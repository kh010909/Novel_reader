<?php
session_start();
include("../core/config.php");
if(isset($_SESSION["user_intro_id"])){
    $intro_id = $_SESSION["user_intro_id"];
}
else{
    header("Location: ../index.php");
}

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}
$sql = "SELECT * FROM `user` WHERE `id` = '$intro_id'";
$result = $sql_link->query($sql);
$row = $result->rowCount();
if ($row < 1) {
    header("Location: ../index.php");
    exit();
} 
else {
    $row = $result->fetch();
    $_SESSION["user_intro"] = [
                            "id" => $row["id"],
                            "name" => $row["name"],
                            "email" => $row["email"],
                            "icon" => $row["icon"],
                            "about" => $row["about"],
                            "permission" => $row["permission"],
                            "create_at" => $row["create_at"]];
                            
    $email = $_SESSION["user_intro"]["email"];
    $sql_post = "SELECT * FROM `post` WHERE `email` = '$email'";
    $presult = $sql_link->query($sql_post);
    $_SESSION["user_intro_post"] = $presult->fetchall();
    $_SESSION["user_intro_prow"] = $presult->rowCount();

    if(isset($_SESSION["user"]["name"])){
        if($_SESSION["user_intro"]["name"] == $_SESSION["user"]["name"]){
            header("Location: ../profile/profile_handle.php");
        }
        else{
            header("Location: ../user_intro.php?user_intro_id=$intro_id");
        }
    }
    else{
        header("Location: ../user_intro.php?user_intro_id=$intro_id");
    }
    exit();
}
?>