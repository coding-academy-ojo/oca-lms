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

<div class="container">
    <!-- Masterpiece Progress Section -->
    <div class="container my-4">
        <h3 class="mb-4 text-primary"> Set Masterpiece Task deadlines </h3>
        <form method="POST" action="{{ route('masterpiece.progress.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-primary">Task</th>
                                    <th scope="col">Idea Pitching</th>
                                    <th scope="col">Wireframe &amp; Mockup</th>
                                    <th scope="col">Front-end</th>
                                    <th scope="col">Final version fully functional</th>
                                    <th scope="col">All other deliverables</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-primary">Deadline</th>
                                    <td><input type="date" id="idea_pitching_date" value="<?php echo date('Y-m-d'); ?>"
                                            min="<?php echo date('Y-m-d'); ?>" onchange="enableSetButton()"></td>
                                    <td><input type="date" id="wireframe_date" value="<?php echo date('Y-m-d'); ?>"
                                            min="<?php echo date('Y-m-d'); ?>" onchange="enableSetButton()"></td>
                                    <td><input type="date" id="frontend_date" value="<?php echo date('Y-m-d'); ?>"
                                            min="<?php echo date('Y-m-d'); ?>" onchange="enableSetButton()"></td>
                                    <td><input type="date" id="final_version_date" value="<?php echo date('Y-m-d'); ?>"
                                            min="<?php echo date('Y-m-d'); ?>" onchange="enableSetButton()"></td>
                                    <td><input type="date" id="other_deliverables_date"
                                            value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"
                                            onchange="enableSetButton()"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button id="setButton" type="submit" class="btn btn-primary" onclick="setDates()">Set</button>
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
                            <select id="task" class="form-control @error('task') is-invalid @enderror" name="task"
                                required autocomplete="task" autofocus>
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
                            <select id="student-select" class="form-control" name="student_id">
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->en_first_name }}
                                    {{ $student->en_second_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Other Form Fields -->
                    <div class="form-group mb-3">
                        <label for="progress">Progress (%)</label>
                        <input id="progress" type="number" min="0" max="100"
                            class="form-control @error('progress') is-invalid @enderror" name="progress"
                            value="{{ old('progress') }}" required autocomplete="progress">
                        @error('progress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="notes">Notes</label>
                        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes"
                            required autocomplete="notes">{{ old('notes') }}</textarea>
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



<div class="row">
    <div class="col">
        <!-- Masterpiece Task Form -->
        <h3 class="mb-4 text-primary">Enter Masterpiece Tracking points </h3>
        <div class="card mb-3">
            <div class="card-body">
                <form method="POST" action="{{ route('masterpiece.task.deadline.store') }}">
                    @csrf
                    <div class="form-group">

                        <label for="task">Task</label>
                        <select id="task" class="form-control @error('task') is-invalid @enderror" name="task" required
                            autocomplete="task" autofocus>
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
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" id="deadline" name="deadline" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Set Deadline</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



<script>

</script>
@endsection