<link rel="stylesheet" href="css/scroll-to-top.css">

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

                    <li class="nav-item">
                        <a href="all-item.php">Sản Phẩm <i class="fa-solid fa-angle-down"></i></a>

                        <ul class="submenu-brands">
                            <li class="submenu-brand-item"><a href="#">Sơn IVANO <i
                                        class="fa-solid fa-arrow-right"></i></a></li>
                            <li class="submenu-brand-item"><a href="#">Sơn MEKONG <i
                                        class="fa-solid fa-arrow-right"></i></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="dai-ly.php">Đại Lý</a></li>
                    <li class="nav-item"><a href="">Bảng Màu</a></li>
                    <li class="nav-item"><a href="">Tuyển Dụng</a></li>
                </ul>
            </nav>

            <a href="index.php" class="logo-page"><img src="images/logo.png" alt="LOGO"></a>

            <nav class="nav-right">
                <form class="search-box" method="GET">
                    <input type="text" name="search" placeholder="Nhập nội dung cần tìm..." class="search-text"
                        id="search">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <ul class="container-nav-right-item">
                    <a href="" class="view-orders item-nav-right"><i class="fa-solid fa-headset"></i></a>

                    <a href="login.php" class="login-link item-nav-right"><i class="fa-regular fa-user"></i></a>

                    <div class="shopping-cart-page">
                        <a href="cart-page.php">
                            <i class="fa-solid fa-basket-shopping item-nav-right"></i>
                            <p id="lenght-cart"></p>
                        </a>

                        <div id="show-cart">
                            <div id="my-cart">
                                <div class="top-cart">
                                    <p>Giỏ Hàng</p>
                                    <button type="button" class="see-cart"><a href="cart-page.php">Xem giỏ</a></button>
                                </div>
                                <div id="cart-items">
                                    <!-- item here -->
                                </div>

                                <div class="cart-bottom">
                                    <p class="cart-total">Tổng tiền: <span>0 VNĐ</span></p>

                                    <a href="checkout.php" class="let-cart-link">Thanh Toán <i
                                            class="fa-solid fa-arrow-right"></i></a>
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

<div class="overlay" id="overlay"></div>

<style>
    .bar-mobile-btn,
    .close-bar-btn,
    .search-box-mobile {
        display: none;
    }

    #header-page {
        position: fixed;
        top: 0;
        width: 100%;
        transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
        z-index: 1000;
    }

    #header-page.hidden {
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
    }

    .wrapper-header-top {
        /* background: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%); */
    }

    .header-top {
        width: 95%;
        margin: 0px auto;
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        align-items: center;
        color: #221F20;
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
        /* background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%); */
    }

    .header-bottom {
        background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(7.5px);
        -webkit-backdrop-filter: blur(7.5px);
        border-radius: 35px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        width: 95%;
        height: 60px;
        margin: 0px auto;
        display: flex;
        justify-content: space-between;
        position: relative;
        border-radius: 50px;
        padding: 35px 30px;
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
        width: 130px;
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
        padding: 10px 0;
        font-weight: 600;
        position: relative;
    }

    .nav-item a {
        transition: all ease-in-out 0.3s;
        color: #000;
        font-size: 15px;
    }

    .nav-item:hover>a {
        color: #fff;
    }

    .fa-angle-down {
        display: inline-block;
        margin-left: 5px;
        transform: rotate(0deg);
        transition: transform 0.2s ease;
    }

    .nav-item:hover a .fa-angle-down {
        transform: rotate(180deg);
    }

    .search-box {
        background: #fff;
        border: 1px solid #fff;
        border-radius: 30px;
        margin-right: 20px;
        position: relative;
    }

    .search-box:focus-within {
        border-color: #29db52;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.3);
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
</style>

<!-- overlay css -->
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    .overlay.active {
        display: block;
    }
</style>

<!-- overlay js -->
<script>
    const overlay = document.getElementById('overlay');
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(navItem => {
        navItem.addEventListener('mouseover', function () {
            if (this.querySelector('.submenu-brands')) {
                overlay.classList.add('active');
            }
        });

        navItem.addEventListener('mouseout', function () {
            overlay.classList.remove('active');
        });
    });
</script>

<!-- submenu css -->
<style>
    .submenu-brands {
        border-radius: 10px;
        position: absolute;
        top: 10px;
        left: 0;
        width: 250%;
        background-color: #eee;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transition: top 0.3s ease, opacity 0.3s ease;
        visibility: hidden;
        text-align: left;
        font-size: 15px;
    }

    .nav-item:hover #overlay {
        display: block;
    }

    .submenu-brands::before {
        content: '';
        position: absolute;
        top: -9px;
        left: 17%;
        transform: translateX(-50%);
        border-width: 0 10px 10px;
        border-style: solid;
        border-color: transparent transparent #eee;
    }

    .nav-item:hover .submenu-brands {
        top: 40px;
        opacity: 1;
        visibility: visible;
    }

    .submenu-brand-item {
        padding: 20px;
        border-bottom: 1px dashed #333;
    }

    .submenu-brand-item:last-child {
        border-bottom: none;
    }

    .submenu-brand-item a {
        color: #000;
    }

    .fa-arrow-right {
        margin-left: 10px;
        transition: margin-left 0.5s ease;
    }

    .submenu-brand-item:hover a {
        color: #f58f5d;
    }

    .submenu-brand-item:hover .fa-arrow-right {
        margin-left: 30%;
    }
</style>

<!-- scroll-to-top js-->
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

<!-- show-hide-bar-btn js-->
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

<!-- header-fixed js -->
<script>
    const header = document.getElementById('header-page');
    const cart = document.getElementById('show-cart');

    let lastScrollTop = 0;

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            header.style.transform = 'translateY(-100px)';
        } else {
            header.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, false);
</script>

<!-- show-submenu -->
<script>
    document.getElementById("submenu").addEventListener("mouseleave", function (event) {
        var e = event.toElement || event.relatedTarget;
        if (e.parentNode == this || e == this) {
            return;
        }
        this.style.opacity = 0;
        this.style.visibility = "hidden";
    });
</script>

<!-- css-show-cart -->
<style>
    #show-cart {
        position: fixed;
        width: 330px;
        height: 560px;
        right: 0px;
        top: 120%;
        transition: all ease-in-out 0.3s;
        opacity: 0;
        border-radius: 15px;
        visibility: hidden;
        background-color: #FFF;
        pointer-events: none;
        padding: 0 10px;
        color: #221F20;
        z-index: 1000;
    }

    #show-cart.show {
        opacity: 1;
        top: 110%;
        visibility: visible;
        pointer-events: auto;
    }


    #show-cart::after {
        content: "";
        position: absolute;
        top: -15px;
        right: 8%;
        border-width: 0 15px 15px 15px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
    }

    #my-cart {
        padding: 10px;
    }

    #lenght-cart {
        font-size: 15px;
        position: absolute;
        top: 52%;
        right: 20px;
        color: #000;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
        width: 20px;
        height: 20px;
        background-color: #dd9933;
        border-radius: 50%;
        text-align: center;
        justify-content: center;
        visibility: none;
    }

    .top-cart {
        height: 10%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #464545;
    }

    .top-cart p {
        font-size: 18px;
        font-weight: 500;
        color: #221F20;
        margin-bottom: 0;
        margin-top: 5px;
        text-transform: uppercase;
    }

    .top-cart .see-cart {
        background: none;
        border: none;
        cursor: pointer;
    }

    .top-cart a {
        color: #55D5D2;
    }

    #cart-items {
        margin-top: 10px;
        height: 80%;
        max-height: 400px;
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

<!-- item trong giỏ hàng -->
<style>
    .cart-item {
        display: flex;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        align-items: center;
        position: relative;
    }

    .cart-item:last-child{
        border-bottom: none;
        padding-bottom: 0;
    }

    .cart-item-image {
        width: 80px;
        height: 100px;
        object-fit: cover;
        margin-right: 5px;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 14px;
        color: #dd9933;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .item-price {
        font-size: 13px;
        color: #1E90FF;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .item-quantity {
        font-size: 13px;
        margin-top: 5px;
        margin-bottom: 0;
    }

    .item-size {
        margin-top: 13px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .item-color {
        font-size: 13px;
    }

    .delete-cart-item {
        position: absolute;
        bottom: 10px;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 35px;
        height: 35px;
        background-color: #55D5D2;
        border: none;
        color: #fff;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
        border-radius: 10px;
    }

    .delete-cart-item:hover {
        background-color: #f58f5d;
    }

    .cart-bottom {
        margin-top: 10px;
        display: block;
        height: 10%;
        padding: 10px 0 0 0;
        border-top: 1px dashed #221F20;
        text-align: center;
        justify-content: center;
    }

    .cart-total {
        margin-bottom: 15px;
        color: #1E90FF;
        font-weight: 600;
        text-align: right;
        font-size: 14px;

    }

    .let-cart-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 30px;
        position: relative;
        border: none;
        font-weight: 600;
        cursor: pointer;
        background-color: #55D5D2;
        transition: all ease-in-out 0.3s;
        border-radius: 20px;
        font-size: 13px;
        color: #FFF;
    }

    .let-cart-link:hover {
        background-color: #f58f5d;
    }

    .let-cart-link i {
        margin-left: 10px;
        transition: transform 0.3s ease;
        transform: rotate(300deg);
    }

    .let-cart-link:hover i {
        transform: rotate(360deg);
    }
</style>

<!-- show-cart js-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const shoppingCart = document.querySelector('.shopping-cart-page');
        const showCart = document.getElementById('show-cart');
        const overlay = document.querySelector('.overlay');
        const headerTopP = document.querySelector('.header-top p');

        let timeoutId;

        shoppingCart.addEventListener('mouseenter', function () {
            clearTimeout(timeoutId);
            showCart.classList.add('show');
            overlay.classList.add('active');
            headerTopP.style.color = '#FFF';
        });

        shoppingCart.addEventListener('mouseleave', function () {
            timeoutId = setTimeout(function () {
                showCart.classList.remove('show');
                overlay.classList.remove('active');
                headerTopP.style.color = '#000';
            }, 300); // Timeout để giảm trễ xuống còn 300ms
        });

        showCart.addEventListener('mouseenter', function () {
            clearTimeout(timeoutId);
        });

        showCart.addEventListener('mouseleave', function () {
            timeoutId = setTimeout(function () {
                showCart.classList.remove('show');
                overlay.classList.remove('active');
                headerTopP.style.color = '#000';
            }, 300); // Timeout để giảm trễ xuống còn 300ms
        });
    });
</script>

<!-- add-to-cart -->
<script src="js/add-to-cart.js"></script>

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

<!-- sweetalert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>