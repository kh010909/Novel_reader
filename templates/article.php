<?php
include("./core/config.php");
session_start();
if (!isset($_SESSION['article_content'])) {
    $chapter = $_SESSION['chapter'];
    $id = $_SESSION['id']; ?>
    <script>
        window.location.href = "./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $chapter ?>";
    </script>
<?php }
$article_row = $_SESSION['article_content'];
$totalarticlecount = $_SESSION['totalarticlecount'];
$chapter = $_SESSION['chapter'];
$id = $_SESSION['id'];
//bg
if (!isset($_COOKIE['background'])) {
    $background = "bg-light";
} else {
    $background = $_COOKIE['background'];
}
//text color
if ($background == "bg-light") {
    $text = "text-black";
} else {
    $text = "text-white";
}
//font
if (!isset($_COOKIE['font'])) {
    $font = "Noto-Sans-TC";
} else {
    $font = $_COOKIE['font'];
}
//size
if (!isset($_COOKIE['size'])) {
    $size_big = "h3";
    $size_small = "h5";
} else {
    $size_big = "h" . ($_COOKIE['size'] - 2);
    $size_small = "h" . $_COOKIE['size'];
}
//$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
//different fonts:cwTeXKai,cwTeXYen,Noto-Sans-TC
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo;<?= $article_row[0]['aName'] ?></title>


    <link href="../static/images/icon/tree_book.png" rel="icon" />
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap" rel="stylesheet">
    <!-- Vue -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

    <!-- Custom script -->
    <!-- <script src="../scripts/index_nav.html.js"></script> -->
    <script src="../scripts/password_validation.js"></script>
    <script src="../scripts/croppie.js"></script>
    <script src="../scripts/index_post_ajax.js"></script>
    <script src="../scripts/sided/sided.js"></script>
    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <header>
        <?php include('./core/navbar.php'); ?>
    </header>
    <div class="<?= $background ?> <?= $text ?> " id="articlemain">
        <main id="fonttarget" class="container margin">
            <p id="big" class="<?= $size_big ?> py-4 <?= $font ?>"><?= $article_row[0]['aName'] ?></p>
            <div id="small" class="<?= $size_small ?> <?= $font ?>"><?= $article_row[0]['aContent'] ?></div>
            <div class="btn-group container">
                <div class="container-fluid col-8 py-3 justify-content-center d-flex">
                    <?php
                    $prevchapter = $chapter - 1;
                    $nextchapter = $chapter + 1;
                    if ($chapter != 1) { ?>
                        <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $prevchapter  ?>" class="btn btn-secondary m-1 rounded-pill">
                            <?php $chapter ?>
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    <?php }
                    if ($chapter != $totalarticlecount - 1) { ?>
                        <a href="./article/article_handle.php?nId=<?= $id ?>&chapter=<?= $nextchapter ?>" class="btn btn-primary m-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <?php include("./sided_drop_down.php"); ?>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>
<script>
    //for audio
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function getListings(url, callback) {
        //console.log("first", url);
        $.get(url, (data) => {
            //console.log(data);
            listing = parseDirectoryListing(data);
            callback(listing);
        });
    }

    function parseDirectoryListing(text) {
        let docs = text.match(/href="([\w-]+\.mp3)/g); // pull out the hrefs
        if (docs != null) {
            result = docs.map((x) => x.replace('href="', '')); // clean up
            return result;
        }
        //console.log(docs);

    }


    //決定歌曲在哪個資料夾
    var whole = document.getElementById("music-whole");
    var music_to_play;
    var type_list = ['mtype-1', 'mtype-2', 'mtype-3', 'mtype-4', 'mtype-5'];
    var type_list_semantic = ["Science_Novel", "Romantic_Novel", "Magic_Novel", "Detective_Novel", "default"];
    var emotion_list = ['memo-1', 'memo-2', 'memo-3', 'memo-4', 'memo-5'];
    var emotion_list_semantic = ["joy", "love", "sadness", "fear", "anger"]
    var type;
    var emotion;
    var url = ""; //../static/music/default/
    var audio = new Audio();

    //see whether have music tag 
    if (whole == null) {
        type = "default/";
        emotion = "";

    } else { //get the type and emotion on the tag (for the whole page(no changing music)) 每一小段的先不用code
        type_list.forEach(function(value, index) {
            if (whole.classList.contains(value)) {
                type = type_list_semantic[index];
            }
        });
        if (type == null) {
            type = "default/";
        } else {
            type = type + "/";
        }
        emotion_list.forEach(function(value, index) {
            if (whole.classList.contains(value)) {
                emotion = emotion_list_semantic[index];
            }
        });
        if (emotion == null) {
            emotion = "";
        } else {
            emotion = emotion + "/";
        }
        //get the music to play 
    }
    url = "../static/music/" + type + emotion;

    decide_song(url);
    play_the_music();

    //執行歌曲
    function decide_song(url) {
        getListings(url, (listing) => {
            //隨機選一首在資料夾的歌
            //如果沒有?-> 在default 選情緒相同的
            //play the music (condition?)
            //choose the music to play
            if (listing) {
                var randomIndex = Math.floor(Math.random() * listing.length);
                var randomMusic = listing[randomIndex];
            } else {

                randomMusic = null;
            }

            if (randomMusic) {
                music_to_play = url + randomMusic; // 保存当前的音乐 URL
                audio.src = music_to_play;
            } else {

                let new_url = "../static/music/default/" + emotion + "/";
                getListings(new_url, (listing2) => {

                    if (listing2) {
                        var randomIndex = Math.floor(Math.random() * listing2.length);
                        var randomMusic = listing2[randomIndex];
                    } else {

                        randomMusic = null;
                    }
                    if (randomMusic) {
                        music_to_play = new_url + randomMusic; // 保存当前的音乐 URL
                    } else {
                        music_to_play = "../static/music/default/fsm-team-escp-dewdrops.mp3";
                    }
                    audio.src = music_to_play;
                });

            }
            //console.log(listing.length);
        });
    }

    function play_the_music() {
        //撥放音樂
        //decide play or not when enter the page
        const stat = getCookie("play_stat");
        if (stat == "true" || stat == "") {
            playing = true;
        } else {
            playing = false;
        }

        //play or not when enter the page
        if (playing) {
            audio.play();
            audio.loop = true;
            document.getElementById("play_icon").className = "bi bi-stop-circle-fill ";
            document.cookie = 'play_stat=true';
        } else {
            audio.pause();
            document.getElementById("play_icon").className = "bi bi-play-fill";
            document.cookie = 'play_stat=false';
        }

        //撥放音樂+控制音樂
        document.getElementById("player").onclick = function() {
            play()
        };

        function play() {
            playing = !playing;
            if (playing) {
                audio.play();
                audio.loop = true
                document.getElementById("play_icon").className = "bi bi-stop-circle-fill";
                document.cookie = 'play_stat=true';
            } else {
                audio.pause();
                document.getElementById("play_icon").className = "bi bi-play-fill";
                document.cookie = 'play_stat=false';
            }
        }
        //decide volume
        audio.volume = 0.5;
        let volume = document.getElementById('volume-slider');
        volume.addEventListener("change", function(e) {
            audio.volume = e.currentTarget.value / 100;
            var volume_set = e.currentTarget.value / 100;
        })
    }
</script>
<?php
unset($_SESSION['article_content']);
unset($_SESSION['totalarticlecount']); ?>
<style>
    .margin {
        margin-top: 74px;
    }
</style>