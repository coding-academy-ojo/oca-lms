@extends('layouts.app')

@section('title')
Edit {{ $academy->academy_name }}
@endsection
@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academies') }}">Academies</a></li>
        <li class="breadcrumb-item text-primary" aria-current="page">Edit Academy</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit {{ $academy->academy_name }}</h2>
    <form action="{{ route('academies.update', $academy->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="academyName" class="form-label">Academy Name</label>
            <input type="text" class="form-control" id="academyName" name="academy_name" placeholder="Enter academy name" value="{{ $academy->academy_name }}">
        </div>
        <div class="mb-3">
            <label for="academyManager" class="form-label">Academy Manager</label>
            <select class="form-control" id="academyManager" name="manager_id">
                <option value="">Select a Manager</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}" {{ $academy->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->staff_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="academyLocation" class="form-label">Location</label>
            <input type="text" class="form-control" id="academyLocation" name="academy_location" placeholder="Enter academy location" value="{{ $academy->academy_location }}">
        </div>
        <!-- Additional fields can be added here -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection
