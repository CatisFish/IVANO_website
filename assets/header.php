<header id="header-page">
    <div class="wrapper-header-top">
        <section class="header-top">
            <p>ĐIỂM TÔ CUỘC SỐNG - TIẾP BƯỚC THÀNH CÔNG</p>

            <div class="header-top-right">
                <a href="" class="recruitment-link">
                    <i class="fa-solid fa-plus"></i> <span>Tuyển Dụng</span>
                </a>

                <a href="" class="view-orders"><i class="fa-solid fa-headphones-simple"></i></a>

                <a href="login-register/index.html" class="login-link">
                    <i class="fa-regular fa-user"></i>
                </a>





            </div>
        </section>
    </div>

    <div class="wrapper-header-bottom">
        <section class="header-bottom">
            <nav class="nav-left">
                <ul class="container-nav-item">
                    <li class="nav-item"><a href="">Sản Phẩm</a></li>
                    <li class="nav-item"><a href="">Giới Thiệu</a></li>
                    <li class="nav-item"><a href="">Tin Tức</a></li>
                    <li class="nav-item"><a href="">Liên Hệ</a></li>
                </ul>
            </nav>

            <a href="index.php" class="logo-page"><img src="images/logo.png" alt="LOGO"></a>

            <nav class="nav-right">
                <ul class="container-nav-item">
                    <li class="nav-item"><a href="">Đại Lý</a></li>
                    <li class="nav-item"><a href="">Bảng Màu</a></li>
                    <li class="nav-item">
                        <form action="assets/search.php" class="search-box">
                            <input type="text" placeholder="Nhập sản phẩm cần tìm..." class="search-text">
                            <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </li>

                    <div class="shopping-cart-page" onclick="showCart(event)">
                        <a href="#">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <p id="lenght-cart"></p>
                        </a>

                        <div id="show-cart">
                            <div class="cart-top">
                                <h2>Giỏ Hàng</h2>
                                <button type="button" id="close-cart-btn"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            
                            <div id="my-cart">
                                <p id="cart-items"></p>
                            </div>

                            <div id="checkout">
                                <p id="cart-total">Tổng tiền: <span>0 đ</span></p>

                                <div class="container-clear-cart">
                                    <button type="button" class="clear-cart-btn">Clear Giỏ Hàng</button>
                                </div>

                                <a id="view-cart-link" href="checkout.php">Thanh Toán</a>
                            </div>
                        </div>
                    </div>
                </ul>
            </nav>
        </section>
    </div>
</header>
<!-- header-top -->
<style>
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
        font-weight: 600;
        font-size: 12px;
    }

    .header-top-right {
        display: flex;
        gap: 20px;
    }

    .view-orders,
    .recruitment-link,
    .login-link {
        color: #221F20;
        font-weight: 600;
        font-size: 11px;
        background-color: rgb(74, 234, 220);
        border-radius: 10px;
        padding: 10px 15px;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .view-orders:hover,
    .shopping-cart-page:hover,
    .recruitment-link:hover,
    .login-link:hover {
        background-color: rgb(57, 207, 197);
    }

    .recruitment-link i {
        margin-right: 10px;
    }    
</style>

<!-- header-bottom -->
<style>
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

    .logo-page:hover img {
        scale: 105%;
    }

    .logo-page img {
        width: 170px;
        height: 70px;

        transition: all ease-in-out 0.3s;
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

    .nav-right {
        text-align: center;
    }

    .nav-right a {
        color: #FFF;
    }

    .cart-top{
        align-items: center;
        color: #FFF;
        font-weight: 700;
        padding: 10px 0;
    }

    .shopping-cart-page {
        color: #221F20;
        font-weight: 600;
        background-color: rgb(74, 234, 220);
        border-radius: 10px;
        padding: 10px 15px;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    #show-cart {
        position: fixed;
        width: 318px;
        height: 650px;
        box-shadow: 0 8px 10px 0 rgb(0 0 0 / 10%);
        right: -65px;
        top: 0px;
        background-color: #221F20;
        transition: all ease-in-out 0.3s;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        z-index: 500;
    }

    #close-cart-btn {
        position: absolute;
        right: 0;
        top: 0;
        padding: 10px 13px;
        cursor: pointer;
    }

    #lenght-cart {
        font-size: 15px;
        position: absolute;
        top: -10px;
        right: -10px;
        color: #000;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
    }

    #my-cart {
        max-height: 420px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #999 transparent;
        overflow-x: hidden;
        padding: 10px;
    }

    #my-cart::-webkit-scrollbar {
        width: 2px;
    }

    #show-cart.show {
        opacity: 1;
        right: 0px;
        transition: all ease-in-out 0.3s;
        visibility: visible;
        pointer-events: auto;
    }

    .clear-cart-btn{
    background-color: #FFD400;
    width: 100%;
    border: none;
    padding: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    
}

/* #view-cart-link{
    color: #221F20;
    padding: 10px;
    margin: 10px 0px;
    background-color: #FFD400;
    position: absolute;
    bottom: 0px;
    width: 100%;
    text-align: center;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
} */

</style>

<!-- search -->
<style>
    .container-nav-item {
        align-items: center;
    }

    .search-box {
        display: flex;
        height: 40px;
        border: 1px solid #eee;
        border-radius: 10px;
        background-color: #FFF;
    }

    .search-text {
        width: 200px;
        padding: 10px;
        border: none;
        outline: none;
        margin-left: 5px;
        background: none;
    }

    .search-btn {
        width: 40px;
        height: 40px;
        border: none;
        cursor: pointer;
        border-left: 1px solid #eee;
        border-radius: 10px;
        background: none;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var showCartBtn = document.querySelector('.shopping-cart-page a');
        var closeCartBtn = document.getElementById('close-cart-btn');
        var cart = document.getElementById('show-cart');

        function showCart(event) {
            event.stopPropagation();
            if (!cart.classList.contains('show')) {
                cart.classList.add('show');
            }
        }

        function closeCart(event) {
            event.stopPropagation();
            cart.classList.remove('show');
        }

        showCartBtn.addEventListener('click', showCart);
        closeCartBtn.addEventListener('click', closeCart);

        window.addEventListener('click', function(event) {
            if (!cart.contains(event.target) && !showCartBtn.contains(event.target)) {
                cart.classList.remove('show');
            }
        });
    });
</script>




<!-- header fixed -->
<style>
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
</style>

<script>
    window.addEventListener('scroll', function() {
        var headerBottom = document.querySelector('.header-bottom');
        var scrollPosition = window.scrollY || window.pageYOffset;

        if (scrollPosition > 10 && !headerBottom.classList.contains('fixed-header')) {
            headerBottom.classList.add('fixed-header');
            setTimeout(function() {
                headerBottom.classList.add('active');
            }, 10);
        } else if (scrollPosition <= 10 && headerBottom.classList.contains('fixed-header')) {
            headerBottom.classList.remove('active');
            setTimeout(function() {
                headerBottom.classList.remove('fixed-header');
            }, 250);
        }
    });
</script>

<button class="top-page-btn">
    <i class="fa-solid fa-angle-up"></i>
</button>

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

<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    var topButton = document.querySelector('.top-page-btn');

    topButton.addEventListener('click', scrollToTop);

    window.addEventListener('scroll', function() {
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