<?php
include('../core/config.php');
session_start();
if (isset($_GET['nId']) & isset($_GET['chapter'])) {
    $id = $_GET['nId'];
    $chapter = $_GET['chapter'];
    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"]["uId"];
        //if there is no record
        $sql = "SELECT * FROM `bookrecord` WHERE `nId` = $id AND `uId` = $user_id";
        $temp = get_row($sql, $count, $sql_link);
        //there's no record
        if ($count == 0) {
            $sql = "INSERT INTO `bookrecord` VALUES (NULL,$id,$user_id,0,$chapter,'watch')";
            $temp = $sql_link->query($sql);
        }
        //else: update record
        else {
            $sql = "UPDATE `bookrecord` SET `currCh` = $chapter WHERE `nId` = $id AND `uId` = $user_id";
            $temp = $sql_link->query($sql);
        }
    } else {
        $user_id = 0;
    }
    $sql = "SELECT * FROM `article` WHERE `nId` = $id AND `aChapter` = $chapter";
    $article_row = get_row($sql, $articlecount, $sql_link);
    $article_row[0]['aContent']; // = strip_tags($article_row[0]['aContent'], '<br>');
    $sql = "SELECT * FROM `article` WHERE `nId` = $id";
    $article_rows = get_row($sql, $totalarticlecount, $sql_link);
    $_SESSION['article_content'] = $article_row;
    $_SESSION['totalarticlecount'] = $totalarticlecount;
    $_SESSION['chapter'] = $chapter;
    $_SESSION['id'] = $id;

?>
    <script>
        window.location.href = '../article.php';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>