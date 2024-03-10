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
                <caption class="visually fs-3 text-primary mb-2">View Assignments Submissions</caption>
                <thead>
                    <tr>
                        <th scope="col ">Trainee name</th>
                        <th scope="col ">Assignment name</th>
                        <th scope="col">Submissions date </th>
                        <th scope="col">Github link</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $assignment)
                    <tr>
                        <td>{{$assignment->student->en_first_name }} {{$assignment->student->en_second_name }}</td>
                        <td>{{$assignment->assignment->assignment_name }}</td>
                        <td>{{$assignment->created_at }}</td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href={{$assignment->attached_file }}target="_blank">{{$assignment->attached_file }}</a></td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="{{ route('assignment.feedbacksubmission.feedback', [$assignment->assignment->id, $assignment->student->id]) }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
