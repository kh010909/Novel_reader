<?php
//add a completely new collection
include('../core/config.php');
session_start();
if (isset($_POST['nId'])) {
    if (isset($_SESSION["user"])) {
        $id = $_POST['nId'];
        $collection = $_POST['collection'];
        $collection = $sql_link->quote($collection);
        $user_id = $_SESSION["user"]['uId'];
        $sql = "SELECT * FROM `collection` WHERE `uId` = $user_id AND collectName = $collection";
        $temp = get_row($sql, $count, $sql_link);
        if ($count == 0) {
            $sql = "INSERT INTO `collection` VALUES (NULL,$collection,$user_id)";
            $temp = $sql_link->query($sql);
        }
    }
?>
    <script>
        window.location.href = '../novel/novel_handle.php?nId=<?= $id ?>';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>