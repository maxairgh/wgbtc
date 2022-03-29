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


       <div class="col-md-8">
           <div class="card">
                <div class="card-body">
                    <h6>Available Users</h6>
                    <hr class="text-primary">
  <div class="table-responsive">
  <table class="table border-primary border-primary table-hove">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Type</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($availableusers as $user)
    <tr>
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->firstname }} {{ $user->lastname }}</td>   
      <td>{{ $user->mobile }}</td>
      <td>{{ $user->type }}</td>
      <td>{{ $user->status }}</td>
      <td>
                <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
										<button type="button" wire:click="getUserDetails( {{ $user->id }} )" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</button>
										<button type="button" class="btn btn-primary" wire:click="changeStatus( {{ $user->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle me-2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg> Status</button>
										 <button type="button" class="btn btn-success" wire:click="ResetPassword( {{ $user->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock align-middle me-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg> Reset Password</button>
                     <button type="button" class="btn btn-danger" wire:click="deleteUser( {{ $user->id }} )"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x align-middle me-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg> Delete</button>
							 </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $availableusers->links() }}
</div>

                </div>
            </div>
       </div>
       <div class="col-md-4">
       <div class="card">
                <div class="card-body">
                    <h6>New User Details</h6>
                    <hr class="text-primary">

                    <div class="mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm" wire:model="firstname" name="firstname" placeholder="First Name">
						<label for="floatingPassword">First Name</label>
					</div>
          @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror 
				    </div>

          <div class="mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm" wire:model="lastname" name="firstname" placeholder="Last Name">
						<label for="floatingPassword">Last Name</label>
					</div>
          @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror 
				  </div>

          <div class="mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm" wire:model="mobile" name="firstname" placeholder="Mobile Number">
						<label for="floatingPassword">Mobile Number</label>
					</div>
          @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror 
				  </div>

          <div class="mt-2">
					<div class="form-floating">
						<input type="text" class="form-control input-sm" wire:model="email" name="firstname" placeholder="Email Address">
						<label for="floatingPassword">Email Address</label>
					</div>
          @error('email') <span class="text-danger">{{ $message }}</span> @enderror 
				  </div>

          <select class="form-select mt-2" wire:model.lazy="usertype" aria-label="Default select example">
            <option selected>User Type</option>
            <option value="admin">Admin</option>
            <option value="facilitator">'facilitator</option> 
            <option value="learner">'learner</option> 
          </select>
          @error('usertype') <span class="text-danger">{{ $message }}</span> @enderror 

          <select class="form-select mt-2" wire:model.lazy="userstatus" aria-label="Default select example">
            <option selected>Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">'Inactive</option> 
          </select>
          @error('userstatus') <span class="text-danger">{{ $message }}</span> @enderror 

          <div class="text-center mt-2">
          <button class="btn btn-primary btn-sm" wire:click="SaveUserDetails">{{ $entryLabel }}</button>
          </div>
          

                </div>
            </div>
       </div>
   </div>
</div>
