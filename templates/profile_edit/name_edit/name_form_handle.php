<?php

session_start();

if (!isset($_SESSION["profile"]) || !isset($_SESSION["user"])) {
    exit();
}

include("../../core/config.php");

$return_msg = "";

if (isset($_POST["save-name"])) {
    $sql_link = connect('root', '');

    if (!$sql_link) {
        $_SESSION["show_message"] = "Error at connect to database";
        exit();
    }

    $user_id = $_SESSION["profile"]["id"];

    $name = $_POST["name-input"];
    $name = $sql_link->quote($name);

    $sql = "UPDATE `user` 
            SET `name`=$name
            WHERE `id`='$user_id'";

    if ($sql_link->exec($sql)) {
        $_SESSION["user"]["name"] = $name;
        $return_msg = "Update successfully";
    } else {
        $return_msg = "Fail to update name";
    }
?>
    <script>
        window.location.href = "../profile_edit_handle.php";
    </script>
<?php
}
