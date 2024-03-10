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
            {{-- view assignmnet details --}}
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
            {{-- view all student submission for this assignmnet --}}
            <div class="border border-light my-2">
                @foreach ($assignment_submissions as $assignment_submission)
                <p class="mx-3">{{ $assignment_submission->student->en_first_name }} {{ $assignment_submission->student->en_second_name }}</p>
                    <div class="d-flex justify-content-between border border-light my-3 py-3 mx-3">
                        
                        <div class="mx-4"> <a class="link-underline link-underline-opacity-0"
                            href={{$assignment_submission->attached_file }}target="_blank">{{$assignment_submission->attached_file }}</a></div>
                        <div class="mx-4"> {{ $assignment_submission->created_at }}</div>
                    </div>

                    <p class="mx-3">{{ $assignment_submission->staff->staff_name }}</p>
                    <div class="d-flex justify-content-between border border-primary my-3 py-3 mx-3">
                        <div class="mx-4"> {{ $assignment_submission->feedback }}</div>
                        <div class="mx-4"> {{ $assignment_submission->updated_at }}</div>
                    </div>
                @endforeach
            </div>
            @if (auth()->check() && auth()->user()->role == 'trainer')
                <form method="post" action="{{ route('assignment.feedbacksubmission.store') }}"
                    enctype="multipart/form-data" class="needs-validation  m-auto" novalidate>
                    @csrf
                    <div class="input-group my-3 ">
                        <input type="hidden" name="Assignment_submission_ID" value="{{ $assignment_submission->id }}">
                        <input type="text" class="form-control" name="Assignment_feedback"
                            placeholder="write your feedback" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Submit</button>
                    </div>
                    <input type="hidden" name="Assignment_submission_ID" value="{{ $assignment_submission->id }}">
                </form>
            @else
                <form method="post" action="{{ route('Student.assignment.store') }}" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="input-group my-3">
                        <input type="text" class="form-control" name="Assignment_submission"
                            placeholder="submit your work" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Submit</button>
                    </div>
                    <input type="hidden" name="Assignment_ID" value="{{ $assignment->id }}">
                </form>
            @endif


        </div>
    </div>
@endsection
