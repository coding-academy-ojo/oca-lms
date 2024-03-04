<!-- resources/views/pages/announcements.blade.php -->
@extends('layouts.app')
@section('title')
Trainees Progress
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


@include('layouts.innerNav')
<section class="inner-bred my-5 ">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Trainees</a></li>

        </ul>
    </div>
</section>

<!-- Overview of the Trainees progress -->



<!------ Trainees Progress table ---------->
<div style="width:50%; margin: 0 auto;">
    <!-- Chart for trainee progress on Projects -->
    <div style="margin-bottom: 100px;">
        <canvas id="ProjectsProgressChart"></canvas>
    </div>

    <!-- Chart for trainee progress on assignments -->
    <div style="margin-bottom: 100px;">
        <canvas id="AssignmentsProgressChart"></canvas>
    </div>

    <!-- Chart for trainee attendance status -->
    <div>
        <canvas id="AttendanceChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart for trainee progress on Projects
    const projectsCtx = document.getElementById('ProjectsProgressChart');
    new Chart(projectsCtx, {
        type: 'bar',
        data: {
            labels: ['HTML', 'CSS', 'JS', 'React', 'NodeJs', 'PostgreSQL', 'MongoDB', 'Wordpress'],
            datasets: [{
                label: 'Percentage of Progress on Projects',
                data: [14, 16, 4, 9, 15, 7, 8, 5],
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


@endSection