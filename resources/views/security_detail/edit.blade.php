@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ url('/security-detail/edit/' . $security_detail->id) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2">
                    <a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard</a>
                    <a href="{{ url('/client-profile/' . $security_detail->client_id) }}" class="text-muted fw-light">/
                        Security Detail</a>
                    <span class="color">/</span>
                    <span class="text-heading fw-bold text-color"> Edit</span>
                </h4>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save & Close</button>
                </div>
            </div>
            <div class="row invoice-add">
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body pb-0">
                            <h4 class="my-3">Edit Security Detail</h4>
                            <div class="row mx-0">
                                <!-- Form fields for shipment details -->
                                <div class="col-md-4 mb-3">
                                    <p class="mb-2">Client Name</p>
                                    <select id="client_id" required name="client_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($clients as $client)
                                            <option {{ $security_detail->client_id == $client->id ? 'selected' : '' }}
                                                value="{{ $client->id }}">
                                                {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Type</p>
                                    <select id="type_id" name="type_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($types as $type)
                                            <option {{ $security_detail->type_id == $type->id ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Date</p>
                                    <input type="date" class="form-control" name="date" placeholder="Date"
                                        value="{{ @$security_detail->date }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Token</p>
                                    <input type="text" class="form-control" name="token" placeholder="Token"
                                        value="{{ @$security_detail->token }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Amount</p>
                                    <input type="number" class="form-control" name="amount" id="amount"
                                        placeholder="Amount" value="{{ @$security_detail->amount }}">
                                </div>
                                {{-- <div class="col-md-3 mb-3">
                                    <p class="mb-2">Paid to</p>
                                    <select id="paid_to" name="paid_to" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($clients as $client)
                                            <option  {{ $security_detail->paid_to == $client->id ? 'selected' : '' }} value="{{ $client->id }}">
                                                {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control" name="description" rows="5" id="description">{{ @$security_detail->description }}</textarea>
                                        <label for="description">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('/assets/js/offcanvas-send-invoice.js') }}"></script>
<script src="{{ url('/assets/js/app-invoice-add.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#currency_id").on("change", function() {
            updateBuySell(this.value);
        });

        function updateBuySell(selectedCurrencyId) {
            // var selectedCurrencyId = this.value;
            var buyInput = document.getElementById('buy');
            var sellInput = document.getElementById('sell');
            console.log('selectedCurrencyId', selectedCurrencyId);

            if (selectedCurrencyId == '5') {
                // Set buy to 0, sell to 1, and make both fields readonly
                buyInput.value = 0;
                sellInput.value = 1;
                buyInput.setAttribute('readonly', true);
                sellInput.setAttribute('readonly', true);
                updateConvertedAmount();
            } else {
                // If a different currency is selected, remove readonly attribute
                buyInput.removeAttribute('readonly');
                sellInput.removeAttribute('readonly');
            }
        }

        function updateConvertedAmount() {
            const sellInput = document.getElementById('sell');
            const rtgsAmountInput = document.getElementById('amount');
            const convertedAmountInput = document.querySelector('.converted-amount');
            const rtgsAmount = parseFloat(rtgsAmountInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 1;
            console.log('sell', sell)
            const convertedAmount = rtgsAmount * sell;
            convertedAmountInput.value = convertedAmount.toFixed(2);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sellInput = document.getElementById('sell');
        const rtgsAmountInput = document.getElementById('amount');
        const currencySelect = document.getElementById('currency_id');
        const convertedAmountInput = document.querySelector('.converted-amount');

        function updateConvertedAmount() {
            const rtgsAmount = parseFloat(rtgsAmountInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 1;
            const convertedAmount = rtgsAmount * sell;
            convertedAmountInput.value = convertedAmount.toFixed(2);
        }

        function handleRateQuantityChange() {
            updateConvertedAmount();
        }

        function handleSellChange() {
            updateConvertedAmount();
        }

        function handleCurrencyChange() {
            updateConvertedAmount();
        }

        // Event listeners
        sellInput.addEventListener('input', handleSellChange);
        rtgsAmountInput.addEventListener('input', handleSellChange);
        currencySelect.addEventListener('change', handleCurrencyChange);

        updateConvertedAmount();

        $('input[name="amount"]').on('input', function() {
            updateConvertedAmount();
        });

    });
</script>
