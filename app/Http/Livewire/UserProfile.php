<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class UserProfile extends Component
{
    use WithFileUploads;

    public $displayPicture, $password, $passwordConfirm, $firstname, $lastname, $mobilenumber;
    public $fname,$lname,$unumber,$ustatus,$urole,$uemail,$uPicture;
    
    public function mount(){
        $this->getDetails();
    }

    public function getDetails(){
        $profile = User::find(Auth::user()->id);
        $this->fname = $profile->firstname;
        $this->lname = $profile->lastname;
        $this->unumber = $profile->mobile;
        $this->ustatus = $profile->status;
        $this->urole = $profile->type;
        $this->uemail = $profile->email;
        $this->uPicture = $profile->picture;
    }

    public function saveDP()
    {
        $destination = storage_path().'/app/public/users/';
        //check if the folder exist if not create.
       if(!File::isDirectory($destination)){
       File::makeDirectory($destination, 0777, true, true);
       }

        $this->validate([
            'displayPicture' => 'image|max:1024', // 1MB Max
        ]);
     
        //file name
       $filename = md5(Auth::user()->email).'.'.$this->displayPicture->extension();
       //update details
       $profile = User::find(Auth::user()->id);
       $done = $profile->update([
        'picture' => $filename,
       ]);

       //save data and notify user
       $this->displayPicture->storeAs('public/users/', $filename);
       session()->flash('success', 'Image uploaded Successfully.');
       $this->getDetails();
    }

    public function ChangePassword(){
         
        $this->validate([
            'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|min:6', // 1MB Max
            'passwordConfirm' => 'required_with:password|same:password|min:6', // 1MB Max
        ]);

         //update details
         $profile = User::find(Auth::user()->id);
         $done = $profile->update([
          'password' => Hash::make($this->password),
         ]);
         //inform the user on success
         if ($done){
             session()->flash('success', 'Password Updated Successfully.');
             Auth::logout();
             return redirect('/');

         }
         //failed
         session()->flash('error', 'Password could not be updated.');
    }

    public function updateDetails(){

        $this->validate([
            'firstname' => 'string', //  
            'lastname' => 'string', //  
            'mobilenumber' => 'numeric', //  
        ]);
         //update details
         $profile = User::find(Auth::user()->id);
         $done = $profile->update([
          'firstname' => $this->firstname,
          'lastname' => $this->lastname,
          'mobile' => $this->mobilenumber,
         ]);
         //inform the user on success
         if ($done){
             session()->flash('success', 'Details Updated Successfully.');
             $this->getDetails();
             return  ;
         }
         //failed
         session()->flash('error', 'Password could not be updated.');
    }

    public function render()
    {
        return view('livewire.user-profile') 
        ->layout('layouts.admin'); 
    }
}
