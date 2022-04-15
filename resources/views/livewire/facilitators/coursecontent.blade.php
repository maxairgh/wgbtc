<div>      
@section('title','Materials')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Courses Materials</h5>
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
            <h6 class="text-primary"> Assigned Courses </h6>
            <hr class="text-primary" />

<!--courses-->
<div class="row">
@foreach($courses as $course)
     <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center ">
            <p class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle me-2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></p>
            <h6 class="text-primary">{{ $course['title'] }}</h6>
            <p>Learners <span class="badge rounded-pill bg-primary">+{{ $course['number'] }}</span></p>
            <button wire:click="manageContent({{ $course['id'] }})" class="btn btn-primary btn-sm">Manage</button>
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
            <h4 class="text-success"> {{ $selectCourse->code ?? '' }} - {{ $selectCourse->title ?? '' }} 
            <button type="button" wire:click="backToCourses" class="btn btn-primary btn-sm float-end" >Back <<</button>
            </h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
            <h6 class="text-success ">
                Contents
            </h6>
            <hr class="text-success">

            <ol class="list-group list-group-numbered">
         @foreach($courseContents as $content)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold">{{ $content->chapter }}</div>
            {{ $content->title }} 
			 <div class="text-success">
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="viewContentDetails({{ $content->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="View content" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>| 
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="editContentDetails({{ $content->id }})"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>|
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="deleteMaterial({{ $content->id }})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle me-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg> |
             @if ($content->publishedForActiveTerm($activeTerm->id))
             @php 
             $publish = $content->publishedForActiveTerm($activeTerm->id)
             @endphp
             <svg xmlns="http://www.w3.org/2000/svg"  wire:click="unPublishContent({{ $publish->id }})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle me-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
             @endif
             @if (!$content->publishedForActiveTerm($activeTerm->id))
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="publishContentForActiveTerm({{ $content->id }})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell-off align-middle me-2"><path d="M13.73 21a2 2 0 0 1-3.46 0"></path><path d="M18.63 13A17.89 17.89 0 0 1 18 8"></path><path d="M6.26 6.26A5.86 5.86 0 0 0 6 8c0 7-3 9-3 9h14"></path><path d="M18 8a6 6 0 0 0-9.33-5"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
             @endif
            </div>
            </div>
           
            <span class="badge bg-primary rounded-pill">14</span>
        </li>
            @endforeach
            </ol>

            <div>
              
            </div>
         </div>
        </div>
    </div>
    <div class="col-md-8">
    <div class="card">
            <div class="card-body">
            <h6 class="text-success ">
                New Course Content
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Add +</button>
            </h6>
            <hr class="text-success">

            <!-- Button trigger modal -->
            <div class="row mb-3">
          <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" wire:model="Nchapter" class="form-control form-control-sm" id="floatingInput">
                    <label for="floatingInput">Chapter</label>
                    @error('Nchapter') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
          </div>
          <div class="col-md-4">
                <div class="form-floating">
                        <input type="text"  wire:model="Ntitle"  class="form-control form-control-sm" id="floatingInput">
                        <label for="floatingInput">Title</label>
                        @error('Ntitle') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
          </div>
          <div class="col-md-4">
                <div class="form-floating">
                    <input type="number" wire:model="Norder" class="form-control form-control-sm" id="floatingInput">
                    <label for="floatingInput">Order ID</label>
                    @error('Norder') <span class="text-danger">{{ $message }}</span> @enderror 
                </div> 
          </div>
      </div>

            <div class="row mb-2">
            <div class="col-md-6">
            <div class="form-floating">
            <select class="form-select" wire:model="Nstatus" id="floatingSelect" aria-label="Floating label select example">
                <option value="">Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option> 
            </select>
            <label for="floatingSelect">Status</label>
            @error('Nstatus') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                        <input type="text"  wire:model="Nfile"  class="form-control form-control-sm" id="floatingInput">
                        <label for="floatingInput">Video ID</label>
                        @error('Nfile') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
            </div>
            </div>

            <div class="form-floating" wire:ignore>
                <textarea class="form-control"  id="newsnote"></textarea>
                <label for="floatingTextarea">Comments</label>
                @error('Ndetails') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>

            <div class="text-center mt-2">

            <div wire:loading wire:target="saveContent" class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            <button wire:click="saveContent" type="button" class="btn btn-success" >{{  $label }}</button>
            </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="displayContentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="displayContentModalLabel">{{ $Vchapter }}</h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h6 class="">{{ $Vtitle }}</h6>
@if ($Vfile)
      <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/{{ $Vfile }}?h=a33df2a000&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="simple"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
@endif
         <div style="overflow-x: hidden; overflow-y: auto;">
             {!! $Vdetails !!}
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
        @this.set('Ndetails',evt.editor.getData() );
    });

    Livewire.on('setDetailsDataEvent',details=>{
        CKEDITOR.instances.newsnote.setData(details);
        @this.set('Ndetails',details);
    });

    Livewire.on('resetEmittedData',()=>{
        CKEDITOR.instances.newsnote.setData('');
        @this.set('Ndetails','');  
    });


    Livewire.on('showModalEvent',()=>{
        $('#displayContentModal').modal('show');
    });

  
});
</script>
@endsection
</div>
 

