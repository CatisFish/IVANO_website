<?php
session_start();

if (isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];

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