<?php
session_start();
$post_description = $_SESSION["post"]["description"];
if (isset($_SESSION["article"])) {
    $article = $_SESSION["article"];
}
if (isset($_SESSION["author"])) {
    if ($_SESSION['author']['icon'] != "") {
        $author_icon = "../static/images/user/icon/" . $_SESSION['author']['icon'];
    }
    $author_name = $_SESSION["author"]["name"];
    $author_about = $_SESSION["author"]["about"];

    //take first paragragh in $author_about: https://electrictoolbox.com/extract-first-paragraph-webpage-php/
    $start = strpos($author_about, '<p>');
    $end = strpos($author_about, '</p>', $start);
    $author_about = substr($author_about, $start, $end - $start + 4);
}
?>
<section id="posts-content" class="container p-5">
    <h2 class="pb-4 mb-4 fst-italic border-bottom fs-2 fw-bold">
        <?= $post_description ?>
    </h2>
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
                            </div>
                        <?php } else { ?>
                            <div id="<?= $value["id"] ?>" class="card my-3 border border-start-0 border-end-0 rounded-0">
                                <div class="row g-0 py-4">
                                    <div class="col-lg-6">
                                        <img src="../static/images/blog_post/article/<?= $value["picture"] ?>" class="d-block w-100 h-100 img-fluid Wrounded-start" alt="圖片無法載入">
                                    </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                }
                if (isset($_SESSION["user"])) {
                    if ($_SESSION["user"]["email"] == $_SESSION["post"]["post_email"]) { ?>
                        <form class="d-grid mx-auto" action="./post_edit/post_edit_handle.php">
                            <input class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit" value='Edit'>
                        </form>
                <?php }
                } ?>
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
                    <?php }
                        }
                    } ?>
                    <a class="nav-link" href="#Comments">
                        Comments
                    </a>
                    <div id="author" class="container mt-5 border border-secondary border-2 rounded">
                        <div class="row">
                            <div class="col-5 mt-3 mb-3 text-center">
                                <?php
                                if (isset($author_icon)) { ?>
                                    <img src="<?= $author_icon ?>" alt="mdo" class="rounded-circle d-block text-center" height="100px" width="100px">
                                <?php } else { ?>
                                    <i class="bi bi-person-circle"></i>
                                <?php } ?>
                            </div>
                            <div class="col-7">
                                <div class="row mt-3">
                                    <div class="col">
                                        <h5><?= $author_name ?></h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <?php if ($author_about != "") {
                                            echo $author_about;
                                        } else { ?>
                                            <p class="text-black-50">( The author has not filled in the self-introduction. )</p>
                                        <?php }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </nav>
        </div>
    </div>
    <?php include("../comment/comment_content.php"); ?>
</section>