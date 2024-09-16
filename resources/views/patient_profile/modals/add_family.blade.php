<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="myForm" class="modal-content mb-0" enctype="multipart/form-data"
                action="{{ url('/family-member/add'. '/' . $customer->id) }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Family Members</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $customer->id }}" name="customer_head_id">
                    <input type="hidden" value="3" name="customer_type_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="mdi mdi-account-outline"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" required class="form-control name-validate"
                                        id="basic-icon-default-fullname" placeholder="Enter Family Member Name" name="name"
                                        aria-label="Enter Family Member Name" aria-describedby="basic-icon-default-fullname2" />
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
                                    value="{{ $customer->surname }}" aria-label="Enter Surname" aria-describedby="basic-icon-default-fullname2" />
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
                                        value="{{ $customer->phone_no }}" aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
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
                                        placeholder="Enter Whatsapp No." value="{{ $customer->whatsapp_no }}" aria-label="Enter Whatsapp No."
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
                                        aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
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
                                        value="{{ $customer->email }}" aria-label="Enter Email" aria-describedby="basic-icon-default-email2" />
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
                                        class="form-check-input" value="male" />
                                    <label class="form-check-label" for="formValidationGender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="formValidationGender2" name="gender"
                                        class="form-check-input" value="female" />
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
                                        <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                    @endforeach
                                </select>
                                <label for="relations">Relation</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline my-2">
                                <textarea class="form-control form-control-sm" name="address" rows="3" id="address">{{ $customer->address }}</textarea>
                                <label for="address">Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span class="input-group-text"><i class="mdi mdi-city"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="city" id="basic-icon-default-email"
                                        class="form-control" placeholder="Enter City" value="{{ $customer->city }}" aria-label="Enter City"
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
                                        class="form-control" placeholder="Enter State" value="{{ $customer->state }}" aria-label="Enter State"
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
                                    {{-- <option value="{{ $customer->country }}">{{ $customer->country }}</option> --}}
                                            <option value="">Select</option>
                                            <option value="AF" {{ $customer->country == 'AF' ? 'selected' : '' }}>Afghanistan</option>
                                            <option value="AX" {{ $customer->country == 'AX' ? 'selected' : '' }}>Aland Islands</option>
                                            <option value="AL" {{ $customer->country == 'AL' ? 'selected' : '' }}>Albania</option>
                                            <option value="DZ" {{ $customer->country == 'DZ' ? 'selected' : '' }}>Algeria</option>
                                            <option value="AS" {{ $customer->country == 'AS' ? 'selected' : '' }}>American Samoa</option>
                                            <option value="AD" {{ $customer->country == 'AD' ? 'selected' : '' }}>Andorra</option>
                                            <option value="AO" {{ $customer->country == 'AO' ? 'selected' : '' }}>Angola</option>
                                            <option value="AI" {{ $customer->country == 'AI' ? 'selected' : '' }}>Anguilla</option>
                                            <option value="AQ" {{ $customer->country == 'AQ' ? 'selected' : '' }}>Antarctica</option>
                                            <option value="AG" {{ $customer->country == 'AG' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                            <option value="AR" {{ $customer->country == 'AR' ? 'selected' : '' }}>Argentina</option>
                                            <option value="AM" {{ $customer->country == 'AM' ? 'selected' : '' }}>Armenia</option>
                                            <option value="AW" {{ $customer->country == 'AW' ? 'selected' : '' }}>Aruba</option>
                                            <option value="AU" {{ $customer->country == 'AU' ? 'selected' : '' }}>Australia</option>
                                            <option value="AT" {{ $customer->country == 'AT' ? 'selected' : '' }}>Austria</option>
                                            <option value="AZ" {{ $customer->country == 'AZ' ? 'selected' : '' }}>Azerbaijan</option>
                                            <option value="BS" {{ $customer->country == 'BS' ? 'selected' : '' }}>Bahamas</option>
                                            <option value="BH" {{ $customer->country == 'BH' ? 'selected' : '' }}>Bahrain</option>
                                            <option value="BD" {{ $customer->country == 'BD' ? 'selected' : '' }}>Bangladesh</option>
                                            <option value="BB" {{ $customer->country == 'BB' ? 'selected' : '' }}>Barbados</option>
                                            <option value="BY" {{ $customer->country == 'BY' ? 'selected' : '' }}>Belarus</option>
                                            <option value="BE" {{ $customer->country == 'BE' ? 'selected' : '' }}>Belgium</option>
                                            <option value="BZ" {{ $customer->country == 'BZ' ? 'selected' : '' }}>Belize</option>
                                            <option value="BJ" {{ $customer->country == 'BJ' ? 'selected' : '' }}>Benin</option>
                                            <option value="BM" {{ $customer->country == 'BM' ? 'selected' : '' }}>Bermuda</option>
                                            <option value="BT" {{ $customer->country == 'BT' ? 'selected' : '' }}>Bhutan</option>
                                            <option value="BO" {{ $customer->country == 'BO' ? 'selected' : '' }}>Bolivia</option>
                                            <option value="BQ" {{ $customer->country == 'BQ' ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA" {{ $customer->country == 'BA' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                            <option value="BW" {{ $customer->country == 'BW' ? 'selected' : '' }}>Botswana</option>
                                            <option value="BV" {{ $customer->country == 'BV' ? 'selected' : '' }}>Bouvet Island</option>
                                            <option value="BR" {{ $customer->country == 'BR' ? 'selected' : '' }}>Brazil</option>
                                            <option value="IO" {{ $customer->country == 'IO' ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                            <option value="BN" {{ $customer->country == 'BN' ? 'selected' : '' }}>Brunei Darussalam</option>
                                            <option value="BG" {{ $customer->country == 'BG' ? 'selected' : '' }}>Bulgaria</option>
                                            <option value="BF" {{ $customer->country == 'BF' ? 'selected' : '' }}>Burkina Faso</option>
                                            <option value="BI" {{ $customer->country == 'BI' ? 'selected' : '' }}>Burundi</option>
                                            <option value="KH" {{ $customer->country == 'KH' ? 'selected' : '' }}>Cambodia</option>
                                            <option value="CM" {{ $customer->country == 'CM' ? 'selected' : '' }}>Cameroon</option>
                                            <option value="CA" {{ $customer->country == 'CA' ? 'selected' : '' }}>Canada</option>
                                            <option value="CV" {{ $customer->country == 'CV' ? 'selected' : '' }}>Cape Verde</option>
                                            <option value="KY" {{ $customer->country == 'KY' ? 'selected' : '' }}>Cayman Islands</option>
                                            <option value="CF" {{ $customer->country == 'CF' ? 'selected' : '' }}>Central African Republic</option>
                                            <option value="TD" {{ $customer->country == 'TD' ? 'selected' : '' }}>Chad</option>
                                            <option value="CL" {{ $customer->country == 'CL' ? 'selected' : '' }}>Chile</option>
                                            <option value="CN" {{ $customer->country == 'CN' ? 'selected' : '' }}>China</option>
                                            <option value="CX" {{ $customer->country == 'CX' ? 'selected' : '' }}>Christmas Island</option>
                                            <option value="CC" {{ $customer->country == 'CC' ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                            <option value="CO" {{ $customer->country == 'CO' ? 'selected' : '' }}>Colombia</option>
                                            <option value="KM" {{ $customer->country == 'KM' ? 'selected' : '' }}>Comoros</option>
                                            <option value="CG" {{ $customer->country == 'CG' ? 'selected' : '' }}>Congo</option>
                                            <option value="CD" {{ $customer->country == 'CD' ? 'selected' : '' }}>Congo, Democratic Republic of the Congo</option>
                                            <option value="CK" {{ $customer->country == 'CK' ? 'selected' : '' }}>Cook Islands</option>
                                            <option value="CR" {{ $customer->country == 'CR' ? 'selected' : '' }}>Costa Rica</option>
                                            <option value="CI" {{ $customer->country == 'CI' ? 'selected' : '' }}>Cote D'Ivoire</option>
                                            <option value="HR" {{ $customer->country == 'HR' ? 'selected' : '' }}>Croatia</option>
                                            <option value="CU" {{ $customer->country == 'CU' ? 'selected' : '' }}>Cuba</option>
                                            <option value="CW" {{ $customer->country == 'CW' ? 'selected' : '' }}>Curacao</option>
                                            <option value="CY" {{ $customer->country == 'CY' ? 'selected' : '' }}>Cyprus</option>
                                            <option value="CZ" {{ $customer->country == 'CZ' ? 'selected' : '' }}>Czech Republic</option>
                                            <option value="DK" {{ $customer->country == 'DK' ? 'selected' : '' }}>Denmark</option>
                                            <option value="DJ" {{ $customer->country == 'DJ' ? 'selected' : '' }}>Djibouti</option>
                                            <option value="DM" {{ $customer->country == 'DM' ? 'selected' : '' }}>Dominica</option>
                                            <option value="DO" {{ $customer->country == 'DO' ? 'selected' : '' }}>Dominican Republic</option>
                                            <option value="EC" {{ $customer->country == 'EC' ? 'selected' : '' }}>Ecuador</option>
                                            <option value="EG" {{ $customer->country == 'EG' ? 'selected' : '' }}>Egypt</option>
                                            <option value="SV" {{ $customer->country == 'SV' ? 'selected' : '' }}>El Salvador</option>
                                            <option value="GQ" {{ $customer->country == 'GQ' ? 'selected' : '' }}>Equatorial Guinea</option>
                                            <option value="ER" {{ $customer->country == 'ER' ? 'selected' : '' }}>Eritrea</option>
                                            <option value="EE" {{ $customer->country == 'EE' ? 'selected' : '' }}>Estonia</option>
                                            <option value="ET" {{ $customer->country == 'ET' ? 'selected' : '' }}>Ethiopia</option>
                                            <option value="FK" {{ $customer->country == 'FK' ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                            <option value="FO" {{ $customer->country == 'FO' ? 'selected' : '' }}>Faroe Islands</option>
                                            <option value="FJ" {{ $customer->country == 'FJ' ? 'selected' : '' }}>Fiji</option>
                                            <option value="FI" {{ $customer->country == 'FI' ? 'selected' : '' }}>Finland</option>
                                            <option value="FR" {{ $customer->country == 'FR' ? 'selected' : '' }}>France</option>
                                            <option value="GF" {{ $customer->country == 'GF' ? 'selected' : '' }}>French Guiana</option>
                                            <option value="PF" {{ $customer->country == 'PF' ? 'selected' : '' }}>French Polynesia</option>
                                            <option value="TF" {{ $customer->country == 'TF' ? 'selected' : '' }}>French Southern Territories</option>
                                            <option value="GA" {{ $customer->country == 'GA' ? 'selected' : '' }}>Gabon</option>
                                            <option value="GM" {{ $customer->country == 'GM' ? 'selected' : '' }}>Gambia</option>
                                            <option value="GE" {{ $customer->country == 'GE' ? 'selected' : '' }}>Georgia</option>
                                            <option value="DE" {{ $customer->country == 'DE' ? 'selected' : '' }}>Germany</option>
                                            <option value="GH" {{ $customer->country == 'GH' ? 'selected' : '' }}>Ghana</option>
                                            <option value="GI" {{ $customer->country == 'GI' ? 'selected' : '' }}>Gibraltar</option>
                                            <option value="GR" {{ $customer->country == 'GR' ? 'selected' : '' }}>Greece</option>
                                            <option value="GL" {{ $customer->country == 'GL' ? 'selected' : '' }}>Greenland</option>
                                            <option value="GD" {{ $customer->country == 'GD' ? 'selected' : '' }}>Grenada</option>
                                            <option value="GP" {{ $customer->country == 'GP' ? 'selected' : '' }}>Guadeloupe</option>
                                            <option value="GU" {{ $customer->country == 'GU' ? 'selected' : '' }}>Guam</option>
                                            <option value="GT" {{ $customer->country == 'GT' ? 'selected' : '' }}>Guatemala</option>
                                            <option value="GG" {{ $customer->country == 'GG' ? 'selected' : '' }}>Guernsey</option>
                                            <option value="GN" {{ $customer->country == 'GN' ? 'selected' : '' }}>Guinea</option>
                                            <option value="GW" {{ $customer->country == 'GW' ? 'selected' : '' }}>Guinea-Bissau</option>
                                            <option value="GY" {{ $customer->country == 'GY' ? 'selected' : '' }}>Guyana</option>
                                            <option value="HT" {{ $customer->country == 'HT' ? 'selected' : '' }}>Haiti</option>
                                            <option value="HM" {{ $customer->country == 'HM' ? 'selected' : '' }}>Heard Island and Mcdonald Islands</option>
                                            <option value="VA" {{ $customer->country == 'VA' ? 'selected' : '' }}>Holy See (Vatican City State)</option>
                                            <option value="HN" {{ $customer->country == 'HN' ? 'selected' : '' }}>Honduras</option>
                                            <option value="HK" {{ $customer->country == 'HK' ? 'selected' : '' }}>Hong Kong</option>
                                            <option value="HU" {{ $customer->country == 'HU' ? 'selected' : '' }}>Hungary</option>
                                            <option value="IS" {{ $customer->country == 'IS' ? 'selected' : '' }}>Iceland</option>
                                            <option value="IN" {{ $customer->country == 'IN' ? 'selected' : '' }}>India</option>
                                            <option value="ID" {{ $customer->country == 'ID' ? 'selected' : '' }}>Indonesia</option>
                                            <option value="IR" {{ $customer->country == 'IR' ? 'selected' : '' }}>Iran, Islamic Republic of</option>
                                            <option value="IQ" {{ $customer->country == 'IQ' ? 'selected' : '' }}>Iraq</option>
                                            <option value="IE" {{ $customer->country == 'IE' ? 'selected' : '' }}>Ireland</option>
                                            <option value="IM" {{ $customer->country == 'IM' ? 'selected' : '' }}>Isle of Man</option>
                                            <option value="IL" {{ $customer->country == 'IL' ? 'selected' : '' }}>Israel</option>
                                            <option value="IT" {{ $customer->country == 'IT' ? 'selected' : '' }}>Italy</option>
                                            <option value="JM" {{ $customer->country == 'JM' ? 'selected' : '' }}>Jamaica</option>
                                            <option value="JP" {{ $customer->country == 'JP' ? 'selected' : '' }}>Japan</option>
                                            <option value="JE" {{ $customer->country == 'JE' ? 'selected' : '' }}>Jersey</option>
                                            <option value="JO" {{ $customer->country == 'JO' ? 'selected' : '' }}>Jordan</option>
                                            <option value="KZ" {{ $customer->country == 'KZ' ? 'selected' : '' }}>Kazakhstan</option>
                                            <option value="KE" {{ $customer->country == 'KE' ? 'selected' : '' }}>Kenya</option>
                                            <option value="KI" {{ $customer->country == 'KI' ? 'selected' : '' }}>Kiribati</option>
                                            <option value="KP" {{ $customer->country == 'KP' ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                                            <option value="KR" {{ $customer->country == 'KR' ? 'selected' : '' }}>Korea, Republic of</option>
                                            <option value="XK" {{ $customer->country == 'XK' ? 'selected' : '' }}>Kosovo</option>
                                            <option value="KW" {{ $customer->country == 'KW' ? 'selected' : '' }}>Kuwait</option>
                                            <option value="KG" {{ $customer->country == 'KG' ? 'selected' : '' }}>Kyrgyzstan</option>
                                            <option value="LA" {{ $customer->country == 'LA' ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                                            <option value="LV" {{ $customer->country == 'LV' ? 'selected' : '' }}>Latvia</option>
                                            <option value="LB" {{ $customer->country == 'LB' ? 'selected' : '' }}>Lebanon</option>
                                            <option value="LS" {{ $customer->country == 'LS' ? 'selected' : '' }}>Lesotho</option>
                                            <option value="LR" {{ $customer->country == 'LR' ? 'selected' : '' }}>Liberia</option>
                                            <option value="LY" {{ $customer->country == 'LY' ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                                            <option value="LI" {{ $customer->country == 'LI' ? 'selected' : '' }}>Liechtenstein</option>
                                            <option value="LT" {{ $customer->country == 'LT' ? 'selected' : '' }}>Lithuania</option>
                                            <option value="LU" {{ $customer->country == 'LU' ? 'selected' : '' }}>Luxembourg</option>
                                            <option value="MO" {{ $customer->country == 'MO' ? 'selected' : '' }}>Macao</option>
                                            <option value="MK" {{ $customer->country == 'MK' ? 'selected' : '' }}>Macedonia, the Former Yugoslav Republic of</option>
                                            <option value="MG" {{ $customer->country == 'MG' ? 'selected' : '' }}>Madagascar</option>
                                            <option value="MW" {{ $customer->country == 'MW' ? 'selected' : '' }}>Malawi</option>
                                            <option value="MY" {{ $customer->country == 'MY' ? 'selected' : '' }}>Malaysia</option>
                                            <option value="MV" {{ $customer->country == 'MV' ? 'selected' : '' }}>Maldives</option>
                                            <option value="ML" {{ $customer->country == 'ML' ? 'selected' : '' }}>Mali</option>
                                            <option value="MT" {{ $customer->country == 'MT' ? 'selected' : '' }}>Malta</option>
                                            <option value="MH" {{ $customer->country == 'MH' ? 'selected' : '' }}>Marshall Islands</option>
                                            <option value="MQ" {{ $customer->country == 'MQ' ? 'selected' : '' }}>Martinique</option>
                                            <option value="MR" {{ $customer->country == 'MR' ? 'selected' : '' }}>Mauritania</option>
                                            <option value="MU" {{ $customer->country == 'MU' ? 'selected' : '' }}>Mauritius</option>
                                            <option value="YT" {{ $customer->country == 'YT' ? 'selected' : '' }}>Mayotte</option>
                                            <option value="MX" {{ $customer->country == 'MX' ? 'selected' : '' }}>Mexico</option>
                                            <option value="FM" {{ $customer->country == 'FM' ? 'selected' : '' }}>Micronesia, Federated States of</option>
                                            <option value="MD" {{ $customer->country == 'MD' ? 'selected' : '' }}>Moldova, Republic of</option>
                                            <option value="MC" {{ $customer->country == 'MC' ? 'selected' : '' }}>Monaco</option>
                                            <option value="MN" {{ $customer->country == 'MN' ? 'selected' : '' }}>Mongolia</option>
                                            <option value="ME" {{ $customer->country == 'ME' ? 'selected' : '' }}>Montenegro</option>
                                            <option value="MS" {{ $customer->country == 'MS' ? 'selected' : '' }}>Montserrat</option>
                                            <option value="MA" {{ $customer->country == 'MA' ? 'selected' : '' }}>Morocco</option>
                                            <option value="MZ" {{ $customer->country == 'MZ' ? 'selected' : '' }}>Mozambique</option>
                                            <option value="MM" {{ $customer->country == 'MM' ? 'selected' : '' }}>Myanmar</option>
                                            <option value="NA" {{ $customer->country == 'NA' ? 'selected' : '' }}>Namibia</option>
                                            <option value="NR" {{ $customer->country == 'NR' ? 'selected' : '' }}>Nauru</option>
                                            <option value="NP" {{ $customer->country == 'NP' ? 'selected' : '' }}>Nepal</option>
                                            <option value="NL" {{ $customer->country == 'NL' ? 'selected' : '' }}>Netherlands</option>
                                            <option value="AN" {{ $customer->country == 'AN' ? 'selected' : '' }}>Netherlands Antilles</option>
                                            <option value="NC" {{ $customer->country == 'NC' ? 'selected' : '' }}>New Caledonia</option>
                                            <option value="NZ" {{ $customer->country == 'NZ' ? 'selected' : '' }}>New Zealand</option>
                                            <option value="NI" {{ $customer->country == 'NI' ? 'selected' : '' }}>Nicaragua</option>
                                            <option value="NE" {{ $customer->country == 'NE' ? 'selected' : '' }}>Niger</option>
                                            <option value="NG" {{ $customer->country == 'NG' ? 'selected' : '' }}>Nigeria</option>
                                            <option value="NU" {{ $customer->country == 'NU' ? 'selected' : '' }}>Niue</option>
                                            <option value="NF" {{ $customer->country == 'NF' ? 'selected' : '' }}>Norfolk Island</option>
                                            <option value="MP" {{ $customer->country == 'MP' ? 'selected' : '' }}>Northern Mariana Islands</option>
                                            <option value="NO" {{ $customer->country == 'NO' ? 'selected' : '' }}>Norway</option>
                                            <option value="OM" {{ $customer->country == 'OM' ? 'selected' : '' }}>Oman</option>
                                            <option value="PK" {{ $customer->country == 'PK' ? 'selected' : '' }}>Pakistan</option>
                                            <option value="PW" {{ $customer->country == 'PW' ? 'selected' : '' }}>Palau</option>
                                            <option value="PS" {{ $customer->country == 'PS' ? 'selected' : '' }}>Palestinian Territory, Occupied</option>
                                            <option value="PA" {{ $customer->country == 'PA' ? 'selected' : '' }}>Panama</option>
                                            <option value="PG" {{ $customer->country == 'PG' ? 'selected' : '' }}>Papua New Guinea</option>
                                            <option value="PY" {{ $customer->country == 'PY' ? 'selected' : '' }}>Paraguay</option>
                                            <option value="PE" {{ $customer->country == 'PE' ? 'selected' : '' }}>Peru</option>
                                            <option value="PH" {{ $customer->country == 'PH' ? 'selected' : '' }}>Philippines</option>
                                            <option value="PN" {{ $customer->country == 'PN' ? 'selected' : '' }}>Pitcairn</option>
                                            <option value="PL" {{ $customer->country == 'PL' ? 'selected' : '' }}>Poland</option>
                                            <option value="PT" {{ $customer->country == 'PT' ? 'selected' : '' }}>Portugal</option>
                                            <option value="PR" {{ $customer->country == 'PR' ? 'selected' : '' }}>Puerto Rico</option>
                                            <option value="QA" {{ $customer->country == 'QA' ? 'selected' : '' }}>Qatar</option>
                                            <option value="RE" {{ $customer->country == 'RE' ? 'selected' : '' }}>Reunion</option>
                                            <option value="RO" {{ $customer->country == 'RO' ? 'selected' : '' }}>Romania</option>
                                            <option value="RU" {{ $customer->country == 'RU' ? 'selected' : '' }}>Russian Federation</option>
                                            <option value="RW" {{ $customer->country == 'RW' ? 'selected' : '' }}>Rwanda</option>
                                            <option value="BL" {{ $customer->country == 'BL' ? 'selected' : '' }}>Saint Barthelemy</option>
                                            <option value="SH" {{ $customer->country == 'SH' ? 'selected' : '' }}>Saint Helena</option>
                                            <option value="KN" {{ $customer->country == 'KN' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                            <option value="LC" {{ $customer->country == 'LC' ? 'selected' : '' }}>Saint Lucia</option>
                                            <option value="MF" {{ $customer->country == 'MF' ? 'selected' : '' }}>Saint Martin</option>
                                            <option value="PM" {{ $customer->country == 'PM' ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                            <option value="VC" {{ $customer->country == 'VC' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                            <option value="WS" {{ $customer->country == 'WS' ? 'selected' : '' }}>Samoa</option>
                                            <option value="SM" {{ $customer->country == 'SM' ? 'selected' : '' }}>San Marino</option>
                                            <option value="ST" {{ $customer->country == 'ST' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                            <option value="SA" {{ $customer->country == 'SA' ? 'selected' : '' }}>Saudi Arabia</option>
                                            <option value="SN" {{ $customer->country == 'SN' ? 'selected' : '' }}>Senegal</option>
                                            <option value="RS" {{ $customer->country == 'RS' ? 'selected' : '' }}>Serbia</option>
                                            <option value="CS" {{ $customer->country == 'CS' ? 'selected' : '' }}>Serbia and Montenegro</option>
                                            <option value="SC" {{ $customer->country == 'SC' ? 'selected' : '' }}>Seychelles</option>
                                            <option value="SL" {{ $customer->country == 'SL' ? 'selected' : '' }}>Sierra Leone</option>
                                            <option value="SG" {{ $customer->country == 'SG' ? 'selected' : '' }}>Singapore</option>
                                            <option value="SX" {{ $customer->country == 'SX' ? 'selected' : '' }}>Sint Maarten</option>
                                            <option value="SK" {{ $customer->country == 'SK' ? 'selected' : '' }}>Slovakia</option>
                                            <option value="SI" {{ $customer->country == 'SI' ? 'selected' : '' }}>Slovenia</option>
                                            <option value="SB" {{ $customer->country == 'SB' ? 'selected' : '' }}>Solomon Islands</option>
                                            <option value="SO" {{ $customer->country == 'SO' ? 'selected' : '' }}>Somalia</option>
                                            <option value="ZA" {{ $customer->country == 'ZA' ? 'selected' : '' }}>South Africa</option>
                                            <option value="GS" {{ $customer->country == 'GS' ? 'selected' : '' }}>South Georgia and the South Sandwich Islands</option>
                                            <option value="SS" {{ $customer->country == 'SS' ? 'selected' : '' }}>South Sudan</option>
                                            <option value="ES" {{ $customer->country == 'ES' ? 'selected' : '' }}>Spain</option>
                                            <option value="LK" {{ $customer->country == 'LK' ? 'selected' : '' }}>Sri Lanka</option>
                                            <option value="SD" {{ $customer->country == 'SD' ? 'selected' : '' }}>Sudan</option>
                                            <option value="SR" {{ $customer->country == 'SR' ? 'selected' : '' }}>Suriname</option>
                                            <option value="SJ" {{ $customer->country == 'SJ' ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                            <option value="SZ" {{ $customer->country == 'SZ' ? 'selected' : '' }}>Swaziland</option>
                                            <option value="SE" {{ $customer->country == 'SE' ? 'selected' : '' }}>Sweden</option>
                                            <option value="CH" {{ $customer->country == 'CH' ? 'selected' : '' }}>Switzerland</option>
                                            <option value="SY" {{ $customer->country == 'SY' ? 'selected' : '' }}>Syrian Arab Republic</option>
                                            <option value="TW" {{ $customer->country == 'TW' ? 'selected' : '' }}>Taiwan, Province of China</option>
                                            <option value="TJ" {{ $customer->country == 'TJ' ? 'selected' : '' }}>Tajikistan</option>
                                            <option value="TZ" {{ $customer->country == 'TZ' ? 'selected' : '' }}>Tanzania, United Republic of</option>
                                            <option value="TH" {{ $customer->country == 'TH' ? 'selected' : '' }}>Thailand</option>
                                            <option value="TL" {{ $customer->country == 'TL' ? 'selected' : '' }}>Timor-Leste</option>
                                            <option value="TG" {{ $customer->country == 'TG' ? 'selected' : '' }}>Togo</option>
                                            <option value="TK" {{ $customer->country == 'TK' ? 'selected' : '' }}>Tokelau</option>
                                            <option value="TO" {{ $customer->country == 'TO' ? 'selected' : '' }}>Tonga</option>
                                            <option value="TT" {{ $customer->country == 'TT' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                            <option value="TN" {{ $customer->country == 'TN' ? 'selected' : '' }}>Tunisia</option>
                                            <option value="TR" {{ $customer->country == 'TR' ? 'selected' : '' }}>Turkey</option>
                                            <option value="TM" {{ $customer->country == 'TM' ? 'selected' : '' }}>Turkmenistan</option>
                                            <option value="TC" {{ $customer->country == 'TC' ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                            <option value="TV" {{ $customer->country == 'TV' ? 'selected' : '' }}>Tuvalu</option>
                                            <option value="UG" {{ $customer->country == 'UG' ? 'selected' : '' }}>Uganda</option>
                                            <option value="UA" {{ $customer->country == 'UA' ? 'selected' : '' }}>Ukraine</option>
                                            <option value="AE" {{ $customer->country == 'AE' ? 'selected' : '' }}>United Arab Emirates</option>
                                            <option value="GB" {{ $customer->country == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                            <option value="US" {{ $customer->country == 'US' ? 'selected' : '' }}>United States</option>
                                            <option value="UM" {{ $customer->country == 'UM' ? 'selected' : '' }}>United States Minor Outlying Islands</option>
                                            <option value="UY" {{ $customer->country == 'UY' ? 'selected' : '' }}>Uruguay</option>
                                            <option value="UZ" {{ $customer->country == 'UZ' ? 'selected' : '' }}>Uzbekistan</option>
                                            <option value="VU" {{ $customer->country == 'VU' ? 'selected' : '' }}>Vanuatu</option>
                                            <option value="VE" {{ $customer->country == 'VE' ? 'selected' : '' }}>Venezuela</option>
                                            <option value="VN" {{ $customer->country == 'VN' ? 'selected' : '' }}>Viet Nam</option>
                                            <option value="VG" {{ $customer->country == 'VG' ? 'selected' : '' }}>Virgin Islands, British</option>
                                            <option value="VI" {{ $customer->country == 'VI' ? 'selected' : '' }}>Virgin Islands, U.s.</option>
                                            <option value="WF" {{ $customer->country == 'WF' ? 'selected' : '' }}>Wallis and Futuna</option>
                                            <option value="EH" {{ $customer->country == 'EH' ? 'selected' : '' }}>Western Sahara</option>
                                            <option value="YE" {{ $customer->country == 'YE' ? 'selected' : '' }}>Yemen</option>
                                            <option value="ZM" {{ $customer->country == 'ZM' ? 'selected' : '' }}>Zambia</option>
                                            <option value="ZW" {{ $customer->country == 'ZW' ? 'selected' : '' }}>Zimbabwe</option>
                                </select>
                                <label for="country">Country</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="zip_code" id="basic-icon-default-email"
                                        class="form-control" placeholder="Enter Zip Code" value="{{ $customer->zip_code }}" aria-label="Enter Zip Code"
                                        aria-describedby="basic-icon-default-email2" />
                                    <label for="basic-icon-default-email">Zip Code</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
