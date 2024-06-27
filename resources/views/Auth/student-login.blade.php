@extends('layouts.auth')

@section('title')
    Login Page
@endsection

@section('main')
<section class="wizard-section mt-5">
    <div class="form-wizard">
        <form method="POST" action="{{ route('student.login') }}">
            @csrf
            <div class="d-flex align-items-center flex-column">
                <div class="form-group col-lg-6 col-md-7 mb-4">
                    <h1>Sign in</h1>
                </div>
                <div class="mb-4 form-group col-lg-6 col-md-7">
                    <label for="email" class="is-required">Email Address<span class="sr-only"> (required)</span></label>
                    <div class="input-group">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 form-group col-lg-6 col-md-7">
                    <label for="password" class="is-required">Password<span class="sr-only"> (required)</span></label>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
