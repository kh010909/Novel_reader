<div class="modal  modal-xl fade" id="about-form" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="about-form-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="about-form-label">Edit about</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./profile_edit/about_edit/about_form_handle.php" method="POST">
                <div class="modal-body">
                    <div class="container px-5">
                        <textarea id="about-article" name="about-article"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save-about" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>