<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\Term;
use App\Models\Course;
use App\Models\Assessment; 
use App\Models\Assesstype;
use App\Http\Traits\SmsTrait;
use Livewire\WithFileUploads;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\FacilitatorCourseRegistration as coursereg;
use App\Models\LearnerCourseRegistration as Lcoursereg;
use Illuminate\Support\Facades\File; 

class Courseworks extends Component
{
    use SmsTrait, LivewireAlert, WithFileUploads;
    public $selectMode = true, $selectedCourse, $activeCourse, $coursetypes = [], $isUpdate = false, $label= "SAVE WORK";
    public $exercisetype, $content, $quiz = 1, $attachment, $duedate, $courseWorks = [], $activeTerm;
    public $Vexercisetype, $Vcontent, $Vquiz, $Vattachment, $Vduedate, $selectID, $deleteID;

    public function getCourse(){
        $Details = [];
        $userID = Auth::user()->id;
        $courses = coursereg::where('staff_id',$userID)->get();
         //active term details
        $this->activeTerm = Term::where('status','Active')->first();
        
        foreach($courses as $course){
            $list = [];
            $list['title'] = $course->course->code . ' - '. $course->course->title ;
            $list['number'] = Lcoursereg::where('term_id',$this->activeTerm->id)->where('course_id',$course->course_id)->count();
            $list['id'] = $course->course_id;
            $Details[] = $list;
        }
       
        return $Details;
    }

    public function manageContent($id){
        $this->selectMode = false;
        $this->selectedCourse = Course::where('id',$id)->first();
        $this->coursetypes = Assesstype::where('status',1)->get();
        $this->getCourseContent($id);
    }

    public function backToCourses(){
        $this->selectMode = true;
        $this->resetForm();
       }

    public function savecourseWork(){
        
        $this->validate([
            'exercisetype' => ['required','integer'],  
            'content' => ['required','string'],  
            'attachment' => ['nullable','mimetypes:image/jpeg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document','max:500000'],  
            'quiz' => ['required','integer'],  
            'duedate' => ['required','date'],   
        ]); 

        
        $destination = storage_path().'/app/public/coursework/';
        $filename = "";
        //check if the folder exist if not create.
       if(!File::isDirectory($destination)){
            File::makeDirectory($destination, 0777, true, true);
       }

       //if file upload available save it first.
       $checks = md5($this->selectedCourse->id.$this->activeTerm->id.$this->exercisetype);
       
       if ($this->attachment){
           //save data and notify user 
       $filename = md5($this->selectedCourse->id.$this->activeTerm->id.$this->exercisetype).'.'.$this->attachment->extension();
       $this->attachment->storeAs('public/coursework/', $filename);
       }
        
        $newDateformat = date('Y-m-d H:i:s',strtotime($this->duedate));
      
        
       if ($this->isUpdate){
       


       }else{

        try {
            //code...
             $done = Assessment::create([
                'course_id' => $this->selectedCourse->id,
                'term_id' => $this->activeTerm->id,
                'assesstype_id' => $this->exercisetype,
                'content' => $this->content,
                'attachment' => $filename,
                'duedate' => $newDateformat,
                'quiz' => $this->quiz,
                'checks' => $checks,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
             ]);

             if ($done){
                session()->flash('success', 'Content work added successfully');
                $this->resetForm();
                $this->getCourseContent($this->selectedCourse->id);
                $this->alert('success', 'Content work added successfully',[
                 'position' => 'center'
             ]);
             
             }
            } catch (\Throwable $th) {
                $this->alert('success', 'An error occured, work already exist',[
                    'position' => 'center'
                ]);
            }
       }
  
}
  

    public function getCourseContent($id){
        $this->courseWorks = Assessment::where('course_id',$id)->where('term_id',$this->activeTerm->id)->get();
       
    }

    public function resetForm(){
        $this->emit('resetEmittedData');
        $this->exercisetype = ''; 
        $this->content = ''; 
        $this->quiz = 1;  
        $this->attachment = ''; 
        $this->duedate = ''; 
        $this->isUpdate = false;
        $this->label = "SAVE WORK";
        $this->selectID = '';
         $this->deleteID = '';
    }

    public function viewContentDetails($id){
        $this->emit('showModalEvent'); 
        $assessment = Assessment::where('id',$id)->first();
        $this->Vexercisetype = $assessment->type->code . ' ' . $assessment->type->name;
        $this->Vcontent = $assessment->content; 
        $this->Vquiz = $assessment->quiz; 
        $this->Vattachment= $assessment->attachment; 
        $this->Vduedate = $assessment->duedate; 
    }

    public function editContentDetails($id){
        $assessment = Assessment::where('id',$id)->first();
        if ($assessment){
            $this->label = "UPDATE WORK"; 
            $this->isUpdate = true;
            $this->selectID = $assessment->id;
            $this->exercisetype = $assessment->assesstype_id;
            $this->content = $assessment->content;
            $this->quiz = $assessment->quiz;
            //$this->attachment = $assessment->attachment;
            $this->duedate = date('Y-m-d',strtotime($assessment->duedate)); ;
            $this->emit('setDetailsDataEvent', $this->content); 
            $this->alert('success', 'Content Loaded',[
                'position' => 'center'
            ]);
            return;
        }
        $this->alert('warning', 'Content not Loaded',[
            'position' => 'center'
        ]);
    }

    public function downloadFile(){
        if ($this->Vattachment){
            //return Storage::disk('public/coursework/')->download($this->Vattachment);
            $this->emit('hideModalEvent'); 
            return response()->download(storage_path('/app/public/coursework/'.$this->Vattachment));
           
        } 
    }

    public function DeleteWork($id){
        $this->deleteID = $id;
        $this->alert('question', 'Are you sure you want to delete course work?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'DeleteNow',
        ]);
    }

    public function DeleteNow(){
        $content = Assessment::where('id',$this->deleteID)->first();
        $file = $content->attachment;
        $Course_id = $content->course_id;
        if ($content->delete()){
            if ($file){
                unlink(storage_path('/app/public/coursework/'.$file));
            }
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

    protected $listeners = [
        'DeleteNow',  
    ];

    public function render()
    {
        
        return view('livewire.facilitators.courseworks',['courses'=>$this->getCourse()])
        ->layout('layouts.facilitator'); 
    }
}
