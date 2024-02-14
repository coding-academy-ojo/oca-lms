@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('staff')}}">Staff</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Staff</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit Staff</h2>
    <form>
        @csrf

        <div class="mb-3">
            <label for="staffName" class="form-label fw-bold">Name <small class="text-danger">: Not Modifiable</small></label>
            <input type="text" class="form-control" id="staffName" name="name" placeholder="Staff Name Here" readonly value="Ahmad">
        </div>

        <div class="mb-3">
            <label for="staffEmail" class="form-label fw-bold">Email<small class="text-danger">: Not Modifiable</small></label>
            <input type="email" class="form-control " id="staffEmail" name="email" placeholder="Staff Email Here" readonly value="Ahmad@example.com">
        </div>

        <div class="mb-3">
            <label for="academySelect" class="form-label">Academy</label>
            <select class="form-select" id="academySelect" name="academy">
                <option selected>Choose Academy...</option>
                <option value="Amman">Amman</option>
                <option value="Irbid">Irbid</option>
                <option value="Aqaba">Aqaba</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="roleSelect" class="form-label">Role</label>
            <select class="form-select" id="roleSelect" name="role">
                <option selected>Choose a role...</option>
                <option value="manager">Manager</option>
                <option value="team-leader">Team Leader</option>
                <option value="trainer">Trainer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection
