@extends('Layouts.app')
@section('title')
    View Assignment
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
            {{-- <div class="col-12 m-auto my-3"><b>Technology:</b> {{ $assignment->topic->roadmap->technologies->technology_name }}</div> --}}
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
        </div>
    </div>
@endsection
