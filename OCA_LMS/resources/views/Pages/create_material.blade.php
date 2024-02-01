@extends('Layouts.app')
@section('content')
<nav class="navbar  navbar-expand-lg  supra"
aria-label="Supra navigation - With an additional languages navbar example">
<div class="container-xxl">
    <ul class="navbar-nav me-auto mx-5 px-3 ">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Stream</a>
        </li>
        <li class="nav-item"><a href="#" class="nav-link">Classwork</a></li>
        <li class="nav-item"><a href="#" class="nav-link">People</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Marks</a></li>

    </ul>
</div>
</nav>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Class</li>
                <li class="breadcrumb-item active" aria-current="page">Material </li>
            </ol>
        </nav>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Material </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="" action="" enctype="multipart/form-data" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Title</label>
                                                <input type="text" class="form-control" name="title" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Topics</label>
                                                <select class="form-select" id="class" name="topic" required>
                                                    <option value="">Select topic</option>
                                                    <option value="">HTML</option>
                                                    <option value="">CSS</option>
                                                    <option value="">PHP</option>
                                                </select>
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Resources Links</label>
                                                <input type="text" class="form-control" name="description" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Assignment File</label>
                                                <input type="file" class="form-control" name="image" required>
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
