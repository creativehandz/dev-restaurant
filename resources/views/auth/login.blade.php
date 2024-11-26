@extends('auth.layouts')

@section('content')



<div class="row">
    <div class="col-lg-12 d-flex flex-column justify-content-center align-items-center bg-black mnh-100vh">
        <a class="u-login-form py-3 mb-auto" href="index.html">
        </a>

        <div class="u-login-form">
            <div class="mb-3">
                <div class="py-3 mb-auto">
                    <a class="u-login-form mb-auto text-center" href="index.html">
                        <img class="img-fluid" src="{{ asset('img/display-logo.png') }}" width="80" alt="Restaurant Admin"> 
                    </a>
                </div>
                <h1 class="h2 text-white">Welcome Back!</h1>
                <p class="small text-golden">Login to your dashboard with your registered email address and password.
                </p>
            </div>
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                <div class="form-group mb-4">
                    <label for="email" class="text-white">Your email</label>

                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif

                </div>
                <div class="form-group mb-4">
                    <label for="password" class="text-white">Password</label>

                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                </div>

                  <div class="col-auto">
               
            </div>
                <div class="form-group d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input id="rememberMe" class="custom-control-input" name="rememberMe" type="checkbox">
                        <label class="custom-control-label text-white" for="rememberMe">Remember me</label>
                    </div>

     <a class="link-muted small text-white" href="{{ route('forget.password.get') }}">
                    Forgot password??
                </a>
                   <!--  <a class="" href="rafw-account-password-recover.html">Forgot
                        Password?</a> -->
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-warning btn-block" value="Login">
                </div>
            </form>
        </div>
        <div class="u-login-form text-muted py-3 mt-auto">
        </div>
    </div>
</div>



@endsection