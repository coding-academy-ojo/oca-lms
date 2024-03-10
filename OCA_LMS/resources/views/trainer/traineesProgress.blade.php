@extends('layouts.app')
@section('title')
Trainees Progress
@endsection
@section('content')
@include('layouts.innerNav')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="inner-bred my-5">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Trainees</a></li>
        </ul>
    </div>
</section>

<style>
.green {
    background-color: #2BC155 !important;
}

.red {
    background-color: #F35757 !important;
}

.orange {
    background-color: orange !important;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-primary">Trainees Statistics General view / 06-March-2024</h2>
        </div>
    </div>
    <div class="row">
        <!-- Cards Section -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <!-- Adjusted for 55% width -->
            <div class="row">
                <!-- Attendence -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <p class="card-title" style="font-size: 1.2rem;">Attendance</p>
                            <p style="font-size: 0.8rem;">30 Trainees</p>
                            <a href="">
                                <p class="card-title" style="font-size: 0.8rem;">More</p>
                            </a>
                            <div class="progress mb-2 my-2">
                                <div class="progress-bar progress-animated bg-primary" style="width: 75%"></div>
                            </div>
                            <small>5 late, 0 Absence</small>
                        </div>
                    </div>
                </div>
                <!-- Late Assignments Submissions -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <p class="card-title" style="font-size: 1.2rem;">Late Assignments Submissions</p>
                            <p style="font-size: 0.8rem;">2 Trainees</p>
                            <a href="">
                                <p class="card-title" style="font-size: .8rem;">Flex and Grid</p>
                            </a>

                            <div class="progress mb-2 my-2">
                                <div class="progress-bar progress-animated bg-warning" style="width: 88%"></div>
                            </div>
                            <small> 33 on time </small>
                        </div>
                    </div>
                </div>
                <!-- Assignments Assessment -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <div class="card-body">

                            <h4 class="card-title">Assignments Assessment</h4>
                            <canvas id="Assignments Assessment"></canvas>
                            <small>76% Better than last assignment</small>
                        </div>
                    </div>
                </div>
                <!-- Projects Assessment Card -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <h4 class="card-title">Projects Assessment</h4>
                            <canvas id="Projects Assessment"></canvas>
                            <small>90% Better than last Project</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chart Section -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <p>All Technologies Status </p>
            <div class="card mb-4">
                <!-- Roadmap Chart Card -->
                <div class="card-body">
                    <canvas id="Roadmap" style="width: 100%; height: 200px;"></canvas>
                </div>
            </div>
            <p>All Assignments Status</p>
            <div class="card">
                <!-- Stacked Bar Chart Card -->
                <div class="card-body">
                    <canvas id="barChart_3" style="width: 100%; height: 200px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills carousel -->

    <div class="container my-5">

        <div class="row">

            <div class="col-md-12">
            <h2 class=" carousel-title text-primary">Overview on Skills Status</h2>
                <hr>

            </div>
            <!-- End of Col-md-12 -->

            <!-- 
                =================================
                This Code Block is For PC Edition
                ================================= 
            -->

            <div id="carouselExample" class="carousel slide d-none d-sm-none d-md-block" data-ride="carousel">

                <div class="carousel-inner">



                    <!-- first carousel slide -->

                    <div class="carousel-item active">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="pb-1">
                                    <p style="font-size: 14px; margin-top: 10px;">S1: Create mock-ups for an application
                                    </p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div>
                                    <p style="font-size: 14px; margin-top: 10px;">S2: Create static and adaptive web
                                        user interfaces</p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="pb-1">
                                    <p style="margin-top: 10px; font-size: 14px;">S3: Develop a dynamic web user
                                        interface</p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div>
                                    <p style="margin-top: 10px; font-size: 14px;">S4: Create a user interface with a
                                        content management or
                                        e-commerce solution</p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end of first carousel slide -->


                    <!-- Second carousel slide -->
                    <div class="carousel-item ">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="pb-1">
                                    <p style="margin-top: 10px; font-size: 14px;">S5: Create a database</p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="pb-1">
                                    <p style="margin-top: 10px; font-size: 14px;">S6: Develop data access components</p>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div>
                                    <p style="margin-top: 10px; font-size: 14px;">S7: Develop the back end of a web or
                                        mobile web application
                                    </p>
                                </div>

                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>

                            </div>
                            <div class="col-md-3 ">
                                <div>
                                    <p style="font-size: 14px; margin-top: 10px;">S8: Create and implement components in
                                        a content
                                        management or e-commerce application</p>
                                </div>

                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="0%"
                                    style="margin-top: 10px;">
                                    <div>Level1</div>
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>

                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="25%"
                                    style="margin-top: 10px;">
                                    <div>Level2</div>
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>

                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" title="50%"
                                    style="margin-top: 10px;">
                                    <div>Level3</div>
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End of Second carousel slide -->

                <!-- Carousel Control prev -->
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <!-- Carousel Control Next -->
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Carousel Control Next -->

        </div>
        <!-- End of Carousel Example -->

        <!-- 
                =================================
                /End of PC Edition 
                =================================
            -->


        <!-- 
                =================================
                This Code Block is For Mobile Edition
                ================================= 
            -->

        <div id="carouselExampleMobile" class="carousel slide d-md-none d-lg-none d-xl-none" data-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 1&amp;font=noto"
                        alt="First slide">

                </div>
                <!-- Carousel Item 1 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 2&amp;font=noto"
                        alt="Second slide">

                </div>
                <!-- Carousel Item 2 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 3&amp;font=noto"
                        alt="Third slide">

                </div>
                <!-- Carousel Item 3 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 4&amp;font=noto"
                        alt="Fourth slide">

                </div>
                <!-- Carousel Item 4 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 5&amp;font=noto"
                        alt="Fifth slide">

                </div>
                <!-- Carousel Item 5 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 6&amp;font=noto"
                        alt="Sixth slide">

                </div>
                <!-- Carousel Item 6 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 7&amp;font=noto"
                        alt="Seventh slide">

                </div>
                <!-- Carousel Item 7 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 8&amp;font=noto"
                        alt="Eighth slide">

                </div>
                <!-- Carousel Item 8 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 9&amp;font=noto"
                        alt="Ninth slide">

                </div>
                <!-- Carousel Item 9 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 10&amp;font=noto"
                        alt="Tenth slide">

                </div>
                <!-- Carousel Item 10 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 11&amp;font=noto"
                        alt="Eleventh slide">

                </div>
                <!-- Carousel Item 11 -->

                <div class="carousel-item">

                    <img class="d-block w-100" src="https://fakeimg.pl/800x400/?retina=1&amp;text=Logo 12&amp;font=noto"
                        alt="Twelveth slide">

                </div>
                <!-- Carousel Item 12 -->

            </div>

            <a class="carousel-control-prev" href="#carouselExampleMobile" role="button" data-slide="prev">

                <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                <span class="sr-only">Previous</span>

            </a>
            <!-- Carousel Control Prev -->

            <a class="carousel-control-next" href="#carouselExampleMobile" role="button" data-slide="next">

                <span class="carousel-control-next-icon" aria-hidden="true"></span>

                <span class="sr-only">Next</span>

            </a>
            <!-- Carousel Control Next -->

        </div>
        <!-- End of Carousel Example -->

        <!-- 
                =================================
                /End of Mobile Edition 
                =================================
            -->

    </div>
    <!-- End of Row -->






    <!-- Table for All trainees  -->
    <div class="row my-5">
        <h1 class="text-primary"> All Trainees Overview</h1>
        <div class="col-md-12">
            <div class="widget blank no-padding">
                <div class="panel panel-default work-progress-table">
                </div>
                <div class="table-responsive">
                    <!-- Add this wrapper -->
                    <table id="mytable" class="table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>Name</th>
                                <th>Student Progress</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Mohsin</td>
                                <td style="width: 70%;">
                                    <div class="progress">
                                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="60" role="progressbar" class="red progress-bar">
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Haseeb</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 80%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="80" role="progressbar" class="green progress-bar">
                                            <span>80%</span>
                                        </div>
                                    </div>
                                </td>

                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Hussain</td>

                                <td>
                                    <div class="progress">
                                        <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="40" role="progressbar" class="purple progress-bar">
                                            <span>40%</span>
                                        </div>
                                    </div>
                                </td>

                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Noman</td>

                                <td>
                                    <div class="progress">
                                        <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="90" role="progressbar" class="purple progress-bar">
                                            <span>90%</span>
                                        </div>
                                    </div>
                                </td>

                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Ubaid</td>

                                <td>
                                    <div class="progress">
                                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="60" role="progressbar" class="red progress-bar">
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Adnan</td>

                                <td>
                                    <div class="progress">
                                        <div style="width: 45%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="45" role="progressbar" class="red progress-bar">
                                            <span>45%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>

                            </tr>

                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Saboor</td>

                                <td>
                                    <div class="progress">
                                        <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="89" role="progressbar" class="green progress-bar">
                                            <span>89%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <script>
    //Changing progress bar colors based on Percentage
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.progress-bar');

        progressBars.forEach(function(bar) {
            const progressValue = parseInt(bar.getAttribute('aria-valuenow'));

            if (progressValue > 75) {
                bar.classList.add('green');
            } else if (progressValue < 50) {
                bar.classList.add('red');
            } else {
                bar.classList.add('orange');
            }
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        // Line Chart Initialization
        if (document.getElementById('Roadmap')) {
            var Roadmap = document.getElementById('Roadmap').getContext('2d');
            var RoadmapgradientStroke = Roadmap.createLinearGradient(500, 0, 100, 0);
            RoadmapgradientStroke.addColorStop(0, "rgba(102, 115, 253, 1)");
            RoadmapgradientStroke.addColorStop(1, "rgba(102, 115, 253, 0.5)");

            new Chart(Roadmap, {
                type: 'line',
                data: {
                    labels: ["HTML& CSS", "JS", "React", "NodeJS", "MongoDB", "PostgreSQL",
                        "Wordpress"],
                    datasets: [{

                        label: "Roadmap timeline",
                        data: [25, 20, 60, 41, 66, 45, 80],
                        borderColor: "#fc9403",
                        borderWidth: 2,
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fc9403'

                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100,
                                min: 0,
                                stepSize: 20,
                                padding: 10
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                padding: 5
                            }
                        }]
                    }
                }
            });
        }

        // Doughnut Chart 1 Initialization
        if (document.getElementById('Assignments Assessment')) {
            var doughnutChart1 = new Chart(document.getElementById('Assignments Assessment'), {
                type: 'doughnut',
                data: {

                    datasets: [{
                        lables: ['Passed', 'Not Passed', 'not submitted'],
                        data: [5, 85, 10],
                        backgroundColor: [
                            "#d9d8d7",
                            "rgba(43, 193, 85, 1)",
                            "rgba(243, 87, 87, 1)"
                        ],
                        hoverBackgroundColor: [
                            "#d9d8d7",
                            "rgba(43, 193, 85, 1)",
                            "rgba(243, 87, 87, 1)"
                        ],
                        borderWidth: 3,
                        borderColor: "rgba(255,255,255,1)"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutoutPercentage: 70
                }
            });
        }

        // Doughnut Chart 2 Initialization
        if (document.getElementById('Projects Assessment')) {
            var doughnutChart2 = new Chart(document.getElementById('Projects Assessment'), {
                type: 'doughnut',
                data: {
                    lables: ['Passed', 'Corrective action'],
                    datasets: [{
                        data: [33, 2],
                        backgroundColor: [
                            "rgba(43, 193, 85, 1)",
                            "rgba(243, 87, 87, 1)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(43, 193, 85, 1)",
                            "rgba(243, 87, 87, 1)"
                        ],
                        borderWidth: 3,
                        borderColor: "rgba(255,255,255,1)"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutoutPercentage: 70,
                }
            });
        }

        // Stacked Bar Chart Initialization
        if (document.getElementById('barChart_3')) {
            const barChart_3 = document.getElementById("barChart_3").getContext('2d');

            // Generate gradients for each dataset
            const barChart_3gradientStroke1 = barChart_3.createLinearGradient(0, 0, 0, 300);
            barChart_3gradientStroke1.addColorStop(0, "rgba(102, 115, 253, 1)");
            barChart_3gradientStroke1.addColorStop(1, "rgba(102, 115, 253, 0.5)");

            const barChart_3gradientStroke2 = barChart_3.createLinearGradient(0, 0, 0, 300);
            barChart_3gradientStroke2.addColorStop(0, "rgba(43, 193, 85, 1)");
            barChart_3gradientStroke2.addColorStop(1, "rgba(43, 193, 85, 1)");

            const barChart_3gradientStroke3 = barChart_3.createLinearGradient(0, 0, 0, 300);
            barChart_3gradientStroke3.addColorStop(0, "rgba(243, 87, 87, 1)");
            barChart_3gradientStroke3.addColorStop(1, "rgba(243, 87, 87, 1)");

            // Chart data
            let barChartData = {
                labels: ["HTML& CSS", "JS", "React", "NodeJS", "MongoDB", "PostgreSQL", "Wordpress"],
                datasets: [{
                    label: 'Passed',
                    backgroundColor: barChart_3gradientStroke2,
                    hoverBackgroundColor: barChart_3gradientStroke2,
                    data: [35, 33, 33, 34, 35, 34, 35]
                }, {
                    label: 'Corrective actions',
                    backgroundColor: barChart_3gradientStroke3,
                    hoverBackgroundColor: barChart_3gradientStroke3,
                    data: [0, 2, 2, 1, 0, 1, 0]
                }]
            };

            // Chart options
            new Chart(barChart_3, {
                type: 'bar',
                data: barChartData,
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });
        }



    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    @endSection