@extends('layouts.app')
@section('title')
Edit Project Skills
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
            <li><a style="color:#F16E00"href="">Edit Project Skills</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage mt-3">
    <div class="container">

        <h2>Edit Project Skills Level</h2>
        <form action="{{ route('update_project_skills_level', ['id' => $project->id]) }}" method="POST">
            @csrf
            @method('PUT') {{-- Use the PUT method for updating --}}

            @foreach($skills as $skill)
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->id }}" id="{{ 'skill_' . $skill->id }}" @if(in_array($skill->id, $selectedSkills ?? [])) checked @endif>
                        <label class="form-check-label" for="{{ 'skill_' . $skill->id }}">{{ $skill->skills_name }}</label>
                    </div>

                    <select class="form-select mt-2" name="levels[]">
                        <option value="" selected disabled>Select Level</option>
                        @foreach($levels as $level)
                            @php
                                $selectedLevel = $project->skills->where('id', $skill->id)->first()->pivot->level_id ?? null;
                                $description = $descriptions->where('skill_id', $skill->id)->where('level_id', $level->id)->first()->skillLevels_description ?? '';
                            @endphp
                            <option value="{{ $level->id }}" @if($level->id == $selectedLevel) selected @endif data-description="{{ $description }}">
                                {{ $level->levels_name }} - " {{ $description }} "
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update Project Skills Level</button>
        </form>

    </div>
</div>

@endsection
