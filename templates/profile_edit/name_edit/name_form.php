<div class="modal fade" id="name-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="name-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="name-form-label">Update your name</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./profile_edit/name_edit/name_form_handle.php" method="POST">
                <div class="modal-body p-5">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                        <div class="form-floating w-100">
                            <input type="text" class="form-control shadow-none" name="name-input" id="name-input"
                                placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping"
                                autocomplete="off">
                            <label class="text-muted" for="name-input">Name</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save-name" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>