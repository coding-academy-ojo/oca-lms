@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{asset('assets/style_files/viewCohort.css')}}">
@section('title')
{{ $cohort->cohort_name }}
@endsection
@section('content')
    @include('layouts.innerNav')





<div class="container my-5">
    <div class="d-flex  flex-wrap dashboard-cards">
        <div class="dashboard-card">
            <h3>Number of Students</h3>
            <p>{{ $cardsStatistics['statistics']['Number_of_Students'] }}</p>
        </div>
        <div class="dashboard-card">
            <h3>Number of Briefs</h3>
            <p>{{ $cardsStatistics['statistics']['Number_of_Briefs'] }}</p>
        </div>
        <div class="dashboard-card">
            <h3>Total Assignments</h3>
            <p>{{ $cardsStatistics['statistics']['Total_Assignments'] }}</p>
        </div>
        <div class="dashboard-card">
            <h3>Total Technologies</h3>
            <p>{{ $cardsStatistics['statistics']['Total_Technologies'] }}</p>
        </div>
    </div>
    


    <div class="row mt-4">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex w-100 justify-content-between">
                        <h3 class="mb-0 text-primary">Cohort Information</h3>
                        <a href="{{ route('import-data.index', ['id' => $cohort->id]) }}" class="btn btn-info">Import Data</a>
                    </div>
                    <div class="my-3">
                        @if($cardsStatistics['cohort'])
                            <h5 class="card-title">{{ $cardsStatistics['cohort']->cohort_name }}</h5>
                            <p class="card-text">{{ $cardsStatistics['cohort']->cohort_description }}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Start Date: <strong>{{ $cardsStatistics['cohort']->cohort_start_date }}</strong></li>
                                <li class="list-group-item">End Date: <strong>{{ $cardsStatistics['cohort']->cohort_end_date }}</strong></li>
                                <li class="list-group-item">Donor: <strong>{{ $cardsStatistics['cohort']->cohort_donor }}</strong></li>
                            </ul>
                        @else
                            <p>No running cohort found.</p>
                        @endif
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
                                    {{-- <th scope="col">Description</th> --}}
                                    <th scope="col">Resources</th>
                                    <th scope="col">Training Period</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">Satisfaction</th> --}}
                                    {{-- <th scope="col">Feedback</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($technologiesOverview) === 0)
                                <tr>
                                    <td colspan="7">No technologies added yet</td>
                                </tr>
                                @else
                                @foreach($technologiesOverview as $index => $technology)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $technology['name'] }}</td>
                                    {{-- <td>{{ $technology['description'] }}</td> --}}
                                    <td>{{ $technology['resources'] }}</td>
                                    <td>{{ $technology['training_period'] }}</td>
                                    <td>
                                        <div style="width: 100%; background-color: #ddd;">
                                            <div style="height: 20px; width: {{ $technology['percentage'] }}%; background-color: {{ $technology['status'] == 'Finished' ? '#4CAF50' : ($technology['status'] == 'In Progress' ? '#ffa500' : '#f44336') }};"></div>
                                        </div>
                                        {{ $technology['status'] }}
                                    </td>
                                    {{-- <td class="justify-content-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $index + 1 }}"><span class="material-symbols-outlined">
                                            open_in_new
                                            </span></button>
                                    </td> --}}
                                       {{-- <div class="satisfaction-container" style="width: 100px; background-color: #f0f0f0;border-radius: 5px;">
                                            <div class="satisfaction-bar" style="width:100%; background-color: #4CAF50;" style="height: 100%; transition: width 0.5s ease-in-out;"></div>
                                        </div> --}}

                                </tr>
                                @endforeach
                                @endif
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
                    <h3 class="text-primary">Softskills Overview</h3>
                    <div class="table-responsive">
                        @if(count($softSkillsForCohort) > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    {{-- <th scope="col">Description</th> --}}
                                    <th scope="col">Trainer</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Satisfaction</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($softSkillsForCohort as $index => $softSkill)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $softSkill->name }}</td>
                                    {{-- <td>{{ $softSkill->description }}</td> --}}
                                    <td>{{ $softSkill->trainer }}</td>
                                    <td>{{ $softSkill->date }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px; background-color: #f0f0f0; border-radius: 5px;">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ $softSkill->satisfaction }}%; 
                                                       background-color: {{ $softSkill->satisfaction < 80 ? '#FFD700' : '#499557' }}; 
                                                       color: black; 
                                                       display: flex; 
                                                       align-items: center; 
                                                       justify-content: center;">
                                                {{ $softSkill->satisfaction }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        @else
                        <p>No soft skills data available for this cohort.</p>
                        @endif
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
            <div id="cohort-milestone" class="card shadow-sm">
                <h2 id="cohort-milestone-heading" style="text-align:start" class="my-4 mx-3 h3 text-primary">Cohort Milestone</h2>
                <ul id="cohort-milestone-list">
                    @foreach($milestoneOverview as $index => $milestone)
                    @php
                        // Determine color based on the percentage
                        $color = '#FF0000'; 
                        if ($milestone['percentage'] > 0 && $milestone['percentage'] < 100) {
                            $color = '#ffa500'; // Orange color for in-progress
                        } elseif ($milestone['percentage'] >= 100) {
                            $color = '#4CAF50'; // Green color for completed
                        }
                    @endphp
                    <li style="--accent-color: {{ $color }}">
                        <div class="date">{{ $milestone['name'] }}</div>
                        <div class="title h4">{{ $milestone['start_date'] }}</div>
                        {{-- <div class="descr">{{ $milestone['description'] }}</div> --}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    
    
    
    

    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart data and options can be customized as needed
        var ctxTime = document.getElementById('softSkillsDevelopmentChart').getContext('2d');
        var softSkillsTimeChart = new Chart(ctxTime, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Development Over Time',
                    data: [60, 65, 70, 75, 80, 85],
                    fill: false,
                    borderColor: 'rgba(255, 165, 0, 1)',
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    tension: 0.1
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
    
        var ctxSubject = document.getElementById('softSkillsBySubjectChart').getContext('2d');
        var softSkillsSubjectChart = new Chart(ctxSubject, {
            type: 'line',
            data: {
                labels: ['Communication', 'Teamwork', 'Problem-solving', 'Leadership', 'Work Ethic', 'Creativity'],
                datasets: [{
                    label: 'Development by Subject',
                    data: [65, 59, 70, 80, 75, 85],
                    fill: false,
                    borderColor: 'rgba(255, 140, 0, 1)',
                    backgroundColor: 'rgba(255, 140, 0, 0.2)',
                    tension: 0.1
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
    });
    </script>
    
    

    

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx3 = document.getElementById('totalSummaryChart').getContext('2d');
        var totalSummaryChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($attendanceOverview['attendance_data'])) !!},
                datasets: [{
                    label: 'Attendance',
                    data: {!! json_encode(array_values($attendanceOverview['attendance_data'])) !!},
                    backgroundColor: '#e66c37',
                    borderColor: '#e66c37',
                    borderWidth: 1
                }, {
                    label: 'Late',
                    data: {!! json_encode(array_values($attendanceOverview['late_data'])) !!},
                    backgroundColor: '#ffa500', // Orange color for late students
                    borderColor: '#ffa500',
                    borderWidth: 1
                }, {
                    label: 'Absence',
                    data: {!! json_encode(array_values($attendanceOverview['absence_data'])) !!},
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
    });
</script>


@endsection