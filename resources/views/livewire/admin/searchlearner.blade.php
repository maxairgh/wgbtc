<div>      
@section('title','Search')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Search Learner</h5>
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

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-4">
            <div class="form-floating mb-3">
            <input type="email" class="form-control" wire:model.lazy="indexnumber" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Index Number</label>
            </div>
        </div>
        <div class="col-4">
                <div class="form-floating">
                <select class="form-select" wire:model.defer="programid" id="floatingSelect" aria-label="Floating label select example">
                <option value="">Search Program</option> 
                @foreach($programs as $program)
            <option value="{{ $program->id }}">{{ $program->title }}</option> 
            @endforeach 
                </select>
                <label for="floatingSelect">Program</label>
                </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3">
                 <input type="email" class="form-control" wire:model.lazy="surname" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Surname</label>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" wire:click="findLearner" class="btn btn-primary btn-sm">Search Learner</button>
        </div>
    </div>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-12">
 
    <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Index No.</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Program</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($foundRecords as $found)
    <tr>
      <th scope="row">{{ $found->matrix }}</th>
      <td>{{ $found->lastname }} {{ $found->firstname }} </td>   
      <td>{{ $found->gender }}</td>
      <td>{{ $found->email  }}</td>
      <td>{{ $found->mobile  }}</td>
      <td>{{  $found->status }}</td>
      <td>
  
      @foreach($found->programs as $program)  
      <span class="badge {{ ($program->enddate) ? 'bg-warning' : 'bg-success'}}">{{ $program->program->title }}</span><br>
      @endforeach
       </td>
      <td>
                <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
					<a href="#"   class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> View</a>
					<a href="{{ route('editlearner',$found->id ) }}"   class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</a>
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


@section('scripts')
<script>
$(document).ready(function() {


});
</script>
@endsection
</div>

