@extends('layouts.app')
@section('title')
Add Project Skills
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



        <h2>Add Project Skills Level</h2>
        <form action="{{ route('process_project_skills_level_form') }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">

            @foreach($skills as $skill)
                <div class="mb-3">
                    <input type="checkbox" id="{{ 'skill_' . $skill->id }}" name="skills[]" value="{{ $skill->id }}">
                    <label for="{{ 'skill_' . $skill->id }}">{{ $skill->skills_name }}</label>

                    <select class="form-select" name="levels[]">
                        <option value="" selected disabled>Select Level</option>
                        @foreach($levels as $level)
                            @php
                                $description = $descriptions->where('skill_id', $skill->id)->where('level_id', $level->id)->first()->skillLevels_description ?? '';
                                // Limit description to 25 characters
                                 $description = substr($description, 0, 140);
                            @endphp
                            <option value="{{ $level->id }}" data-description="{{ $description }}">
                                {{ $level->levels_name }} -  " {{ $description }} "
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Save Project Skills Level</button>
        </form>




    </div>
</div>

@endsection
