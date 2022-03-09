<aside class="col-xl-3 ml-xl-5 col-lg-4 col-md-5 offset-md-0 col-sm-8 col-10 mt-3">

    <div class="card mt-3" dir="rtl">
        <h6 id="media" class="text-center bg-dark font-weight-bold card-header">ما را در شبکه های اجتماعی دنبال کنید.</h6>

        <ul class="d-flex justify-content-center">
            <li>
                <a href="#" class="fa fa-facebook-square m-2" title="Facebook"></a>
            </li>
            <li>
                <a href="#" class="fa fa-instagram m-2" title="Instagram"></a>
            </li>
            <li>
                <a href="#" class="fa fa-twitter m-2" title="Twitter"></a>
            </li>
            <li>
                <a href="#" class="fa fa-telegram m-2" title="Telegram"></a>
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <h4 class="card-header bg-dark text-center" id="promotions">تبلیغات شما در اینجا</h4>
    </div>

    <?php

    $sql = "SELECT `image`, content FROM post WHERE `type`= 'تبلیغات'";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($result as $res) { ?>

            <div class="text-right mt-3">
                <div class="card mb-4">
                    <h6 class="card-text text-center bg-dark p-3 mt-4" dir="rtl"> <?php echo $res->content ?> </h6>
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="img/Label/<?php echo $res->image ?>" alt="" class="img-fluid w-75 d-flex m-auto">
                            </div>

                        </div>
                    </div>
                </div>
        <?php
        }
    } ?>
            </div>

</aside>