@extends('Layouts.app')
@section('title')
Trainee Attendance
@endsection

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
        <li class="breadcrumb-item active" aria-current="page">Attendance</li>
    </ol>
</nav>






<div class="container mt-5">
    <div class="py-3 d-flex justify-content-between">
        <h2 class="text-primary">Attendance Record</h2>
        <div class="col-auto">
            <input type="date" class="form-control">
        </div>
    </div>
    <form>

        <!-- Block 1 -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3 mb-0">Trainee 1</label>
            <select style="width: fit-content;" ; class="form-select" aria-label="Select attendance status">
                <option >Attended</option>
                <option selected>Absent</option>
                <option>Late</option>
            </select>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3 mb-0">Trainee 1</label>
            <select style="width: fit-content;" ; class="form-select" aria-label="Select attendance status">
                <option selected>Attended</option>
                <option>Absent</option>
                <option>Late</option>
            </select>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3 mb-0">Trainee 1</label>
            <select style="width: fit-content;" ; class="form-select" aria-label="Select attendance status">
                <option >Attended</option>
                <option selected>Absent</option>
                <option>Late</option>
            </select>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3 mb-0">Trainee 1</label>
            <select style="width: fit-content;" ; class="form-select" aria-label="Select attendance status">
                <option selected>Attended</option>
                <option>Absent</option>
                <option>Late</option>
            </select>
        </div>
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3 mb-0">Trainee 1</label>
            <select style="width: fit-content;" ; class="form-select" aria-label="Select attendance status">
                <option >Attended</option>
                <option>Absent</option>
                <option selected>Late</option>
            </select>
        </div>



        <!-- Submit button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-dark">Update Attendance</button>
        </div>
    </form>
</div>

@endsection
