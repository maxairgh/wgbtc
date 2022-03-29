<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\News;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Annoucements extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $viewMode = true, $caption, $details, $status, $label = 'SAVE NEWS',$isUpdate = false;
    public $deleteID, $editID;
    public function saveNews(){
        // $this->emit('setDetailsDateEvent');
       
        $this->validate([
            'caption' => ['required'],  
            'details' => ['required'],  
            'status' => ['required'],    
        ]);
 
        if ($this->isUpdate){
            //update 
            $news = News::where('id',$this->editID)->udpate([
                'title' => $this->caption,
                'annoucement' => $this->details,
                'status' => $this->status,
              //  'user_id' => Auth::user()->id, 
               // 'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    
            if ($news){
                $this->alert('success', 'Annoucement update successfully',[
                    'position' => 'center'
                ]);
                session()->flash('success', 'Annoucement update successfully');
                $this->resetData();
                return ;
            }
            session()->flash('error', 'Annoucement saved successfully');
          
        }else{
            //save
            $news = News::create([
                'title' => $this->caption,
                'annoucement' => $this->details,
                'status' => $this->status,
                'user_id' => Auth::user()->id, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    
            if ($news){
                $this->alert('success', 'Annoucement saved successfully',[
                    'position' => 'center'
                ]);
                session()->flash('success', 'Annoucement saved successfully');
                $this->resetData();
                return ;
            }
            session()->flash('error', 'Annoucement saved successfully');
          
        }
   
    }

    public function switchTab($id){
        if ($id == 1){
            $this->viewMode = true;
        }else{
            $this->viewMode = false;
        }
    }

    public function init(){
        $this->news = News::orderBy('created_at','DESC')->paginate(4); 
    }

    public function resetData(){
        $this->emit('resetEmittedData');
        $this->caption = '';
        $this->status = ''; 
        $this->deleteID = '';
        $this->editID = '';  
        $this->label = 'SAVE NEWS';
    }

    public function deleteNews($id){
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
   
        if (!$this->deleteID){
            $this->alert('warning', 'Kindly select one.',[
                'position' => 'center'
            ]);
            return;
        }

        if (News::where('id',$this->deleteID)->delete()){
            $this->alert('success', 'Annoucement deleted successfully.',[
                'position' => 'center'
            ]);
            return;
        }

        $this->alert('warning', 'Annoucement could not be deleted.',[
            'position' => 'center'
        ]);
    }

    public function EditNow(){

        if (!$this->editID){
            $this->alert('warning', 'Kindly select one.',[
                'position' => 'center'
            ]);
            return;
        }

        //get data
        $news = News::where('id',$this->editID)->first();
        $isUpdate = true;
        $this->label = "UPDATE NEWS";
        $this->caption = $news->title;
        $details = $news->annoucement;
        $this->status = $news->status;
        $this->viewMode = false;
        $this->emit('setDetailsDataEvent', $details);

    }

    public function editNews($id){
   $this->editID = $id;
        $this->alert('question', 'Are you sure you want to edit annoucement ?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Edit', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'EditNow',
        ]);
    }

    protected $listeners = [
        'DeleteNow',
        'EditNow'
    ];
   
    public function render()
    {
        $data = News::orderBy('created_at','DESC')->paginate(15); 
        return view('livewire.admin.annoucements',['news'=>$data]) 
        ->layout('layouts.admin'); 
    }
}
