@extends('Layouts.app')
@section('title')
Trainee Absence
@endsection

@section('content')

@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
        <li class="breadcrumb-item active" aria-current="page">Absence</li>
    </ol>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Absence Record</h2>
        <div class="d-flex">
            <input type="date" class="form-control me-2" placeholder="Filter by date..." aria-label="Filter by date">
            <input type="text" class="form-control" placeholder="Search Trainee..." aria-label="Search">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="table-orange">
                <tr>
                    <th scope="col">Trainee</th>
                    <th scope="col">Absence Status</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Trainee 1</td>
                    <td>Absent</td>
                    <td>-</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('spacificUserReport')}}"><button class="btn btn-primary">View</button></a>
                        <button class="btn btn-secondary"><span class="material-symbols-outlined">upload_file</span> Report</button>

                    </td>
                </tr>
                <tr>
                    <td>Trainee 2</td>
                    <td>Late</td>
                    <td>Transportation issue</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('spacificUserReport')}}"><button class="btn btn-primary">View</button></a>
                        <button class="btn btn-secondary"><span class="material-symbols-outlined">upload_file</span> Report</button>

                    </td>
                </tr>
                <tr>
                    <td>Trainee 3</td>
                    <td>Absent</td>
                    <td>Medical leave</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('spacificUserReport')}}"><button class="btn btn-primary">View</button></a>
                        <button class="btn btn-secondary"><span class="material-symbols-outlined">upload_file</span> Report</button>


                        
                    </td>
                </tr>
                <tr>
                    <td>Trainee 4</td>
                    <td>Absent</td>
                    <td>-</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('spacificUserReport')}}"><button class="btn btn-primary">View</button></a>
                        <button class="btn btn-secondary"><span class="material-symbols-outlined">upload_file</span> Report</button>

                    </td>
                </tr>
                <tr>
                    <td>Trainee 5</td>
                    <td>Late</td>
                    <td>Delayed by previous commitment</td>
                    <td class="d-flex gap-2">
                        <a href="{{route('spacificUserReport')}}"><button class="btn btn-primary">View</button></a>
                        <button  class="btn btn-secondary"><span class="material-symbols-outlined">upload_file</span> Report</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
