<?php
session_start();
if (isset($_GET["user"])) {
    $_SESSION["user_intro_id"]=$_GET["user"];
    header("Location: ../user_intro/intro_handle.php");
    exit();
} elseif (isset($_GET["post"])) {
    $_SESSION["post"]["id"]=$_GET["post"];
    print($_SESSION["post"]["id"]);
    header("Location: ../post/post_handle.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
<?php exit(); ?>