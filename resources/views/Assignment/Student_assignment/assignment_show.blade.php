@extends('Layouts.app')
@section('title')
    View Assignments
@endsection
@section('content')
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Assignments </a></li>
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
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close m-auto my-auto" data-bs-dismiss="alert" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Close"><span class="visually-hidden">Close</span></button>
        </div>
    @endif
        <div class="m-auto col-9" > 
            <div class="assignment-container">
                @foreach ($assignments as $assignment)
                <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                    style="height: 50px; cursor: pointer;" onclick="toggleassignmentDetails(this)">
                    <div class="d-flex">
                        <div class="icon m-2">
                            <span class="material-symbols-outlined">assignment</span>
                        </div>
                        <div class="text m-2 pt-1"> <a
                            class="link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('Student.assignment.show', $assignment->id) }}">{{ $assignment->assignment_name}}</a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
