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
             <svg xmlns="http://www.w3.org/2000/svg" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="View video" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video align-middle me-2"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>| 
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="viewContentDetails({{ $content->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="View content" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>| 
             <svg xmlns="http://www.w3.org/2000/svg" wire:click="editContentDetails({{ $content->id }})"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>|
             <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Bookmark to Term" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark align-middle me-2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>|
             <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu align-middle me-2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
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
            <h6 class="text-success ">
                New Course Content
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Add +</button>
            </h6>
            <hr class="text-success">

            <!-- Button trigger modal -->
            <div class="row mb-3">
          <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" wire:model="Nchapter" class="form-control form-control-sm" id="floatingInput">
                    <label for="floatingInput">Chapter</label>
                    @error('Nchapter') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
          </div>
          <div class="col-md-6">
                <div class="form-floating">
                        <input type="text"  wire:model="Ntitle"  class="form-control form-control-sm" id="floatingInput">
                        <label for="floatingInput">Title</label>
                        @error('Ntitle') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
          </div>
      </div>

           <div class="form-floating mb-3">
                <input type="file" wire:model="Nfile" class="form-control form-control-sm" id="floatingInput">
                <label for="floatingInput">Video File</label>
                @error('Nfile') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>

            <div class="row">
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
            <div class="form-floating mb-3">
                <input type="number" wire:model="Norder" class="form-control form-control-sm" id="floatingInput">
                <label for="floatingInput">Order ID</label>
                @error('Norder') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>
            </div>
            </div>

            <div class="form-floating" wire:ignore>
                <textarea class="form-control"  id="newsnote"></textarea>
                <label for="floatingTextarea">Comments</label>
                @error('Ndetails') <span class="text-danger">{{ $message }}</span> @enderror 
            </div>

            <div class="text-center mt-2">
            <button wire:click="saveContent" type="button" class="btn btn-success" >SAVE</button>
            </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Couse Content Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
     

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
	editor = CKEDITOR.replace( 'newsnote' );
 
    Livewire.on('setDetailsDataEvent',details=>{
        CKEDITOR.instances.newsnote.setData(details);
        @this.set('Ndetails',details);
    });

    Livewire.on('resetEmittedData',()=>{
        CKEDITOR.instances.newsnote.setData('');
        @this.set('Ndetails','');  
    });

        // when a change occuress in the edit set it to variable.
    editor.on( 'change', function( evt ) {
        // getData() returns CKEditor's HTML content.
        @this.set('Ndetails',evt.editor.getData() );
    });

});
</script>
@endsection
</div>
 

