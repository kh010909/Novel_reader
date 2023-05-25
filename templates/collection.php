<?php
include("./core/config.php");
session_start();
if (isset($_SESSION["user"])) {
    $user_uId = $_SESSION["user"]["uId"];
    $sql = "SELECT * FROM `collection` AS c WHERE c.uId=$user_uId";
    $collection_file_rows = get_row($sql, $collection_file_count, $sql_link);

    $sql = "SELECT * 
    FROM `collection` AS c, `keep` AS k,`bookrecord` AS b, `novel` AS n  
    WHERE c.uId=$user_uId AND c.collectId=k.collectId AND k.bId=b.bId AND b.nId=n.nId";
    $novel_rows = get_row($sql, $novel_count, $sql_link);
}

?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo;My collection</title>


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
        <?php
        if ($collection_file_count == 0) { ?>
            <div style="height: 25px;">
                <div aria-label="Example 20px high" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="margin h3 pt-2 fs-1 pb-3 border-bottom">歡迎來到Language Forest，請增加你的收藏夾...</div>
            <a class="ms-3 mb-1 h1 pb-5 pt-2 mt-5" href="./index.php">
                <i class="bi bi-folder-plus title-hover" style="font-size: 100px;"></i>
            </a>
        <?php } ?>
        <?php
        for ($i = 0; $i < $collection_file_count; $i++) {
            $k = 0; ?>
            <div class="row justify-content-md-center d-none d-lg-block margin rounded-2 shadow-lg pb-3">
                <div class="row">
                    <div class="d-flex justify-content-start border-bottom pb-2 m-2 pt-2 me-3">
                        <a class="h1 title-hover" href="./novel_list.php?list_type=COLLECTION&list_q=<?= $collection_file_rows[$i]['collectName'] ?>"><?= $collection_file_rows[$i]['collectName'] ?></a>
                        <form action="./collection/collection_delete_handle.php" method="post" class="p-2">
                            <input type="hidden" name="collectId" value="<?= $collection_file_rows[$i]['collectId'] ?>">
                            <button type="submit" class="dropdown-item pt-3 title-hover"> <i class="bi bi-trash"></i> </button>
                        </form>
                    </div>
                    <div class="d-flex flex-row pt-3 mb-3 pb-3">
                        <?php
                        for ($j = 0; $j < $novel_count; $j++) {
                            if ($novel_rows[$j]['collectId'] == $collection_file_rows[$i]['collectId']) { ?>
                                <a class="rounded-2 single-novel-block-hover p-2 flex-row d-flex col-3" href="./novel/novel_handle.php?nId=<?= $novel_rows[$j]['nId'] ?>">
                                    <div class="col-6 me-2">
                                        <img class="rounded-2" src="../static/images/novel/<?= $novel_rows[$j]['nImg'] ?>">
                                    </div>
                                    <div class="py-2">
                                        <p class="skip fw-bold p-1 h-50 d-block d-xl-none">
                                            <?= $novel_rows[$j]['nName'] ?>
                                        </p>
                                        <p class="h8 py-3 px-1 d-block d-xl-none">
                                            <?= $novel_rows[$j]['author'] ?>
                                        </p>
                                        <p class="skip fw-bold p-1 h-25 d-xl-block d-none">
                                            <?= $novel_rows[$j]['nName'] ?>
                                        </p>
                                        <p class="h8 py-3 px-1 h-50 d-xl-block d-none">
                                            <?= $novel_rows[$j]['author'] ?>
                                        </p>
                                        <div class="btn-group h-50">
                                            <form action="./novel_list.php" method="GET">
                                                <input type="hidden" name="list_type" value="COMPLETED">
                                                <input type="hidden" name="list_q" value="<?= $novel_rows[$j]['completed'] ?>">
                                                <button type="submit" class="btn btn-outline-primary rounded-pill">
                                                    <?= $novel_rows[$j]['completed'] ?>
                                                </button>
                                            </form>
                                            <form action="./collection/collection_add_handle.php" method="post" class="p-2">
                                                <input type="hidden" name="nId" value="<?= $novel_rows[$j]['nId'] ?>">
                                                <input type="hidden" name="collectId" value="<?= $collection_file_rows[$i]['collectId'] ?>">
                                                <input type="hidden" name="inside" value="1">
                                                <button type="submit" class="dropdown-item"> <i class="bi bi-trash title-hover"></i> </button>
                                            </form>
                                        </div>

                                    </div>
                                </a>

                            <?php $k++;
                            }
                            if ($k >= 4) {
                                break;
                            }
                        }
                        if ($k == 0) { ?>
                            <a class="ms-3 mb-1 h1" href="./index.php">
                                <i class="bi bi-folder-plus title-hover" style="font-size: 100px;"></i>
                            </a>
                            <!-- <div class="mb-5 h3">There's no novel in the collection...</div> -->
                        <?php }
                        ?>
                    </div>
                </div>
            </div><?php
                } ?>
        <div style="height: 50px;">
            <div aria-label="Example 20px high" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </main>

    <footer>
        <?php include('./core/footer.php') ?>
    </footer>
</body>

</html>
<!-- <?php
        // unset($_SESSION["collection_file"]);
        // unset($_SESSION["collection_file_count"]);
        // unset($_SESSION["collection_novel"]);
        // unset($_SESSION["collection_novel_count"]);
        ?> -->
<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>