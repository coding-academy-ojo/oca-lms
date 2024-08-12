@extends('Layouts.app')
@section('title')
View Project Submissions
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred">

    @if (session('success'))
        <script>
            Swal.fire({
            title: 'Success!',
            html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
                '<div style="margin-top: 20px;">{{ session('success') }}</div>',
            showConfirmButton: true,
            timer: 5000,
            confirmButtonColor: '#ff7900',
        });
        </script>
    @endif

    <div class="container mt-3">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/projects">Project</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="{{ route('project_brief', ['id' => $project->id]) }}">Prpject Brief</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a style="color:#F16E00"href="">View Submissions</a></li>
        </ul>
    </div>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage mt-3">
    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<h2>View Project Submissions</h2>

<p>{{ $project->project_name }}</p>
<p>{{ $cohort->cohort_name }}</p>

<form action="{{ route('view_project_submissions', ['project_id' => $project->id]) }}" method="GET">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search Trainee">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

 <!-- ... (existing code) ... -->
@if($submissions->count() > 0)

<table class="table">
    <thead>
        <tr>
            <th>Trainee</th>
            <th>Submission Link</th>
            <th>Submission Time</th>
            <th>Status</th>
            @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                <th>Action</th>
            @endif
            <th>View Conversation</th> <!-- Add this column -->
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $submission)
            <tr>
                <td>{{ $submission->student->en_first_name }} {{ $submission->student->en_last_name }}</td>
                <td>
                    <a href="{{ route('view_submissions_feedback', ['project_id' => $project->id, 'submission_id' => $submission->id]) }}" target="_blank">
                        {{ $submission->submission_link }}
                    </a>
                </td>
                <td>{{ $submission->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    @if($submission->created_at->gt($project->project_delivery_date))
                        <span class="text-danger">Late</span>
                    @else
                        <span class="text-success">Submitted on time</span>
                    @endif
                </td>
                @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $submission->id }}">
                            Add Feedback
                        </button>
                    </td>
                @endif

                <td>
                    <a href="{{ route('view_submissions_feedback', ['project_id' => $project->id, 'student_id' => $submission->student_id]) }}" class="btn btn-info">View Conversation</a>
                </td>

            </tr>
            <!-- ... Existing code ... -->
        @endforeach
    </tbody>
</table>
@else
<p>No submissions available for this project.</p>
@endif

<!-- Feedback Modal -->
@foreach($submissions as $submission)
<div class="modal fade" id="feedbackModal{{ $submission->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $submission->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel{{ $submission->id }}">Feedback for {{ $submission->student->en_first_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Feedback form goes here -->
                <form action="{{ route('process_feedback', ['submission_id' => $submission->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                    </div>
                    <!-- Add this line to include submission_id -->
                    <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                    <button type="submit" class="btn btn-primary">Save Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

    </div>
</div>

@endsection

