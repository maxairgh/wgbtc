<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Program;
use App\Models\Course;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Courses extends Component
{
    use LivewireAlert, WithPagination;
    public $label = "SAVE", $courseid, $code, $title, $creditValue, $status, $programid, $deleteID;
    public $isUpdate = false; 
   
    
    public function SaveCourse(){
        
        $this->validate([
            //'courseid' => ['string'],  
            'code' => ['required','string'],  
            'title' => ['required','string'],  
            'creditValue' => ['required'],  
            'programid' => ['required','integer'],  
            'status' => ['required'],   
        ]);
    
try {
    //code...  $courseid, $code, $title, $creditValue, $status, $programid
  
        if ($this->isUpdate){
           //update
           $course = Course::find($this->courseid);
           $done = $course->update([
            'code' => $this->code,
            'title' => $this->title,
            'credit_value' => $this->creditValue,
            'status' => $this->status,
            'program_id' => $this->programid,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($course){
            //event
          //event(new UserRegisteredEvent($user));
          session()->flash('success', 'Course updated successfully');
          $this->alert('success', 'Course updated successfully.',[
            'position' => 'center'
        ]);
          $this->resetData(); 
          return ;
        }
       
        }else{
            //save
            $course = Course::create([
                'code' => $this->code,
                'title' => $this->title,
                'credit_value' => $this->creditValue,
                'status' => $this->status,
                'program_id' => $this->programid,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            if ($course){
                //event
              //event(new UserRegisteredEvent($user));
              session()->flash('success', 'Course saved successfully');
              $this->alert('success', 'Course saved successfully.',[
                'position' => 'center'
            ]);
              $this->resetData(); 
              return ;
            }
           
        }
        
    } catch (\Throwable $th) {
        
        session()->flash('error', 'An error occured while trying to save data '. $th);
    }
    
    }


    public function EditDetails($id){
        $course = Course::find($id);
        if($course){
            $this->courseid = $course->id;
            $this->code = $course->code;
            $this->title = $course->title;
            $this->creditValue = $course->credit_value;
            $this->status = $course->status;
            $this->programid = $course->program_id;
            $this->isUpdate = true; 
            $this->label="UPDATE"; 
        }
    }

    public function changeStatus($id){
        try {
            //code...
        $course = Course::find($id);
        if ($course->status == 1){
            $done = $course->update([
                'status' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }else{
            $done = $course->update([
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $this->resetData(); 
        session()->flash('success', 'operation successful');
        $this->alert('success', 'operation successfully.',[
            'position' => 'center'
        ]);
    } catch (\Throwable $th) {
        session()->flash('error', 'An error occured in operation');
    }
    }

    public function deleteCourseConfrim(){
        if (!$this->deleteID){
            $this->alert('warning', 'Kindly select one.',[
                'position' => 'center'
            ]);
            return;
        }

        if (Course::where('id',$this->deleteID)->delete()){
            $this->alert('success', 'Course deleted successfully.',[
                'position' => 'center'
            ]);
            return;
        }

        $this->alert('warning', 'Course could not be deleted.',[
            'position' => 'center'
        ]);
    }

    public function deleteCourse($id){
        $this->deleteID = $id;
        $this->alert('question', 'Are you sure you want to delete ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'deleteCourseConfrim',
        ]);  
    }

    public function resetData(){
        $this->courseid =""; 
        $this->code =""; 
        $this->title =""; 
        $this->creditValue =""; 
        $this->status =""; 
        $this->programid ="";
        $this->isUpdate = false;
        $this->label = "SAVE";
    }

    protected $listeners = [
        'deleteCourseConfrim',
        'EditNow'
    ];

    public function render()
    {
        $programs = Program::where('status',2)->get();
        $courses = Course::paginate(15); 
        return view('livewire.admin.courses',['programs'=>$programs,'courses'=>$courses])
        ->layout('layouts.admin'); 
    }
}
