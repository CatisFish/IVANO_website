<?php
ob_start(); 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">

    <title>Trang Chủ | IVANO</title>
</head>

<body>
    <main id="main-page">
        <?php include "assets/header.php"; ?>

        <?php include "assets/banner-test.php"; ?>

        <?php include "assets/sales.php"; ?>

        <section class="container-fsale">
            <div class="container-heading-fsale">
                <h2 class="title-fsale">Flash Sale</h2>
                <button class="see-more-fsale">
                    <a href="">Xem Thêm</a>
                </button>
            </div>
           
            <?php include "assets/flsale.php"; ?>
        </section>

        <?php include "assets/banner-news.php"; ?>

        <section class="container-outstanding">
            <div class="container-heading-oustanding">
                <h1>Sản Phẩm Nổi Bật</h1>

                <button class="see-more">
                    <a href="all-item.php">Xem Thêm</a>
                </button>
            </div>

            <?php include "assets/outstanding.php"; ?>
        </section>

        <section class="container-show-list-category">
            <h1>Thương Hiệu Nổi Bật</h1>
            <?php include "assets/show-brand.php"; ?>
        </section>

        <?php include "assets/certification.php"; ?>

        <?php include "assets/comment-show.php"; ?>

        <?php include "assets/footer.php"; ?>
    </main>

    <style>
        #main-page {
            position: relative;
        }
    </style>
</body>

<?php
// Kết nối tới cơ sở dữ liệu;
include 'php/conection.php';

// Lấy product_id từ URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Tăng click_count trong bảng products_clicks
    $sql = "UPDATE products_clicks SET click_count = click_count + 1 WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo "Click count updated successfully";
    } else {
        echo "Error updating click count: " . $conn->error;
    }
} else {

}

$conn->close();
?>

</html>