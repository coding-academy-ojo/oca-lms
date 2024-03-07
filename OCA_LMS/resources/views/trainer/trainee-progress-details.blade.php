@extends('layouts.app')

@section('title', 'Student Progress Overview')

@section('content')
@include('layouts.innerNav')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/orange-boosted/dist/css/orangeboosted.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
@media (min-width: 992px) {
    .chart-container {
        max-width: 600px;
        margin: auto;
        height: 400px;
    }
}

@media (min-width: 1200px) {
    .chart-container {
        height: 300px;
    }
}

@media (max-width: 991px) {
    .chart-container {
        max-width: 100%;
        padding: 0 15px;
    }
}
</style>

<div class="container my-4">
    <div class="row">
        <!-- Student Details Section -->
        <div class="col-lg-4 mb-4">
            <!-- Student Information Card -->
            <div class="card card-profile mb-4">
                <div class="card-body pt-2">
                    <h4 class="card-title text-primary">Student Information</h4>
                    <div class="text-center">
                        <div class="profile-photo">
                            <img src="{{ asset('assets/img/usericon.jpg') }}" width="100"
                                class="img-fluid rounded-circle" alt="">
                        </div>
                        <h3 class="mt-4 mb-1">Mohsin</h3>
                        <p class="text-muted"> SWE</p>
                        <ul class="list-group mb-3 list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Student no.</span><strong>02</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Phone No. :</span><strong>0777807890</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Admission Date. :</span><strong>01 July 2023</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Email:</span><strong>Mohsin@gmail.com</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">Attendance Overview</h4>
                    <div class="chart-container">
                        <canvas id="pie_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Title for Income/Expense Report Chart -->
                            <h4 class="card-title text-primary"> Assignments Overview</h4>
                            <!-- Chart Container for Income/Expense Report -->
                            <div class="chart-container">
                                <canvas id="barChart_2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Another Chart Section -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Title for Another Chart -->
                            <h4 class="card-title text-primary">Project Overview</h4>
                            <!-- Chart Container for Another Chart -->
                            <div class="chart-container">
                                <canvas id="areaChart_1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Masterpiece Progress Section -->
<div class="container my-4">
    <h2 class="mb-4 text-primary">Masterpiece Progress</h2>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered verticle-middle table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Label</th>
                            <th>Notes</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Idea Pitching</td>
                            <td>
                                <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                    <div class="progress-bar bg-warning" style="width: 45%;" role="progressbar"><span
                                            class="sr-only">45% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 20,2023</td>
                            <td><span class="badge bg-warning">45%</span></td>
                            </td>
                            <td>
                                ........
                            </td>
                            <td>
                                <span>
                                    <a href="javascript:void()" class="mr-4" data-toggle="tooltip" data-placement="top"
                                        title="Edit"><i class="fa fa-pencil color-muted"></i>
                                    </a>
                                    <a href="javascript:void()" data-toggle="tooltip" data-placement="top"
                                        title="Close"></a>
                                </span>
                            </td>



                        </tr>
                        <tr>
                            <td>Wireframe & Mockup</td>
                            <td>
                                <div class="progress" style="background: rgba(76, 175, 80, .1)">
                                    <div class="progress-bar bg-success" style="width: 80%;" role="progressbar"><span
                                            class="sr-only">80% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Jun 15,2023</td>
                            <td><span class="badge bg-success">80%</span>
                            </td>
                            <td>
                                ........
                            </td>
                            <td><span><a href="javascript:void()" class="mr-4" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i>
                                    </a><a href="javascript:void()" data-toggle="tooltip" data-placement="top"
                                        title="Close"></a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Front-end</td>
                            <td>
                                <div class="progress" style="background: rgba(70, 74, 83, .1)">
                                    <div class="progress-bar bg-warning" style="width: 40%;" role="progressbar"><span
                                            class="sr-only">40% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Jul 1,2023</td>
                            <td><span class="badge bg-warning">40%</span>
                            </td>
                            <td>
                                ........
                            </td>
                            <td><span><a href="javascript:void()" class="mr-4" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i>
                                    </a><a href="javascript:void()" data-toggle="tooltip" data-placement="top"
                                        title="Close"></a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Final version fully functional</td>
                            <td>
                                <div class="progress" style="background: rgba(255, 87, 34, .1)">
                                    <div class="progress-bar bg-danger" style="width: 20%;" role="progressbar"><span
                                            class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Aug 5,2023</td>
                            <td><span class="badge bg-danger">20%</span>
                            </td>
                            <td>
                                ........
                            </td>
                            <td><span><a href="javascript:void()" class="mr-4" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i>
                                    </a><a href="javascript:void()" data-toggle="tooltip" data-placement="top"
                                        title="Close"></a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>All other deliverables</td>
                            <td>
                                <div class="progress" style="background: rgba(255, 193, 7, .1)">
                                    <div class="progress-bar bg-success" style="width: 70%;" role="progressbar"><span
                                            class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Aug 28,2023</td>
                            <td><span class="badge bg-success">70%</span>
                            </td>
                            <td>
                                ........
                            </td>
                            <td><span><a href="javascript:void()" class="mr-4" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i>
                                    </a><a href="javascript:void()" data-toggle="tooltip" data-placement="top"
                                        title="Close"></a></span>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
var pieChartCanvas = document.getElementById('pie_chart');
if (pieChartCanvas) {
    var ctx = pieChartCanvas.getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: [
                    "rgba(255, 121, 0, 1)",
                    "rgba(255, 166, 101, 1)",
                    "rgba(255, 211, 177, 1)",
                    "rgba(255,241,229)"
                ],
                hoverBackgroundColor: [
                    "rgba(255, 121, 0, 1)",
                    "rgba(255, 166, 101, 1)",
                    "rgba(255, 211, 177, 1)",
                    "rgba(255,241,229)"
                ]
            }],
            labels: [
                "Attended",
                "Absence",
                "Justified Tardy",
                "Non justified Tardy"
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true
            },
            maintainAspectRatio: false // Set to true if you want the chart to maintain its aspect ratio
        }
    });
}
var areaChart = function() {
    if (jQuery('#areaChart_1').length > 0) {
        const areaChart_1 = document.getElementById("areaChart_1").getContext('2d');

        new Chart(areaChart_1, {
            type: 'line',
            data: {
                labels: ['Project A', 'Project B', 'Project C'],
                datasets: [{
                    label: 'Assigned Projects',
                    data: [25, 20, 60],
                    borderColor: '#ff7900',
                    borderWidth: 3,
                    backgroundColor: 'rgba(255, 166, 101, 1)',
                    pointBackgroundColor: 'rgba(141, 149, 255, 1)',
                    fill: true // Fill area under the line
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            min: 0,
                            stepSize: 20
                        }
                    }],
                    xAxes: [{}]
                }
            }
        });
    }
}
areaChart();

var barChart = function() {
    if (jQuery('#barChart_2').length > 0) {
        const barChart_2 = document.getElementById("barChart_2").getContext('2d');
        const barChart_2gradientStroke = barChart_2.createLinearGradient(0, 0, 0, 250);
        barChart_2gradientStroke.addColorStop(0, "rgba(141, 149, 255, 1)");
        barChart_2gradientStroke.addColorStop(1, "#ff7900");

        new Chart(barChart_2, {
            type: 'bar',
            data: {
                labels: ["HTML& CSS", "JS", "React", "NodeJS", "MongoDB", "PostgreSQL", "Wordpress"],
                datasets: [{
                    label: "Completion rate",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: barChart_2gradientStroke,
                    borderWidth: "0",
                    backgroundColor: barChart_2gradientStroke,
                    hoverBackgroundColor: barChart_2gradientStroke
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.5
                    }]
                }
            }
        });
    }
}
barChart();
</script>

@endsection