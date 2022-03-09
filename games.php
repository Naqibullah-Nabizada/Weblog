<?php
require_once("db.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="font/css/font-awesome.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">


            <nav class="navbar navbar-dark bg-dark nav-pills nav-tabs navbar-expand-sm w-100" dir="rtl">

                <button class="navbar-toggler" data-toggle="collapse" data-target="#myToggleNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="myToggleNav">

                    <div id="navbar" class="col-10 navbar-nav text-center">
                        <a href="index.php" class="nav-link nav-item text-white">سیاسی</a>
                        <a href="ecanomic.php" class="nav-link nav-item text-white">اقتصادی</a>
                        <a href="social.php" class="nav-link nav-item text-white">اجتماعی</a>
                        <a href="cultural.php" class="nav-link nav-item text-white">فرهنگی</a>
                        <a href="sports.php" class="nav-link nav-item text-white">ورزشی</a>
                        <a href="games.php" class="nav-link nav-ite1 active text-white">تفریحی</a>
                        <a href="technalogy.php" class="nav-link nav-item text-white">تکنالوجی</a>
                    </div>

                </div>

                <div class="nav col-2 d-none d-md-flex">
                    <img src="img/News/logo-af.jpg" alt="TOLO NEWS" id="headerLogo" class="img-fluid m-auto w-25" title="طلوع نیوز" style="cursor: pointer;">
                </div>
            </nav>


            <div id="hobybg" dir="rtl">
                <h2 class="text-white font-weight-bold text-center" style="margin-top: 10vh;">طلوع نیوز پایگاه خبر افغانستان</h2>
                <h5 class="text-white font-weight-bold text-center mt-5">برای آکاهی از تازه ترین رویداد های داخلی و خارجی ما را دنبال کنید.</h5>

                <div class="d-flex" style="margin-top: 10vh;">
                    <img src="img/News/logo-af.jpg" alt="TOLO NEWS" class="img-fluid m-auto" title="طلوع نیوز" style="cursor: pointer;">
                </div>
                <div id="social-media" style="margin-top: 8vh;">
                    <a href="#" title="Facebook" class="fa fa-facebook-square text-white"></a>
                    <a href="#" title="Instagram" class="fa fa-instagram text-white"></a>
                    <a href="#" title="Twitter" class="fa fa-twitter text-white"></a>
                    <a href="#" title="Telegram" class="fa fa-telegram text-white"></a>
                </div>
            </div>


            <!--========================================== main ====================================-->


            <main class="col-xl-8 offset-xl-0 col-lg-6 col-md-7 offset-md-0 col-sm-8 col-10 mt-3" dir="rtl">

                <div class="d-xl-flex flex-xl-wrap">

                    <div class="card col-12 mt-3">
                        <marquee class="card-header h3 text-right text-white bg-danger">تازه ترین رویداد های افغانستان منطقه و جهان</marquee>
                    </div>

                    <?php

                    $sql = "SELECT post_id, `image`, content, `date` FROM post WHERE `type`='تفریحی'";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>

                            <div class="col-xl-6 col-lg-12 mt-3" dir="rtl">
                                <div class="card">
                                    <div class="card-body d-flex flex-wrap">
                                        <a href="single.php?postId=<?php echo $res->post_id ?>"> <img src="img/News/<?php echo $res->image ?>" class="img-thumbnail w-100" style="height: 250px"></a>
                                        <p class="card-text text-right mt-3" style="text-align: justify !important;"> <?php echo substr(htmlentities($res->content), 0, 420) . "..." ?> <a href="single.php?postId=<?php echo $res->post_id ?>">بیشتر</a> </p>
                                        <div class="border p-3 rounded d-flex col-12 justify-content-around" dir="ltr">
                                            <div class="d-flex">
                                                <li class="list-unstyled fa fa-television mt-1" style="cursor: pointer;"></li>

                                                <?php

                                                $view = "SELECT COUNT(post_id) AS allView FROM view WHERE post_id=?";
                                                $view = $conn->prepare($view);
                                                $view->bindValue(1, $res->post_id);
                                                $view->execute();
                                                $results = $view->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) { ?>
                                                    <span id="view" class="ml-2"> <?php echo $result->allView ?> </span>
                                                <?php
                                                }

                                                ?>

                                            </div>

                                            <div id="comment">
                                                <span class="fa fa-comment mt-1"> </span>

                                                <?php
                                                $sql = "SELECT COUNT(*) AS allComments FROM comment INNER JOIN post ON comment.post_id = post.post_id WHERE post.post_id=?";
                                                $query = $conn->prepare($sql);
                                                $query->bindValue(1, $res->post_id);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($results as $result) { ?>
                                                    <span><?php echo $result['allComments'] ?></span>
                                                <?php
                                                }
                                                ?>

                                            </div>

                                            <div id="date">
                                                <span><?php echo date('Y/m/d') ?></span>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>

                </div>

            </main>



            <!-------------------------- aside --------------------------->


            <?php
            require_once("aside.php");
            ?>
            <!-----------------------------------------------footer --------------------------------------->



            <footer class="col-12 p-0 m-0" dir="rtl">
                <div id="footer" class="mt-4">
                    <div id="icons" class="text-center">
                        <a href="" class="fa fa-facebook-square text-white" title="Facebook"></a>
                        <a href="" class="fa fa-instagram text-white" title="Instagram"></a>
                        <a href="" class="fa fa-twitter-square text-white" title="Twitter"></a>
                        <a href="" class="fa fa-telegram text-white" title="Telegram"></a>

                        <h6 class="text-white mt-3">ما را در صفحات مجازی دنبال کنید.</h6>
                        <p class="fa fa-copyright text-white mt-2"> تمام حقوق این سایت متعلق به طلوع نیوز میباشد.</p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>

<script src="js/jquery-3.5.1.min.js "></script>
<script src="js/bootstrap.min.js "></script>
<script src="js/Custom.js"></script>

</html>