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
            <div class="card ">
                <div class="card-body">
                    <h4 class="card-title text-primary">Attendance Overview</h4>
                    <div>
                        <ul class="list-group mb-3 list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Justified Absence:</span><strong>2</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Non-Justified Absence:</span><strong>0</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Justified Tardy:</span><strong>3</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Non-Justified Tardy:</span><strong>0</strong>
                            </li>
                        </ul>
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
                                <canvas id="assignments_tech"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Another Chart Section -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Title for Another Chart -->
                            <h4 class="card-title text-primary"> Project Overview </h4>
                            <!-- Chart Container for Another Chart -->
                            <div class="chart-container">
                                <canvas id="barChart_3"></canvas>
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
                                    <div class="progress-bar bg-success" style="width: 100%;" role="progressbar"><span
                                            class="sr-only">100% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 20,2023</td>
                            <td><span class="badge bg-success">100%</span></td>
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
                                    <div class="progress-bar bg-warning" style="width: 50%;" role="progressbar"><span
                                            class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>Jul 1,2023</td>
                            <td><span class="badge bg-warning">50%</span>
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
// Assignments Bar Chart Initialization
if (document.getElementById('assignments_tech')) {

    const assignments_tech = document.getElementById("assignments_tech").getContext('2d');



    // Chart data
    let barChartData = {
        labels: ["HTML& CSS", "JS", "React", "NodeJS", "MongoDB", "PostgreSQL", "Wordpress"],
        datasets: [{
            label: 'Passed',
            backgroundColor: "rgba(43, 193, 85, 1)", // Green color
            hoverBackgroundColor: "rgba(43, 193, 85, 1)",
            data: [35, 33, 33, 34, 35, 34, 35]
        }, {
            label: 'Not Passed',
            backgroundColor: "rgba(243, 87, 87, 1)", // Red color
            hoverBackgroundColor: "rgba(243, 87, 87, 1)",
            data: [0, 2, 2, 1, 0, 1, 0]
        }]
    };

    // Chart options
    new Chart(assignments_tech, {
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
            data: [35, 33, 33, 34, 35, 34, 35]
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
</script>

@endsection