<?php
//session_start();
//$_SESSION['last_url'] = "{$_SERVER['PHP_SELF']}";
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>LanguageForest &raquo; Profile</title>


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
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Custom script -->
    <!-- <script src="../scripts/index_nav.html.js"></script> -->
    <script src="../scripts/password_validation.js"></script>
    <script src="../scripts/croppie.js"></script>
    <script src="../scripts/index_post_ajax.js"></script>
    <link href="../static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
        <?php include('./core/navbar.php');
        ?>
    </header>

    <main>
        <div class="container-fluid col-8 margin">

            <div class="d-flex flex-row border-bottom ">
                <img src="./Testing.png" width="10%" class="py-3">
                <h1 class="align-self-end py-3 px-5">Welcom Back! _Username_</h1>
            </div>

            <div class="py-5 d-flex flex-row">
                <div class="col-5 flex-row d-flex">
                    <p class="px-3">
                        Email : abcdefghijlkm@gmail.com
                    </p>
                    <a><i class="bi bi-pencil mx-2 p-1 rounded border-dark border"></i></a>
                </div>
                <div class="col-3">
                </div class="col-4">
                <p>
                    Your Role is : normal member /if other/ Normal member
                </p>
            </div>

            <!--Blocks-->
            <div class="py-5">
                <!--My collection-->
                <div class="py-5">
                    <!-- 塊狀1 全小方格-->
                    <div class="justify-content-md-center container-fluid d-none d-lg-block">
                        <div class="row">
                            <div class="border-bottom">
                                <h1>My Collection</h1>
                            </div>
                            <!-- 單排格式 -->
                            <div class="d-flex flex-row">
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class=" col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- 單排格式 -->
                            <div class="d-flex flex-row   ">
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex  ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- small screen-->
                    <div class="container-fluid d-lg-none">
                        <div class="row">
                            <ul class="list-group col">
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
                                <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
                                <li class="list-group-item list-group-item-success">This is a success list group item</li>
                            </ul>
                            <ul class="list-group col">
                                <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
                                <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
                                <li class="list-group-item list-group-item-info">This is a info list group item</li>
                                <li class="list-group-item list-group-item-light">This is a light list group item</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Books I like-->
                <div>
                    <!-- 塊狀1 全小方格-->
                    <div class="justify-content-md-center container-fluid d-none d-lg-block">
                        <div class="row">
                            <div class="border-bottom">
                                <h1>Books I like</h1>
                            </div>
                            <!-- 單排格式 -->
                            <div class="d-flex flex-row">
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class=" col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- 單排格式 -->
                            <div class="d-flex flex-row   ">
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex  ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                                <!-- 單位格式 -->
                                <div class="p-2 flex-row d-flex col-3">
                                    <div class="  col-6">
                                        <img src="./Testing.png">
                                    </div>
                                    <div class="py-2 flex-column d-flex ">
                                        <p class="p-1">作品的名稱...</p>
                                        <p class="py-3 px-1">作者的名稱...</p>
                                        <p class="p-1">這理是介紹這理是介紹這理是介紹這理是介紹限二十五字...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- small screen-->
                    <div class="container-fluid d-lg-none">
                        <div class="row">
                            <ul class="list-group col">
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
                                <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
                                <li class="list-group-item list-group-item-success">This is a success list group item</li>
                            </ul>
                            <ul class="list-group col">
                                <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
                                <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
                                <li class="list-group-item list-group-item-info">This is a info list group item</li>
                                <li class="list-group-item list-group-item-light">This is a light list group item</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include('./core/footer.php') ?>
    </footer>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#modal-show-message').modal('show');
    });
</script>