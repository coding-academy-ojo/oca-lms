@extends('layouts.app')
@section('title')
Profile
@endsection

@section('content')
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Profile</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<!-- <div class="innerPage  mt-3">
    <div class="container">
        <div class="main-body">
            <div class="col-md-2 ms-auto mb-3">
                <a href="">Edit Profile</a>
                &nbsp;  
                <a href="">Reset Password</a>
            </div>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>flan la-flane</h4>
                                    <p class="text-secondary mb-1">Full Stack Developer</p>
                                    <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg>Website</h6>
                                <span class="text-secondary">https://test.com</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>Github</h6>
                                <span class="text-secondary">test.com</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Kenneth Valdez
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    test@gmail.com
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone Number</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    1234567890
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bio</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, magna et aliquet euismod, nisl quam aliquam massa, ac ullamcorper est lorem in neque.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, magna et aliquet euismod, nisl quam aliquam massa, ac ullamcorper est lorem in neque.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod, magna et aliquet euismod, nisl quam aliquam massa, ac ullamcorper est lorem in neque.
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Education</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Skills</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <ul>
                                        <li>- Programming Languages: Java, Python, JavaScript</li>
                                        <li>- Web Development: HTML, CSS, React</li>
                                        <li>- Database Management: SQL, MongoDB</li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">CV</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <a href="{{ asset('assets/img/cv.pdf') }}" download="JohnDoe_CV.pdf">Download CV</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="innerPage mt-3">
    <div class="container">
        <div class="main-body">
            <div class="col-md-3 ms-auto mb-3">

                @auth('staff')
                <a class=" btn btn-primary mb-3" href="{{ route('profile.edit') }}">Edit Profile</a>
                &nbsp;
                @endauth
                @auth('students')
                <a class=" btn btn-primary mb-3" href="{{ route('password.reset') }}">View Details</a>
                @endauth

                <a class=" btn btn-primary mb-3" href="{{ route('password.reset') }}">Reset Password</a>
                &nbsp;

            </div>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $user->staff_name ?? $user->en_first_name }} {{$user->en_last_name }}</h4>
                                    <p class="text-secondary mb-1">{{ $user->role ?? 'Student' }}</p>
                                    <!-- You can adjust the below line to display the appropriate location -->
                                    <p class="text-muted font-size-sm">{{ $user->location ?? 'Location' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email</h6>
                                <span class="text-secondary">{{ $user->staff_email ?? $user->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Phone Number</h6>
                                <span class="text-secondary">{{ $user->staff_Phone ?? 'N/A' }}</span>
                            </li>
                            <!-- Add more user information fields here -->
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">LinkedIn</h6>
                                <span class="text-secondary"> <a href="{{ $user->linkedin ?? 'link' }}">{{ $user->linkedin ?? 'link' }}</a></span>
                               
                            </li>
                        </ul>
                    </div>
                </div>
                @auth('staff')
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bio</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->staff_bio ?? $user->about }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Education</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->education ?? '----' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Experience </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->education ?? '2 years' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Field of experience </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->field_of_experience ?? 'manager' }}
                                </div>
                            </div>
                            <!-- Add more user information fields here -->
                        </div>
                    </div>
                </div>
                @endauth

                @auth('students')
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Display user's first name -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('First Name') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->en_first_name }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's second name -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Second Name') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->en_second_name }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's third name -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Third Name') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->en_third_name }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's last name -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Last Name') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->en_last_name }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's mobile -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Mobile') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->mobile }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's birthdate -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Birthdate') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->birthdate }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's gender -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Gender') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->gender }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's education -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Education') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->education ?? '2 years' }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's educational status -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Educational Status') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->educational_status }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's city -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('City') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->city }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's address -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Address') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->address }}
                                </div>
                            </div>
                            <hr>
                            <!-- Display user's relative mobile -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Relative Mobile') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->relative_mobile_1 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @endauth

            </div>
        </div>
    </div>
</div>


@endsection





<!-- <div class="col-md-8">
    <div class="card mb-3">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('First Name') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('en_first_name', $user->en_first_name) }}" required autocomplete="en_first_name" autofocus>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Second Name') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('en_second_name', $user->en_second_name) }}" autocomplete="en_second_name">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Third Name') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('en_third_name', $user->en_third_name) }}" autocomplete="en_third_name">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Last Name') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('en_last_name', $user->en_last_name) }}" required autocomplete="en_last_name">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Mobile') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('mobile', $user->mobile) }}" required autocomplete="mobile">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Birthdate') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('birthdate', $user->birthdate) }}" required autocomplete="birthdate">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Gender') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('gender', $user->gender) }}" required autocomplete="gender">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Education') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('education', $user->education) }}" required autocomplete="education">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Educational Status') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('educational_status', $user->educational_status) }}" required autocomplete="educational_status">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('City') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('city', $user->city) }}" required autocomplete="city">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Address') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('address', $user->address) }}" required autocomplete="address">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">{{ __('Relative Mobile') }}</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" value="{{ old('relative_mobile_1', $user->relative_mobile_1) }}" required autocomplete="relative_mobile_1">
                </div>
            </div>

        </div>
    </div>
</div> -->
