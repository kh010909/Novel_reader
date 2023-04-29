<?php
include("../core/config.php");

session_start();

unset($_SESSION["article"]);

if (@$_GET["id"]) {
    $_SESSION["post"]["id"] = $_GET["id"];
}

if (!isset($_SESSION["post"]["id"])) {
    $_SESSION["show_message"] = "Undefine post id"; ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php exit();
}

$return_msg = "";
$url = "../post.php";

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

//fetch post data
$post_id = $_SESSION["post"]["id"];
$sql = "SELECT * FROM `post` WHERE `id` = '$post_id'";

$post_result = $sql_link->query($sql);

if ($post_result) {
    $row = $post_result->fetch();

    $_SESSION["post"] = [
        "id" => $row["id"],
        "post_email" => $row['email'],
        "title" => $row["title"],
        "description" => $row["description"],
        "picture" => $row["picture"],
        "create_at" => $row["create_at"],
        "edit" => false
    ];

    //fetch article data
    $sql = "SELECT * FROM `article` WHERE `for_post` = '$post_id' ORDER BY `position`";

    $article_result = $sql_link->query($sql);

    if ($article_result) {
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
        $url = "../index.php";
        $return_msg = "Fail to fetch article data from database";
    }

    //fetch author data
    $post_email = $_SESSION["post"]["post_email"];
    $sql = "SELECT * FROM `user` WHERE `email` = '$post_email'";
    $author_result = $sql_link->query($sql);
    if ($author_result) {
        $row = $author_result->fetch();
        $_SESSION["author"] = [
            "name" => $row["name"],
            "icon" => $row['icon'],
            "about" => $row["about"],
        ];
    } else {
        $url = "../index.php";
        $return_msg = "Fail to fetch author data from database";
    }
} else {
    $url = "../index.php";
    $return_msg = "Fail to fetch post data from database";
}

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}
?>
<script>
    window.location.href = '<?= $url ?>';
</script>
<?php exit() ?>