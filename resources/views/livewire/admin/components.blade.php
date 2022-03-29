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

<h5 class="text-info">Fee Components</h5>
<hr class="text-info">

<div>
<div class="input-group mb-3">
  <input type="text" wire:model="newcomponent" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
  <span wire:click="AddComponent" class="input-group-text" id="basic-addon1">+ ADD</span>
</div>
</div>

<div>
 
<div class="table-responsive">
  <table class="table border-primary border-primary table-hove">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th> 
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($components as $component)
    <tr>
      <th scope="row">{{ $component->id }}</th>
      <td>{{ $component->name }} </td>   
      <td>
           <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
			<button type="button" class="btn btn-danger btn-sm" wire:click="deleteProgram( {{ $component->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x align-middle me-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> Delete</button>
			</div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

</div>
