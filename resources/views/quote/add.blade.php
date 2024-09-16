@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1  container-p-y">
        <form id="invoiceForm" action="{{ url('/quote/add') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                        href="{{ url('/quote') }}" class="text-muted fw-light">/ Quote</a><span class="color">
                        /</span><span class="text-heading fw-bold text-color"> Add</span>
                </h4>
                <div class="text-end">
                    {{-- <button type="button" value="2" name="status" class="close-invoice btn btn-primary">
                        Save & Close
                    </button> --}}
                    <button type="submit" value="1" name="status" class="btn btn-primary">
                        Save
                    </button>
                </div>
                {{-- <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button> --}}
            </div>
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body pb-3">
                            <div class="row mx-0">
                                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                    <div class=" svg-illustration align-items-center gap-2">
                                        <img src="{{ url('/blue-logo.png') }}" width="150px" height="40px"
                                            class="h4 mb-0  app-brand-text fw-bold">
                                    </div>
                                    {{-- <h4 class="mb-0">Create Invoice</h4> --}}

                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select id="customer_source" name="customer_source" type="text"
                                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($customer_sources as $source)
                                                    <option value="{{ $source->id }}">
                                                        {{ $source->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="customer_type">Customer Source</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select id="customer_type_id" name="customer_type_id" type="text"
                                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($customer_types as $type)
                                                    <option value="{{ $type->id }}">
                                                        {{ $type->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="customer_type">Customer Type</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="customer_id" required name="customer_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($customers as $customer)
                                                <option {{ request()->customer_id == $customer->id ? 'selected' : '' }}
                                                    value="{{ $customer->id }}">
                                                    {{ $customer->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="salesperson">Customer Name</label>
                                    </div>
                                </div>
                                <div class="col-md-2 offset-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="currency_id" required name="currency_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value=""> </option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}">
                                                    {{ $currency->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="currency">Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="conversion_rate" name="conversion_rate"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Conversion Rate" aria-label="Enter Conversion Rate"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Conversion Rate</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="origin" name="origin"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Origin" aria-label="Enter Origin"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Origin</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-2 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="origin" name="origin" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Aland Islands">Aland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and
                                                Saba</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                            </option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, Democratic Republic of the Congo">Congo, Democratic
                                                Republic of the Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote DIvoire">Cote DIvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Curacao">Curacao</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                            </option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories
                                            </option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald
                                                Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                            </option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                                People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic
                                                Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the
                                                Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of
                                            </option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied
                                            </option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Barthelemy">Saint Barthelemy</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Martin">Saint Martin</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the
                                                Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Sint Maarten">Sint Maarten</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and the South Sandwich Islands">South Georgia and
                                                the South Sandwich Islands</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of
                                            </option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor
                                                Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="date" name="date"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Date From" aria-label="Enter Date From"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Date From</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="valid_till" name="valid_till"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Date To" aria-label="Enter Date To"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Date To</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pax" name="pax"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Pax" aria-label="Enter Pax"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Pax</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="meal_plan" name="meal_plan"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Meal Plan" aria-label="Enter Meal Plan"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Meal Plan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body pt-0">
                            <div class="source-item pt-1">
                                <div class="mb-3" data-repeater-list="group">
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                        <div class="d-flex rounded position-relative pe-0">
                                            <div class="row w-100 p-2">
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 ">Product Categories</p>
                                                    <select class="product-category-dropdown form-select" required
                                                        name="product_category_id" type="text">
                                                        <option value="">Select</option>
                                                        @foreach ($product_categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 ">Products</p>
                                                    <select class="product-dropdown form-select" required
                                                        name="product_id" type="text">
                                                        <option value="">Select</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Rate</p>
                                                    <input type="text" class="form-control charges" name="charges"
                                                        required id="charges" placeholder="Rate" />
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Persons / Rooms</p>
                                                    <input type="text" min="1" max="99999"
                                                        class="form-control invoice-item-qty personsrooms"
                                                        name="persons_rooms" id="persons_rooms"
                                                        placeholder="Persons / Rooms" />
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Days / Dives</p>
                                                    <input type="text" min="1" max="99999"
                                                        class="form-control invoice-item-qty quantity days_dives"
                                                        name="days_dives" id="days_dives" placeholder="Days / Dives" />
                                                </div>
                                                <div class="col-md-1 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Amount</p>
                                                    <input type="text" class="form-control amount" name="amount"
                                                        required placeholder="Amount" />
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Converted Amount</p>
                                                    <input type="text" class="form-control converted-amount"
                                                        name="converted_amount" readonly placeholder="Converted Amount" />
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                                <i class="mdi mdi-close cursor-pointer" data-repeater-delete></i>
                                                <div class="dropdown">
                                                    <i class="mdi mdi-cog-outline cursor-pointer more-options-dropdown"
                                                        role="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="outside" aria-expanded="false">
                                                    </i>
                                                    <div class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <div class="row g-3">
                                                            <div class="col-md-12 mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Discount</p>
                                                                <input type="text" id="discount" name="discount"
                                                                    class="form-control discount invoice-item-qty"
                                                                    placeholder="%" />
                                                            </div>
                                                            <div class="col-md-12  mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Tax</p>
                                                                <input type="text" id="tax" name="tax"
                                                                    class="form-control tax invoice-item-qty"
                                                                    placeholder="%" />
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-divider my-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="mdi mdi-plus me-1"></i> Add Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-start">
                                    <div class="invoice-calculations">
                                        {{-- <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="me-3">Payment :</span>
                                            <div class="row">
                                                <div class="col-md-6 pe-0">
                                                    <select name="payment_mode" class="select2 form-select"
                                                        id="payment_mode">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Online Transfer">Online Transfer</option>
                                                        <option value="Card">Credit Card</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" required name="payment" class="form-control"
                                                        id="payment" placeholder="$" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="card_charges">
                                            <div class="col-md-6">
                                                <span class="me-3">Card Charges :</span>
                                                <input type="text" name="credit_card_input" class="form-control"
                                                    id="credit_card_input" placeholder="$" />
                                            </div>
                                            <div class="col-md-6">
                                                <span class="me-3">Total Amount to Pay :</span>
                                                <input type="text" name="total_amount_paid" class="form-control"
                                                    id="total_amount_paid" placeholder="$" />
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Due:</span>
                                            <input type="hidden" class="due_amount" name="due_amount">
                                            <span class="fw-semibold" id="due_amount">$ 00.00</span>
                                        </div> --}}
                                        {{-- <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Advance:</span>
                                            <input type="hidden" class="advance_amount" name="advance_amount">
                                            <span class="fw-semibold" id="advance_amount">$ 00.00</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-md-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Sub Total:</span>
                                            <input type="hidden" class="sub_total" name="sub_total">
                                            <span class="fw-semibold sub_total" id="sub_total">$ 00.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Discount :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_discount_percentage"
                                                    class="form-control w-px-100 me-2" id="total_discount_percentage"
                                                    placeholder="%" />
                                                <input type="text" name="total_discount_amount"
                                                    class="form-control w-px-100" id="total_discount_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Service Charge :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_service_charge"
                                                    class="form-control w-px-100 me-2" id="total_service_charge"
                                                    value="10" placeholder="%" />
                                                <input type="text" name="total_service_charge_amount"
                                                    class="form-control w-px-100" id="total_service_charge_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">GST :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_tax_percentage"
                                                    value="16" placeholder="%" />
                                                <input type="text" name="total_tax_amount"
                                                    class="form-control w-px-100" id="total_tax_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Green Tax :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_green_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_green_tax_percentage"
                                                    placeholder="%" />
                                                <input type="text" name="total_green_tax_amount"
                                                    class="form-control w-px-100" id="total_green_tax_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Total:</span>
                                            <input type="hidden" class="total_amount" name="total_amount">
                                            <span class="fw-semibold" id="total_amount">$ 00.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-300">Total Converted Amount:</span>
                                            <input type="hidden" class="total_amount_converted"
                                                name="total_amount_converted">
                                            <span class="fw-semibold" id="total_amount_converted"> 00.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/ Content -->
@endsection
<script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('/assets/js/offcanvas-send-invoice.js') }}"></script>
<script src="{{ url('/assets/js/app-invoice-add.js') }}"></script>

<script>
    $(document).ready(function() {
        // Array to store information about each procedure
        var procedures = [];

        // Listen for changes in the input fields
        $(document).on("change", ".product-dropdown, .charges, .quantity, .discount, .tax, .days_dives",
            calculateTotalAmount);
        $(document).on("input", ".charges, .discount, .tax, .quantity, .days_dives", calculateTotalAmount);


        // $(document).on("change",
        //     "#total_discount_percentage, #total_tax_percentage, #total_discount_amount, #total_tax_amount",
        //     calculateTotalBill);

        function calculateTotalAmount() {
            var totalAmount = 0;
            var totalConvertedAmount = 0;
            var currency = $('#currency_id option:selected').text() || '$';
            var ConversionRate = parseFloat($('#conversion_rate').val()) || 1;



            // Calculate total amount for each procedure
            $(".product-dropdown").each(function() {
                var repeaterWrapper = $(this).closest('.repeater-wrapper');
                var charges = parseFloat(repeaterWrapper.find(".charges").val()) || 0;
                // var quantity = parseFloat(repeaterWrapper.find(".quantity").val()) || 0;
                var days_dives = parseFloat(repeaterWrapper.find(".days_dives").val()) || 0;
                var discountPercentage = parseFloat(repeaterWrapper.find(".discount").val()) || 0;
                var taxPercentage = parseFloat(repeaterWrapper.find(".tax").val()) || 0;
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;
                // var dayDivesAmount = 1;
                // if (days_dives > 1) {
                //     dayDivesAmount = days_dives * charges;
                // }

                // var personRoomAmount = 1;
                // if (quantity > 1) {
                //     personRoomAmount = quantity * charges;
                // }

                var rateAmount = 1;
                if (days_dives == 1) {
                    rateAmount = charges;
                } else if (days_dives > 1) {
                    rateAmount = days_dives * charges;
                } else if (days_dives < 1) {
                    rateAmount = 0;
                }

                // var totalProcedureAmount = personRoomAmount + dayDivesAmount - discountAmount +
                //     taxAmount;
                var totalProcedureAmount = rateAmount - discountAmount +
                    taxAmount;
                var totalProcedureConvertedAmount = totalProcedureAmount * ConversionRate;

                // Update the amount field for the current procedure
                repeaterWrapper.find(".amount").val(totalProcedureAmount.toFixed(2));
                repeaterWrapper.find(".converted-amount").val(totalProcedureConvertedAmount.toFixed(2));

                // Add the current procedure amount to the total
                totalAmount += totalProcedureAmount;
                totalConvertedAmount += totalProcedureConvertedAmount;
            });
            // Update the total amount field or perform other actions with the total
            $(".sub_total").val(totalConvertedAmount.toFixed(2));
            $("#sub_total").text(currency + totalConvertedAmount.toFixed(2));
            $(".total_amount").val(totalAmount.toFixed(2));
            $("#total_amount").text("$ " + totalAmount.toFixed(2));
            $(".total_amount_converted").val(totalConvertedAmount.toFixed(2));
            $("#total_amount_converted").text(currency + totalConvertedAmount.toFixed(2));
            calculateTax();
            calculateServiceCharges();
            updateFinalAmount();
        }

        $("#total_discount_percentage").on("input", function() {
            var discountPercentage = parseFloat($('#total_discount_percentage').val());

            // console.log(discountPercentage);
            if (!isNaN(discountPercentage)) {
                var discountAmount = (discountPercentage / 100) *
                    parseInt($('#sub_total').val()); // Replace 1000 with your desired base amount
                // console.log(discountAmount);
                $("#total_discount_amount").val(discountAmount.toFixed(2));
                // var final_amount = discountAmount;
                // console.log(discountAmount)
            } else {
                $("#total_discount_amount").val("");
            }
            updateFinalAmount();
        });

        $("#total_discount_amount").on("input", function() {
            var discountAmount = parseFloat($(this).val());

            if (!isNaN(discountAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var discountPercentage = (discountAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_discount_percentage").val(discountPercentage.toFixed(0));
            } else {
                $("#total_discount_percentage").val("");
            }
        });

        function calculateServiceCharges() {
            var taxPercentage = parseFloat($('#total_service_charge').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_service_charge_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_service_charge_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_service_charge").on("change", calculateServiceCharges);
        });
        $(document).ready(function() {
            $("#total_service_charge").on("input", calculateServiceCharges);
        });


        $("#total_service_charge_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_service_charge").val(taxPercentage.toFixed(0));
            } else {
                $("#total_service_charge").val("");
            }
            updateFinalAmount();
        });

        function calculateTax() {
            var taxPercentage = parseFloat($('#total_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_tax_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_tax_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_tax_percentage").on("change", calculateTax);
        });

        $(document).ready(function() {
            $("#total_tax_percentage").on("input", calculateTax);
        });


        $("#total_tax_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function calculateGreenTax() {
            var taxPercentage = parseFloat($('#total_green_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_green_tax_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_green_tax_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_green_tax_percentage").on("change", calculateGreenTax);
        });
        $(document).ready(function() {
            $("#total_green_tax_percentage").on("input", calculateGreenTax);
        });


        $("#total_green_tax_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_green_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_green_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function updateFinalAmount() {
            var shareAmount = parseFloat($("#sub_total").val());
            var discountAmount = parseFloat($("#total_discount_amount").val());
            var discountPercentage = parseFloat($("#total_discount_percentage").val());
            var serviceChargesAmount = parseFloat($("#total_service_charge_amount").val());
            var serviceChargesPercentage = parseFloat($("#total_service_charge_percentage").val());
            var taxAmount = parseFloat($("#total_tax_amount").val());
            var taxPercentage = parseFloat($("#total_tax_percentage").val());
            var greenTaxAmount = parseFloat($("#total_green_tax_amount").val());
            var greenTaxPercentage = parseFloat($("#total_green_tax_percentage").val());
            var ConversionRate = parseFloat($('#conversion_rate').val()) || 1;
            var currency = $('#currency_id option:selected').text() || '$';

            if (!isNaN(shareAmount)) {
                var totalAmount = shareAmount;

                if (!isNaN(discountAmount)) {
                    totalAmount -= discountAmount;
                } else if (!isNaN(discountPercentage)) {
                    totalAmount -= (discountPercentage / 100) * shareAmount;
                }

                if (!isNaN(taxAmount)) {
                    totalAmount += taxAmount;
                } else if (!isNaN(taxPercentage)) {
                    totalAmount += (taxPercentage / 100) * shareAmount;
                }
                if (!isNaN(serviceChargesAmount)) {
                    totalAmount += serviceChargesAmount;
                } else if (!isNaN(serviceChargesPercentage)) {
                    totalAmount += (serviceChargesPercentage / 100) * shareAmount;
                }
                if (!isNaN(greenTaxAmount)) {
                    totalAmount += greenTaxAmount;
                } else if (!isNaN(greenTaxPercentage)) {
                    totalAmount += (greenTaxPercentage / 100) * shareAmount;
                }

                var totalConvertedAmount = totalAmount / ConversionRate;

                $(".total_amount").val(totalConvertedAmount.toFixed(2));
                $("#total_amount").text("$ " + totalConvertedAmount.toFixed(2));
                $(".total_amount_converted").val(totalAmount.toFixed(2));
                $("#total_amount_converted").text(currency + totalAmount.toFixed(2));
            }
        }

        // Trigger the update on input change for discount and tax inputs
        $("#total_discount_amount, #total_discount_percentage, #total_tax_amount, #total_tax_percentage").on(
            "input",
            function() {
                updateFinalAmount();
            });

        $("#payment").on("input", function() {
            // Get the total amount
            var totalAmount = parseFloat($(".total_amount_converted").val()) || 0;
            var currency = $('#currency_id option:selected').text() || '$';

            // Get the entered payment amount
            var paymentAmount = parseFloat($(this).val()) || 0;

            // Calculate due and advance amounts
            var dueAmount = Math.max(totalAmount - paymentAmount, 0);
            var advanceAmount = Math.max(paymentAmount - totalAmount, 0);

            // Update the UI with the calculated values
            $(".due_amount").val(dueAmount.toFixed(2));
            $("#due_amount").text(currency + dueAmount.toFixed(2));

            $(".advance_amount").val(advanceAmount.toFixed(2));
            $("#advance_amount").text("$ " + advanceAmount.toFixed(2));
            updatePayment();
        });

        function getProductId(select) {
            var selectedProcedure = select.options[select.selectedIndex].value;
            var repeaterWrapper = $(select).closest('.repeater-wrapper');

            $.ajax({
                type: "POST",
                data: {
                    "product_id": selectedProcedure,
                },
                url: "{{ url('api/product/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    var totalAmount = data.price;
                    repeaterWrapper.find(".charges").val(data.price ?? null);
                    repeaterWrapper.find(".amount").val(data.price ?? null);
                    repeaterWrapper.find(".quantity").val(1 ?? null);
                    repeaterWrapper.find(".personsrooms").val(1 ?? null);
                    $(".sub_total").val(parseFloat(totalAmount ?? 00).toFixed(2));
                    $("#sub_total").text("$ " + parseFloat(totalAmount ?? 00).toFixed(2));
                    $(".total_amount").val(parseFloat(totalAmount ?? 00).toFixed(2));
                    $("#total_amount").text("$ " + parseFloat(totalAmount ?? 00).toFixed(2));
                    calculateTotalAmount();
                    updateFinalAmount();
                    calculateTax();
                    calculateServiceCharges();
                }
            });
        }

        function getByCurrencyId(select) {
            var selectedCurrency = select.options[select.selectedIndex].value;

            $.ajax({
                type: "POST",
                data: {
                    "currency_id": selectedCurrency,
                },
                url: "{{ url('api/currency/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    $('#conversion_rate').val(data.conversion_rate);
                    calculateTotalAmount();
                }
            });
        }

        function getProductsByCategoryId(select) {
            var selectedProductCategory = select.value; // Use select.value directly

            // Find the closest repeater wrapper
            var repeaterWrapper = $(select).closest('.repeater-wrapper');

            // Find the product dropdown within the repeater wrapper
            var productDropdown = repeaterWrapper.find('.product-dropdown');

            // Make an AJAX request
            $.ajax({
                type: "POST",
                data: {
                    "product_category_id": selectedProductCategory,
                },
                url: "{{ url('api/product/getByCategoryId') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;

                    // Clear existing options in the product dropdown
                    productDropdown.empty();

                    // Add the initial "Please select" option
                    productDropdown.append('<option value="">Please select</option>');

                    // Add new options based on the result
                    $.each(data, function(index, product) {
                        productDropdown.append('<option value="' + product.id + '">' +
                            product.name + '</option>');
                    });
                }
            });
        }

        $(document).on('click', '[data-repeater-delete]', function() {
            // Get the deleted row
            var deletedRow = $(this).closest('[data-repeater-item]');

            // Get the charges of the deleted row
            var deletedCharges = parseFloat(deletedRow.find(".charges").val()) || 0;

            // Subtract the charges of the deleted row from the total amount
            var currentTotalAmount = parseFloat($("#amount").val()) || 0;
            var newTotalAmount = Math.max(currentTotalAmount - deletedCharges, 0);

            // Update the total amount
            $("#amount").val(newTotalAmount.toFixed(2));

            // Remove the procedure from the group
            deletedRow.find(".procedure-dropdown").val("");

            // Remove the entire repeater item
            deletedRow.remove();

            // Recalculate the total amount
            calculateTotalAmount();
        });

        // Attach the change event to the product category dropdown
        // $('.product-category-dropdown').on('change', function() {
        //     getProductsByCategoryId(this);
        // });
        $(document).on('change', '.product-category-dropdown', function() {
            getProductsByCategoryId(this);
        });

        // Attach event handler to all procedure dropdowns
        $(document).on('change', '.product-dropdown', function() {
            getProductId(this);
        });

        $(document).on('change', '#currency_id', function() {
            getByCurrencyId(this);
        });
    });

    function updatePayment() {
        var currency = $('#currency_id option:selected').text() || '$';
        var selectedValue = $("#payment_mode").val();
        var totalAmount = parseFloat($("#payment").val()) || 0;
        var cardCharges = 0.035 * totalAmount;

        if (selectedValue == 'Card') {
            $('#card_charges').show();
            $("#credit_card_input").val(cardCharges.toFixed(2));
            $("#total_amount_paid").val((cardCharges + totalAmount).toFixed(2));
        } else {
            $('#card_charges').hide();
            $("#credit_card_input").val('');
            $("#total_amount_paid").val((totalAmount - cardCharges).toFixed(2));
        }
    }

    $(document).ready(function() {
        $("#payment_mode").on("change", function() {
            updatePayment();
        });
        $('#card_charges').hide();
    });

    $(document).ready(function() {
        $('.close-invoice').click(function(e) {
            // Prevent the button from triggering its default action (e.g., submitting a form)
            e.preventDefault();

            // Get the value of the dure_amount input
            var payment = $('#payment').val();
            var total_amount = $('.total_amount').val();
            // Check if dure_amount is 0
            if (parseFloat(payment) == parseFloat(total_amount)) {
                // Submit the form if dure_amount is 0
                $('#invoiceForm').submit();
            } else {
                // Show an alert if dure_amount is not 0
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Amount Should be Paid Fully! ',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    });
</script>
