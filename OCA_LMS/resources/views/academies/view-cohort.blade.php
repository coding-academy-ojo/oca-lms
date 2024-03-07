@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{asset('assets/style_files/viewCohort.css')}}">
@section('title')
Amman Cohort 1
@endsection
@section('content')
    @include('layouts.innerNav')





<div class="container my-5">
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3>Number of Students</h3>
            <p>32</p>
        </div>
        <div class="dashboard-card">
            <h3>Number of Briefs</h3>
            <p>4</p>
        </div>
        <div class="dashboard-card">
            <h3>Total Assignments</h3>
            <p>13</p>
        </div>
        <div class="dashboard-card">
            <h3>Total Technologies</h3>
            <p>3</p>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-0 text-primary">Cohort Information</h3>
                    <div class="my-3">
                        <h5 class="card-title">Amman Cohort 1</h5>
                        <p class="card-text">This cohort aims to empower participants through intensive training in web development, focusing on both front-end and back-end technologies. With a curriculum designed to foster practical skills and real-world problem-solving abilities, our goal is to prepare students for successful careers in the tech industry.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Start Date: <strong>05 May 2024</strong></li>
                            <li class="list-group-item">End Date: <strong>18 Sep 2024</strong></li>
                            <li class="list-group-item">Donor: <strong>EU</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div style="height: 380px" class="card-body">
                    <h3 class="text-primary">Weekly Attendance Report</h3>
                    <canvas id="totalSummaryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-primary">Technologies Overview</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Resources</th>
                                    <th scope="col">Training Period</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>++
                                    <td>React</td>
                                    <td>A JavaScript library for building user interfaces.</td>
                                    <td>Official Docs, Tutorials</td>
                                    <td>1 Month</td>
                                    <td>
                                        <div style="width: 100%; background-color: #ddd;">
                                            <div style="height: 20px; width: 100%; background-color: #4CAF50;"></div>
                                        </div>
                                        Finished
                                    </td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal1">View Feedback</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>PHP</td>
                                    <td>A popular general-purpose scripting language.</td>
                                    <td>Official Docs, Laracasts</td>
                                    <td>2 Months</td>
                                    <td>
                                        <div style="width: 100%; background-color: #ddd;">
                                            <div style="height: 20px; width: 50%; background-color: #4CAF50;"></div>
                                        </div>
                                        In Progress
                                    </td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal2">View Feedback</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Laravel</td>
                                    <td>A PHP framework for web artisans.</td>
                                    <td>Official Docs, Laracasts</td>
                                    <td>2 Months</td>
                                    <td>
                                        <div style="width: 100%; background-color: #ddd;">
                                            <div style="height: 20px; width: 0%; background-color: #f44336;"></div>
                                        </div>
                                        Not Started
                                    </td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal3">View Feedback</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Feedback Modals with Progress Bars -->
    <div class="modal fade" id="feedbackModal1" tabindex="-1" aria-labelledby="feedbackModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="feedbackModalLabel1">React Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Very Good:</strong> 75%</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p><strong>Satisfied:</strong> 50%</p>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-3">Note: React has been well-received, with a majority of students finding it very beneficial.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Repeat modals for PHP and Laravel with respective ids: feedbackModal2 and feedbackModal3 -->
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-primary">Cohort Milestones</h3>
                    <p class="text-muted">May to September Cohort Progress</p>
                    <div class="timeline">
                        <div class="timeline-item completed">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5 class="mb-1">May - Introduction & Setup</h5>
                                <p>Getting started with basic setup, tools, and understanding the course outline.</p>
                            </div>
                        </div>
                        <div class="timeline-item completed">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5 class="mb-1">June - React</h5>
                                <p>Covering React fundamentals, building components, and state management.</p>
                            </div>
                        </div>
                        <div class="timeline-item active">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5 class="mb-1">July - PHP & Laravel</h5>
                                <p>Introduction to PHP, Laravel basics, and building a simple application.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5 class="mb-1">August - Advanced Laravel</h5>
                                <p>Diving deeper into Laravel, covering advanced topics and building a complex project.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5 class="mb-1">September - Capstone Project</h5>
                                <p>Applying all learned skills to develop a comprehensive project, presentations, and graduation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 18px;
            width: 4px;
            background: #e9ecef;
        }
        .timeline-item {
            margin-bottom: 20px;
            position: relative;
        }
        .timeline-marker {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 4px solid #fff;
            background-color: #6c757d; /* Default marker color */
            z-index: 1;
        }
        .timeline-item.completed .timeline-marker {
            background-color: #28a745; /* Completed marker color */
        }
        .timeline-item.active .timeline-marker {
            background-color: #007bff; /* Active marker color */
        }
        .timeline-content {
            margin-left: 60px;
            margin-top: -5px;
        }
        .timeline-content h5 {
            margin-top: 0;
        }
    </style>
    

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var ctx3 = document.getElementById('totalSummaryChart').getContext('2d');
    var totalSummaryChart = new Chart(ctx3, {
        type: 'bar', // Change to 'bar' for a bar chart
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], // Days of the week
            datasets: [{
                label: 'Attendance',
                data: [30, 28, 32, 31, 29], // Example attendance data
                backgroundColor: '#e66c37', // Blue, semi-transparent
                borderColor: '#e66c37', // Blue, solid
                borderWidth: 1
            }, {
                label: 'Absence',
                data: [], 
                backgroundColor: '#f3a17a',
                borderColor: '#f3a17a', 
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true, 
                },
                y: {
                    stacked: true,
                    beginAtZero: true, 
                }
            }
        }
    });

    totalSummaryChart.data.datasets[1].data = totalSummaryChart.data.datasets[0].data.map(attendance => 32 - attendance);
    totalSummaryChart.update(); // Update the chart to reflect new data
});
</script>

@endsection