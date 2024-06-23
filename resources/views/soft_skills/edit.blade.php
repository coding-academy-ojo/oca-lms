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
            <input type="range" class="form-range" id="satisfaction" name="satisfaction" min="0" max="100" step="1" value="0" oninput="updateSatisfactionValue(this.value)">
            <div class="d-flex justify-content-between">
                <small>0%</small>
                <small>100%</small>
            </div>
            <input type="text" id="satisfactionValue" class="form-control mt-2" value="0%" readonly>
        </div>
        
        <script>
            function updateSatisfactionValue(value) {
                document.getElementById('satisfactionValue').value = value + '%';
            }
        </script>
        
        
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
