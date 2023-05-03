<?php
include('../core/config.php');
session_start();
if (isset($_GET['nId'])) {
    $id = $_GET['nId'];
    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"]["uId"];
    } else {
        $user_id = 0;
    }

    //novel
    $sql = "SELECT * FROM `novel` WHERE `nId` = $id";
    $novel_row = get_row($sql, $novelcount, $sql_link);
    $i = 0;
    $novel_row[$i]["description"] = strip_tags($novel_row[$i]["description"], '<br>');
    //article
    $sql = "SELECT * FROM `article` WHERE `nId` = $id ORDER BY aChapter";
    $article_rows = get_row($sql, $articlecount, $sql_link);
    //tags
    $sql = "SELECT `tag` FROM `tag` WHERE `nId` = $id";
    $tag_rows = get_row($sql, $tagcount, $sql_link);
    //record
    $sql = "SELECT * FROM `bookrecord` WHERE `nId` = $id AND `uId` = $user_id";
    $record_row = get_row($sql, $recordcount, $sql_link);
    $sql = "SELECT c.*,u.name FROM `comment` AS c NATURAL JOIN `user` AS u WHERE `nId` = $id ORDER BY c.cNumber ";
    $comment_rows = get_row($sql, $commentcount, $sql_link);
    $sql = "SELECT * FROM `collection` WHERE `uId` = $user_id";
    $collection_rows = get_row($sql, $collectioncount, $sql_link);
    $sql = "SELECT * FROM `collection` AS c, `keep` AS k, `bookrecord` AS b WHERE c.uId = $user_id AND b.nId=$id AND c.collectId=k.collectId AND k.bId=b.Bid";
    $collection_novel_rows = get_row($sql, $collectionNovelCount, $sql_link);


    $_SESSION['novel'] = $novel_row;
    $_SESSION['article'] = $article_rows;
    $_SESSION['tag'] = $tag_rows;
    $_SESSION['comment'] = $comment_rows;
    $_SESSION['record'] = $record_row;
    $_SESSION['commentcount'] = $commentcount;
    $_SESSION['tagcount'] = $tagcount;
    $_SESSION['articlecount'] = $articlecount;
    $_SESSION['collection'] = $collection_rows;
    $_SESSION['collectioncount'] = $collectioncount;
    $_SESSION['collection_novel'] = $collection_novel_rows;
    $_SESSION['collection_novel_count'] = $collectionNovelCount;
?>
    <script>
        window.location.href = '../novel.php';
    </script>
<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>