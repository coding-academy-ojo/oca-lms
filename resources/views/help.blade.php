<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description"
	content="user registration website - registration process - coding academy by orange ">
	<meta name="keywords"
	content="registration,coding,orange, laravel, learning">
	<meta name="author" content="Marya Alzubi">
	<title>@yield('title')</title>
	<link rel="preload" href="{{asset('assets/boosted/dist/fonts/HelvNeue55_W1G.woff2')}}" as="font"
	type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="{{asset('assets/boosted/dist/fonts/HelvNeue75_W1G.woff2')}}" as="font"
	type="font/woff2" crossorigin="anonymous">
	<link href="{{asset('assets/boosted/dist/css/orangeHelvetica.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/boosted/dist/css/orangeIcons.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/boosted/dist/css/boosted.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/css/client.css')}}" rel="stylesheet">
	<link rel="preconnect" href="https://code.jquery.com" crossorigin="anonymous">
	<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
	integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="{{asset('assets/js/countries.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.2/js/countrySelect.min.js" integrity="sha512-agmFjG7H3K/n7ca70w6lzdO0MxUFWYcaDrw5WpwBMjhXxfrchssrKyZrJOSEN7q4vIeTcHUX5A7mM6zjbE2ZAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	@yield('links')
	<style>
		@yield('style')
		h1,h2,h3,h4{
			color:#FF7700;
		}
		.text-orange{
			color:#FF7700;
		}
	</style>
</head>
<body>
	<div class="d-md-flex flex-md-equal h-100 ">
		<div class="col-lg-4 p-0 auth-slider my-div" style="position: fixed;top: 0; bottom:0; left: 0; height: 100%">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block h-100 my-div" src="{{asset('assets/img/1.jpg')}}" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block h-100 my-div" src="{{asset('assets/img/2.jpg')}}" alt="Second slide">
					</div>
					<!-- <div class="carousel-item">
						<img class="d-block h-100 my-div" src="{{asset('assets/img/3.png')}}" alt="Second slide">
					</div>
					<div class="carousel-item">
						<img class="d-block h-100 my-div" src="{{asset('assets/img/4.png')}}" alt="Second slide">
					</div> -->
				</div>
			</div>
		</div>
		<div class="col-lg-8 px-0" style="position: absolute;top: 0; bottom: 0; right: 0">
			<header role="banner">
				<nav role="navigation" id="mainNav" class="navbar navbar-light bg-white navbar-expand-md pt-2 border-bottom pb-0 mb-2 pt-1"
				aria-label="Main navigation">
				<div class="container-fluid">
					<a href="/">
						<img src="{{asset('assets/boosted/dist/img/orange.png')}}"
						class="d-inline-block align-bottom mr-3" alt="Back to homepage" title="Back to homepage"
						height="70" loading="lazy" />
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#orange-navbar-collapse"
					aria-controls="orange-navbar-collapse" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="navbar-collapse justify-content-end collapse" id="orange-navbar-collapse">
					<ul class="navbar-nav">
						<li class="nav-item"><a class="nav-link" href="/help" target="_blank">Help </a></li>
						<li class="nav-item"><a class="nav-link" href="/login"> Back To Home</a></li>
					</ul>
					<ul class="navbar-nav">
						@guest

						@else
						<li  class="nav-item dropdown">
							<a class="nav-link logout-style" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();" >Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>
</header>
<section class="wizard-section mt-4">
	<div class="form-wizard">
		<form method="post" class="signup-step1" action="{{route('help')}}">
			@csrf
			<div class="d-flex align-items-center flex-column">
				<div class="col-lg-9 col-md-7">
					<h1 class="text-warning">Help & Support</h1>
				</div>
				<div class="col-lg-9 col-md-7" style="margin-left: 15px;">                    	
					
					 <div>
					 	For any inquiry, send Coding Academy an email 
					 	<span class="text-orange">codingacademy.ojo@orange.com</span>

					 </div>
					

					
					

				</div>
				<div class="ms-clear"></div>


			</div>
		</div>
	</div>


</div>
</form>
</div>
</section>
</div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/boosted@4.5.3/dist/js/boosted.bundle.min.js"
integrity="sha384-hQFBUEXKv1tPjGNFpCctXthNheXFWEyT+cKHsR5+8VYwGoe2L0SIaDNXDpE1LlTK"
crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{asset('assets/boosted/dist/js/jquery-slim.min.js')}}"><\/script>')</script>
<script src="{{asset('assets/boosted/dist/js/boosted.bundle.min.js')}}"></script>
{{-- sweet alert cdn and use --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // create a record
    @if(session('status_store'))
    swal({
    	title: "{{session('status_store')}}",
    	icon: "success",
    	button: "ok",
    });
    @endif
    // update a record
    @if(session('status_update'))
    swal({
    	title: "{{session('status_update')}}",
    	icon: "success",
    	button: "ok",
    });
    @endif
    // delete a record
    @if(session('status_destroy'))
    swal({
    	title: "{{session('status_destroy')}}",
    	icon: "error",
    	button: "ok",
    });
    @endif
</script>
</body>
</html>

