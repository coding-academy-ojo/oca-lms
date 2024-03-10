<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/fonts/HelvNeue55_W1G.woff2" rel="preload" as="font" type="font/woff2" integrity="sha384-R6e0PFLMMV6HBvkQK22ecNfjOzyh89wSndiTC71MuvoaOnhIYgOAGVC0gW0kVN16" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/fonts/HelvNeue75_W1G.woff2" rel="preload" as="font" type="font/woff2" integrity="sha384-ylOkwNNvSwXpWNbpEhI45ruJTXyfQbIb42IxMvSGGcndZBpZ9iAmOFSUl4/Goeqz" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/orange-helvetica.min.css" rel="stylesheet" integrity="sha384-A0Qk1uKfS1i83/YuU13i2nx5pk79PkIfNFOVzTcjCMPGKIDj9Lqx9lJmV7cdBVQZ" crossorigin="anonymous">
    <!-- Orange Boosted CSS -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet">
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>OCA || ORANGE CODING ACADEMY</title>
    <link rel="stylesheet" href="{{asset('assets/style_files/home.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"></script>
</head>

<body style="padding: 0px !important;" class="m-0 border-0 bd-example m-0 border-0">
    <!-- Example Code -->
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('assets/home-img/orange-logo.svg')}}" width="30" height="30" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.login.form') }}">Student Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Staff Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        





        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="" aria-label="Slide 1" style="--bs-carousel-interval: 10000ms;"></button>
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2" class="" style="--bs-carousel-interval: 2000ms;"></button>
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item" data-bs-interval="10000">
                    <div class="image-text-container">
                        <img src="{{asset('assets/home-img/Coding.png')}}" class="d-block w-100" alt="First slide">

                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="image-text-container">
                        <img src="{{asset('assets/home-img/image.png')}}" class="d-block w-100" alt="Second slide">
                    </div>
                </div>
                <div class="carousel-item active">
                    <div class="image-text-container">
                        <img src="{{asset('assets/home-img/image.png')}}" class="d-block w-100" alt="Third slide">

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <section class="about_section padding bg-white px-2">
            <div class="row justify-content-center align-items-center">
                <div class="content col-12 col-lg-5 p-4 m-3">
                    <div class="text-start">
                        <p class="text-primary h1 py-4">About Coding Academy</p>
                        <p class="mb-3 text-start">In light of the increasing demand for qualified programmers in local and regional markets, Orange Jordan took on its shoulders the mission of qualifying a new generation mastering this skill efficiently.</p>
                        <p class="mb-3 text-start">The Coding Academy by Orange was launched in June 2019, in partnership with Simplon.co, to offer a free of charge 6-month training courses in coding languages for free, supported by 1-month internship in ICT sector. Every year
                            50 students, out of thousands of applicants, get the opportunity to join the Academy after passing a very competitive admission process. The employability rate among the first batch of students exceeded 70% which proves the
                            efficiency of the academy’s teaching methodology, curricula and academic staff.</p>
                        <p class="h3 text-primary mx-2 mt-4">What does the Academy Offer</p>
                        <ul class="text-start">
                            <li><strong>6 months</strong> of cost-free training course.</li>
                            <li><strong>1 month internship</strong> in one of the leading IT companies in the Kingdom.
                            </li>
                            <li>Intensive courses offered by a team of qualified trainers in an <strong>active-learning
                                    experience</strong>, such as: HTML, CSS, JavaScript (React), PHP (Laravel), Python (Flask).
                            </li>
                            <li>Networking opportunities with the largest companies in the <strong>local and
                                    international markets</strong>.</li>
                            <li>Access to careers and entrepreneurship training courses in <strong>life and
                                    administrative skills</strong>.</li>
                        </ul>
                    </div>
                </div>
                <div class="content col-12 col-lg-5 p-4 m-3" data-aos="fade-left">
                    <div class="about_img">

                        <img src="{{asset('assets/home-img/coding-academy.png')}}" alt="idea-images" class="img-rounded about_img_1" data-aos="fade-right">
                        <img src="{{asset('assets/home-img/codingAcademy.png')}}" alt="idea-images" class="img-rounded about_img_2" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{asset('assets/home-img/Image (1).png')}}" alt="idea-images" class="img-rounded about_img_3" data-aos="fade-right" data-aos-delay="200">
                    </div>
                </div>

            </div>

        </section>
        <div class=" bg-white">
            <div class="row">
                <div class="col-md-12">
                    <div class="academy-partners paragraph paragraph--type--bp-simple paragraph--view-mode--default paragraph--id--231" id="paragraph--id--231">
                        <div class="paragraph__column">
                            <div class="text-wrapper">
                                <div class="clearfix text-formatted field field--name-bp-text field--type-text-long field--label-hidden field__item">
                                    <p class="align-items-center h1 text-primary d-flex p-5">Our Partners</p>
                                    <div class="row ">
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img class="img-fluid" alt="Coding Academy partner" data-entity-type="file" data-entity-uuid="aa8cb7f6-fe3a-429a-b087-8a430899a6cb" src="{{asset('assets/home-img/economy.png')}}">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img class="img-fluid" alt="Coding Academy partner" data-entity-type="file" data-entity-uuid="50b44262-026b-4929-9255-8113c8c38bf5" src="{{asset('assets/home-img/university.png')}}">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                                            <img class="img-fluid" alt="Simplon" data-entity-type="file" data-entity-uuid="fed83976-6250-4e3f-aa2c-c1562bf42e2d" src="{{asset('assets/home-img/simplon.png')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class="footer navbar" data-bs-theme="dark">
        <h2 class="visually-hidden">Sitemap & information</h2>
        <div class="container-xxl footer-social">
            <h3 class="footer-heading me-md-3">Follow us</h3>
            <ul class="navbar-nav gap-2 flex-row align-self-start">
                <li><a href="#" class="btn btn-icon btn-social btn-twitter"><span class="visually-hidden">Twitter</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-facebook"><span class="visually-hidden">Facebook</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-instagram"><span class="visually-hidden">Instagram</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-whatsapp"><span class="visually-hidden">WhatsApp</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-linkedin"><span class="visually-hidden">LinkedIn</span></a></li>
                <li><a href="#" class="btn btn-icon btn-social btn-youtube"><span class="visually-hidden">YouTube</span></a></li>
            </ul>
        </div>
    </footer>
    <!-- End Example Code -->
    <script>
        AOS.init();
    </script>
</body>

</html>