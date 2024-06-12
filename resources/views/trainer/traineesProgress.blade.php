@extends('layouts.app')
@section('title')
Trainees Progress
@endsection
@section('content')
@include('layouts.innerNav')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="inner-bred my-5">
@if (session('success'))
        <script>
            Swal.fire({
            title: 'Success!',
            html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
                '<div style="margin-top: 20px;">{{ session('success') }}</div>',
            showConfirmButton: true,
            timer: 5000,
            confirmButtonColor: '#ff7900',
        });
        </script>
    @endif
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/traineesProgress">Progress</a></li>
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

    .skill-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 200px; /* Adjust as needed */
        padding: 10px;
        box-sizing: border-box;
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .skill-title {
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
        flex-grow: 1;
    }
    .skill-levels {
        width: 100%;
    }
    .skill-progress {
        position: relative;
        margin-top: 10px;
    }
    #levels-progress-bar span {
        position: absolute;
        width: 100%;
        left: 0;
        text-align: center;
        color: #fff;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
       <h2 class="text-primary">Trainees Statistics</h2>
       <h2> {{ $attendanceOverview['cohort_name'] }} / {{ $attendanceOverview['date'] }}</h2>
    </div>
    </div>
    <div class="row">
    <!-- Cards Section -->
    <div class="col-xl-12">
        <!-- Adjusted for full width -->
        <div class="row">
            <!-- Attendance -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="widget-stat card">
                    <div class="card-body">
                        <p class="card-title text-primary mb-4" style="font-size: 1.2rem;">Student Attendance</p>
                        
                        <div class="progress mb-2 my-4">
                            <div class="progress-bar progress-animated bg-Success" style="width: {{ $attendanceOverview['attended_percentage'] }}%">{{ $attendanceOverview['attended_percentage'] }}%</div>
                        </div>
                        <small>{{ $attendanceOverview['attended'] }} Trainees Attended </small>
                        <div class="progress mb-2 my-4">
                            <div class="progress-bar progress-animated bg-Success" style="width: {{ $attendanceOverview['late_percentage'] }}%">{{ $attendanceOverview['late_percentage'] }}%</div>
                        </div>
                        <small>{{ $attendanceOverview['late'] }} Trainees late  </small>
                        <div class="progress mb-2 my-4">
                            <div class="progress-bar progress-animated bg-Success" style="width: {{ $attendanceOverview['absent_percentage'] }}%">{{ $attendanceOverview['absent_percentage'] }}%</div>
                        </div>
                        <small>{{ $attendanceOverview['absent'] }} Trainees Absent  </small>

                        <a href="{{ route('absence') }}">
                            <p class="card-title mt-3" style="font-size: 1rem;">More</p>
                        </a>
                    </div>
                </div>
            </div>
            
            <!--  Assignments review -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-4 ">
                <div class="widget-stat card">
                    <div class="card-body">
                        <p class="card-title text-primary mb-4" style="font-size: 1.2rem;">Assignment Review</p>
                        
                        <div class="progress mb-2 my-4">
                            <div class="progress-bar progress-animated bg-success" style="width: {{ $lateAssignmentSubmissions['passSubmissionsStatus'] }}%">{{ $lateAssignmentSubmissions['passSubmissionsStatus'] }} %</div>
                        </div>
                        <small>{{$lateAssignmentSubmissions['passSubmissionsCount']}} Trainees Passed of {{$lateAssignmentSubmissions['numberOfSubmissions']}}  </small>
                        <div class="progress mb-2 my-4">
                        <div class="progress-bar progress-animated bg-success" style="width: {{ $lateAssignmentSubmissions['notPassSubmissionsPercentage'] }}%">{{ $lateAssignmentSubmissions['notPassSubmissionsPercentage'] }}%</div>
                        </div>
                        @if ($lateAssignmentSubmissions['notPassSubmissionsPercentage'] == 100)
                            <small>All Assignments are reviewed</small>
                        @else
                            <small>{{ $lateAssignmentSubmissions['notPassSubmissionsCount'] }} Trainees not reviewed yet of {{$lateAssignmentSubmissions['numberOfSubmissions']}}</small>
                        @endif


                        <div class="progress mb-2 my-4">
                            <div class="progress-bar progress-animated bg-success" style="width: {{ $lateAssignmentSubmissions['latePercentage'] }}%">{{ $lateAssignmentSubmissions['latePercentage'] }} %</div>
                        </div>
                        <small>{{ $lateAssignmentSubmissions['latePercentage'] }} Trainees Submit Late of {{$lateAssignmentSubmissions['numberOfSubmissions']}} </small>
                        

                         <a href="{{ route('assignment.show', $assignmentAssessment['latestAssignmentId']) }}">
                            <p class="card-title mt-3" style="font-size: 1rem;">{{$assignmentAssessment['latestAssignmentTitle']}}</p>
                        </a>
                        </div>
                </div>
            </div>

            <!-- Assignments Assessment -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-4 " style="width: 300px;">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Assignment Submission</h6>
                        <canvas id="LatestAssignmentSubmission"></canvas>
                        <a href="{{ route('assignment.feedbacksubmission.show', $assignmentAssessment['latestAssignmentId']) }}">
                            <p class="card-title" style="font-size: 1rem;">{{$assignmentAssessment['latestAssignmentTitle']}} </p>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Projects Assessment  -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-4" style="width: 300px;">
                <div class="widget-stat card">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Projects Assessment</h4>
                        <canvas id="ProjectsAssessment"></canvas>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <!-- Chart Section -->
   
</div>


</div>

    <!-- Skills carousel -->

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class=" carousel-title text-primary">Overview on Skills Status</h2>
                <hr>
            </div>
        </div>
    
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach(array_chunk($skillsStatus, 4) as $skillChunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="d-flex justify-content-between">
                        @foreach($skillChunk as $skill)
                        <div class="flex-grow-1 mx-2 skill-card">
                            <div class="pb-1">
                                <p class="skill-title">{{ $skill['skill_name'] }}</p>
                            </div>
                            <div class="skill-levels">
                                @foreach($skill['levels'] as $level)
                                <div class="progress skill-progress">
                                    <div  id="levels-progress-bar" class="progress-bar" role="progressbar" style="width: {{ $level['progress'] }}%;">
                                        <span>{{ $level['level_name'] }} 35-35</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
   




   <!-- Table for All trainees  -->
   
      <div class="row my-5">
        <h1 class="text-primary">All Trainees Overview</h1>
        <div class="col-md-12">
            <div class="table-responsive card" style="max-height: 400px; overflow-y: auto;">
                <table id="mytable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Trainees Progress</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allTrainessOverview as $student)
                        <tr>
                            <td>{{ $student['id'] }}</td>
                            <td>{{ $student['name'] }}</td>
                            <td style="width: 70%;">
                                <div style="width: 100%;" class="progress">
                                    <!-- Dynamic part for projects -->
                                    <div class="progress-bar" role="progressbar" style="width: {{ $student['passedPercentage'] }}%; background-color: #ffc107;" aria-valuenow="{{ $student['passedPercentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $student['passedPercentage'] }}% of Projects</div>
                                    
                                    <!-- Static part for internship -->
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%;">Internship</div>
                                    
                                    <!-- Static part for absence -->
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%;">Absence</div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('ProgressDetails.showDetails', ['id' => $student['id']]) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>








<!-- // Js code  -->
<script>
// Handling data from absence controller








// //Changing progress bar colors based on Percentage for trainees overview table
// document.addEventListener('DOMContentLoaded', function() {
//     const progressBars = document.querySelectorAll('.progress-bar');

//     progressBars.forEach(function(bar) {
//         const progressValue = parseInt(bar.getAttribute('aria-valuenow'));

//         if (progressValue > 75) {
//             bar.classList.add('green');
//         } else if (progressValue < 50) {
//             bar.classList.add('red');
//         } else {
//             bar.classList.add('orange');
//         }
//     });
// });


//Chart for all Assignments based on tech
document.addEventListener('DOMContentLoaded', function() {
    // Assignments Bar Chart Initialization
    if (document.getElementById('assignments_per_technology')) {
        const assignments_per_technology = document.getElementById("assignments_per_technology").getContext('2d');



        // Chart data
        let barChartData = {
            labels: [ "Assignment 1", "Assignment 2", "Assignment 3", "Assignment 4"],
            datasets: [{
                label: 'Passed',
                backgroundColor: "rgba(43, 193, 85, 1)", // Green color
                hoverBackgroundColor: "rgba(43, 193, 85, 1)",
                data: [30, 30, 30, 25]
            }, {
                label: 'Not Yet',
                backgroundColor: "rgba(243, 87, 87, 1)", // Red color
                hoverBackgroundColor: "rgba(243, 87, 87, 1)",
                data: [0, 0, 0, 5]
            }]
        };

        // Chart options
        new Chart(assignments_per_technology, {
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

    // All Projects Bar Chart Initialization
    if (document.getElementById('barChart_3')) {
        const barChart_3 = document.getElementById("barChart_3").getContext('2d');



        // Chart data
        let barChartData = {
            labels: ["HTML& CSS", "JS", "React", "NodeJS", "MongoDB", "PostgreSQL", "Wordpress"],
            datasets: [{
                label: 'Passed',
                backgroundColor: "rgba(43, 193, 85, 1)", // Green color
                hoverBackgroundColor: "rgba(43, 193, 85, 1)",
                data: [100, 95, 90, 100, 80, 93, 99]
            }, {
                label: 'Corrective actions',
                backgroundColor: "rgba(243, 87, 87, 1)", // Red color
                hoverBackgroundColor: "rgba(243, 87, 87, 1)",
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



    // LatestAssignmentSubmission chart Initialization
    if (document.getElementById('LatestAssignmentSubmission')) {
        var doughnutChart1 = new Chart(document.getElementById('LatestAssignmentSubmission'), {
            type: 'doughnut',
            data: {
                labels: ['Submitted', 'Not Submitted'],
                datasets: [{

                    data: [ {{ $assignmentAssessment['numberOfStudentsSubmitted'] }}, {{ $assignmentAssessment['numberOfStudentsNotSubmitted'] }}],
                    backgroundColor: [
                        "rgba(43, 193, 85, 1)",
                        "rgba(243, 87, 87, 1)",
                    ],
                    hoverBackgroundColor: [
                        "rgba(43, 193, 85, 1)",
                        "rgba(243, 87, 87, 1)",
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

    // Projects Assessment Chart Initialization

    let passedStudents = {{ $projectsAssessment['passedStudents'] }};
    let failedStudents = {{ $projectsAssessment['failedStudents'] }};

    if (document.getElementById('ProjectsAssessment')) {
        var doughnutChart2 = new Chart(document.getElementById('ProjectsAssessment'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [passedStudents, failedStudents],
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
                }],
                labels: ['Passed', 'Corrective action']
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutoutPercentage: 80
            }
        });
    }
});

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>



<script>
const element = document.getElementById("id01");
element.innerHTML = "New Heading";
</script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
</script>

@endSection