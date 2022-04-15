<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Assesstype;

class Assesstypes extends Component
{
    public $components = [], $code, $name, $percentage, $status;

    public function mount(){
        $this->getDetails();
    }
    
    public function saveType(){

        $this->validate([
            'code' => ['required'],  
            'name' => ['required'],      
            'percentage' => ['required'],      
        ]);

        $done = Assesstype::create([
            'code' => $this->code,  
            'name' => $this->name, 
            'percentage' => $this->percentage, 
            'status' => 1, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),   
        ]);

        if ($done){
            session()->flash('success', 'Assessment type saved successfully');
            $this->code = '';
            $this->name = '';
            $this->percentage = '';
            $this->getDetails();
            return ;
        }

    }

    public function deleteProgram($id){
        $comp = Assesstype::find($id);
        if ($comp->delete()){
            session()->flash('success', 'operation successful');
        }else{
            session()->flash('error', 'operation was not successful');
        }
       // $this->resetData();
        $this->getDetails();
     }
     
    public function getDetails(){
        $this->components = Assesstype::all();
    }

    public function changeStatus($id){
        $comp = Assesstype::find($id);
        if ($comp->status == 1){
            $comp->update([
                'status' => 0,  
                'updated_at' => date('Y-m-d H:i:s'),  
            ]);
        }else{
            $comp->update([
                'status' => 1, 
                'updated_at' => date('Y-m-d H:i:s'),  
            ]);
        } 
        $this->getDetails();
    }

    public function render()
    {
        return view('livewire.admin.assesstypes');
    }
}
