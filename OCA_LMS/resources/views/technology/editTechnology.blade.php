@extends('layouts.app')
@section('title')
Edit Topic
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
            <li><a href="">Edit Topics</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Edit Topic </h1>
            <!-- edit.blade.php -->

            <form method="POST" action="{{ route('technology.update', ['technology' => $technology->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="technologies_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="technologies_name" name="technologies_name" value="{{ $technology->technologies_name }}">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="technologies_description" class="form-label">Description</label>
                    <textarea class="form-control" id="technologies_description" name="technologies_description" rows="3">{{ $technology->technologies_description }}</textarea>
                </div>

                <!-- Resources -->
                <div class="mb-4">
                    <label for="technologies_resources" class="form-label">Resources</label>
                    <textarea class="form-control" id="technologies_resources" name="technologies_resources" rows="3">{{ $technology->technologies_resources }}</textarea>
                </div>

                <!-- Training Period -->
                <div class="mb-4">
                    <label for="technologies_trainingPeriod" class="form-label">Training Period</label>
                    <textarea class="form-control" id="technologies_trainingPeriod" name="technologies_trainingPeriod" rows="3">{{ $technology->technologies_trainingPeriod }}</textarea>
                </div>

                <!-- New Image -->
                <div class="mb-4">
                    <label for="image" class="form-label">Upload New Image :</label>
                    <div class="mb-4">

                        @if ($technology->technologies_photo)
                        <img src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                        @else

                        <p>No image uploaded.</p>
                        @endif
                    </div>
                    <input type="file" class="form-control" id="image" name="image">
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>


        </div>
    </div>
</div>
@endsection