@extends('Layouts.app')
@section('title')
    View Assignments
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Assignments</li>
            </ol>
        </div>
    </section>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .assignment:hover {
            box-shadow: 8px 1px 8px 1px rgb(197, 197, 197);
            border: 2px rgb(196, 196, 196);
            border-radius: 3px;

        }
    </style>
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show col-8 m-auto" role="alert">
            <span class="alert-icon"><span class="visually-hidden">Warning</span></span>
            <p>{{ session('success') }} </p>
            
            <button type="button" class="btn-close m-auto my-auto" data-bs-dismiss="alert" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Close"><span class="visually-hidden">Close</span></button>
        </div>
    @endif
        <div class="m-auto" > 
        <div class="table-responsive card my-3" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-hover">
    <thead>
        <tr class="table-light">
            <th>Assignment Name</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
                @foreach ($assignments as $assignment)
 
        <tr onclick="toggleassignmentDetails(this)" style="cursor: pointer;">
            <td>
                <div class="d-flex">
                    <div class="icon m-2">
                        <span class="material-symbols-outlined">assignment</span>
                    </div>
                    <div class="text m-2 pt-1">
                        <a class="link-offset-2 link-underline link-underline-opacity-0"
                           href="{{ route('Student.assignment.show', $assignment->id) }}">
                            {{ $assignment->assignment_name }}
                        </a>
                    </div>
                </div>
            </td>
            <td class="m-2 pt-1">{{ $assignment->assignment_due_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

                
            </div>
        </div>
    </div>
@endsection
