<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\OnlineRegistration as Reg;
use App\Models\Session;
use App\Http\Traits\SmsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Onlineapprove extends Component
{
    use SmsTrait, LivewireAlert;
    
    public function deleteRecords($id){
        $reg = Reg::find($id);
        if ($reg->delete()){
            session()->flash('success', 'Application records deleted successfully.');
            $this->alert('success', 'Application records deleted successfully.',[
                'position' => 'center'
            ]);
            return;
        }
        session()->flash('error', 'An error occured registration could not be deleted.');
        $this->alert('warning', 'Application records deleted successfully.',[
            'position' => 'center'
        ]);
        return;
    }

    public function approveRegistration($id){
        $reg = Reg::find($id);
         
        $matrix_number = $this->generateIndexNumber();
        $dateofbirth = date('Y-m-d',strtotime($reg->dob));
               //start transaction 
       DB::beginTransaction();
       try {
         $learner_id = DB::table('learners')->insertGetId([
            'matrix' =>  $matrix_number,  
            'firstname' =>  $reg->firstname,   
            'lastname' =>  $reg->lastname, 
            'middlename' =>  $reg->middlename, 
            'gender' =>  $reg->gender, 
            'dob' =>  $dateofbirth, 
            'marital_status' =>  $reg->marital_status, 
            'status' =>  'Active', 
            'mobile' =>  $reg->mobile, 
            'email' =>  $reg->email, 
            'denomination' =>  $reg->denomination, 
            'position' =>  $reg->position,  
            'user_id' =>  Auth::user()->id, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]);
          //insert registration
          DB::table('learner_programs')->insert([
            'learner_id' =>  $learner_id,  
            'program_id' =>  $reg->program_id, 
            'checks' =>  md5($learner_id.$reg->program_id), 
            'startdate' =>  date('Y-m-d H:i:s'), 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]);
          //create user
          $newpassword = 'bslemas'.Date('Y');
           DB::table('users')->insert([
          'firstname' => $reg->firstname,
          'lastname' => $reg->lastname,
          'mobile' => $reg->mobile,
          'type' => 'learner',
          'status' => 'Active',
          'email' => $reg->email, 
          'learner_id' => $learner_id,  
          'password' => Hash::make($newpassword),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('online_registrations')->where('id',$id)->update([
        'status' => 'Registered',
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

          //event new learner notification
  
             DB::commit();
             session()->flash('success', 'Learner registered successfully');
             $this->alert('success', 'Learner registered successfully',[
                'position' => 'center'
            ]);
             return ;
         } catch (\Throwable $th) {
             //throw $th;
          DB::rollback();
          session()->flash('error', 'Learner registration not successful');
          $this->alert('success', 'Learner registration not successful',[
            'position' => 'center'
        ]);
        }
  

        
    }

    public function disapproveRegistration($id){
        $reg = Reg::find($id);
        $done  = $reg->update([
            'status' => 'Declined',
        ]);
        if ($done){
            session()->flash('success', 'Application declined successfully.');
            
            return;
        }
        session()->flash('error', 'An error occured.');
      
        return;

    }


    public function render()
    {
        $applicants = Reg::where('status','Pending',)->orderBy('created_at')->get();
        return view('livewire.admin.onlineapprove',['applicants'=>$applicants])
        ->layout('layouts.admin'); 
    }
}
