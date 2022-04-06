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

<div class="row">
    @foreach($news as $item)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-info">{{ $item->title }}</h5>
                <div><span class="float-end text-mute">{{ date("jS F, Y", strtotime($item->created_at)) }}</span></div>
                <hr class="text-info">
                {!! $item->annoucement !!}
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <hr class="text-success">
               {{ $news->links() }}
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
 

