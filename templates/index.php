<?php
include("./core/config.php");
session_start();
$sql = "SELECT * FROM novel ORDER BY nTime DESC LIMIT 8";
$newest_rows = get_row($sql, $newcount, $sql_link);
$sql = "SELECT * FROM novel ORDER BY nLike DESC LIMIT 5";
$popularity_result = $sql_link->query($sql);
$popularity_rows = get_row($sql, $popularcount, $sql_link);
for ($i = 0; $i < 8; $i++) {
    $newest_rows[$i]["description"] = strip_tags($newest_rows[$i]["description"], '<br>');
    $newest_rows[$i]["description"] = substr($newest_rows[$i]["description"], 0, 80);
    $newest_rows[$i]["description"] .= '...';
}

//$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo; Home</title>


    <link href="../static/images/icon/tree_book.png" rel="icon" />
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap" rel="stylesheet">
    <!-- Vue -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Custom script -->
    <!-- <script src="../scripts/index_nav.html.js"></script> -->
    <script src="../scripts/password_validation.js"></script>
    <!-- <script src="../scripts/croppie.js"></script> -->
    <!-- <script src="../scripts/index_post_ajax.js"></script> -->
    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <?php include('./core/navbar.php'); ?>
    </header>
    <main class="container">
        <!-- 塊狀1 全小方格-->
        <div class="row justify-content-md-center d-none d-lg-block margin">
            <div class="row">
                <div class="border-bottom" id="block1">
                    <a class="h1" href="./novel_list.php?list_type=TIME">最新小說</a>
                </div>
                <!-- 單排格式 -->
                <div class="d-flex flex-row">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="p-2 flex-row d-flex col-3">
                            <div class=" col-6">
                                <a href="./novel/novel_handle.php?nId=<?= $newest_rows[$i]['nId'] ?>">
                                    <img src="../static/images/novel/<?= $newest_rows[$i]['nImg'] ?>">
                                </a>
                            </div>
                            <div class="py-2 flex-column d-flex">
                                <p class="p-1">
                                    <?= $newest_rows[$i]['nName'] ?>
                                </p>
                                <p class="py-3 px-1">
                                    <?= $newest_rows[$i]['author'] ?>
                                </p>
                                <p class="p-1">
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- 單排格式 -->
                <div class="d-flex flex-row   ">
                    <?php for ($i = 4; $i < 8; $i++) { ?>
                        <div class="p-2 flex-row d-flex col-3">
                            <div class=" col-6">
                                <a href="./novel/novel_handle.php?nId=<?= $newest_rows[$i]['nId'] ?>">
                                    <img src="../static/images/novel/<?= $newest_rows[$i]['nImg'] ?>">
                                </a>
                            </div>
                            <div class="py-2 flex-column d-flex">
                                <p class="p-1">
                                    <?= $newest_rows[$i]['nName'] ?>
                                </p>
                                <p class="py-3 px-1">
                                    <?= $newest_rows[$i]['author'] ?>
                                </p>
                                <p class="p-1">
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- 塊狀2 大方格-->
        <div class="row justify-content-md-center d-none d-lg-block">
            <div class="row">
                <div class="border-bottom" id="block2">
                    <a class="h1" href="./novel_list.php?list_type=LIKE">熱門小說</a>
                </div>
                <!-- 單位格式 (大)-->
                <?php $i = 0; ?>
                <div class="py-3 pl-3 pr-0 flex-row d-flex col-6">
                    <div class="col-6">
                        <a href="./novel/novel_handle.php?nId=<?= $popularity_rows[$i]['nId'] ?>">
                            <img src="../static/images/novel/<?= $popularity_rows[$i]['nImg'] ?>">
                        </a>
                    </div>
                    <div class="py-2 flex-column d-flex ">
                        <p class="p-1">
                            <?= $popularity_rows[$i]['nName'] ?>
                        </p>
                        <p class="py-3 px-1">
                            <?= $popularity_rows[$i]['author'] ?>
                        </p>
                        <p class="p-1">
                        </p>
                    </div>
                </div>
                <div class="col">
                    <!-- 單排格式 -->
                    <div class="d-flex flex-row  ">
                        <?php for ($i = 1; $i < 3; $i++) { ?>
                            <!-- 單位格式 (塊狀2 小)-->
                            <div class="p-2 flex-row d-flex col-6">
                                <div class="col-6">
                                    <a href="./novel/novel_handle.php?nId=<?= $popularity_rows[$i]['nId'] ?>">
                                        <img src="../static/images/novel/<?= $popularity_rows[$i]['nImg'] ?>">
                                    </a>
                                </div>
                                <div class="py-2 flex-column d-flex ">
                                    <p class="p-1">
                                        <?= $popularity_rows[$i]['nName'] ?>
                                    </p>
                                    <p class="py-3 px-1">
                                        <?= $popularity_rows[$i]['author'] ?>
                                    </p>
                                    <p class="p-1">
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- 單排格式 -->
                    <div class="d-flex flex-row ">
                        <!-- 單位格式 (塊狀2 小)-->
                        <?php for ($i = 3; $i < 5; $i++) { ?>
                            <!-- 單位格式 (塊狀2 小)-->
                            <div class="p-2 flex-row d-flex col-6">
                                <div class="col-6">
                                    <a href="./novel/novel_handle.php?nId=<?= $popularity_rows[$i]['nId'] ?> ">
                                        <img src="../static/images/novel/<?= $popularity_rows[$i]['nImg'] ?>">
                                    </a>
                                </div>
                                <div class="py-2 flex-column d-flex ">
                                    <p class="p-1">
                                        <?= $popularity_rows[$i]['nName'] ?>
                                    </p>
                                    <p class="py-3 px-1">
                                        <?= $popularity_rows[$i]['author'] ?>
                                    </p>
                                    <p class="p-1">
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-lg-none margin">
            <div class="row">
                <ul class="list-group col">
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
                    <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
                    <li class="list-group-item list-group-item-success">This is a success list group item</li>
                </ul>
                <ul class="list-group col">
                    <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
                    <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
                    <li class="list-group-item list-group-item-info">This is a info list group item</li>
                    <li class="list-group-item list-group-item-light">This is a light list group item</li>
                </ul>
            </div>
        </div>


    </main>

    <footer>
        <?php include('./core/footer.php') ?>
    </footer>
</body>

</html>

<script>
    $(document).ready(function () {
        $('#modal-show-message').modal('show');
    });
</script>