<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\FacilitatorCourseRegistration as coursereg;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacilitatorCoursereg extends Component
{
    use SmsTrait, LivewireAlert;
    public $selectedTeacherID, $regCourses=[];

    public function getAssignedCourses(){
        //reset selected course
        $this->regCourses=[];
        $this->validate([  
            'selectedTeacherID' => ['required'],  
        ]);
        //get registered course for the selected facilitator
        $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();

        if (count($this->regCourses) > 0){
            session()->flash('success', 'Assigned courses loaded successfully.');
            $this->alert('success', 'Assigned courses loaded successfully.',[
             'position' => 'center'
         ]);
            return ;
        }
        session()->flash('success', 'No assigned course.'); 
        $this->alert('success', 'No assigned course.',[
         'position' => 'center'
     ]);
    }


    public function addCourse($id){
        $this->regCourses=[];
        $this->validate([  
            'selectedTeacherID' => ['required'],   
        ]);
          
        try {

            $exist = coursereg::where('course_id',$id)->first();

            if ( $exist ){
                session()->flash('success', 'Course already assigned.');
                $this->alert('success', 'Course already assigned.',[
                 'position' => 'center'
             ]);
             $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();
             return;
            }

            //add course
            $done = coursereg::create([
                'staff_id' => $this->selectedTeacherID,
                'course_id' =>  $id,
                'checks' => md5($id.$this->selectedTeacherID),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($done){
                //get registered course for the selected facilitator
                $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();
                session()->flash('success', 'Course assigned successfully.');
                $this->alert('success', 'Course assigned successfully.',[
                 'position' => 'center'
             ]);
             return;
            }

        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('success', 'An arror occured, Course already assigned.');
            $this->alert('success', 'An arror occured, Course already assigned.',[
             'position' => 'center'
         ]);
         $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();
        }
      


        
    }

    public function removeCourse($id){
        $this->regCourses=[];
        $this->validate([  
            'selectedTeacherID' => ['required'],   
        ]);
 
         if (coursereg::where('id',$id)->delete()){
        //get registered course for the selected facilitator
        $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();
        session()->flash('success', 'Course assigned deleted successfully.');
        $this->alert('success', 'Course assigned deleted successfully.',[
        'position' => 'center'
        ]);
        return;
        }
            //get registered course for the selected facilitator
            $this->regCourses = coursereg::where('staff_id',$this->selectedTeacherID)->get();
            session()->flash('success', 'Assigned Course could not be deleted.');
            $this->alert('success', 'Assigned Course could not be deleted.',[
            'position' => 'center'
            ]);
    }

    public function render()
    {
        
        $courses = Course::where('status',1)->get();
        $facilitators = user::where('type','facilitator')->get();
        
        return view('livewire.admin.facilitator-coursereg',['facilitators'=>$facilitators,'courses'=>$courses])
        ->layout('layouts.admin'); 
    }
}
