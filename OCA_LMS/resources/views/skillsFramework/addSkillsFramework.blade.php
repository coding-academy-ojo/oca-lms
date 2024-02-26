@extends('layouts.app')
@section('title')
Skills Framework (Competence)
@endsection

@section('content')
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Create Skills Framework</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Create New Skill Framework </h1>
            <form method="post" action="{{ route('addskillsFramework') }}">
                @csrf
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="Enter the title" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection