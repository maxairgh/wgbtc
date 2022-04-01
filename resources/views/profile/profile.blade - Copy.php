@extends('layouts.admin')

@section('title','Profile')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>Profile</h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<livewire:user-profile />
@endsection

@section('scripts')
<script>

</script>
@endsection
          