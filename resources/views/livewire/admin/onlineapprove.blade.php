<div>      
@section('title','Approval')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Online Registration Approval</h5>
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
    <div class="col-md-12">
        <h6>Applicant Details</h6>
        <hr class="text-primary">
    </div>
    <div class="col-md-12">
    <div class="table-responsive">         
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Age</th>
      <th scope="col">Marital Status</th>
      <th scope="col">Mobile</th>
      <th scope="col">Email</th>
      <th scope="col">Denomination</th>
      <th scope="col">Position</th>
      <th scope="col">Program</th>
      <th scope="col">Registered Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
@foreach($applicants as $applicant)
    <tr>
      <th scope="row">{{ $applicant->id }}</th>
      <td>{{ $applicant->firstname }} {{ $applicant->lastname }}</td>
      <td>{{ $applicant->gender }}</td>
      <td>{{ $applicant->getAge() }}yr(s)</td>
      <td>{{ $applicant->marital_status }}</td>
      <td>{{ $applicant->mobile }}</td>
      <td>{{ $applicant->email }}</td>
      <td>{{ $applicant->denomination }}</td>
      <td>{{ $applicant->position }}</td>
      <td>{{ $applicant->program->title }}</td>
      <td>{{  date( "jS M, Y H:i:s a", strtotime($applicant->created_at)) }}</td>
      <td>
      <div class="form-floating">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" wire:click="approveRegistration({{$applicant->id}})" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up align-middle me-2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg></button>
            <button type="button"  wire:click="disapproveRegistration({{$applicant->id}})"  class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down align-middle me-2"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"></path></svg></button>
            <button type="button" wire:click="deleteRecords({{$applicant->id}})"  class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
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
</div>


@section('scripts')
<script>
$(document).ready(function() {


});
</script>
@endsection
</div>



