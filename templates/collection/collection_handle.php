<?php
include("../core/config.php");
session_start();
// $sql_link = connect('root', '');
if (isset($_SESSION["user"])) {
    $user_uId = $_SESSION["user"]["uId"];
    $sql = "SELECT * FROM `collection` AS c WHERE c.uId=$user_uId";
    $collection_file_rows = get_row($sql, $collection_file_count, $sql_link);

    $sql = "SELECT * 
    FROM `collection` AS c, `keep` AS k,`bookrecord` AS b, `novel` AS n  
    WHERE c.uId=$user_uId AND c.collectId=k.collectId AND k.bId=b.bId AND b.nId=n.nId";
    $novel_rows = get_row($sql, $novel_count, $sql_link);

    $_SESSION["collection_file"] = $collection_file_rows;
    $_SESSION["collection_file_count"] = $collection_file_count;
    $_SESSION["collection_novel"] = $novel_rows;
    $_SESSION["collection_novel_count"] = $novel_count;
?>
    <script>
        window.location.href = '../collection.php';
    </script><?php
            } else {
                ?>
    <script>
        window.location.href = '../index.php';
    </script><?php
            } ?>