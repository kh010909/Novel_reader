<?php
session_start();
include("../core/config.php");

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $nId = $_POST["nId"];
    if (isset($_SESSION["user"])) {

        if ($_SESSION["user"]["name"] == $_POST["comment_name"]) {

            $comment_id = $_POST["comment_id"];
            $sql_del_comment = "DELETE FROM `comment` WHERE `cNumber` = '$comment_id'";
            $sql_link->query($sql_del_comment);
        } else {
            header("Location: ../novel/novel_handle.php?nId=$nId");
            exit();
        }
    } else {
        header("Location: ../novel/novel_handle.php?nId=$nId");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
header("Location: ../novel/novel_handle.php?nId=$nId");
exit();
