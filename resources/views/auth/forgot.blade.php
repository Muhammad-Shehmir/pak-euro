@extends('auth.layout.app')
@section('content')
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
            <img src="../../assets/img/illustrations/login.png"
                class="auth-cover-illustration w-100" alt="auth-illustration"
                data-app-light-img="illustrations/login.png"
                data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />
            <img src="../../assets/img/illustrations/auth-cover-forgot-password-mask-light.png" class="authentication-image"
                alt="mask" data-app-light-img="illustrations/auth-cover-forgot-password-mask-light.png"
                data-app-dark-img="illustrations/auth-cover-forgot-password-mask-dark.png" />
        </div>
        <!-- /Left Section -->

        <!-- Forgot Password -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <h2 class="mb-2 fw-semibold">Forgot Password? 🔒</h2>
                <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
                <form action="{{ route('forgot.password.link') }}" method="post" id="formAuthentication" class="mb-3"
                    action="auth-reset-password-cover.html">
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
                    <div class="form-floating form-floating-outline mb-3">

                        <input type="text" class="form-control" name="email" placeholder="Enter email address"
                            value="{{ old('email') }}">
                            <label for="email">Email</label>
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                </form>
                <div class="text-center">
                    <a href="/"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
        {{-- {{ dd(session()->all()); }} --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>


        @if (session()->has('password_success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'We have e-mailed your password reset link!',
                    showConfirmButton: false,
                    heightAuto: false,
                    timer: 4000
                })
            </script>
        @endif
        <!-- /Forgot Password -->
    </div>
    </div>
@endsection
