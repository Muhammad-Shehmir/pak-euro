@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1  container-p-y">
        <form id="invoiceForm" action="{{ url('/quote/edit/' . $quote->id) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                        href="{{ url('/quote') }}" class="text-muted fw-light">/ Quote</a><span class="color">
                        /</span><span class="text-heading fw-bold text-color"> Edit</span>
                </h4>
                <div class="text-end">
                    {{-- <button type="button" value="2" name="status" class="close-invoice btn btn-primary">
                        Save & Close
                    </button> --}}
                    <button type="submit" class="btn btn-primary submitBtn">
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
                        <div class="card-body pb-0">
                            <div class="row mx-0">
                                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                    <div class=" svg-illustration align-items-center gap-2">
                                        <img src="{{ url('/blue-logo.png') }}" width="150px" height="40px"
                                            class="h4 mb-0  app-brand-text fw-bold">
                                    </div>
                                    {{-- <h4 class="mb-0">Create Invoice</h4> --}}

                                </div>
                                {{-- <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                    <dl class="row mb-2 g-2">
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <div class="input-group input-group-merge disabled">
                                                <span class="input-group-text">#</span>
                                                <input type="text" class="form-control" disabled
                                                    placeholder="Invoice No.#"
                                                    value="{{ $quote ? (int) $quote->id : null }}"
                                                    id="invoiceId" />
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <input type="date" class="form-control date-picker" name="date"
                                                id="date-picker" placeholder="YYYY-MM-DD"
                                                value="{{ \Carbon\Carbon::parse($quote->created_at)->toDateString() }}" />

                                        </dd>
                                    </dl>
                                </div> --}}
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
                                                    <option
                                                        {{ $quote->customer_source_id == $source->id ? 'selected' : '' }}
                                                        value="{{ $source->id }}">
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
                                                    <option {{ $quote->customer_type_id == $type->id ? 'selected' : '' }}
                                                        value="{{ $type->id }}">
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
                                                <option {{ $quote->customer_id == $customer->id ? 'selected' : '' }}
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
                                                <option {{ $quote->currency_id == $currency->id ? 'selected' : '' }}
                                                    value="{{ $currency->id }}">
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
                                                value="{{ $quote->conversion_rate }}" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Conversion Rate"
                                                aria-label="Enter Conversion Rate"
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
                                                value="{{ $quote->origin }}" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Origin" aria-label="Enter Origin"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Origin</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-2 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="origin" name="origin" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="" {{ $quote->origin == '' ? 'selected' : '' }}>Select</option>
                                    <option value="Afghanistan" {{ $quote->origin == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                    <option value="Aland Islands" {{ $quote->origin == 'Aland Islands' ? 'selected' : '' }}>Aland Islands</option>
                                    <option value="Albania" {{ $quote->origin == 'Albania' ? 'selected' : '' }}>Albania</option>
                                    <option value="Algeria" {{ $quote->origin == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                    <option value="American Samoa" {{ $quote->origin == 'American Samoa' ? 'selected' : '' }}>American Samoa</option>
                                    <option value="Andorra" {{ $quote->origin == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                    <option value="Angola" {{ $quote->origin == 'Angola' ? 'selected' : '' }}>Angola</option>
                                    <option value="Anguilla" {{ $quote->origin == 'Anguilla' ? 'selected' : '' }}>Anguilla</option>
                                    <option value="Antarctica" {{ $quote->origin == 'Antarctica' ? 'selected' : '' }}>Antarctica</option>
                                    <option value="Antigua and Barbuda" {{ $quote->origin == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                    <option value="Argentina" {{ $quote->origin == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                    <option value="Armenia" {{ $quote->origin == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                    <option value="Aruba" {{ $quote->origin == 'Aruba' ? 'selected' : '' }}>Aruba</option>
                                    <option value="Australia" {{ $quote->origin == 'Australia' ? 'selected' : '' }}>Australia</option>
                                    <option value="Austria" {{ $quote->origin == 'Austria' ? 'selected' : '' }}>Austria</option>
                                    <option value="Azerbaijan" {{ $quote->origin == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                    <option value="Bahamas" {{ $quote->origin == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                    <option value="Bahrain" {{ $quote->origin == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                    <option value="Bangladesh" {{ $quote->origin == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    <option value="Barbados" {{ $quote->origin == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                    <option value="Belarus" {{ $quote->origin == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                    <option value="Belgium" {{ $quote->origin == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                    <option value="Belize" {{ $quote->origin == 'Belize' ? 'selected' : '' }}>Belize</option>
                                    <option value="Benin" {{ $quote->origin == 'Benin' ? 'selected' : '' }}>Benin</option>
                                    <option value="Bermuda" {{ $quote->origin == 'Bermuda' ? 'selected' : '' }}>Bermuda</option>
                                    <option value="Bhutan" {{ $quote->origin == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                    <option value="Bolivia" {{ $quote->origin == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                    <option value="Bonaire, Sint Eustatius and Saba" {{ $quote->origin == 'Bonaire, Sint Eustatius and Saba' ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
                                    <option value="Bosnia and Herzegovina" {{ $quote->origin == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                    <option value="Botswana" {{ $quote->origin == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                    <option value="Bouvet Island" {{ $quote->origin == 'Bouvet Island' ? 'selected' : '' }}>Bouvet Island</option>
                                    <option value="Brazil" {{ $quote->origin == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                    <option value="British Indian Ocean Territory" {{ $quote->origin == 'British Indian Ocean Territory' ? 'selected' : '' }}>British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam" {{ $quote->origin == 'Brunei Darussalam' ? 'selected' : '' }}>Brunei Darussalam</option>
                                    <option value="Bulgaria" {{ $quote->origin == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                    <option value="Burkina Faso" {{ $quote->origin == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                    <option value="Burundi" {{ $quote->origin == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                    <option value="Cambodia" {{ $quote->origin == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                    <option value="Cameroon" {{ $quote->origin == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                    <option value="Canada" {{ $quote->origin == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    <option value="Cape Verde" {{ $quote->origin == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                                    <option value="Cayman Islands" {{ $quote->origin == 'Cayman Islands' ? 'selected' : '' }}>Cayman Islands</option>
                                    <option value="Central African Republic" {{ $quote->origin == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                    <option value="Chad" {{ $quote->origin == 'Chad' ? 'selected' : '' }}>Chad</option>
                                    <option value="Chile" {{ $quote->origin == 'Chile' ? 'selected' : '' }}>Chile</option>
                                    <option value="China" {{ $quote->origin == 'China' ? 'selected' : '' }}>China</option>
                                    <option value="Christmas Island" {{ $quote->origin == 'Christmas Island' ? 'selected' : '' }}>Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands" {{ $quote->origin == 'Cocos (Keeling) Islands' ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                                    <option value="Colombia" {{ $quote->origin == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                    <option value="Comoros" {{ $quote->origin == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                    <option value="Congo" {{ $quote->origin == 'Congo' ? 'selected' : '' }}>Congo</option>
                                    <option value="Congo, Democratic Republic of the Congo" {{ $quote->origin == 'Congo, Democratic Republic of the Congo' ? 'selected' : '' }}>Congo, Democratic Republic of the Congo</option>
                                    <option value="Cook Islands" {{ $quote->origin == 'Cook Islands' ? 'selected' : '' }}>Cook Islands</option>
                                    <option value="Costa Rica" {{ $quote->origin == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                    <option value="Cote DIvoire" {{ $quote->origin == 'Cote DIvoire' ? 'selected' : '' }}>Cote DIvoire</option>
                                    <option value="Croatia" {{ $quote->origin == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                    <option value="Cuba" {{ $quote->origin == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                    <option value="Curacao" {{ $quote->origin == 'Curacao' ? 'selected' : '' }}>Curacao</option>
                                    <option value="Cyprus" {{ $quote->origin == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                    <option value="Czech Republic" {{ $quote->origin == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                    <option value="Denmark" {{ $quote->origin == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                    <option value="Djibouti" {{ $quote->origin == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                    <option value="Dominica" {{ $quote->origin == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                    <option value="Dominican Republic" {{ $quote->origin == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                    <option value="Ecuador" {{ $quote->origin == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                    <option value="Egypt" {{ $quote->origin == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                    <option value="El Salvador" {{ $quote->origin == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                    <option value="Equatorial Guinea" {{ $quote->origin == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                                    <option value="Eritrea" {{ $quote->origin == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                    <option value="Estonia" {{ $quote->origin == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                    <option value="Ethiopia" {{ $quote->origin == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)" {{ $quote->origin == 'Falkland Islands (Malvinas)' ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                                    <option value="Faroe Islands" {{ $quote->origin == 'Faroe Islands' ? 'selected' : '' }}>Faroe Islands</option>
                                    <option value="Fiji" {{ $quote->origin == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                    <option value="Finland" {{ $quote->origin == 'Finland' ? 'selected' : '' }}>Finland</option>
                                    <option value="France" {{ $quote->origin == 'France' ? 'selected' : '' }}>France</option>
                                    <option value="French Guiana" {{ $quote->origin == 'French Guiana' ? 'selected' : '' }}>French Guiana</option>
                                    <option value="French Polynesia" {{ $quote->origin == 'French Polynesia' ? 'selected' : '' }}>French Polynesia</option>
                                    <option value="French Southern Territories" {{ $quote->origin == 'French Southern Territories' ? 'selected' : '' }}>French Southern Territories</option>
                                    <option value="Gabon" {{ $quote->origin == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                    <option value="Gambia" {{ $quote->origin == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                                    <option value="Georgia" {{ $quote->origin == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                    <option value="Germany" {{ $quote->origin == 'Germany' ? 'selected' : '' }}>Germany</option>
                                    <option value="Ghana" {{ $quote->origin == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                    <option value="Gibraltar" {{ $quote->origin == 'Gibraltar' ? 'selected' : '' }}>Gibraltar</option>
                                    <option value="Greece" {{ $quote->origin == 'Greece' ? 'selected' : '' }}>Greece</option>
                                    <option value="Greenland" {{ $quote->origin == 'Greenland' ? 'selected' : '' }}>Greenland</option>
                                    <option value="Grenada" {{ $quote->origin == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                                    <option value="Guadeloupe" {{ $quote->origin == 'Guadeloupe' ? 'selected' : '' }}>Guadeloupe</option>
                                    <option value="Guam" {{ $quote->origin == 'Guam' ? 'selected' : '' }}>Guam</option>
                                    <option value="Guatemala" {{ $quote->origin == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                    <option value="Guernsey" {{ $quote->origin == 'Guernsey' ? 'selected' : '' }}>Guernsey</option>
                                    <option value="Guinea" {{ $quote->origin == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                                    <option value="Guinea-Bissau" {{ $quote->origin == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                                    <option value="Guyana" {{ $quote->origin == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                    <option value="Haiti" {{ $quote->origin == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands" {{ $quote->origin == 'Heard Island and Mcdonald Islands' ? 'selected' : '' }}>Heard Island and Mcdonald Islands</option>
                                    <option value="Holy See (Vatican City State)" {{ $quote->origin == 'Holy See (Vatican City State)' ? 'selected' : '' }}>Holy See (Vatican City State)</option>
                                    <option value="Honduras" {{ $quote->origin == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                    <option value="Hong Kong" {{ $quote->origin == 'Hong Kong' ? 'selected' : '' }}>Hong Kong</option>
                                    <option value="Hungary" {{ $quote->origin == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                    <option value="Iceland" {{ $quote->origin == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                    <option value="India" {{ $quote->origin == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="Indonesia" {{ $quote->origin == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Iran, Islamic Republic of" {{ $quote->origin == 'Iran, Islamic Republic of' ? 'selected' : '' }}>Iran, Islamic Republic of</option>
                                    <option value="Iraq" {{ $quote->origin == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                    <option value="Ireland" {{ $quote->origin == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                    <option value="Isle of Man" {{ $quote->origin == 'Isle of Man' ? 'selected' : '' }}>Isle of Man</option>
                                    <option value="Israel" {{ $quote->origin == 'Israel' ? 'selected' : '' }}>Israel</option>
                                    <option value="Italy" {{ $quote->origin == 'Italy' ? 'selected' : '' }}>Italy</option>
                                    <option value="Jamaica" {{ $quote->origin == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                    <option value="Japan" {{ $quote->origin == 'Japan' ? 'selected' : '' }}>Japan</option>
                                    <option value="Jersey" {{ $quote->origin == 'Jersey' ? 'selected' : '' }}>Jersey</option>
                                    <option value="Jordan" {{ $quote->origin == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                    <option value="Kazakhstan" {{ $quote->origin == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                    <option value="Kenya" {{ $quote->origin == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                    <option value="Kiribati" {{ $quote->origin == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of" {{ $quote->origin == 'Korea, Democratic People\'s Republic of' ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                                    <option value="Korea, Republic of" {{ $quote->origin == 'Korea, Republic of' ? 'selected' : '' }}>Korea, Republic of</option>
                                    <option value="Kuwait" {{ $quote->origin == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                    <option value="Kyrgyzstan" {{ $quote->origin == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic" {{ $quote->origin == 'Lao People\'s Democratic Republic' ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                                    <option value="Latvia" {{ $quote->origin == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                    <option value="Lebanon" {{ $quote->origin == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                    <option value="Lesotho" {{ $quote->origin == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                    <option value="Liberia" {{ $quote->origin == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                    <option value="Libyan Arab Jamahiriya" {{ $quote->origin == 'Libyan Arab Jamahiriya' ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein" {{ $quote->origin == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                    <option value="Lithuania" {{ $quote->origin == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                    <option value="Luxembourg" {{ $quote->origin == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                    <option value="Macao" {{ $quote->origin == 'Macao' ? 'selected' : '' }}>Macao</option>
                                    <option value="Macedonia, the Former Yugoslav Republic of" {{ $quote->origin == 'Macedonia, the Former Yugoslav Republic of' ? 'selected' : '' }}>Macedonia, the Former Yugoslav Republic of</option>
                                    <option value="Madagascar" {{ $quote->origin == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                    <option value="Malawi" {{ $quote->origin == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                    <option value="Malaysia" {{ $quote->origin == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                    <option value="Maldives" {{ $quote->origin == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                    <option value="Mali" {{ $quote->origin == 'Mali' ? 'selected' : '' }}>Mali</option>
                                    <option value="Malta" {{ $quote->origin == 'Malta' ? 'selected' : '' }}>Malta</option>
                                    <option value="Marshall Islands" {{ $quote->origin == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                                    <option value="Martinique" {{ $quote->origin == 'Martinique' ? 'selected' : '' }}>Martinique</option>
                                    <option value="Mauritania" {{ $quote->origin == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                    <option value="Mauritius" {{ $quote->origin == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                    <option value="Mayotte" {{ $quote->origin == 'Mayotte' ? 'selected' : '' }}>Mayotte</option>
                                    <option value="Mexico" {{ $quote->origin == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                    <option value="Micronesia, Federated States of" {{ $quote->origin == 'Micronesia, Federated States of' ? 'selected' : '' }}>Micronesia, Federated States of</option>
                                    <option value="Moldova, Republic of" {{ $quote->origin == 'Moldova, Republic of' ? 'selected' : '' }}>Moldova, Republic of</option>
                                    <option value="Monaco" {{ $quote->origin == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                    <option value="Mongolia" {{ $quote->origin == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                    <option value="Montenegro" {{ $quote->origin == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                                    <option value="Montserrat" {{ $quote->origin == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                                    <option value="Morocco" {{ $quote->origin == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                    <option value="Mozambique" {{ $quote->origin == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                    <option value="Myanmar" {{ $quote->origin == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                    <option value="Namibia" {{ $quote->origin == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                    <option value="Nauru" {{ $quote->origin == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                    <option value="Nepal" {{ $quote->origin == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                    <option value="Netherlands" {{ $quote->origin == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                    <option value="New Caledonia" {{ $quote->origin == 'New Caledonia' ? 'selected' : '' }}>New Caledonia</option>
                                    <option value="New Zealand" {{ $quote->origin == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                    <option value="Nicaragua" {{ $quote->origin == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                    <option value="Niger" {{ $quote->origin == 'Niger' ? 'selected' : '' }}>Niger</option>
                                    <option value="Nigeria" {{ $quote->origin == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                    <option value="Niue" {{ $quote->origin == 'Niue' ? 'selected' : '' }}>Niue</option>
                                    <option value="Norfolk Island" {{ $quote->origin == 'Norfolk Island' ? 'selected' : '' }}>Norfolk Island</option>
                                    <option value="Northern Mariana Islands" {{ $quote->origin == 'Northern Mariana Islands' ? 'selected' : '' }}>Northern Mariana Islands</option>
                                    <option value="Norway" {{ $quote->origin == 'Norway' ? 'selected' : '' }}>Norway</option>
                                    <option value="Oman" {{ $quote->origin == 'Oman' ? 'selected' : '' }}>Oman</option>
                                    <option value="Pakistan" {{ $quote->origin == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    <option value="Palau" {{ $quote->origin == 'Palau' ? 'selected' : '' }}>Palau</option>
                                    <option value="Palestinian Territory, Occupied" {{ $quote->origin == 'Palestinian Territory, Occupied' ? 'selected' : '' }}>Palestinian Territory, Occupied</option>
                                    <option value="Panama" {{ $quote->origin == 'Panama' ? 'selected' : '' }}>Panama</option>
                                    <option value="Papua New Guinea" {{ $quote->origin == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                                    <option value="Paraguay" {{ $quote->origin == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                    <option value="Peru" {{ $quote->origin == 'Peru' ? 'selected' : '' }}>Peru</option>
                                    <option value="Philippines" {{ $quote->origin == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                    <option value="Pitcairn" {{ $quote->origin == 'Pitcairn' ? 'selected' : '' }}>Pitcairn</option>
                                    <option value="Poland" {{ $quote->origin == 'Poland' ? 'selected' : '' }}>Poland</option>
                                    <option value="Portugal" {{ $quote->origin == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                    <option value="Puerto Rico" {{ $quote->origin == 'Puerto Rico' ? 'selected' : '' }}>Puerto Rico</option>
                                    <option value="Qatar" {{ $quote->origin == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                    <option value="Reunion" {{ $quote->origin == 'Reunion' ? 'selected' : '' }}>Reunion</option>
                                    <option value="Romania" {{ $quote->origin == 'Romania' ? 'selected' : '' }}>Romania</option>
                                    <option value="Russian Federation" {{ $quote->origin == 'Russian Federation' ? 'selected' : '' }}>Russian Federation</option>
                                    <option value="Rwanda" {{ $quote->origin == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                    <option value="Saint Barthelemy" {{ $quote->origin == 'Saint Barthelemy' ? 'selected' : '' }}>Saint Barthelemy</option>
                                    <option value="Saint Helena" {{ $quote->origin == 'Saint Helena' ? 'selected' : '' }}>Saint Helena</option>
                                    <option value="Saint Kitts and Nevis" {{ $quote->origin == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia" {{ $quote->origin == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                    <option value="Saint Martin (French part)" {{ $quote->origin == 'Saint Martin (French part)' ? 'selected' : '' }}>Saint Martin (French part)</option>
                                    <option value="Saint Pierre and Miquelon" {{ $quote->origin == 'Saint Pierre and Miquelon' ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and the Grenadines" {{ $quote->origin == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                    <option value="Samoa" {{ $quote->origin == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                    <option value="San Marino" {{ $quote->origin == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                    <option value="Sao Tome and Principe" {{ $quote->origin == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                    <option value="Saudi Arabia" {{ $quote->origin == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                    <option value="Senegal" {{ $quote->origin == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                    <option value="Serbia" {{ $quote->origin == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                    <option value="Seychelles" {{ $quote->origin == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                    <option value="Sierra Leone" {{ $quote->origin == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                    <option value="Singapore" {{ $quote->origin == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                    <option value="Sint Maarten (Dutch part)" {{ $quote->origin == 'Sint Maarten (Dutch part)' ? 'selected' : '' }}>Sint Maarten (Dutch part)</option>
                                    <option value="Slovakia" {{ $quote->origin == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                    <option value="Slovenia" {{ $quote->origin == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                    <option value="Solomon Islands" {{ $quote->origin == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                                    <option value="Somalia" {{ $quote->origin == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                    <option value="South Africa" {{ $quote->origin == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                    <option value="South Georgia and the South Sandwich Islands" {{ $quote->origin == 'South Georgia and the South Sandwich Islands' ? 'selected' : '' }}>South Georgia and the South Sandwich Islands</option>
                                    <option value="South Sudan" {{ $quote->origin == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                                    <option value="Spain" {{ $quote->origin == 'Spain' ? 'selected' : '' }}>Spain</option>
                                    <option value="Sri Lanka" {{ $quote->origin == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                    <option value="Sudan" {{ $quote->origin == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                    <option value="Suriname" {{ $quote->origin == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                                    <option value="Svalbard and Jan Mayen" {{ $quote->origin == 'Svalbard and Jan Mayen' ? 'selected' : '' }}>Svalbard and Jan Mayen</option>
                                    <option value="Swaziland" {{ $quote->origin == 'Swaziland' ? 'selected' : '' }}>Swaziland</option>
                                    <option value="Sweden" {{ $quote->origin == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                    <option value="Switzerland" {{ $quote->origin == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                    <option value="Syrian Arab Republic" {{ $quote->origin == 'Syrian Arab Republic' ? 'selected' : '' }}>Syrian Arab Republic</option>
                                    <option value="Taiwan" {{ $quote->origin == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                                    <option value="Tajikistan" {{ $quote->origin == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                    <option value="Tanzania, United Republic of" {{ $quote->origin == 'Tanzania, United Republic of' ? 'selected' : '' }}>Tanzania, United Republic of</option>
                                    <option value="Thailand" {{ $quote->origin == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                    <option value="Timor-Leste" {{ $quote->origin == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                                    <option value="Togo" {{ $quote->origin == 'Togo' ? 'selected' : '' }}>Togo</option>
                                    <option value="Tokelau" {{ $quote->origin == 'Tokelau' ? 'selected' : '' }}>Tokelau</option>
                                    <option value="Tonga" {{ $quote->origin == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                    <option value="Trinidad and Tobago" {{ $quote->origin == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                    <option value="Tunisia" {{ $quote->origin == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                    <option value="Turkey" {{ $quote->origin == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                    <option value="Turkmenistan" {{ $quote->origin == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                    <option value="Turks and Caicos Islands" {{ $quote->origin == 'Turks and Caicos Islands' ? 'selected' : '' }}>Turks and Caicos Islands</option>
                                    <option value="Tuvalu" {{ $quote->origin == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                    <option value="Uganda" {{ $quote->origin == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                    <option value="Ukraine" {{ $quote->origin == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                    <option value="United Arab Emirates" {{ $quote->origin == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                    <option value="United Kingdom" {{ $quote->origin == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="United States" {{ $quote->origin == 'United States' ? 'selected' : '' }}>United States</option>
                                    <option value="Uruguay" {{ $quote->origin == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                    <option value="Uzbekistan" {{ $quote->origin == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                    <option value="Vanuatu" {{ $quote->origin == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                    <option value="Venezuela" {{ $quote->origin == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                    <option value="Viet Nam" {{ $quote->origin == 'Viet Nam' ? 'selected' : '' }}>Viet Nam</option>
                                    <option value="Virgin Islands, British" {{ $quote->origin == 'Virgin Islands, British' ? 'selected' : '' }}>Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S." {{ $quote->origin == 'Virgin Islands, U.S.' ? 'selected' : '' }}>Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna" {{ $quote->origin == 'Wallis and Futuna' ? 'selected' : '' }}>Wallis and Futuna</option>
                                    <option value="Western Sahara" {{ $quote->origin == 'Western Sahara' ? 'selected' : '' }}>Western Sahara</option>
                                    <option value="Yemen" {{ $quote->origin == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                    <option value="Zambia" {{ $quote->origin == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                    <option value="Zimbabwe" {{ $quote->origin == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                </select>
                                
                                        <label for="origin">
                                                Origin</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-user"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="date" name="date"
                                                value="{{ $quote->date }}" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Date From" aria-label="Enter Date From"
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
                                                value="{{ $quote->valid_till }}" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Date To"
                                                aria-label="Enter Date To"
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
                                                value="{{ $quote->pax }}"
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
                                                value="{{ $quote->meal_plan }}" id="basic-icon-default-email"
                                                class="form-control" placeholder="Enter Meal Plan"
                                                aria-label="Enter Meal Plan"
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
                                    @foreach ($quote->quote_detail as $index => $item)
                                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                            <div class="d-flex rounded position-relative pe-0">
                                                <div class="row w-100 p-2">
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 ">Product Categories</p>
                                                        <select class="product-category-dropdown form-select" required
                                                            name="product_category_id" type="text">
                                                            <option value="">Select</option>
                                                            @foreach ($product_categories as $category)
                                                                <option
                                                                    {{ $item->product_category_id == $category->id ? 'selected' : '' }}
                                                                    value="{{ $category->id }}">{{ $category->name }}
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
                                                                <option
                                                                    {{ $item->product_id == $product->id ? 'selected' : '' }}
                                                                    value="{{ $product->id }}">{{ $product->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Rate</p>
                                                        <input type="text" class="form-control charges" name="charges"
                                                            required id="charges" placeholder="Enter Charges"
                                                            value="{{ $item->charges }}" />
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Persons / Rooms</p>
                                                        <input type="text" min="1" max="99999"
                                                            value="{{ $item->persons_rooms }}"
                                                            class="form-control invoice-item-qty persons_rooms"
                                                            name="persons_rooms" id="persons_rooms"
                                                            placeholder="Persons / Rooms" />
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Days / Dives</p>
                                                        <input type="text" min="1" max="99999"
                                                            value="{{ $item->days_dives }}"
                                                            class="form-control invoice-item-qty quantity"
                                                            name="days_dives" id="quantity"
                                                            placeholder="Days / Dives" />
                                                    </div>


                                                    <div class="col-md-1 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Amount</p>
                                                        <input type="text" class="form-control amount" name="amount"
                                                            required placeholder="Enter Amount"
                                                            value="{{ $item->amount }}" />
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Converted Amount</p>
                                                        <input type="text" class="form-control converted-amount"
                                                            name="converted_amount" readonly
                                                            value="{{ $item->converted_amount }}"
                                                            placeholder="Converted Amount" />
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                                    <i class="mdi mdi-close cursor-pointer" data-repeater-delete></i>
                                                    <div class="dropdown">
                                                        <i class="mdi mdi-cog-outline cursor-pointer more-options-dropdown"
                                                            role="button" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                            aria-expanded="false">
                                                        </i>
                                                        <div class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <div class="row g-3">
                                                                <div class="col-md-12 mb-md-0 mb-3">
                                                                    <p class="mb-2 repeater-title">Discount</p>
                                                                    <input type="text" id="discount" name="discount"
                                                                        class="form-control discount invoice-item-qty"
                                                                        placeholder="%" value="{{ $item->discount }}" />
                                                                </div>
                                                                <div class="col-md-12  mb-md-0 mb-3">
                                                                    <p class="mb-2 repeater-title">Tax</p>
                                                                    <input type="text" id="tax" name="tax"
                                                                        class="form-control tax invoice-item-qty"
                                                                        placeholder="%" value="{{ $item->tax }}" />
                                                                </div>
                                                            </div>
                                                            <div class="dropdown-divider my-3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                            <span class="w-px-200">Payment :</span>
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
                                            <input type="hidden" class="due_amount" name="due_amount"
                                                value="{{ $totalAmountRemaining }}">
                                            <span class="fw-semibold" id="due_amount">{{ $quote->currency->name }}
                                                {{ number_format($totalAmountRemaining, 2, '.', '') ?? '0.00' }}
                                            </span>
                                        </div> --}}
                                        {{-- <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Advance:</span>
                                            <input type="hidden" class="advance_amount" name="advance_amount">
                                            <span class="fw-semibold" id="advance_amount">Rs. 00.00</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-md-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Sub Total:</span>
                                            <input type="hidden" class="sub_total" name="sub_total"
                                                value="{{ $quote->sub_total }}">
                                            <span class="fw-semibold sub_total"
                                                id="sub_total">{{ $quote->currency->name }}
                                                {{ $quote->sub_total }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Discount :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_discount_percentage"
                                                    class="form-control w-px-100 me-2" id="total_discount_percentage"
                                                    placeholder="%" value="{{ $quote->total_discount_percentage }}" />
                                                <input type="text" name="total_discount_amount"
                                                    class="form-control w-px-100" id="total_discount_amount"
                                                    placeholder="$" value="{{ $quote->total_discount_amount }}" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Service Charge :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_service_charge"
                                                    class="form-control w-px-100 me-2" id="total_service_charge"
                                                    value="{{ $quote->total_service_charge }}" placeholder="%" />
                                                <input type="text" name="total_service_charge_amount"
                                                    class="form-control w-px-100"
                                                    value="{{ $quote->total_service_charge_amount }}"
                                                    id="total_service_charge_amount" placeholder="$" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Tax :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_tax_percentage"
                                                    placeholder="%" value="{{ $quote->total_tax_percentage }}" />
                                                <input type="text" name="total_tax_amount"
                                                    class="form-control w-px-100" id="total_tax_amount" placeholder="$"
                                                    value="{{ $quote->total_tax_amount }}" />
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Green Tax :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_green_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_green_tax_percentage"
                                                    placeholder="%" value="{{ $quote->total_green_tax_percentage }}" />
                                                <input type="text" name="total_green_tax_amount"
                                                    class="form-control w-px-100" id="total_green_tax_amount"
                                                    placeholder="$" value="{{ $quote->total_green_tax_amount }}" />
                                            </span>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Total:</span>
                                            <input type="hidden" class="total_amount" name="total_amount"
                                                value=" {{ $quote->total_amount }}">
                                            <span class="fw-semibold" id="total_amount">$
                                                {{ $quote->total_amount }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-300">Total Converted Amount:</span>
                                            <input type="hidden" class="total_amount_converted"
                                                value="{{ $quote->total_converted_amount }}"
                                                name="total_amount_converted">
                                            <span class="fw-semibold" id="total_amount_converted">
                                                {{ $quote->currency->name }}
                                                {{ $quote->total_converted_amount }}</span>
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
        $(document).on("change", ".product-dropdown, .charges, .quantity, .discount, .tax",
            calculateTotalAmount);
        $(document).on("input", ".charges, .discount, .tax, .quantity",
            calculateTotalAmount);

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
                var quantity = parseFloat(repeaterWrapper.find(".quantity").val()) || 0;
                var discountPercentage = parseFloat(repeaterWrapper.find(".discount").val()) || 0;
                var taxPercentage = parseFloat(repeaterWrapper.find(".tax").val()) || 0;
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;
                var totalProcedureAmount = quantity * charges - discountAmount + taxAmount;
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
                    parseInt($('.sub_total').val()); // Replace 1000 with your desired base amount
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
                var discountPercentage = (discountAmount / parseInt($('.sub_total').val())) * 100;
                $("#total_discount_percentage").val(discountPercentage.toFixed(0));
            } else {
                $("#total_discount_percentage").val("");
            }
        });

        function calculateServiceCharges() {
            var taxPercentage = parseFloat($('#total_service_charge').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('.sub_total').val());
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
                var taxPercentage = (taxAmount / parseInt($('.sub_total').val())) * 100;
                $("#total_service_charge").val(taxPercentage.toFixed(0));
            } else {
                $("#total_service_charge").val("");
            }
            updateFinalAmount();
        });

        function calculateTax() {
            var taxPercentage = parseFloat($('#total_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('.sub_total').val());
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
                var taxPercentage = (taxAmount / parseInt($('.sub_total').val())) * 100;
                $("#total_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function calculateGreenTax() {
            var taxPercentage = parseFloat($('#total_green_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('.sub_total').val());
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
                var taxPercentage = (taxAmount / parseInt($('.sub_total').val())) * 100;
                $("#total_green_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_green_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function updateFinalAmount() {
            var shareAmount = parseFloat($(".sub_total").val());
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
            var dueAmount = Math.max(totalAmount - paymentAmount - paidAmount, 0);
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
