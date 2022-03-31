<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Session extends Component
{
    public function render()
    {
        return view('livewire.admin.session')
        ->layout('layouts.admin'); 
    }
}
