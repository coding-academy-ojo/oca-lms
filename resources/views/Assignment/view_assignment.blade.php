@extends('Layouts.app')
@section('title')
    View Assignments
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Home</a></li>
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
                <button type="button" class="btn-close m-auto my-auto" data-bs-dismiss="alert" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="Close"><span class="visually-hidden">Close</span></button>
            </div>
        @endif
        {{-- search based on assignmnet name & topic name  --}}
        <div class="row d-flex  ">
            <div class="col-9">
            <form action="" method="GET" class="d-flex gap-2">
                <div class="col-7 d-flex border border-light">
                    <input type="text" class="form-control border border-white"
                        placeholder="Search by assignment name or topic" name="search" value="{{ request('search') }}">
                    <button class="btn rounded-0 btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            
                {{-- Filter based on technology --}}
                <select class="form-select" name="technology_id" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="">All Technologies</option>
                    @foreach ($technologies as $technology)
                        <option value="{{ $technology->id }}" {{ request('technology_id') == $technology->id ? 'selected' : '' }}>
                            {{ $technology->technologies_name }}
                        </option>
                    @endforeach
                </select>
            </form>
            </div>
            <div class=" col-3">
                <a href="{{ route('assignment.create') }}" class="btn btn-primary m-auto">Create</a>
                <a href="{{ route('assignments.feedback') }}" class="btn btn-primary m-auto">Submission</a>
            </div>
        </div>
        <div class="m-auto ">
        <h3 class="visually fs-3 text-primary my-3">View Assignments</h3>
            <div class="table-responsive card ">
                
                <table class="table table-hover ">
                    {{-- show all assignmnets --}}
                    
                    <thead>
                        <tr>
                            <th scope="col ">Assignment Name</th>
                            <th scope="col">Topic Name </th>
                            <th scope="col">Technology </th>
                            <th scope="col">Details </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td><a class="link-offset-2 link-underline link-underline-opacity-0"
                                        href="{{ route('assignment.show', $assignment->id) }}">{{ $assignment->assignment_name }}  </a>
                                </td>
                                <td>{{ optional($assignment->topic)->topic_name }}</td>
                                <td>
                                    {{ $assignment->topic->technologyCohort->technology->technologies_name }}
                                </td>
                                <td> <a class="mx-2 link-underline link-underline-opacity-0"
                                        href="{{ route('assignment.show', $assignment->id) }}">view</a>
                                </td>
                                <td>
                                    <div class="my-auto d-flex">
                                        <a class="mx-2" href="{{ route('assignment.edit', $assignment->id) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <form action="{{ route('assignment.destroy', $assignment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border border-0 m-auto bg-white"
                                                onclick="return confirm('Are you sure you want to delete this assignment')">
                                                <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $assignments->links() }}
        </div>
    </div>
@endsection
