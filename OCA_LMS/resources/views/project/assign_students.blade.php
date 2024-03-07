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

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/projects">Project</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
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
            @foreach($students as $student)
                <input class="form-check-input" type="checkbox" value="{{ $student->id }}" name="students[]">
                <label class="form-check-label" for="{{ $student->id }}">
                    {{ $student->en_first_name }} {{ $student->en_second_name }} {{ $student->en_third_name }}
                </label>
                <br>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Assign Students</button>
    </form>


    </div>
</div>

@endsection
