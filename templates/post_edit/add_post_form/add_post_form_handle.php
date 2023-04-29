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
        mkdir("../../../" . $dir, 0777, true);
    }

    rename($image_name, "../../../" . $dir . $image_name);

    $_SESSION["post"]["upload-post-picture"] = $image_name;
    echo '<img src="../' . $dir . $image_name . '" class="img-fluid" />';
}

if (isset($_POST["save-add-post"])) {
    //INSERT email, name, title, description, create_at upload
    date_default_timezone_set("Asia/Taipei");

    $email = $_SESSION['user']['email'];
    $title = $_POST["title"];
    $title = $sql_link->quote($title);
    $description = $_POST["description"];
    $description = $sql_link->quote($description);
    $datetime = date("Y-m-d H:i:s");

    $image_name = $_SESSION["post"]["upload-post-picture"];

    $add_post = $sql_link->exec("INSERT INTO post(email, picture, title, description, create_at) 
                                 VALUES('$email', '$image_name',$title, $description, '$datetime')");

    $sql = "SELECT id FROM post WHERE picture='$image_name'";

    $result = $sql_link->query($sql);

    if ($result) {
        $row = $result->fetch();
        $post_id = $row["id"];
        $_SESSION["post"]["id"] = $row["id"];

        if (isset($_SESSION["post"]["upload-post-picture"])) {
            $post_id_image_name = "post_" . "{$post_id}"
                . "_pic_" . time() . ".png";

            $dir_original = "static/images/blog_post/upload/";
            $dir_target = "static/images/blog_post/post/";

            $sql = "UPDATE `post` 
            SET `picture`='$post_id_image_name'
            WHERE `id`='$post_id'";

            if ($sql_link->exec($sql)) {
                $_SESSION["post"]["picture"] = $image_name;
                $return_msg = "Upload successfully";
            } else {
                $return_msg = "Fail to upload post image";
            }

            rename(
                "../../../" . $dir_original . $image_name,
                "../../../" . $dir_target . $post_id_image_name
            );

            $files = glob("../../../" . $dir_original . '/*'); //遞迴取得子資料夾 | 檔名不含路徑
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            $url = "../../post_edit/post_edit_handle.php";
        }
    } else {
        $url = "../../index.php";
        $return_msg = "Fail to fetch post data from database";
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

exit();
?>