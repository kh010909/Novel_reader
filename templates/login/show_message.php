<?php
if (isset($_SESSION["show_message"])) { ?>
<div class="modal fade" id="modal-show-message" aria-hidden="true" aria-labelledby="modal-show-message-label"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modal-show-message-label">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?=$_SESSION["show_message"]?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
unset($_SESSION['show_message']);
}?>