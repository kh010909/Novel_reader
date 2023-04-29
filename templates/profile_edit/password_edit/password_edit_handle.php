<?php

include("../../core/config.php");
session_start();

$return_msg = "";

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

if (!isset($_SESSION["user"])) {
    $_SESSION["show_message"] = "Please login first";
    exit();
} elseif (@$_POST) {
    $password = $_POST["password"];
    $password_new = $_POST["password-new"];
    $password_confirm = $_POST["password-confirm"];

    $email = $_SESSION["user"]["email"];
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = $sql_link->query($sql);

    if ($result) {
        $num = $result->rowCount();
        if ($num == 0) {
            $return_msg = "Can not find membership for this user";
        } else {
            $row = $result->fetch();
            if ($row["password"] == $password) {
                if ($password_new == $password_confirm) {
                    $user_email = $_SESSION["user"]["email"];

                    $sql = "UPDATE `user` 
                            SET `password`='$password_new'
                            WHERE `email`='$user_email'";

                    if ($sql_link->exec($sql)) {
                        $return_msg = "Update successfully";
                    } else {
                        $return_msg = "Fail to update name";
                    }
                } else {
                    $return_msg = "New password are not confirm the same";
                }
            } else {
                $return_msg = "Orignal password is incorrect";
            }
        }
    } else {
        $return_msg = "Password or email is incorrect";
    }
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}

?>
<script>
window.location.href = '../../profile_edit.php';
</script>

<?php exit(); ?>