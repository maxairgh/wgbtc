<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\Term;
use App\Models\Course;
use App\Models\PubblishContent;
use App\Models\Coursecontent as Content; 
use App\Models\LearnerCourseRegistration as Lcoursereg;
use App\Models\FacilitatorCourseRegistration as coursereg;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Vimeo\Laravel\Facades\Vimeo;
use Livewire\WithFileUploads;


class Coursecontent extends Component
{
    use SmsTrait, LivewireAlert, WithFileUploads;

    public $selectMode = true, $Vchapter, $Vtitle, $Vfile, $Vstatus, $Vorder, $Vdetails, $isUpdate = false, $label = "SAVE";
    public $selectCourse, $nContentId, $Nchapter, $Ntitle, $Nfile, $Nstatus, $Norder, $Ndetails, $courseContents=[], $updateID;
    public $deleteID, $unPublishId, $activeTerm;

    protected $listeners = [
        'DeleteNow', 
        'unPublishNow',
    ];

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
           // 'Nfile' => ['nullable','mimetypes:video/mp4,video/x-msvideo','max:500000'],  
            'Nstatus' => ['required','integer'],  
            'Norder' => ['required','integer'],  
            'Ndetails' => ['required','string'],  
        ]); 


        if ($this->isUpdate){
            //update
            $done = Content::where('id',$this->updateID)->update([
                'chapter' => $this->Nchapter, 
                'title' => $this->Ntitle,
                'video' => $this->Nfile,
                'status' => $this->Nstatus,
                'details' => $this->Ndetails,
                'order' => $this->Norder,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    
            if ($done){
                session()->flash('success', 'Content updated successfully');
                $this->resetForm();
                $this->getCourseContent($this->selectCourse->id);
                $this->alert('success', 'Content updated successfully',[
                 'position' => 'center'
             ]);
             return;
            }  
        }else{
            $done = Content::create([
                'course_id' => $this->selectCourse->id, 
                'chapter' => $this->Nchapter, 
                'title' => $this->Ntitle,
                'video' => $this->Nfile,
                'status' => $this->Nstatus,
                'details' => $this->Ndetails,
                'order' => $this->Norder,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    
            if ($done){
                session()->flash('success', 'Content added successfully');
                $this->resetForm();
                $this->getCourseContent($this->selectCourse->id);
                $this->alert('success', 'Content added successfully',[
                 'position' => 'center'
             ]);
             return;
            }
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
    $this->isUpdate = false;
    $this->label = "SAVE";
   }

   public function backToCourses(){
    $this->selectMode = true;
    $this->resetForm();
   }

   public function getCourseContent($id){
        $this->courseContents = Content::where('course_id',$id)->orderBy('order')->get();
        $this->activeTerm = Term::where('status','Active')->first();
   }

   public function viewContentDetails($id){
    $content = Content::where('id',$id)->orderBy('order')->first();
    if ($content){
        $this->emit('showModalEvent');
        $this->updateID = $content->id;
        $this->Vchapter = $content->chapter;
        $this->Vtitle = $content->title;
        $this->Vfile = $content->video;
        $this->Vstatus = $content->status;
        $this->Vorder = $content->order;
        $this->Vdetails = $content->details;
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
        $this->label = "UPDATE";
        $this->isUpdate = true;
        $this->updateID = $content->id;
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
     
    public function deleteMaterial($id){
        $this->deleteID = $id;
        $this->alert('question', 'Are you sure you want to delete ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'DeleteNow',
        ]);

    }

    public function deleteNow(){
        $content = Content::where('id',$this->$deleteID)->orderBy('order')->first();
        $Course_id = $content->course_id;
        if ($content->delete()){
            $this->getCourseContent($Course_id);
            session()->flash('success', 'Content deleted successfully');
            $this->alert('success', 'Content deleted successfully',[
                'position' => 'center'
            ]);
            return ;  
        }
        session()->flash('success', 'Content could not be deleted');
            $this->alert('success', 'Content could not be deleted',[
                'position' => 'center'
            ]);
    }

    public function publishContentForActiveTerm($id){
        //active term details
         if ($this->activeTerm){
            $done = PubblishContent::create([
                'course_id' => $this->selectCourse->id,
                'term_id' => $this->activeTerm->id,
                'content_id' => $id, 
                'check' => md5($this->selectCourse->id.$this->activeTerm->id.$id),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($done){
                session()->flash('success', 'Content published successfully');
                $this->alert('success', 'Content published successfully',[
                    'position' => 'center'
                ]);
                $this->getCourseContent($this->selectCourse->id);
                return;
            }
        }
        session()->flash('warning', 'Content could not be published');
        $this->alert('success', 'Content could not be published',[
            'position' => 'center'
        ]);
    }

    public function unPublishContent($id){
        $this->unPublishId = $id;
        $this->alert('question', 'Are you sure you want to unpublish content ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, remove', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'unPublishNow',
        ]);
    }

    public function unPublishNow(){
       if( PubblishContent::where('id',$this->unPublishId)->delete() ){
        session()->flash('success', 'Content unpublished successfully');
        $this->alert('success', 'Content unpublished successfully',[
            'position' => 'center'
        ]);
        $this->getCourseContent($this->selectCourse->id);
        return;
       }
       session()->flash('success', 'Content could not be unpublished');
       $this->alert('success', 'Content could not be unpublished',[
           'position' => 'center'
       ]);
    }

    public function render()
    {
         return view('livewire.facilitators.coursecontent',['courses'=>$this->getCourse()])
        ->layout('layouts.facilitator'); 
    }
}
