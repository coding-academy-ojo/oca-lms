@extends('Layouts.app')
@section('title')
Create Topic
@endsection
@section('content')
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Topic </a></li>
            </ol>
        </div>
    </section>
    <div class="container">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title text-primary">Create Topic </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('topic.store') }}" enctype="multipart/form-data" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Title</label>
                                                <input type="text" class="form-control" name="topic_name" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Technology</label>
                                                <select class="form-select" id="class" name="technology_id" required>
                                                    <option value="">Select topic</option>
                                                    @foreach($technologies as $technology)
                                                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
