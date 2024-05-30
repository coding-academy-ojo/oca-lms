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
            <li><a href=""> Edit Skills Levels</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


<!-- <div class="innerPage  mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Edit Levels for {{ $skill->skills_name }} </h1>
            @foreach($skillLevels as $skillLevel)
            <form method="POST" action="{{ route('updateSkillLevel', ['level' => $skillLevel->id]) }}" class="mb-3">
                @csrf
                @method('PUT')
            
                <div class="mb-4">
                    <label for="title" class="form-label">level {{$skillLevel->name}} description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="1" rows="3" placeholder="Enter your skills" name="level" require>{{ $skillLevel->skillLevels_description }}</textarea>
                </div>
              
                <button type="submit" class="btn btn-primary rounded-pill">Update</button>
            </form>
            @endforeach
        </div>
    </div>
</div> -->

<div class="innerPage mt-3">
    <div class="container">
        <div class="addpro">
            <h1 class="text-center mb-4">Edit Levels for {{ $skill->skills_name }}</h1>
            @php
            $words = ['Imitate', 'Adapt', 'Transpose'];
            @endphp
            @foreach($skillLevels as $index => $skillLevel)
            <form method="POST" action="{{ route('updateSkillLevel', ['level' => $skillLevel->id]) }}" class="mb-3">
                @csrf
                @method('PUT')
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label">level {{ $words[$index % count($words)] }} description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="1" rows="3" placeholder="Enter your skills" name="level" required>{{ $skillLevel->skillLevels_description }}</textarea>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary rounded-pill">Update</button>
            </form>
            @endforeach
        </div>
    </div>
</div>


@endsection