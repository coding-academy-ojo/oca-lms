@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('title')
    Dashboard
@endsection
@section('content')
    @include('layouts.innerNav')


<style>
       .dashboard-cards {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin: 20px 0;
    }

    .dashboard-card {
        /* background-color: #FFA500; */
        /* color: white; */
        max-width: 373px;

        border: 2px solid #e66c37; /* Adjusted to a darker border for visibility */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        flex-grow: 1;
        margin: 10px;
        text-align: center;
        border-radius: 4px; /* Optional for rounded corners */
    }

    .dashboard-card h3 {
        margin: 0;
        padding: 0;
        font-size: 1.5rem;
    }

    .dashboard-card p {
        font-size: 2.5rem; 
        margin: 5px 0 15px; 
        font-weight: bold;
    }

    /* Adjustments for responsiveness */
    @media (max-width: 768px) {
        .dashboard-cards {
            flex-direction: column;
        }

        .dashboard-card {
            width: 100%;
        }
    }


    /* Adjust the styles for charts as needed */
    .chart-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: flex-start;
    }

    .chart-container-half {
        flex: 1 0 calc(50vh - 10px); /* flex grow | flex shrink | flex basis */
        height: 50vh;
        margin: 5px; /* Added some margin for spacing */
    }

    .chart-container-wide {
        flex: 0 0 calc(90vw - 10px); 
        height: 50vh;
        margin: 5px; 
    }

    /* Additional responsive styling if necessary */
    @media (max-width: 768px) {
        .chart-container-half,
        .chart-container-wide {
            width: 100%;
            flex-basis: 100%;
            height: auto;
        }
    }

    
 </style>

    <div class="container my-5">

        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3>Total Students Enrolled</h3>
                <p>689</p>
            </div>
            <div class="dashboard-card">
                <h3>Total Students Graduates</h3>
                <p>551</p>
            </div>
            <div class="dashboard-card">
                <h3>Number of Academies</h3>
                <p>6</p>
            </div>
        </div>
        <div class="chart-row">
            <div class="chart-container-half">
                <canvas id="graduatesByAcademy"></canvas>
            </div>
            <div class="chart-container-half">
                <canvas id="totalSummaryChart"></canvas>
            </div>
            <div class="chart-container-wide">
                <canvas id="academyPerformanceChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx1 = document.getElementById('graduatesByAcademy').getContext('2d');
            var graduatesByAcademyChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Amman', 'Data Science', 'Irbid', 'Zarqa', 'Balqa', 'Aqaba'],
                    datasets: [{
                        label: 'Sum of Total Graduates',
                        data: [199, 121, 70, 66, 49, 46],
                        backgroundColor: [
                            '#e66c37'
                        ],
                        borderColor: [
                            '#e66c37'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // After initializing graduatesByAcademyChart...

            // Number of Enrolled Students by Academy and Cohort
            var ctx = document.getElementById('academyPerformanceChart').getContext('2d');
    var academyPerformanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Amman', 'Data Science', 'Irbid', 'Zarqa', 'Aqaba', 'Balqa'],
            datasets: [
                {
                    label: 'Sum of Number of Enrolled Students',
                    data: [208, 121, 105, 102, 80, 73],
                    backgroundColor: '#ad5129',
                    borderColor: '#ad5129',
                    borderWidth: 1
                },
                {
                    label: 'Sum of Number of Graduates',
                    data: [199, 121, 70, 66, 46, 49],
                    backgroundColor: '#e66c37',
                    borderColor: '#e66c37',
                    borderWidth: 1
                },
                {
                    label: 'Sum of Number of Students has access to the market',
                    data: [174, 40, 74, 58, 35, 27],
                    backgroundColor: '#eb895f',
                    borderColor: '#eb895f',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: false,
                },
                y: {
                    stacked: false,
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var ctx3 = document.getElementById('totalSummaryChart').getContext('2d');
    var totalSummaryChart = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Remaining Enrolled', 'Remaining Graduates', 'Employed Graduates'],
            datasets: [{
                label: 'Summary',
                data: [689 - 551, 551 - 419, 419], // The data for the donut segments
                backgroundColor: [
                    '#e66c37',
                    '#eb895f',
                    '#ad5129'
                ],
               
                borderWidth: 1
            }]
        },
        options: {
            cutout: '60%', // This is the correct property in Chart.js version 3.x or later
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