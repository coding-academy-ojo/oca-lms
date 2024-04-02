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
    <h2 class="mb-4 text-primary">Student Absence Report - {{ $student->en_first_name }} {{ $student->en_last_name }}</h2>
    @if ($student->absences->isEmpty())
        <div class="alert alert-info" role="alert">
            No absence records found for this student.
        </div>
    @else
    <div class="table-responsive">
        <table class="table">
            <thead class="table-orange">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->absences as $absence)
                <tr>
                    <td>{{ $absence->absences_date }}</td>
                    <td>{{ $absence->absences_type }}</td> <!-- Display whether it was late or absent -->
                    <td>{{ $absence->absences_reason }}</td>
                    <td>{{ $absence->absences_duration }} Hours</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <a href="javascript:history.back()" class="btn btn-secondary mt-3" style="margin-bottom: 50px">Back to Absence Record</a>
</div>

@endsection
