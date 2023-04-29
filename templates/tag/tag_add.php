<?php
include('../core/config.php');
session_start();
if (isset($_POST['nId'])) {
    if (isset($_SESSION["user"])) {
        $id = $_POST['nId'];
        $tag = $_POST['tag'];
        $tag = $sql_link->quote($tag);
        $sql = "INSERT INTO `tag` SELECT $id,$tag FROM DUAL WHERE NOT EXISTS(SELECT nId,tag FROM `tag` WHERE nId = $id AND tag = $tag)";
        $temp = $sql_link->query($sql);
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