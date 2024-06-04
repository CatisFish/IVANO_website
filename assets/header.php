<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <title>Document</title>
</head>
<!-- scroll to top -->
<style>
    .top-page-btn {
        z-index: 10;
        background-color: rgb(74, 234, 220);
        width: 50px;
        height: 50px;
        border: none;
        transition: all 0.3s ease-in-out;
        position: fixed;
        right: 5px;
        bottom: 5px;
        color: #221F20;
        z-index: 999;
        opacity: 0;
        cursor: pointer;
        border-radius: 10px
    }

    .top-page-btn:hover {
        transform: translateY(-5px);
    }
</style>
<style>
    .bar-mobile-btn,
    .close-bar-btn,
    .search-box-mobile {
        display: none;
    }

    .wrapper-header-top {
        background: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
    }

    .header-top {
        width: 90%;
        margin: 0px auto;
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        align-items: center;
        color: #FFF;
    }

    .header-top p {
        text-align: center;
        font-weight: 600;
        font-size: 12px;
    }

    .header-top-right {
        display: flex;
        gap: 20px;
    }

    .wrapper-header-bottom {
        background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%);
    }

    .header-bottom {
        width: 90%;
        height: 90px;
        margin: 0px auto;
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 30px 0;
        align-items: center;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .logo-page {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .logo-page img {
        width: 170px;
        transition: all ease-in-out 0.3s;
    }

    .logo-page:hover img {
        scale: 105%;
    }

    .container-nav-item {
        display: flex;
        gap: 20px;
        text-align: center;
        padding: 10px 0;
    }

    .nav-item {
        font-weight: 600;
    }

    .nav-item a {
        transition: all ease-in-out 0.3s;
    }

    .nav-item:hover a {
        color: #FFF;
    }

    .search-box {
        background: #fff;
        border: 1px solid #fff;
        border-radius: 30px;
        margin-right: 20px;
        position: relative;
    }

    .search-text {
        background: #fff;
        border: none;
        outline: none;
        background: none;
        width: 230px;
        padding: 10px 10px 10px 20px;
        transition: all 0.50s ease-in-out;
        color: #221f20;
    }

    .search-btn {
        background-color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 50%;
        padding: 10px 15px;

    }

    .nav-right {
        display: flex;
        align-items: center;
    }

    .container-nav-right-item {
        display: flex;
        margin-left: 20px;
        gap: 30px;
        font-size: 20px;
    }

    .view-orders {
        padding-left: 40px;
        border-left: 1px solid #000;
    }


    /* header-fixed */
    .fixed-header {
        background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%);
        transition: transform 0.5s ease, top 0.5s ease;
        position: fixed;
        top: -100%;
        left: 0;
        width: 100%;
        padding: 0px 5%;
        z-index: 99;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .fixed-header.active {
        top: 0;
        transform: translateY(0);
    }

    @media only screen and (max-width: 600px) {
        .bar-mobile-btn {
            display: block;
            background: none;
            border: none;
            color: #FFF;
            font-size: 20px;
            cursor: pointer;
        }

        .header-top {
            width: 90%;
            margin: 0px auto;
            justify-content: center;
            padding: 5px 0;
            align-items: center;
            color: #FFF;
        }

        .header-top p {
            font-weight: 600;
            font-size: 10px;
        }

        .header-bottom {
            height: 60px;
            padding: 20px 0;
        }

        .logo-page img {
            width: 100px;
        }

        .nav-left {
            position: fixed;
            background-color: #eee;
            left: -100%;
            width: 50%;
            height: 100vh;
            top: 0;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
            font-weight: 600;
            font-size: 13px;
        }

        .nav-left.show {
            left: 0;
        }

        .close-bar-btn {
            position: absolute;
            right: 0px;
            top: 0px;
            width: 30px;
            height: 30px;
            background-color: #f44336;
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .close-bar-btn i {
            font-size: 15px;
        }

        .close-bar-btn:active {
            background-color: #d32f2f;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .search-box-mobile {
            display: flex;
            width: 100%;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .search-text-mobile {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            width: 90%;

        }

        .search-btn-mobile {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            margin-left: 10px;
        }

        .container-nav-item {
            flex-direction: column;
            display: flex;
            margin-top: 40px;
        }

        .nav-item {
            transition: all 0.3s ease;
            margin: -10px 0;
        }

        .nav-item.active a,
        .nav-item:hover a {
            background-color: aqua;
            color: #FFF;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .nav-item a {
            display: block;
            padding: 20px;
            border-bottom: 1px solid #FFF;
            transition: all 0.3s ease;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .search-box {
            display: none;
        }

        .container-nav-right-item {
            display: flex;
            gap: 20px;
            font-size: 15px;
        }

        .view-orders {
            padding-left: 0;
            border-left: none;
        }

        .fixed-header {
            background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%);
            transition: transform 0.5s ease, top 0.5s ease;
            position: fixed;
            top: -100%;
            left: 0;
            width: 100%;
            padding: 0px 5%;
            z-index: 99;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .fixed-header.active {
            top: 0;
            transform: translateY(0);
        }
    }

    /* Styles for tablet */
    /* @media only screen and (min-width: 601px) and (max-width: 1335px) {
    .bar-mobile-btn {
        display: block;
        background: none;
        border: none;
        color: #FFF;
        font-size: 20px;
        cursor: pointer;
    }

    .header-top {
        width: 90%;
        margin: 0px auto;
        justify-content: space-between;
        padding: 10px 0;
        align-items: center;
        color: #FFF;
    }


    .header-top p {
        font-weight: 600;
        font-size: 10px;
    }

    .header-bottom {
        height: 70px;
        padding: 20px 0;
    }

    .logo-page img {
        width: 120px;
    }

    .nav-left {
        position: fixed;
        background-color: #eee;
        left: -100%;
        width: 35%;
        height: 100vh;
        top: 0;
        transition: all 0.3s ease-in-out;
        z-index: 1000;
        font-weight: 600;
        font-size: 13px;
    }

    .nav-left.show {
        left: 0;
    }

    .close-bar-btn {
        position: absolute;
        right: 0px;
        top: 0px;
        width: 30px;
        height: 30px;
        background-color: #f44336;
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .close-bar-btn i {
        font-size: 20px;
    }

    .close-bar-btn:active {
        background-color: #d32f2f;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .search-box-mobile {
        display: flex;
        width: 100%;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }

    .search-text-mobile {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 12px;
        width: 90%;
    }

    .search-btn-mobile {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 12px;
        margin-left: 10px;

    }

    .container-nav-item {
        flex-direction: column;
        display: flex;
        margin-top: 40px;
    }

    .nav-item {
        transition: all 0.3s ease;
        margin: -10px 0;
    }

    .nav-item.active a,
    .nav-item:hover a {
        background-color: aqua;
        color: #FFF;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .nav-item a {
        display: block;
        padding: 20px;
        border-bottom: 1px solid #FFF;
        transition: all 0.3s ease;
    }


    .nav-right {
        display: flex;
        align-items: center;
    }

    .search-box {
        display: none;
    }

    .container-nav-right-item {
        display: flex;
        gap: 20px;
        font-size: 16px;
    }
} */
</style>

<body>
    <header id="header-page">
        <div class="wrapper-header-top">
            <section class="header-top">
                <p>ĐIỂM TÔ CUỘC SỐNG - TIẾP BƯỚC THÀNH CÔNG</p>
            </section>
        </div>

        <div class="wrapper-header-bottom">
            <section class="header-bottom">

                <button class="bar-mobile-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <nav class="nav-left">
                    <button class="close-bar-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <ul class="container-nav-item">

                        <form class="search-box-mobile" action="search.php" method="GET">
                            <input type="text" class="search-text-mobile" placeholder="Nhập sản phẩm cần tìm..."
                                name="search" required>
                            <button type="submit" class="search-btn-mobile"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>

                        <li class="nav-item"><a href="all-item.php">Sản Phẩm</a></li>
                        <li class="nav-item"><a href="dai-ly.php">Đại Lý</a></li>
                        <li class="nav-item"><a href="">Bảng Màu</a></li>
                        <li class="nav-item"><a href="">Tuyển Dụng</a></li>
                    </ul>
                </nav>

                <a href="index.php" class="logo-page"><img src="images/logo.png" alt="LOGO"></a>

                <nav class="nav-right">
                    <form class="search-box" action="search.php" method="GET">
                        <input type="text" class="search-text" placeholder="Nhập sản phẩm cần tìm..." name="search"
                            required>
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <ul class="container-nav-right-item">
                        <a href="" class="view-orders item-nav-right"><i class="fa-solid fa-headphones-simple"></i></a>

                        <a href="login-register/index.html" class="login-link item-nav-right"><i
                                class="fa-regular fa-user"></i></a>

                        <div class="shopping-cart-page" onclick="showCart(event)">
                            <a href="#">
                                <i class="fa-solid fa-basket-shopping item-nav-right"></i>
                                <p id="lenght-cart"></p>
                            </a>
                        </div>
                    </ul>
                </nav>
            </section>
        </div>
    </header>

    <button class="top-page-btn">
        <i class="fa-solid fa-angle-up"></i>
    </button>
</body>

<!-- show-hide-bar-btn -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.matchMedia("(max-width: 600px)").matches) {
            const barMobileBtn = document.querySelector('.bar-mobile-btn');
            const navLeft = document.querySelector('.nav-left');
            const closeBarBtn = document.querySelector('.close-bar-btn');

            barMobileBtn.addEventListener('click', function () {
                navLeft.classList.toggle('show');
            });

            closeBarBtn.addEventListener('click', function () {
                navLeft.classList.remove('show');
            });
        }
    });
</script>

<!-- fixed-header -->
<script>
    window.addEventListener('scroll', function () {
        var headerBottom = document.querySelector('.header-bottom');
        var scrollPosition = window.scrollY || window.pageYOffset;

        if (scrollPosition > 10 && !headerBottom.classList.contains('fixed-header')) {
            headerBottom.classList.add('fixed-header');
            setTimeout(function () {
                headerBottom.classList.add('active');
            }, 10);
        } else if (scrollPosition <= 10 && headerBottom.classList.contains('fixed-header')) {
            headerBottom.classList.remove('active');
            setTimeout(function () {
                headerBottom.classList.remove('fixed-header');
            }, 250);
        }
    });
</script>

<!-- scroll-to-top -->
<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    var topButton = document.querySelector('.top-page-btn');

    topButton.addEventListener('click', scrollToTop);

    window.addEventListener('scroll', function () {
        if (window.scrollY > 10) {
            topButton.style.opacity = '1';
            topButton.style.pointerEvents = 'auto';
            topButton.classList.add('visible');
        } else {
            topButton.style.opacity = '0';
            topButton.style.pointerEvents = 'none';
            topButton.classList.remove('visible');
        }
    });
</script>

</html>