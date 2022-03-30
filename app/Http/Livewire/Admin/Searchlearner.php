<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Program; 
use App\Models\Learner;
use App\Models\LearnerProgram; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Searchlearner extends Component
{
    use LivewireAlert;

    public $foundRecords=[],$surname;
    public $sessionid, $programid, $indexnumber;

    public function findLearner(){
        
        $this->foundRecords = [];
        if ($this->indexnumber){
         
            $this->foundRecords = Learner::where('matrix',$this->indexnumber)->get();
           
            if(count($this->foundRecords) > 0){
                session()->flash('success', 'Record found for the search.');  
                $this->alert('success', 'Record found for the search',[
                    'position' => 'center'
                ]);
                return;   
            }
           
            session()->flash('error', 'No records found for the search.');
            $this->alert('error', 'No records found for the search.',[
                'position' => 'center'
            ]);
            return; 
            
        }
 
        if ($this->programid) {

            $ids = LearnerProgram::where('program_id',$this->programid)->pluck('learner_id');
            if ($ids){
                $this->foundRecords = Learner::whereIn('id',$ids)->where('status','Active')->get();
                if(count($this->foundRecords) > 0){
                    session()->flash('success', 'Record found for the search.');
                    $this->alert('success', 'Record found for the search.',[
                        'position' => 'center'
                    ]);
                    return;  
                }else{
                    session()->flash('error', 'No records found for the search.');
                    $this->alert('error', 'No records found for the search.',[
                        'position' => 'center'
                    ]);
                    return;
                }
            }
            
        }

        if ($this->surname) {
 
                $this->foundRecords = Learner::where('firstname','like', '%'.$this->surname.'%')->get();
                if(count($this->foundRecords) > 0){
                    session()->flash('success', 'Record found for the search.');
                    $this->alert('success', 'Record found for the search.',[
                        'position' => 'center'
                    ]);
                    return;  
                }
                session()->flash('error', 'No records found for the search.');
                $this->alert('error', 'No records found for the search.',[
                    'position' => 'center'
                ]);
                return; 
        }
 
      //  return; 
    }

    public function render()
    {
        $programs = Program::where('status',2)->get(); 
        return view('livewire.admin.searchlearner',['programs'=>$programs])
        ->layout('layouts.admin'); 
    }
}
