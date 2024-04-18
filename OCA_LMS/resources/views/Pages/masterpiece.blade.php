
@extends('layouts.app')

@section('title')
Announcements
@endsection

@section('content')
{{-- Include Inner Navigation --}}
@include('layouts.innerNav')

{{-- Breadcrumb Section --}}
<section class="inner-bred my-3">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="#">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="#">Test</a></li>
        </ul>
    </div>
</section>

<!-- Sidebar with Student Selection -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Student Name</div>
                <div class="card-body">
                    <select id="student-select" class="form-control">
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->en_first_name }} {{ $student->en_second_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Masterpiece Info Form -->
            <div class="card mb-3">
                <div class="card-header">Set a Deadline for each Masterpiece Task<span id="selected-student-name"></span></div>
                <div class="card-body">
                    <form id="masterpiece-form" method="POST" action="{{ route('masterpiece.store') }}">
                        @csrf
                        <input type="hidden" name="student_id" id="student-id">
                        <div class="form-group mb-3">
                            <label for="task">Task</label>
                            <select id="task" class="form-control @error('task') is-invalid @enderror" name="task" required autocomplete="task" autofocus>
                                <option value="">Select Task</option>
                                <option>Idea pitching</option>
                                <option>Wireframe & Mockup</option>
                                <option>Fully responsive Front-end</option>
                                <option>Final version fully functional</option>
                                <option>All other deliverables</option>
                            </select>
                            @error('task')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deadline">Deadline</label>
                            <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" required autocomplete="deadline">
                            @error('deadline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Masterpiece Progress Entry Form -->
            <div class="card my-3">
                <div class="card-header">Masterpiece Progress Entry <span id="selected-student-name"></span></div>
                <div class="card-body">
                    <form id="masterpiece-form" method="POST" action="{{ route('masterpiece.store') }}">
                        @csrf
                        <input type="hidden" name="student_id" id="student-id">
                        
                        <!-- Task and Student Selection -->
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label for="task">Task</label>
                                <select id="task" class="form-control @error('task') is-invalid @enderror" name="task" required autocomplete="task" autofocus>
                                    <option value="">Select Task</option>
                                    <option>Idea pitching</option>
                                    <option>Wireframe & Mockup</option>
                                    <option>Fully responsive Front-end</option>
                                    <option>Final version fully functional</option>
                                    <option>All other deliverables</option>
                                </select>
                                @error('task')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="student-select">Student Name</label>
                                <select id="student-select" class="form-control">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->en_first_name }} {{ $student->en_second_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Other Form Fields -->
                        <div class="form-group mb-3">
                            <label for="progress">Progress (%)</label>
                            <input id="progress" type="number" min="0" max="100" class="form-control @error('progress') is-invalid @enderror" name="progress" value="{{ old('progress') }}" required autocomplete="progress">
                            @error('progress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes">Notes</label>
                            <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" required autocomplete="notes">{{ old('notes') }}</textarea>
                            @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

