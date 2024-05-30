<header id="header-page">
    <div class="wrapper-header-top">
        <section class="header-top">
            <p>ĐIỂM TÔ CUỘC SỐNG - TIẾP BƯỚC THÀNH CÔNG</p>
        </section>
    </div>

    <div class="wrapper-header-bottom">
        <section class="header-bottom">


            <nav class="nav-left">
                <ul class="container-nav-item">
                    <li class="nav-item"><a href="all-item.php">Sản Phẩm</a></li>
                    <li class="nav-item"><a href="">Đại Lý</a></li>
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

.logo-page img {
    width: 170px;
    height: 70px;
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
</style>

<!-- search -->
<style>
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
</style>

<!-- nav-bottom-right -->
<style>
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