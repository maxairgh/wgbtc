<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\Term;
use App\Models\Course;
use App\Models\Coursecontent as Content; 
use App\Models\LearnerCourseRegistration as Lcoursereg;
use App\Models\FacilitatorCourseRegistration as coursereg;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Coursecontent extends Component
{
    use SmsTrait, LivewireAlert;

    public $selectMode = true, $Vchapter, $Vtitle, $Vfile, $Vstatus, $Vorder, $Vdetails, $isUpdate = false, $label = "SAVE";
    public $selectCourse, $Nchapter, $Ntitle, $Nfile, $Nstatus, $Norder, $Ndetails, $courseContents=[], $updateID;

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

   public function  manageContent($id){
        $this->selectMode = false;
        $this->selectCourse = Course::where('id',$id)->first();
        $this->getCourseContent($id);
   }

   public function saveContent(){
        $this->validate([
            'Nchapter' => ['required','string'],  
            'Ntitle' => ['required','string'],  
            //'Nfile' => ['required','integer'],  
            'Nstatus' => ['required','string'],  
            'Norder' => ['required','integer'],  
            'Ndetails' => ['required','string'],  
        ]); 

        if ($isUpdate){

        }else{

        }

        
   }

   public function resetForm(){
    $this->emit('resetEmittedData');
    $this->Nchapter ="";
    $this->Ntitle =""; 
    $this->Nfile =""; 
    $this->Nstatus =""; 
    $this->Norder =""; 
    $this->Ndetails ="";
    $this->updateID = "";
    $this->updateID = "";
   }

   public function backToCourses(){
    $this->selectMode = true;
   }

   public function getCourseContent($id){
        $this->courseContents = Content::where('course_id',$id)->orderBy('order')->get();
   }

   public function viewContentDetails($id){
    $content = Content::where('course_id',$id)->orderBy('order')->first();
    if ($content){
        $this->updateID = $content->id;
        $this->Vchapter = $content->chapter;
        $this->Vtitle = $content->title;
        $this->Vfile = $content->video;
        $this->Vstatus = $content->status;
        $this->Vorder = $content->order;
        $this->Vdetails = $content->details;
        $this->label = "UPDATE";
        $this->isUpdate = true;
        $this->alert('success', 'Content Loaded',[
            'position' => 'center'
        ]);
    return ;
}
    $this->alert('warning', 'Content could not be loaded.',[
        'position' => 'center'
    ]);
   }

   public function editContentDetails($id){
    $content = Content::where('id',$id)->orderBy('order')->first();
    if ($content){
        $this->Nchapter = $content->chapter;
        $this->Ntitle = $content->title;
        $this->Nfile = $content->video;
        $this->Nstatus = $content->status;
        $this->Norder = $content->order;
        $this->Ndetails = $content->details;
        $this->emit('setDetailsDataEvent', $this->Ndetails);
        $this->alert('success', 'Content Loaded',[
            'position' => 'center'
        ]);
        return ;
    }
        $this->alert('warning', 'Content could not be loaded.',[
            'position' => 'center'
        ]);
    }

   

    public function render()
    {
         return view('livewire.facilitators.coursecontent',['courses'=>$this->getCourse()])
        ->layout('layouts.facilitator'); 
    }
}
