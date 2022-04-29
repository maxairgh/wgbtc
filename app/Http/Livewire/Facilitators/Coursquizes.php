<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\Term;
use App\Models\Course;
use App\Models\Assessment; 
use App\Models\Quizquestions; 
use App\Http\Traits\SmsTrait;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\File; 
use App\Models\FacilitatorCourseRegistration as coursereg;
use App\Models\LearnerCourseRegistration as Lcoursereg;

class Coursquizes extends Component
{
    use SmsTrait, LivewireAlert, WithFileUploads, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectMode = true, $selectedCourse, $activeCourse, $activeTerm, $selectedQuiz, $isUpdate = false;
    public $excelfile, $question, $alt1,$alt2, $alt3, $alt4, $answer, $allocateQuizTime, $deleteID, $updateID;               
   
    protected $listeners = [
        'deleteNow', 
        'editNow',
        'clearQuestionsNow',
    ];

    public function saveQuestion(){
        
        $this->validate([
            'question' => ['required','string'],  
            'alt1' => ['required','string'],  
            'alt2' => ['required','string'],  
            'alt3' => ['required','string'],  
            'alt4' => ['required','string'],  
            'answer' => ['required','string'],   
        ]); 

        if ($this->isUpdate){
            //update
        //save question
        $done = Quizquestions::where('id',$this->updateID)->update([
            'question' => $this->question,
            'answer1' => $this->alt1,
            'answer2' => $this->alt2,
            'answer3' => $this->alt3,
            'answer4' =>  $this->alt4,
            'answers' => $this->answer,
            'updated_at' => date('Y-m-d H:i:s'), 
        ]);  

        if ($done){
            session()->flash('success', 'Question saved successfully');
            $this->resetForm();
            $this->getCourseWork($this->selectedCourse->id);
            $this->alert('success', 'Question saved successfully',[
             'position' => 'center'
         ]);
        }
        }else{
            //save
        //save question
        $done = Quizquestions::create([
            'assess_id' => $this->selectedQuiz->id,
            'question' => $this->question,
            'type' => null,
            'answer1' => $this->alt1,
            'answer2' => $this->alt2,
            'answer3' => $this->alt3,
            'answer4' =>  $this->alt4,
            'answers' => $this->answer,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'), 
        ]);  

        if ($done){
            session()->flash('success', 'Question saved successfully');
            $this->resetForm();
            $this->getCourseWork($this->selectedCourse->id);
            $this->alert('success', 'Question saved successfully',[
             'position' => 'center'
         ]);
        }
        }


    }

    public function uploadQuestions(){
        $this->validate([
            'excelfile' => ['required','mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.sealed.xls,text/csv','max:100000'],  
        ]); 

        $destination = storage_path().'/app/public/temp/';
        $filename = "";
        //check if the folder exist if not create.
       if(!File::isDirectory($destination)){
            File::makeDirectory($destination, 0777, true, true);
       }
  
       if ($this->excelfile){
           //save data and notify user 
       $filename = md5(date('y-m-d H:i:s')).'.'.$this->excelfile->extension();
       $this->excelfile->storeAs('public/temp/', $filename);
       }

       $file = storage_path().'/app/public/temp/'.$filename;

         $users = (new FastExcel)->import($file, function ($line) {
             return Quizquestions::create([
                'assess_id' => $this->selectedQuiz->id,
                'question' => $line['question'],
                'type' => null,
                'answer1' => $line['alt1'],
                'answer2' => $line['alt2'],
                'answer3' => $line['alt3'],
                'answer4' =>  $line['alt4'],
                'answers' => $line['answer'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'), 
            ]); 
        });

         //delete file
         unlink($file);

    }

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
        $this->getCourseWork($id);
        $this->resetForm();
    }

    public function backToCourses(){
        $this->selectMode = true;
        $this->resetForm();
        $this->selectedQuiz = '';
       }

    public function getCourseWork($id){
        $this->selectedQuiz = Assessment::where('term_id',$this->activeTerm->id)->where('course_id',$id)->where('quiz',2)->first();   
   }

   public function resetForm(){
        $this->excelfile = '';
        $this->question  = '';
        $this->alt1  = '';
        $this->alt2  = ''; 
        $this->alt3  = ''; 
        $this->alt4  = ''; 
        $this->answer  = ''; 
        $this->updateID = ''; 
        $this->deleteID = ''; 
        $this->allocateQuizTime = ''; 
        $this->isUpdate = false;
    }

    public function deleteQuestion($id){
        $this->deleteID = $id;
        $this->alert('question', 'Are you sure you want to delete this question ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'deleteNow',
        ]);
    }

    public function deleteNow(){
        if( Quizquestions::where('id',$this->deleteID)->delete() ){
         session()->flash('success', 'Question deleted successfully');
         $this->alert('success', 'Question deleted successfully',[
             'position' => 'center'
         ]);
         return;
        }
        session()->flash('success', 'Question could not be deleted');
        $this->alert('success', 'Question could not be deleted',[
            'position' => 'center'
        ]);
     }

    public function editQuestion($id){
        $this->updateID = $id; 
        $this->alert('question', 'Are you sure you want to update this question ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, update', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'editNow',
        ]); 
    }

    public function editNow(){
        $question = Quizquestions::where('id',$this->updateID)->first();
        if ($question){
            $this->isUpdate = true;
            $this->question  = $question->question; 
            $this->alt1 = $question->answer1; 
            $this->alt2 = $question->answer2; 
            $this->alt3 = $question->answer3; 
            $this->alt4  = $question->answer4; 
            $this->answer = $question->answers; 
            session()->flash('success', 'Question loaded successfully');
            $this->alert('success', 'Question loaded successfully',[
                'position' => 'center'
            ]);
            return;
        }
    }

    public function updateTime(){
        
        $this->validate([
            'allocateQuizTime' => ['required','integer'],  
        ]); 

        $this->selectedQuiz->update([
            'time' => $this->allocateQuizTime,
        ]);

        session()->flash('success', 'Quiz time updated successfully');
        $this->alert('success', 'Quiz time updated successfully',[
            'position' => 'center'
        ]);
    }

    public function clearQuestions(){

        $this->alert('question', 'Are you sure you want to clear all questions ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Clear All', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'clearQuestionsNow',
        ]); 
    }

    public function clearQuestionsNow(){
    
        if (Quizquestions::where('assess_id',$this->selectedQuiz->id)->delete()){
            session()->flash('success', 'Quiz cleared successfully');
            $this->alert('success', 'Quiz cleared successfully',[
                'position' => 'center'
            ]); 
            $this->resetForm();
            return;
        }
        session()->flash('success', 'An error occured');
        $this->alert('danger', 'An error occured',[
            'position' => 'center'
        ]);
    }

    public function render()
    {
         
        if ($this->selectedQuiz){
            return view('livewire.facilitators.coursquizes',['courses'=>$this->getCourse(), 
            'quizQuestions' => Quizquestions::where('assess_id',$this->selectedQuiz->id)->paginate(15),
            'counted' => Quizquestions::where('assess_id',$this->selectedQuiz->id)->count()
            ])
            ->layout('layouts.facilitator'); 
        }
        return view('livewire.facilitators.coursquizes',['courses'=>$this->getCourse(),
        'quizQuestions' => Quizquestions::where('assess_id','')->paginate(2),
        'counted' => Quizquestions::where('assess_id','')->count()
        ])
        ->layout('layouts.facilitator'); 
        
    }
}
