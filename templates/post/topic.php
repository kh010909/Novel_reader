<?php
session_start();
$title = $_SESSION["post"]["title"];
$picture = $_SESSION["post"]["picture"];
?>
<section id="posts-topic" class="topic-content">
    <img src="../static/images/blog_post/post/<?= $picture ?>" class="d-block w-100 h-100 img-fluid" alt="圖片無法載入">
    <div class="d-block d-xs-none">
        <h3><?= $title ?></h3>
    </div>
</section>