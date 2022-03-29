@extends('layouts.pnis')

@section('title','Learners')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>Learner Registration </h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<livewire:admin.learners />
@endsection

@section('scripts')
<script>
$(document).ready(function() {

  
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
 

});
</script>
@endsection
          