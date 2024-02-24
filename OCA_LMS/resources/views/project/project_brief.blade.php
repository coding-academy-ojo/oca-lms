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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="d-flex justify-content-between align-items-center">
            <h2>Project Brief</h2>

            <!-- Dropdown for Edit Options -->
            <div class="dropdown mt-3 ">
                <button class="dropdown-toggle btn btn-primary" style="background-color: #f16e00; border:#000 2px solid"
                    type="button" id="editOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Option
                </button>

                <ul class="dropdown-menu" aria-labelledby="editOptionsDropdown">
                    @if(Auth::user()->role == 'trainer')
                    <li><a class="dropdown-item" href="{{ route('edit_project', ['id' => $project->id]) }}">Edit
                            Project</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('edit_project_skills_level', ['id' => $project->id]) }}">Edit Project Skills
                            Level</a></li>
                    @endif

                    {{-- @if(in_array(Auth::user()->role, ['trainer', 'manager']))
                    <li><a class="dropdown-item"
                            href="{{ route('view_project_submissions', ['project_id' => $project->id]) }}">View Project
                            Submissions</a></li>
                    @endif --}}

                    {{-- @if(Auth::user()->role == 'trainee')
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#addSubmissionModal">Add Project Submissions</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('view_submissions_feedback', ['project_id' => $project->id]) }}">View Your
                            Submissions</a></li>
                    @endif --}}

                </ul>

            </div>


            <!-- Modal for Add Project Submissions -->
            {{-- <div class="modal fade" id="addSubmissionModal" tabindex="-1" role="dialog"
                aria-labelledby="addSubmissionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubmissionModalLabel">Add Project Submissions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Include the form content -->
                            @include('add_project_submission')
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>



        <div class="mb-3 mt-3">
            <img src="{{ asset('images/' . $project->image) }}" alt="Project Image" class="img-fluid"
                style="height: 400px; width: 100%;">
        </div>


        <div>
            <p><strong>Project Name:</strong> {{ $project->name }}</p>
            <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
            <p><strong>Delivery Date:</strong> {{ $project->delivery_date }}</p>
            <p><strong>Project Description:</strong> {{ $project->description }}</p>
            <p><strong>Cohort:</strong> {{ $project->cohort->cohort_name }}</p>
            @if($project->staff)
                <p><strong>Trainer:</strong> {{ $project->staff->staff_name }}</p>
            @else
                <p><strong>Trainer:</strong> Not Assigned</p>
            @endif


            <p><strong>Target Skills:</strong></p>
            <ul>
                @foreach($skills as $skill)
                <li class="mt-1">
                    - {{ $skill->name }} - Levels {{ $skill->pivot->level_id }}:
                    @foreach($levels as $level)
                    @if($level->id == $skill->pivot->level_id)
                    <span style="color:#f16e00">"{{ $level->name }}"</span>
                    @endif
                    @endforeach
                </li>
                @endforeach
            </ul>
        </div>


    </div>
</div>

@endsection
