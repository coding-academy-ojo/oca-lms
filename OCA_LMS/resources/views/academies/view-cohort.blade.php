@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{asset('assets/style_files/viewCohort.css')}}">
@section('title')
Cohort 1
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
            <h3>Total Topics</h3>
            <p>13</p>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-0 text-primary">Donor Information</h3>
                    <div class="my-3">
                        <h5 class="card-title">Cohort 1</h5>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>React</td>
                                    <td>A JavaScript library for building user interfaces.</td>
                                    <td>Official Docs, Tutorials</td>
                                    <td>1 Month</td>
                            
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>PHP</td>
                                    <td>A PHP framework for web artisans.</td>
                                    <td>Official Docs, Laracasts</td>
                                    <td>2 Months</td>
                           
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Laravel</td>
                                    <td>A PHP framework for web artisans.</td>
                                    <td>Official Docs, Laracasts</td>
                                    <td>2 Months</td>
                           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-primary">Weekly Projects Overview</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Week</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Assigned To</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Week 1</td>
                                <td>Portfolio Website</td>
                                <td>Design and develop a personal portfolio website.</td>
                                <td>Group 1</td>
                                <td>
                                    <div style="width: 100%; background-color: #ddd;">
                                        <div style="height: 20px; width: 50%; background-color: #4CAF50;"></div>
                                    </div>
                                    In Progress
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Week 2</td>
                                <td>Blog Platform</td>
                                <td>Develop a simple blog platform using Laravel.</td>
                                <td>Group 2</td>
                                <td>
                                    <div style="width: 100%; background-color: #ddd;">
                                        <div style="height: 20px; width: 0%; background-color: #f44336;"></div>
                                    </div>
                                    Not Started
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Week 3</td>
                                <td>E-commerce Site</td>
                                <td>Build a basic e-commerce site with a shopping cart.</td>
                                <td>Group 3</td>
                                <td>
                                    <div style="width: 100%; background-color: #ddd;">
                                        <div style="height: 20px; width: 100%; background-color: #4CAF50;"></div>
                                    </div>
                                    Finished
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
                data: [], // To be calculated
                backgroundColor: '#f3a17a', // Red, semi-transparent
                borderColor: '#f3a17a', // Red, solid
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true, // Enable stacked bars
                },
                y: {
                    stacked: true, // Enable stacked bars
                    beginAtZero: true, // Start the y-axis at 0
                }
            }
        }
    });

    // Calculate absence data based on attendance data
    totalSummaryChart.data.datasets[1].data = totalSummaryChart.data.datasets[0].data.map(attendance => 32 - attendance);
    totalSummaryChart.update(); // Update the chart to reflect new data
});
</script>

@endsection