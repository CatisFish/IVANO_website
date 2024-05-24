<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/custom-scroll.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="sidebar" id="sidebar">
        <?php
        include "assets/sidebar.php";
        ?>
    </div>

    <div class="content" id="content">
        <div class="container-heading-admin-page">
            <h1>Wellcom to IVANO</h1>

            <?php
            include "assets/hello-user.php";
            ?>
        </div>

        <fieldset class="content-top-page">
            <legend class="title-content-top-page">Thông Tin Chính</legend>
            <?php
            include "statistical/daily.php";
            ?>

            <?php
            include "statistical/product.php";
            ?>

            <?php
            include "statistical/order.php";
            ?>

            <?php
            include "statistical/tongdoanhthu.php";
            ?>
            </legend>
        </fieldset>

        <div class="container-total-orders">
            <h2>Thống Kê Đơn Hàng</h2>
            <div class="statistic-month-year">
                <?php include "statistical/thongke_donhang.php"; ?>
            </div>
        </div>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Montserrat", sans-serif;
            }

            .container-heading-admin-page {
                padding: 10px 20px;
                background: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            }

            .container-heading-admin-page h1 {
                color: #fff;
            }

            .content {
                margin-left: 18%;
                padding: 20px;
                transition: margin-left 0.3s ease;
            }

            .content-top-page {
                border: 2px solid #ccc;
                border-radius: 8px;
                padding: 20px;
                margin: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
            }

            legend {
                font-size: 25px;
                font-weight: 700;
                color: #333;
                padding: 0 15px;
                text-align: center;

            }

            .container-total-orders {
                margin-top: 30px;
            }

            .container-total-orders h2 {
                text-align: center;
            }

            .statistic-month-year {
                display: flex;
                gap: 10%;
            }
        </style>
        <!-- <script src="js/app.js"></script> -->
</body>

</html>