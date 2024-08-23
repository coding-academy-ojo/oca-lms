@extends('Layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('title')
Academies Cohorts Overview
@endsection
@section('content')
    @include('Layouts.innerNav')


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

            border: 2px solid #e66c37;
            /* Adjusted to a darker border for visibility */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex-grow: 1;
            margin: 10px;
            text-align: center;
            border-radius: 4px;
            /* Optional for rounded corners */
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

        @media (max-width: 768px) {

            /* Specific adjustment for academyPerformanceChart */
            #academy-chart-container {
                height: 300px;
                /* Fixed height */
            }
        }

        @media (max-width: 768px) {

            /* Targeting only the specific chart container */
            .chart-row .chart-container-half {
                height: 300px;
                /* Fixed height */
            }
        }


        /* Adjust the styles for charts as needed */
        .chart-row {
            gap: 75px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
        }


        .chart-container-half {
    flex: 1 1 45%; /* Allows each chart to take up roughly half of the container's width */
    max-width: 100%;
    height: 300px; /* Fixed height, adjust as needed */
    margin: 5px;
    box-sizing: border-box;
}

.chart-container-wide {
    flex: 1 1 90%;
    max-width: 100%;
    height: 300px; /* Fixed height, adjust as needed */
    margin: 5px;
    box-sizing: border-box;
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

        .card-custom {
            background-color: #ffffff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-radius: 0.5rem;
            padding: 20px;
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .card-filter-group {
            display: flex;
            gap: 0.5rem;
        }

        .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-header-custom {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-filter-group {
                width: 100%;
                justify-content: space-between;
                margin-top: 0.5rem;
            }
        }
    </style>
    {{-- <div class="container my-5">
    <div class="row">
        <!-- Filter Card -->
        <div class="col-12">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div>
                        <h5 class="card-title m-0">Filters</h5>
                    </div>
                    <div class="card-filter-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="academyFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Academy
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="academyFilterDropdown">
                                <li><a class="dropdown-item" href="#">Amman</a></li>
                                <li><a class="dropdown-item" href="#">Data Science</a></li>
                                <li><a class="dropdown-item" href="#">Irbid</a></li>
                                <li><a class="dropdown-item" href="#">Zarqa</a></li>
                                <li><a class="dropdown-item" href="#">Balqa</a></li>
                                <li><a class="dropdown-item" href="#">Aqaba</a></li>
                        </div>
                        <button class="btn btn-primary" id="showAll">Show All</button>
                        <button class="btn btn-outline-success" id="topPerformers">Top Performers</button>
                        <button class="btn btn-outline-danger" id="needsAttention">Needs Attention</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="container my-5">

        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h3>Total Students Enrolled</h3>
                <p>{{ $dashboardCardsData['totalStudentsEnrolled'] }}</p>
            </div>
            <div class="dashboard-card">
                <h3>Total Students Graduates</h3>
                <p>{{ $dashboardCardsData['totalStudentsGraduated'] }}</p>
            </div>
            <div class="dashboard-card">
                <h3>Number of Academies</h3>
                <p>{{ $dashboardCardsData['totalAcademies'] }}</p>
            </div>

        </div>
        <div class="container my-5 chart-row">

            <div class="chart-container-half">
                <h3 class="text-primary">Enrolled Students Overview</h3>
                <canvas id="graduatesByAcademy"></canvas>
            </div>

            <div class="chart-container-half">
                <h3 class="text-primary">Graduated Students Overview</h3>
                <canvas  id="totalSummaryChart"></canvas>

            </div>
        </div>
        <div class="container my-5 chart-row">
            <div class="chart-container-half" id="academy-chart-container">
                <h3 class="text-primary">Cohorts Per Academy Overview</h3>
                <canvas id="academyPerformanceChart"></canvas>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var graduatesByAcademyData = @json($graduatesByAcademyData);

            var ctx1 = document.getElementById('graduatesByAcademy').getContext('2d');
            var graduatesByAcademyChart = new Chart(ctx1, {
                type: 'bar',
                data: graduatesByAcademyData,
                options: {
                    plugins: {
                        legend: {
                            display: false // Hides the legend
                        },
                        tooltip: {
                            enabled: true // Hides the tooltips
                        }
                    },
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // After initializing graduatesByAcademyChart...

            // Number of Enrolled Students by Academy and Cohort
            var academyPerformanceChartData = @json($academyPerformanceChartData);

            var ctx = document.getElementById('academyPerformanceChart').getContext('2d');
            var academyPerformanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: academyPerformanceChartData.labels,
                    datasets: academyPerformanceChartData.datasets
                },
                options: {
                    plugins: {
                        legend: {
                            display: false // Hides the legend
                        },
                        tooltip: {
                            enabled: true // Hides the tooltips
                        }
                    },
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
                    // width: 600,
                    // height: 200
                }
            });


            var totalSummaryChartData = @json($totalSummaryChartData);

            var ctx3 = document.getElementById('totalSummaryChart').getContext('2d');
            var totalSummaryChart = new Chart(ctx3, {
                type: 'bar', // Change type to 'bar'
                data: {
                    labels: totalSummaryChartData.labels, // Use existing labels
                    datasets: totalSummaryChartData.datasets // Use existing datasets
                },
                options: {
                  
                    indexAxis: 'y', // Horizontal bars (set to 'x' for vertical bars)
                    scales: {
            x: {
                stacked: true,
                barPercentage: 0.8, // Adjust this to control the width of bars relative to the category
                categoryPercentage: 0.9 // Example: adjust this value to control the width
            },
            y: {
                stacked: true
            }
        },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    var value = context.raw; // Get the value of the bar
                                    var total = context.dataset.data.reduce((a, b) => a + b,
                                    0); // Total for percentage calculation
                                    var percentage = ((value / total) * 100).toFixed(2);
                                    label += value + ' (' + percentage + '%)';
                                    return label;
                                }
                            }
                        },
                        legend: {
                            display: false // Display the legend if needed
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                    
                }
            });


        });
    </script>
@endsection
