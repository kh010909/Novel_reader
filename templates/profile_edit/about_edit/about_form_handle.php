<?php

session_start();

if (!isset($_SESSION["profile"]) || !isset($_SESSION["user"])) {
    exit();
}

include("../../core/config.php");

$return_msg = "";

if (isset($_POST["save-about"])) {
    $sql_link = connect('root', '');

    if (!$sql_link) {
        $_SESSION["show_message"] = "Error at connect to database";
        exit();
    }

    $user_id = $_SESSION["profile"]["id"];

    $text = $_POST["about-article"];

    $text = str_replace(array("<script>","</script>"), "", $text);

    $sql = "UPDATE `user`
    SET `about`='$text'
    WHERE `id`='$user_id'";

    if ($sql_link->exec($sql)) {
        $_SESSION["user"]["about"] = $text;
        $return_msg = "Update successfully";
    } else {
        $return_msg = "Fail to update about";
    }
    ?>
<script>
window.location.href = "../profile_edit_handle.php";
</script>
<?php
}