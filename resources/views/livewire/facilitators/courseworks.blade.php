<div>      
@section('title','Assignments')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Courses Assignments</h5>
	</div>
    <div class="col-md-6 text-center">
            
	</div>
</div>
</div>
</div>
@endsection

<div class="row">
<div class="col-md-12">
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="alert-message">
    <strong>Hello there! </strong> {{ session('success') }} 
  </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="alert-message">
    <strong>Hello there! {{ session('error') }}</strong>  
  </div>
</div>
@endif
</div>
</div>

<!--courses section-->
<div class="row {{ ($selectMode) ? '' : 'd-none'}}">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h6 class="text-info"> Assigned Courses </h6>
            <hr class="text-info" />

<!--courses-->
<div class="row">
   
@foreach($courses as $course)
     <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center ">
            <p class="text-info"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle me-2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></p>
            <h6 class="text-info">{{ $course['title'] }}</h6>
            <p>Learners <span class="badge rounded-pill bg-info">+{{ $course['number'] }}</span></p>
            <button wire:click="manageContent({{ $course['id'] }})" class="btn btn-warning btn-sm">Manage</button>
            </div>
        </div>
    </div>
@endforeach
</div>
<!--courses-->
  
            </div>
        </div>
    </div>
</div>
<!--courses section-->

<div class="row {{ ($selectMode) ? 'd-none' : ''}}">
<div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h4 class="text-success"> {{ $selectedCourse->code ?? '' }} - {{ $selectedCourse->title ?? '' }} 
            <button type="button" wire:click="backToCourses" class="btn btn-primary btn-sm float-end" >Back <<</button>
            </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
		<div class="card">
            <div class="card-body">
            <h6 class="text-success ">
                Assignments
            </h6>
            <hr class="text-success">

            <ol class="list-group list-group-numbered">
         @foreach($courseWorks as $content)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold">{{ $content->type->code }} {{ $content->type->name }}</div>
            {{ $content->title }} 
			 <div class="text-success">
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="viewContentDetails({{ $content->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="View content" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>| 
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="editContentDetails({{ $content->id }})"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>|
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="DeleteWork({{ $content->id }})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle me-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg> |
             
            </div>
            </div>
           
            <span class="badge bg-primary rounded-pill">14</span>
        </li>
            @endforeach
            </ol>

            </div>
              
            </div>
    </div>
    <div class="col-md-8">
            <div class="card">
            <div class="card-body">
           
            <div class="form-floating mb-3">
            <select class="form-select" wire:model="exercisetype" id="floatingSelect" aria-label="Floating label select example">
                <option value="">Excercise Type</option>
                @foreach($coursetypes as $type)
                <option value="{{ $type->id }}">{{ $type->code }} - {{ $type->name }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Assessment Type</label>
            @error('exercisetype') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>

            <div class="form-floating mb-3" wire:ignore>
                <textarea class="form-control"  id="newsnote"></textarea>
                <label for="floatingTextarea">Questions</label>
            </div>
            @error('content') <span class="text-danger">{{ $message }}</span> @enderror 

            <div class="form-floating mb-3">
            <select class="form-select" wire:model="quiz" id="floatingSelect" aria-label="Floating label select example">
                <option value="1">No</option>
                <option value="2">Yes</option>
             </select>
            <label for="floatingSelect">Quiz</label>
            @error('quiz') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                <div class="form-floating">
                        <input type="file"  wire:model="attachment"  class="form-control form-control-sm" id="floatingInput">
                        <label for="floatingInput">Attachment</label>
                        @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating">
                        <input type="date"  wire:model="duedate"  class="form-control form-control-sm" id="floatingInput">
                        <label for="floatingInput">Due Date</label>
                        @error('duedate') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
                </div>
            </div>

            <div class="text-center">
            <button type="button" wire:click="savecourseWork" class="btn btn-primary btn-sm bt-2" >{{ $label }}</button>
            <button type="button" wire:click="resetForm" class="btn btn-primary btn-sm bt-2" >Reset</button>
            </div>

            </div>
            </div>
    </div>
</div>


<div class="modal fade" id="displayContentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="displayContentModalLabel">{{ $Vexercisetype }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <div>
      {!! $Vcontent !!}
      </div>

      <div>
      <hr class="text-success"> 
      @if($Vattachment)
      <a href="#"><span wire:click="downloadFile" class="badge bg-primary">Attached file for download</span></a>
      @endif
      <span wire:click="" class="badge bg-secondary float-end">Due Date: {{ date('j M Y H:i:s',strtotime($Vduedate)) }}</span>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<script>
   
$(document).ready(function() {

  let editor = CKEDITOR.replace( 'newsnote' );
            // when a change occuress in the edit set it to variable.
            editor.on( 'change', function( evt ) {
        // getData() returns CKEditor's HTML content.
        @this.set('content',evt.editor.getData() );
    });

    Livewire.on('setDetailsDataEvent',content=>{
        CKEDITOR.instances.newsnote.setData(content);
        @this.set('content',content);
    });

    Livewire.on('resetEmittedData',()=>{
        CKEDITOR.instances.newsnote.setData('');
        @this.set('content','');  
    });


    Livewire.on('showModalEvent',()=>{
        $('#displayContentModal').modal('show');
    });

    Livewire.on('hideModalEvent',()=>{
        $('#displayContentModal').modal('hide');
    });

  
});
</script>
@endsection
</div>
 


