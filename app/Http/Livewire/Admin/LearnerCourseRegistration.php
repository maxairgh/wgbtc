<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Learner;
use App\Models\Term;
use App\Models\LearnerProgram;
use App\Models\Course;
use App\Models\LearnerCourseRegistration as coursereg;

class LearnerCourseRegistration extends Component
{
    use SmsTrait, LivewireAlert;
    public $selectedLearnerID, $courses=[],$registeredcourses=[],$learnerdetails, $programname, $indexNumber; 

    public function getDetails(){
        $this->resetData();
        $this->validate([  
            'indexNumber' => ['required'],    
        ]);

        $learner = Learner::where('matrix',$this->indexNumber)->first();

        if ($learner){
            $this->getLearnerDetails($learner);
            session()->flash('success', 'Learner found.');
            $this->alert('success', 'Learner  found.',[
            'position' => 'center'
           ]);
        }else{
            session()->flash('error', 'Learner not found.');
             $this->alert('warning', 'Learner not found.',[
             'position' => 'center'
         ]);
         $this->resetData();
        }


    }

    public function getLearnerDetails(Learner $learner){
 //active term details
 $term = Term::where('status','Active')->first();
 //learner details
 $this->learnerdetails = $learner->matrix.' '.$learner->firstname.' '.$learner->middlename.' '.$learner->lastname;
 $this->selectedLearnerID = $learner->id;
 //get registered program.
  $activeprogram = LearnerProgram::where('learner_id',$learner->id)->whereNull('enddate')->first();
  $this->programname = $activeprogram->program->title;
 //get registered course for the program
 $regcourseid = coursereg::where('learner_id',$learner->id)->pluck('course_id'); //get ids
 $this->registeredcourses = coursereg::where('learner_id',$learner->id)->where('term_id',$term->id)->get();
 //get course for the program excluding those already registered for.
 $this->courses = Course::where('program_id',$activeprogram->program->id)->whereNotIn('id',$regcourseid)->get();
 }

public function registerCourse($courseid){
     if (!$this->selectedLearnerID){
        session()->flash('success', 'Please provide a correct index number.');
        $this->alert('success', 'Please provide a correct index number.',[
        'position' => 'center'
       ]);
     }else{
         $term = Term::where('status','Active')->first();
         $checks = md5($this->selectedLearnerID.$courseid);
         $done = coursereg::create([
            'learner_id' => $this->selectedLearnerID,
            'term_id' => $term->id,
            'course_id' => $courseid,
            'checks' => $checks,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($done){
            //reloaod the details
            $learner = Learner::where('id',$this->selectedLearnerID)->first();
            $this->getLearnerDetails($learner);
            session()->flash('success', 'Course registered successfully.');
            $this->alert('success', 'Course registered successfully.',[
            'position' => 'center'
           ]);
           return;
        }
        session()->flash('error', 'Course registration failed');
        $this->alert('warning', 'Course registration failed',[
        'position' => 'center'
       ]);
     }
}

public function removeRegisteredCourse($courseid){
    $course = coursereg::where('id',$courseid)->first();
    $learner = Learner::where('id',$course->learner_id)->first();
    if ($course->delete()){
        session()->flash('error', 'Registered course removed successfully');
        $this->alert('warning', 'Registered course removed successfully',[
        'position' => 'center'
       ]);
       $this->getLearnerDetails($learner);
        return;
    }
    session()->flash('error', 'Registered course could not be removed');
        $this->alert('warning', 'Registered course could not be removed',[
        'position' => 'center'
       ]);
}

    public function resetData(){
        $this->learnerdetails = '';
        $this->selectedLearnerID = '';
        $this->registeredcourses = [];
        $this->courses = [];
        $this->programname = '';
    }

    public function render()
    {
        $term = Term::where('status','Active')->first();
        return view('livewire.admin.learner-course-registration',['term'=>$term])
        ->layout('layouts.admin'); 
    }
}
