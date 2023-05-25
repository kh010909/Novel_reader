<?php
// include 'config.php';

// $sql_link = connect('root', '');

// if (!$sql_link) {
//     $_SESSION["show_message"] = "Error at connect to database";
//     exit();
// }

// $sql = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 6";

// $result = $sql_link->query($sql);

// $i = 0;
// $post_list = array();

// while ($row = $result->fetch()) {
//     $post_list[$i] = [
//         "id" => $row["id"],
//         "title" => $row["title"]
//     ];

//     $i++;
// }
?>
<section id="index-footer" class="border-top text-white main-color"><!--bg-success -->
    <div class="container px-5">
        <div class="row py-5 justify-content-center">
            <div class="col-lg-2 col-sm-3">
                <h5 class="text-black-50 fw-bold border-bottom border-secondary"><a href="index.php">主頁</a></h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="index.php#block1" class="nav-link p-0">最新</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="index.php#block2" class="nav-link p-0">推薦</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="index.php#block3" class="nav-link p-0">完結</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-sm-6">
                <h5 class="text-black-50 fw-bold border-bottom border-secondary"><a>種類</a></h5>
                <ul>
                    <form class="row" action="post/post_handle.php">
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=言情" class="nav-link p-0 border-0 bg-transparent text-start" value="言情">
                                        言情
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=玄幻" class="nav-link p-0 border-0 bg-transparent text-start" value="玄幻">
                                        玄幻
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=軍事" class="nav-link p-0 border-0 bg-transparent text-start" value="軍事">
                                        軍事
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=短篇" class="nav-link p-0 border-0 bg-transparent text-start" value="短篇">
                                        短篇
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=靈異" class="nav-link p-0 border-0 bg-transparent text-start" value="靈異">
                                        靈異
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=遊戲" class="nav-link p-0 border-0 bg-transparent text-start" value="遊戲">
                                        遊戲
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=女性向" class="nav-link p-0 border-0 bg-transparent text-start" value="女性向">
                                        女性向
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=都市" class="nav-link p-0 border-0 bg-transparent text-start" value="都市">
                                        都市
                                    </a>
                                </li>

                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=科幻" class="nav-link p-0 border-0 bg-transparent text-start" value="科幻">
                                        科幻
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=歷史" class="nav-link p-0 border-0 bg-transparent text-start" value="歷史">
                                        歷史
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=同人" class="nav-link p-0 border-0 bg-transparent text-start" value="歷史">
                                        同人
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=懸疑" class="nav-link p-0 border-0 bg-transparent text-start" value="懸疑">
                                        懸疑
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=體育" class="nav-link p-0 border-0 bg-transparent text-start" value="體育">
                                        體育
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=男性向" class="nav-link p-0 border-0 bg-transparent text-start" value="男性向">
                                        男性向
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=仙俠" class="nav-link p-0 border-0 bg-transparent text-start" value="仙俠">
                                        仙俠
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=武俠" class="nav-link p-0 border-0 bg-transparent text-start" value="武俠">
                                        武俠
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=勵志" class="nav-link p-0 border-0 bg-transparent text-start" value="勵志">
                                        勵志
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=經典文學" class="nav-link p-0 border-0 bg-transparent text-start" value="歷史">
                                        經典文學
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=冒險" class="nav-link p-0 border-0 bg-transparent text-start" value="冒險">
                                        冒險
                                    </a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a name="id" href="./novel_list.php?list_type=TAG&list_q=熱血" class="nav-link p-0 border-0 bg-transparent text-start" value="熱血">
                                        熱血
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </form>
                </ul>
            </div>



            <div class="col-lg-2 offset-2 d-none d-lg-block text-center">
                <img src="../static/images/icon/tree_book.png" class="d-block w-100 img-fluid" alt="圖片無法載入">
                <a class="nav-link text-black fw-bold" href="index.php">
                    <h2>Language Forest</h2>
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-between py-4 mt-4 border-top border-secondary">
            <!-- 不一定要加這幾行-->
            <!-- <p class="copy-right">&copy; 2022 Wanna Go, Inc. All rights reserved.</p>
            <a class="icon-link" href="https://github.com/whats2000/TravelBlogProject">
                <i class="bi bi-github"></i>
            </a> -->
        </div>
    </div>
</section>