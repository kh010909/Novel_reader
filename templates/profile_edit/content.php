<?php
if (isset($_SESSION["profile"])) { ?>
<section id="profile-edit-content" class="container p-5">
    <h2 class="pb-4 mb-4 fst-italic border-bottom fs-2 fw-bold">
        Hey, welcome back <?=$_SESSION["profile"]["name"]?>
    </h2>

    <div class="row">
        <div class="col-md-8">
            <div id="nav-content">
                <div id="account-safety" class="mb-5 pt-5">
                    <div class="align-middle">
                        <h3>Account safety</h3>
                    </div>
                    <div class="accordion accordion-flush" id="account-option">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="account-password">
                                <button class="rounded-top accordion-button collapsed shadow-none border-bottom"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-password"
                                    aria-expanded="false" aria-controls="flush-password">
                                    Change your account password
                                </button>
                            </h2>
                            <div id="flush-password" class="accordion-collapse collapse"
                                aria-labelledby="flush-heading-one" data-bs-parent="#account-option">
                                <div class="accordion-body p-5">
                                    <form action="./profile_edit/password_edit/password_edit_handle.php" method="POST">
                                        <div class="px-5 mt-2">
                                            <div class="mb-3 row">
                                                <label for="inputPassword"
                                                    class="col-lg-4 col-form-label">Password</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control shadow-none"
                                                            id="password" name="password" required>
                                                        <span class="input-group-text">
                                                            <i class="bi bi-shield-lock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputPassword" class="col-lg-4 col-form-label">New
                                                    Password</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="password"
                                                            class="check-password form-control shadow-none"
                                                            id="password-new" name="password-new" minlength="8"
                                                            autocomplete="off" required>
                                                        <span class="input-group-text rounded-end">
                                                            <i class="bi bi-eye-slash toggle-password"
                                                                id="toggle-password">
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
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="inputPassword" class="col-lg-4 col-form-label">
                                                    Enter Again
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="password"
                                                            class="check-password-confirm form-control shadow-none"
                                                            id="password-confirm" name="password-confirm" minlength="8"
                                                            autocomplete="off" required>
                                                        <span class="input-group-text rounded-end">
                                                            <i class="bi bi-eye-slash toggle-password-confirm"
                                                                id="toggle-password-confirm"></i>
                                                        </span>
                                                        <div class="invalid-feedback">
                                                            You have to enter the same password or invalid password
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-5">

                                        <div class="px-5">
                                            <button
                                                class="check-password-submit w-100 py-2 mb-2 btn btn-outline-secondary rounded-3 disabled"
                                                type="submit">
                                                Confirm
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="about-me" class="mb-5 pt-5" data-bs-toggle="modal" data-bs-target="#about-form">
                    <div class="align-middle">
                        <h3>About me</h3>
                    </div>
                    <div class="card">
                        <div class="card-header text-center">
                            Content
                        </div>
                        <div class="card-body">
                            <div class="article-text card-text">
                                <?php if ($_SESSION["profile"]["about"] != "") { ?>
                                <?=$_SESSION["profile"]["about"]?>
                                <?php } else {?>
                                <p>I am new here, thank you for visiting my page!</p>
                                <?php }?>
                            </div>
                        </div>
                        <div class="card-footer text-muted w-100 text-center">
                            <button href="#" class="btn btn-sm btn-secondary">
                                Edit <i class="rounded-circle bi bi-pencil icon-edit text-end fs-6 ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mb-5">
            <nav id="sitcky-posts-nav" class="position-sticky d-none d-md-block">
                <nav class="nav nav-pills flex-column pt-5">
                    <a class="nav-link" href="#account-safety">
                        Account safety
                    </a>
                    <a class="nav-link" href="#about-me">
                        About me
                    </a>
                </nav>
            </nav>
        </div>
    </div>
</section>
<?php }?>