<?php
session_start();
include("../core/config.php");

$sql_link = connect('root', '');

if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

if (isset($_GET["search"])) {//start the search code here
    if (!empty($_GET["search"])) {
        //deal with raw input
        $targets = $_GET["search"];

        $targets = htmlspecialchars($targets);
        $targets = str_replace("\\", "", $targets);
        $targets = preg_replace('/[^0-9A-z,]/', ' ', $targets);
        $targets = preg_replace(array('/\s{2,}/', '/[\t\n]/','/\+/','/,/'), ' ', $targets);
        $targets = explode(" ", $targets);
        $_SESSION["search_input"] = $targets;

        //deal with sql query and save them to $_SESSION
        //from user
        $sql_user_a =  "SELECT * FROM user WHERE";
        foreach ($targets as $target) {
            $sql_user_a.=" (name = '$target') OR";
        }
        $sql_user_a = rtrim($sql_user_a, "OR");
        $sql_user_a .= "LIMIT 100";
        $user_a_rows = $sql_link->query($sql_user_a);
        $user_a_count = $user_a_rows->rowCount();
        $result_user_a = $user_a_rows->fetchall(PDO::FETCH_ASSOC);
        $rb = 100 - $user_a_rows->rowCount();
        $sql_user_b =  "SELECT * FROM user WHERE(";
        foreach ($targets as $target) {
            $sql_user_b.=" (name LIKE '%$target%') OR";
        }
        $sql_user_b = rtrim($sql_user_b, "OR");
        $sql_user_b .=")AND NOT(";
        foreach ($targets as $target) {
            $sql_user_b.="(name = '$target') OR";
        }
        $sql_user_b = rtrim($sql_user_b, "OR");
        $sql_user_b .=")";
        $sql_user_b .= "LIMIT $rb";
        $user_b_rows = $sql_link->query($sql_user_b);
        $user_b_count = $user_b_rows->rowCount();
        $result_user_b = $user_b_rows->fetchall(PDO::FETCH_ASSOC);
        $rc = $rb - $user_b_rows->rowCount();
        if ($rc>0) {
            $sql_user_c =  "SELECT * FROM user WHERE(";
            foreach ($targets as $target) {
                $sql_user_c.=" (name SOUNDS LIKE '$target') OR";
            }
            $sql_user_c = rtrim($sql_user_c, "OR");
            $sql_user_c .=")AND NOT(";
            foreach ($targets as $target) {
                $sql_user_c.="(name = '$target') OR";
            }
            $sql_user_c = rtrim($sql_user_c, "OR");
            $sql_user_c .=")AND NOT(";
            foreach ($targets as $target) {
                $sql_user_c.="(name LIKE '%$target%') OR";
            }
            $sql_user_c = rtrim($sql_user_c, "OR");
            $sql_user_c .=")";
            $sql_user_c .= "LIMIT $rc";
            $user_c_rows = $sql_link->query($sql_user_c);
            $user_c_count = $user_c_rows->rowCount();
            $result_user_c = $user_c_rows->fetchall(PDO::FETCH_ASSOC);
        }
        //combine the result to $_SESSION["SResult_U"],$_SESSION["SResult_U_rowcount"]
        $result_user = array_merge($result_user_a, $result_user_b);
        $result_user = array_merge($result_user, $result_user_c);
        $_SESSION["SResult_U"] = $result_user;
        $_SESSION["SResult_U_rowcount"] = $user_a_count+$user_b_count+$user_c_count;
        //from post
        $sql_post_a =  "SELECT * FROM post WHERE";
        foreach ($targets as $target) {
            $sql_post_a.=" (title = '$target') OR";
        }
        $sql_post_a = rtrim($sql_post_a, "OR");
        $sql_post_a .= "LIMIT 100";
        $post_a_rows = $sql_link->query($sql_post_a);
        $post_a_count = $post_a_rows->rowCount();
        $result_post_a = $post_a_rows->fetchall(PDO::FETCH_ASSOC);
        $rb = 100 - $post_a_rows->rowCount();

        $sql_post_b =  "SELECT * FROM post WHERE(";
        foreach ($targets as $target) {
            $sql_post_b.=" (title LIKE '%$target%') OR";
        }
        $sql_post_b = rtrim($sql_post_b, "OR");
        $sql_post_b .=")AND NOT(";
        foreach ($targets as $target) {
            $sql_post_b.="(title = '$target') OR";
        }
        $sql_post_b = rtrim($sql_post_b, "OR");
        $sql_post_b .=")";
        $sql_post_b .= "LIMIT $rb";
        $post_b_rows = $sql_link->query($sql_post_b);
        $post_b_count = $post_b_rows->rowCount();
        $result_post_b = $post_b_rows->fetchall(PDO::FETCH_ASSOC);
        $rc = $rb - $post_b_rows->rowCount();
        if ($rc>0) {
            $sql_post_c =  "SELECT * FROM post WHERE(";
            foreach ($targets as $target) {
                $sql_post_c.=" (title SOUNDS LIKE '$target') OR";
            }
            $sql_post_c = rtrim($sql_post_c, "OR");
            $sql_post_c .=")AND NOT(";
            foreach ($targets as $target) {
                $sql_post_c.="(title = '$target') OR";
            }
            $sql_post_c = rtrim($sql_post_c, "OR");
            $sql_post_c .=")AND NOT(";
            foreach ($targets as $target) {
                $sql_post_c.="(title LIKE '%$target%') OR";
            }
            $sql_post_c = rtrim($sql_post_c, "OR");
            $sql_post_c .=")";
            $sql_post_c .= "LIMIT $rc";
            $post_c_rows = $sql_link->query($sql_post_c);
            $post_c_count = $post_c_rows->rowCount();
            $result_post_c = $post_c_rows->fetchall(PDO::FETCH_ASSOC);
        }
        $result_post = array_merge($result_post_a, $result_post_b);
        $result_post = array_merge($result_post, $result_post_c);
        $_SESSION["SResult_P"] = $result_post;
        $_SESSION["SResult_P_rowcount"] = $post_a_count+$post_b_count+$post_c_count;
    } else {
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}
//
?>

<script>
window.location.href = "../search.php";
</script>

<?php exit(); ?>