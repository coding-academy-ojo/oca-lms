@extends('layouts.auth')
@section('title')
    Login Page
@endsection
@section('main')
<!--<div class="col-lg-9 col-md-7" style="margin-left: 15px;">                      

     <div style="font-weight: bold">
                        <p>Thank you for taking the time to submit your application, please keep following your email to check your application status.
                        </p>
                        <p>
                            You didn't catch this training session yet? Stay tuned for our future opportunity.

                        </p>
                        <br><br>
                        <p>
                        Best of luck</p>

                        <p class="text-orange" style="color: #FF7700">Coding Academy by Orange Team    
                        </p> 
                    </div>
		</div>
-->
<section class="wizard-section mt-5">
        <div class="form-wizard">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if(session('error'))
                <div class="alert alert-danger alert-dismissable fade show text-center">
                    <button class="close " data-dismiss="alert" aria-label="Close">×</button>
                    {{session('error')}}
                </div>
            @endif
                <div class="d-flex align-items-center flex-column">
                    <div class="form-group col-lg-6 col-md-7 mb-4">
                        <h1>Sign in</h1>
                    </div>
                    <div class="mb-4 form-group col-lg-6 col-md-7 ">
                        <label for="validationServer01" class="is-required">Email address<span class="sr-only"> (required)</span></label>
                        <div class="input-group ">
                            <input name="email" type="text"
                                   class="form-control email @error('email') is-invalid @enderror " id="email"
                                   value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <small>eg: username@domain.com </small>
                    </div>
                    <div class="mb-4 form-group col-lg-6 col-md-7 ">
                        <label for="validationServer02" class="is-required">Password<span
                                class="sr-only"> (required)</span></label>
                        <div class="input-group ">
                            <input name="password" type="password"
                                   class="form-control password col-11 pr-0  @error('password') is-invalid @enderror"
                                   id="password"
                                   value="{{old('password')}}">
                            <div class="d-flex align-items-center " onclick="showPass()">
                                <i class="fa fa-eye-slash eye btn btn-light border-left-0" aria-hidden="true" ></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-7 mb-4">
                        <div class=" d-flex justify-content-start">
                            <div>
                              
                                   <a class="forget-credentials" href="">Forgot your password?</a>
                                  <!-- <a class="forget-credentials">Forgot your password?</a>-->
                             
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-7 mb-4">
                        <button class="btn btn-primary  btn-lg btn-block" type="submit"> Login</button>
                    </div>
{{--                    <div class="mb-4 form-group col-lg-6 col-md-7">--}}
{{--                      <!--  <a href="{{ route('login.google') }}" class="google btn  btn-lg btn-block">--}}
{{--                                <i class="align-self-center fab fa-google mr-1"></i>--}}
{{--                                Login with Google--}}
{{--                        </a>--}}
{{--                    </div>--}}
                   {{-- <div class="form-group col-lg-6 col-md-7 mb-4">
                        <a href="{{ route('register') }}" class="btn btn-secondary  btn-lg btn-block">Not a user? create an account </a>
                    </div>--}}
                </div>
           </form>
        </div>
    </section> 
@endsection
@section('script')
    <script>
        function showPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $('.eye').removeClass( "fa-eye-slash" );
                $('.eye').addClass( "fa-eye" );
            } else {
                x.type = "password";
                $('.eye').addClass( "fa-eye-slash" );
                $('.eye').removeClass( "fa-eye" );
            }
        }

    </script>
@endsection
