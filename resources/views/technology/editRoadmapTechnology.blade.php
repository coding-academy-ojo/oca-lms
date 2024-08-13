@extends('Layouts.app')
@section('title')
Edit Technology
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/rodmap">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Edit Roadmap Technology</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage  mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Edit Roadmap Technology Date</h1>
            <!-- edit.blade.php -->
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('Roadmap.update', ['technologyID' => $technology->id]) }}" class="mb-5">
                @csrf
                @method('PUT')

                <!-- start_date -->
                <div class="mb-4">
                    <label for="technologies_name" class="form-label">Estimated time for this technology</label>
                    <input type="text" class="form-control" id="technologies_name" name="technologies_training_period" value="{{ $technology->technologies_training_period }}">
                </div>


                <!-- start_date -->
                <div class="mb-4">
                    <label for="technologies_name" class="form-label">Technology Start Date</label>
                    <input type="date" class="form-control" id="technologies_name" name="start_date" value="{{ $technology->start_date }}">
                </div>

                <!-- end_date -->
                <div class="mb-4">
                    <label for="technologies_name" class="form-label">Technology End Date</label>
                    <input type="date" class="form-control" id="technologies_name" name="end_date" value="{{ $technology->end_date }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>


        </div>
    </div>
</div>
@endsection