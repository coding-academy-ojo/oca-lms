@extends('Layouts.app')
@section('title')
Student Absence Report
@endsection

@section('content')

@include('Layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academyview') }}">{{ $student->cohort->cohort_name ?? 'Cohort' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('absence')}}">Absence</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absence Report</li>
    </ol>
</nav>

<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Student Absence Report - {{ $student->en_first_name }} {{ $student->en_last_name }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('absence.export.pdf', ['studentId' => $student->id]) }}" 
               class="btn btn-primary d-flex align-items-center gap-2">
                <span class="material-symbols-outlined">picture_as_pdf</span>
                Export PDF
            </a>
        </div>
    </div>

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
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
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
                    <th scope="col">Follow-up Action</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->absences as $index => $absence)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($absence->absences_date)->format('M d, Y') }}</td>
                    <td>
                        @if($absence->absences_type == 'absent')
                            <span class="badge bg-danger">{{ ucfirst($absence->absences_type) }}</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ ucfirst($absence->absences_type) }}</span>
                        @endif
                    </td>
                    <td>{{ $absence->absences_reason }}</td>
                    <td>
                        @php
                            $duration = trim($absence->absences_duration);
                            
                            if (empty($duration) || $duration === '') {
                                echo 'N/A';
                            } elseif (is_numeric($duration)) {
                                // Handle numeric values (assume minutes)
                                $minutes = intval($duration);
                                if ($minutes >= 60) {
                                    echo number_format($minutes / 60, 1) . ' Hours';
                                } else {
                                    echo $minutes . ' Minutes';
                                }
                            } elseif (stripos($duration, 'hour') !== false) {
                                // Handle text like "2 hour" or "1.5 hours"
                                $hourValue = floatval(preg_replace('/[^0-9.]/', '', $duration));
                                if ($hourValue > 0) {
                                    echo number_format($hourValue, 1) . ' Hours';
                                } else {
                                    echo 'N/A';
                                }
                            } else {
                                // Handle other cases or malformed data
                                echo 'N/A';
                            }
                        @endphp
                    </td>
                    <td>
                        @if ($absence->file_path)
                            <a href="{{ route('absence.download', ['absence_id' => $absence->id]) }}" class="text-success">
                                <span class="material-symbols-outlined">download</span> Download Report
                            </a>
                        @else
                            <span class="text-muted">No report uploaded</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('absence.action.update', ['absence_id' => $absence->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="actions" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 180px;">
                                <option value="null">Select Action...</option>
                                <option value="Alert" {{ $absence->actions == 'Alert' ? 'selected' : '' }}>Alert</option>
                                <option value="Warning" {{ $absence->actions == 'Warning' ? 'selected' : '' }}>Warning</option>
                                <option value="Committee Review" {{ $absence->actions == 'Committee Review' ? 'selected' : '' }}>Committee Review</option>
                                <option value="Meeting with Manager/Job Coach" {{ $absence->actions == 'Meeting with Manager/Job Coach' ? 'selected' : '' }}>Meeting with Manager/Job Coach</option>
                            </select>
                        </form>
                        @if($absence->actions)
                            <small class="text-muted d-block mt-1">Current: {{ $absence->actions }}</small>
                        @endif
                    </td>
                    <td>
                        <form class="d-flex gap-2" action="{{ route('absence.upload', ['absence_id' => $absence->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="file-input-{{ $index }}" class="btn btn-secondary btn-sm">
                                <span class="material-symbols-outlined">upload_file</span> Upload
                            </label>
                            <input id="file-input-{{ $index }}" type="file" name="report_file" style="display: none;" onchange="showSubmitButton(this, {{ $index }})">
                            <button type="submit" id="submit-button-{{ $index }}" class="btn btn-success btn-sm" style="display: none;">
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
    <div class="d-flex gap-2 mt-3" style="margin-bottom: 50px">
        <a href="{{route('absence')}}" class="btn btn-secondary">Back to Absence Record</a>
       
    </div>
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