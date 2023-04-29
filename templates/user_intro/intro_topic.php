<?php
session_start();

if ($_SESSION['user_intro']['icon'] != "") {
    $icon = "../static/images/user/icon/".$_SESSION['user_intro']['icon'];
} else {
    $icon = "../static/images/icon/person-circle.svg";
}
?>
<!-- same style with profile-topic -->
<section id="profile-topic" class="topic-content">
    <img src="../static/images/posts/posts1-1.jpg" class="d-block w-100 h-100 img-fluid" alt="圖片無法載入">
    <div class="img-cover"></div>
    <div class="d-block d-xs-none">
        <figure class="figure">
            <img src="<?=$icon?>" alt="mdo" class="rounded-circle mx-auto d-block" height="100px" width="100px">
            <figcaption class="figure-caption mt-4 text-center"><?=$_SESSION["user_intro"]["name"]?></figcaption>
        </figure>
    </div>
</section>