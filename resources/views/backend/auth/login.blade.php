@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Admin Panel
@endsection

@section('auth-content')
     <!-- login area start -->
     <div class="login-area">
     <!-- <img src="https://www.skylite.com/wp-content/uploads/2018/05/Skylite-Logo-Final.png" alt="Example Image" width="180px"> -->
        <div class="container">
            <div class="login-box ptb--100" >
                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <div class="login-form-head" style="background-image: url('https://www.skylite.com/wp-content/uploads/2018/05/Skylite-Logo-Final.png') ; background-repeat: no-repeat; background-position: center;">
                        <!-- <h4>Sign In </h4> -->

                        <!-- <a class="text-danger" href="{{ url('login/facebook') }}">Login with Facebook</a> -->
                    </div>
                    <div class="login-form-body">

                        @include('backend.layouts.partials.messages')
                        <div class="form-gp">

                            <!-- <label for="exampleInputEmail1">Email address or Username</label> -->
                            <input type="text" id="exampleInputEmail1" name="email" placeholder="Enter Your Email or Username">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-gp">
                            <!-- <label for="exampleInputPassword1">Password</label> -->
                            <input type="password" id="exampleInputPassword1" name="password" placeholder="Enter Your Password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            {{-- <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div> --}}
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Sign In <i class="ti-arrow-right"></i></button>
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->
@endsection