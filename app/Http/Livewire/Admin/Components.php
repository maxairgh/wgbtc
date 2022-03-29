<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Component as Comp;

class Components extends Component
{
    public $components, $newcomponent;

    public function mount(){
        $this->getDetails();
    }

    public function AddComponent(){
        $component = Comp::create([
            'name' => $this->newcomponent,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($component){
            //event
          //event(new UserRegisteredEvent($user));
          session()->flash('success', 'Session saved successfully');
          $this->newcomponent = '';
          $this->getDetails();
          return ;
        } 
    }

    public function deleteProgram($id){
        $comp = Comp::find($id);
        if ($comp->delete()){
            session()->flash('success', 'operation successful');
        }else{
            session()->flash('error', 'operation was not successful');
        }
       // $this->resetData();
        $this->getDetails();
     }
     
public function getDetails(){
    $this->components = Comp::all();
}

    public function render()
    {
        return view('livewire.admin.components');
    }
}
