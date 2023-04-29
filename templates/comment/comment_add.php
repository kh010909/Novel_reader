<?php

session_start();
include("../core/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $return_msg = "";
    $id = $_POST["nId"];
    $user_id = $_SESSION["user"]["uId"];
    $comment = $sql_link->quote($_POST["comment_content"]);

    //insert the data to db
    if (!empty($_POST["comment_content"])) {
        $sql = "INSERT INTO comment (`nId`,`cNumber`, `uId`, `cContent`) VALUES ($id,NULL,$user_id, $comment)";
        $sql_link->query($sql);
    } else {
        $return_msg = "Please Enter Something first";
        header("Location: ../novel/novel_handle.php?nId=$id");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}
header("Location: ../novel/novel_handle.php?nId=$id");
exit();
