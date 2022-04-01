<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Events\UserRegisteredEvent;
use App\Events\PasswordResetEvent;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userid, $firstname, $lastname, $mobile, $email, $usertype, $userstatus, $entryType = 1, $entryLabel = "SAVE";
    //public $getusers,$availableusers;

    public function mount(){
       
    }

    public function getUserDetails($id){
        $user = User::find($id);
        $this->userid = $user->id; 
        $this->entryType = 2; //1 for new and 2 for update.
        $this->firstname = $user->firstname; 
        $this->lastname= $user->lastname; 
        $this->mobile= $user->mobile; 
        $this->email= $user->email; 
        $this->usertype= $user->type; 
        $this->userstatus = $user->status; 
        $this->entryLabel = "UPDATE";
    }

    //reset user form details
    public function resetDatails(){
        $this->userid = "";
        $this->entryType = 1; //1 for new and 2 for update.
        $this->firstname = ""; 
        $this->lastname = ""; 
        $this->mobile = ""; 
        $this->email = ""; 
        $this->usertype = ""; 
        $this->userstatus = ""; 
        $this->entryLabel = "SAVE";
    }
  
//save or update user
    public function SaveUserDetails(){
       
        $this->validate([
            'firstname' => ['required','string'],  
            'lastname' => ['required','string'],  
            'mobile' => ['required','integer'],  
            'email' => ['required','email'],  
            'usertype' => ['required','string'],  
            'userstatus' => ['required','string'],  
        ]);

     try{
         $newpassword = 'bslemas'.Date('Y');

         if ($this->entryType == 1){
            $user = User::create([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'mobile' => $this->mobile,
                'type' => $this->usertype,
                'status' => $this->userstatus,
                'email' => $this->email,
                'password' => Hash::make($newpassword),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($user){
                //event
              event(new UserRegisteredEvent($user));
              session()->flash('success', 'User registered successfully');
              return ;
            }

         }else{
             
            $user = User::find($this->userid);
            $user->update([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'mobile' => $this->mobile,
                'type' => $this->usertype,
                'status' => $this->userstatus,
                'email' => $this->email,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($user){
                $this->resetDatails();
              session()->flash('success', 'User updated successfully');
              return ;
            }
         }

        }catch(\Exception $e){
            session()->flash('error', 'User registration fail, already registered.');  
        }

    }

public function changeStatus($id){

try{
    $user = User::find($id);
    if (strcmp($user->status,'Active')==0){
     $done = $user->update([
            'status' => "Inactive", 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }else{
        $done = $user->update([ 
            'status' => "Active", 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
   

    if ($done){
        $this->resetDatails();
      session()->flash('success', 'User status updated successfully');
      return ;
    }

}catch(\Exception $e){
    session()->flash('error', 'User registration fail, already registered.'.$e);  
}
}

public function ResetPassword($id){
    try{
        ///get user
        $user = User::find($id);
        //get new password
        $newpassword = 'bslemas'.Date('Y');
        //check if user is active
        if (strcmp($user->status,'Active')==0){
            //update user details
         $done = $user->update([
                'password' => Hash::make($newpassword),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }else{
            session()->flash('success', 'Inactive users password cannot be reset.');
          return ;
        }
       
    
        if ($done){
              //event
           event(new PasswordResetEvent($user));
          session()->flash('success', 'User password reset successfully via email.');
          return ;
        }
    
    }catch(\Exception $e){
        session()->flash('error', 'User registration fail, already registered.'.$e);  
    }
}

public function deleteUser($id){
 ///get user
    $user = User::find($id);
//delete user
/*
  $done = $user->delete();
    if ($done){
        session()->flash('success', 'User Deleted successfully.');
        return ;
    }

    session()->flash('success', 'User could not be deleted.');
    return ;
*/
}

    public function render()
    {
        return view('livewire.user-management',[
            'availableusers' => User::paginate(15),
        ])->layout('layouts.admin'); 
    }
}
