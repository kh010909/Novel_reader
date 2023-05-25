<?php
//need ctrl+f to change all the novel_list.php to the right name
//need change 1config.php and 1search....php to the right name before using
include('./core/config.php');
include('./core/search_relative.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo; Search</title>

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

    <main class="margin">
        <?php
        //$_GET VARIABLES THIS PAGE HAVE
        //"list_type" type we want, necessary for ALL OF FIVE TYPE *
        //"list_q", target we want, necessary for SEARCH & TAG *
        //"list_user" necessary for COLLECTION *
        //"list_page", current novel_list page
        $length = null;
        $type = null;

        if (isset($_GET["list_page"])) { //KNOW CURRENT PAGE
            $page = $_GET["list_page"];
            if ($page < 1) {
                $page = 1;
            }
        } else {
            $page = 1;
        }
        if (isset($_SESSION["user"]["uId"])) {
            $user = $_SESSION["user"]["uId"];
        } else {
            $user = null;
        }

        if (isset($_GET["list_type"])) { //QUERY TO TO DB
            $type = $_GET["list_type"];
            if (($type == "SEARCH" || $type == "TAG") && (isset($_GET["list_q"]))) {
                $result = search_list($sql_link, $type, $length, $_GET["list_q"], 33, (($page - 1) * 32), $user);
                if ($type == "SEARCH") {
                    $list_title = "搜尋結果: ";
                } else
                    $list_title = "Tag: ";

                $list_title .= $_GET["list_q"];
            } else if ($type == "LIKE" || $type == "TIME") {
                $result = search_list($sql_link, $type, $length, "", 33, (($page - 1) * 32), $user);
                if ($type == "LIKE") {
                    $list_title = "熱門";
                } else
                    $list_title = "最新";
            } else if ($type == "COLLECTION" && isset($_GET["list_q"]) && isset($_SESSION["user"]["uId"])) {
                $result = search_list($sql_link, $type, $length, $_GET["list_q"], 33, (($page - 1) * 32), $user, $user);
                $list_title = "蒐藏夾: ";
                $list_title .= $_GET["list_q"];
            } else if ($type == "COMPLETED" && isset($_GET["list_q"])) {
                $result = search_list($sql_link, $type, $length, $_GET["list_q"], 33, (($page - 1) * 32), $user);
                $list_title = $_GET["list_q"];
            }
        } else {
            //header("Location:./index.php");
        }
        if (!isset($list_title)) { //KNOW CURRENT PAGE
            $list_title = "No Content Currently";
        }
        ?>
        <div class="container-fluid col-11 py-3 ">

        </div>
        <div class="container-fluid col-11">
            <h1>
                <?= $list_title ?>
            </h1>
            <div class="d-none d-lg-block">
                <?php
                if (isset($result) && isset($length)) { //RENDER THE RESULT

                    $name = array_column($result, 'nName');
                    $author = array_column($result, 'author');
                    $newchp = array_column($result, 'newestChapter');
                    $nimg = array_column($result, 'nImg');
                    $nID = array_column($result, 'nId');

                    for ($i = 0; $i < $length; $i++) {
                        if ($i < 32) {
                            block_row($nID, $nimg, $name, $author, $newchp, $i, 4);
                            $i += 3;
                        }
                    }
                }
                ?>
            </div>

            <div class="d-lg-none">
                <ul class="list-group">
                    <?php
                    if (isset($result) && isset($length)) { //RENDER THE RESULT
                        $name = array_column($result, 'nName');
                        $author = array_column($result, 'author');
                        $newchp = array_column($result, 'newestChapter');
                        $nimg = array_column($result, 'nImg');
                        $nID = array_column($result, 'nId');

                        for ($i = 0; $i < $length; $i++) {
                            if ($i < 32) {
                                block_row_small($nID, $nimg, $name, $author, $newchp, $i, 4);
                                $i += 3;
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $last_page = false;
        if ($length < 33) {
            $last_or_no = ""; //This is the Last page.
            $last_page = true;
            if (isset($_GET["list_q"])) {
                $list_q = $_GET["list_q"];
            } else {
                $list_q = null;
            }
            if ($length == 0) {
                $length2 = 0;
                $right_pos = search_list($sql_link, $type, $length2, $list_q, null, null, $user, $user);
                if ($length2 == 0) {
                    //return to page 1
                    $last_or_no = "No content currently.";
                    $page = 1;
                } else {
                    //go to where last page is
                    $target_page = floor($length2 / 32) + 1;
                    print($target_page);
                    $target_get_string = "./novel_list.php?";
                    if (isset($_GET["list_type"])) {
                        $target_get_string .= "list_type=$_GET[list_type]";
                    }
                    if (isset($_GET["list_q"])) {
                        $target_get_string .= "&list_q=$_GET[list_q]";
                    }
                    if (isset($_GET["list_user"])) {
                        $target_get_string .= "&list_user=$_GET[list_user]";
                    }
                    $target_get_string .= "&list_page=$target_page";
        ?>
                    <script type="text/javascript">
                        window.location = "<?= $target_get_string ?>"
                    </script>
            <?php
                }
            }
            ?>
            <div class="container-fluid col-8 py-3 ">
                <h1>
                    <?= $last_or_no ?>
                </h1>
            </div>
        <?php
        }
        ?>
        <div>

            <!-- button row -->
            <div class="container-fluid col-8 py-3 justify-content-center d-flex">
                <form action="novel_list.php" method="GET">
                    <?php
                    if (isset($_GET["list_type"])) {
                    ?>
                        <input type="hidden" name="list_type" value="<?= $_GET["list_type"] ?>">
                    <?php
                    }
                    if (isset($_GET["list_q"])) {
                    ?>
                        <input type="hidden" name="list_q" value="<?= $_GET["list_q"] ?>">
                    <?php
                    }
                    if (isset($_GET["list_user"])) {
                    ?>
                        <input type="hidden" name="list_user" value="<?= $_GET["list_user"] ?>">
                    <?php
                    }
                    ?>
                    <input type="hidden" name="list_page" value="<?= $page - 1 ?>">
                    <?php
                    if ($page == 1) {
                    ?>
                        <p class="btn btn-outline-success mx-3">上一頁</p>
                    <?php
                    } else {
                    ?>
                        <input type="submit" class="btn btn-outline-success mx-3" value="上一頁">
                    <?php
                    }
                    ?>
                </form>
                <?php
                if (isset($_GET["list_type"]) && isset($page)) {
                    if (isset($_GET["list_q"])) {
                        $list_q = $_GET["list_q"];
                    } else {
                        $list_q = null;
                    }
                    $i_end = null;
                    $i_start = $page - 4;
                    if ($i_start < 1) {
                        $i_start = 1;
                        $i_end = 9;
                    } else {
                        $i_end = $page + 4;
                    }
                    if ($last_page) { //check whether $i_end is exist
                        $i_end = $page;
                    } else {
                        $check_count = $i_end - $page;
                        search_list($sql_link, $type, $length3, $list_q, ($check_count * 32), (($page) * 32), $user, $user);
                        $i_end = $page + ceil($length3 / 32);
                    }

                    for ($i_start; $i_start <= $i_end; $i_start++) {
                ?>
                        <form action="novel_list.php" method="GET">
                            <?php
                            if (isset($_GET["list_type"])) {
                            ?>
                                <input type="hidden" name="list_type" value="<?= $_GET["list_type"] ?>">
                            <?php
                            }
                            if (isset($_GET["list_q"])) {
                            ?>
                                <input type="hidden" name="list_q" value="<?= $_GET["list_q"] ?>">
                            <?php
                            }
                            if (isset($_GET["list_user"])) {
                            ?>
                                <input type="hidden" name="list_user" value="<?= $_GET["list_user"] ?>">
                            <?php
                            }
                            ?>
                            <input type="hidden" name="list_page" value="<?= $i_start ?>">
                            <?php
                            if ($page == $i_start) {
                            ?>
                                <p class="btn btn-outline-light mx-3 bg-success">
                                    <?php
                                    echo ($page);
                                    ?>
                                </p>

                            <?php
                            } else {
                            ?>
                                <input type="submit" class="btn btn-outline-success mx-3" value="<?= $i_start ?>">
                            <?php
                            }
                            ?>
                        </form>
                <?php
                    }
                }
                ?>
                <form action="novel_list.php" method="GET">
                    <?php
                    if (isset($_GET["list_type"])) {
                    ?>
                        <input type="hidden" name="list_type" value="<?= $_GET["list_type"] ?>">
                    <?php
                    }
                    if (isset($_GET["list_q"])) {
                    ?>
                        <input type="hidden" name="list_q" value="<?= $_GET["list_q"] ?>">
                    <?php
                    }
                    if (isset($_GET["list_user"])) {
                    ?>
                        <input type="hidden" name="list_user" value="<?= $_GET["list_user"] ?>">
                    <?php
                    }
                    ?>
                    <input type="hidden" name="list_page" value="<?= $page + 1 ?>">
                    <?php
                    if ($last_page) {
                    ?>
                        <p class="btn btn-outline-success mx-3">下一頁</p>
                    <?php
                    } else {
                    ?>
                        <input type="submit" class="btn btn-outline-success mx-3" value="下一頁">
                    <?php
                    }
                    ?>
                </form>
                <!-- <form action="novel_list.php" method="GET">
                    <?php
                    if (isset($_GET["list_type"])) {
                    ?>
                        <input type="hidden" name="list_type" value="<?= $_GET["list_type"] ?>">
                        <?php
                    }
                    if (isset($_GET["list_q"])) {
                        ?>
                        <input type="hidden" name="list_q" value="<?= $_GET["list_q"] ?>">
                        <?php
                    }
                    if (isset($_GET["list_user"])) {
                        ?>
                        <input type="hidden" name="list_user" value="<?= $_GET["list_user"] ?>">
                        <?php
                    }
                        ?>
                    <input type="number" class="btn btn-outline-success mx-3 col-3" name="list_page"
                        value="<?= $page ?>">
                </form> -->
                <div class="align-self-center">
                    Current page:
                    <?= $page ?>
                </div>

            </div>
        </div>

    </main>

    <footer class="margin">
        <?php include('./core/footer.php') ?>
    </footer>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>