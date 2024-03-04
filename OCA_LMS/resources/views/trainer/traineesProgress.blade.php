
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-primary">Trainees Progress General view</h2>
            </div>
        </div>
        <div class="row">
            <!-- Cards Section -->
            <div class="col-xl-6 col-lg-6 col-md-12"> <!-- Adjusted for 55% width -->
                <div class="row">
                    <!-- Total Students Card -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">Total Students</h4>
                                <h3>3280</h3>
                                <div class="progress mb-2">
                                    <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                                </div>
                                <small>80% Increase in 20 Days</small>
                            </div>
                        </div>
                    </div>
                    <!-- New Students Card -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">New Students</h4>
                                <h3>245</h3>
                                <div class="progress mb-2">
                                    <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                                </div>
                                <small>50% Increase in 25 Days</small>
                            </div>
                        </div>
                    </div>
                    <!-- Total Course Card -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">Total Course</h4>
                                <canvas id="doughnut_chart_1"></canvas>
                                <small>76% Increase in 20 Days</small>
                            </div>
                        </div>
                    </div>
                    <!-- Fees Collection Card -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="widget-stat card">
                            <div class="card-body">
                                <h4 class="card-title">Fees Collection</h4>
                                <canvas id="doughnut_chart_2"></canvas>
                                <small>30% Increase in 30 Days</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart Section -->
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card mb-4"> <!-- Line Chart Card -->
                    <div class="card-body">
                        <canvas id="lineChart_2"></canvas>
                    </div>
                </div>
                <div class="card"> <!-- Stacked Bar Chart Card -->
                    <div class="card-body">
                        <canvas id="barChart_3"></canvas>
                    </div>
                </div>
            </div>
        </div>
    

          <div class="row">
            <div class="col-md-12">
                <div class="widget blank no-padding">
                    <div class="panel panel-default work-progress-table">
                    </div>
                    <div class="table-responsive"> <!-- Add this wrapper -->
                        <table id="mytable" class="table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall" /></th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Name
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item" type="button">Action</button>
                                            <button class="dropdown-item" type="button">Another action</button>
                                            <button class="dropdown-item" type="button">Something else here</button>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Skill
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item" type="button">S1 - Create mock-ups for an
                                                application</button>
                                            <button class="dropdown-item" type="button">S2 - Create static and adaptive web
                                                user interfaces</button>
                                            <button class="dropdown-item" type="button">S3 - Develop a dynamic web user
                                                interface</button>
                                            <button class="dropdown-item" type="button">S4 - Create a user interface with a
                                                content management</button>
                                            <button class="dropdown-item" type="button">S5 - Create a database</button>
                                            <button class="dropdown-item" type="button">S6 - Develop data access
                                                components</button>
                                            <button class="dropdown-item" type="button">S7 - Develop the back end</button>
                                            <button class="dropdown-item" type="button">S8 - Create and implement
                                                components</button>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Level
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item" type="button">Level 1 - Imitate</button>
                                            <button class="dropdown-item" type="button">Level 2 - Adapt </button>
                                            <button class="dropdown-item" type="button">Level 3 - Transpose </button>
                                        </div>
                                    </div>
                                </th>
                                <th style="width:50% ">Progress</th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item" type="button">Pending</button>
                                            <button class="dropdown-item" type="button">Reviewed</button>
                                        </div>
                                    </div>
                                </th>
                                <th>Student Progress</td>

                            </tr>
                            
                        </thead>

                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Mohsin</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="60" role="progressbar" class="red progress-bar">
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-info">Pending</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Haseeb</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 80%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="80" role="progressbar" class="green progress-bar">
                                            <span>80%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-primary">Reviewed</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Hussain</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="40" role="progressbar" class="purple progress-bar">
                                            <span>40%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-warning">Reviewed </span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Noman</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="90" role="progressbar" class="purple progress-bar">
                                            <span>90%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-success">Reviewed</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Ubaid</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="60" role="progressbar" class="red progress-bar">
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-warning">Reviewed</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Adnan</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 45%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="45" role="progressbar" class="red progress-bar">
                                            <span>45%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-warning">Reviewed</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>

                            </tr>

                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>Saboor</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <div class="progress">
                                        <div style="width: 89%;" aria-valuemax="100" aria-valuemin="0"
                                            aria-valuenow="89" role="progressbar" class="green progress-bar">
                                            <span>89%</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="label label-warning">Reviewed</span></td>
                                <td><a href="{{route('trainee-progress-details')}}" class="btn btn-primary">View</a></td>
                            </tr>

                   
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Line Chart Initialization
    if (document.getElementById('lineChart_2')) {
        var lineChart_2 = document.getElementById('lineChart_2').getContext('2d');
        var lineChart_2gradientStroke = lineChart_2.createLinearGradient(500, 0, 100, 0);
        lineChart_2gradientStroke.addColorStop(0, "rgba(102, 115, 253, 1)");
        lineChart_2gradientStroke.addColorStop(1, "rgba(102, 115, 253, 0.5)");

        new Chart(lineChart_2, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    label: "Trainees Progress",
                    data: [25, 20, 60, 41, 66, 45, 80],
                    borderColor: lineChart_2gradientStroke,
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    pointBackgroundColor: 'rgba(102, 115, 253, 0.5)'
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
    if (document.getElementById('doughnut_chart_1')) {
        var doughnutChart1 = new Chart(document.getElementById('doughnut_chart_1'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [45, 25, 30],
                    backgroundColor: [
                        "rgba(102, 115, 253, 1)",
                        "rgba(43, 193, 85, 1)",
                        "rgba(243, 87, 87, 1)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(102, 115, 253, 0.9)",
                        "rgba(43, 193, 85, .9)",
                        "rgba(243, 87, 87, .9)"
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
    if (document.getElementById('doughnut_chart_2')) {
        var doughnutChart2 = new Chart(document.getElementById('doughnut_chart_2'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [20, 40, 40],
                    backgroundColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(255, 99, 132, 0.9)",
                        "rgba(54, 162, 235, 0.9)",
                        "rgba(255, 206, 86, 0.9)"
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
        labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Dataset 1',
            backgroundColor: barChart_3gradientStroke1,
            hoverBackgroundColor: barChart_3gradientStroke1,
            data: [12, 19, 3, 5, 2, 3, 9]
        }, {
            label: 'Dataset 2',
            backgroundColor: barChart_3gradientStroke2,
            hoverBackgroundColor: barChart_3gradientStroke2,
            data: [2, 3, 20, 5, 1, 4, 2]
        }, {
            label: 'Dataset 3',
            backgroundColor: barChart_3gradientStroke3,
            hoverBackgroundColor: barChart_3gradientStroke3,
            data: [3, 10, 13, 15, 22, 30, 40]
        }]
    };

    // Chart options
    new Chart(barChart_3, {
        type: 'bar',
        data: barChartData,
        options: {
            scales: {
                xAxes: [{ stacked: true }],
                yAxes: [{ stacked: true }]
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
>>>>>>> abefbacf6eaf7c562abf505085ac3ea8fef8247c

    // Chart for trainee progress on assignments
    const assignmentsCtx = document.getElementById('AssignmentsProgressChart');
    new Chart(assignmentsCtx, {
        type: 'bar',
        data: {
            labels: ['HTML', 'CSS', 'JS', 'React', 'NodeJs', 'PostgreSQL', 'MongoDB', 'Wordpress'],
            datasets: [{
                label: 'Percentage of Trainee Progress on assignments',
                data: [14, 16, 7, 8, 5, 4, 9, 15],
                borderWidth: 1,
                borderColor: '#36C10EB',
                backgroundColor: '#ff7900'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for trainee attendance status
    const attendanceCtx = document.getElementById('AttendanceChart');
    
    new Chart(attendanceCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Trainee attendance status',
                data: [14, 16, 7, 8, 5, 4, 9, 15],
                borderWidth: 1,
                borderColor: '#36C10EB',
                backgroundColor: '#ff7900'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


});


    </script>
    

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endSection
