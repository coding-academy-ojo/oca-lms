{{-- resources/views/pages/studentProgressOverview.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Progress Overview')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/orange-boosted/dist/css/orangeboosted.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Projects Progress Section -->
<div class="container my-4">
    <h2 class="mb-4">Projects Progress</h2>
    <canvas id="projectsProgressChart"></canvas>
</div>

<script>
const projectsProgressData = {
    labels: ['Student A', 'Student B', 'Student C'],
    datasets: [
        {
            label: 'Assigned Projects',
            data: [10, 8, 12],
            backgroundColor: 'orange'
        },
        {
            label: 'Done Projects',
            data: [7, 6, 9],
            backgroundColor: 'green'
        },
        {
            label: 'Late Projects',
            data: [1, 2, 1],
            backgroundColor: 'red'
        }
    ]
};

const ctxProjects = document.getElementById('projectsProgressChart').getContext('2d');
const projectsProgressChart = new Chart(ctxProjects, {
    type: 'bar',
    data: projectsProgressData,
    options: {
        scales: {
            x: {
                stacked: true
            },
            y: {
                stacked: true
            }
        }
    }
});
</script>
<!-- Trainees Attendance Section -->
<div class="container my-4">
    <h2 class="mb-4">Trainees Attendance</h2>
    <canvas id="attendanceChart"></canvas>
</div>

<script>
const attendanceData = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [{
        label: 'Attendance Rate',
        data: [75, 80, 90, 85],
        fill: false,
        borderColor: 'blue',
        tension: 0.1
    }]
};

const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
const attendanceChart = new Chart(ctxAttendance, {
    type: 'line',
    data: attendanceData,
});
</script>
<!-- Tasks Progress Section -->
<div class="container my-4">
    <h2 class="mb-4">Tasks Progress</h2>
    <canvas id="tasksProgressChart"></canvas>
</div>

<script>
const tasksProgressData = {
    labels: ['Student A', 'Student B', 'Student C'],
    datasets: [
        {
            label: 'Grouped Tasks',
            data: [15, 10, 20],
            backgroundColor: 'purple'
        },
        {
            label: 'Single Tasks',
            data: [20, 25, 15],
            backgroundColor: 'grey'
        }
    ]
};

const ctxTasks = document.getElementById('tasksProgressChart').getContext('2d');
const tasksProgressChart = new Chart(ctxTasks, {
    type: 'bar',
    data: tasksProgressData,
});
</script>
<!-- Masterpiece Progress Section -->
<div class="container my-4">
    <h2 class="mb-4">Masterpiece Progress</h2>
    <div id="masterpieceProgress">
        <!-- Student A Progress -->
        <h3>Student A</h3>
        <label for="htmlProgressA">HTML Progress</label>
        <div class="progress mb-2">
            <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
        </div>
        <label for="backendProgressA">Backend Progress</label>
        <div class="progress mb-2">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>

        <!-- Repeat for other students -->
    </div>
</div>

@endsection
