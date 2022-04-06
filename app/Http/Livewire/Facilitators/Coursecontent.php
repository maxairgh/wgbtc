<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;

class Coursecontent extends Component
{
    public function render()
    {
        return view('livewire.facilitators.coursecontent')
        ->layout('layouts.facilitator'); 
    }
}
