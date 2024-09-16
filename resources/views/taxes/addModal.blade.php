<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" class="modal-content" action="{{ url('/tax/add') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Taxes</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                class="mdi mdi-format-align-left"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                placeholder="Enter description" name="description" aria-label="Enter description"
                                aria-describedby="basic-icon-default-fullname2" />
                            <label for="basic-icon-default-fullname"> Description</label>
                        </div>
                    </div>
                    <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                class="mdi mdi-percent-outline"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input required name="tax" type="decimal" id="basic-icon-default-phone"
                                class="form-control phone-mask" placeholder="Enter Tax" aria-label="Enter tax."
                                aria-describedby="basic-icon-default-phone2" />
                            <label for="basic-icon-default-phone">Tax</label>
                        </div>
                    </div>
                    {{-- <div class="form-floating form-floating-outline my-3">
                        <select id="type" name="type" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="percentage" @if (old('type') === 'percentage') selected @endif>Percentage</option>
                        </select>
                        <label for="type">Type</label>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
