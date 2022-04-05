<div>      
@section('title','Faciliator Courses')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Course Assignment for Facilitators </h5>
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <p class="text-success">Select Facilitator</p> 
					<div class="input-group mb-3">
						<select class="form-select" id="inputGroupSelect02" wire:model="selectedTeacherID">
                        <option value="">Choose...</option>
                        @foreach($facilitators as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->firstname }} {{ $teacher->middlename }} {{ $teacher->lastname }}</option>
                        @endforeach
                    </select>
                    <button wire:click="getAssignedCourses" class="btn btn-outline-secondary" type="button" id="button-addon2">View</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h5 class="text-info">Assigned courses to Facilitators</h5>
                <hr class="text-info">
 
                <div style="overflow-y: scroll; height:400px;">

                <ul class="list-group">
                    @foreach($courses as $course)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $course->code }} - {{ $course->title }}
                        <a wire:click="addCourse({{$course->id }})" href="#"> <span class="badge bg-success rounded-pill"> Assign >> </span></a>
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
                <h5 class="text-info">View Assigned Courses</h5>
                <hr class="text-info">

                <div style="overflow-y: scroll; height:400px;">

                <ul class="list-group">
				@foreach($regCourses as $Course)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $Course->course->code }} - {{ $Course->course->title }}  
                        <a href="#" wire:click="removeCourse({{ $Course->id }})"><span class="badge bg-danger rounded-pill"><< Remove</span></a>
                    </li>
				@endforeach 
                </ul>

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

