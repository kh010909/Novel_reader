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
<section id="index-footer" class="border-top bg-success text-white">
    <div class="container px-5">
        <div class="row py-5 justify-content-center">
            <div class="col-lg-2 col-sm-3">
                <h5 class="fst-italic"><a href="index.php">Home</a></h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="index.php#block1" class="nav-link p-0">Newest</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="index.php#block2" class="nav-link p-0">Recommend</a>
                    </li>
                    <!-- <li class="nav-item mb-2">
                        <a href="index.php#block3" class="nav-link p-0">Finished</a>
                    </li> -->
                </ul>
            </div>

            <div class="col-lg-4 col-sm-6">
                <h5 class="fst-italic"><a href="">Genres</a></h5>
                <ul>
                    <form class="row" action="post/post_handle.php">
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <button name="id" class="nav-link p-0 border-0 bg-transparent text-start" value="action">
                                        <a>action</a>
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <button name="id" class="nav-link p-0 border-0 bg-transparent text-start" value="sci-fi">
                                        <a>sci-fi</a>
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-1">
                                    <button name="id" class="nav-link p-0 border-0 bg-transparent text-start" value="sci-fi">
                                        <a>sci-fi</a>
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </form>
                </ul>
            </div>

            <!-- <div class="col-lg-2 col-sm-3">
                <h5 class="fst-italic">Sort By</h5>
                <ul class="row">
                    <li class="col">
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="" class="nav-link p-0">newest</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="" class="nav-link p-0">Most Popular</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div> -->


            <div class="col-lg-2 offset-2 d-none d-lg-block text-center">
                <img src="../static/images/icon/tree_book.png" class="d-block w-100 img-fluid" alt="圖片無法載入">
                <a class="nav-link" href="index.php">
                    <h2>Language Forest</h2>
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-between py-4 mt-4 border-top">
            <!-- 不一定要加這幾行-->
            <!-- <p class="copy-right">&copy; 2022 Wanna Go, Inc. All rights reserved.</p>
            <a class="icon-link" href="https://github.com/whats2000/TravelBlogProject">
                <i class="bi bi-github"></i>
            </a> -->
        </div>
    </div>
</section>