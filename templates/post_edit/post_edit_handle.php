<?php
include("../core/config.php");

session_start();

unset($_SESSION["article"]);

if (!isset($_SESSION["post"]["id"])) {
    $_SESSION["show_message"] = "Undefine post id"; ?>
<script>
window.location.href = '../index.php';
</script>
<?php

exit();
}

$return_msg = "";
$url = "../index.php";

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

$return_msg = "";

if (isset($_SESSION["user"])) {
    $post_id = $_SESSION["post"]["id"];
    $sql = "SELECT * FROM `post` WHERE `id` = '$post_id'";

    $post_result = $sql_link->query($sql);

    if ($post_result) {
        $row = $post_result->fetch();

        if ($row["email"] == $_SESSION["user"]["email"]) {
            $_SESSION["post"] = [
                "id" => $row["id"],
                "post_email" => $row['email'],
                "title" => $row["title"],
                "description" => $row["description"],
                "picture" => $row["picture"],
                "create_at" => $row["create_at"],
                "edit" => true
            ];

            $sql = "SELECT * FROM `article` WHERE `for_post` = '$post_id' ORDER BY `position`";

            $article_result = $sql_link->query($sql);

            if ($article_result) {
                if ($article_result->rowCount() > 0) {
                    $article_rows = [];

                    while ($row = $article_result->fetch()) {
                        $_SESSION["article"][$row["id"]] = [
                            "id" => $row["id"],
                            "title" => $row["title"],
                            "description" => $row["description"],
                            "picture" => $row["picture"],
                            "display" => $row["display"],
                            "edit_time" => $row["edit_time"],
                            "for_post" => $row["for_post"],
                            "position" => $row["position"]
                        ];
                    }
                } else {
                    unset($_SESSION["article"]);
                }

                $url = "../post_edit.php";
            } else {
                $return_msg = "Fail to fetch article data from database";
            }
        } else {
            $return_msg = "You don't have permission to edit this post.";
        }
    } else {
        $return_msg = "Fail to fetch post data from database";
    }
} else {
    $return_msg = "Please login first";
}


if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}
?>
<script>
window.location.href = '<?= $url ?>';
</script>
<?php exit() ?>