@extends('Layouts.app')
@section('title')
Create Lesson
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Material</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Create Lesson</a></li>
            </ol>
        </div>
    </section>
    <div class="container mb-5">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title text-primary fs-3">Create Lesson</h3>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                        <strong>Error!</strong> Please check the inputs below:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form method="post" action="{{ route('lessons.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="my-2 fw-semibold">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter lesson title" required>
                                                <div class="invalid-feedback">Title is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="my-2 fw-semibold">Topic <span class="text-danger">*</span></label>
                                                <select class="form-select" name="topic_id" required>
                                                    <option value="">Select Topic</option>
                                                    @foreach($topics as $topic)
                                                        <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                                            {{ $topic->topic_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Please select a topic</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-group">
                                                <label class="my-2 fw-semibold">Description</label>
                                                <textarea class="form-control" name="description" rows="4" placeholder="Enter lesson description (optional)">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="my-2 fw-semibold">PDF File <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="pdf" accept=".pdf" required>
                                                <div class="invalid-feedback">Please upload a valid PDF document (Max 20MB)</div>
                                                <small class="form-text text-muted">Only PDF files are allowed. Maximum file size: 20MB.</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-3">
                                            <div class="form-group">
                                                <label class="my-2 fw-semibold">Order Position <span class="text-muted">(Optional)</span></label>
                                                <input type="number" class="form-control" name="order" value="{{ old('order') }}" min="1" placeholder="Leave empty to place at the end">
                                                <small class="form-text text-muted">Specify order number. Shifting will occur if position is occupied.</small>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary px-4">Submit</button>
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

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
