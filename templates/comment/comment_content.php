<?php
if (!isset($_SESSION["post"]["id"])) { //know to post id
    //form for add
    if (isset($_SESSION['user'])) { //login stat
        //$email = $_SESSION['user']['email'];
?>
        <div class="row">
            <form id="Comments" class="my-2" action="./comment/comment_add.php" method="post">
                <input type="hidden" name="nId" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="comment-email" class="form-label">
                        使用者名稱
                    </label>
                    <p><b><?= $_SESSION['user']['name'] ?></b></p>
                </div>
                <div class="mb-3">
                    <label for="comment-article" class="form-label">
                        請將您的留言留於此處
                    </label>
                    <textarea class="form-control" id="comment-article" rows="3" placeholder="分享您的想法..." name="comment_content" maxlength="1500"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary d-flex float-end">
                    留言
                </button>
            </form>
            <br>
        </div>
    <?php
    } else {
    ?>
        <div class="row mb-3">
            <div id="Comments" class="mb-3">
                <h3>請登錄以留言</h3>
            </div>
            <br>
            <hr>
        </div>
    <?php
    }

    if ($commentcount == 0) {
    ?>
        <div class="row mb-3">
            <div id="Comments" class="mb-3">
                <h3>目前沒有留言...</h3>
            </div>
            <br>
        </div>
        <?php
    } else if ($commentcount > 3) {
        for ($i = 0; $i < 3; $i++) {
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['name'] != $comment_rows[$i]['name']) {
        ?>
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
                <?php
                } else { //those comment they can edit
                ?>
                    <div class="card my-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center card-title">
                                    <img src="../static/images/icon/person-circle-dark.svg" alt="avatar" width="25" height="25" />
                                    <p class=" px-3 mt-2" id=<?php //$content_tag_id 
                                                                ?>><b><?= $comment_rows[$i]["name"] ?></b></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between card-text">
                                <p class="col-12 lh-base"><?= $comment_rows[$i]["cContent"] ?></p>
                            </div>
                            <form>
                                <div class="d-flex justify-content-between card-text">
                                    <textarea class="col-12 lh-base border-0"><?= $comment_rows[$i]["cContent"] ?></textarea>
                                </div>
                                <button type="button" class="btn btn-light btn-sm float-end" title="確認更改">
                                    <i class="bi bi-check"></i>
                                </button>
                            </form>


                            <form class="float-end" action="./comment/comment_delete.php" method="post">
                                <input type="hidden" name="comment_id" value="<?= $comment_rows[$i]["cNumber"] ?>">
                                <input type="hidden" name="comment_name" value="<?= $comment_rows[$i]["name"] ?>">
                                <input type="hidden" name="nId" value="<?= $id ?>">
                                <button type="submit" class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
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
        }
        ?>
        <button class="btn btn-secondary col-12 mt-5 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetarget" aria-expanded="false" aria-controls="collapsetarget">
            觀看更多留言
        </button>
        <?php for ($i = 3; $i < $commentcount; $i++) { ?>

            <br>
            <div class="collapse" id="collapsetarget">
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['name'] != $comment_rows[$i]['name']) {
                ?>
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
                    <?php
                    } else { //those comment they can edit
                    ?>
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center card-title">
                                        <img src="../static/images/icon/person-circle-dark.svg" alt="avatar" width="25" height="25" />
                                        <p class=" px-3 mt-2" id=<?php //$content_tag_id 
                                                                    ?>><b><?= $comment_rows[$i]["name"] ?></b></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between card-text">
                                    <p class="col-12 lh-base"><?= $comment_rows[$i]["cContent"] ?></p>
                                </div>
                                <form action="./comment/comment_delete.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment_rows[$i]["cNumber"] ?>">
                                    <input type="hidden" name="comment_name" value="<?= $comment_rows[$i]["name"] ?>">
                                    <input type="hidden" name="nId" value="<?= $id ?>">
                                    <!-- <div class="d-flex justify-content-between card-text"> -->
                                    <textarea class="col-12 lh-base border-0"><?= $comment_rows[$i]["cContent"] ?></textarea>
                                    <!-- </div> -->
                                    <button type="button" class="btn btn-light btn-sm float-end" title="確認更改">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>

                                <form class="float-end" action="./comment/comment_delete.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment_rows[$i]["cNumber"] ?>">
                                    <input type="hidden" name="comment_name" value="<?= $comment_rows[$i]["name"] ?>">
                                    <input type="hidden" name="nId" value="<?= $id ?>">
                                    <button type="submit" class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php   }
                } else { ?>
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
                    <?php
                }
            }
        } else {
            for ($i = 0; $i < $commentcount; $i++) {
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['name'] != $comment_rows[$i]['name']) {
                    ?>
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
                    <?php
                    } else { //those comment they can edit
                    ?>
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center card-title">
                                        <img src="../static/images/icon/person-circle-dark.svg" alt="avatar" width="25" height="25" />
                                        <p class=" px-3 mt-2" id=<?php //$content_tag_id 
                                                                    ?>><b><?= $comment_rows[$i]["name"] ?></b></p>
                                    </div>
                                </div>
                                <form action="./comment/comment_edit.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment_rows[$i]["cNumber"] ?>">
                                    <input type="hidden" name="comment_name" value="<?= $comment_rows[$i]["name"] ?>">
                                    <input type="hidden" name="nId" value="<?= $id ?>">
                                    <!-- <div class="d-flex justify-content-between card-text"> -->
                                    <textarea class="col-12 lh-base border-0" rows="2" name="cContent"><?= $comment_rows[$i]["cContent"] ?></textarea>
                                    <!-- </div> -->
                                    <button type="submit" class="btn btn-light btn-sm float-end" title="確認更改">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>


                                <form class="float-end" action="./comment/comment_delete.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment_rows[$i]["cNumber"] ?>">
                                    <input type="hidden" name="comment_name" value="<?= $comment_rows[$i]["name"] ?>">
                                    <input type="hidden" name="nId" value="<?= $id ?>">
                                    <button type="submit" class="btn btn-light btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                } else { ?>
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
    <?php
                }
            }
        }
        // if ($comment["icon"] == "") {
        //     $icon = "../static/images/icon/person-circle-dark.svg";
        // } else {
        //     $icon = "../static/images/user/icon/" . $comment["icon"];
        // }
        // $content_tag_id = "tag_id_" . $comment["id"];
        // $edit_button_id = "edit_id_" . $comment["id"]

    }
    ?>