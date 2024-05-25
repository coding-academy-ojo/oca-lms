@extends('layouts.auth')

@section('title')
    Login Page
@endsection

@section('main')
<section class="wizard-section mt-5">
    <div class="form-wizard">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="d-flex align-items-center flex-column">
                <div class="form-group col-lg-6 col-md-7 mb-4">
                    <h1>Sign in</h1>
                </div>
                <div class="mb-4 form-group col-lg-6 col-md-7 ">
                    <label for="staff_email" class="is-required">Email address<span class="sr-only"> (required)</span></label>
                    <div class="input-group ">
                        <input name="staff_email" type="text" class="form-control @error('staff_email') is-invalid @enderror" id="staff_email" value="{{ old('staff_email') }}">
                        @error('staff_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <small>eg: username@domain.com</small>
                </div>
                <div class="mb-4 form-group col-lg-6 col-md-7 ">
                    <label for="password" class="is-required">Password<span class="sr-only"> (required)</span></label>
                    <div class="input-group ">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                        <div class="d-flex align-items-center " onclick="showPass()">
                            <i class="fa fa-eye-slash eye btn btn-light border-left-0" aria-hidden="true"></i>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-7 mb-4">
                    <div class="d-flex justify-content-start">
                        <div>
                            {{-- <a class="forget-credentials" href="#">Forgot your password?</a> --}}
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-7 mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                </div>
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
            $('.eye').removeClass("fa-eye-slash");
            $('.eye').addClass("fa-eye");
        } else {
            x.type = "password";
            $('.eye').addClass("fa-eye-slash");
            $('.eye').removeClass("fa-eye");
        }
    }
</script>
@endsection
