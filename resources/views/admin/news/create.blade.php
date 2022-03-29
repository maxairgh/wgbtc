@extends('layouts.pnis')

@section('title','News')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>Create Announcement </h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-12">
	<form method="POST" action="{{ route('news.store') }}" > 
@csrf()

<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" name="caption" placeholder="name@example.com" required>
  <label for="floatingInput">News Caption</label>
</div>

<div class="mb-3">
<label for="floatingTextarea2">Details</label>  
  <textarea class="form-control"  id="newsnote" name="news" required></textarea>
  
</div>

<div class="form-floating mb-3">
  <select class="form-select" id="floatingSelect" required name="status" aria-label="Floating label select example">
     <option value="1">Active</option>
    <option value="2">Inactive</option> 
  </select>
  <label for="floatingSelect">Status</label>
</div>

<div class="col-md-12 text-center">
<button type="submit" class="btn btn-primary btn-sm">Save</button>
</div>
</form>
	</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
	CKEDITOR.replace( 'newsnote' );
});
</script>
@endsection
          