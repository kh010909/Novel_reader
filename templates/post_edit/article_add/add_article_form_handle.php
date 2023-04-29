<?php

session_start();

if (!isset($_SESSION["user"])) { ?>
    <script>
        window.location.href = '../../index.php';
    </script>
<?php exit();
}

if (!isset($_SESSION["post"]["id"])) {
    $_SESSION["show_message"] = "Undefine post id"; ?>
    <script>
        window.location.href = '../../index.php';
    </script>
<?php exit();
}

include("../../core/config.php");

$return_msg = "";

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

$url = "../../index.php";
date_default_timezone_set("Asia/Taipei");

$data = null;
$dir = null;
$image_name = "";

if (file_exists($_FILES["upload-article-picture"]["tmp_name"])) {
    $tmp_name = $_FILES["upload-article-picture"]["tmp_name"];

    $dir = "static/images/blog_post/upload/";

    if (!file_exists("../../../" . $dir)) {
        mkdir("../../../" . $dir, 0777, true);
    }

    $image_name = "article_" . "_pic_" . time() . ".png";

    move_uploaded_file(
        $_FILES["upload-article-picture"]["tmp_name"],
        "../../../" . $dir . $image_name
    );

    $_SESSION["article"]["upload-article-picture"] = $image_name;
}

if (isset($_POST["save-add-article"])) {
    $for_post_id = $_SESSION["post"]["id"];

    $sql = "SELECT * FROM `article` 
            WHERE `for_post` = '$for_post_id' 
            ORDER BY `position`";

    $article_result = $sql_link->query($sql);
    $rowCount = $article_result->rowCount();
    $position = $rowCount + 1;

    $title = $_POST["article-title"];
    $title = $sql_link->quote($title);

    if (isset($_SESSION["article"]["upload-article-picture"])) {
        $image_name = $_SESSION["article"]["upload-article-picture"];
    }

    $description = str_replace(array("<script>", "</script>"), "", $_POST["add-article"]);

    $display = $_POST["article-display"];
    $edit_time = date("Y-m-d H:i:s");

    $sql = "INSERT INTO article(for_post, position, title, 
                                picture, description, 
                                display, edit_time) 
            VALUES ($for_post_id, $position,$title, 
                   '$image_name','$description', 
                   '$display', '$edit_time')";

    $add_post = $sql_link->exec($sql);

    $url = "../../post_edit/post_edit_handle.php";

    if ($image_name != "") {
        $sql = "SELECT id FROM article 
            WHERE picture='$image_name'";

        $result = $sql_link->query($sql);

        if ($result) {
            $row = $result->fetch();
            $article_id = $row["id"];
            $_SESSION["article"]["id"] = $row["id"];

            if (isset($_SESSION["article"]["upload-article-picture"])) {
                $article_id_image_name = "article_" . "{$for_post_id}" . "_" . "{$article_id}"
                    . "_" . time() . ".png";

                $dir_original = "static/images/blog_post/upload/";
                $dir_target = "static/images/blog_post/article/";

                $sql = "UPDATE `article` 
            SET `picture`='$article_id_image_name'
            WHERE `id`='$article_id'";

                if ($sql_link->exec($sql)) {
                    $_SESSION["article"]["picture"] = $article_id_image_name;
                    $return_msg = "Upload successfully";
                } else {
                    $return_msg = "Fail to upload post image";
                }

                rename(
                    "../../../" . $dir_original . $image_name,
                    "../../../" . $dir_target . $article_id_image_name
                );

                $files = glob("../../../" . $dir_original . '/*'); //遞迴取得子資料夾 | 檔名不含路徑
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            }

            $url = "../../post_edit/post_edit_handle.php";
        } else {
            $url = "../../index.php";
            $return_msg = "Fail to fetch post data from database";
        }
    }

    if ($return_msg != "") {
        $_SESSION["show_message"] = $return_msg;
    } ?>
    <script>
        window.location.href = '<?= $url ?>';
    </script>
<?php }

exit(); ?>