<link rel="stylesheet" href="css/scroll-to-top.css">

<header id="header-page">
    <div class="wrapper-header-top">
        <section class="header-top">
            <p>ĐIỂM TÔ CUỘC SỐNG - TIẾP BƯỚC THÀNH CÔNG</p>

            <div class="hello-user-container">
                <i class="fa-regular fa-user"></i>
                <?php
                if (isset($_SESSION['user_name'])) {
                    $loggedInUsername = $_SESSION['user_name'];
                    echo '<span>' . htmlspecialchars($loggedInUsername) . '</span>';

                    echo '<div class="user-dropdown-content" id="dropdownContent">';
                    echo '<a class="user-link" href="#">Cài đặt</a>';
                    echo '<a class="user-link" href="logout.php">Đăng xuất</a>';
                    echo ' </div>';
                } else {
                    // echo '<span>Người Dùng</span>';
                }
                ?>
            </div>
        </section>
    </div>

    <div class="wrapper-header-bottom">
        <section class="header-bottom">
            <nav class="nav-left">
                <ul class="container-nav-item">
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
                    <li class="nav-item"><a href="filter-color.php">Bảng Màu</a></li>
                    <li class="nav-item"><a href="tuyen-dung.php">Tuyển Dụng</a></li>
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

                    <a href="login.php" class="login-link item-nav-right" id="loginLink"><i
                            class="fa-regular fa-user"></i></a>

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

<div id="header-mobile">
    <div class="header-mobile-left">
        <button class="bar-mobile-btn" type="button">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="container-navbar-mobile">
            <div class="navbar-mobile-top">
                <?php
                if (isset($_SESSION['user_name'])) {
                    $loggedInUsername = $_SESSION['user_name'];
                    echo '<span class="hello-user-name">Hi, ' . htmlspecialchars($loggedInUsername) . '</span>';
                } else {
                    echo '<span class="hello-user-name">Người Dùng</span>';
                }
                ?>

                <button class="close-navbar-mobile" type="button"><i class="fa-solid fa-xmark"></i></button>
            </div>


            <form class="search-box-mobile" action="../assets/search.php" method="GET">
                <input type="text" class="search-text-mobile" placeholder="Nhập sản phẩm cần tìm..." name="search"
                    required>
                <button type="submit" class="search-btn-mobile"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <div class="navbar-mobile-bottom">
                <ul class="container-nav-item-mobile">
                    <li class="nav-item-mobile"><a href="index.php">Trang Chủ</a></li>
                    <li class="nav-item-mobile"><a href="all-item.php">Sản Phẩm</a></li>
                    <li class="nav-item-mobile"><a href="dai-ly.php">Đại Lý</a></li>
                    <li class="nav-item-mobile"><a href="filter-color.php">Bảng Màu</a></li>
                    <li class="nav-item-mobile"><a href="">Tuyển Dụng</a></li>
                    <li class="nav-item-mobile"><a href="">Tra Cứu Đơn Hàng</a></li>
                    <li class="nav-item-mobile"><a href="login.php">Tài Khoản</a></li>
                </ul>
            </div>
        </div>
    </div>

    <a href="index.php" class="logo-page-mobile"><img src="images/logo.png" alt="LOGO"></a>

    <div class="header-mobile-right">
        <div class="shopping-cart-page">
            <a href="cart-page.php">
                <i class="fa-solid fa-basket-shopping item-nav-right"></i>
                <p class="lenght-cart"></p>
            </a>
        </div>
    </div>
</div>

<button class="top-page-btn">
    <i class="fa-solid fa-angle-up"></i>
</button>

<div class="overlay" id="overlay"></div>

<style>
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

    .hello-user-container {
        background-color: #55D5D2;
        color: #FFF;
        padding: 5px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        position: relative;
    }

    .hello-user-container i {
        margin-right: 10px;
    }

    .user-dropdown-content {
        z-index: 1000;
        position: absolute;
        background-color: #F58F5D;
        top: 200%;
        right: 0;
        width: 200px;
        transition: all ease-in-out 0.3s;
        visibility: hidden;
        opacity: 0;
        padding: 5px 0;
        display: flex;
        flex-direction: column;
    }

    .user-dropdown-content.show {
        opacity: 1;
        visibility: visible;
        top: 115%;
    }

    .user-dropdown-content::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 80%;
        transform: translateX(-50%);
        border-width: 0 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #F58F5D transparent;
    }

    .user-link {
        padding: 10px 30px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
        color: #FFF;
    }

    .user-link:last-child {
        border-bottom: none;
    }

    .user-link:hover {
        background-color: #55D5D2;
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
            header.style.transform = 'translateY(-110px)';
        } else {
            header.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, false);
</script>

<!-- header-mobile-fixed js -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.matchMedia("(max-width: 600px)").matches) {
            const headerMobile = document.getElementById('header-mobile');
            const containerNavbarMobile = document.querySelector('.container-navbar-mobile');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function () {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > lastScrollTop) {
                    headerMobile.style.transform = 'translateY(-110px)';
                    containerNavbarMobile.style.top = '110px';
                    containerNavbarMobile.style.top = '155%';
                } else {
                    headerMobile.style.transform = 'translateY(0)';
                    containerNavbarMobile.style.top = '0';
                }

                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }, false);
        }
    });

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
        top: -13px;
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
        height: 400px;
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
        color: #221F20;
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

    .cart-item:last-child {
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

<!-- show user-link js -->
<script>
    const helloUser = document.querySelector('.hello-user-container');
    const dropdownContent = document.querySelector('.user-dropdown-content');

    helloUser.addEventListener('mouseenter', function () {
        dropdownContent.classList.add('show');
    });

    helloUser.addEventListener('mouseleave', function () {
        dropdownContent.classList.remove('show');
    });
</script>

<!-- chặn tới login khi đăng nhập rồi -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var loginLink = document.getElementById('loginLink');
        var helloUserContainer = document.querySelector('.hello-user-container');

        <?php if (isset($_SESSION['user_name'])): ?>
            loginLink.addEventListener('click', function (event) {
                event.preventDefault();
            });
        <?php else: ?>
            helloUserContainer.style.display = 'none';
        <?php endif; ?>
    });
</script>

<!-- show-navbar-mobile -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.matchMedia("(max-width: 600px)").matches) {
            const barMobileBtn = document.querySelector('.bar-mobile-btn');
            const navContainer = document.querySelector('.container-navbar-mobile');
            const closeBarBtn = document.querySelector('.close-navbar-mobile');

            barMobileBtn.addEventListener('click', function () {
                navContainer.style.left = "0px";
                navContainer.style.opacity = "1";
                console.log("show navbar-mobile");
            });

            closeBarBtn.addEventListener('click', function () {
                navContainer.style.left = "-100%";
                navContainer.style.opacity = "0";
                console.log("close is clicked");
            });

            document.addEventListener('click', function (event) {
                const isClickInsideNavContainer = navContainer.contains(event.target);
                const isClickOnBarMobileBtn = barMobileBtn.contains(event.target);

                if (!isClickInsideNavContainer && !isClickOnBarMobileBtn) {
                    navContainer.style.left = "-100%";
                    navContainer.style.opacity = "0";
                    console.log("clicked outside, close navbar-mobile");
                }
            });
        }
    });
</script>

<!-- navbar-mobile css -->
<style>
    @media only screen and (max-width: 600px) {
        #header-page {
            display: none;
        }

        #header-mobile {
            height: 70px !important;
            display: block;
            background: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 25%, rgba(252, 185, 0, 1) 50%, rgba(255, 105, 0, 1) 75%, rgb(74, 234, 220) 100%);
            display: flex;
            justify-content: space-between;
            height: 70px;
            align-items: center;
            padding: 0 2.5%;
            position: fixed;
            top: 0;
            width: 100%;
            transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1000;
        }

        /* left */
        .bar-mobile-btn {
            width: 30px;
            height: 30px;
            color: #fff;
            background-color: #55D5D2;
            border: 1px solid #FFF;
            border-radius: 5px;
        }

        .container-navbar-mobile {
            position: fixed;
            background-color: rgba(192, 192, 192, 0.95);
            width: 75%;
            height: 100vh;
            left: -100%;
            top: 0;
            transition: all 0.3s ease-in-out, opacity 0.3s ease;
            z-index: 1000;
            font-weight: 600;
            font-size: 13px;
            opacity: 0;
            display: flex;
            flex-direction: column;
        }

        .navbar-mobile-top {
            display: flex;
            justify-content: space-between;
        }

        .hello-user-name {
            margin: 30px 0 0 30px;
            padding: 10px 30px;
            border-radius: 30px;
            color: #FFF;
            background-color: #55D5D2;
        }


        .close-navbar-mobile {
            position: absolute;
            top: 0;
            right: 0;
            width: 40px;
            height: 40px;
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

        .close-navbar-mobile i {
            font-size: 15px;
        }

        .close-navbar-mobile:active {
            background-color: #d32f2f;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .search-box-mobile {
            display: flex;
            width: 90%;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin: 30px auto;
        }

        .search-text-mobile {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 12px;
            width: 90%;
            height: 35px;
        }

        .search-btn-mobile {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            margin-left: 10px;
            width: 35px;
            height: 35px;
        }

        .container-nav-item-mobile {
            display: flex;
            flex-direction: column;
        }

        .nav-item-mobile a {
            display: block;
            padding: 20px 30px;
            border-bottom: 1px dashed #FFF;
            transition: all 0.3s ease;
        }

        /* mid */
        .logo-page-mobile img {
            width: 100px;
        }

        .shopping-cart-page {
            border: 1px solid #FFF;
            padding: 5px;
            background-color: #55D5D2;
            border-radius: 5px;
        }

        .shopping-cart-page a i {
            color: #FFF;

        }
    }

    @media only screen and (min-width: 601px) {
        #header-mobile {
            display: none;
        }

    }
</style>

<!-- add-to-cart js-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartItems = [];
        var cartItemsContainer = document.getElementById('cart-items');
        var totalCartPrice = document.querySelector('.cart-total span');
        var cartLength = document.getElementById('lenght-cart');

        if (localStorage.getItem('cartItems')) {
            cartItems = JSON.parse(localStorage.getItem('cartItems'));
            updateCartLength();
            updateCartItems();
            calculateTotalPrice();
        } else {
            cartLength.textContent = '0';
            totalCartPrice.textContent = '0 VNĐ';
        }

        function checkCartEmpty() {
            if (cartItems.length === 0) {
                if (cartItemsContainer) {
                    cartItemsContainer.innerHTML = '<p class="title-none-cart">Giỏ hàng trống !!!</p>';
                }
            }
        }

        function parseFormattedPrice(price) {
            return parseFloat(price.replace(/\./g, '').replace(' VNĐ', '').replace(',', '.'));
        }

        function formatPrice(price) {
            return price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' VNĐ';
        }

        function calculateTotalPrice() {
            var totalPrice = 0;
            cartItems.forEach(function (cartItem) {
                totalPrice += parseFormattedPrice(cartItem.price);
            });
            totalCartPrice.textContent = formatPrice(totalPrice);
            return totalPrice;
        }

        function calculateTotalQuantity() {
            var totalQuantity = 0;
            cartItems.forEach(function (cartItem) {
                totalQuantity += cartItem.quantity;
            });
            return totalQuantity;
        }

        function updateCartLength() {
            var totalQuantity = calculateTotalQuantity();
            cartLength.textContent = totalQuantity;
        }

        checkCartEmpty();

        var addToCartBtn = document.querySelector('.add-to-cart');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function () {
                var productName = document.querySelector('.product-name').textContent;
                var productPrice = document.querySelector('.product-price').textContent;
                var productImage = document.querySelector('.detail-product-img').getAttribute('src');
                var productQuantity = parseInt(document.querySelector('.product-quantity input').value);
                var selectedSizeElement = document.getElementById('size-select');
                var selectedSize = selectedSizeElement.selectedOptions[0].textContent;
                var selectedColor = document.getElementById('color-select').value;

                if (selectedSize === "Chọn kích thước" || selectedColor === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lỗi',
                        text: 'Vui lòng chọn kích thước và màu sắc trước khi thêm vào giỏ hàng!',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                var basePrice = parseFormattedPrice(productPrice);
                var itemPrice = basePrice / productQuantity; // Giá của mỗi sản phẩm

                var existingItemIndex = cartItems.findIndex(function (item) {
                    return item.name === productName && item.size === selectedSize && item.color === selectedColor;
                });

                if (existingItemIndex !== -1) {
                    cartItems[existingItemIndex].quantity += productQuantity;
                    cartItems[existingItemIndex].price = formatPrice(itemPrice * cartItems[existingItemIndex].quantity);
                } else {
                    var item = {
                        name: productName,
                        price: formatPrice(basePrice),
                        image: productImage,
                        quantity: productQuantity,
                        size: selectedSize,
                        color: selectedColor
                    };
                    cartItems.push(item);
                }

                updateCartLength();
                calculateTotalPrice();
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCartItems();

                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Sản phẩm đã được thêm vào giỏ hàng!',
                    confirmButtonText: 'OK'
                });
            });
        }

        function updateCartItems() {
            if (cartItemsContainer) {
                cartItemsContainer.innerHTML = '';

                cartItems.forEach(function (cartItem, index) {
                    var cartItemHTML = '<div class="cart-item">';
                    cartItemHTML += '<img src="' + cartItem.image + '" alt="' + cartItem.name + '" class="cart-item-image">';
                    cartItemHTML += '<div class="item-details">';
                    cartItemHTML += '<p class="item-name">' + cartItem.name + '</p>';
                    cartItemHTML += '<p class="item-price">Tạm tính: ' + cartItem.price + '</p>';
                    cartItemHTML += '<p class="item-quantity">Số lượng: ' + cartItem.quantity + '</p>';
                    cartItemHTML += '<p class="item-size">Kích Thước: ' + cartItem.size + '</p>';
                    cartItemHTML += '<p class="item-color">Đuôi: ' + cartItem.color + '</p>';
                    cartItemHTML += '<button class="delete-cart-item" data-index="' + index + '"><i class="fa-regular fa-trash-can"></i></button>';
                    cartItemHTML += '</div>';
                    cartItemHTML += '</div>';

                    cartItemsContainer.innerHTML += cartItemHTML;
                });

                var deleteButtons = document.querySelectorAll('.delete-cart-item');
                deleteButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        var index = event.currentTarget.getAttribute('data-index');
                        cartItems.splice(index, 1);
                        updateCartLength();
                        calculateTotalPrice();
                        updateCartItems();
                        checkCartEmpty();
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    });
                });
            }
        }

        var clearCartBtn = document.querySelector('.clear-cart-btn');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', function () {
                if (cartItems.length > 0) {
                    Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            cartItems = [];
                            updateCartLength();
                            totalCartPrice.textContent = '0';
                            checkCartEmpty();
                            updateCartItems();
                            calculateTotalPrice();

                            localStorage.removeItem('cartItems');
                            checkCartEmpty();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Giỏ hàng đã trống',
                        text: 'Không có sản phẩm nào trong giỏ hàng để xóa.',
                        confirmButtonText: 'OK'
                    });

                    localStorage.removeItem('cartItems');
                    totalCartPrice.textContent = '0 VNĐ';
                }
            });
        }
    });

</script>