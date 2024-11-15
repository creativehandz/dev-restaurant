{{-- 
@include('layouts.frontend')  
@yield('contents')
--}} 

@extends('auth.layouts')

@section('content')


<div class="row">
    <div class="col-lg-12 d-flex flex-column justify-content-center align-items-center bg-black mnh-100vh">
        <a class="u-login-form py-3 mb-auto" href="index.html"></a>
        <div class="u-login-form">
            <div class="mb-3">
                <div class="py-3 mb-auto">
                        <a class="u-login-form mb-auto text-center" href="index.html">
                            <img class="img-fluid" src="{{ asset('img/main-logo-two.png') }}" width="80" alt="RAFW Admin">
                        </a>
                </div>
                <h1 class="h2 text-white">Reset password!</h1>
                <p class="small text-golden">Enter your email address. You will get a link to reset the password.</p>
            </div>
            @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
  
                      <form action="{{ route('forget.password.post') }}" method="POST">
                          @csrf
                          <div class="form-group mb-4">
                              <label for="email_address" class="text-white">E-Mail Address</label>
                              
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              
                          </div>
                          <div class="mb-3">
                              <button type="submit" class="btn btn-warning btn-block">
                                  Send Password Reset Link
                              </button>
                          </div>
                      </form>
                        
        </div>
        <div class="u-login-form text-muted py-3 mt-auto">
        </div>
    </div>
</div>


@endsection
          
              
                  
  
                   
               
              
          

