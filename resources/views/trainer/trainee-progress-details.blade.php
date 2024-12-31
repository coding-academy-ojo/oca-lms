@extends('Layouts.app')

@section('title', 'Student Progress Overview')

@section('content')
@include('Layouts.innerNav')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/orange-boosted/dist/css/orangeboosted.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="inner-bred my-5">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a style="color:#F16E00" href="/traineesProgress"> Student Progress Overview</a></li>

        </ul>
    </div>
</section>

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

                        <h3 class="mt-4 mb-1">{{$student->en_first_name}} {{$student->en_last_name}}</h3>
                        <p class="text-muted"> {{$student->educational_background}}</p>
                        <p class="text-muted"> Certificate Type: {{$student->certificate_type}}</p>
                        <p class="text-muted"> Internship Status: {{ $student->internship_status ? 'Interned' : 'Not Interned' }} </p>
                        <ul class="list-group mb-3 list-group-flush">
                            
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Student no.</span><strong>{{$student->id}}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Phone No. :</span><strong>{{$student->mobile}}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Admission Date. :</span><strong>01 July 2023</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Email:</span><strong>{{$student->email}}</strong>
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
                                <span>Justified Absence:</span><strong>{{$absencesCount}}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Non-Justified
                                    Absence:</span><strong>{{$nonJustifiedAbsencesCount}}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Justified Tardy:</span><strong>{{$lateCount}}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="mb-0">Non-Justified
                                    Tardy:</span><strong>{{$nonJustifiedLateCount}}</strong>
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



<!-- Students Assignments review History Section -->
<div class="container my-4">
    <h2 class="text-primary">{{$student->en_first_name}}'s Assignments History</h2>
    <div class="card">
        <div class="card-body">

            <div class="table-container" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Assignment</th>
                            <th scope="col">Submission Status</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentAssignments as $assignment)
                        @if ($assignment->submissionStatus === 'No Assignments Assigned')
                        <tr>
                            <td colspan="5" class="text-center text-primary">No Assignments are assigned for
                                {{$student->en_first_name}}</td>
                        </tr>
                        @else
                        <tr>
                            <th scope="row">{{ $assignment->id }}</th>
                            <td>{{ $assignment->assignment_name }}</td>
                            <td>{{ $assignment->submissionStatus }}</td>
                            <td>{{ $assignment->dueDate }} <Span
                                    style="color: {{ $assignment->isLate === 'Late' ? 'red' : 'inherit' }}">{{ $assignment->isLate }}</Span>
                            </td>
                            <td><a href="{{ route('assignment.show', $assignment->id) }}">Details</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<!-- Students Projects History Section -->
<div class="container my-4">
    <h2 class="text-primary">{{ $student->en_first_name }}'s Projects History</h2>
    <div class="card">
        <div class="card-body">
            @if (!empty($studentProjects))
                @if (count($studentProjects) > 0)
                    <div class="table-container" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: auto;">Due Date</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Submission Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentProjects as $index => $project)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $project['due_date'] }}</td>
                                        <td>{{ $project['project_name'] }}</td>
                                        <td>{{ $project['status'] }}</td>
                                        <td>{{ $project['submission_date'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                <tr>
                    <td colspan="5" class="text-center text-primary">No projects found.</td>
                </tr>
                  
                @endif
            @else
            <tr>
                <td colspan="5" class="text-center text-primary">No data available.</td>
            </tr>
            @endif
        </div>
    </div>
</div>


<!-- Project details History Modal -->
<div class="modal fade" id="feedbackModal3" tabindex="-1" aria-labelledby="feedbackModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="feedbackModalLabel3">JS Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Corrective Action</th>
                            <th scope="col">File</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>ToDo App</td>
                            <td>
                                <div>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#feedbackModal3">Details</a>
                                </div>
                            </td>
                            <td>10/3/2024</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Read more in Object oriented</td>
                            <td>
                                <div>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#feedbackModal3">Details</a>
                                </div>
                            </td>
                            <td>14/3/2024</td>
                        </tr>
                        <tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>




<div class="container my-4">
    <h2 class="mb-4 text-primary">Masterpiece Progress</h2>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table verticle-middle table-responsive-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasksWithProgress as $task)
                        <tr>
                            <td>{{ $task['task_name'] }}</td>
                            <td>
                                <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                    @php
                                        $progressColor = 'bg-success'; // Default to green
                                        if ($task['progress'] < 25) {
                                            $progressColor = 'bg-danger'; // Red
                                        } elseif ($task['progress'] >= 25 && $task['progress'] < 75) {
                                            $progressColor = 'bg-warning'; // Orange
                                        }
                                    @endphp
                                    <div class="progress-bar {{ $progressColor }}" 
                                         style="width: {{ $task['progress'] }}%;" 
                                         role="progressbar" 
                                         data-toggle="tooltip" 
                                         data-placement="top" 
                                         title="{{ $task['progress'] }}%">
                                        {{ $task['progress'] }}%<span class="sr-only">{{ $task['progress'] }}% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $task['task_deadline'] }}</td>
                            <td>{{ $task['notes'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>






<script>
// All Assignments Bar Chart Initialization
if (document.getElementById('assignments_tech')) {

    const assignments_tech = document.getElementById("assignments_tech").getContext('2d');
    // Define your labels using the technologyNames array
    let labels = <?php echo json_encode($technologyNames); ?>;

    // Chart data
    let barChartData = {
        labels: labels,
        datasets: [{
            label: 'Passed',
            backgroundColor: "rgba(43, 193, 85, 1)", // Green color
            hoverBackgroundColor: "rgba(43, 193, 85, 1)",
            data: <?php echo json_encode($countValues); ?>
        }, {
            label: 'Not Passed',
            backgroundColor: "rgba(243, 87, 87, 1)", // Red color
            hoverBackgroundColor: "rgba(243, 87, 87, 1)",
            data: [0, 0, 0, 0, 0, 0, 0]
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

// All Projects status Bar Chart Initialization
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('barChart_3')) {
        const barChart_3 = document.getElementById("barChart_3").getContext('2d');

        // Assuming studentProjects is available in the global scope or passed to the view
        let labels = [];
        let passedData = [];
        let failedData = [];

        @foreach ($studentProjects as $project)
            labels.push("{{ $project['project_name'] }}");
            if ("{{ $project['status'] }}" === 'Passed') {
                passedData.push(100);
                failedData.push(0);
            } else {
                passedData.push(0);
                failedData.push(100);
            }
        @endforeach

        let barChartData = {
            labels: labels,
            datasets: [{
                label: 'Passed',
                backgroundColor: "rgba(43, 193, 85, 1)", // Green color
                hoverBackgroundColor: "rgba(43, 193, 85, 1)",
                data: passedData
            }, {
                label: 'Failed',
                backgroundColor: "rgba(243, 87, 87, 1)", // Red color
                hoverBackgroundColor: "rgba(243, 87, 87, 1)",
                data: failedData
            }]
        };

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

</script>

@endsection