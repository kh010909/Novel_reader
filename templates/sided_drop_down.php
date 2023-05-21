<?php
$id = $_SESSION['id'];
$sql = "SELECT c.*,u.name FROM `comment` AS c NATURAL JOIN `user` AS u WHERE `nId` = $id ORDER BY c.cNumber ";
$comment_rows = get_row($sql, $commentcount, $sql_link);
?>
<div class="side_bar container d-flex flex-column align-items-center justify-content-center">
    <!--button One-->
    <div class="side_bar_button py-3">
        <div class="btn-group dropstart">
            <button type="button " class="btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
                <!--icon for this button-->
                <i class="bi bi-chat-square-text" alt="comment"></i>
            </button>
            <ul class="dropdown-menu side_bar_comment height overflow-auto">
                <!-- Dropdown menu links -->
                <!-- 單位格式 -->
                <?php if ($commentcount == 0) { ?>
                    <p class="h5 p-1">尚未有留言</p>
                    <?php } else {
                    for ($i = 0; $i < $commentcount; $i++) { ?>
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="../static/images/icon/person-circle-dark.svg" alt="avatar" width="25" height="25" />
                                        <p class="card-title px-3 mt-2"><b><?= $comment_rows[$i]["name"] ?></b></p>
                                    </div>
                                </div>
                                <p class="col-12 lh-base"><?= $comment_rows[$i]["cContent"] ?></p>
                            </div>
                        </div>
                <?php }
                } ?>
                <!-- 單位格式 -->
                <!-- <div class="p-2 flex-row d-flex col">
                    <div class=" col-6">
                        <img src="./Testing.png">
                    </div>
                    <div class="py-2 flex-column d-flex">
                        <p class="p-1">作品的名稱...</p>
                        <p class="py-3 px-1">作者的名稱...</p>
                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                        </p>
                    </div>
                </div> -->
            </ul>
        </div>
    </div>
    <!--button Two-->
    <div class="side_bar_button py-3 dropstart">
        <button type="button " class="btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
            <!--icon for this button-->
            <i class="bi bi-palette" alt="background color"></i>
        </button>
        <ul class="dropdown-menu side_bar_comment overflow-auto">
            <!-- Dropdown menu links -->
            <!-- 單位格式 -->
            <p class="h2 p-3">背景顏色</p>
            <button class="bg-light dropdown-item text-black p-3" id="bg-button-light">white</button>
            <button class="bg-secondary dropdown-item text-white p-3" id="bg-button-secondary">gray</button>
            <button class="bg-dark dropdown-item text-white p-3" id="bg-button-dark">black</button>
            <!-- href method, save it for further use. -->
            <!-- <button class="bg-secondary dropdown-item text-white p-3" id="bg-button-secondary">gray</button> -->
        </ul>
    </div>
    <!--button Three-->
    <div class="side_bar_button py-3 dropstart">
        <button type="button " class="btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-fonts" alt="Fonts"></i>
        </button>
        <ul class="dropdown-menu side_bar_comment overflow-auto">
            <p class="h2 p-3">字體</p>
            <button class="bg-light dropdown-item text-black p-1 h5 cwTeXKai" id="font-button-cwTeXKai">楷體</button>
            <button class="bg-light dropdown-item text-black p-1 h5 cwTeXYen" id="font-button-cwTeXYen">圓體</button>
            <button class="bg-light dropdown-item text-black p-1 h5 Noto-Sans-TC" id="font-button-Noto-Sans-TC">思源黑體</button>
        </ul>

    </div>
    <!--button Four-->
    <div class="side_bar_button py-3 dropstart">
        <button type="button " class="btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-type-h3" alt="text size"></i>
        </button>
        <ul class="dropdown-menu side_bar_comment overflow-auto">
            <p class="h2 p-3">文字大小</p>
            <button class="bg-light dropdown-item text-black p-1 h3" id="size-button-h3">大</button>
            <button class="bg-light dropdown-item text-black p-1 h4" id="size-button-h4">中</button>
            <button class="bg-light dropdown-item text-black p-1 h5" id="size-button-h5">小</button>
        </ul>
    </div>
    <div class="side_bar_button py-3 dropstart">
        <button type="button " class="btn rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-music-note-beamed" alt="BGMS"></i>
        </button>
        <ul class="dropdown-menu side_bar_comment overflow-auto">
            <!-- for audio -->
            <div class="container d-flex flex-row">
                <div id="player" class="h2 "><i class="bi bi-play" id="play_icon"></i></div>
                <div class="d-flex flex-column px-3">
                    <label for="volume-slider" class="form-label">Volume</label>
                    <input type="range" id="volume-slider" value='50'>
                </div>
            </div>
        </ul>

    </div>
</div>

<style>
    .side_bar {
        position: fixed;
        top: 74px;
        right: 0;
        height: 100%;
        width: 3.5%;
        background-color: gray;
        opacity: 80%;
    }

    .side_bar:hover {
        opacity: 100%;
    }

    .side_bar_comment {
        position: relative;
        top: 10px;
        width: 800%;
        max-height: 600%;
    }

    #index-footer {
        display: none;
    }
</style>