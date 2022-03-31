<div>      
@section('title','Sessions')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Session</h5>
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

<div class="row">
    <div class="col-md-8">
        <div class="card">
          <div class="card-body">
           
    <div class="table-responsive">
  <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Academic Year</th>
      <th scope="col">Status</th>
      <th scope="col">Term Details</th> 
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($academicyears as $academic)
    <tr>
      <th scope="row">{{ $academic->id }}</th>
      <td>{{ $academic->name }}</td>   
      <td> <span class="badge {{ (strcmp($academic->status,'Active')==0) ? 'bg-success' : 'bg-secondary'}}">{{ $academic->status }}</span></td>
       <td>
          
      @foreach($academic->terms as $term)  
      <div class="btn-group btn-group-sm mb-2" role="group" aria-label="Button group with nested dropdown">
  <button type="button" class="btn btn-primary">Name: {{ $term->name }}</button>
  <button type="button" class="btn btn-primary">Status: {{ $term->status }}</button>

  <div class="btn-group btn-group-sm" role="group">
    <button id="btnGroupDrop{{ $term->id }}" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Action
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $term->id }}">
      <li wire:click="viewTermDetails({{ $term->id }})" ><a class="dropdown-item" href="#">View</a></li>
      <li wire:click="editTerm({{ $term->id }})" ><a class="dropdown-item" href="#">Edit</a></li>
      <li wire:click="deleteTerm({{ $term->id }})"><a class="dropdown-item" href="#">Delete</a></li>
    </ul>
  </div>
</div>
      @endforeach
       </td>
      <td>
          <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
				    	<button wire:click="editAcademicYear({{ $academic->id }})" class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</a>
				    	<button wire:click="deleteAcademicYear({{ $academic->id }})" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle me-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg> Delete</a>
				  </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
    </div>

          </div>
        </div>
    </div>
    <div class="col-md-4">
      <div class="card">
          <div class="card-body">
            <h5 class="text-info">New Academic Year</h5>
              <hr class="text-info">
              <div>
                  <div class="form-floating  mb-2">
                  <input type="email" class="form-control" wire:model.lazy="academicyearname" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Name</label>
                  </div>
                  <div class="form-floating  mb-2">
                  <select class="form-select" wire:model.defer="academicyearstatus" id="floatingSelect" aria-label="Floating label select example">
                  <option value="">Select Status</option> 
                  <option value="Active">Active</option> 
                  <option value="Completed">Completed</option> 
                 </select>
                <label for="floatingSelect">Status</label>
                </div>
                <div class="text-center">
            <button type="button" wire:click="saveAcademicYear" class="btn btn-primary btn-sm">{{ $academicyearLabel }}</button>
        </div>
              </div>
            <h5 class="text-info mt-3">New Term/Semester</h5>
            <hr class="text-info">
            <div>
            <div class="form-floating  mb-2">
                  <select class="form-select" wire:model.defer="TermAcademicId" id="floatingSelect" aria-label="Floating label select example">
                  <option value="">Search Academic Year</option> 
                  @foreach($ayselection as $selection)
                  <option value="{{ $selection->id }}">{{ $selection->name }}</option> 
                  @endforeach
                 </select>
                <label for="floatingSelect">Academic Year</label>
                @error('TermAcademicId') <span class="text-danger">{{ $message }}</span> @enderror 
                </div> 

                  <div class="form-floating  mb-2">
                  <select class="form-select" wire:model.defer="termname" id="floatingSelect" aria-label="Floating label select example">
                    <option value="">Select Term/Semester</option> 
                    <option value="1st Term">1st Term</option> 
                    <option value="2nd Term">2nd Term</option> 
                    <option value="3rd Term">3rd Term</option> 
                    <option value="1st Semester">1st Semester</option> 
                    <option value="2nd Semester">2nd Semester</option> 
                  </select>
                  <label for="floatingSelect">Status</label>
                </div>

                  <div class="form-floating  mb-2">
                  <select class="form-select" wire:model.defer="termstatus" id="floatingSelect" aria-label="Floating label select example">
                    <option value="">Select Status</option> 
                    <option value="Active">Active</option> 
                    <option value="Pending">Pending</option> 
                    <option value="Completed">Completed</option> 
                  </select>
                  <label for="floatingSelect">Status</label>
                </div>

                <div class="form-floating  mb-2">
                  <input type="date" class="form-control" wire:model.lazy="startdate" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Start Date</label>
                   @error('startdate') <span class="text-danger">{{ $message }}</span> @enderror 
                  </div> 

                  <div class="form-floating  mb-2">
                  <input type="date" class="form-control" wire:model.lazy="enddate" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">End Date</label>
                   @error('enddate') <span class="text-danger">{{ $message }}</span> @enderror 
                  </div>

                  <div class="text-center">
                    <button type="button" wire:click="saveTerm" class="btn btn-primary btn-sm">{{ $termLabel }}</button>
                  </div>

            </div>
          </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {


});
</script>
@endsection
</div>

