<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="sidebar" id="sidebar">
        <?php
            include "assets/sidebar.php";
        ?>
    </div>

    <div class="content" id="content">
       
        <div class="content-box">
            <?php include "../php/thongke/thongke_sodaily.php"; ?>
        </div>
        <div class="content-box">
            <?php include "../php/thongke/thongke_user.php"; ?>
        </div>
        <div class="content-box">
            <?php include "../php/thongke/thongke_sodonhang.php"; ?>
        </div>
        <div class="content-box">
            <?php include "../php/thongke/thongke_soluongsanpham.php"; ?>
        </div>
        <div class="content-box">
            <?php include "../php/thongke/top_product.php"; ?>
        </div>
        <div class="content-box">
            <?php
                include "../php/thongke/doanhthu_theohoadon.php";
                include "../php/thongke/donhang_theothang.php";
                include "../php/thongke/donhang_theonam.php";
            ?>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>
