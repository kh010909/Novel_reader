<?php
include './core/config.php';

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

$sql = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 5";

$result = $sql_link->query($sql);
?>

<section id="index-post" class="accordion container p-5">
    <h2 class="pb-4 mb-4 fst-italic border-bottom fs-2 fw-bold">
        Explore
    </h2>

    <div class="container g-0 text-center img-container">
        <div class="img-hov d-flex">
            <form action="./post/post_handle.php" method="GET"
                class="post-list row justify-content-md-center bg-secondary">
                <?php if ($result->rowCount() > 0) {
                    while ($row = $result->fetch()) {
                        $post_id = $row['id']; ?>
                <button type="submit" class="img-hov-item col-md-6 g-0" name="id" value="<?=$row["id"]?>">
                    <img src="../static/images/blog_post/post/<?=$row["picture"]?>" class="d-block img-fluid"
                        alt="圖片無法載入">
                    <div class="img-hov-cover"></div>
                    <figcaption class="img-hov-text">
                        <h3><?=$row["title"]?></h3>
                        <p><?=$row["description"]?></p>
                    </figcaption>
                </button>
                <?php } ?>
                <div class="show-more-main bg-light" id="show-more-main<?=$post_id?>">
                    <span id="<?=$post_id?>" class="show-more rounded-3" title="Load more posts">
                        <h3>Show more</h3>
                    </span>
                    <span class="loading rounded-3" style="display: none;">
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>
</section>