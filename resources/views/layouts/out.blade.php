<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | WORD of GRACE</title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

	<!-- Styles -->
    <link href="{{ asset('vendors/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/DataTables/datatables.min.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/dt/jquery.datetimepicker.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}"/>
	 
    <!--  Scripts -->
    <!-- include summernote css/js -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	@yield('style')
	@livewireStyles
</head>

<body>
	
	<div class="wrapper">
		 <!-- partial:partials/_sidebar.html -->
              
		<!-- partial -->
		
		<div class="main">
	  <!-- partial:partials/_navbar.html -->
      
      <!-- partial -->
			
			<main class="content">
				<div class="container-fluid p-0">
					<!-- partial -->
					@include('partials.admin._success')   
					@include('partials.admin._errors') 
					<!-- main content -->
					@yield('navigation')
					@yield('content')
					{{ $slot ?? ''}}
				</div>
			</main>

		<!-- partial:partials/_footer.html -->
		@include('partials.admin._footer')
		<!-- partial -->			
		
		</div>
	</div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--<script src="{{ asset('vendors/js/jquery3.6.0.min.js') }}" defer></script> -->
<!--<script src="{{ asset('vendors/bootstrap5/js/propper.js') }}" defer></script>-->
<!--<script src="{{ asset('vendors/bootstrap5/js/bootstrap.min.js') }}" defer></script> -->
<script type="text/javascript" src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('vendors/dt/build/jquery.datetimepicker.full.min.js') }}"></script>  
<script src="{{ asset('vendors/ckeditor/ckeditor.js') }}" defer></script>
<script src="{{ asset('vendors/js/app.js') }}" defer></script>

@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <x-livewire-alert::scripts />
@yield('scripts')
@stack('scripts')

</body>

</html>