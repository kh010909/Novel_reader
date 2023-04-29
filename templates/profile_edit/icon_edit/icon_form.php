<div class="modal fade" id="icon-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="icon-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="icon-form-label">Upload icon image</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./profile_edit/icon_edit/icon_form_handle.php" method="POST">
                <div class="modal-body">
                    <div class="container px-5">
                        <!-- Select image area-->
                        <h2 class="py-4 fs-3">Select Profile Image</h2>
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input type="file" name="upload-icon" id="upload-icon" class="form-control border-0"
                                accept=".png, .jpg, .jpeg, .icon, .svg">
                            <label id="upload-label" for="upload-icon" class="font-weight-light text-muted">
                                Select a image
                            </label>
                            <label for="upload-icon" class="btn btn-light m-0 rounded-pill px-4">
                                <i class="bi bi-upload mr-2 text-muted"></i>
                                <small class="text-uppercase font-weight-bold text-muted">
                                    Open up
                                </small>
                            </label>
                        </div>

                        <!-- Uploaded image area-->
                        <p class="font-italic text-secondary text-center">
                            The image uploaded will be rendered inside the box
                            below.
                        </p>
                        <div class="image-area mt-4 text-center text-muted">
                            <div id="uploaded-icon">
                                <p>There nothing here currently</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="cancel-save" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save-image" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>