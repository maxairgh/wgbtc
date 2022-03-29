<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Program as Programs;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Program extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $programid, $code, $title, $creditValue, $status, $isUpdate = false, $label="SAVE",$deleteID =""; 
    
    public function SaveProgram(){
 
        $this->validate([
            //'programid' => ['string'],  
            'code' => ['required','string'],  
            'title' => ['required','string'],   
            'status' => ['required'],   
        ]);
    
try {
    //code...

        if ($this->isUpdate){
           //update
           $program = Programs::find($this->programid);
           $done = $program->update([
            'code' => $this->code,
            'title' => $this->title,
            'status' => $this->status,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($program){
            //event
          //event(new UserRegisteredEvent($user));
          session()->flash('success', 'Program updated successfully');
          $this->alert('success', 'Program updated successfully',[
            'position' => 'center'
        ]);
          $this->resetData(); 
          return ;
        }

        }else{
            //save
            $program = Programs::create([
                'code' => $this->code,
                'title' => $this->title,
                'status' => $this->status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
 
            if ($program){
                //event
              //event(new UserRegisteredEvent($user));
              session()->flash('success', 'Program saved successfully');
              $this->alert('success', 'Program saved successfully',[
                'position' => 'center'
            ]);
              $this->resetData(); 
              return ;
            }
        }
    } catch (\Throwable $th) {
        
        session()->flash('error', 'An error occured while trying to save data');
    }
    session()->flash('error', 'An error occured while trying to save data');
    $this->alert('warning', 'An error occured while trying to save data',[
        'position' => 'center'
    ]);
}
    
    public function resetData(){
         $this->programid ="";
         $this->code =""; 
         $this->title ="";
         $this->creditValue =""; 
         $this->status =""; 
         $this->isUpdate = false; 
         $this->label = "SAVE"; 
         $this->deleteID = "";
    }
    
    public function changeStatus($id){
        try {
            //code...
        $program = Programs::find($id);
        if ($program->status == 1){
            $done = $program->update([
                'status' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }else{
            $done = $program->update([
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        $this->resetData(); 
        $this->alert('success', 'operation successful',[
            'position' => 'center'
        ]);
        session()->flash('success', 'operation successful');
    } catch (\Throwable $th) {
        session()->flash('error', 'An error occured in operation');
    }
    }

    
    public function deleteProgramConfrim($id){
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

    public function DeleteNow(){
        $program = Programs::find($this->deleteID);
        if ($program->delete()){
            $this->alert('warning', 'operation successful',[
                'position' => 'center'
            ]);
            session()->flash('success', 'operation successful');
        }else{
            session()->flash('error', 'operation was not successful');
        }
        $this->resetData(); 
    }


    public function EditDetails($id){
        $program = Programs::find($id);
        if($program){
            $this->programid = $program->id;
            $this->code = $program->code;
            $this->title = $program->title;
            $this->creditValue = $program->credit_value;
            $this->status = $program->status;
            $this->isUpdate = true; 
            $this->label="UPDATE"; 
        }
    }

    protected $listeners = [
        'DeleteNow',
        'EditNow'
    ];

      public function render()
    {
        $programs = Programs::paginate(15);
        return view('livewire.admin.program',['programs'=>$programs])
        ->layout('layouts.admin'); 
    }
}
