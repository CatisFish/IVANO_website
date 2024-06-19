<?php
session_start();

if (isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];

    if (isset($loggedInUsername)) {
        $initial = substr($loggedInUsername, 0, 1);
    } else {
        echo "Không có tên người dùng đăng nhập";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global-style-ad.css">
    <title>Trang Quản trị | IVANO</title>
</head>

<style>
    .main-admin-page {
        margin-left: 18%;
        border-left: 1px solid #fff;
        width: 82%;
        transition: all ease-in-out 0.3s;
    }


    .main-info {
        display: flex;
        margin: auto;
    }

    .left-info {
        margin: 20px;
    }

    .oders_tal {
        width: 100%;
    }

    .count-info {
        display: flex;
        width: 100%;
    }
</style>

<body>
    <div class="container-admin-page">

        <?php include "assets/sidebar-new.php"; ?>

        <main class="main-admin-page">
            <section class="main-top-admin-page">
                <div class="main-top-left-admin-page">
                    <a href="">Trang Quản Trị</a>
                </div>

                <?php include "assets/hello-user.php"; ?>
            </section>
            <section class="main-info">
                <div class="right-info">
                    <div class="top-product">
                        <?php
                        include './statistical/top_product.php';
                        ?>
                    </div>

                </div>
                <div class="left-info">
                    <div class="count-info">
                        <div class="revenue">
                            <?php
                            include './statistical/tongdoanhthu.php';
                            ?>
                        </div>

                        <div class="oders">
                            <?php
                            include './statistical/order.php';
                            ?>
                        </div>
                        <div class="product-tal">
                            <?php
                            include './statistical/product.php';
                            ?>
                        </div>
                        <div class="agency-tal">
                            <?php
                            include './statistical/daily.php';
                            ?>
                        </div>
                    </div>
                    <div class="oders_tal">
                        <?php
                        include './statistical/thongke_donhang.php';
                        ?>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

<script>
    document.getElementById("show-hide-sidebar-ad").addEventListener("click", function () {
        var sidebar = document.querySelector(".container-sidebar-ad");
        var main = document.querySelector(".main-ad-page");
        var h3 = document.querySelector(".sidebar-top-ad h3");
        var spans = document.querySelectorAll(".sidebar-bottom-ad span");
        var topSidebarIcon = document.querySelector(".sidebar-top-ad button i");

        if (sidebar.style.width === "5%") {
            sidebar.style.width = "18%";
            main.style.width = "82%";
            main.style.marginLeft = "18%";
            h3.style.display = "block";
            spans.forEach(span => {
                span.style.display = "inline";
            });
            sidebar.classList.remove("sidebar-collapsed");
            topSidebarIcon.style.transform = "rotate(0deg)";
        } else {
            sidebar.style.width = "5%";
            main.style.width = "95%";
            main.style.marginLeft = "5%";
            h3.style.display = "none";
            spans.forEach(span => {
                span.style.display = "none";
            });
            sidebar.classList.add("sidebar-collapsed");
            topSidebarIcon.style.transform = "rotate(180deg)";
        }
    });

</script>

</html>