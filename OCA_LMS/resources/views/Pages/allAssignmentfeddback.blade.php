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
        <div>
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
                    <tr>
                        <td>Rawan Bilal</td>
                        <td>Create Database</td>
                        <td>7/2/2024</td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="https://trello.com/b/OFxkzaRe/lms" target="_blank">https://trello.com/b/OFxkzaRe/lms</a></td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="{{ route('submit_assignment') }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Ahmad Hassan</td>
                        <td>Create table</td>
                        <td>8/2/2024</td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="https://trello.com/b/OFxkzaRe/lms" target="_blank">https://trello.com/b/OFxkzaRe/lms</a></td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="{{ route('submit_assignment') }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Rawan Bilal</td>
                        <td>Create Database</td>
                        <td>7/2/2024</td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="https://trello.com/b/OFxkzaRe/lms" target="_blank">https://trello.com/b/OFxkzaRe/lms</a></td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="{{ route('submit_assignment') }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Rand Kharoush</td>
                        <td>Create Database</td>
                        <td>8/2/2024</td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="https://trello.com/b/OFxkzaRe/lms" target="_blank">https://trello.com/b/OFxkzaRe/lms</a></td>
                        <td><a class="link-underline link-underline-opacity-0"
                                href="{{ route('submit_assignment') }}">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
