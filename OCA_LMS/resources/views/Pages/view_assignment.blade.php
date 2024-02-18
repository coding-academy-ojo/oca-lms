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
            <div class="my-5">
                <a href="{{ route('create_assignment') }}" class="btn btn-primary m-auto"
                    style="width: 90px; height:50px">Create</a>
            </div>
            <div class="assignment-container">
                <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                    style="height: 50px; cursor: pointer;" onclick="toggleassignmentDetails(this)">
                    <div class="d-flex">
                        <div class="icon m-2">
                            <span class="material-symbols-outlined">assignment</span>
                        </div>
                        <div class="text m-2 pt-1">Crete database</div>
                    </div>
                    <div class="clickable-icon" data-bs-toggle="dropdown" data-target="#optionsModal">
                        <span class="material-symbols-outlined mt-2 me-2">more_vert</span>
                        <ul class="dropdown-menu dropdown-menu-end rounded-2">
                            <li><a class="dropdown-item" href="{{ route('edit_assignment') }}">Edit</a></li>
                            <li>
                                <form action="" method="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="assignment-details border border-top-0 border-light pt-3 px-3" style="display: none;">
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    <p class="border-top border-light mt-3 pt-3"><a
                            class="link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('submit_assignment') }}">View assignment</a></p>
                </div>
                <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                    style="height: 50px; cursor: pointer;" onclick="toggleassignmentDetails(this)">
                    <div class="d-flex">
                        <div class="icon m-2">
                            <span class="material-symbols-outlined">assignment</span>
                        </div>
                        <div class="text m-2 pt-1">create Attendance system</div>
                    </div>
                    <div class="clickable-icon " data-bs-toggle="dropdown" data-target="#optionsModal">
                        <span class="material-symbols-outlined mt-2 me-2">more_vert</span>
                        <ul class="dropdown-menu dropdown-menu-end rounded-2">
                            <li><a class="dropdown-item" href="{{ route('edit_assignment') }}">Edit</a></li>
                            <li>
                                <form action="" method="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="assignment-details border border-top-0 border-light pt-3 px-3" style="display: none;">
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    <p class="border-top border-light mt-3 pt-3"><a
                            class="link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('submit_assignment') }}">View assignment</a></p>
                </div>
                <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                    style="height: 50px; cursor: pointer;" onclick="toggleassignmentDetails(this)">
                    <div class="d-flex">
                        <div class="icon m-2">
                            <span class="material-symbols-outlined">assignment</span>
                        </div>
                        <div class="text m-2 pt-1">Laravel</div>
                    </div>
                    <div class="clickable-icon " data-bs-toggle="dropdown" data-target="#optionsModal">
                        <span class="material-symbols-outlined mt-2 me-2">more_vert</span>
                        <ul class="dropdown-menu dropdown-menu-end rounded-2">
                            <li><a class="dropdown-item" href="{{ route('edit_assignment') }}">Edit</a></li>
                            <li>
                                <form action="" method="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="assignment-details border border-top-0 border-light pt-3 px-3" style="display: none;">
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code>
                    class. This is the second item's accordion body. Let's imagine this being filled with some actual
                    content.
                    <p class="border-top border-light mt-3 pt-3"><a
                            class="link-offset-2 link-underline link-underline-opacity-0"
                            href="{{ route('submit_assignment') }}">View assignment</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleassignmentDetails(assignment) {
            const details = assignment.nextElementSibling;
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
            // details.style.border = "1px solid #ccc";  
        }
    </script>
@endsection
