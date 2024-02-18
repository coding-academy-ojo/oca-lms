
@extends('Layouts.app')
@section('title')
Student Absence Report
@endsection

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('attendance')}}">Attendance</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absence Report</li>
    </ol>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-primary">Student Absence Report</h2>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-orange">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Duration</th>

                </tr>
            </thead>
            <tbody>
                <!-- Static Row Example -->
                <tr>
                    <td>2024-02-10</td>
                    <td>Medical Leave</td>
                    <td>3 Days</td>

                </tr>
                <tr>
                    <td>2024-01-25</td>
                    <td>Family Emergency</td>
                    <td>1 Day</td>

                </tr>
                <!-- Add more static rows as needed -->
            </tbody>
        </table>
    </div>
    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Back to Absence Record</a>
</div>

@endsection
