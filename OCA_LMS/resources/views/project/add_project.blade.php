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



        <h2>Add Project</h2>
        <form action="{{ route('add_project') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Project Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="delivery_date" class="form-label">Delivery Date</label>
                <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
            </div>
            {{-- <div class="mb-3">
                <label for="classroom_id" class="form-label">Choose Classroom</label>
                <select class="form-select" id="classroom_id" name="classroom_id">
                    @foreach($classrooms as $classroom)
                        @if(Auth::user()->classrooms->contains($classroom))
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div> --}}
            <div class="mb-3">
                <label for="cohort_id" class="form-label">Choose Cohort</label>
                <select class="form-select" id="cohort_id" name="cohort_id">
                    @foreach($cohorts as $cohort)
                        @if(Auth::user()->cohorts->contains($cohort))
                            <option value="{{ $cohort->id }}">{{ $cohort->cohort_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Next</button>
        </form>


    </div>
</div>

@endsection
