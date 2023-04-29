<?php
session_start();
if (!isset($_SESSION["user"])) {
    exit();
}
include("../../core/config.php");

$return_msg = "";

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

$url = "../../index.php";

$data = null;
$dir = null;

if (isset($_POST["image"])) {
    $data = $_POST["image"];

    $dir = "static/images/blog_post/upload/";

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $image_name = "post_" . "_pic_" . time() . ".png";

    file_put_contents($image_name, $data);

    if (!file_exists("../../../" . $dir)) {
        //以数字权限模式创建目录（单级目录）
        mkdir("../../../" . $dir, 0777, true);
    }

    rename($image_name, "../../../" . $dir . $image_name);

    $_SESSION["post"]["upload-post-picture"] = $image_name;
    echo "../$dir$image_name";
}

if (isset($_POST["save-edit-post"])) {
    //INSERT email, name, title, description, create_at upload
    date_default_timezone_set("Asia/Taipei");

    $post_id = $_POST["post-id"];
    $post_pic = $_POST["post-pic"];
    $title = $_POST["post-title"];
    $title = $sql_link->quote($title);
    $description = $_POST["post-description"];
    $description = $sql_link->quote($description);
    $datetime = date("Y-m-d H:i:s");

    if (isset($_SESSION["post"]["upload-post-picture"])) {
        $image_name = $_SESSION["post"]["upload-post-picture"];
        $post_id_image_name = "post_" . "{$post_id}"
            . "_pic_" . time() . ".png";

        $dir_original = "static/images/blog_post/upload/";
        $dir_target = "static/images/blog_post/post/";

        $sql = "UPDATE post SET `picture`='$post_id_image_name', 
                `title`=$title, `description`=$description
                WHERE `id`='$post_id'";

        if ($sql_link->exec($sql)) {
            $return_msg = "Upload successfully";
        } else {
            $return_msg = "Fail to upload post image";
        }

        //remove picture from blog_post/upload/ to blog_post/post/
        rename(
            "../../../" . $dir_original . $image_name,
            "../../../" . $dir_target . $post_id_image_name
        );

        //clear picture in blog_post/upload/
        $files = glob("../../../" . $dir_original . '/*'); //遞迴取得子資料夾 | 檔名不含路徑
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        //clear previous post picture
        $before_edit_pic = "../../../" . $dir_target . $post_pic;
        if (file_exists($before_edit_pic)) {
            unlink($before_edit_pic);
        }

        $url = "../../post_edit/post_edit_handle.php";
    } else {
        $sql = "UPDATE post SET `title`=$title, `description`=$description
                WHERE `id`='$post_id'";

        if ($sql_link->exec($sql)) {
            $return_msg = "Upload successfully";
        } else {
            $return_msg = "Fail to upload post image";
        }
        $url = "../../post_edit/post_edit_handle.php";
    }


?>
    <script>
        window.location.href = '<?= $url ?>';
    </script>
<?php
}
if (isset($_POST["cancel-save"])) {
    $dir = "static/images/blog_post/upload/";
    $files = glob("../../../" . $dir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    } ?>
    <script>
        window.location.href = "<?= $url ?>";
    </script>
<?php
}
if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}
exit(); ?>