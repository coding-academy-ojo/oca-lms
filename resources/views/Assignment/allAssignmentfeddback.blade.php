@extends('Layouts.app')
@section('title')
    View Asignment Submissions
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('assignments') }}"> Assignments </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Assignments Submissions </a></li>
            </ol>
        </div>
    </section>
    <div class="container">
        <div class="col-8">
            <form action="" method="GET" class="d-flex gap-2">
                <div class="col-7 d-flex border border-light">
                    <input type="text" class="form-control border border-white"
                        placeholder="search by assignment name or topic" name="search" value="{{ request('search') }}">
                    <button class="btn rounded-0 bg-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover ">
                {{-- show all submission for assignmnet with details  --}}
                <caption class="visually fs-3 text-primary mb-2">View Assignments Submissions</caption>
                <thead>
                    <tr>
                        <th scope="col ">Trainee Name</th>
                        <th scope="col ">Assignment Name</th>
                        <th scope="col">Is Late </th>
                        <th scope="col">Github Link</th>
                        <th scope="col">Add Feedback</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- show submissions details --}}
                    @foreach ($assignments as $Assignment)
                        <tr>
                            <td>{{ $Assignment->student->en_first_name }} {{ $Assignment->student->en_second_name }}</td>
                            <td>{{ $Assignment->assignment->assignment_name }}</td>
                            @if ($Assignment->is_late == 1)
                                <td>Late</td>
                            @else
                                <td> Not late </td>
                            @endif

                            <td><a class="link-underline link-underline-opacity-0"
                                    href={{ $Assignment->attached_file }}>{{ $Assignment->attached_file }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary add-feedback-btn ms-3" data-bs-toggle="modal"
                                    data-bs-target="#addFeedback{{ $Assignment->id }}">
                                    +
                                </button>
                            </td>
                            <td>
                                @if ($Assignment->status == 'not pass')
                                    😭❌
                                @else
                                    😀 ✔
                                @endif
                            </td>
                            <td><a class="link-underline link-underline-opacity-0"
                                    href="{{ route('assignment.feedbacksubmission.feedback', [$Assignment->assignment->id, $Assignment->student->id, $Assignment->id]) }}">View</a>
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
    <div class="d-flex justify-content-center">
        {{ $assignments->links() }}
    </div>
@endsection
