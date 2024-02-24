{{-- resources/views/pages/studentProgressOverview.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Progress Overview')

@section('content')
<style>
    .progress-container {
        width: 100%; /* Ensures each progress bar container spans the full width of its cell */
    }
    .progress {
        height: 20px; /* Optional: Adjusts the height of the progress bars */
    }
</style>
<div class="container my-4">
    <h2 class="mb-4 text-primary">Student Progress Overview</h2>

    {{-- Projects Progress --}}
    <div class="mb-5">
        <h3 class="text-primary">Projects Progress</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Project Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Student A</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Student B</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                            </div>
                        </div>
                       
                    </td>
                </tr>
                <tr>
                    <td>Student C</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                            </div>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Masterpiece Progress --}}
{{-- Masterpiece Progress --}}
<div class="mb-5">
    <h3 class="text-primary">Masterpiece Progress</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Masterpiece Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Student A</td>
                <td>
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Student B</td>
                <td>

                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Student C</td>
                <td>


                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">95%</div>
                        </div>
                    </div>

           
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mb-5">
    <h3 class="text-primary">Tasks Progress</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Task Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Student A</td>
                <td>
                 
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                        </div>
                    </div>
                
                </td>
            </tr>
            <tr>
                <td>Student B</td>
                <td>
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                    </div>
             
                </td>
            </tr>
            <tr>
                <td>Student C</td>
                <td>

                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                        </div>
                    </div>
               
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mb-5">
    <h3 class="text-primary">Attendance Progress</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Attendance Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Student A</td>
                <td>
                    <div class="progress-container">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">95%</div>
                        </div>
                    </div>
              
                </td>
            </tr>
            <tr>
                <td>Student B</td>
                <td>
                    <div class="progress-container">

                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                    </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Student C</td>
                <td>
                    <div class="progress-container">

                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                    </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection
