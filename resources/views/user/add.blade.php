@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/user') }}" class="text-muted fw-light">/ User</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Add</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add User</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/user/add') }}" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Name" name="name"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="email" id="basic-icon-default-email"
                                            class="form-control email-validate" placeholder="Enter Email"
                                            aria-label="Enter Email" aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Email</label>
                                    </div>
                                    {{-- <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span> --}}
                                </div>
                                <span class="text-danger validation-email" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Email format is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge mb-2">
                                        {{-- <span id="basic-icon-default-ppassword2" class="input-group-text"><i
                                                class="mdi mdi-key"></i></span> --}}
                                        <div class="form-floating form-floating-outline">
                                            <input required name="password" type="password" id="basic-icon-default-password"
                                                class="form-control password-mask password-validate"
                                                placeholder="Enter Your Password" aria-label="Enter Password."
                                                aria-describedby="basic-icon-default-password2" />
                                            <label for="basic-icon-default-password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                                <span class="text-danger validation-password" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Password format should be Combination of Special
                                    Character, a Number and a Capital Letter.
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="role" name="role_id" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Please Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                        @endforeach
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-2">
                                    <input name="profile_pic" class="form-control" type="file" id="formValidationFile"
                                        name="profile_pic" accept=".png, .jpeg, .jpg, .pdf, .svg" />
                                    <label for="formValidationFile">Profile Pic</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="status" name="status" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/user') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
