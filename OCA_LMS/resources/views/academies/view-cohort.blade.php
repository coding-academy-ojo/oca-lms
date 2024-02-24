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
                    <h4 class="mb-0 text-primary">Donor Information</h4>
                    <div class="my-3">
                        <h5 class="card-title">Cohort 1</h5>
                        <p class="card-text">A brief description about the cohort and its objectives.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Start Date: <strong>05 May 2024</strong></li>
                            <li class="list-group-item">End Date: <strong>05 May 2024</strong></li>
                            <li class="list-group-item">Donor: <strong>Simplon</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div style="height: 380px" class="card-body">
                    <h4 class="text-primary">Given Technologies</h4>
                    <canvas id="totalSummaryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-primary">Technologies Overview</h3>
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
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

    var ctx3 = document.getElementById('totalSummaryChart').getContext('2d');
    var totalSummaryChart = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['Remaining Enrolled', 'Remaining Graduates', 'Employed Graduates'],
            datasets: [{
                label: 'Summary',
                data: [689 - 551, 551 - 419, 419], 
                backgroundColor: [
                    '#e66c37',
                    '#eb895f',
                    '#ad5129'
                ],
               
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,

            cutout: '60%',
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            var total = context.dataset.data.reduce((previousValue, currentValue) => previousValue + currentValue, 0);
                            var currentValue = context.dataset.data[context.dataIndex];
                            var percentage = ((currentValue / total) * 100).toFixed(2);
                            label += currentValue + ' (' + percentage + '%)';
                            return label;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection