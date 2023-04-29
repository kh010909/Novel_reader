<div class="modal fade" id="add-post-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="name-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="name-form-label">Add Post</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./post_edit/add_post_form/add_post_form_handle.php" enctype="multipart/form-data" method="POST">
                <div class="modal-body p-5 container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <!-- Select image area-->
                            <h2 class="py-4 fs-3">Select Post Image</h2>
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                <input type="file" name="upload-post-picture" id="upload-post-picture" class="form-control border-0" accept=".png, .jpg, .jpeg, .icon, .svg" required="required">
                                <label id="upload-label" for="upload-post-picture" class="font-weight-light text-muted">
                                    Select a image
                                </label>
                                <label for="upload-post-picture" class="btn btn-light m-0 rounded-pill px-4">
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
                            <div class="image-area mt-4 text-center text-muted mb-5">
                                <div id="uploaded-picture" class="text-center">
                                    <p>There nothing here currently</p>
                                </div>
                            </div>
                            <!--Add Title-->
                            <div class="mb-3 ">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input class="form-control" type="text" name="title" required="required" maxlength="20" /> <br />
                            </div>
                            <!--Add Subtitle-->
                            <div class="mb-3 ">
                                <label for="exampleFormControlInput1" class="form-label">Subtitle</label>
                                <input class="form-control" type="text" name="description" required="required" maxlength="40" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="cancel-save" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save-add-post" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>