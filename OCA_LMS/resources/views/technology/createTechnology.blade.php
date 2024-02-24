@extends('layouts.app')
@section('title')
Create Topic
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')


{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


<div class="innerPage   mt-3">
    <div class="container">
        <div class="addpro">
            <h1>Create New Technology</h1>
            <form method="POST" action="{{ route('technology.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div class="mb-4">
                    <label for="technologies_name" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill" id="technologies_name" name="technologies_name" placeholder="Enter the title" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="technologies_description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="technologies_description" name="technologies_description" rows="3" placeholder="Enter the description" required></textarea>
                </div>

                <!-- Resources -->
                <div class="mb-3">
                    <label for="technologies_resources" class="form-label">Resources <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="technologies_resources" name="technologies_resources" rows="3" placeholder="Enter the resources" required></textarea>
                </div>

                <!-- Training Period -->
                <div class="mb-3">
                    <label for="technologies_trainingPeriod" class="form-label">Training Period <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="technologies_trainingPeriod" name="technologies_trainingPeriod" rows="3" placeholder="Enter the training period" required></textarea>
                </div>

                <!-- Category ID (Hidden Input) -->
               

                <input type="hidden" name="technology_category_id" value="{{ $category }}">

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
            </form>


        </div>
    </div>
</div>


@endsection