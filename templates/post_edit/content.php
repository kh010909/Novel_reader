<?php
session_start();

$post_description = $_SESSION["post"]["description"];
if (isset($_SESSION["article"])) {
    $article = $_SESSION["article"];
}
if (isset($_SESSION["post"])) {
    $post = $_SESSION["post"];
}

?>
<section id="posts-content" class="container p-5">
    <h2 class="pb-4 mb-4 fst-italic border-bottom fs-2 fw-bold">
        <?= $post_description ?>
    </h2>
    <div class="row">
        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit-post-form">
                <span class="bi bi-pencil-fill"></span> <!--edit-->
            </button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-post-delete">
                <span class="bi bi-trash3-fill"></span> <!--delete-->
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="nav-content">
                <?php if (isset($_SESSION["article"])) {
                    foreach ($article as $key => $value) {
                        if ($value["display"] == "normal") { ?>
                            <div id="<?= $value["id"] ?>" class="mb-5 pt-5">
                                <h3><?= $value["title"] ?></h3>

                                <?php if ($value["picture"] != "") { ?>
                                    <img src="../static/images/blog_post/article/<?= $value["picture"] ?>" class="d-block w-100 h-100 img-fluid" alt="圖片無法載入">
                                <?php } ?>

                                <div class="lh-base">
                                    <?= $value["description"] ?>
                                </div>

                                <small class="text-muted float-end p-2">
                                    Last updated at <?= date('Y-m-d', strtotime($value["edit_time"])) ?>
                                </small>

                                <div class="btn-group mt-2">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <form action="./post_edit/article_edit/article_modify.php" method="POST">
                                            <input type="hidden" name="for_post" value="<?= $value['for_post'] ?>">
                                            <input type="hidden" name="position" value="<?= $value['position'] ?>">
                                            <input type="hidden" name="article_pic" value="<?= $value["picture"] ?>">
                                            <li>
                                                <input class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-article-delete-<?= $value["id"] ?>" value="Delete" />
                                            </li>
                                            <li>
                                                <input class="dropdown-item" type="submit" name="move_up" value="Move Up">
                                            </li>
                                            <li>
                                                <input class="dropdown-item" type="submit" name="move_down" value="Move Down">
                                            </li>
                                            <li>
                                                <input class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-article-<?= $value['id'] ?>" value="Edit" />
                                            </li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div id="<?= $value["id"] ?>" class="card my-3 border border-start-0 border-end-0 rounded-0">
                                <div class="row g-0 py-4">
                                <?php if ($value["picture"] != "") { ?>
                                    <div class="col-lg-6">
                                        <img src="../static/images/blog_post/article/<?= $value["picture"] ?>" class="d-block w-100 h-100 img-fluid Wrounded-start" alt="圖片無法載入">
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= $value["title"] ?>
                                            </h5>
                                            <div class="card-text lh-base">
                                                <?= $value["description"] ?>
                                            </div>
                                            <p class="card-text lh-base">
                                                <small class="text-muted float-end">
                                                    Last updated at <?= date('Y-m-d', strtotime($value["edit_time"])) ?>
                                                </small>
                                            </p>
                                            <div class="btn-group mt-2">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <form action="./post_edit/article_edit/article_modify.php" method="POST">
                                                        <input type="hidden" name="for_post" value="<?= $value['for_post'] ?>">
                                                        <input type="hidden" name="position" value="<?= $value['position'] ?>">
                                                        <input type="hidden" name="article_pic" value="<?= $value["picture"] ?>">
                                                        <li>
                                                            <input class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-article-delete-<?= $value['id'] ?>" value="Delete" />
                                                        </li>
                                                        <li>
                                                            <input class="dropdown-item" type="submit" name="move_up" value="Move Up">
                                                        </li>
                                                        <li>
                                                            <input class="dropdown-item" type="submit" name="move_down" value="Move Down">
                                                        </li>
                                                        <li>
                                                            <input class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-article-<?= $value['id'] ?>" value="Edit" />
                                                        </li>
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php }
                    }
                } ?>
                <div class="d-grid mx-auto" data-bs-toggle="modal" data-bs-target="#add-article-form">
                    <input class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" value="Add new article">
                </div>
                <form class="d-grid mx-auto" action="./post/post_handle.php">
                    <input class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit" value="Finish">
                </form>
            </div>
        </div>
        <div class="col-4 mb-5">
            <nav id="sitcky-posts-nav" class="position-sticky d-none d-md-block">
                <nav class="nav nav-pills flex-column pt-5">
                    <?php if (isset($_SESSION["article"])) {
                        foreach ($article as $key => $value) {
                            if ($value["display"] != "card") { ?>
                                <a class="nav-link" href="#<?= $value["id"] ?>">
                                    <?= $value["title"] ?>
                                </a>
                    <?php
                            }
                        }
                    } ?>
                </nav>
            </nav>
        </div>
    </div>
</section>