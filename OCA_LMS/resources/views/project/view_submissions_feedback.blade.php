@extends('layouts.app')
@section('title')
Topics
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
<section class="inner-bred">

    <div class="container">
      
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
                <p class="mt-3"><a href="{{ $item['submission_link'] }}">{{ $item['submission_link'] }}</a></p>
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
        @endif

    </div>
</div>



@endsection
