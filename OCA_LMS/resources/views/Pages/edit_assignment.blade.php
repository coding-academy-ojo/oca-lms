@extends('Layouts.app')
@section('title')
Edit Assignment
@endsection
@section('content')
 
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb m-3">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href=""> Class</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href=""> Assignment </a></li>
                </ol>
            </nav>
        </div>
    </section>
    <style>
        .expand {
            max-width: 200px;
        }

        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            /* padding: 10px; */
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            max-height: 200px;
            /* Set a fixed height for the dropdown content */
            overflow-y: auto;
            /* Enable vertical scrolling if needed */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content label {
            display: block;
            padding: 8px 10px;
            cursor: pointer;
        }

        .dropdown-content label:hover {
            background-color: #ddd;
        }

        .dropdown-contentt {
            background-color: orange;
        }

        .dropdown-content input {
            margin-right: 5px;
        }

        .show {
            display: block;
        }
    </style>
    <div class="container">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Assignment</h3>
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
                                                <input type="text" class="form-control" name="title" value="php task" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Topics</label>
                                                <select class="form-select" id="class" name="topic"  required>
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
                                                <label class="my-2">Description</label>
                                                <input type="text" class="form-control" name="description" value="create DB" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Date</label>
                                                <div>
                                                    <input type="date" class="form-control" name="birthday"
                                                        min="{{ date('Y-m-d') }}" required>
                                                    <div class="invalid-feedback">This field is required</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Assignment File</label>
                                                <input type="file" class="form-control" name="image" required>
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            {{-- <label class="my-2">Students</label>
                                            <div class="dropdown ">
                                                <button class="btn btn-secondary dropdown-toggle form-control" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Dropdown button
                                                </button> --}}
                                            {{-- <div class="form-check dropdown-menu">
                                                <input class="form-check-input " type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Rawan
                                                </label>
                                              </div> --}}
                                            {{-- <ul class="dropdown-menu" style="">
                                                  <li class=""><input class="form-check-input  " type="checkbox" value="" id="flexCheckDefault">Action</li>
                                                  <li><input class="form-check-input  " type="checkbox" value="" id="flexCheckDefault">Action</li>
                                                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                              </div> --}}
                                            <div class="form-group">
                                                <label class="my-2">Students</label>
                                                <div class="dropdown-button form-control" onclick="toggleDropdown()">Select
                                                    Student</div>
                                                <div class="dropdown-content" id="dropdownContent">
                                                    <label>
                                                        <input type="checkbox" value="Option 1"> Rawan
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" value="Option 2"> Reem
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" value="Option 3"> Rand
                                                    </label>
                                                </div>

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
<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownContent");
        dropdownContent.classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        var dropdownContent = document.getElementById("dropdownContent");
        if (!event.target.matches('.dropdown-button') && !dropdownContent.contains(event.target)) {
            dropdownContent.classList.remove('show');
        }
    }
</script>
