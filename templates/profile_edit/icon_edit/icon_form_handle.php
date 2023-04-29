<?php

session_start();

if (!isset($_SESSION["profile"]) || !isset($_SESSION["user"])) {
    exit();
}

include("../../core/config.php");

$return_msg = "";

if (isset($_POST["icon"])) {
    $data = $_POST["icon"];

    $dir = "static/images/user/upload/";

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $image_name = "user_" . $_SESSION["profile"]["id"]
                . "_icon_" . time() . ".png";

    file_put_contents($image_name, $data);

    if (!file_exists("../../../" . $dir)) {
        mkdir("../../../" . $dir, 0777, true);
    }

    rename($image_name, "../../../" . $dir . $image_name);

    $_SESSION["profile"]["upload-icon"] = $image_name;

    echo '<img src="../' . $dir . $image_name.'" class="img-thumbnail" />';
}

if (isset($_POST["save-image"])) {
    if (isset($_SESSION["profile"]["upload-icon"])) {
        $sql_link = connect('root', '');

        if (!$sql_link) {
            $_SESSION["show_message"] = "Error at connect to database";
            exit();
        }

        $user_id = $_SESSION["profile"]["id"];

        $image_name = $_SESSION["profile"]["upload-icon"];

        $dir_original = "static/images/user/upload/";
        $dir_target = "static/images/user/icon/";

        if ($_SESSION["profile"]["icon"] != "") {
            if (file_exists("../../../" . $dir_target . $_SESSION["profile"]["icon"])) {
                unlink("../../../" . $dir_target . $_SESSION["profile"]["icon"]);
            }
        }

        $sql = "UPDATE `user` 
            SET `icon`='$image_name'
            WHERE `id`='$user_id'";

        if ($sql_link->exec($sql)) {
            $_SESSION["user"]["icon"] = $image_name;
            $return_msg = "Upload successfully";
        } else {
            $return_msg = "Fail to upload icon";
        }

        rename(
            "../../../" . $dir_original . $image_name,
            "../../../" . $dir_target . $image_name
        );

        $files = glob("../../../" . $dir_original . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
    ?>
<script>
window.location.href = "../profile_edit_handle.php";
</script>
<?php
}

if (isset($_POST["cancel-save"])) {
    $dir = "static/images/user/upload/";

    $files = glob("../../../" . $dir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    } ?>
<script>
window.location.href = "../profile_edit_handle.php";
</script>
<?php
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}

exit();
?>