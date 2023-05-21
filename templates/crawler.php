<?php
include("./core/config.php");
session_start();
//$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>LanguageForest &raquo;Crawler</title>


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

    <div class="col-8 container-fluid">
        <div class="row mb-5">
            <div class="margin border-bottom h2 mb-3">
                說明
            </div>
            <p class="h6">這個頁面可以幫助你在我們支援的網站中爬蟲，並利用我們寫的程式將他存入您的電腦。</p>
        </div>
        <div class="row mb-5">
            <div class="border-bottom h2 mb-3">
                如何使用
            </div>
            <ol class="h6 list-group list-group-numbered ">
                <li class="list-group-item border border-0">
                    將小說主頁的網址部分複製到下載區域的指定框中
                    <ul class="crawler-use-list-group list-group mt-1">
                        <li class="border-0">
                            指定框中有出現的部分網址請不要重複貼上
                        </li>
                        <li class="border-0">
                            瀏覽器的左上方的網頁加載符號在跑就代表後台正在運作，請不要重複點擊爬蟲按鈕
                        </li>
                    </ul>
                </li>
                <li class="list-group-item border border-0">
                    按下「開始爬蟲」
                </li>
                <li class="list-group-item border border-0">
                    安全防護提示
                    <ul class="crawler-use-list-group mt-1">
                        <li class="border-0">
                            如果有安全提示框跳出，請按確定
                        </li>
                        <li class="border-0">
                            如果在下載檔案夾中未看到檔案，請在瀏覽器下方的下載文件直接開啟文件
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
        <div class="border-bottom h2 mb-3">
            下載區域
        </div>
        <div class="row mb-5">
            <div id="czbooks-block" class="row mb-3">
                <form class="h4" action="crawler/crawler_handle.php" method="POST"><!--@submit.prevent="startCrawler":用來顯示後台運行情況-->
                    <input type="hidden" name="wb_name" value="czbooks">
                    <label for="pageURL" class="form-label">小說狂人</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://czbooks.net/n/</span>
                        <input type="text" class="form-control" id="czbooks-url" name="pageURL" aria-describedby="basic-addon3" required>
                        <input class="input-group-text" type="submit" value="開始爬蟲">
                    </div>
                    <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["permission"] == "owner") { ?>
                        <div class="h6 mt-2 ms-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="yes">
                                <label class="form-check-label" for="addBgm1">
                                    Add BGM
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="no" checked>
                                <label class="form-check-label" for="addBgm2">
                                    Don't add BGM
                                </label>
                            </div>
                        </div>
                    <?php }
                    ?>
                </form>
                <!-- <div v-if="isLoading">
                <div class="loader"></div>
                <p>正在執行中...</p>
            </div>
            <p v-else>{{ status }}</p> --><!--用來顯示後台運行情況-->
            </div>
            <div id="qidian-block" class="row mb-3">
                <form class="h4" action="crawler/crawler_handle.php" method="POST">
                    <input type="hidden" name="wb_name" value="qidian">
                    <label for="pageURL" class="form-label">起點中文網</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://book.qidian.com/info/</span>
                        <input type="text" class="form-control" id="qidian-url" name="pageURL" aria-describedby="basic-addon3" required>
                        <input class="input-group-text" type="submit" value="開始爬蟲">
                    </div>
                    <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["permission"] == "owner") { ?>
                        <div class="h6 mt-2 ms-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="yes">
                                <label class="form-check-label" for="addBgm1">
                                    Add BGM
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="no" checked>
                                <label class="form-check-label" for="addBgm2">
                                    Don't add BGM
                                </label>
                            </div>
                        </div>
                    <?php }
                    ?>
                </form>
            </div>
            <div id="jjwxc-block" class="row mb-3">
                <form class="h4" action="crawler/crawler_handle.php" method="POST">
                    <input type="hidden" name="wb_name" value="jjwxc">
                    <label for="pageURL" class="form-label">晉江文學城</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://www.jjwxc.net/onebook.php?novelid=</span>
                        <input type="text" class="form-control" id="jjwxc-url" name="pageURL" aria-describedby="basic-addon3" required>
                        <input class="input-group-text" type="submit" value="開始爬蟲">
                    </div>
                    <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["permission"] == "owner") { ?>
                        <div class="h6 mt-2 ms-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="yes">
                                <label class="form-check-label" for="addBgm1">
                                    Add BGM
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addBgm" value="no" checked>
                                <label class="form-check-label" for="addBgm2">
                                    Don't add BGM
                                </label>
                            </div>
                        </div>
                    <?php }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <?php include('./core/footer.php') ?>
    </footer>
    <!-- <script src="../scripts/crawler/crawler.js"></script> --><!--用來顯示後台運行情況-->
</body>

</html>
<!-- <style>
    .loader {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style> -->
<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>