<?php
include("./core/config.php");
session_start();
if (!isset($_SESSION['article_content'])) {
    $chapter = $_SESSION['chapter'];
    $id = $_SESSION['id']; ?>
    <script>
        window.location.href = "./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $chapter ?>";
    </script>
<?php }
$article_row = $_SESSION['article_content'];
$totalarticlecount = $_SESSION['totalarticlecount'];
$chapter = $_SESSION['chapter'];
$id = $_SESSION['id'];

//$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo;<?= $article_row[0]['aName'] ?></title>


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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

    <!-- Custom script -->
    <!-- <script src="../scripts/index_nav.html.js"></script> -->
    <script src="../scripts/password_validation.js"></script>
    <script src="../scripts/croppie.js"></script>
    <script src="../scripts/index_post_ajax.js"></script>
    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <?php include('./core/navbar.php'); ?>
    </header>

    <main class="container margin">
        <p class="h4 py-4"><?= $article_row[0]['aName'] ?></p>
        <p class="h5"><?= $article_row[0]['aContent'] ?></p>
        <div class="btn-group container">
            <div class="col-2">
                <?php
                $prevchapter = $chapter - 1;
                $nextchapter = $chapter + 1;
                if ($chapter != 0) { ?>
                    <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $prevchapter  ?>" class="btn btn-secondary m-1 rounded-pill">
                        <?php $chapter ?>
                        <i class="bi bi-arrow-left"></i>
                    </a>
                <?php }
                if ($chapter != $totalarticlecount - 1) { ?>
                    <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $nextchapter ?>" class="btn btn-primary m-1 rounded-pill">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                <?php } ?>
            </div>
        </div>
    </main>


</body>

</html>

<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>
<?php
unset($_SESSION['article_content']);
unset($_SESSION['totalarticlecount']); ?>