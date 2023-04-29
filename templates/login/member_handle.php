<?php
include("../core/config.php");
session_start();
$return_msg = "";

// $sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

// Validate the data from https://www.w3schools.com/php/php_form_complete.asp
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (@$_POST) { //@: 抑制錯誤診斷和訊息
    $name = $_POST["name"];
    $password = $_POST["password"];
}


if (@$_GET["method"] == "logout") {
    $return_msg = "Logout successfully";
    unset($_SESSION["user"]);
    unset($_SESSION["profile"]);
    // unset($_SESSION["post"]);
    unset($_SESSION["user_intro"]);
}

if (@$_POST["method"] == "login") {
    $name = $sql_link->quote($_POST["name"]);
    $sql = "SELECT * FROM `user` WHERE `name` = $name";
    $result = $sql_link->query($sql);

    if ($result) {
        $num = $result->rowCount();
        if ($num == 0) {
            $return_msg = "Can not find membership for this user";
        } else {
            $row = $result->fetch();

            if ($row["password"] == $password) {
                // 將會員名稱存入session
                $_SESSION["user"] = [
                    "name" => $row["name"],
                    "email" => $row["email"],
                    "permission" => $row["permission"],
                    "uId" => $row["uId"]
                ];
                $return_msg = "Login successfully";
            } else {
                $return_msg = "Password or Name is incorrect";
            }
        }
    } else {
        $return_msg = "Fail to fetch data from database";
    }
} elseif (@$_POST["method"] == "signup") {
    $email = test_input($_POST["email"]);
    $name = test_input($_POST["name"]);
    $name = $sql_link->quote($name);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $return_msg = "Invalid Email format";
    } else {
        $sql = "SELECT * FROM `user` WHERE `name` = $name";
        $result = $sql_link->query($sql);

        if ($result) {
            $num = $result->rowCount();
            if ($num == 0) {
                // date_default_timezone_set('Asia/Taipei');
                // $current_time = date('Y-m-d h:i:s');
                // $name = $sql_link->quote($name);
                $password = $sql_link->quote($password);
                $permission = "user";
                $sql = "INSERT INTO user (name, password, email, permission) 
                        VALUES ($name, $password, '$email', '$permission')";

                if ($sql_link->exec($sql)) {
                    $return_msg = "Sign up successfully";
                    // 將會員名稱存入session
                    $_SESSION["user"] = [
                        "name" => $name,
                        "email" => $email,
                        "permission" => $permission
                    ];
                } else {
                    $return_msg = "Fail to write data to database";
                }
            } else {
                $return_msg = "This user name have already sign up, please use other name";
            }
        } else {
            $return_msg = "Fail to fetch data from database";
        }
    }
}

if (isset($_SESSION["last_url"])) {
    $url = $_SESSION["last_url"];
} else {
    $url = "../index.php";
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}

?>
<script>
    window.location.href = '<?= $url ?>';
</script>

<?php exit(); ?>