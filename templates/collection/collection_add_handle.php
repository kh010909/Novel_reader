<?php
include('../core/config.php');
session_start();
if (isset($_POST['nId'])) {
    if (isset($_SESSION["user"])) {
        $id = $_POST['nId'];
        $collect_id = $_POST['collectId'];
        $user_id = $_SESSION["user"]['uId'];
        $sql = "SELECT * FROM `bookrecord` WHERE `uId` = $user_id AND nId = $id";
        $temp = get_row($sql, $count, $sql_link);
        if ($count == 0) {
            $sql = "INSERT INTO `bookrecord` VALUES (NULL,$id,$user_id,0,0,'watch')";
            $temp = $sql_link->query($sql);
            $sql = "SELECT * FROM `bookrecord` WHERE `uId` = $user_id AND nId = $id";
            $temp = get_row($sql, $count, $sql_link);
        }
        $bId = $temp[0]['bId'];
        $sql = "SELECT * FROM `keep` WHERE `uId` = $user_id AND collectId = $collect_id AND nId = $id";
        $temp = get_row($sql, $count, $sql_link);
        if ($count == 0) {
            $sql = "INSERT INTO `keep` VALUES ($bId,$collect_id,$id,$user_id)";
            $temp = $sql_link->query($sql);
        } else {
            $sql = "DELETE FROM `keep` WHERE `uId` = $user_id AND collectId = $collect_id AND nId = $id";
            $temp = $sql_link->query($sql);
        }
    }
    if (isset($_POST['inside'])) { ?>
        <script>
            window.location.href = '../collection.php';
        </script>
    <?php }
    ?>
    <script>
        window.location.href = '../novel/novel_handle.php?nId=<?= $id ?>';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>