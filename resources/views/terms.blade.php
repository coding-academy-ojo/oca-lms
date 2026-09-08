<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="user registration website - registration process - coding academy by orange">
    <meta name="keywords" content="registration,coding,orange, laravel, learning">
    <meta name="author" content="Marya Alzubi">
    <title>@yield('title')</title>
    <link rel="preload" href="{{asset('assets/boosted/dist/fonts/HelvNeue55_W1G.woff2')}}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{asset('assets/boosted/dist/fonts/HelvNeue75_W1G.woff2')}}" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="{{asset('assets/boosted/dist/css/orangeHelvetica.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/boosted/dist/css/orangeIcons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/boosted/dist/css/boosted.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/client.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://code.jquery.com" crossorigin="anonymous">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/countries.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.2/js/countrySelect.min.js" integrity="sha512-agmFjG7H3K/n7ca70w6lzdO0MxUFWYcaDrw5WpwBMjhXxfrchssrKyZrJOSEN7q4vIeTcHUX5A7mM6zjbE2ZAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('links')
    <style>
        @yield('style')
        h1,h2,h3,h4{
            color:#FF7700;
        }
             @font-face {
    font-family: 'Helvetica Neue Arabic';
    
    font-weight: 400;
    font-style: normal;
    font-display: swap;
}
    </style>
</head>
<body>
    <div class="d-md-flex flex-md-equal h-100">
        <!-- Slider Side -->
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
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="col-lg-8 px-0" style="position: absolute;top: 0; bottom: 0; right: 0">
            <header role="banner">
                <nav role="navigation" id="mainNav" class="navbar navbar-light bg-white navbar-expand-md pt-2 border-bottom pb-0 mb-2 pt-1" aria-label="Main navigation">
                    <div class="container-fluid">
                        <a href="/">
                            <img src="{{asset('assets/boosted/dist/img/orange.png')}}" class="d-inline-block align-bottom mr-3" alt="Back to homepage" title="Back to homepage" height="70" loading="lazy" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#orange-navbar-collapse" aria-controls="orange-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse justify-content-end collapse" id="orange-navbar-collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="/help">Help </a></li>
                                <li class="nav-item"><a class="nav-link" href="/login"> Back To Home</a></li>
                            </ul>
                            <ul class="navbar-nav">
                                @guest
                                @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link logout-style" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
                    <form method="post" class="signup-step1" action="{{route('terms')}}">
                        @csrf
                        <div class="d-flex align-items-center flex-column">
                            <div class="form-group col-lg-6 col-md-7">
                                <h1 class="text-warning">Terms & Conditions</h1>
                            </div>
                            
                            <div class="col-lg-9 col-md-7 mb-5" style="margin-left: 15px;">
                                <!-- Section 1 -->
                                <h4 class="orange-txt mt-3">1. Acceptance of Terms of Use</h4>
                                <div>These Terms & Conditions apply to all individuals and organizations accessing or using the Orange Coding Academy website to register for any of the Academy's programs.</div>
                                <div class="mt-2">The website includes, but is not limited to, text, information, advertisements, data, audio and visual materials, software, and all other content (collectively referred to as the "Content").</div>
                                <div class="mt-2">By accessing or using this website, you acknowledge that you have read, understood, and agree to be bound by these Terms & Conditions.</div>

                                <!-- Section 2 -->
                                <h4 class="orange-txt mt-4">2. Privacy Policy & Intellectual Property Rights</h4>
                                <div>The provisions of the Privacy Policy apply throughout the entire training period and remain effective until the contractual relationship between the trainee and Orange Coding Academy has ended.</div>
                                <div class="mt-2"><strong>Orange Coding Academy reserves the right to:</strong></div>
                                <div class="ml-3 mt-1">• Collect, use, process, and retain personal information provided by users.</div>
                                <div class="ml-3">• Retain ownership of all training materials and educational resources.</div>
                                <div class="ml-3">• Use and display student projects for educational, promotional, or official purposes.</div>
                                <div class="ml-3">• Obtain copies of source code developed during the training period.</div>
                                <div class="ml-3">• Photograph or record trainees and their projects for promotional or educational purposes.</div>

                                <!-- Section 3 -->
                                <h4 class="orange-txt mt-4">3. Access to the Website</h4>
                                <div>Users agree to provide accurate, complete, and up-to-date information and keep it updated. Orange Coding Academy may suspend or terminate access if false or incomplete information is provided.</div>

                                <!-- Section 4 -->
                                <h4 class="orange-txt mt-4">4. Account Responsibility</h4>
                                <div>Users are responsible for maintaining the confidentiality of their account credentials and for all activities performed under their account. Any unauthorized use must be reported immediately.</div>

                                <!-- Section 5 -->
                                <h4 class="orange-txt mt-4">5. Information Security</h4>
                                <div>Reasonable measures are implemented to protect personal information; however, absolute security cannot be guaranteed.</div>

                                <!-- Section 6 -->
                                <h4 class="orange-txt mt-4">6. Creating Your Profile</h4>
                                <div>1. Visit the Orange Coding Academy website.</div>
                                <div>2. Select Sign On Services.</div>
                                <div>3. Complete and submit the registration form.</div>

                                <!-- Section 7 -->
                                <h4 class="orange-txt mt-4">7. Privacy Policy</h4>
                                <div>By using this website, you consent to the collection and processing of your information in accordance with the Privacy Policy.</div>

                                <!-- Section 8 -->
                                <h4 class="orange-txt mt-4">8. Disclaimer of Warranties</h4>
                                <div>The website is provided on an "as is" and "as available" basis without warranties of any kind.</div>

                                <!-- Section 9 -->
                                <h4 class="orange-txt mt-4">9. Limitation of Liability</h4>
                                <div>Orange Coding Academy shall not be liable for any direct, indirect, incidental, consequential, or special damages arising from the use of the website.</div>

                                <!-- Section 10 -->
                                <h4 class="orange-txt mt-4">10. User Agreement</h4>
                                <div>By using this website, you agree to comply with these Terms & Conditions and any future updates.</div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/boosted@4.5.3/dist/js/boosted.bundle.min.js" integrity="sha384-hQFBUEXKv1tPjGNFpCctXthNheXFWEyT+cKHsR5+8VYwGoe2L0SIaDNXDpE1LlTK" crossorigin="anonymous"></script>
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