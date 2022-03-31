<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Program;
use App\Models\denomination;
use App\Models\Session;
use App\Models\Learner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SmsTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Learners extends Component
{
    use SmsTrait, LivewireAlert;
 
    public $firstname, $middlename, $lastname, $gender, $dob, $maritalstatus, $status, $phonenumber, $email, $denomination, $position, $programid, $sessionid;

  
    public function saveDetail(){
      
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
            'programid' => ['required'],    
        ]);
       
       $matrix_number = $this->generateIndexNumber();

       //start transaction 
       DB::beginTransaction();
       try {
           //code...
          
        //insert learner
        $learner_id = DB::table('learners')->insertGetId([
          'matrix' =>  $matrix_number,  
          'firstname' =>  $this->firstname,   
          'lastname' =>  $this->lastname, 
          'middlename' =>  $this->middlename, 
          'gender' =>  $this->gender, 
          'dob' => date('Y-m-d',strtotime($this->dob)), 
          'marital_status' =>  $this->maritalstatus, 
          'status' =>  $this->status, 
          'mobile' =>  $this->phonenumber, 
          'email' =>  $this->email, 
          'denomination' =>  $this->denomination, 
          'position' =>  $this->position,  
          'user_id' =>  Auth::user()->id, 
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //insert registration
         DB::table('learner_programs')->insert([
            'learner_id' =>  $learner_id,  
            'program_id' =>  $this->programid, 
            'checks' =>  md5($learner_id.$this->programid), 
            'startdate' =>  date('Y-m-d H:i:s'), 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]);
        //create user
        $newpassword = 'bslemas'.Date('Y');
         DB::table('users')->insert([
        'firstname' => $this->firstname,
        'lastname' => $this->lastname,
        'mobile' => $this->phonenumber,
        'type' => 'learner',
        'status' => 'Active',
        'email' => $this->email, 
        'learner_id' => $learner_id,  
        'password' => Hash::make($newpassword),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
        //event new learner notification
       
           DB::commit();
           session()->flash('success', 'Learner registered successfully with index Number: '.$matrix_number);
           $this->resetForm();
           $this->alert('success', 'Learner registered successfully with index Number: '.$matrix_number,[
            'position' => 'center'
        ]);
           return ;
       } catch (\Throwable $th) {
       //throw $th;
        DB::rollback();
        session()->flash('error', 'Learner registration not successful');
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

    public function render()
    {
        $denominations = denomination::all();
        $programs = Program::where('status',2)->get();
        return view('livewire.admin.learners',['denominations'=>$denominations,
        'programs'=>$programs])
        ->layout('layouts.admin'); 
    }
}
