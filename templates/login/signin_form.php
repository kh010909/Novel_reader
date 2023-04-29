<div class="modal fade" id="modal-signin" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="modal-signin-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2" id="modal-signin-label">Sign up for free</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-5 pt-0">
                <form action="./login/member_handle.php" method="POST">
                    <input type="hidden" name="method" value="signup">

                    <label for="signin-name" class="form-label">User Name</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control shadow-none" id="signin-name" required>
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>

                    <label for="signin-email" class="form-label">Email Address</label>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control shadow-none" id="signin-email" required>
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>

                    <hr class="my-4">

                    <label for="signin-password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="check-password form-control shadow-none" id="signin-password" minlength="8" autocomplete="off" required>
                        <span class="input-group-text rounded-end">
                            <i class="bi bi-eye-slash toggle-password" id="toggle-password"></i>
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
                                    Your password must have at least 1 special character.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <label for="signin-password" class="form-label">Confirm Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="check-password-confirm form-control shadow-none" id="signin-password-confirm" minlength="8" autocomplete="off" required>
                        <span class="input-group-text rounded-end">
                            <i class="bi bi-eye-slash toggle-password-confirm" id="toggle-password-confirm"></i>
                        </span>
                        <div class="invalid-feedback">
                            You have to enter the same password or invalid password
                        </div>
                    </div>

                    <!-- <div class="form-check my-2 d-flex align-items-center">
                        <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault"
                            data-bs-toggle="modal" data-bs-target="#modal-policy" required>
                        <label class="form-check-label ps-2" for="flexCheckDefault">
                            <p>I agree Privacy Policy</p>
                        </label>
                    </div> -->

                    <button class="check-password-submit w-100 my-2 btn btn-lg rounded-3 btn-secondary disabled" type="submit">
                        Sign up
                    </button>
                    <hr class="my-4">
                    <p>
                        <small class="text-muted">Have a account?
                            <a class="border-bottom border-secondary" data-bs-toggle="modal" data-bs-target="#modal-login">
                                Login
                            </a> .
                        </small>
                    </p>
                    <!-- <p class="mt-1">
                        <small class="text-muted">By clicking Sign up, you agree to the
                            <a class="border-bottom border-secondary" data-bs-toggle="modal"
                                data-bs-target="#modal-policy">
                                Privacy Policy
                            </a> .
                        </small>
                    </p> -->
                </form>
            </div>
        </div>
    </div>
</div>