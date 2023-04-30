<?php
include './login/login_form.php';
include './login/logout_form.php';
// include './login/policy.html';
include './login/show_message.php';
include './login/signin_form.php';
include './profile/profile_form.php';

// include './post_edit/add_post_form/add_post_form.php';
// include './post_edit/add_post_form/add_post_form_crop.php';

// if (isset($_SESSION['user']) && ($_SESSION['user']['icon'] != "")) {
//     $icon = "../static/images/user/icon/" . $_SESSION['user']['icon'];
// } else {
//     $icon = "../static/images/icon/person-circle.svg";
// }

?>
<nav id="index-navbar" class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
    <div id="navbar-content" class="container-fluid">
        <a class="navbar-brand end-0" href="index.php">
            Language<br>Forest
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item font-weight-bold">
                    <a class="nav-link" href="./crawler.php">Crawl</a>
                </li>
                <?php
                if (isset($_SESSION["user"])) {
                ?>
                    <li class="nav-item font-weight-bold">
                        <a class="nav-link" aria-current="page" href="./collection.php">Collection</a>
                    </li>
                    <li class="nav-item font-weight-bold">
                        <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal-profile">Profile</a>
                    </li>
                <?php } else {
                ?>
                    <li class="nav-item font-weight-bold">
                        <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#modal-login">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" data-bs-toggle="modal" data-bs-target="#modal-login">Profile</a>
                    </li>
                <?php }
                ?>

            </ul>
            <div class="d-flex align-items-center">
                <form class="me-2 w-100" role="search" action="./novel_list.php">
                    <input type="hidden" name="list_type" value="SEARCH">
                    <input type="search" class="form-control-sm bg-transparent border-0 border-bottom rounded-0 " placeholder="Search..." aria-label="Search" name="list_q" ?>
                </form>
                <div class="dropdown text-end">
                    <a href="#" class="d-block text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../static/images/icon/tree_book.png" alt="mdo" class="rounded-circle" height="31px" width="31px">
                    </a>
                    <ul class="dropdown-menu text-small dropdown-menu-end mt-2">
                        <?php if (!isset($_SESSION["user"])) {
                        ?>
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-login">Login</a>
                            </li>
                        <?php } else {
                        ?>
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-logout">Logout</a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- <script src="../scripts/croppie.js"></script>
<script src="../scripts/post_edit/add_post_form_edit.js"></script> -->