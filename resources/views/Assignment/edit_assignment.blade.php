@extends('Layouts.app')
@section('title')
    Edit Assignment
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb m-3">
                    <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('assignments') }}"> Assignment </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Edit Assignment </a></li>

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

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .input-sizer {
            display: inline-grid;
            vertical-align: top;
            align-items: center;
            position: relative;
            border: solid 1px;

            &.stacked {
                padding: .5em;
                align-items: stretch;

                &::after,
                input,
                textarea {
                    grid-area: 2 / 1;
                }
            }

            &::after,
            input,
            textarea {
                width: auto;
                min-width: 1em;
                grid-area: 1 / 2;
                font: inherit;
                padding: 0.25em;
                margin: 0;
                resize: none;
                background: none;
                appearance: none;
                border: none;
            }


            &::after {
                content: attr(data-value) ' ';
                visibility: hidden;
                white-space: pre-wrap;
            }



            textarea:focus,
            input:focus {
                outline: none;
            }
        }
    </style>
    <div class="container">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title text-primary">Edit Assignment</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('assignment.update', $assignment->id) }}"
                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Title</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $assignment->assignment_name }}" required>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Topics</label>
                                                <select class="form-select" id="class" name="topic" required>
                                                    <option value="{{ $assignment->topic_id }}">
                                                        {{ $assignment->topic->topic_name }}</option>
                                                    @foreach ($topics as $topic)
                                                        <option value="{{ $topic->id }}">{{ $topic->topic_name }} -
                                                            </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Date</label>
                                                <div>
                                                    <input type="date" class="form-control" name="due_date"
                                                        value="{{ $assignment->assignment_due_date }}" required>
                                                    <div class="invalid-feedback">This field is required</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Level</label>
                                                <select class="form-select" id="class" name="level" required>
                                                    <option value="{{ $assignment->assignment_level }}">
                                                        {{ $assignment->assignment_level }}</option>
                                                    <option value="easy">Easy</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="advance">Advance</option>
                                                </select>
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Assignment File</label>
                                                <input type="file" class="form-control" name="assignment_file"
                                                    value="{{ $assignment->assignment_attached_file }}"
                                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" onchange="validateFile(this)">
                                                <div class="invalid-feedback">This field is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="my-2">Students</label>
                                                <div class="dropdown-button form-control" onclick="toggleDropdown()">Select
                                                    Student</div>
                                                <div class="dropdown-content" id="dropdownContent">
                                                    @if(!$isAllAssigned)
                                                    <label>
                                                        <input class="form-check-input" type="checkbox" name="students[]"
                                                            value="" onclick="selectAll()">All students
                                                    </label>
                                                    @endif
                                                    @foreach ($assignmentStudents as $student)
                                                        <label>
                                                            <input class="form-check-input" type="checkbox"
                                                                name="students[]"
                                                                value="{{ $student->id }}">{{ $student->en_first_name }}
                                                            {{ $student->en_last_name }}
                                                        </label>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="form-group">
                                                <label class="my-2 ">Description</label>
                                                <label class="input-sizer stacked col-12 form-control border border-light">
                                                    <textarea oninput="this.parentNode.dataset.value = this.value " rows="2" id="myTextarea" name="description"> {{ $assignment->assignment_description }} </textarea>
                                                </label>
                                                <div class="invalid-feedback">This feild is required</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-12 ">
                                    @foreach ($students as $Student)
                                        <div class="d-flex">
                                            <div class="my-2 mx-2">{{ $Student->en_first_name }}</div>
                                            <div class="my-2">
                                                <form action="{{ route('assignment.removeStudent', ['assignment' => $assignment->id, 'student' => $Student->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border border-0 m-auto bg-white"
                                                        onclick="return confirm('Are you sure you want to delete this student')">
                                                        <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

    /////////////////////////
    function validateFile(input) {
        const file = input.files[0];
        const validExtensions = ['.pdf', '.doc', '.docx', '.jpg', '.jpeg', '.png'];
        const maxFileSize = 5 * 1024 * 1024; // 5MB

        if (file) {
            const fileName = file.name;
            const fileSize = file.size;
            const fileExtension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();

            if (!validExtensions.includes(fileExtension) || fileSize > maxFileSize) {
                input.setCustomValidity('Invalid file type or size (PDF, Word, or Image only, max 5MB).');
            } else {
                input.setCustomValidity('');
            }
        } else {
            // If no file is selected, clear any existing validation message
            input.setCustomValidity('');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

    });
</script>
