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
        <div class="col-12 m-auto my-3"><b>Technology:</b> {{ $assignment->topic->technology->name }}</div>
        <div class="col-12 m-auto my-3"><b>Topic:</b> {{ $assignment->topic->topic_name }}</div>
        <div class="col-12 m-auto mt-3">{{ $assignment->assignment_description}}</div>
        @if (!empty($assignment->assignment_attached_file))
        <a href="{{ route('download', ['filename' => $assignment->assignment_attached_file]) }}">{{ $assignment->assignment_attached_file}}</a>
    @else
        <p>No file available for download.</p>
    @endif
            <div class="mt-3">
              <b>Deadline: {{ $assignment->assignment_due_date }}</b> 
            </div>
        <form method="" action="" enctype="multipart/form-data" class="needs-validation"
        novalidate>
        @csrf
        <div class="input-group my-3">
            <input type="text" class="form-control" placeholder="submit your assignment" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">Submit</button>
          </div>
        </form>
    </div>
    </div>
@endsection
