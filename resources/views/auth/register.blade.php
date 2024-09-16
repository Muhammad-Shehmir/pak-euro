@extends('auth.layout.app')
@section('content')
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
            <img src="../../assets/img/illustrations/auth-register-illustration-light.png"
                class="auth-cover-illustration w-100" alt="auth-illustration"
                data-app-light-img="illustrations/auth-register-illustration-light.png"
                data-app-dark-img="illustrations/auth-register-illustration-dark.png" />
            <img src="../../assets/img/illustrations/auth-cover-register-mask-light.png" class="authentication-image"
                alt="mask" data-app-light-img="illustrations/auth-cover-register-mask-light.png"
                data-app-dark-img="illustrations/auth-cover-register-mask-dark.png" />
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div
            class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
            <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                <h2 class="mb-2 fw-semibold">Sign Up</h2>
                <p class="mb-4">Make your app management easy and fun!</p>
                <form action="{{ route('create') }}" method="post" id="formAuthentication" class="mb-3"
                    action="index.html">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf

                    <div class="form-floating form-floating-outline mb-3">

                        <input type="text" class="form-control" name="name" placeholder="Enter full name"
                            value="{{ old('name') }}">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-3">

                        <input type="text" class="form-control" name="email" placeholder="Enter email address"
                            value="{{ old('email') }}">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                        <label for="email">Email</label>
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
                                <input type="password" class="form-control" name="cpassword"
                                    placeholder="Enter confirm password" value="{{ old('cpassword') }}">
                                <span class="text-danger">
                                    @error('cpassword')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <label for="cpassword">Confirm Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div> --}}
                    <button class="btn btn-primary d-grid w-100">Sign up</button>
                </form>

                <p class="text-center mt-2">
                    <span>Already have an account?</span>
                    <a href="{{ url('/') }}">
                        <span>Sign in instead</span>
                    </a>
                </p>


                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
                @if (session()->has('register_successfully'))
                    <script>
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'You need to verify your account. We have sent you an activation link, please check your email.',
                            showConfirmButton: false,
                            heightAuto: false,
                            timer: 4000
                        })
                    </script>
                @endif



                {{-- <div class="divider my-4">
                    <div class="divider-text">or</div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                        <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                        <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                        <i class="tf-icons mdi mdi-24px mdi-github"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                        <i class="tf-icons mdi mdi-24px mdi-google"></i>
                    </a>
                </div> --}}
            </div>
        </div>
        <!-- /Register -->
    </div>
    </div>
@endsection
