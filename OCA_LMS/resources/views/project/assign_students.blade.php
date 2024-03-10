@extends('layouts.app')
@section('title')
Create Project
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
<section class="inner-bred">

    <div class="container mt-3">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/projects">Project</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="{{ route('project_brief', ['id' => $project->id]) }}">Prpject Brief</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a style="color:#F16E00"href="">Assign Students</a></li>
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

        <h2>Assign Students to Project</h2>
        <form action="{{ route('assign_students', ['projectId' => $project->id]) }}" method="post">
            @csrf
            <div class="form-check">
                <div style="margin-bottom: 20px;">
                    <input class="form-check-input" type="checkbox" id="selectAllStudents">
                    <label class="form-check-label" for="selectAllStudents">Select All Students</label>
                </div>
                @php
                    $students = $students->sortBy('en_first_name');
                    $selectedStudentIds = $project->students->pluck('id')->toArray();
                @endphp
                @foreach($students as $student)
                    <div style="line-height: 1.5; margin-left:20px;">
                        <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]"
                            @if(in_array($student->id, $selectedStudentIds)) checked @endif>
                        <label class="form-check-label" for="{{ $student->id }}">
                            {{ $student->en_first_name }} {{ $student->en_last_name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-4">Assign Students</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectAllCheckbox = document.getElementById('selectAllStudents');
        var studentCheckboxes = document.querySelectorAll('input[name="students[]"]');

        // Add event listener to Select All checkbox
        selectAllCheckbox.addEventListener('change', function () {
            studentCheckboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Add event listener to individual checkboxes
        studentCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                } else {
                    // Check if all individual checkboxes are checked
                    var allChecked = Array.from(studentCheckboxes).every(function (checkbox) {
                        return checkbox.checked;
                    });
                    selectAllCheckbox.checked = allChecked;
                }
            });
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
