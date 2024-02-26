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
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            {{-- <li><a href="">{{ $category->Categories_name }}</a></li> --}}
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage mt-3">
    <div class="container">

        {{-- @if ($errors->any())
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

        <!-- Display submissions and feedback here -->
        @foreach ($submissionsAndFeedback as $item)

        <!-- Display trainee submission -->
        <div class="message">
            <img style="height: 50px; width:50px; border-radius:50%; float: left; margin-right: 10px;"
                src="{{ asset('images/' . $item['student_photo']) }}" alt="{{ $item['student_name'] }}" class="avatar">
            <div>
                <p style="font-weight: bold;">{{ $item['student_name'] }}</p>
                <p style="font-size: 12px; color: #444;">Submitted at: {{ $item['submission_created_at'] }}</p>
            </div>
            <p style="clear: both; margin-top: 30px; margin-left:30px;">Submitted: {{ $item['submission_link'] }}</p>
        </div>
        <!-- Display trainer feedback if available -->
        @if ($item['staff_name'] && $item['feedback'])
        <hr>

        <div class="message">
            <img style="height: 50px; width:50px; border-radius:50%; float: left; margin-right: 10px;"
                src="{{ asset('images/' . $item['staff_photo']) }}" alt="{{ $item['staff_name'] }}" class="avatar">
            <div>
                <p style="font-weight: bold;">{{ $item['staff_name'] }}</p>
                <p style="font-size: 12px; color: #444;">Feedback at: {{ $item['feedback_created_at'] }}</p>
            </div>
            <p style="clear: both; margin-top: 30px; margin-left:30px;">Feedback: {{ $item['feedback'] }}</p>
        </div>
        @endif
        <hr>
        @endforeach --}}

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

        <!-- Display submissions and feedback here -->
        @foreach ($submissionsAndFeedback as $item)

            <!-- Display trainee submission -->
            <div class="message">
                <img style="height: 50px; width:50px; border-radius:50%; float: left; margin-right: 10px;"
                    src="{{ asset('images/' . $item['student_photo']) }}" alt="{{ $item['student_name'] }}" class="avatar">
                <div>
                    <p style="font-weight: bold;">{{ $item['student_name'] }}</p>
                    <p style="font-size: 12px; color: #444;">Submitted at: {{ $item['submission_created_at'] }}</p>
                </div>
                <p style="clear: both; margin-top: 30px; margin-left:30px;">Submitted: {{ $item['submission_link'] }}</p>
            </div>

            <!-- Display trainer feedback if available -->
            @if ($item['staff_name'] && $item['feedback'])
                <hr>

                <div class="message">
                    <img style="height: 50px; width:50px; border-radius:50%; float: left; margin-right: 10px;"
                        src="{{ asset('images/' . $item['staff_photo']) }}" alt="{{ $item['staff_name'] }}" class="avatar">
                    <div>
                        <p style="font-weight: bold;">{{ $item['staff_name'] }}</p>
                        <p style="font-size: 12px; color: #444;">Feedback at: {{ $item['feedback_created_at'] }}</p>
                    </div>
                    <p style="clear: both; margin-top: 30px; margin-left:30px;">Feedback: {{ $item['feedback'] }}</p>
                </div>
                <hr>
            @endif
        @endforeach


    </div>
</div>

@endsection

