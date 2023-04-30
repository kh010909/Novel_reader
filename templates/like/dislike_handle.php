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
        $sql = "INSERT INTO `bookrecord` VALUES (NULL,$id,$user_id,0,0,'hate')";
        $temp = $sql_link->query($sql);
    }
    //else: update record
    else {
        $prefer = $temp[0]['preference'];

        if ($prefer == 'hate') {
            $prefer = 'watch';
            $prefer = $sql_link->quote($prefer);
            $sql = "UPDATE `bookrecord` SET `preference` = $prefer WHERE `nId` = $id AND `uId` = $user_id";
            $temp = $sql_link->query($sql);
        } else if ($prefer == 'watch') {
            $prefer = 'hate';
            $prefer = $sql_link->quote($prefer);
            $sql = "UPDATE `bookrecord` SET `preference` = $prefer WHERE `nId` = $id AND `uId` = $user_id";
            $temp = $sql_link->query($sql);
        }
    } ?>
    <script>
        window.location.href = '../novel/novel_handle.php?nId=<?= $id ?>';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>