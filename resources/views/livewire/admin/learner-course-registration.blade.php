<div>      
@section('title','Course Registration')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Course Registration</h5>
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
                <div class="col-md-4">
                <span class="badge bg-primary">Learner's Name:</span> <strong>{{ $learnerdetails }}</strong>
                </div>
                <div class="col-md-4">
                <span class="badge bg-primary">Program:</span> <strong>{{ $programname }}</strong>
                </div>
                <div class="col-md-4">
                <span class="badge bg-primary">Term:</span> <strong>{{ $term->academicyear->name }} - {{ $term->name }}</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div wire:loading wire:target="getDetails" class="spinner-border text-success" role="status">
                </div>
                    <div class="input-group mt-3">
                    <input class="form-control" type="text"  id="inputGroupSelect03" wire:model="indexNumber" placeholder="Index number" >
                    <button wire:click="getDetails" class="btn btn-outline-secondary" type="button">View</button>
                    </div>
                    @error('indexnumber') <span class="text-danger">{{ $message }}</span> @enderror 
                </div>
            </div>
        </div>
    </div>


<div class="row">
         <div class="col-md-6">
     <div class="card">
            <div class="card-body">
            <h5 class="text-info">Mounted Course</h5>
            <hr class="text-info">
            <div>
				<ul class="list-group">
					@foreach($courses as $course)
					<li class="list-group-item d-flex justify-content-between align-items-center">
					{{ $course->code }} - {{ $course->title }}
						<a wire:click="registerCourse({{ $course->id }})" href="#"><span class="badge bg-primary rounded-pill">Register >></span></a>
					</li> 
					@endforeach
			   </ul>
            </div>
            </div>
        </div>
    </div>

	<div class="col-md-6">
    <div class="card">
            <div class="card-body">
			<h5 class="text-info">Registered Courses</h5>
            <hr class="text-info">
            <div class="list-group">
			@foreach($registeredcourses as $regcourse)
			  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
				<div class="d-flex w-100 justify-content-between">
				  <h5 class="mb-1">{{ $regcourse->course->title }}</h5>
				  <small wire:click="removeRegisteredCourse({{ $regcourse->id }})"><span class="badge bg-danger rounded-pill">Remove <<</span></small>
				</div>
				 <small>{{ $regcourse->created_at->diffForHumans() }}</small>
			  </a>
			 @endforeach
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
