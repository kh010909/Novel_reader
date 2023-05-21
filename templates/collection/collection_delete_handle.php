<?php
include('../core/config.php');
session_start();
if (isset($_POST['collectId'])) {
    if (isset($_SESSION["user"])) {
        $collect_id = $_POST['collectId'];
        $user_id = $_SESSION["user"]['uId'];
        $sql = "DELETE FROM `collection` WHERE collectId = $collect_id";
        $temp = $sql_link->query($sql);
    }
?>
    <script>
        window.location.href = '../collection.php';
    </script>

<?php } else { ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php } ?>