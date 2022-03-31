<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Academicyear; 
use App\Models\Term;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Session extends Component
{
    use LivewireAlert, WithPagination;

    public $deleteAYID, $selectedAYId, $academicyearname, $academicyearstatus, $isUpdate = false, $academicyearLabel = "Save Academic Year",$sl;
    public $deleteTID, $TermAcademicId,$termLabel = "Save Term", $enddate, $startdate, $termstatus, $termname, $TermId, $isTermUpdate = false;
 
    public function saveAcademicYear(){

        $this->validate([
            'academicyearstatus' => ['required'],  
            'academicyearname' => ['required'],   
        ]);

        if ($this->isUpdate){
            //update
            try {
                //code...
            $done = Academicyear::where('id',$this->selectedAYId)->update([
            'status' => $this->academicyearstatus,
            'name' => $this->academicyearname,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($done){
            session()->flash('success', 'Academic year updated successfully');
            $this->alert('success', 'Academic year updated successfully',[
            'position' => 'center'
           ]);
           $this->resetAcadmicYear();
        }
            } catch (\Throwable $th) {
                //throw $th;
                $this->alert('warning', 'An error occured!',[
                    'position' => 'center'
                ]);
            }
       
        }else{
            //save
            try {
                //code...

            //checks
            if (strcmp('Active',$this->academicyearstatus)==0){
                $exit_ay = Academicyear::where('status',$this->academicyearstatus)->first();
                if ($exit_ay){
                    $this->alert('warning', 'An Active Academic Year already exist',[
                        'position' => 'center'
                    ]); 
                    return;
                }
            }
            
            $done = Academicyear::create([
            'status' => $this->academicyearstatus,
            'name' => $this->academicyearname,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

            if ($done){
                session()->flash('success', 'Academic year added successfully');
                $this->alert('success', 'Academic year added successfully',[
                'position' => 'center'
            ]);
            $this->resetAcadmicYear();
            }
            } catch (\Throwable $th) {
                //throw $th;
                   $this->alert('warning', 'An error occured!',[
                'position' => 'center'
            ]);
            }
        
        }
    }

    public function resetAcadmicYear(){
        $this->selectedAYId = '';
        $this->academicyearname = ""; 
        $this->academicyearstatus = "";
        $this->isUpdate = false;
        $this->academicyearLabel = "Save Academic Year";
    }

    public function resetTermData(){
        $this->TermAcademicId = '';
        $this->enddate = ""; 
        $this->startdate = "";
        $this->termstatus = "";
        $this->isUpdate = false;
        $this->termLabel = "Save Term";
    }

    public function saveTerm(){

        $this->validate([   
            'TermAcademicId' => ['sometimes'],  
            'enddate' => ['required'],  
            'startdate' => ['required'],   
            'termstatus' => ['required'],   
            'termname' => ['required'],   
        ]);
        
        if ($this->isTermUpdate){
            //update

            
            try {
                //code...
                $done = Term::where('id',$this->TermId)->update([
                   'name' => $this->termname,
                    'start_date' => $this->startdate,
                    'end_date' => $this->enddate,
                    'status' => $this->termstatus, 
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                if ($done){
                    session()->flash('success', 'Term updated successfully');
                    $this->alert('success', 'Term updated successfully',[
                    'position' => 'center'
                   ]);
                   $this->resetTermData();
                }
                    } catch (\Throwable $th) {
             
                //throw $th;
                session()->flash('success', 'Term could not be updated successfully'.$th);
                $this->alert('success', 'Term could not be  updated successfully',[
                'position' => 'center'
               ]);
            }

        }else{
             //save 
             try {
                //code...

            //checks
            if ((strcmp('Active',$this->termstatus)==0) || (strcmp('Pending',$this->termstatus)==0)){
                $exit_term = Term::where('status',$this->termstatus)->first();
                if ($exit_term){
                    $this->alert('warning', 'An Active or Pending term/semester already exist',[
                        'position' => 'center'
                    ]); 
                    session()->flash('success', 'An Active or Pending term/semester already exist');
                    return;
                }
                 
            }
            
            $done = Term::create([
            'academyyear_id' => $this->TermAcademicId,
            'name' => $this->termname,
            'start_date' => $this->startdate,
            'end_date' => $this->enddate,
            'status' => $this->termstatus,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
         ]);

            if ($done){
                session()->flash('success', 'Term added successfully');
                $this->alert('success', 'Term added successfully',[
                'position' => 'center'
            ]);
            $this->resetTermData();
            }
            } catch (\Throwable $th) {
                //throw $th;
                   $this->alert('warning', 'An error occured!',[
                'position' => 'center'
            ]);
            }
        }
    }

    public function deleteAcademicYear($id){
         $this->deleteAYID = $id;
        $this->alert('question', 'Are you sure you want to delete Academic year?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'deleteAcademicYearNow',
        ]);
    }

    public function deleteAcademicYearNow(){
        $academicyear = Academicyear::find($this->deleteAYID);
        if ($academicyear->delete()){
            $this->alert('success', 'Academic Year removed with terms successfully!',[
                'position' => 'center'
            ]);
            session()->flash('success', 'Academic Year removed with terms successfully!');
            return;
        }
         $this->alert('warning', 'An error occured whiles removing academic year',[
                'position' => 'center'
            ]);
            session()->flash('error', 'An error occured whiles removing academic year!') ;
    }

    public function deleteTerm($id){
        $this->deleteTID = $id;
          $this->alert('question', 'Are you sure you want to delete Term?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Delete', 
            'showCancelButton' => true,
            'cancelButtonText' => 'No!',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => 'deleteTermNow',
        ]);
    }
    public function deleteTermNow(){
        $term = Term::find($this->deleteTID);
        if ($term ->delete()){
            $this->alert('success', 'Term deleted successfully!',[
                'position' => 'center'
            ]);
            session()->flash('success', 'Term deleted successfully!');
            return;
        }
         $this->alert('warning', 'An error occured whiles removing Term',[
                'position' => 'center'
            ]);
            session()->flash('error', 'An error occured whiles removing term!');
            return;
    }

    protected $listeners = [
        'deleteTermNow',
        'deleteAcademicYearNow'
    ];

    public function editAcademicYear($id){
        $AY = Academicyear::find($id);
        if ($AY){
            $this->selectedAYId = $AY->id;
            $this->academicyearstatus = $AY->status;
            $this->academicyearname = $AY->name;
            $this->isUpdate = true;
            $this->academicyearLabel = "Update Academic Year";
        }

    }

    public function viewTermDetails($id){
        $term = Term::find($id);
        $message = "<b><u>Term Details</u></b>\n".
                "Academic Year: ". $term->academicyear->name."\n".
                "Status: ". $term->status."\n".
                "Start Date: ". date('j M Y',strtotime($term->start_date))."\n".
                "End Date: ". date('j M Y',strtotime($term->end_date))."\n";
        $this->alert('question', $message, [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Noted', 
            'showCancelButton' => true,
            'cancelButtonText' => 'ok',
            'position' => 'center',
            'timer' => null,
            'onConfirmed' => '',
        ]);
    }

    public function editTerm($id){
        $term = Term::find($id);
        if ($term){
            $this->TermAcademicId = $term->academyyear_id;
            $this->TermId =  $term->id;
            $this->isTermUpdate = true;
            $this->termLabel = "Update Term"; 
            $this->termname = $term->name;
            $this->termstatus = $term->status;
            $this->startdate = date('Y-m-d',strtotime($term->start_date));
            $this->enddate = date('Y-m-d',strtotime($term->end_date)); 
        } 
    }
    
    public function render()
    {
        $academicyears = Academicyear::orderBy('created_at','DESC')->paginate(15);
        $ayselection = Academicyear::where('status','Active')->orderBy('created_at')->get();
        return view('livewire.admin.session',['academicyears'=>$academicyears,'ayselection'=>$ayselection])
        ->layout('layouts.admin'); 
    }
}
