<?php

session_start();

if (!isset($_SESSION["user"])) { ?>
<script>
window.location.href = '../../index.php';
</script>
<?php exit();
}

if (!isset($_POST["article-id"])) {
    $_SESSION["show_message"] = "Undefine article id"; ?>
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

$dir = null;
$article_id_image_name = "";

if (isset($_POST["save-edit-article"])) {
    $article_id = $_POST["article-id"];

    $description = str_replace(array("<script>", "</script>"), "", $_POST["edit-article"]);

    $title = $_POST["article-title"];
    $display = $_POST["article-display-edit"];
    $edit_time = date("Y-m-d H:i:s");
    $title = $sql_link->quote($title);

    $url = "../../post_edit/post_edit_handle.php";
    //$articl_id_string = implode("", $_POST["article-id"]);

    if (file_exists($_FILES["upload-article-picture-edit"]["tmp_name"])) {
        $sql = "SELECT * FROM `article` 
            WHERE `id` = '$article_id' 
            ORDER BY `position`";
        $result = $sql_link->query($sql);

        //Deal with image
        if ($result) {
            $row = $result->fetch();
            $for_post_id = $row["id"];

            $file_tmp_name = $_FILES["upload-article-picture-edit"]["tmp_name"];
            $article_id_image_name = "article_" . "{$for_post_id}" . "_" . "{$article_id}"
                . "_" . time() . ".png";
            $dir = "static/images/blog_post/article/";
            if (move_uploaded_file($file_tmp_name, "../../../" . $dir . $article_id_image_name)) {
                $sql = "UPDATE `article`
                        SET `title`=$title, `picture`='$article_id_image_name', `description`='$description', 
                        `display`='$display', `edit_time`='$edit_time'
                        WHERE `id`='$article_id'";

                $edit_article = $sql_link->exec($sql);
            }
            $url = "../../post_edit/post_edit_handle.php";
        } else {
            $url = "../../index.php";
            $return_msg = "Fail to fetch article data from database";
        }
    } else {
        $sql = "UPDATE `article`
            SET `title`=$title, `description`='$description', `display`='$display', `edit_time`='$edit_time'
            WHERE `id`='$article_id'";
        $edit_article = $sql_link->exec($sql);

        if ($edit_article) {
            $url = "../../post_edit/post_edit_handle.php";
        } else {
            $url = "../../index.php";
            $return_msg = "Fail to fetch article data from database";
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