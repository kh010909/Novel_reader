<?php
//Only change the name of situation for rendering block
//delete Session start

//When include, will auto connect to database, and start session.
// Connection check from https://gist.github.com/RodRitter/5390459
function connect($root, $pass)
{
    try {
        $conn = new PDO('mysql:host=localhost; dbname=novel_reader', $root, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (Exception $e) {
        print("Error connecting to database: " . $e->getMessage());
        return false;
    }
}


//connect
$sql_link = connect('root', '');
if (!$sql_link) {
    $_SESSION["show_message"] = "Error at connect to database";
    exit();
}

//the output function
//get_row($sql, &$length, $sql_link)
//$sql is your sql, $length is rowCount, $sql_link is the linkthing 
//ex: $_SESSION["abc"] =  get_row($sql,$length,$sql_link);
//save the output in $_SESSION["abc"]/*make sure your have define it before this ex. $_SESSION["abc"] = 0*/ , put the variable your want to store length at that part.
function get_row($sql, &$length, $sql_link)
{
    $temp = $sql_link->query($sql);
    $length = $temp->rowCount();
    $tempout = $temp->fetchall(PDO::FETCH_ASSOC);
    return $tempout;
}

// //get_row() 範例
// //include config.php in core file, it will start a session and connect to the database
// include('./core/config.php');
// //declare the Session first if you want to use
// $_SESSION["test"] = 0;
// //your sql
// $sql = "SELECT * FROM novel";
// //get_row($sql, &$length, $sql_link)
// //Make the variable your want to get the output by A = get_row($sql,$length,$sql_link);
// //$sql is your sql, $length is rowCount, $sql_link is the linkthing;
// $_SESSION["test"] =  get_row($sql,$length,$sql_link);

// //使用block_row範例
// //取特定值colu,m
// $name = array_column($_SESSION["test"], 'nName');
// $author = array_column($_SESSION["test"], 'author');
// $desc = array_column($_SESSION["test"], 'description');
// $nimg = array_column($_SESSION["test"], 'nImg');
?>
<!-- <div class="row justify-content-md-center d-none d-lg-block margin">
    <div class="row col-8">      -->
<?php //呼叫row (img, name ,author, desc, width, type) if type = 0(default), desc will be optionall input
// block_row($nimg,$name,$author,4);
// block_row($nimg,$name,$author,4);
?>
<!-- </div>
</div> -->


<?php
//Block functions
//單位格式
function block_unit1($nID, $image_dir = '...', $book_name = '', $author = '', $description = '')
{
?>
    <a href="./novel/novel_handle.php?nId=<?= $nID ?>" class="p-2 flex-row d-flex col-3">
        <div class=" col-6">
            <img src="<?= $image_dir ?>">
        </div>
        <div class="py-2 flex-column d-flex">
            <p class="p-1 fw-bold">
                <?= $book_name ?>
            </p>
            <p class="py-3 px-1">
                <?= $author ?>
            </p>
            <p class="p-1">
                <?= $description ?>
            </p>
        </div>
    </a>
<?php
}
//將特定coloum取出
// $first_names = array_column($records, 'first_name');
function block_unit2($nID, $image_dir = '...', $book_name = '', $author = '', $description = '')
{ //big block_unit input 個別變數
?>
    <a href="./novel/novel_handle.php?nId=<?= $nID ?>" class="p-2 flex-row d-flex col-6">
        <div class=" col-6">
            <img src="<?= $image_dir ?>">
        </div>
        <div class="py-2 flex-column d-flex">
            <p class="p-1">
                <?= $book_name ?>
            </p>
            <p class="py-3 px-1">
                <?= $author ?>
            </p>
            <p class="p-1">
                <?= $description ?>
            </p>
        </div>
    </a>
    <?php
}
//單排模式
function block_row($nID, $image_dir = '...', $book_name = '', $author = '', $description = '', $start = 0, $type = 0)
{ //input a row, and enter the width you want input 矩陣
    $width = 4;
    if ($type == 0) {
    ?>
        <div class="d-flex flex-row">
            <?php
            for ($i = $start; $i < $width + $start; $i++) {

                if (isset($book_name[$i])) {
                    $img = "../static/images/novel/";
                    $img .= $image_dir[$i];
                    block_unit1($nID[$i], $img, $book_name[$i], $author[$i], "");
                }
            }
            ?>
        </div>
    <?php
    } else {
    ?>
        <div class="d-flex flex-row">
            <?php
            for ($i = $start; $i < $width + $start; $i++) {
                if (isset($book_name[$i])) {
                    $img = "../static/images/novel/";
                    $img .= $image_dir[$i];
                    block_unit1($nID[$i], $img, $book_name[$i], $author[$i], $description[$i]);
                }
            }
            ?>
        </div>
    <?php
    }
}
// 外包<div class = "d-lg-none"> <ul class="list-group col"> 
function block_row_small($nID, $image_dir = '...', $book_name = '', $author = '', $description = '', $start = 0, $width = 4)
{ //input a row, and enter the width you want input 矩陣
    $type = 0;
    if ($type == 0) {
    ?>
        <?php
        for ($i = $start; $i < $width + $start; $i++) {

            if (isset($book_name[$i])) {
                $img = "../static/images/novel/";
                $img .= $image_dir[$i];
                if ($i % 2 == 0) {
        ?>
                    <a href="./novel/novel_handle.php?nId=<?= $nID[$i] ?>">
                        <li class="list-group-item">

                            <div class="fw-bold"><?= $book_name[$i] ?></div> 作者:
                            <?= $author[$i] ?>

                        </li>
                    </a>
                <?php
                } else {
                ?>
                    <a href="./novel/novel_handle.php?nId=<?= $nID[$i] ?>">
                        <li class="list-group-item list-group-item-success">

                            <div class="fw-bold"><?= $book_name[$i] ?></div> 作者:
                            <?= $author[$i] ?>

                        </li>
                    </a>
        <?php
                }
                //block_unit1($img, $book_name[$i], $author[$i], "");
            }
        }
        ?>
<?php
    }
}
?>