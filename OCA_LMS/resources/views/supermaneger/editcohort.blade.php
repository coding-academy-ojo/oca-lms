@extends('Layouts.app')
@section('title')
Edit Cohort
@endsection

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('academyview')}}">Cohorts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Cohort</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit Cohort</h2>
    <form>
        @csrf
         @method('PUT')

        <div class="mb-3">
            <label for="cohortName" class="form-label">Cohort Name</label>
            <input type="text" class="form-control" id="cohortName" name="name" placeholder="Cohort Name Here">
        </div>

        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="start_date">
        </div>

        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" name="end_date">
        </div>

        <div class="mb-3">
            <label for="cohortDescription" class="form-label">Description</label>
            <textarea class="form-control" id="cohortDescription" name="description" rows="3" placeholder="Brief description about the cohort"></textarea>
        </div>

        <!-- Additional static fields for instructors, courses, etc., can be added here -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection
