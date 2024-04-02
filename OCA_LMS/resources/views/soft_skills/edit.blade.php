@extends('layouts.app')

@section('title', 'Edit Soft Skills Training')

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('soft-skills.index') }}">Soft Skills Training</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Soft Skills Training</li>
    </ol>
</nav>

<div class="container my-5" >
    <h2>Edit Soft Skills Training</h2>
    <form method="POST" action="{{ route('soft-skills.update', $softSkillsTraining->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Soft Skills Training Name" value="{{$softSkillsTraining->name}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{$softSkillsTraining->description}}</textarea>
        </div>

        <div class="mb-3">
            <label for="trainer" class="form-label fw-bold">Trainer</label>
            <input type="text" class="form-control" id="trainer" name="trainer" placeholder="Trainer Name" value="{{$softSkillsTraining->trainer}}">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label fw-bold">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$softSkillsTraining->date}}">
        </div>

        <div class="mb-3">
            <label for="satisfaction" class="form-label">Satisfaction</label>
            <fieldset class="star-rating">
                <legend class="visually-hidden">Satisfaction Rating</legend>
                <input type="radio" id="terrible" name="satisfaction" value="1" class="visually-hidden" {{ $softSkillsTraining->satisfaction == 1 ? 'checked' : '' }}>
                <label for="terrible" title="Terrible"><span class="visually-hidden">1 star</span></label>
                
                <input type="radio" id="bad" name="satisfaction" value="2" class="visually-hidden" {{ $softSkillsTraining->satisfaction == 2 ? 'checked' : '' }}>
                <label for="bad" title="Bad"><span class="visually-hidden">2 stars</span></label>
                
                <input type="radio" id="mixed" name="satisfaction" value="3" class="visually-hidden" {{ $softSkillsTraining->satisfaction == 3 ? 'checked' : '' }}>
                <label for="mixed" title="Mixed"><span class="visually-hidden">3 stars</span></label>
                
                <input type="radio" id="good" name="satisfaction" value="4" class="visually-hidden" {{ $softSkillsTraining->satisfaction == 4 ? 'checked' : '' }}>
                <label for="good" title="Good"><span class="visually-hidden">4 stars</span></label>
        
                <input type="radio" id="excellent" name="satisfaction" value="5" class="visually-hidden" {{ $softSkillsTraining->satisfaction == 5 ? 'checked' : '' }}>
                <label for="excellent" title="Excellent"><span class="visually-hidden">5 stars</span></label>
            </fieldset>
        </div>
        
        <div class="mb-3">
            <label for="cohort" class="form-label fw-bold">Cohort</label>
            <select class="form-select" id="cohort" name="cohort_id">
                @foreach($runningCohorts as $cohort)
                    <option value="{{ $cohort->id }}" {{ $cohort->id == $softSkillsTraining->cohort_id ? 'selected' : '' }}>
                        {{ $cohort->cohort_name }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
