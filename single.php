<?php
require_once("db.php");

$postId = $_GET['postId'];

$sql = "SELECT * FROM post WHERE post_id=?";
$query = $conn->prepare($sql);
$query->bindValue(1, $postId);
$query->execute();
$result = $query->fetch();


$view = "INSERT INTO view SET post_id=?";
$view = $conn->prepare($view);
$view->bindValue(1, $postId);
$view->execute();


if (isset($_POST['sub'])) {

    $detail = $_POST['comment'];

    if ($detail !== "") {
        $comment = "INSERT INTO comment SET post_id=?, comment=?";
        $comment = $conn->prepare($comment);
        $comment->bindValue(1, $postId);
        $comment->bindValue(2, $detail);
        $comment->execute();
    } else {
        echo "<script> alert('نظر خود را بنویسید') </script>";
    }
}

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
                        <a href="games.php" class="nav-link nav-ite1 text-white">تفریحی</a>
                        <a href="technalogy.php" class="nav-link nav-item text-white">تکنالوجی</a>
                    </div>

                </div>

                <div class="nav col-2 d-none d-md-flex">
                    <img src="img/News/logo-af.jpg" alt="TOLO NEWS" class="img-fluid m-auto w-25" title="طلوع نیوز" style="cursor: pointer;">
                </div>
            </nav>



            <!--========================================== main ====================================-->



            <main class="col-xl-8 offset-xl-0 col-lg-6 offset-lg-1 col-md-7 offset-md-0 col-sm-8 offset-sm-2 col-10 offset-1 mt-3">

                <div class="d-xl-flex flex-xl-wrap">

                    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">
                        <h6 class="card-header text-right text-white bg-danger">تازه ترین رویداد های افغانستان منطقه و جهان</h6>
                    </div>

                    <div class="col-xl-8 offset-xl-2 col-lg-12 col-md-12 mt-3" dir="rtl">
                        <div class="card">
                            <div class="card-body d-flex flex-wrap">
                                <img src="img/News/<?php echo $result['image'] ?>" class="img-thumbnail w-100">
                                <p class="card-text text-right mt-3" style="text-align: justify !important;"> <?php echo htmlentities($result['content']) ?> </p>

                                <div class="border p-3 rounded d-flex col-12 justify-content-around" dir="ltr">

                                    <div class="d-flex">
                                        <?php
                                        $sql = "SELECT COUNT(*) AS allView FROM view WHERE post_id=?";
                                        $query = $conn->prepare($sql);
                                        $query->bindValue(1, $postId);
                                        $query->execute();
                                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $res) { ?>
                                            <li class="list-unstyled fa fa-television mt-1" style="cursor: pointer;"></li>
                                            <span class="ml-2"> <?php echo $res->allView ?> </span>
                                        <?php
                                        }

                                        ?>

                                    </div>

                                    <div id="comment">
                                        <span class="fa fa-comment mt-1"> </span>

                                        <?php
                                        $sql = "SELECT COUNT(*) AS allComments FROM comment INNER JOIN post ON comment.post_id = post.post_id WHERE comment.post_id=?";
                                        $query = $conn->prepare($sql);
                                        $query->bindValue(1, $postId);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($results as $result) { ?>
                                            <span><?php echo $result['allComments'] ?></span>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div id="tiem">
                                        <span><?php echo date('Y/m/d') ?></span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 offset-xl-2 col-lg-12 col-md-12 col-sm-12 mt-3" dir="rtl">

                        <form method="POST" class="mt-5">
                            <label for="comment" class="float-right text-right bg-primary w-50 p-2 text-white font rounded">ثبت نظرات</label>
                            <input type="text" placeholder="ثبت نظر" id="comment" class="form-control" name="comment">
                            <input type="submit" class="btn btn-outline-success btn-block mt-4" value="ثبت" name="sub">
                        </form>

                    </div>


                    <div class="card col-xl-8 offset-xl-2 text-right">
                        <h5 class="card-header">نظرات کاربران</h5>

                        <?php
                        $numbers = 1;
                        $comment = "SELECT * FROM comment WHERE post_id=?";
                        $comment = $conn->prepare($comment);
                        $comment->bindValue(1, $postId);
                        $comment->execute();
                        $results = $comment->fetchAll(PDO::FETCH_OBJ);
                        if ($comment->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <div class="card-body">
                                    <p class="card-text border p-2 mt-5 rounded table table-primary" style="margin: -10px !important;" dir="rtl"> <?php echo "کاربر " . $numbers++ . "- " . $result->comment  ?> </p>


                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

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