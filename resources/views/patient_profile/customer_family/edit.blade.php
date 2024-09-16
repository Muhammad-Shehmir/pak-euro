@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/customer-profile' . '/' . $customer->id) }}" class="text-muted fw-light">/ Family Member</a><span
                class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Family Member</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm"
                            action="{{ url('/family-member/edit' . '/' . $customer->id . '/' . $family->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" required class="form-control name-validate"
                                                id="basic-icon-default-fullname" placeholder="Enter Family Member Name" name="name"
                                                value="{{ $family->name }}" aria-label="Enter Family Member Name" aria-describedby="basic-icon-default-fullname2" />
                                            <label for="basic-icon-default-fullname">Family Member Name</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-name" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Name is invalid
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Surname" name="surname"
                                            value="{{ $family->surname }}" aria-label="Enter Surname" aria-describedby="basic-icon-default-fullname2" />
                                            <label for="basic-icon-default-fullname">Surname</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-surname" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Name is invalid
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-phone"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="phone_no" type="text" id="basic-icon-default-phone"
                                                class="form-control phone-mask number-validate" placeholder="Enter Your Number"
                                                value="{{ $family->phone_no }}" aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Phone No</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-number" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Number is invalid
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-whatsapp"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="whatsapp_no" type="text" id="basic-icon-default-phone"
                                                class="form-control phone-mask whtp-number-validate"
                                                placeholder="Enter Whatsapp No." value="{{ $family->whatsapp_no }}" aria-label="Enter Whatsapp No."
                                                aria-describedby="basic-icon-default-`2" />
                                            <label for="basic-icon-default-phone">Whatsapp No</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-whtp-number" style="display: none;">
                                        <i class="mdi mdi-alert"></i>Number is invalid
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="dob" type="date" id="basic-icon-default-phone"
                                                class="form-control dob-validate" placeholder="YYYY-MM-DD"
                                                value="{{ $family->dob }}" aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Date Of Birth</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-dob" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Date of birth cannot be in the future
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="email" id="basic-icon-default-email"
                                                class="form-control email-validate" placeholder="Enter Email"
                                                value="{{ $family->email }}" aria-label="Enter Email" aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Email</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-email" style="display: none;">
                                        <i class="mdi mdi-alert"></i>Email format is invalid
                                    </span>
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="form-label d-block">Gender</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="formValidationGender" name="gender"
                                                class="form-check-input" value="male" {{ $family->gender == 'male' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="formValidationGender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="formValidationGender2" name="gender"
                                                class="form-check-input" value="female" {{ $family->gender == 'female' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="formValidationGender2">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select name="relation_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($relations as $relation)
                                                <option {{ $family->relation_id == $relation->id ? 'selected' : '' }}
                                                value="{{ $relation->id }}">{{ $relation->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="relations">Relation</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control form-control-sm" name="address" rows="3" id="address">{{ $family->address }}</textarea>
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-city"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="city" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter City" value="{{ $family->city }}" aria-label="Enter City"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">City</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-home-city"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="state" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter State" value="{{ $family->state }}" aria-label="Enter State"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">State</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-town-hall"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="country" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Country" aria-label="Enter Country"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Country</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select id="country" name="country" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            {{-- <option value="{{ $family->country }}" selected>{{ $family->country }}</option> --}}
                                            <option value="">Select</option>
                                            <option value="AF" {{ $family->country == 'AF' ? 'selected' : '' }}>Afghanistan</option>
                                            <option value="AX" {{ $family->country == 'AX' ? 'selected' : '' }}>Aland Islands</option>
                                            <option value="AL" {{ $family->country == 'AL' ? 'selected' : '' }}>Albania</option>
                                            <option value="DZ" {{ $family->country == 'DZ' ? 'selected' : '' }}>Algeria</option>
                                            <option value="AS" {{ $family->country == 'AS' ? 'selected' : '' }}>American Samoa</option>
                                            <option value="AD" {{ $family->country == 'AD' ? 'selected' : '' }}>Andorra</option>
                                            <option value="AO" {{ $family->country == 'AO' ? 'selected' : '' }}>Angola</option>
                                            <option value="AI" {{ $family->country == 'AI' ? 'selected' : '' }}>Anguilla</option>
                                            <option value="AQ" {{ $family->country == 'AQ' ? 'selected' : '' }}>Antarctica</option>
                                            <option value="AG" {{ $family->country == 'AG' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                            <option value="AR" {{ $family->country == 'AR' ? 'selected' : '' }}>Argentina</option>
                                            <option value="AM" {{ $family->country == 'AM' ? 'selected' : '' }}>Armenia</option>
                                            <option value="AW" {{ $family->country == 'AW' ? 'selected' : '' }}>Aruba</option>
                                            <option value="AU" {{ $family->country == 'AU' ? 'selected' : '' }}>Australia</option>
                                            <option value="AT" {{ $family->country == 'AT' ? 'selected' : '' }}>Austria</option>
                                            <option value="AZ" {{ $family->country == 'AZ' ? 'selected' : '' }}>Azerbaijan</option>
                                            <option value="BS" {{ $family->country == 'BS' ? 'selected' : '' }}>Bahamas</option>
                                            <option value="BH" {{ $family->country == 'BH' ? 'selected' : '' }}>Bahrain</option>
                                            <option value="BD" {{ $family->country == 'BD' ? 'selected' : '' }}>Bangladesh</option>
                                            <option value="BB" {{ $family->country == 'BB' ? 'selected' : '' }}>Barbados</option>
                                            <option value="BY" {{ $family->country == 'BY' ? 'selected' : '' }}>Belarus</option>
                                            <option value="BE" {{ $family->country == 'BE' ? 'selected' : '' }}>Belgium</option>
                                            <option value="BZ" {{ $family->country == 'BZ' ? 'selected' : '' }}>Belize</option>
                                            <option value="BJ" {{ $family->country == 'BJ' ? 'selected' : '' }}>Benin</option>
                                            <option value="BM" {{ $family->country == 'BM' ? 'selected' : '' }}>Bermuda</option>
                                            <option value="BT" {{ $family->country == 'BT' ? 'selected' : '' }}>Bhutan</option>
                                            <option value="BO" {{ $family->country == 'BO' ? 'selected' : '' }}>Bolivia</option>
                                            <option value="BQ" {{ $family->country == 'BQ' ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA" {{ $family->country == 'BA' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                            <option value="BW" {{ $family->country == 'BW' ? 'selected' : '' }}>Botswana</option>
                                            <option value="BV" {{ $family->country == 'BV' ? 'selected' : '' }}>Bouvet Island</option>
                                            <option value="BR" {{ $family->country == 'BR' ? 'selected' : '' }}>Brazil</option>
                                            <option value="IO" {{ $family->country == 'IO' ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                            <option value="BN" {{ $family->country == 'BN' ? 'selected' : '' }}>Brunei Darussalam</option>
                                            <option value="BG" {{ $family->country == 'BG' ? 'selected' : '' }}>Bulgaria</option>
                                            <option value="BF" {{ $family->country == 'BF' ? 'selected' : '' }}>Burkina Faso</option>
                                            <option value="BI" {{ $family->country == 'BI' ? 'selected' : '' }}>Burundi</option>
                                            <option value="KH" {{ $family->country == 'KH' ? 'selected' : '' }}>Cambodia</option>
                                            <option value="CM" {{ $family->country == 'CM' ? 'selected' : '' }}>Cameroon</option>
                                            <option value="CA" {{ $family->country == 'CA' ? 'selected' : '' }}>Canada</option>
                                            <option value="CV" {{ $family->country == 'CV' ? 'selected' : '' }}>Cape Verde</option>
                                            <option value="KY" {{ $family->country == 'KY' ? 'selected' : '' }}>Cayman Islands</option>
                                            <option value="CF" {{ $family->country == 'CF' ? 'selected' : '' }}>Central African Republic</option>
                                            <option value="TD" {{ $family->country == 'TD' ? 'selected' : '' }}>Chad</option>
                                            <option value="CL" {{ $family->country == 'CL' ? 'selected' : '' }}>Chile</option>
                                            <option value="CN" {{ $family->country == 'CN' ? 'selected' : '' }}>China</option>
                                            <option value="CX" {{ $family->country == 'CX' ? 'selected' : '' }}>Christmas Island</option>
                                            <option value="CC" {{ $family->country == 'CC' ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                            <option value="CO" {{ $family->country == 'CO' ? 'selected' : '' }}>Colombia</option>
                                            <option value="KM" {{ $family->country == 'KM' ? 'selected' : '' }}>Comoros</option>
                                            <option value="CG" {{ $family->country == 'CG' ? 'selected' : '' }}>Congo</option>
                                            <option value="CD" {{ $family->country == 'CD' ? 'selected' : '' }}>Congo, Democratic Republic of the Congo</option>
                                            <option value="CK" {{ $family->country == 'CK' ? 'selected' : '' }}>Cook Islands</option>
                                            <option value="CR" {{ $family->country == 'CR' ? 'selected' : '' }}>Costa Rica</option>
                                            <option value="CI" {{ $family->country == 'CI' ? 'selected' : '' }}>Cote D'Ivoire</option>
                                            <option value="HR" {{ $family->country == 'HR' ? 'selected' : '' }}>Croatia</option>
                                            <option value="CU" {{ $family->country == 'CU' ? 'selected' : '' }}>Cuba</option>
                                            <option value="CW" {{ $family->country == 'CW' ? 'selected' : '' }}>Curacao</option>
                                            <option value="CY" {{ $family->country == 'CY' ? 'selected' : '' }}>Cyprus</option>
                                            <option value="CZ" {{ $family->country == 'CZ' ? 'selected' : '' }}>Czech Republic</option>
                                            <option value="DK" {{ $family->country == 'DK' ? 'selected' : '' }}>Denmark</option>
                                            <option value="DJ" {{ $family->country == 'DJ' ? 'selected' : '' }}>Djibouti</option>
                                            <option value="DM" {{ $family->country == 'DM' ? 'selected' : '' }}>Dominica</option>
                                            <option value="DO" {{ $family->country == 'DO' ? 'selected' : '' }}>Dominican Republic</option>
                                            <option value="EC" {{ $family->country == 'EC' ? 'selected' : '' }}>Ecuador</option>
                                            <option value="EG" {{ $family->country == 'EG' ? 'selected' : '' }}>Egypt</option>
                                            <option value="SV" {{ $family->country == 'SV' ? 'selected' : '' }}>El Salvador</option>
                                            <option value="GQ" {{ $family->country == 'GQ' ? 'selected' : '' }}>Equatorial Guinea</option>
                                            <option value="ER" {{ $family->country == 'ER' ? 'selected' : '' }}>Eritrea</option>
                                            <option value="EE" {{ $family->country == 'EE' ? 'selected' : '' }}>Estonia</option>
                                            <option value="ET" {{ $family->country == 'ET' ? 'selected' : '' }}>Ethiopia</option>
                                            <option value="FK" {{ $family->country == 'FK' ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                            <option value="FO" {{ $family->country == 'FO' ? 'selected' : '' }}>Faroe Islands</option>
                                            <option value="FJ" {{ $family->country == 'FJ' ? 'selected' : '' }}>Fiji</option>
                                            <option value="FI" {{ $family->country == 'FI' ? 'selected' : '' }}>Finland</option>
                                            <option value="FR" {{ $family->country == 'FR' ? 'selected' : '' }}>France</option>
                                            <option value="GF" {{ $family->country == 'GF' ? 'selected' : '' }}>French Guiana</option>
                                            <option value="PF" {{ $family->country == 'PF' ? 'selected' : '' }}>French Polynesia</option>
                                            <option value="TF" {{ $family->country == 'TF' ? 'selected' : '' }}>French Southern Territories</option>
                                            <option value="GA" {{ $family->country == 'GA' ? 'selected' : '' }}>Gabon</option>
                                            <option value="GM" {{ $family->country == 'GM' ? 'selected' : '' }}>Gambia</option>
                                            <option value="GE" {{ $family->country == 'GE' ? 'selected' : '' }}>Georgia</option>
                                            <option value="DE" {{ $family->country == 'DE' ? 'selected' : '' }}>Germany</option>
                                            <option value="GH" {{ $family->country == 'GH' ? 'selected' : '' }}>Ghana</option>
                                            <option value="GI" {{ $family->country == 'GI' ? 'selected' : '' }}>Gibraltar</option>
                                            <option value="GR" {{ $family->country == 'GR' ? 'selected' : '' }}>Greece</option>
                                            <option value="GL" {{ $family->country == 'GL' ? 'selected' : '' }}>Greenland</option>
                                            <option value="GD" {{ $family->country == 'GD' ? 'selected' : '' }}>Grenada</option>
                                            <option value="GP" {{ $family->country == 'GP' ? 'selected' : '' }}>Guadeloupe</option>
                                            <option value="GU" {{ $family->country == 'GU' ? 'selected' : '' }}>Guam</option>
                                            <option value="GT" {{ $family->country == 'GT' ? 'selected' : '' }}>Guatemala</option>
                                            <option value="GG" {{ $family->country == 'GG' ? 'selected' : '' }}>Guernsey</option>
                                            <option value="GN" {{ $family->country == 'GN' ? 'selected' : '' }}>Guinea</option>
                                            <option value="GW" {{ $family->country == 'GW' ? 'selected' : '' }}>Guinea-Bissau</option>
                                            <option value="GY" {{ $family->country == 'GY' ? 'selected' : '' }}>Guyana</option>
                                            <option value="HT" {{ $family->country == 'HT' ? 'selected' : '' }}>Haiti</option>
                                            <option value="HM" {{ $family->country == 'HM' ? 'selected' : '' }}>Heard Island and Mcdonald Islands</option>
                                            <option value="VA" {{ $family->country == 'VA' ? 'selected' : '' }}>Holy See (Vatican City State)</option>
                                            <option value="HN" {{ $family->country == 'HN' ? 'selected' : '' }}>Honduras</option>
                                            <option value="HK" {{ $family->country == 'HK' ? 'selected' : '' }}>Hong Kong</option>
                                            <option value="HU" {{ $family->country == 'HU' ? 'selected' : '' }}>Hungary</option>
                                            <option value="IS" {{ $family->country == 'IS' ? 'selected' : '' }}>Iceland</option>
                                            <option value="IN" {{ $family->country == 'IN' ? 'selected' : '' }}>India</option>
                                            <option value="ID" {{ $family->country == 'ID' ? 'selected' : '' }}>Indonesia</option>
                                            <option value="IR" {{ $family->country == 'IR' ? 'selected' : '' }}>Iran, Islamic Republic of</option>
                                            <option value="IQ" {{ $family->country == 'IQ' ? 'selected' : '' }}>Iraq</option>
                                            <option value="IE" {{ $family->country == 'IE' ? 'selected' : '' }}>Ireland</option>
                                            <option value="IM" {{ $family->country == 'IM' ? 'selected' : '' }}>Isle of Man</option>
                                            <option value="IL" {{ $family->country == 'IL' ? 'selected' : '' }}>Israel</option>
                                            <option value="IT" {{ $family->country == 'IT' ? 'selected' : '' }}>Italy</option>
                                            <option value="JM" {{ $family->country == 'JM' ? 'selected' : '' }}>Jamaica</option>
                                            <option value="JP" {{ $family->country == 'JP' ? 'selected' : '' }}>Japan</option>
                                            <option value="JE" {{ $family->country == 'JE' ? 'selected' : '' }}>Jersey</option>
                                            <option value="JO" {{ $family->country == 'JO' ? 'selected' : '' }}>Jordan</option>
                                            <option value="KZ" {{ $family->country == 'KZ' ? 'selected' : '' }}>Kazakhstan</option>
                                            <option value="KE" {{ $family->country == 'KE' ? 'selected' : '' }}>Kenya</option>
                                            <option value="KI" {{ $family->country == 'KI' ? 'selected' : '' }}>Kiribati</option>
                                            <option value="KP" {{ $family->country == 'KP' ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                                            <option value="KR" {{ $family->country == 'KR' ? 'selected' : '' }}>Korea, Republic of</option>
                                            <option value="XK" {{ $family->country == 'XK' ? 'selected' : '' }}>Kosovo</option>
                                            <option value="KW" {{ $family->country == 'KW' ? 'selected' : '' }}>Kuwait</option>
                                            <option value="KG" {{ $family->country == 'KG' ? 'selected' : '' }}>Kyrgyzstan</option>
                                            <option value="LA" {{ $family->country == 'LA' ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                                            <option value="LV" {{ $family->country == 'LV' ? 'selected' : '' }}>Latvia</option>
                                            <option value="LB" {{ $family->country == 'LB' ? 'selected' : '' }}>Lebanon</option>
                                            <option value="LS" {{ $family->country == 'LS' ? 'selected' : '' }}>Lesotho</option>
                                            <option value="LR" {{ $family->country == 'LR' ? 'selected' : '' }}>Liberia</option>
                                            <option value="LY" {{ $family->country == 'LY' ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                                            <option value="LI" {{ $family->country == 'LI' ? 'selected' : '' }}>Liechtenstein</option>
                                            <option value="LT" {{ $family->country == 'LT' ? 'selected' : '' }}>Lithuania</option>
                                            <option value="LU" {{ $family->country == 'LU' ? 'selected' : '' }}>Luxembourg</option>
                                            <option value="MO" {{ $family->country == 'MO' ? 'selected' : '' }}>Macao</option>
                                            <option value="MK" {{ $family->country == 'MK' ? 'selected' : '' }}>Macedonia, the Former Yugoslav Republic of</option>
                                            <option value="MG" {{ $family->country == 'MG' ? 'selected' : '' }}>Madagascar</option>
                                            <option value="MW" {{ $family->country == 'MW' ? 'selected' : '' }}>Malawi</option>
                                            <option value="MY" {{ $family->country == 'MY' ? 'selected' : '' }}>Malaysia</option>
                                            <option value="MV" {{ $family->country == 'MV' ? 'selected' : '' }}>Maldives</option>
                                            <option value="ML" {{ $family->country == 'ML' ? 'selected' : '' }}>Mali</option>
                                            <option value="MT" {{ $family->country == 'MT' ? 'selected' : '' }}>Malta</option>
                                            <option value="MH" {{ $family->country == 'MH' ? 'selected' : '' }}>Marshall Islands</option>
                                            <option value="MQ" {{ $family->country == 'MQ' ? 'selected' : '' }}>Martinique</option>
                                            <option value="MR" {{ $family->country == 'MR' ? 'selected' : '' }}>Mauritania</option>
                                            <option value="MU" {{ $family->country == 'MU' ? 'selected' : '' }}>Mauritius</option>
                                            <option value="YT" {{ $family->country == 'YT' ? 'selected' : '' }}>Mayotte</option>
                                            <option value="MX" {{ $family->country == 'MX' ? 'selected' : '' }}>Mexico</option>
                                            <option value="FM" {{ $family->country == 'FM' ? 'selected' : '' }}>Micronesia, Federated States of</option>
                                            <option value="MD" {{ $family->country == 'MD' ? 'selected' : '' }}>Moldova, Republic of</option>
                                            <option value="MC" {{ $family->country == 'MC' ? 'selected' : '' }}>Monaco</option>
                                            <option value="MN" {{ $family->country == 'MN' ? 'selected' : '' }}>Mongolia</option>
                                            <option value="ME" {{ $family->country == 'ME' ? 'selected' : '' }}>Montenegro</option>
                                            <option value="MS" {{ $family->country == 'MS' ? 'selected' : '' }}>Montserrat</option>
                                            <option value="MA" {{ $family->country == 'MA' ? 'selected' : '' }}>Morocco</option>
                                            <option value="MZ" {{ $family->country == 'MZ' ? 'selected' : '' }}>Mozambique</option>
                                            <option value="MM" {{ $family->country == 'MM' ? 'selected' : '' }}>Myanmar</option>
                                            <option value="NA" {{ $family->country == 'NA' ? 'selected' : '' }}>Namibia</option>
                                            <option value="NR" {{ $family->country == 'NR' ? 'selected' : '' }}>Nauru</option>
                                            <option value="NP" {{ $family->country == 'NP' ? 'selected' : '' }}>Nepal</option>
                                            <option value="NL" {{ $family->country == 'NL' ? 'selected' : '' }}>Netherlands</option>
                                            <option value="AN" {{ $family->country == 'AN' ? 'selected' : '' }}>Netherlands Antilles</option>
                                            <option value="NC" {{ $family->country == 'NC' ? 'selected' : '' }}>New Caledonia</option>
                                            <option value="NZ" {{ $family->country == 'NZ' ? 'selected' : '' }}>New Zealand</option>
                                            <option value="NI" {{ $family->country == 'NI' ? 'selected' : '' }}>Nicaragua</option>
                                            <option value="NE" {{ $family->country == 'NE' ? 'selected' : '' }}>Niger</option>
                                            <option value="NG" {{ $family->country == 'NG' ? 'selected' : '' }}>Nigeria</option>
                                            <option value="NU" {{ $family->country == 'NU' ? 'selected' : '' }}>Niue</option>
                                            <option value="NF" {{ $family->country == 'NF' ? 'selected' : '' }}>Norfolk Island</option>
                                            <option value="MP" {{ $family->country == 'MP' ? 'selected' : '' }}>Northern Mariana Islands</option>
                                            <option value="NO" {{ $family->country == 'NO' ? 'selected' : '' }}>Norway</option>
                                            <option value="OM" {{ $family->country == 'OM' ? 'selected' : '' }}>Oman</option>
                                            <option value="PK" {{ $family->country == 'PK' ? 'selected' : '' }}>Pakistan</option>
                                            <option value="PW" {{ $family->country == 'PW' ? 'selected' : '' }}>Palau</option>
                                            <option value="PS" {{ $family->country == 'PS' ? 'selected' : '' }}>Palestinian Territory, Occupied</option>
                                            <option value="PA" {{ $family->country == 'PA' ? 'selected' : '' }}>Panama</option>
                                            <option value="PG" {{ $family->country == 'PG' ? 'selected' : '' }}>Papua New Guinea</option>
                                            <option value="PY" {{ $family->country == 'PY' ? 'selected' : '' }}>Paraguay</option>
                                            <option value="PE" {{ $family->country == 'PE' ? 'selected' : '' }}>Peru</option>
                                            <option value="PH" {{ $family->country == 'PH' ? 'selected' : '' }}>Philippines</option>
                                            <option value="PN" {{ $family->country == 'PN' ? 'selected' : '' }}>Pitcairn</option>
                                            <option value="PL" {{ $family->country == 'PL' ? 'selected' : '' }}>Poland</option>
                                            <option value="PT" {{ $family->country == 'PT' ? 'selected' : '' }}>Portugal</option>
                                            <option value="PR" {{ $family->country == 'PR' ? 'selected' : '' }}>Puerto Rico</option>
                                            <option value="QA" {{ $family->country == 'QA' ? 'selected' : '' }}>Qatar</option>
                                            <option value="RE" {{ $family->country == 'RE' ? 'selected' : '' }}>Reunion</option>
                                            <option value="RO" {{ $family->country == 'RO' ? 'selected' : '' }}>Romania</option>
                                            <option value="RU" {{ $family->country == 'RU' ? 'selected' : '' }}>Russian Federation</option>
                                            <option value="RW" {{ $family->country == 'RW' ? 'selected' : '' }}>Rwanda</option>
                                            <option value="BL" {{ $family->country == 'BL' ? 'selected' : '' }}>Saint Barthelemy</option>
                                            <option value="SH" {{ $family->country == 'SH' ? 'selected' : '' }}>Saint Helena</option>
                                            <option value="KN" {{ $family->country == 'KN' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                            <option value="LC" {{ $family->country == 'LC' ? 'selected' : '' }}>Saint Lucia</option>
                                            <option value="MF" {{ $family->country == 'MF' ? 'selected' : '' }}>Saint Martin</option>
                                            <option value="PM" {{ $family->country == 'PM' ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                            <option value="VC" {{ $family->country == 'VC' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                            <option value="WS" {{ $family->country == 'WS' ? 'selected' : '' }}>Samoa</option>
                                            <option value="SM" {{ $family->country == 'SM' ? 'selected' : '' }}>San Marino</option>
                                            <option value="ST" {{ $family->country == 'ST' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                            <option value="SA" {{ $family->country == 'SA' ? 'selected' : '' }}>Saudi Arabia</option>
                                            <option value="SN" {{ $family->country == 'SN' ? 'selected' : '' }}>Senegal</option>
                                            <option value="RS" {{ $family->country == 'RS' ? 'selected' : '' }}>Serbia</option>
                                            <option value="CS" {{ $family->country == 'CS' ? 'selected' : '' }}>Serbia and Montenegro</option>
                                            <option value="SC" {{ $family->country == 'SC' ? 'selected' : '' }}>Seychelles</option>
                                            <option value="SL" {{ $family->country == 'SL' ? 'selected' : '' }}>Sierra Leone</option>
                                            <option value="SG" {{ $family->country == 'SG' ? 'selected' : '' }}>Singapore</option>
                                            <option value="SX" {{ $family->country == 'SX' ? 'selected' : '' }}>Sint Maarten</option>
                                            <option value="SK" {{ $family->country == 'SK' ? 'selected' : '' }}>Slovakia</option>
                                            <option value="SI" {{ $family->country == 'SI' ? 'selected' : '' }}>Slovenia</option>
                                            <option value="SB" {{ $family->country == 'SB' ? 'selected' : '' }}>Solomon Islands</option>
                                            <option value="SO" {{ $family->country == 'SO' ? 'selected' : '' }}>Somalia</option>
                                            <option value="ZA" {{ $family->country == 'ZA' ? 'selected' : '' }}>South Africa</option>
                                            <option value="GS" {{ $family->country == 'GS' ? 'selected' : '' }}>South Georgia and the South Sandwich Islands</option>
                                            <option value="SS" {{ $family->country == 'SS' ? 'selected' : '' }}>South Sudan</option>
                                            <option value="ES" {{ $family->country == 'ES' ? 'selected' : '' }}>Spain</option>
                                            <option value="LK" {{ $family->country == 'LK' ? 'selected' : '' }}>Sri Lanka</option>
                                            <option value="SD" {{ $family->country == 'SD' ? 'selected' : '' }}>Sudan</option>
                                            <option value="SR" {{ $family->country == 'SR' ? 'selected' : '' }}>Suriname</option>
                                            <option value="SJ" {{ $family->country == 'SJ' ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                            <option value="SZ" {{ $family->country == 'SZ' ? 'selected' : '' }}>Swaziland</option>
                                            <option value="SE" {{ $family->country == 'SE' ? 'selected' : '' }}>Sweden</option>
                                            <option value="CH" {{ $family->country == 'CH' ? 'selected' : '' }}>Switzerland</option>
                                            <option value="SY" {{ $family->country == 'SY' ? 'selected' : '' }}>Syrian Arab Republic</option>
                                            <option value="TW" {{ $family->country == 'TW' ? 'selected' : '' }}>Taiwan, Province of China</option>
                                            <option value="TJ" {{ $family->country == 'TJ' ? 'selected' : '' }}>Tajikistan</option>
                                            <option value="TZ" {{ $family->country == 'TZ' ? 'selected' : '' }}>Tanzania, United Republic of</option>
                                            <option value="TH" {{ $family->country == 'TH' ? 'selected' : '' }}>Thailand</option>
                                            <option value="TL" {{ $family->country == 'TL' ? 'selected' : '' }}>Timor-Leste</option>
                                            <option value="TG" {{ $family->country == 'TG' ? 'selected' : '' }}>Togo</option>
                                            <option value="TK" {{ $family->country == 'TK' ? 'selected' : '' }}>Tokelau</option>
                                            <option value="TO" {{ $family->country == 'TO' ? 'selected' : '' }}>Tonga</option>
                                            <option value="TT" {{ $family->country == 'TT' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                            <option value="TN" {{ $family->country == 'TN' ? 'selected' : '' }}>Tunisia</option>
                                            <option value="TR" {{ $family->country == 'TR' ? 'selected' : '' }}>Turkey</option>
                                            <option value="TM" {{ $family->country == 'TM' ? 'selected' : '' }}>Turkmenistan</option>
                                            <option value="TC" {{ $family->country == 'TC' ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                            <option value="TV" {{ $family->country == 'TV' ? 'selected' : '' }}>Tuvalu</option>
                                            <option value="UG" {{ $family->country == 'UG' ? 'selected' : '' }}>Uganda</option>
                                            <option value="UA" {{ $family->country == 'UA' ? 'selected' : '' }}>Ukraine</option>
                                            <option value="AE" {{ $family->country == 'AE' ? 'selected' : '' }}>United Arab Emirates</option>
                                            <option value="GB" {{ $family->country == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                            <option value="US" {{ $family->country == 'US' ? 'selected' : '' }}>United States</option>
                                            <option value="UM" {{ $family->country == 'UM' ? 'selected' : '' }}>United States Minor Outlying Islands</option>
                                            <option value="UY" {{ $family->country == 'UY' ? 'selected' : '' }}>Uruguay</option>
                                            <option value="UZ" {{ $family->country == 'UZ' ? 'selected' : '' }}>Uzbekistan</option>
                                            <option value="VU" {{ $family->country == 'VU' ? 'selected' : '' }}>Vanuatu</option>
                                            <option value="VE" {{ $family->country == 'VE' ? 'selected' : '' }}>Venezuela</option>
                                            <option value="VN" {{ $family->country == 'VN' ? 'selected' : '' }}>Viet Nam</option>
                                            <option value="VG" {{ $family->country == 'VG' ? 'selected' : '' }}>Virgin Islands, British</option>
                                            <option value="VI" {{ $family->country == 'VI' ? 'selected' : '' }}>Virgin Islands, U.s.</option>
                                            <option value="WF" {{ $family->country == 'WF' ? 'selected' : '' }}>Wallis and Futuna</option>
                                            <option value="EH" {{ $family->country == 'EH' ? 'selected' : '' }}>Western Sahara</option>
                                            <option value="YE" {{ $family->country == 'YE' ? 'selected' : '' }}>Yemen</option>
                                            <option value="ZM" {{ $family->country == 'ZM' ? 'selected' : '' }}>Zambia</option>
                                            <option value="ZW" {{ $family->country == 'ZW' ? 'selected' : '' }}>Zimbabwe</option>
                                        </select>
                                        <label for="country">Country</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="zip_code" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Zip Code" value="{{ $family->zip_code }}" aria-label="Enter Zip Code"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Zip Code</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <a href="{{ url('/customer-profile' . '/' . $customer->id) }}" type="back"
                                        class="btn btn-label-secondary waves-effect">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection