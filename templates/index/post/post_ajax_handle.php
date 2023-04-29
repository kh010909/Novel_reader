<?php
if (@$_POST["id"]) {
    session_start();

    include("../../core/config.php");

    $return_msg = "";
    $show_limit = 2;

    $sql_link = connect('root', '');

    if (!$sql_link) {
        $_SESSION["show_message"] = "Error at connect to database";
        exit();
    }

    $fetch_id = $_POST['id'];

    $sql = "SELECT * FROM post
            WHERE `id` < '$fetch_id' 
            ORDER BY `id` DESC";

    $result = $sql_link->query($sql);

    if ($result) {
        $total_row_count = $result->rowCount();
    }

    $sql = "SELECT * FROM post 
            WHERE `id` < '$fetch_id' 
            ORDER BY `id` DESC 
            LIMIT " . $show_limit;

    $result = $sql_link->query($sql);

    if ($result) {
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $post_id = $row['id']; ?>

<button type="submit" class="img-hov-item col-md-6 g-0" name="id" value="<?=$row["id"]?>">
    <img src="../static/images/blog_post/post/<?=$row["picture"]?>" class="d-block img-fluid" alt="圖片無法載入">
    <div class="img-hov-cover"></div>
    <figcaption class="img-hov-text">
        <h3><?=$row["title"]?></h3>
        <p><?=$row["description"]?></p>
    </figcaption>
</button>

<?php } ?>
<?php if ($total_row_count > $show_limit) { ?>
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
<?php
        }
    }
}
?>