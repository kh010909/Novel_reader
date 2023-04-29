<?php
session_start();
include "../../core/config.php";

$return_msg = "";
$sql_link = connect("root", "");

if (isset($_POST["post_id"])) {
    $post_id = $_POST["post_id"];
    $post_pic = $_POST["post_pic"];

    //delete post data in db
    $sql = "DELETE FROM `post`
                 WHERE `id`='$post_id'";
    if (!$sql_link->exec($sql)) {
        $return_msg = "Your data hasn't been cleared";
        exit();
    }

    //clean post picture in folder
    if ($post_pic != "") {
        $post_pic_file = "../../../static/images/blog_post/post/" . $post_pic;
        if (file_exists($post_pic_file)) {
            unlink($post_pic_file);
        }
    }

    //query article data: picture name
    $sql = "SELECT * FROM `article` 
            WHERE `for_post` = '$post_id'";
    $article = $sql_link->query($sql);
    $article_rowCount = $article->rowCount();
    $articles = $article->fetchAll();

    //delete related article data
    if ($article_rowCount > 0) {
        //delete articles data in db
        $sql = "DELETE FROM `article`
                    WHERE `for_post`='$post_id'";
        if (!$sql_link->exec($sql)) {
            $return_msg = "Your data hasn't been cleared";
            exit();
        }

        //delete articles picture in filder
        foreach ($articles as $article) {
            $article_pic_file = "../../../static/images/blog_post/article/" . $article["picture"];
            if (file_exists($article_pic_file)) {
                unlink($article_pic_file);
            }
        }
    }
    $return_msg = "Delete post successfully !";
} else {
    $return_msg = "Have not get the post id";
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
} ?>
<script>
    window.location.href = "../../index.php";
</script>
<?php

exit();
?>