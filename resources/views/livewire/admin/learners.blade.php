<div>      
@section('title','Learners')

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

<div class="bg-gray text-center">
<div class="btn-group btn-group-md mb-2" role="group" aria-label="Small button group">
			    <a href="{{ route('searchlearner') }}" class="btn btn-info btn-md"> Search Learners</a>
			    <a href="{{ route('onlineapprove') }}" class="btn btn-success btn-md"> Online Registration </a>
		   </div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-md-12">
    <h6>Learner Details</h6>
    <hr class="text-primary">
    </div>
</div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" wire:model="firstname" placeholder="name@example.com" required>
            <label for="floatingInput">Firstname</label>
            @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-md-4"> 
            <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" wire:model="middlename" placeholder="name@example.com" required>
            <label for="floatingInput">Middlename</label>
            @error('middlename') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" wire:model="lastname" placeholder="name@example.com" required>
            <label for="floatingInput">Surname</label>
            @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" required wire:model="gender" aria-label="Floating label select example">
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option> 
            </select>
            <label for="floatingSelect">Gender</label>
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
            <input type="date" class="form-control" id="floatingInput" wire:model="dob" placeholder="name@example.com" required>
            <label for="floatingInput">Date of Birth</label>
            @error('dob') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" required wire:model="maritalstatus" aria-label="Floating label select example">
            <option value="">Select</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option> 
            <option value="Divorced">Divorced</option>  
            </select>
            <label for="floatingSelect">Marital Status</label>
            @error('maritalstatus') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row mt-2">
       <div class="col-md-4">
            <div class="form-floating">
            <input type="tel" class="form-control" id="floatingInput" wire:model="phonenumber" placeholder="name@example.com" pattern="[09]{3}[09]{2}[09]{3}" required>
            <label for="floatingInput">Phone Number</label>
            @error('phonenumber') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" wire:model="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email Address</label>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" required wire:model="status" aria-label="Floating label select example">
            <option value="">Select</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option> 
            <option value="Completed">Completed</option>  
            </select>
            <label for="floatingSelect">Status</label>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="row mt-2">
       <div class="col-md-6">
       <div class="form-floating">
            <select class="form-select" id="floatingSelect" required wire:model="denomination" aria-label="Floating label select example">
            <option value="">Select</option>
            @foreach($denominations as $denomination)
            <option value="{{ $denomination->description }}">{{ $denomination->description }}</option> 
            @endforeach
            </select>
            <label for="floatingSelect">Denomination</label>
            @error('denomination') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" wire:model="position" placeholder="name@example.com" required>
            <label for="floatingInput">Position in Church</label>
            @error('position') <span class="text-danger">{{ $message }}</span> @enderror 
          </div>
        </div>
    </div>


    <div class="row mt-3">
    <div class="col-md-12">
    <h6>Registration Details</h6>
    <hr class="text-primary">
    </div>
    </div>
     
    <div class="row mt-2">
       <div class="col-md-12">
       <div class="form-floating">
            <select class="form-select" id="floatingSelect" required wire:model="programid" aria-label="Floating label select example">
            <option value="">Select</option>
            @foreach($programs as $program)
            <option value="{{ $program->id }}">{{ $program->title }}</option> 
            @endforeach
            </select>
            <label for="floatingSelect">Program</label>
            @error('programid') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="mt-3 col-md-12 text-center">
            <button type="submit" wire:click="saveDetail" class="btn btn-primary btn-sm">SAVE DETAILS</button>
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

