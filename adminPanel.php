<?php
require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/css.css">
</head>

<body>

    <div class="container">
        <div class="content d-flex">
            <div class="row col-8 offset-2" style="margin-top: 20vh;">

                <div class="card col-12" dir="rtl">
                    <h5 class="card-header text-center">برای ورود به صفحه ادمین ابتدا باید نام کاربری و ایمیل تان را وارد نماید.</h5>
                </div>

                <form method="POST" class="col-6 offset-3 mt-4" dir="rtl">
                    <input type="email" placeholder="ایمیل" class="form-control mt-3" name="email">
                    <input type="password" placeholder="رمز عبور" class="form-control mt-3" name="password">
                    <input type="submit" value="ورود" class="btn btn-outline-primary btn-block mt-4" name="sub">
                    <!-- <h6 id="submit" class="text-center mt-3"><a href="register.php">ثبت نام</a></h6> -->
                    <p id="error" class="text-white text-center mt-3"></p>
                </form>

            </div>
        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Custom.js"></script>

<?php

if (isset($_POST['sub'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email !== "" && $password !== "") {

        $sql = "SELECT email, `password` FROM register WHERE email=? AND `password`=?";
        $query = $conn->prepare($sql);
        $query->bindValue(1, $email);
        $query->bindValue(2, $password);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            echo "<script> window.location.href='admin.php' </script>";
        }
    } else { ?>

        <script>
            document.getElementById('error').innerHTML = "دوباره امتحان کنید.";
        </script>
<?php
    }
}


?>

</html>