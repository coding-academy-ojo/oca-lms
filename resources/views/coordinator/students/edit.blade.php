@extends('Layouts.app')
@section('title')
    Edit Student
@endsection

@section('content')
    @include('Layouts.innerNav')

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohorts</a></li>
            <li class="breadcrumb-item"><a href="{{ route('coordinator.students.index', ['cohort_id' => $student->cohort_id]) }}">Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
        </ol>
    </nav>

    <div class="container my-5">
        <h2>Edit Student</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('coordinator.students.update', $student->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="cohort_id" value="{{ $student->cohort_id }}">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="en_first_name" class="form-label">First Name (EN)</label>
                            <input type="text" class="form-control" id="en_first_name" name="en_first_name" value="{{ old('en_first_name', $student->en_first_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="en_second_name" class="form-label">Second Name (EN)</label>
                            <input type="text" class="form-control" id="en_second_name" name="en_second_name" value="{{ old('en_second_name', $student->en_second_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="en_third_name" class="form-label">Third Name (EN)</label>
                            <input type="text" class="form-control" id="en_third_name" name="en_third_name" value="{{ old('en_third_name', $student->en_third_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="en_last_name" class="form-label">Last Name (EN)</label>
                            <input type="text" class="form-control" id="en_last_name" name="en_last_name" value="{{ old('en_last_name', $student->en_last_name) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="ar_first_name" class="form-label">First Name (AR)</label>
                            <input type="text" class="form-control" id="ar_first_name" name="ar_first_name" value="{{ old('ar_first_name', $student->ar_first_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ar_second_name" class="form-label">Second Name (AR)</label>
                            <input type="text" class="form-control" id="ar_second_name" name="ar_second_name" value="{{ old('ar_second_name', $student->ar_second_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ar_third_name" class="form-label">Third Name (AR)</label>
                            <input type="text" class="form-control" id="ar_third_name" name="ar_third_name" value="{{ old('ar_third_name', $student->ar_third_name) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ar_last_name" class="form-label">Last Name (AR)</label>
                            <input type="text" class="form-control" id="ar_last_name" name="ar_last_name" value="{{ old('ar_last_name', $student->ar_last_name) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $student->mobile) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $student->birthdate) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Additional Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="national_id" class="form-label">National ID</label>
                            <input type="number" class="form-control" id="national_id" name="national_id" value="{{ old('national_id', $student->national_id) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="passport_number" class="form-label">Passport Number</label>
                            <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ old('passport_number', $student->passport_number) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $student->city) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $student->country) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $student->address) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="education" class="form-label">Education</label>
                            <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $student->education) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="field" class="form-label">Field</label>
                            <input type="text" class="form-control" id="field" name="field" value="{{ old('field', $student->field) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_link" class="form-label">GitHub Link</label>
                            <input type="url" class="form-control" id="github_link" name="github_link" value="{{ old('github_link', $student->github_link) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="linkedin_link" class="form-label">LinkedIn Link</label>
                            <input type="url" class="form-control" id="linkedin_link" name="linkedin_link" value="{{ old('linkedin_link', $student->linkedin_link) }}">
                        </div>
                    </div>
                </div>
            </div>



            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('coordinator.students.index', ['cohort_id' => $student->cohort_id]) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>
@endsection

