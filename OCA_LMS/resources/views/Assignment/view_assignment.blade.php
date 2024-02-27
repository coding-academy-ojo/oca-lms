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
        
        <div class="m-auto col-8" >
            @if  (auth()->check() && auth()->user()->role == "trainer")
            <div class="my-5">
                <a href="{{ route('assignment.create') }}" class="btn btn-primary m-auto"
                    style="width: 90px; height:50px">Create</a>
            </div>   
            @endif
          
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
                            href="{{ route('assignment.show', $assignment->id) }}">{{ $assignment->assignment_name}}</a></div>
                    </div>
                    @if  (auth()->check() && auth()->user()->role == "trainer")

                    <div class="my-auto d-flex">
                        <a class="mx-2" href="{{ route('assignment.edit', $assignment->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('assignment.destroy', $assignment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border border-0 m-auto bg-white"
                            onclick="return confirm('Are you sure you want to delete this assignment')">
                            <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                        </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
