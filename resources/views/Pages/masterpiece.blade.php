
@extends('Layouts.app')

@section('title')
Announcements
@endsection

@section('content')
{{-- Include Inner Navigation --}}
@include('Layouts.innerNav')

{{-- Breadcrumb Section --}}
<section class="inner-bred my-3">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/cohorts">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/masterpiece">Masterpiece</a></li>
        </ul>
    </div>
</section>

<div class="container">
    <!-- Masterpiece Progress Section -->
    <div class="container my-4">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <div class="row my-5">
            <div class="col">
                <!-- Masterpiece Task Form -->
                <h3 class="mb-4 text-primary"> Set Masterpiece Task deadlines </h3>
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('masterpiece.task.deadline.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="task">Task</label>
                                <select id="task" class="form-control @error('task') is-invalid @enderror" name="task_id" required autocomplete="task" autofocus>
                                    <option value="">Select Task</option>
                                    @foreach($tasks as $taskId => $taskName)
                                        <option value="{{ $taskId }}">{{ $taskName }}</option>
                                    @endforeach
                                </select>
                                @error('task')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="deadline">Deadline</label>
                                <input type="date" id="deadline" name="deadline" class="form-control" >
                                <!-- <input type="date" id="deadline" name="deadline" class="form-control" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"> -->
                            </div>
                            <button type="submit" class="btn btn-primary">Set Deadline</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <!-- Masterpiece Progress Entry Form -->
                <h3 class="mb-4 text-primary">Enter Masterpiece Progress </h3>
                <div class="card my-3">
                    <div class="card-body">
                        <form id="masterpiece-form" method="POST" action="{{ route('masterpiece.progress.store') }}">
                            @csrf
                            <input type="hidden" name="student_id" id="student-id">

                            <!-- Task and Student Selection -->
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <label for="task">Task</label>
                                    <select id="task" class="form-control @error('task') is-invalid @enderror" name="task_id" required autocomplete="task" autofocus>
                                        <option value="">Select Task</option>
                                        @foreach($tasks as $taskId => $taskName)
                                            <option value="{{ $taskId }}">{{ $taskName }}</option>
                                        @endforeach
                                    </select>
                                    @error('task')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="student-select">Student Name</label>
                                    <select id="student-select" class="form-control" name="student_id">
                                        <option value="">Select Student</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->en_first_name }} {{ $student->en_last_name }}</option>
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
  




<!-- New Section with Dropdown Lists -->
<div class="container my-5">
        <h3 class="mb-4 text-primary">Choose Certificate Type and Internship Status</h3>
        <div class="row">
            <!-- Column for Certificate Type and Student Dropdown -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="certificate-form" method="POST" action="{{ route('update.certificate') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="student-select">Student Name</label>
                                <select id="student-select" class="form-control" name="student_id">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->en_first_name }} {{ $student->en_last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="dropdown1">Select Certificate Type</label>
                                <select id="dropdown1" class="form-control" name="certificate_type">
                                    <option value="None">None</option>
                                    <option value="Attendance">Attendance</option>
                                    <option value="Front-end">Front-end</option>
                                    <option value="Back-end">Back-end</option>
                                    <option value="Full-Stack">Full-Stack</option>
                                </select>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Update Certificate</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column for Internship Status and Student Dropdown -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="internship-form" method="POST" action="{{ route('update.internship') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="student-select-internship">Student Name</label>
                                <select id="student-select-internship" class="form-control" name="student_id">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->en_first_name }} {{ $student->en_last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="dropdown2">Select Internship Status</label>
                                <select id="dropdown2" class="form-control" name="internship_status">
                                    <option value="1">Interned</option>
                                    <option value="0">Non-interned</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Internship</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle certificate form submission
            document.getElementById('certificate-form').addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the certificate type?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Handle internship form submission
            document.getElementById('internship-form').addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update the internship status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Check if there's a success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
  </div>
  </div>

@endsection
