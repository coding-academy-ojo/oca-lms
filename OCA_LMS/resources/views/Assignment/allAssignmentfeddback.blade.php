@extends('Layouts.app')
@section('title')
    View Asignment Submissions
@endsection
@section('content')
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Assignments </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Feedback </a></li>
            </ol>
        </div>
    </section>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover ">
                {{-- show all submission for assignmnet with details  --}}
                <caption class="visually fs-3 text-primary mb-2">View Assignments Submissions</caption>
                <thead>
                    <tr>
                        <th scope="col ">Trainee Name</th>
                        <th scope="col ">Assignment Name</th>
                        <th scope="col">Submissions Date </th>
                        <th scope="col">Github Link</th>
                        <th scope="col">Add Feedback</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->student->en_first_name }} {{ $assignment->student->en_second_name }}</td>
                            <td>{{ $assignment->assignment->assignment_name }}</td>
                            <td>{{ $assignment->created_at }}</td>
                            <td><a class="link-underline link-underline-opacity-0"
                                    href={{ $assignment->attached_file }}target="_blank">{{ $assignment->attached_file }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary add-feedback-btn" data-bs-toggle="modal"
                                    data-bs-target="#addFeedback{{ $assignment->id }}">
                                    Add feedback
                                </button>
                            </td>
                            <td><a class="link-underline link-underline-opacity-0"
                                    href="{{ route('assignment.feedbacksubmission.feedback', [$assignment->assignment->id, $assignment->student->id]) }}">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal to add feedback-->
    @foreach ($assignments as $assignment)
        <div class="modal fade" id="addFeedback{{ $assignment->id }}" tabindex="-1"
            aria-labelledby="addFeedbackLabel{{ $assignment->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFeedbackLabel{{ $assignment->id }}">Add feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('submission_feedback.update', $assignment->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="topicName" class="form-label">Add feedback</label>
                                <input type="text" class="form-control" name="Assignment_feedback"
                                    value="{{ $assignment->feedback }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
