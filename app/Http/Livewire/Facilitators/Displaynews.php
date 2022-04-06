<?php

namespace App\Http\Livewire\Facilitators;

use Livewire\Component;
use App\Models\News;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Displaynews extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $news = News::where('status',1)->orderBy('created_at','DESC')->paginate(10);
        return view('livewire.facilitators.displaynews',['news'=>$news])
        ->layout('layouts.facilitator'); 
    }
}
