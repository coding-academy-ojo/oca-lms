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


  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
    <div class="row flex-lg-nowrap">
      <div class="col-12 col-lg-auto mb-3" style="width: 200px;">

      </div>

      <div class="col">
        <div class="row">
          <div class="col mb-3">
            <div class="card">
              <div class="card-body">
                <div class="e-profile">
                  <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                          <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">John Smith</h4>

                        <div class="mt-2">
                          <button class="btn btn-primary" type="button">
                            <i class="fa fa-fw fa-camera"></i>
                            <span>Change Photo</span>
                          </button>
                        </div>
                      </div>

                    </div>
                  </div>
                  
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <form class="form" novalidate="">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Full Name</label>
                                  <input class="form-control" type="text" name="name" placeholder="John Smith" value="John Smith">
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input class="form-control" type="text" name="username" placeholder="johnny.s" value="johnny.s">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input class="form-control" type="text" placeholder="[email protected]">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col mb-3">
                                <div class="form-group">
                                  <label>About</label>
                                  <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-2"><b>Change Password</b></div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Current Password</label>
                                  <input class="form-control" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>New Password</label>
                                  <input class="form-control" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                  <input class="form-control" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                            <div class="mb-2"><b>Keeping in Touch</b></div>
                            <div class="row">
                              <div class="col">
                                <label>Email Notifications</label>
                                <div class="custom-controls-stacked px-2">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                    <label class="custom-control-label" for="notifications-blog">Blog posts</label>
                                  </div>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                    <label class="custom-control-label" for="notifications-news">Newsletter</label>
                                  </div>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                    <label class="custom-control-label" for="notifications-offers">Personal Offers</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                          </div>
                        </div>
                      </form>
                      <form class="form" novalidate="">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="fullName">Full Name</label>
                              <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" value="John Smith">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter your email" value="[email protected]">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="phoneNumber">Phone Number</label>
                              <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phone number">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label for="bio">Bio</label>
                              <textarea class="form-control" id="bio" rows="5" placeholder="Enter your bio"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="education">Education</label>
                              <textarea class="form-control" id="education" rows="3" placeholder="Enter your education"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="skills">Skills</label>
                              <textarea class="form-control" id="skills" rows="3" placeholder="Enter your skills"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="cv">CV</label>
                              <input type="file" class="form-control" id="cv">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" class="form-control" id="image">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
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

      </div>
    </div>
  </div>


</div> -->

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Edit Profile') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <!-- Display errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            @endif

            <!-- Name inputs -->
            @if(Auth::guard('students')->check())
            <div class="form-group mb-3">
              <label for="en_first_name">{{ __('First Name') }}</label>
              <input id="en_first_name" type="text" class="form-control @error('en_first_name') is-invalid @enderror" name="en_first_name" value="{{ old('en_first_name', $user->en_first_name) }}" required autocomplete="en_first_name" autofocus>
              @error('en_first_name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="en_second_name">{{ __('Second Name') }}</label>
              <input id="en_second_name" type="text" class="form-control @error('en_second_name') is-invalid @enderror" name="en_second_name" value="{{ old('en_second_name', $user->en_second_name) }}" autocomplete="en_second_name">
              @error('en_second_name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="en_third_name">{{ __('Third Name') }}</label>
              <input id="en_third_name" type="text" class="form-control @error('en_third_name') is-invalid @enderror" name="en_third_name" value="{{ old('en_third_name', $user->en_third_name) }}" autocomplete="en_third_name">
              @error('en_third_name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="en_last_name">{{ __('Last Name') }}</label>
              <input id="en_last_name" type="text" class="form-control @error('en_last_name') is-invalid @enderror" name="en_last_name" value="{{ old('en_last_name', $user->en_last_name) }}" required autocomplete="en_last_name">
              @error('en_last_name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>
            @else
            <div class="form-group mb-3">
              <label for="staff_name">{{ __('Name') }}</label>
              <input id="staff_name" type="text" class="form-control @error('staff_name') is-invalid @enderror" name="staff_name" value="{{ old('staff_name', $user->staff_name) }}" required autocomplete="staff_name" autofocus>
              @error('staff_name')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>
            @endif

            <!-- Email input -->
            <div class="form-group mb-3">
              <label for="email">{{ __('Email') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->staff_email ?? $user->email) }}" required autocomplete="email">
              @error('email')
              <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            <!-- Add more fields as needed -->

            <!-- Submit button -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection