<div>

<div class="row">

 
				<div class="col-12 ">

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
			 

    <div class="col-md-4">
		<div class="card">
			<div class="card-body">
						
				<div class="row">
	                <div class="col-12">
	                    <h6>Profile Details</h6>
					</div>
					 <div class="col-12">
	                    <div class="text-center">
								<img src="{{ url('storage/users/'.$uPicture) }}" class="rounded-circle" alt="...">
						</div>
					</div>
					 <div class="col-12">
	                    <p><b class="text-primary">First Name:</b> {{ $fname  }}</p>
	                    <p><b class="text-primary">Last Name:</b> {{ $lname  }}</p>
	                    <p><b class="text-primary">Mobile:</b> {{ $unumber  }}</p>
	                    <p><b class="text-primary">Status:</b> {{ $ustatus }}</p>
	                    <p><b class="text-primary">Role:</b> {{ $urole }}</p>
	                    <p><b class="text-primary">Email:</b> {{ $uemail  }}</p>
	                     
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h6>Update Profile Details</h6>
					<hr class="text-success" >
					
			<form  method="#" action="#">
			<div class="row ">
				<div class="col-md-12 mt-2">
					<div class="form-floating">
						<input type="text" wire:model="firstname" class="form-control input-sm" name="firstname" placeholder="First Name">
						<label for="floatingPassword">First Name</label>
					</div>
					@error('firstname') <span class="text-danger">{{ $message }}</span> @enderror 
				</div>
				<div class="col-md-12 mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm"  wire:model="lastname"  name="firstname" placeholder="First Name">
						<label for="floatingPassword">Last Name</label>
					</div>
					@error('lastname') <span class="text-danger">{{ $message }}</span> @enderror 
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm"  wire:model="mobilenumber"  name="firstname" placeholder="Mobile Number">
						<label for="floatingPassword">Mobile Number</label>
					</div>
					@error('mobilenumber') <span class="text-danger">{{ $message }}</span> @enderror 
				</div> 
			</div>
			<div class=" mt-2 text-center">
			<button type="button" class="btn btn-primary btn-sm" wire:click="updateDetails">Update Details</button>
			</div>
			</form>
			
			<hr class="text-success" >
			
			<form  method="#" action="#">
			<h6>Update Password</h6>
			<div class="row ">
				<div class="col-md-6 mt-2">
					<div class="form-floating">
						<input type="password" class="form-control input-sm" wire:model="password" name="firstname" placeholder="First Name">
						<label for="floatingPassword">Password</label>
					</div>
				</div>
 
				@error('password') <span class="text-danger">{{ $message }}</span> @enderror 
			<div class=" mt-2 text-center">
			<button type="button" class="btn btn-primary btn-sm" wire:click="ChangePassword">Update Password</button>
			</div>
				 <strong>Password should include: </strong>
					<div>
						<ul>
							<li>upper and lower case characters (A – Z and a - z)</li>
							<li> Base 10 digits (0 – 9)</li>
							<li>Non-alphanumeric (For example: !, $, #, or %)</li>
						</ul>
					</div>
			</div> 
			
			</form>
			
			<hr class="text-success" >
			
			 
			<h6>Update Profile Picture</h6>
			<div class="row ">
				<div class="col-md-12 mt-2">
					<div class="form-floating">
						<input type="file" wire:model="displayPicture" class="form-control input-sm was-validated" name="firstname" placeholder="First Name">
						<label for="floatingPassword">Profile Picture</label>
					</div>
				</div>
				@error('displayPicture') <span class="text-danger">{{ $message }}</span> @enderror 
			</div> 
			<div class=" mt-2 text-center">
			<button type="button" wire:click="saveDP" class="btn btn-primary btn-sm">Update Picture</button>
			</div>
			 
			
			</div>
		</div>
	</div>
</div>

</div>