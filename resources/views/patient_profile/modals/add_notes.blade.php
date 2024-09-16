<div class="modal fade" id="NotesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="noteForm" action="{{ url('/add-notes' . '/' . $customer->id) }}"
                enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Add Notes</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline my-2">
                                <textarea class="form-control" name="description" rows="5" id="noteDescription"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="mdi mdi-image-outline"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <div class="custom-file-upload">
                                        <label for="note-images" class="custom-file-label">Choose files</label>
                                        <input type="file" name="images[]" class="note-images" id="note-images"
                                            accept=".png, .jpeg, .jpg, .pdf, .svg" multiple />
                                    </div>
                                </div>
                            </div>
                            <label id="note_files" class="mt-2" style="display: none" for="note_files">Current
                                Files:</label>
                            <div class="image-preview-box" id="note-image-preview-box"></div>
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

<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('noteForm').addEventListener('submit', function(event) {
        const description = document.getElementById('noteDescription').value;
        const images = document.getElementById('note-images').files;

        // Check if both description and images are empty
        if (!description.trim() && images.length === 0) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                title: 'Please Fill At Least One Field.'
            });
        }
    });
</script>


<script>
    // Create an array to store selected files
    let selectedFiles = [];

    function updateImagePreviews(input) {
        const imagePreviewBox = document.getElementById('note-image-preview-box');
        imagePreviewBox.innerHTML = '';

        const files = Array.from(input.files);

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = (function(index) {
                return function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'image-preview';

                    // const image = document.createElement('img');
                    // image.className = 'note-image';
                    // image.src = e.target.result;
                    // image.alt = 'Image Preview';
                    // Use a dynamic ID based on the index
                    imageDiv.id = 'image-preview-' + index;

                    if (file.type.startsWith('image/')) {
                        // For images
                        const image = document.createElement('img');
                        image.className = 'note-image';
                        image.src = e.target.result;
                        image.alt = 'Image Preview';
                        imageDiv.appendChild(image);
                    } else if (file.type === 'application/pdf') {
                        // For PDFs
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.width = '100%';
                        embed.height = '300px';
                        imageDiv.appendChild(embed);
                    } else {
                        // For other file types (you can customize this part)
                        const message = document.createElement('p');
                        message.textContent = 'Unsupported file type';
                        imageDiv.appendChild(message);
                    }
                    const removeButton = document.createElement('button');
                    removeButton.className = 'remove-button-multiple';
                    removeButton.type = 'button';
                    removeButton.textContent = 'x';

                    removeButton.addEventListener('click', function() {
                        // Remove the corresponding file from the array
                        selectedFiles.splice(index, 1);
                        // Update the hidden input with the updated file names
                        // Update the image preview box
                        imagePreviewBox.removeChild(imageDiv);
                    });

                    // imageDiv.appendChild(image);
                    imageDiv.appendChild(removeButton);
                    imageDiv.style.height = '145px';
                    imagePreviewBox.appendChild(imageDiv);
                    imagePreviewBox.style.display = 'flex';
                    document.getElementById('note_files').style.display = "block";

                    // Add the file to the selectedFiles array
                    selectedFiles.push(file.name);
                    // Update the hidden input with the current file names
                    updateHiddenInput();
                };
            })(i);

            reader.readAsDataURL(file);
        }
    }

    function updateHiddenInput() {
        const hiddenInput = document.getElementById('note_files');
        hiddenInput.value = selectedlabReportFiles.join(', ');
    }

    const noteImages = document.getElementById('note-images');
    noteImages.addEventListener('change', function() {
        updateImagePreviews(this);
    });
</script>
