<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Education &mdash; Free Website Template by freehtml5.co</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: "Source Sans Pro", Arial, sans-serif;
            font-size: 15px;
            line-height: 1.7;
            color: #828282;
            background: #fff;
        }

        .custom-hero {
            background-image: url('{{ asset('assets/img/coding-1.png') }}');
            background-size: cover;
            background-position: center center;
            height: 60vh;
            position: relative;
        }

        .custom-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }
        .footer-orange-boosted {
            background-color: #f16e00; /* Orange Boosted primary color */
            color: white;
            padding: 2rem 0;
        }

        .footer-orange-boosted a {
            color: white;
        }

        .footer-orange-boosted .footer-heading {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .footer-orange-boosted .list-unstyled {
            list-style-type: none;
            padding-left: 0;
        }

        .footer-orange-boosted .list-unstyled li a:hover {
            text-decoration: underline;
        }

        .footer-social-icons {
            font-size: 1.5rem;
        }

        .footer-social-icons a {
            color: white;
            margin-right: 0.5rem;
        }

        /* Custom media query for smaller screens */
        @media (max-width: 768px) {
            .footer-social-icons {
                margin-top: 1rem;
            }
        }.card {
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
}
/* Custom Styles */
/* Primary Orange color for the titles */
.primary-color {
    color: #f16e00;
}

/* Orange border styling for the section header */
.orange-border-box {
    border: 3px solid #f16e00;
    display: inline-block;
    padding: 10px;
}

/* Larger font size for the section header */
.section-header {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 1rem 0;
}

/* Sub-header with slightly faded text color */
.sub-header {
    color: #666;
    margin-bottom: 2rem;
}

/* Flex container for cards */
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 1rem;
}

/* Card style */
.card {
    border: none;
    max-width: 350px;
    margin-bottom: 1rem;
}

/* Icon style */
.card-icon {
    font-size: 3rem;
    color: #f16e00;
}

/* Card title */
.card-title {
    font-weight: bold;
    margin-top: 10px;
}

/* Card body text */
.card-body {
    font-size: 0.9rem;
    color: #666;
}

/* Media query for responsiveness */
@media (max-width: 768px) {
    .card-container {
        justify-content: center;
    }
}

/* Ensure the card content is centered */
.card .card-body {
    text-align: center;
}.topics-section h2 {
    font-size: 2rem;
    color: #f16e00; /* Orange color */
    border: 2px solid #f16e00;
    display: inline-block;
    padding: 0.3em 0.7em;
}

.topics-section p {
    color: #333;
    max-width: 800px;
    margin: 1em auto;
    line-height: 1.6;
}

.topics-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 2em;
}

.topics-tabs ul {
    list-style: none;
    background-color: #333;
    padding: 1em;
    color: white;
}

.topics-tabs ul li {
    margin: 0.5em 0;
    font-weight: bold;
}

.topics-tabs ul li:hover {
    cursor: pointer;
    text-decoration: underline;
}

.topic-icon {
    width: 100px; /* adjust as necessary */
    height: 100px; /* adjust as necessary */
    margin-right: 2em;
}

.topic-description h3 {
    color: #f16e00;
    margin-bottom: 0.5em;
}

.topic-description p {
    color: #333;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .topics-content {
        flex-direction: column;
    }

    .topic-icon {
        margin: 0 auto 1em auto;
        display: block;
    }
}
#trainigat{
    padding: 30px;
    margin: 30px;
    background-color: #e9ecef;
    margin-top: 3rem !important;
}

    </style>
</head>
<body>

    <div class="fh5co-loader"></div>

    <div id="page">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.html">Orange<span>.</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        {{-- <li class="nav-item active">
                            <a class="nav-link" href="dashboard.html">Dashboard</a>
                        </li> --}}
                        @if(Auth::check())
                        {{-- If user is authenticated, show logout --}}
                        <li class="nav-item">
                      
                
                            <a href="{{ route('logout') }}">Logout</a>

                        </li>
                    @else
                        {{-- If user is not authenticated, show login options --}}
                        <li class="nav-item {{ Request::is('student/login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('student.login.form') }}">Student Login</a>
                        </li>
                        <li class="nav-item {{ Request::is('staff/login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">Staff Login</a>
                        </li>
                    @endif
                </div>
            </div>
        </nav>

        <aside id="fh5co-hero"
            style="background-image: url('{{ asset('assets/img/coding-1.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; width: 100%; height: 60vh; display: block;">
            <div class="bg-overlay" style=""></div>
            <div class="overlay-gradient"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center slider-text">
                        <div class="slider-text-inner" style="padding: 10vh 0;">
                            <h1 style=" color: #FF7900 ; /* Orange Boosted primary color example */
                        font-family: 'Source Sans Pro', Arial, sans-serif; /* Adjust based on Orange Boosted */
                        font-weight: bold;
                        font-size: 3rem;"
                                class="">Orange Coding Academy</h1>
                            <p style="color: #111; /* For contrast */
                        font-family: 'Source Sans Pro', Arial, sans-serif; /* Adjust based on Orange Boosted */
                        font-size: 1.5rem;"
                                class="">Learn by Doing</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <div class="container mt-5" id="trainigat">
            <div class="text-center mb-4">
                <div class="orange-border-box">
                    <h1 class="section-header primary-color">TRAINING AT ORANGE CODING ACADEMY</h1>
                </div>
                {{-- <p class="sub-header">Phasellus non dolor nibh. Nullam elementum tellus pretium feugiat. Cras dictum tellus dui, vitae sollicitudin ipsum tincidunt in. Sed tincidunt tristique enim sed sollicitudin.</p> --}}
            </div>
        
            <div class="card-container">
                <!-- Card 1 -->
                <div class="card">
                    <div class="card-body">
                        <i class="card-icon fas fa-unlock-alt"></i>
                        <h5 class="card-title primary-color">Unlimited access</h5>
                        <p class="card-text">Morbi leo risus, porta ac consectetur, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <i class="card-icon fas fa-unlock-alt"></i>
                        <h5 class="card-title primary-color">Unlimited access</h5>
                        <p class="card-text">Morbi leo risus, porta ac consectetur, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <i class="card-icon fas fa-unlock-alt"></i>
                        <h5 class="card-title primary-color">Unlimited access</h5>
                        <p class="card-text">Morbi leo risus, porta ac consectetur, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <i class="card-icon fas fa-unlock-alt"></i>
                        <h5 class="card-title primary-color">Unlimited access</h5>
                        <p class="card-text">Morbi leo risus, porta ac consectetur, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
                    </div>
                </div>
                <!-- Add additional cards here -->
            </div>
        </div>
{{--         
        <div class="topics-section">
            <div class="topics-header">
                <h2>AVAILABLE TOPICS</h2>
                <p>Phasellus non dolor nibh. Nullam elementum tellus pretium feugiat. Cras dictum tellus dui, vitae sollicitudin ipsum tincidunt in. Sed tincidunt tristique enim sed sollicitudin.</p>
            </div>
            <div class="topics-content">
                <div class="topics-tabs">
                    <ul>
                        <li>Graphic Designing</li>
                        <li>Online Marketing</li>
                        <li>Brand & Strategy</li>
                        <li>Social Marketing</li>
                        <li>Basic Photography</li>
                    </ul>
                </div>
                <div class="topics-info">
                    <div class="topic-icon">
                        <!-- Insert image here -->
                    </div>
                    <div class="topic-description">
                        <h3>Graphic Designing</h3>
                        <p>Cras dictum tellus dui, vitae sollicitudin ipsum tincidunt adipiscing ante varius at. Sed mollis vestibulum sapien sed mattis. Cras dictum tellus duvi, vitae sollicitudin ipsum tincidunt adipiscing ante varius at. Sed mollis vestibulum sapien sed mattis.</p>
                    </div>
                </div>
            </div>
        </div> --}}
        

        







        <footer class="footer-orange-boosted">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="footer-heading">About Us</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus.</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="footer-heading">Follow Us</h5>
                        <div class="footer-social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
          
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Count Down -->
    <script src="https://cdn.jsdelivr.net/npm/jquery.countdown@2.2.0/jquery.countdown.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
    <script>
        var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

        // default example
        simplyCountdown('.simply-countdown-one', {
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate()
        });

        //jQuery example
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            enableUtc: false
        });
    </script>
</body>

</html>
