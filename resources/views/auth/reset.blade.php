@extends('auth.layout.app')
@section('content')
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
            <img src="../../assets/img/illustrations/auth-reset-password-illustration-light.png"
                class="auth-cover-illustration w-100" alt="auth-illustration"
                data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
                data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png" />
            <img src="../../assets/img/illustrations/auth-cover-reset-password-mask-light.png" class="authentication-image"
                alt="mask" data-app-light-img="illustrations/auth-cover-reset-password-mask-light.png"
                data-app-dark-img="illustrations/auth-cover-reset-password-mask-dark.png" />
        </div>
        <!-- /Left Section -->

        <!-- Reset Password -->
        <div
            class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
            <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                <h2 class="mb-2 fw-semibold">Reset Password 🔒</h2>
                <p class="mb-4">Your new password must be different from previously used passwords</p>
                <form action="{{ route('reset.password') }}" method="post" id="formAuthentication" class="mb-3">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3 form-password-toggle">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="email" placeholder="Enter email address"
                                value="{{ $email ?? old('email') }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <label for="email">Email</label>

                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">

                                <input type="password" class="form-control" name="password" placeholder="Enter password"
                                    value="{{ old('password') }}">
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
                    <div class="mb-3 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">

                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Enter password" value="{{ old('password_confirmation') }}">
                                <span class="text-danger">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <label for="password">Confirm password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100 mb-3">Set new password</button>
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                            Back to login
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Reset Password -->
    </div>
    </div>
    </div>
@endsection
