@extends('Layouts.app')
@section('title')
Skills Framework (Competence)
@endsection

@section('content')
@include('Layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Edit Skills Framework</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Edit Skill Framework</h1>
            <form method="post" action="{{ route('updateSkill', ['id' => $skill->id]) }}">
           
                @csrf
                @method('PUT')
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill" id="title" name="skills_name" placeholder="Enter the title" value="{{ $skill->skills_name }}" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection