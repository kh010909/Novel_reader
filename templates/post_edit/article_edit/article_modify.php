<?php

session_start();

include "../../core/config.php";

$sql_link = connect("root", "");

$position = $_POST["position"];
$post = $_POST["for_post"];
$article_pic = $_POST["article_pic"];

$sql = "SELECT * FROM `article` 
        WHERE `for_post` = '$post'";

$result = $sql_link->query($sql);
$rowcount = $result->rowCount();

$return_msg = "";

if (isset($_POST["delete"])) {
    $sql = "DELETE FROM `article` 
            WHERE `position` = '$position' 
            AND `for_post` = '$post'";

    $sql_link->exec($sql);

    for ($i = $position; $i < $rowcount; $i++) {
        $new_position = $i + 1;
        $sql = "UPDATE `article` 
                SET `position` = '$i' 
                WHERE `for_post` = '$post' 
                AND `position` = '$new_position'";

        $sql_link->exec($sql);
    }

    //clean article picture in file
    if ($article_pic != "") {
        $article_pic_file = "../../../static/images/blog_post/article/" . $article_pic;
        if (file_exists($article_pic_file)) {
            unlink($article_pic_file);
        }
    }

    $return_msg = "Complete";
} elseif (isset($_POST["move_up"])) {
    if ($position == 1) {
        $return_msg = "This article already at top";
    } else {
        $sql = "SELECT * FROM `article` 
                WHERE `position` = '$position' 
                AND `for_post` = '$post'";

        $result = $sql_link->query($sql);
        $row = $result->fetch();

        $temp = $row['id'];

        $new_position = $position - 1;
        $sql = "UPDATE `article` 
                SET `position` = '$position' 
                WHERE `for_post` = '$post' 
                AND `position` = '$new_position'";

        $sql_link->exec($sql);

        $sql = "UPDATE `article` 
                SET `position` = '$new_position' 
                WHERE `for_post` = '$post' 
                AND `id` = '$temp'";

        $sql_link->exec($sql);

        $return_msg = "Complete";
    }
} elseif (isset($_POST["move_down"])) {
    if ($position == $rowcount) {
        $return_msg = "This article already at bottom";
    } else {
        $sql = "SELECT * FROM `article` 
                WHERE `position` = '$position' 
                AND `for_post` = '$post'";

        $result = $sql_link->query($sql);
        $row = $result->fetch();

        $temp = $row['id'];

        $new_position = $position + 1;

        $sql = "UPDATE `article` 
                SET `position` = '$position' 
                WHERE `for_post` = '$post' 
                AND `position` = '$new_position'";

        $sql_link->exec($sql);

        $sql = "UPDATE `article` 
                SET `position` = '$new_position' 
                WHERE `for_post` = '$post' 
                AND `id` = '$temp'";

        $sql_link->exec($sql);

        $return_msg = "Complete.";
    }
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
} ?>
<script>
    window.location.href = "../post_edit_handle.php";
</script>
<?php

exit();
?>