<?php
//cannot change page
include("../core/config.php");
if (!isset($_SESSION["post"]["id"])) {
    header("Location: ../index.php");
    exit();
}
$post_id = $_SESSION["post"]["id"];
$sql_comment =  "SELECT c.*,u.name, u.icon FROM comment AS c JOIN user AS u ON c.email = u.email WHERE post_id = '$post_id' ORDER BY c.id";
$sql_link = connect('root', '');
$rows = $sql_link->query($sql_comment);
$rowcount_comment = $rows->rowCount();
$result_comment = $rows->fetchall(PDO::FETCH_ASSOC);
?>