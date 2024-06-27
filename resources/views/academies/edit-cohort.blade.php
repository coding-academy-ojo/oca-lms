@extends('Layouts.app')
@section('title')
Edit Cohort
@endsection

@section('content')

@include('Layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Cohorts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Cohort</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit Cohort</h2>
    <form method="post" action="{{ route('update-cohort', $cohort->id) }}">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="cohortName" class="form-label">Cohort Name</label>
            <input type="text" class="form-control" id="cohortName" name="name" placeholder="Cohort Name Here" value="{{ $cohort->cohort_name }}">
        </div>
        <div class="mb-3">
            <label for="cohortDonor" class="form-label">Cohort Donor</label>
            <input type="text" class="form-control" id="cohortDonor" name="cohort_donor" placeholder="Cohort Donor Name" value="{{ $cohort->cohort_donor }}">
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="start_date" value="{{ $cohort->cohort_start_date }}">
        </div>
    
        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" name="end_date" value="{{ $cohort->cohort_end_date }}">
        </div>
    
        <div class="mb-3">
            <label for="cohortDescription" class="form-label">Description</label>
            <textarea class="form-control" id="cohortDescription" name="description" rows="3">{{ $cohort->cohort_description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Trainers</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" style="width: 100%; border-radius: 0; text-align: left;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Choose Trainers
                </button>
                <div class="dropdown-menu p-2 form-select" aria-labelledby="dropdownMenuButton">
                    @foreach ($trainers as $trainer)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="trainers[]" value="{{ $trainer->id }}"
                            id="trainer{{ $trainer->id }}" @if(in_array($trainer->id, $cohort->staff->pluck('id')->toArray())) checked @endif>
                        <label class="form-check-label" for="trainer{{ $trainer->id }}">
                            {{ $trainer->staff_name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
    
        form.addEventListener('submit', function (e) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
    
            if (endDate < startDate) {
                e.preventDefault(); 
                alert('The end date cannot be before the start date.');
            }
        });
    });
</script>
    
@endsection
