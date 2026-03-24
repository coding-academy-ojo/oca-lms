@extends('Layouts.app')

@section('title')
Edit {{ $academy->academy_name }}
@endsection
@section('content')

@include('Layouts.innerNav')

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
        
        <hr>
        <h5 class="mt-4">📍 Location Settings (GPS)</h5>
        <p class="text-muted">Set coordinates for attendance GPS validation</p>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="number" step="0.00000001" class="form-control" id="latitude" name="latitude" placeholder="e.g., 31.9454" value="{{ $academy->latitude }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="number" step="0.00000001" class="form-control" id="longitude" name="longitude" placeholder="e.g., 35.9284" value="{{ $academy->longitude }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="radius_meters" class="form-label">Radius (meters)</label>
                <input type="number" class="form-control" id="radius_meters" name="radius_meters" placeholder="e.g., 100" value="{{ $academy->radius_meters ?? 100 }}">
                <small class="text-muted">Default: 100 meters</small>
            </div>
        </div>
        
        <div class="mb-3">
            <button type="button" class="btn btn-outline-secondary" onclick="getCurrentLocation()">
                📍 Get My Current Location
            </button>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script>
function getCurrentLocation() {
    if (!navigator.geolocation) {
        alert('Geolocation is not supported by your browser');
        return;
    }
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            document.getElementById('latitude').value = position.coords.latitude.toFixed(8);
            document.getElementById('longitude').value = position.coords.longitude.toFixed(8);
            alert('Location captured! You can adjust if needed.');
        },
        function(error) {
            alert('Unable to get location: ' + error.message);
        },
        {
            enableHighAccuracy: true,
            timeout: 10000
        }
    );
}
</script>

@endsection
