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

        <h2>Edit Project</h2>
        <form action="{{ route('update_project', ['id' => $project->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Use the PUT method for updating --}}

            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <textarea class="form-control" id="description" name="description"
                    required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Project Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset('images/' . $project->image) }}" alt="Project Image" class="img-thumbnail mt-2"
                    style="max-width: 200px">
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date', $project->start_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="delivery_date" class="form-label">Delivery Date</label>
                <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                    value="{{ old('delivery_date', $project->delivery_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="cohort_id" class="form-label">Choose Cohort</label>
                <select class="form-select" id="cohort_id" name="cohort_id" required>
                    @foreach($cohorts as $cohort)
                    <option value="{{ $cohort->id }}" {{ old('cohort_id', $project->cohort_id) == $cohort->id ?
                        'selected' : '' }}>
                        {{ $cohort->cohort_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>


    </div>
</div>

@endsection
