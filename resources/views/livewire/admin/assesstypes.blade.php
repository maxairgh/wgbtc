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

<h5 class="text-info">Assessment Types</h5>
<hr class="text-info">

<div>
<div class="input-group mb-3">
  <input type="text" wire:model="code" class="form-control" placeholder="Code" aria-label="Username" aria-describedby="basic-addon1">
  <input type="text" wire:model="name" class="form-control" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
  <input type="text" wire:model="percentage" class="form-control" placeholder="%" aria-label="Username" aria-describedby="basic-addon1">
  <span wire:click="saveType" class="input-group-text" id="basic-addon1">+ ADD</span>
</div>
</div>

<div>
 
<div class="table-responsive">
  <table class="table border-primary border-primary table-hove">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Code</th> 
      <th scope="col">Name</th> 
      <th scope="col">Percent</th> 
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($components as $component)
    <tr>
      <th scope="row">{{ $component->id }}</th>
       <td>{!! ($component->status) ? $component->code : "<del>".$component->code."</del>" !!} </td>   
      <td>{!! ($component->status) ? $component->name : "<del>".$component->name."</del>" !!} </td>   
      <td>{!! ($component->status) ? $component->percentage.'%' : "<del>".$component->percentage."%</del>" !!}</td>  
       
      <td>
           <div class="btn-group btn-group-sm mb-4 " role="group" aria-label="Small button group">
           <svg class="text-danger" wire:click="deleteProgram( {{ $component->id }} )" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle me-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>   
           <svg class="text-primary" wire:click="changeStatus( {{ $component->id }} )" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize-2 align-middle me-2"><polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>

</div>

