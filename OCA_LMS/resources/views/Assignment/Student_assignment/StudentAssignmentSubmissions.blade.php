@extends('Layouts.app')
@section('title')
    Submit Assignment
@endsection
@section('content')
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Assignment </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Submit Assignment </a></li>
            </ol>
        </div>
    </section>
    <div class="contanier">
        <div class="col-10 m-auto">
            <h2 class="col-12 m-auto">{{ $assignment->assignment_name }}</h2>
            <div class="col-12 m-auto my-3"><b>Technology:</b> {{ $assignment->topic->technology->technologies_name }}</div>
            <div class="col-12 m-auto my-3"><b>Topic:</b> {{ $assignment->topic->topic_name }}</div>
            <div class="col-12 m-auto my-3">{{ $assignment->assignment_description }}</div>
            @if (!empty($assignment->assignment_attached_file))
                <div class="my-3"><b>Assignment file:</b> </div>
                <a class="link-underline link-underline-opacity-0"
                    href="{{ route('download', ['filename' => $assignment->assignment_attached_file]) }}">{{ $assignment->assignment_attached_file }}</a>
            @endif
            <div class="mt-3">
                <b>Deadline: {{ $assignment->assignment_due_date }}</b>
            </div>
            <form method="post" action="{{ route('Student.assignment.store') }}" enctype="multipart/form-data" class="needs-validation"
            novalidate>
            @csrf
            <div class="input-group my-3 ">
                <input type="text" class="form-control" name="Assignment_submission" placeholder="submit your work" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="submit" id="button-addon2">Submit</button>
              </div>
            {{-- <input type="text" name="Assignment_submission" placeholder="sbmiot your work"> --}}
            <input type="hidden" name="Assignment_ID" value="{{ $assignment->id }}">
            </form>
        </div>
    </div>
@endsection
