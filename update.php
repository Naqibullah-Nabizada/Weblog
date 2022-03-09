<?php
require_once("db.php");

if (isset($_REQUEST['id'])) {

    $pid = intval($_GET['id']);

    if (isset($_POST['update'])) {

        $image = $_POST['image'];
        $news = $_POST['news'];

        if ($image !== "" && $news !== "") {

            $sql = "UPDATE post SET `image`=?, content=? WHERE post_id=?";
            $result = $conn->prepare($sql);
            $result->bindValue(1, $image);
            $result->bindValue(2, $news);
            $result->bindValue(3, $pid);
            $result->execute();

            echo "<script> alert('ویرایش موفقانه انجام شد') </script>";
            echo "<script> window.location.href='admin.php' </script>";
        } else {
            echo "<script> alert('ناموفق بود دوباره امتحان کنید') </script>";
        }
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
                <div class="card col-6 offset-3 mt-4">
                    <h5 class="card-header text-center bg-primary text-white">ثبت تازه ترین خبر ها از منابع موثق</h5>

                    <form class="col-10 offset-1 mt-4" dir="rtl" method="POST">

                        <?php

                        $sql = "SELECT `type`, `image`, content FROM post WHERE post_id=:id";
                        $query = $conn->prepare($sql);
                        $query->bindParam(':id', $pid, PDO::PARAM_STR);
                        $query->execute();
                        $result = $query->fetch();
                        if ($query->rowCount() > 0) { ?>

                            <input type="text" name="type" class="form-control" value="<?php echo $result['type'] ?>">
                            <input type="file" name="image" class="form-control mt-3" value="<?php echo $result['image'] ?>">
                            <textarea name="news" cols="30" rows="15" class="form-control mt-3"> <?php echo $result['content'] ?> </textarea>
                            <input name="update" type="submit" class="btn btn-warning btn-block mt-4 mb-۲" value="ویرایش">
                            <a href="admin.php" class="btn btn-block btn-secondary">بازگشت</a>
                        <?php
                        }
                        ?>

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