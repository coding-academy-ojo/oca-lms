@extends('Layouts.app')
@section('title')
Student Absence Report
@endsection

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('absence')}}">Absence</a></li>
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
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead class="table-orange">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->absences as $index => $absence)
                <tr>
                    <td>{{ $absence->absences_date }}</td>
                    <td>{{ $absence->absences_type }}</td>
                    <td>{{ $absence->absences_reason }}</td>
                    <td>{{ $absence->absences_duration }} Hours</td>
                    <td>
                        @if ($absence->file_path)
                            <a href="{{ route('absence.download', ['absence_id' => $absence->id]) }}">Download Report</a>
                        @else
                            No report uploaded
                        @endif
                    </td>
                    <td>
                        <form class="d-flex gap-2" action="{{ route('absence.upload', ['absence_id' => $absence->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="file-input-{{ $index }}" class="btn btn-secondary">
                                <span class="material-symbols-outlined">upload_file</span> Upload Report
                            </label>
                            <input id="file-input-{{ $index }}" type="file" name="report_file" style="display: none;" onchange="showSubmitButton(this, {{ $index }})">
                            <button type="submit" id="submit-button-{{ $index }}" class="btn btn-secondary" style="display: none;">
                                Save
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <a href="{{route('absence')}}" class="btn btn-secondary mt-3" style="margin-bottom: 50px">Back to Absence Record</a>
</div>

<script>
    function showSubmitButton(input, index) {
        var submitButton = document.getElementById("submit-button-" + index);
        if (input.files && input.files[0]) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    }
</script>

@endsection
