<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\Term;
use App\Models\Course;
use App\Http\Traits\SmsTrait;
use Livewire\WithFileUploads;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\FacilitatorCourseRegistration as coursereg;
use App\Models\LearnerCourseRegistration as Lcoursereg;

class Courseworks extends Component
{
    public $selectMode = true, $selectedCourse, $activeCourse;


    public function getCourse(){
        $Details = [];
        $userID = Auth::user()->id;
        $courses = coursereg::where('staff_id',$userID)->get();
         //active term details
        $term = Term::where('status','Active')->first();
        
        foreach($courses as $course){
            $list = [];
            $list['title'] = $course->course->code . ' - '. $course->course->title ;
            $list['number'] = Lcoursereg::where('term_id',$term->id)->where('course_id',$course->course_id)->count();
            $list['id'] = $course->course_id;
            $Details[] = $list;
        }
       
        return $Details;
    }

    public function manageContent($id){
        $this->selectMode = false;
        $this->selectedCourse = Course::where('id',$id)->first();
        $this->getCourseContent($id);
    }

    public function backToCourses(){
        $this->selectMode = true;
        $this->resetForm();
       }

    public function getCourseContent($id){

    }

    public function resetForm(){

    }


    public function render()
    {
        
        return view('livewire.facilitators.courseworks',['courses'=>$this->getCourse()])
        ->layout('layouts.facilitator'); 
    }
}
