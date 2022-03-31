<div>      
@section('title','Annoucements')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Annoucement</h5>
	</div>
    <div class="col-md-6 text-center">
            <div class="btn-group btn-group-md" role="group" aria-label="Small button group">
			 <button type="button" class="btn btn-info btn-md" wire:click="SwitchTab('1')"> View News</button>
			 <button type="button" class="btn btn-success btn-md" wire:click="SwitchTab('2')"> Add New Annoucement</button>
		   </div>
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

@section('scripts')
<script>
$(document).ready(function() {


});
</script>
@endsection
</div>

do the checks  from the route 
