<?php
require_once("db.php");

if (isset($_REQUEST['del'])) {

    $pid = intval($_GET['del']);

    $sql = "DELETE FROM post WHERE post_id=?";
    $result = $conn->prepare($sql);
    $result->bindValue(1, $pid);
    $result->execute();

    echo "<script> alert('خبر با موفقیت حذف شد') </script>";
    echo "<script> window.location.href='admin.php' </script>";
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

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        <main class="col-xl-8 offset-xl-0 col-lg-6 offset-lg-1 col-md-7 offset-md-0 col-sm-8 offset-sm-2 col-10 offset-1 mt-3" dir="rtl">

            <div class="d-flex flex-wrap">

                <!--=================================================== Search ==========================================================-->
                <?php
                if (isset($_POST['search'])) {
                    // echo "<script> window.location.href='search.php' </script>";
                    $search = $_POST['searchbox'];

                    $sql = "SELECT `image`, content FROM post WHERE `type` LIKE '$search' ";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($result as $res) { ?>

                            <div class="col-xl-6 col-lg-12 col-md-12 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="img/News/<?php echo $res->image ?>" class="img-thumbnail w-100" style="height: 200px">
                                        <p class="card-text text-justify "> <?php echo $res->content ?> </p>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        echo "No";
                    }
                    exit();
                }
                ?>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">

                    <form method="POST" class="d-flex justify-content-center">

                        <input type="text" name="searchbox" placeholder="دنبال چی میگردی؟" class="form-control col-9 col-md-8 col-lg-7 col-xl-6 ml-3">
                        <input type="submit" name="search" value="جستجو" class="btn btn-outline-success offset-1 col-3 col-md-2">

                    </form>

                </div>
                <!--=============================================================== Main =============================================================-->
                <?php

                $sql = "SELECT post_id,`image`, content FROM post WHERE `type` <> 'تبلیغات' ORDER BY post_id DESC";
                $query = $conn->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() > 0) {
                    foreach ($result as $res) { ?>

                        <div class="col-xl-6 col-lg-12 col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="img/News/<?php echo $res->image ?>" class="img-thumbnail w-100" style="height: 250px">
                                    <p class="card-text text-justify "> <?php echo substr($res->content, 0, 400) . "..." ?> </p>

                                    <a href="update.php?id=<?php echo $res->post_id ?>" class="btn btn-warning btn-block">ویرایش</a>
                                    <a href="admin.php?del=<?php echo $res->post_id ?>" class="btn btn-danger btn-block" onclick="return confirm('آیا موافق هستید این خبر حذف شود؟')">حذف</a>
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


        <aside class="col-xl-3 ml-xl-5 col-lg-4 col-md-5 offset-md-0 col-sm-8 col-10 mt-3">

            <a href="insertNews.php" class="btn btn-primary btn-block">وارد کردن خبر جدید</a>
            <a href="index.php" class="btn btn-secondary btn-block">بازگشت</a>

            <div class="card mt-3" dir="rtl">
                <h6 class="text-center card-header">ما را در شبکه های اجتماعی دنبال کنید.</h6>

                <ul class="d-flex">
                    <li>
                        <a href="#" class="fa fa-facebook-square mr-1" title="Facebook"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-instagram mr-4" title="Instagram"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-twitter mr-4" title="Twitter"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-telegram mr-4" title="Telegram"></a>
                    </li>
                </ul>
            </div>

            <div class="card mt-3">
                <h4 class="card-header bg-dark text-white text-center">تبلیغات شما در اینجا</h4>
            </div>

            <?php

            $sql = "SELECT post_id, `image`, content FROM post WHERE `type`= 'تبلیغات'";
            $query = $conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($result as $res) { ?>

                    <div class="text-right mt-3">
                        <div class="card mb-4">
                            <h6 class="card-text bg-primary p-2 text-white mt-4"> <?php echo $res->content ?> </h6>
                            <div class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img src="img/Label/<?php echo $res->image ?>" alt="" class="img-fluid d-flex w-75 m-auto">
                                    </div>

                                </div>
                            </div>
                            <a href="update.php?id=<?php echo $res->post_id ?>" class="btn btn-block btn-warning mt-2">ویرایش</a>
                            <a href="admin.php?del=<?php echo $res->post_id ?>" class="btn btn-block btn-danger mt-2" onclick="return confirm('آیا موافق هستید حذف شود؟')">حذف</a>

                        </div>
                <?php
                }
            } ?>
                    </div>

        </aside>


        <!-----------------------------------------------footer --------------------------------------->


        <footer class="col-12" dir="rtl">
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

</html>