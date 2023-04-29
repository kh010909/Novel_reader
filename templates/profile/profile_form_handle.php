<?php

session_start();

if (!isset($_SESSION["profile"]) || !isset($_SESSION["user"])) {
    exit();
}

//include("../core/config.php");

$return_msg = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function logout()
{
    unset($_SESSION["user"]);
    unset($_SESSION["profile"]);
}

if (isset($_POST["save-profile"])) { //press submit button

    if (!$sql_link) { //whether connect DB
        $_SESSION["show_message"] = "Error at connect to database";
        exit();
    }

    $uId = $_SESSION["profile"]["uId"];
    if (!empty($_POST["password"]) && !empty($_POST["password-new"]) && !empty($_POST["password-confirm"])) { //change user name
        $password = $_POST["password"];
        $password_new = $_POST["password-new"];
        $password_confirm = $_POST["password-confirm"];

        $sql = "SELECT * FROM `user` WHERE `uId` = '$uId'"; //get old password
        $result = $sql_link->query($sql);
        if ($result) {
            $num = $result->rowCount();
            if ($num == 0) {
                $return_msg = "Can not find membership for this user";
            } else {
                $row = $result->fetch();
                if ($row["password"] == $password) { //whether old password=input password
                    if ($password_new == $password_confirm) { //whether new password=confirm password
                        $name = test_input($_POST["name"]);
                        $email = test_input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $return_msg = "Invalid Email format";
                        } else {
                            $email = $sql_link->quote($_POST["email"]);
                            $password_new = $sql_link->quote($password_new);
                            if ($_SESSION["profile"]["name"] != $name) { //did not change user name
                                $name = $sql_link->quote($name);
                                $sql = "UPDATE `user` 
                                    SET `name`=$name, `email`=$email, `password`=$password_new
                                    WHERE `uId`='$uId' AND NOT EXISTS(SELECT * FROM `user` WHERE `name` = $name)";
                                if ($sql_link->exec($sql)) {
                                    $return_msg = "Update successfully! Please log in again";
                                    logout();
                                } else {
                                    $return_msg = "This user name have already sign up, please use other name";
                                }
                            } else {
                                $sql = "UPDATE `user` 
                                    SET `email`=$email, `password`=$password_new
                                    WHERE `uId`='$uId'";
                                if ($sql_link->exec($sql)) {
                                    $return_msg = "Update successfully! Please log in again";
                                    logout();
                                } else {
                                    $return_msg = "Update failed";
                                }
                            }
                        }
                    } else {
                        $return_msg = "New password are not confirm the same";
                    }
                } else {
                    $return_msg = "Orignal password is incorrect";
                }
            }
        } else {
            $return_msg = "Fail to fetch data from database";
        }
    } else if (empty($_POST["password"]) && empty($_POST["password-new"]) && empty($_POST["password-confirm"])) { //did not change password
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return_msg = "Invalid Email format";
        } else {
            $email = $sql_link->quote($_POST["email"]);
            if ($_SESSION["profile"]["name"] != $name) {
                $name = $sql_link->quote($name);
                $sql = "UPDATE `user` 
                    SET `name`=$name, `email`=$email
                    WHERE `uId`='$uId' AND NOT EXISTS(SELECT * FROM `user` WHERE `name` = $name)";
                if ($sql_link->exec($sql)) {
                    $return_msg = "Update successfully! Please log in again";
                    logout();
                } else {
                    $return_msg = "This user name have already sign up, please use other name";
                }
            } else {
                $sql = "UPDATE `user` 
                    SET `email`=$email
                    WHERE `uId`='$uId'";
                if ($sql_link->exec($sql)) {
                    $return_msg = "Update successfully! Please log in again";
                    logout();
                } else {
                    $return_msg = "Update failed";
                }
            }
        }
    } else {
        $return_msg = "Your password is not complete";
    }
    if ($return_msg != "") {
        $_SESSION["show_message"] = $return_msg;
    }

?>
    <script>
        window.location.href = "../index.php";
    </script>
<?php
}
