@extends('Layouts.app')
@section('title')
Edit Academy
@endsection

@section('content')

@include('layouts.innerNav')


<nav style="    padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{asset('Academeies')}}">Academeies</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Academy</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit Academy</h2>
    <form>
        <div class="mb-3">
            <label for="academyName" class="form-label">Academy Name</label>
            <input type="text" class="form-control" id="academyName" placeholder="Enter academy name" value="Academy Name Here">
        </div>
        <div class="mb-3">
            <label for="academyManager" class="form-label">Academy Manager</label>
            <input type="text" class="form-control" id="academyManager" placeholder="Enter academy manager's name" value="Manager's Name Here">
        </div>
        <div class="mb-3">
            <label for="academyDescription" class="form-label">Description</label>
            <textarea class="form-control" id="academyDescription" rows="3" placeholder="Enter academy description">Academy Description Here</textarea>
        </div>

        <!-- Additional fields for courses, instructors, etc., can be added here -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection