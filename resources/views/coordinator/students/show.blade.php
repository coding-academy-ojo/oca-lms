@extends('Layouts.app')
@section('title')
    Student Details
@endsection

@section('content')
    @include('Layouts.innerNav')

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohorts</a></li>
            <li class="breadcrumb-item"><a href="{{ route('coordinator.students.index', ['cohort_id' => $student->cohort_id]) }}">Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Details</li>
        </ol>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Student Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('coordinator.students.edit', $student->id) }}" class="btn btn-primary">
                    <span class="material-symbols-outlined">edit</span> Edit
                </a>
                <a href="{{ route('coordinator.students.index', ['cohort_id' => $student->cohort_id]) }}" class="btn btn-secondary">
                    <span class="material-symbols-outlined">arrow_back</span> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if($student->personal_img)
                            <img src="{{ asset('storage/' . $student->personal_img) }}" alt="Student Photo" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mb-3" style="height: 300px;">
                                <span class="material-symbols-outlined" style="font-size: 100px;">person</span>
                            </div>
                        @endif
                        <h4 class="mb-1">
                            {{ $student->en_first_name ?? '' }} 
                            {{ $student->en_second_name ?? '' }} 
                            {{ $student->en_last_name ?? '' }}
                            @if(empty($student->en_first_name) && empty($student->en_second_name))
                                {{ $student->ar_first_name ?? '' }} 
                                {{ $student->ar_second_name ?? '' }} 
                                {{ $student->ar_last_name ?? '' }}
                            @endif
                        </h4>
                        <p class="text-muted mb-0">{{ $student->email }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Email:</strong><br>
                                {{ $student->email }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Mobile:</strong><br>
                                {{ $student->mobile ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Birthdate:</strong><br>
                                {{ $student->birthdate ? date('Y-m-d', strtotime($student->birthdate)) : 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Gender:</strong><br>
                                {{ ucfirst($student->gender ?? 'N/A') }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Marital Status:</strong><br>
                                {{ $student->martial_status ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Status:</strong><br>
                                <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'inactive' ? 'danger' : 'secondary') }}">
                                    {{ $student->status ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Academy & Cohort</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Academy:</strong><br>
                                {{ $student->academy->academy_name ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Cohort:</strong><br>
                                {{ $student->cohort->cohort_name ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Personal Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>National ID:</strong><br>
                                {{ $student->national_id ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Passport Number:</strong><br>
                                {{ $student->passport_number ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>City:</strong><br>
                                {{ $student->city ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Country:</strong><br>
                                {{ $student->country ?? 'N/A' }}
                            </div>
                            <div class="col-12 mb-3">
                                <strong>Address:</strong><br>
                                {{ $student->address ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Education & Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Education:</strong><br>
                                {{ $student->education ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Field:</strong><br>
                                {{ $student->field ?? 'N/A' }}
                            </div>
                            <div class="col-12 mb-3">
                                <strong>Educational Background:</strong><br>
                                {{ $student->educational_background ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>GitHub:</strong><br>
                                @if($student->github_link)
                                    <a href="{{ $student->github_link }}" target="_blank">{{ $student->github_link }}</a>
                                @else
                                    N/A
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>LinkedIn:</strong><br>
                                @if($student->linkedin_link)
                                    <a href="{{ $student->linkedin_link }}" target="_blank">{{ $student->linkedin_link }}</a>
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

