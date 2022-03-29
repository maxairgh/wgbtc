@extends('layouts.pnis')

@section('title','Profile')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>User Management</h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<livewire:user-management />
@endsection

@section('scripts')
<script>

</script>
@endsection
          