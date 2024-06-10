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
            padding: 10px 0;
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

<!-- fix bootstrap -->
<style>
    .header-top p {
        margin-bottom: 0;
    }

    .ft-bottom p {
        margin-bottom: 0;
    }
</style>

<!-- css-cart -->
<style>
    #show-cart {
        position: absolute;
        width: 400px;
        height: 90vh;
        box-shadow: 0 8px 10px 0 rgb(0 0 0 / 10%);
        right: -65px;
        top: 0px;
        background-color: #221F20;
        border-radius: 10px;
        transition: all ease-in-out 0.3s;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    #my-cart {
        /* overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #999 transparent;
        overflow-x: hidden; */
        padding: 10px;
    }

    #show-cart.show {
        opacity: 1;
        right: 0px;
        transition: all ease-in-out 0.3s;
        visibility: visible;
        pointer-events: auto;
    }

    #lenght-cart {
        font-size: 15px;
        position: absolute;
        top: 20%;
        right: -10px;
        color: #000;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
    }

    .top-cart {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #464545;
    }

    .top-cart p {
        font-size: 20px;
        font-weight: 600;
        color: #FFF;
        margin-bottom: 0;
    }

    .close-cart-btn {
        background-color: transparent;
        border: none;
        background-color: #fff;
        color: #ff0000;
        font-size: 16px;
        cursor: pointer;
        padding: 5px 8px;
    }

    #cart-items {
        margin-top: 10px;
        height: 440px;
        max-height: 440px;
        overflow-y: auto;
        scrollbar-width: none;
        overflow-x: hidden;
    }

    #cart-items::-webkit-scrollbar {
        width: 0;
    }

    .title-none-cart {
        text-align: center;
        margin: 200px 0 175px 0;
        font-weight: 700;
        color: #FFF;
    }
</style>

<?php 
    if (!isset($searchQuery)) {
    $searchQuery = '';
    }
?>

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

                        <form class="search-box-mobile" action="../assets/search.php" method="GET">
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
                    <form class="search-box" method="GET">
                        <input type="text" name="search" placeholder="Nhập nội dung cần tìm..." class="search-text"
                            id="search" value="<?php echo htmlspecialchars($searchQuery); ?>">
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <ul class="container-nav-right-item">
                        <a href="" class="view-orders item-nav-right"><i class="fa-solid fa-headphones-simple"></i></a>

                        <a href="login.php" class="login-link item-nav-right"><i class="fa-regular fa-user"></i></a>

                        <div class="shopping-cart-page">
                            <a href="#">
                                <i class="fa-solid fa-basket-shopping item-nav-right"></i>
                                <p id="lenght-cart"></p>
                            </a>

                            <div id="show-cart">
                                <div id="my-cart">
                                    <div class="top-cart">
                                        <p>Giỏ Hàng</p>
                                        <button type="button" class="close-cart-btn">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div id="cart-items">
                                        <!-- item here -->
                                    </div>

                                    <div class="cart-bottom">
                                        <p class="cart-total">Tổng tiền: <span>0</span></p>

                                        <button class="clear-cart-btn" type="button">Clear giỏ hàng</button>
                                        <button class="checkout-btn">
                                            <a href="cart-page.php">Thanh Toán</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
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

<!-- add-to-cart -->
<script src="js/test.js">
</script>

<style>
    .cart-item {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        align-items: center;
        position: relative;
    }

    .cart-item-image {
        width: 100px;
        height: 120px;
        object-fit: cover;
        margin-right: 5px;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 15px;
        color: #dd9933;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .item-price {
        font-size: 14px;
        color: #1E90FF;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .item-quantity {
        font-size: 13px;
        color: #fff;
        margin-top: 5px;
        margin-bottom: 0;
    }

    .item-size {
        margin-top: 10px;
        color: #FFF;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .item-color {
        color: #FFF;
        font-size: 14px;
    }

    .delete-cart-item {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background-color: #d32f2f;
        border: none;
        color: #fff;
    }

    .cart-bottom {
        margin-top: 10px;
    }

    .cart-total {
        color: #1E90FF;
        font-weight: 600;
        text-align: right;
        font-size: 14px;
    }

    .clear-cart-btn {
        width: 100%;
        padding: 10px;
        font-size: 15px;
        margin: 0 0 10px 0;
        background-color: #d32f2f;
        color: #fff;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
    }

    .clear-cart-btn:hover {
        transform: translateY(-5px);
    }

    .checkout-btn {
        width: 100%;
        padding: 7px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        background-color: rgb(13 167 109);
        transition: all ease-in-out 0.3s;
    }

    .checkout-btn a {
        font-size: 15px;
        color: #fff;
    }

    .checkout-btn:hover {
        background-color: rgb(0, 208, 130);
    }
</style>

<!-- show-cart -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartIcon = document.querySelector('.fa-basket-shopping');
        cartIcon.addEventListener('click', function (event) {
            event.preventDefault();
            var showCart = document.getElementById('show-cart');

            if (!showCart.classList.contains('show')) {
                showCart.classList.add('show');
            }
        });


        var closeBtn = document.querySelector('.close-cart-btn');
        closeBtn.addEventListener('click', function (event) {
            event.preventDefault();
            var showCart = document.getElementById('show-cart');
            showCart.classList.remove('show');
        });
    });
</script>

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

<!-- Show lenght-cart khi có class fixed -->
<script>
    var cartLength = document.getElementById('lenght-cart');
    var header = document.querySelector('.header-bottom');

    function updateCartLengthPosition() {
        if (header.classList.contains('fixed-header') && header.classList.contains('active')) {
            cartLength.style.right = '4%';
        } else {
            cartLength.style.right = '-10px';
        }
    }

    window.addEventListener('scroll', updateCartLengthPosition);

    window.addEventListener('resize', updateCartLengthPosition);
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

<!-- sweetalert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>