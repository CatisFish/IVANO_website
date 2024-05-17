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
        include "assets/banner-news.php";
        ?>

        <section class="container-outstanding">
            <h1>Sản Phẩm Nổi Bật</h1>

            <?php
            include "assets/outstanding.php";
            ?>
        </section>

        <style>
            .container-outstanding {
                width: 80%;
                margin: 0 auto;
                position: relative;
            }

            .container-outstanding h1 {
                text-align: center;
                font-size: 30px;
                position: relative;
                z-index: 1;
                color: #FC0000;
                text-transform: uppercase;
            }

            .container-outstanding h1::before,
            .container-outstanding h1::after {
                content: "";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                height: 1px;
                /* background-color: rgba(252, 185, 0, 1); */
                width: 35%;
                background-color: #FC0000;
            }

            .container-outstanding h1::before {
                left: 0;
            }

            .container-outstanding h1::after {
                right: 0;
            }
        </style>

        <section class="container"></section>

        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn" id="close-btn">&times;</span>
                <h2>Thông tin mới</h2>
                <p>Đây là các thông tin mới nhất...</p>
            </div>
        </div>

        <style>
            /* Popup container - can be anything you want */
            .popup {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1;
                /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgba(0, 0, 0, 0.5);
                /* Black w/ opacity */
            }

            /* Popup content */
            .popup-content {
                position: relative;
                background-color: #fff;
                margin: 15% auto;
                /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                /* Could be more or less, depending on screen size */
                max-width: 500px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                border-radius: 10px;
                animation: slideInUp 0.5s ease-out;
                /* Animation for sliding in */
            }

            /* Animation keyframes */
            @keyframes slideInUp {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            /* Close button */
            .close-btn {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close-btn:hover,
            .close-btn:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </main>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the popup
        var popup = document.getElementById('popup');

        // Get the <span> element that closes the popup
        var closeBtn = document.getElementById('close-btn');

        // When the user clicks on <span> (x), close the popup
        closeBtn.onclick = function () {
            popup.style.display = 'none';
        }

        // Show the popup after 10 seconds
        setTimeout(function () {
            popup.style.display = 'block';
        }, 10000);

        // Close the popup if the user clicks anywhere outside of the popup
        window.onclick = function (event) {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        }
    });


</script>

</html>