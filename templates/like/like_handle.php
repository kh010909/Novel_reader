<?php
include('../core/config.php');
session_start();
if (isset($_GET['nId'])) {
    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"]["uId"];
    } else {
        $user_id = 0;
    }
    $id = $_GET['nId'];
    $sql = "SELECT * FROM `bookrecord` WHERE `nId` = $id AND `uId` = $user_id";
    $temp = get_row($sql, $count, $sql_link);
    //there's no record
    if ($count == 0) {
        $sql = "INSERT INTO `bookrecord` VALUES (NULL,$id,1,1,0,'watch')";
        $temp = $sql_link->query($sql);
    }
    //else: update record
    else {
        $like = $temp[0]['bLike'];
        if ($like == 0) {
            $like = 1;
        } else {
            $like = 0;
        }
        $sql = "UPDATE `bookrecord` SET `bLike` = $like WHERE `nId` = $id AND `uId` = 1";
        $temp = $sql_link->query($sql);
    } ?>
    <script>
        window.location.href = '../novel/novel_handle.php?nId=<?= $id ?>';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>