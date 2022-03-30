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

class Onlineregistration extends Component
{

    
    public $firstname, $middlename, $lastname, $gender, $dob, $maritalstatus, $status, $phonenumber, $email, $denomination, $position, $programid;

    public function saveDetail(){
       
        $this->validate([
            //'programid' => ['string'],  
            'firstname' => ['required','string'],  
            'middlename' => ['sometimes'],  
            'lastname' => ['required','string'],  
            'gender' => ['required'],   
            'dob' => ['required','date'],   
            'maritalstatus' => ['required'],   
            'status' => ['required'],   
            'phonenumber' => ['required'],   
            'email' => ['required','unique:users,email'],   
            'denomination' => ['required'],   
            'position' => ['required'],   
            'programid' => ['required'],   
             
        ]);

       
       //start transaction 
       DB::beginTransaction();
       try {
           //code...
        //insert learner
        $learner_id = DB::table('online_registrations')->insertGetId([
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
          'program_id' =>  $this->programid, 
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
     
        //event new learner notification

           DB::commit();
           session()->flash('success', 'You application submitted successfully, we will get back soon. Thank you.');
           $this->resetForm();
           return ;
       } catch (\Throwable $th) {
           //throw $th;
        DB::rollback();
        session()->flash('success', 'An error occured, application not submitted.');
       }


    }

    public function generateIndexNumber(){
        //WGBS000122
      $count = Learner::whereYear('created_at',date('Y'))->count() + 1;
      $newid = str_pad($count,'4','0',STR_PAD_LEFT);
      return 'WGBS'.$newid.date('y');
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
    }


    public function render()
    {
        $denominations = denomination::all();
        $programs = Program::where('status',2)->get();
    
        return view('livewire.admin.onlineregistration',['denominations'=>$denominations,'programs'=>$programs])
        ->layout('layouts.out'); 
    }
}
