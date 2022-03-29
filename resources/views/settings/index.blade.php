@extends('layouts.pnis')

@section('title','Dashboard')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>Settings</h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<div class="card">
<div class="card-body">

	<form method="POST" action="{{ route('settings.store') }}" > 
@csrf()
	<div class="row">
		<div class="col-md-4">
			<livewire:admin.components />
	    </div>
		<div class="col-md-4">sss</div>
		<div class="col-md-4">ss</div>
	</div>
	</form>
</div>
</div>
 
@endsection

@section('scripts')
<script>

</script>
@endsection
          