<?php
include("./core/config.php");
session_start();
$novel_row = $_SESSION['novel'];
$article_rows  = $_SESSION['article'];
$tag_rows = $_SESSION['tag'];
$record_row = $_SESSION['record'];
$comment_rows = $_SESSION['comment'];
$commentcount = $_SESSION['commentcount'];
$tagcount = $_SESSION['tagcount'];
$articlecount = $_SESSION['articlecount'];
$id = $novel_row[0]['nId'];
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo; <?= $novel_row[0]['nName'] ?> </title>

    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="../static/images/icon/tree_book.png" rel="icon" />
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap" rel="stylesheet">
    <!-- Vue -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </script>
    <!-- Jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Custom script -->
    <!-- <script src="../scripts/index_nav.html.js"></script> -->
    <script src="../scripts/password_validation.js"></script>
    <script src="../scripts/croppie.js"></script>
    <script src="../scripts/index_post_ajax.js"></script>
    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <?php include('./core/navbar.php');
        ?>
    </header>

    <main class="container">
        <div class="margin">
            <div class="row">
                <div class="col-md-8 row">
                    <div class="py-3 pl-3 pr-0 flex-row d-flex col-lg-12">
                        <div class="col-lg-6">
                            <img class="p-5" src="../static/images/novel/<?= $novel_row[0]['nImg'] ?>">
                        </div>
                        <div class="py-2 flex-column d-flex">
                            <p class="p-1 h2"><?= $novel_row[0]['nName'] ?></p>
                            <p class="py-3 px-1 h4"><?= $novel_row[0]['author'] ?></p>
                            <p class="p-1 h5"><?= $novel_row[0]['description'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION["user"])) { ?>
            <div class="btn-group">
                <?php if ($record_row != NULL) {
                    if ($record_row[0]['bLike']) { ?>
                        <a href="./like/like_handle.php?nId=<?= $id ?>" class="btn btn-secondary px-3 m-2 rounded-pill">
                            <i class="bi bi-hand-thumbs-up" title="取消喜歡"></i>
                        </a>
                    <?php } else { ?>
                        <a href="./like/like_handle.php?nId=<?= $id ?>" class="btn btn-primary px-3 m-2 rounded-pill">
                            <i class="bi bi-hand-thumbs-up" title="我喜歡這本小說"></i>
                        </a>
                    <?php }
                } else { ?>
                    <a href="./like/like_handle.php?nId=<?= $id ?>" class="btn btn-primary px-3 m-2 rounded-pill">
                        <i class="bi bi-hand-thumbs-up" title="我喜歡這本小說"></i>
                    </a>
                <?php } ?>

                <?php if ($record_row != NULL) {
                    if ($record_row[0]['preference'] == 'hate') { ?>
                        <a href="./like/dislike_handle.php?nId=<?= $id ?>" class="btn btn-danger px-3 m-2 rounded-pill">
                            <i class="bi bi-eye-slash" title="恢復"></i>
                        </a>
                    <?php } else { ?>
                        <a href="./like/dislike_handle.php?nId=<?= $id ?>" class="btn btn-secondary px-3 m-2 rounded-pill">
                            <i class="bi bi-eye" title="我不想看到這本小說"></i>
                        </a>
                    <?php }
                } else { ?>
                    <a href="./like/dislike_handle.php?nId=<?= $id ?>" class="btn btn-secondary px-3 m-2 rounded-pill">
                        <i class="bi bi-eye" title="我不想看到這本小說"></i>
                    </a>
                <?php } ?>

                <form action="" method="">
                    <button type="button" class="btn btn-secondary dropdown-toggle px-3 m-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-folder" title="Add into collection..."></i>
                        <!-- Add into collection -->
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button type="submit" class="dropdown-item"> 收藏 1 </button>
                        </li>
                        <li>
                            <button type="submit" class="dropdown-item"> 收藏 2 </button>
                        </li>
                        <li>
                            <button type="submit" class="dropdown-item"> 新增收藏... </button>
                        </li>
                    </ul>
                </form>
            </div>
        <?php } ?>

        <div class="border-bottom h2 mt-3">
            標籤
            <br>
            <div class="btn-group">
                <form action="" method="">
                    <?php for ($i = 0; $i < $tagcount; $i++) { ?>
                        <button type="submit" class="btn btn-outline-primary m-1 rounded-pill">
                            <?= $tag_rows[$i]["tag"] ?>
                        </button>
                    <?php } ?>
                </form>
                <button type="submit" class="btn btn-outline-primary m-1 rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    新增標籤
                </button>
            </div>
        </div>
        <div class="border-bottom h2 mt-3">
            開始閱讀
            <div>
                <?php for ($i = 0; $i < $articlecount; $i++) {
                    if ($record_row != NULL) {
                        if ($i < $record_row[0]['currCh']) { ?>
                            <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $i ?>" class="btn btn-outline-secondary m-1 rounded-pill">
                                <?= $article_rows[$i]['aName'] ?>
                            </a>
                        <?php } else { ?>
                            <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $i ?>" class="btn btn-secondary m-1 rounded-pill">
                                <?= $article_rows[$i]['aName'] ?>
                            </a>
                        <?php }
                    } else { ?>
                        <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $i ?>" class="btn btn-secondary m-1 rounded-pill">
                            <?= $article_rows[$i]['aName'] ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="border-bottom h2 mt-3">
            留言
        </div>
        <?php include("./comment/comment_content.php") ?>
    </main>
    <div class="margin"></div>
    <footer>
        <?php include('./core/footer.php');
        ?>
    </footer>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>
<?php include("./novel/modal.php"); ?>