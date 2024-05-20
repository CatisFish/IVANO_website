<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <!-- <link rel="stylesheet" href="../css/responsive-header.css"> -->
    <link rel="stylesheet" href="css/custom-scroll.css">


    <title>Trang Chủ | IVANO</title>
</head>

<body>
    <main id="main-page">
        <?php
        include "assets/header.php";
        ?>

        <?php
        include "assets/banner.php";
        ?>

        <?php
            include "assets/sales.php";
        ?>

        <?php
        include "assets/banner-news.php";
        ?>

        <section class="container-outstanding">
            <h1>Sản Phẩm Nổi Bật</h1>

            <?php
            include "assets/outstanding.php";
            ?>

            <div class="container-btn-see-more">
                <button type="button" class="see-more">
                    <a href="all-item.php">Xem Thêm</a>
                </button>
            </div>
        </section>

        <section class="container-show-list-category">
            <h1>Thương Hiệu Nổi Bật</h1>

            <?php 
                include "assets/show-brand.php";
            ?>
        </section>

        <?php
            include "assets/certification.php";
        ?>


        <?php
            include "assets/popup.php";
        ?>
    </main>

    <style>
        #main-page{
            position: relative;
        }

        .container-btn-see-more{
            margin-bottom: 20px;
            text-align: center;
        }

        .see-more{
            padding: 15px 50px;
            border: none;
            background-color: #dd9933;
            font-weight: 600;
            cursor: pointer;
            transition: all ease-in-out 0.3s;
        }

        .see-more a{
            color: #fff;
        }

        .see-more:hover{
            background-color: #fb9c0d;
        }
    </style>
</body>


</html>