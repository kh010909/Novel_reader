<?php
if (isset($_SESSION["post"])) {
?>
    <div class="modal fade" id="modal-post-delete" aria-hidden="true" aria-labelledby="modal-post-delete-label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0" id="modal-post-delete-label">
                        <strong>Are you sure to delete the post ? <br />(containing all articles in the post)</strong>
                    </h5>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <form action="./post_edit/post_edit/post_modify.php" method="POST" class="col-6 m-0 rounded-0 border-end text-center">
                        <input type="hidden" name="post_id" value="<?= $_SESSION["post"]["id"] ?>">
                        <input type="hidden" name="post_pic" value="<?= $_SESSION["post"]["picture"] ?>">
                        <button id="btn-post-delete-confirm" type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none text-danger">
                            Yes, I'm sure
                        </button>
                    </form>

                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">
                        No thanks
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <script>
        console.log("no");
    </script>
<?php
}
?>