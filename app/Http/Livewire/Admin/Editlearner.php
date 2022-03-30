<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Program;
use App\Models\denomination;
use App\Models\Session;
use App\Models\Learner;
use App\Models\LearnerProgram; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Editlearner extends Component
{
    use SmsTrait, LivewireAlert;
 
    public $selectedID, $deleteID, $matrix, $firstname, $middlename, $lastname, $gender, $dob, $maritalstatus, $status;
    public $phonenumber, $email, $denomination, $position, $programid, $programs = [];
    
    public function mount($learnerid)
    {
        $Learner = Learner::find($learnerid);
        if (!$Learner){
            redirect()->route(url()->previous());
        }
        $this->setData($Learner); 
    }
  
    public function updateDetails(){
      
        $this->validate([  
            'firstname' => ['required','string'],  
            'middlename' => ['sometimes'],  
            'lastname' => ['required','string'],  
            'gender' => ['required'],   
            'dob' => ['required','date'],   
            'maritalstatus' => ['required'],   
            'status' => ['required'],   
            'phonenumber' => ['required'],   
            'email' => ['required'],   
            'denomination' => ['required'],   
            'position' => ['required'],          
        ]);
       
        //start transaction 
       DB::beginTransaction();
       try {
          
        //insert learner
        $done = Learner::where('id',$this->selectedID)->update([
          'matrix' =>  $matrix_number,  
          'firstname' =>  $this->firstname,   
          'lastname' =>  $this->lastname, 
          'middlename' =>  $this->middlename, 
          'gender' =>  $this->gender, 
          'dob' =>  $this->dob, 
          'marital_status' =>  $this->maritalstatus, 
          'status' =>  $this->status, 
          'mobile' =>  $this->phonenumber, 
          'email' =>  $this->email, 
          'denomination' =>  $this->denomination, 
          'position' =>  $this->position, 
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //insert registration
       session()->flash('success', 'Learner registration updated successfully.');
           $this->resetForm();
           $this->alert('success', 'Learner registration updated successfully',[
            'position' => 'center'
        ]);
           return ;
       } catch (\Throwable $th) {
       //throw $th;
        DB::rollback();
        session()->flash('error', 'Learner registration not updated successfully');
       }


    }


    public function resetForm(){
        $this->firstname =""; 
        $this->middlename =""; 
        $this->lastname =""; 
        $this->gender =""; 
        $this->dob =""; 
        $this->maritalstatus =""; 
        $this->status =""; 
        $this->phonenumber =""; 
        $this->email =""; 
        $this->denomination =""; 
        $this->position =""; 
        $this->programid =""; 
        $this->sessionid;
    }

    public function setData(Learner $learner){
            $this->selectedID = $learner->id;
            $this->matrix = $learner->matrix;
            $this->firstname = $learner->firstname;
            $this->middlename = $learner->middlename;
            $this->lastname = $learner->lastname;
            $this->gender = $learner->gender;
            $this->dob = $learner->dob; 
            $this->maritalstatus = $learner->marital_status;
            $this->status = $learner->status;
            $this->phonenumber = $learner->mobile;
            $this->email = $learner->email; 
            $this->denomination = $learner->denomination; 
            $this->position = $learner->position;
            $this->programs = $learner->programs; 
  
    }

    public function RegisterNewProgram(){
 
        $this->validate([  
            'selectedID' => ['required'],  
            'programid' => ['required'],  
        ]);
        
        $checks = md5($this->selectedID.$this->programid); 
        $program_exit = LearnerProgram::where('checks',$checks)->first();

        if ($program_exit){
            $this->alert('warning', 'Program already assigned to learner.',[
                'position' => 'center'
            ]);
            return;
        }

        try {
            //code...
            $done = LearnerProgram::create([
                'learner_id' =>  $this->selectedID,  
                'program_id' =>  $this->programid, 
                'checks' =>  md5($this->selectedID.$this->programid), 
                'startdate' =>  date('Y-m-d H:i:s'), 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
              $this->alert('success', 'Program successfully assigned to learner.',[
                'position' => 'center'
            ]);
            session()->flash('success', 'Program successfully assigned to learner.');
        } catch (\Throwable $th) {
            //throw $th;
            $this->alert('warning', 'An error occured.',[
                'position' => 'center'
            ]);
              session()->flash('success', $th);
    
            return;
        }
        $this->alert('warning', 'An error occured.',[
            'position' => 'center'
        ]);
    }

    function deleteAssignedProgram($id){
        $this->deleteID = $id;

        try {
            //code...
            $this->validate([  
                'selectedID' => ['required'],   
                'deleteID' => ['required'],   
            ]);
            
            //get detials 
            $program_exit = LearnerProgram::where('id',$id)->first();
    
            if (!$program_exit->enddate){
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
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function CompletedAssignedProgram($id){
        $done = LearnerProgram::where('id',$id)->update([
            'enddate' =>  date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($done){
            $this->alert('success', 'Program completed successfully.',[
                'position' => 'center'
        ]);
        }
    }

    protected $listeners = [
        'DeleteNow', 
    ];

    public function DeleteNow(){
        $done = LearnerProgram::where('id',$this->deleteID)->delete();
        if ($done){
            $this->alert('success', 'Program successfully deleted.',[
                'position' => 'center'
            ]);
        }
    }
   

    public function render()
    {
        $denominations = denomination::all();
        $programs = Program::where('status',2)->get();
        return view('livewire.admin.editlearner',['denominations'=>$denominations,
        'progs'=>$programs])
        ->layout('layouts.admin'); 
    }
}
