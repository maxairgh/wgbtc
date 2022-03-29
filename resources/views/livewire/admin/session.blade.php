<div>
   
<div class="row">
<div class="col-12 ">

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


<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-md-8">
    <h6>Session List</h6>
<hr class="text-primary">

<div class="table-responsive">
  <table class="table border-primary border-primary table-hove">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($sessions as $session)
    <tr>
      <th scope="row">{{ $session->id }}</th>
      <td>{{ $session->name }} </td>   
      <td>{{ $session->start_date }}</td>
      <td>{{ $session->end_date }}</td>
      <td>
         @if ($session->status == 1)
         <span class="badge bg-warning rounded-pill">Pending</span>
         @elseif($session->status == 2)
         <span class="badge bg-info rounded-pill">Active</span>
         @else
         <span class="badge bg-success rounded-pill">Completed</span>
         @endif
       </td>
      <td>
                <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
				 <button type="button" wire:click="EditDetails( {{ $session->id }} )" class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</button>
				 <button type="button" class="btn btn-primary btn-sm" wire:click="changeStatus( {{ $session->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle me-2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg> Status</button>
				 <button type="button" class="btn btn-danger btn-sm" wire:click="deleteProgramConfrim( {{ $session->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x align-middle me-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> Delete</button>
				</div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

 
</div>

    </div>
    <div class="col-md-4">
<h6>New Session</h6>
<hr class="text-primary">

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" wire:model="sessionid"  readonly required>
            <label for="floatingInput">ID</label>
            @error('sessionid') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>

          <div class="form-floating mb-3"> 
            <input type="text" class="form-control" id="floatingInput" wire:model="name" required>
            <label for="floatingInput">Name</label>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" wire:model="startdate" required>
            <label for="floatingInput">Start Date</label>
            @error('startdate') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" wire:model="enddate"  required>
            <label for="floatingInput">End Date</label>
            @error('enddate') <span class="text-danger">{{ $message }}</span> @enderror
          </div>

          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" required wire:model="status" aria-label="Floating label select example">
            <option value="">Select</option>
            <option value="1">Pending</option>
            <option value="2">Active</option> 
            <option value="3">Completed</option> 
            </select>
            <label for="floatingSelect">Status</label>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" wire:click="SaveSession" class="btn btn-primary btn-sm">{{ $label }}</button>
        </div>

    </div>
</div>
</div>
</div>

</div>
