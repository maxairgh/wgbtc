<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
          <span class="align-middle">WORD OF GRACE LEMAS</span>
        </a>

				<ul class="sidebar-nav">
				
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            		</a>
					</li>
					<li class="sidebar-header">
					Announcement
					</li>
		 
			<li class="sidebar-item">
			<a class="sidebar-link" href="{{ route('news') }}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Add</span>
            </a>
			</li>

					<li class="sidebar-header">
						Registration
					</li>
			
			<li class="sidebar-item">
			<a class="sidebar-link" href="{{ route('program') }}">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Programs</span>
            </a>
			</li>
			
			<li class="sidebar-item">
				<a class="sidebar-link" href="{{ route('course') }}">
				<i class="align-middle" data-feather="search"></i> <span class="align-middle">Courses</span>
				</a>
			</li>
			
			<li class="sidebar-item">
				<a class="sidebar-link" href="{{ route('registerlearner') }}">
				<i class="align-middle" data-feather="refresh-cw"></i> <span class="align-middle">Learners</span>
				</a>
			</li>

			 <li class="sidebar-item">
						<a href="#coursereg" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span class="align-middle">Course Registration</span>
            </a>
						<ul id="coursereg" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('admincoursereg') }}">Learners</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('teacherscoursereg') }}">Facilitators</a></li>
						</ul>
			 </li>

					<li class="sidebar-header">
						Finance
					</li>
				
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Fees Setup</span>
						</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="activity"></i> <span class="align-middle">Waivers</span>
						</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Assign Fees</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Payments</span>
						</a>
					</li>
									
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="search"></i> <span class="align-middle">Search</span>
						</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('dashboard') }}">
						<i class="align-middle" data-feather="search"></i> <span class="align-middle">Fees Analysis</span>
						</a>
					</li>

					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('userprofile') }}">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('manageuser') }}">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">User Management</span>
            </a>
					</li>
				 	
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('session') }}">
              			<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Session</span>
            			</a>
					</li>  
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('settings.index') }}">
              			<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            			</a>
					</li>
				</ul>

				<div class="sidebar-cta text-center">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">WG-LEMAS</strong>
					</div>
				</div>
			</div>
		</nav>
