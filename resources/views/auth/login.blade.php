@extends('auth.layout.app')
@section('content')
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
            <img src="../../assets/img/illustrations/auth-verify-email-illustration-light.png" class="auth-cover-illustration w-100" alt="auth-illustration"
                data-app-light-img="illustrations/auth-verify-email-illustration-light.png"
                data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
            <img src="../../assets/img/illustrations/auth-cover-login-mask-light.png" class="authentication-image"
                alt="mask" data-app-light-img="illustrations/auth-cover-login-mask-light.png"
                data-app-dark-img="illustrations/auth-cover-login-mask-dark.png" />
        </div>
        <!-- /Left Section -->

        <!-- Login -->
        <div
            class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
            <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                {{-- <img src="{{ url('/blue-logo.png') }}" width="150px"> --}}
                <h3 class="mb-2 fw-semibold py-2">Welcome to Login! 👋</h3>
                {{-- <p class="mb-4">Please sign-in to your account.</p> --}}
                <form action="{{ route('check') }}" id="formAuthentication" class="mb-3" method="post">
                    @csrf
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @if (Session::get('info'))
                        <div class="alert alert-info">
                            {{ Session::get('info') }}
                        </div>
                    @endif
                    @csrf

                    <div class="form-floating form-floating-outline mb-3">

                        <input type="text" class="form-control" name="email" placeholder="Enter email address"
                            @if (@isset($_COOKIE['email'])) value="{{ $_COOKIE['email'] }}" @endif required="">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                        <label for="email">Email</label>
                    </div>
                    <div class="mb-3">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" class="form-control" name="password" placeholder="Enter password"
                                        @if (@isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif
                                        required="" />
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me"
                                @if (@isset($_COOKIE['email'])) checked="" @endif />
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                        <a href="forgot" class="float-end mb-1">
                            <span>Forgot Password?</span>
                        </a>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Log in</button>
                </form>

                {{-- <p class="text-center mt-2">
                    <span>New on our platform?</span>
                    <a href="register">
                        <span>Create an account</span>
                    </a>
                </p> --}}

            </div>
        </div>
        <!-- /Login -->
    </div>
@endsection
