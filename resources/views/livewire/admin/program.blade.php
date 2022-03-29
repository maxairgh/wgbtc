<div>
@section('title','Program')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Programs</h5>
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
    <h6>Program List</h6>
    <hr class="text-primary">
    <div class="table-responsive">
  <table class="table border-primary border-primary table-hove">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Code</th>
      <th scope="col">Title</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($programs as $program)
    <tr>
      <th scope="row">{{ $program->id }}</th>
      <td>{{ $program->code }} </td>   
      <td>{{ $program->title }}</td>
      <td>{{ ($program->status == 1) ? 'Active' : 'Inactive' }}</td>
      <td>
                <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
										<button type="button" wire:click="EditDetails( {{ $program->id }} )" class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</button>
										<button type="button" class="btn btn-primary btn-sm" wire:click="changeStatus( {{ $program->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle me-2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg> Status</button>
							     <button type="button" class="btn btn-danger btn-sm" wire:click="deleteProgramConfrim( {{ $program->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x align-middle me-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> Delete</button>
							 </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<hr class="text-success">
{{ $programs->links() }}   
 
</div>

    </div>
    </div>

  </div>
  <div class="col-md-4">

    <div class="card">
    <div class="card-body">
    <h6>New Program</h6>
    <hr class="text-primary">
    <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" wire:model="programid" placeholder="name@example.com" readonly required>
            <label for="floatingInput">ID</label>
            @error('programid') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" wire:model="code" placeholder="name@example.com" required>
            <label for="floatingInput">Code</label>
            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" wire:model="title" placeholder="name@example.com" required>
            <label for="floatingInput">Title</label>
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
          
          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" required wire:model="status" aria-label="Floating label select example">
            <option value="">Select</option>
            <option value="1">Active</option>
            <option value="2">Inactive</option> 
            </select>
            <label for="floatingSelect">Status</label>
            @error('pstatus') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" wire:click="SaveProgram" class="btn btn-primary btn-sm">{{ $label }}</button>
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
