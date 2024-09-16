<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" id="myForm" class="modal-content" action="{{ url('/expense-categories/add') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Expense Categories</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                class="mdi mdi-account-outline"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" required class="form-control name-validate" id="basic-icon-default-fullname"
                                placeholder="Enter Name" name="name"
                                aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                            <label for="basic-icon-default-fullname"> Name</label>
                        </div>
                    </div>
                    <span class="text-danger validation-name" style="display: none;">
                        <i class="mdi mdi-alert"></i> Name is invalid
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


