@extends('layouts.app')
@section('title')
View Submissions and Feedback
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
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

            @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
            @php
                $studentIdForConversation = request('student_id');
            @endphp
            <li><a href="{{ route('view_project_submissions', ['project_id' => $project->id]) }}">Submissions</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            @elseif(Auth::guard('students')->check())
            <li><a href="{{ route('project_brief', ['id' => $project->id]) }}">Prpject Brief</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
           @endif
            <li><a style="color:#F16E00"href="">Views Chat</a></li>
        </ul>
    </div>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}



<div class="innerPage mt-3">
    <div class="container">
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h2>View Submissions and Feedback</h2>
            <h3>{{ $project->project_name }}</h3>

            {{-- Start Conversation --}}
            <div class="col-md-8"> <!-- 60% width for Conversation -->
                @foreach ($submissionsAndFeedback as $item)

                    <!-- Display trainee submission -->
                    <div class="message mt-3 p-3 bg-light rounded">
                        <!-- Submission details -->
                        <div class="d-flex align-items-center">
                            <img style="height: 50px; width:50px; border-radius:50%;" src="{{ asset('images/' . $item['student_photo']) }}" alt="{{ $item['student_name'] }}" class="avatar me-3">
                            <div>
                                <p style="font-weight: bold;">{{ $item['student_name'] }}</p>
                                <p style="font-size: 12px; color: #444;">Submitted at: {{ $item['submission_created_at'] }}</p>
                            </div>
                        </div>
                        <p class="mt-3">Submission Link : <a href="{{ $item['submission_link'] }}">{{ $item['submission_link'] }}</a></p>
                        <p class="mt-3">{{ $item['submission_message'] }}</p>
                    </div>

                    <!-- Display trainer feedback if available -->
                    @if ($item['staff_name'] && $item['feedback'])
                        <div class="message mt-3 p-3 bg-primary text-white rounded">
                            <!-- Feedback details -->
                            <div class="d-flex align-items-center">
                                <img style="height: 50px; width:50px; border-radius:50%;" src="{{ asset('images/' . $item['staff_photo']) }}" alt="{{ $item['staff_name'] }}" class="avatar me-3">
                                <div>
                                    <p style="font-weight: bold;">{{ $item['staff_name'] }}</p>
                                    <p style="font-size: 12px;">Feedback at: {{ $item['feedback_created_at'] }}</p>
                                </div>
                            </div>
                            <p class="mt-3">" {{ $item['feedback'] }} "</p>
                        </div>
                    @endif

                @endforeach
            </div>
            {{-- End Conversation --}}

            {{-- Start Evaluation --}}
            <div class="col-md-4"> <!-- 30% width for Evaluation -->
                @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                    <form action="{{ route('update_project_status', ['projectId' => $project->id, 'studentId' => request('student_id')]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="project_status">Project Status:</label>
                            <!-- Select element for project status -->
                            @if($projectStatus == 2)
                            <select name="project_status" id="project_status" style="background-color: #d30606; color:white">
                            @elseif($projectStatus == 1)
                            <select name="project_status" id="project_status" style="background-color: #2c8506; color:white">
                            @else
                            <select name="project_status" id="project_status" style="background-color: #444; color:white">
                            @endif
                                <option value="0" {{ $projectStatus == 0 ? 'selected' : '' }}>Not evaluated</option>
                                <option value="1" {{ $projectStatus == 1 ? 'selected' : '' }}>Confirm Skills</option>
                                <option value="2" {{ $projectStatus == 2 ? 'selected' : '' }}>Corrective Action</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                @elseif (Auth::guard('students')->check())
                <div class="mb-3">
                    <label for="project_status">Project Status:</label>
                    @if($projectStatus == 2)
                        <div class="alert alert-danger" role="alert">
                            You received Corrective Action.
                        </div>
                    @elseif($projectStatus == 1)
                        <div class="alert alert-success" role="alert">
                            Congratulations! You have confirmed your skills.
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            Your project is not evaluated yet.
                        </div>
                    @endif
                </div>
                @endif
            </div>
            {{-- End Evaluation --}}

        </div>

        <!-- Back button -->
        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
            <a href="{{ route('view_project_submissions', ['project_id' => $project->id]) }}" class="btn btn-primary mt-3">
                Back to Submissions
            </a>
            <br> <br>
        @elseif(Auth::guard('students')->check())
            <a href="{{ route('project_brief', ['id' => $project->id]) }}" class="btn btn-primary mt-3">
                Back to Project Brief
            </a>
            <br> <br>
        @endif

    </div>
</div>











{{-- <div class="innerPage mt-3">
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

        <h2>View Submissions and Feedback</h2>
        <h3>{{ $project->project_name }}</h3>

        @foreach ($submissionsAndFeedback as $item)

            <!-- Display trainee submission -->
            <div class="message mt-3 p-3 bg-light rounded" style="width: 53%">
                <div class="d-flex align-items-center">
                    <img style="height: 50px; width:50px; border-radius:50%;" src="{{ asset('images/' . $item['student_photo']) }}" alt="{{ $item['student_name'] }}" class="avatar me-3">
                    <div>
                        <p style="font-weight: bold;">{{ $item['student_name'] }}</p>
                        <p style="font-size: 12px; color: #444;">Submitted at: {{ $item['submission_created_at'] }}</p>
                    </div>
                </div>
                <p class="mt-3">Submission Link : <a href="{{ $item['submission_link'] }}">{{ $item['submission_link'] }}</a></p>
                <p class="mt-3">{{ $item['submission_message'] }}</p>

            </div>

            <!-- Display trainer feedback if available -->
            @if ($item['staff_name'] && $item['feedback'])
                <div class="message mt-3 p-3 bg-primary text-white rounded ms-auto" style="width: 53%">
                    <div class="d-flex align-items-center">
                        <img style="height: 50px; width:50px; border-radius:50%;" src="{{ asset('images/' . $item['staff_photo']) }}" alt="{{ $item['staff_name'] }}" class="avatar me-3">
                        <div>
                            <p style="font-weight: bold;">{{ $item['staff_name'] }}</p>
                            <p style="font-size: 12px;">Feedback at: {{ $item['feedback_created_at'] }}</p>
                        </div>
                    </div>
                    <p class="mt-3">" {{ $item['feedback'] }} "</p>
                </div>
            @endif

        @endforeach

        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
            @php
                $studentIdForConversation = request('student_id');
            @endphp
            <a href="{{ route('view_project_submissions', ['project_id' => $project->id]) }}" class="btn btn-primary mt-3">
                Back to Submissions
            </a>
            @elseif(Auth::guard('students')->check())
            <a href="{{ route('project_brief', ['id' => $project->id]) }}" class="btn btn-primary mt-3">
                Back to Project Brief
            </a>
        @endif

    <br> <br>
        <!-- Pass and Not Pass dropdown -->

     @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
    <form action="{{ route('update_project_status', ['projectId' => $project->id, 'studentId' => request('student_id')]) }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="project_status">Project Status:</label>
            @if($projectStatus == 2)
            <select name="project_status" id="project_status" style="background-color: #d30606; color:white">
            @elseif($projectStatus == 1)
            <select name="project_status" id="project_status" style="background-color: #2c8506; color:white">
            @else
            <select name="project_status" id="project_status" style="background-color: #444; color:white">
            @endif
                <option value="0" {{ $projectStatus == 0 ? 'selected' : '' }}>Not evaluated</option>
                <option value="1" {{ $projectStatus == 1 ? 'selected' : '' }}>Confirm Skills</option>
                <option value="2" {{ $projectStatus == 2 ? 'selected' : '' }}>Corrective Action</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endif
<br> <br>


    </div>
    <br> <br>
</div> --}}

@endsection
