<?php

if (isset($_SESSION["article"])) {
    foreach ($_SESSION["article"] as $key => $value) { ?>

        <div class="modal fade edit-article-form" id="edit-article-<?= $value["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="name-form-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="name-form-label">Edit Post</h1>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./post_edit/article_edit/edit_article_form_handle.php" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="article-id" value="<?= $value["id"] ?>" />
                        <div class="modal-body p-5 container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <!-- Select image area-->
                                    <h2 class="py-4 fs-3">Select Article Image</h2>
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input type="file" onchange="readEditURL(this);" name="upload-article-picture-edit" id="upload-article-picture-edit-<?= $value["id"] ?>" class="form-control border-0 upload-article-picture-edit" accept=".png, .jpg, .jpeg, .icon, .svg">
                                        <label id="upload-label" for="upload-article-picture-edit-<?= $value["id"] ?>" class="font-weight-light text-muted">
                                            Select a image
                                        </label>
                                        <label for="upload-article-picture-edit-<?= $value["id"] ?>" class="btn btn-light m-0 rounded-pill px-4">
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
                                    <div class="image-area p-5 mt-4 text-center text-muted mb-5">
                                        <img class="uploaded-article-edit" src="../static/images/blog_post/article/<?= $value["picture"] ?>" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" value="">
                                        <!-- <button class="delete-img">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button> -->

                                    </div>
                                    <!--Add Title-->
                                    <div class="mb-3 ">
                                        <label for="article-title" class="form-label">Title</label>
                                        <input class="form-control" type="text" name="article-title" value="<?= $value["title"] ?>" /> <br />
                                    </div>
                                    <!--Add Text-->
                                    <div class="mb-3 ">
                                        <label for="article-text" class="form-label">Text</label>
                                        <textarea class="form-control" name="edit-article" rows="3"></textarea>
                                    </div>
                                    <!-- Make sure Display -->
                                    <div class="mt-5 mb-3">
                                        <label class="form-label">Display</label>
                                        <div class="form-check my-2 d-flex align-items-center">
                                            <input class="form-check-input mt-0" type="radio" name="article-display-edit" value="normal" checked>
                                            <label class="form-check-label ps-2" for="inlineRadio1">Normal</label>
                                        </div>
                                        <div class="form-check my-2 d-flex align-items-center">
                                            <input class="form-check-input mt-0" type="radio" name="article-display-edit" value="card">
                                            <label class="form-check-label ps-2" for="inlineRadio2">Card</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save-edit-article" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>