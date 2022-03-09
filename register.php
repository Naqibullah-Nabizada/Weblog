<?php
require_once("db.php");

if (isset($_POST['sub'])) {

    $name = $_POST['firstname'];
    $family = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($name !== "" && $family !== "" && $email !== "" && $password !== "") {

        $sql = "INSERT INTO register SET firstname=?, lastname=?, email=?, password=?";
        $result = $conn->prepare($sql);

        $result->bindValue(1, $name);
        $result->bindValue(2, $family);
        $result->bindValue(3, $email);
        $result->bindValue(4, $password);
        $result->execute();

        echo "<script> alert('ثبت نام با موفقیت انجام شد') </script>";
        echo "<script> window.location.href='adminPanel.php' </script>";
    } else {

        echo "<script> alert('ثبت نام ناموفق بود دوباره امتحان کنید') </script>";
    }
}
?>


<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="font/css/font-awesome.css">
</head>


<body>
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="card col-6 offset-3 mt-5" dir="rtl">
                    <h5 class="card-header text-center bg-s">برای ورود به سایت ابتدا باید خود را ثبت نام نماید.</h5>
                </div>

                <form method="POST" class="col-4 offset-4 mt-3" dir="rtl">
                    <input type="text" placeholder="نام" class="form-control mt-3" id="fname" name="firstname">
                    <input type="text" placeholder="نام خانوادگی" class="form-control mt-3" id="lname" name="lastname">
                    <input type="email" placeholder="ایمیل" class="form-control mt-3" id="email" name="email">
                    <input type="password" placeholder="رمز عبور" class="form-control mt-3" id="password" name="password">
                    <input type="submit" class="btn btn-outline-primary btn-block mt-3" value="ثبت نام" id="sub" name="sub">
                    <p class="h6 text-danger text-center mt-3" id="error"></p>
                </form>

            </div>
        </div>
    </div>

</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Custom.js"></script>

</html>