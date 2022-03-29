<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashbaord extends Component
{
    public function render()
    {
        return view('livewire.admin.dashbaord')
        ->extends('layouts.admin');
       // return view('livewire.admin.dashbaord')
      //  ->extends('layouts.admin');
    }
}
