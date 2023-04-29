<?php
//include("./core/config.php");
// session_start();
$return_msg = "";
if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}
if (isset($_SESSION["user"])) {
    $name = $sql_link->quote($_SESSION["user"]["name"]);

    $sql = "SELECT * FROM `user` WHERE `name` = $name";
    $result = $sql_link->query($sql);

    if ($result) {
        $num = $result->rowCount();
        if ($num == 0) {
            $return_msg = "Can not find membership for this user";
        } else {
            $row = $result->fetch();

            $_SESSION["profile"] = [
                "uId" => $row["uId"],
                "name" => $row["name"],
                "email" => $row["email"],
                "permission" => $row["permission"],
                "create_at" => $row["create_at"]
            ];
        }
    } else {
        $return_msg = "Fail to deal with this cast";
    }
}
if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}

?>
<div class="modal fade" id="modal-profile" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="modal-profile-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2" id="modal-profile-label">Profile</h1>
                <button @click="isEdit=!isEdit" class="btn btn-sm rounded-3 btn-secondary ms-3 mt-3 border-bottom-0">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div v-show="!isEdit" class="modal-body p-5 pt-0"> <!-- read -->
                <label for="profile-name" class="form-label fs-5">User Name</label>
                <div class="input-group mb-4">
                    <span class="me-2">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <h3><?= $_SESSION["profile"]["name"] ?></h3>
                </div>

                <label for="profile-email" class="form-label fs-5">Email</label>
                <div class="input-group mb-4">
                    <span class="me-2">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <h3><?= $_SESSION["profile"]["email"] ?></h3>
                </div>

                <label for="profile-permission" class="form-label fs-5">Rank</label>
                <div class="input-group mb-4">
                    <span class="me-2">
                        <i class="bi bi-person-vcard-fill"></i>
                    </span>
                    <h3><?= $_SESSION["profile"]["permission"] ?></h3>
                </div>

                <label for="profile-email" class="form-label fs-5">Create At</label>
                <div class="input-group mb-4">
                    <span class="me-2">
                        <i class="bi bi-calendar-plus-fill"></i>
                    </span>
                    <h3><?= $_SESSION["profile"]["create_at"] ?></h3>
                </div>
            </div>
            <div v-show="isEdit" class="container modal-body p-5 pt-0"> <!-- edit -->
                <form action="./profile/profile_form_handle.php" method="POST">

                    <label for="edit-profile-name" class="form-label fs-5">User Name</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control shadow-none" id="edit-profile-name" placeholder="<?= $_SESSION["profile"]["name"] ?>" value="<?= $_SESSION["profile"]["name"] ?>" required>
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>


                    <label for="edit-profile-email" class="form-label fs-5">Email Address</label>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control shadow-none" id="edit-profile-email" placeholder="<?= $_SESSION["profile"]["email"] ?>" value="<?= $_SESSION["profile"]["email"] ?>" required>
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>

                    <div class="row mb-3">
                        <label for="edit-profile-password" class="form-label fs-5">Password
                            <button @click.prevent="passwordEdit=!passwordEdit" class="btn btn-sm rounded-3 btn-secondary border-bottom-0 ms-2">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </label>

                        <div v-show="passwordEdit"><!--v-show="passwordEdit"-->
                            <div class="input-group mb-3">
                                <input type="password" class="form-control shadow-none" id="password" name="password">
                                <span class="input-group-text">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                            </div>
                            <label for="inputPassword" class="col-lg-4 col-form-label fs-5">New
                                Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="check-password form-control shadow-none" id="password-new" name="password-new" minlength="8" autocomplete="off">
                                <span class="input-group-text rounded-end">
                                    <i class="bi bi-eye-slash toggle-password" id="toggle-password">
                                    </i>
                                </span>
                                <div class="invalid-feedback">
                                    <ul>
                                        <li class="requirements my-1 leng">
                                            <i class="bi bi-x-circle red-text"></i>
                                            Your password must have at least 8 characters.
                                        </li>
                                        <li class="requirements my-1 big-letter">
                                            <i class="bi bi-x-circle red-text"></i>
                                            Your password must have at least 1 upper letter.
                                        </li>
                                        <li class="requirements my-1 num">
                                            <i class="bi bi-x-circle red-text"></i>
                                            Your password must have at least 1 number.
                                        </li>
                                        <li class="requirements my-1 special-char">
                                            <i class="bi bi-x-circle red-text"></i>
                                            Your password must have at least 1 special
                                            character.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <label for="inputPassword" class="col-lg-4 col-form-label fs-5">
                                Enter Again
                            </label>
                            <div class="input-group mb-3">
                                <input type="password" class="check-password-confirm form-control shadow-none" id="password-confirm" name="password-confirm" minlength="8" autocomplete="off">
                                <span class="input-group-text rounded-end">
                                    <i class="bi bi-eye-slash toggle-password-confirm" id="toggle-password-confirm"></i>
                                </span>
                                <div class="invalid-feedback">
                                    You have to enter the same password or invalid password
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="edit-profile-permission" class="form-label fs-5">Rank</label>
                    <div class="input-group mb-3">
                        <span class="me-2">
                            <i class="bi bi-person-vcard-fill"></i>
                        </span>
                        <h3><?= $_SESSION["profile"]["permission"] ?></h3>
                    </div>

                    <label for="edit-profile-email" class="form-label fs-5">Create At</label>
                    <div class="input-group mb-3">
                        <span class="me-2">
                            <i class="bi bi-calendar-plus-fill"></i>
                        </span>
                        <h3><?= $_SESSION["profile"]["create_at"] ?></h3>
                    </div>
                    <button class="check-password-submit w-100 my-2 btn btn-lg rounded-3 btn-secondary" name="save-profile" type="submit">
                        Finish
                    </button>

                </form>
            </div>


        </div>
    </div>
</div>
<script src="../scripts/profile_edit/profile.js"></script>