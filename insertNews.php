<?php
require_once("db.php");

if (isset($_POST['sub'])) {

    $type = $_POST['type'];
    $image = $_POST['image'];
    $news = $_POST['news'];

    if ($type !== "" && $image !== "" && $news !== "") {

        $sql = "INSERT INTO post SET `type`=?, `image`=?, content=?";
        $result = $conn->prepare($sql);
        $result->bindValue(1, $type);
        $result->bindValue(2, $image);
        $result->bindValue(3, $news);
        $result->execute();

        echo "<script> alert('ثبت خبر جدید موفقانه انجام شد') </script>";
        // echo "<script> window.location.href='index.php' </script>";
    } else {
        echo "<script> alert('ناموفق بود دوباره امتحان کنید') </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/css.css">
</head>

<body>

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="card col-6 offset-3 mt-5">
                    <h5 class="card-header text-right">ثبت تازه ترین خبر ها از منابع موثق</h5>

                    <form class="col-10 offset-1 mt-5" dir="rtl" method="POST">

                        <input name="type" type="text" placeholder="نوعیت خبر" class="form-control">
                        <input name="image" type="file" class="form-control mt-3">
                        <textarea name="news" cols="30" rows="7" placeholder="متن خبر" class="form-control mt-3"></textarea>
                        <input name="sub" type="submit" class="btn btn-primary btn-block mt-4 mb-3" value="ثبت">
                        <a href="admin.php" class="btn btn-secondary btn-block mb-3">بازگشت</a>
                    </form>

                </div>


            </div>
        </div>
    </div>

</body>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Custom.js"></script>

</html>