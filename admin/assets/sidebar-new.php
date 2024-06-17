<section class="container-sidebar-admin">
    <div class="sidebar-top-admin">
        <h3>SB ADMIN 😍</h3>

        <button id="show-hide-sidebar-admin"><i class="fa-solid fa-circle-chevron-left"></i></button>
    </div>

    <div class="sidebar-bottom-admin">
        <ul class="container-navbar-admin">
            <li class="navbar-admin-item">
                <a href="../../ivano_website/admin/index.php">
                    <i class="fa fa-home"></i>
                    <span>Trang Chủ</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="">
                    <i class="fa-solid fa-store"></i>
                    <span>Cửa Hàng <i class="fa-solid fa-chevron-down"></i></span>
                </a>

                <ul class="submenu-admin">
                    <li class="submenu-admin-item"><a href="../php/productCategory.php">Doanh mục loại sản phẩm</a></li>
                    <li class="submenu-admin-item"><a href="../php/categories.php">Loại sản phẩm</a></li>
                    <li class="submenu-admin-item"><a href="../php/brands.php">Thương hiệu</a></li>
                    <li class="submenu-admin-item"><a href="../php/products.php">Sản phẩm</a></li>
                </ul>
            </li>

            <li class="navbar-admin-item">
                <a href="">
                    <i class="fa-solid fa-paint-roller"></i>
                    <span>Màu Sắc <i class="fa-solid fa-chevron-down"></i></span>
                </a>

                <ul class="submenu-admin">
                    <li class="submenu-admin-item"><a href="">Quản lý màu</a></li>
                    <li class="submenu-admin-item"><a href="">Bảng màu</a></li>
                </ul>
            </li>

            <li class="navbar-admin-item">
                <a href="../assets/tuvan_form.php">
                    <i class="fa-solid fa-headset"></i>
                    <span>Tư Vấn</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="../php/agency.php">
                    <i class="fa-solid fa-people-arrows"></i>
                    <span>Đại Lý</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="../php/customer.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Khách Hàng</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="../php/employee.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Nhân Viên</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="../assets/manage_popups.php">
                    <i class="fa-regular fa-file"></i>
                    <span>Popup</span>
                </a>
            </li>
            <li class="navbar-admin-item">
                <a href="../assets/manage_banners.php">
                    <i class="fa-regular fa-images"></i>
                    <span>Banner</span>
                </a>
            </li>
            <li class="navbar-admin-item">
                <a href="../php/manage_flashsale.php">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Flash Sales</span>
                </a>
            </li>

            <li class="navbar-admin-item">
                <a href="#">
                    <i class="fa fa-chart-bar"></i>
                    <span>Thống kê</span>
                </a>
            </li>
        </ul>
    </div>
</section>

<style>
    .container-sidebar-admin {
        width: 18%;
        height: 100vh;
        background-color: #55D5D2;
        color: #fff;
        top: 0;
        left: 0;
        transition: width 0.3s ease-in-out;
        position: fixed;
    }

    .sidebar-top-admin {
        height: 10vh;
        padding: 20px;
        gap: 30px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #fff;
        justify-content: center;
    }

    .sidebar-top-admin h3 {
        font-size: 20px
    }

    .sidebar-top-admin #show-hide-sidebar-admin {
        border: none;
        font-size: 35px;
        cursor: pointer;
        background: none;
        color: #FFF;
        transition: all ease-in-out 0.3s;
    }

    #show-hide-sidebar-admin i {
    transition: transform 0.3s ease;
}

/* #show-hide-sidebar-admin:hover i {
    transform: rotate(360deg);
} */

    #show-hide-sidebar-admin:hover {
        color: #000;
    }

    .sidebar-bottom-admin {
        /* margin: 20px 0 20px 0; */
        overflow-y: auto;
        height: 90vh;
        max-height: 83vh;
    }

    .sidebar-bottom-admin::-webkit-scrollbar {
        display: none;
    }

    .container-navbar-admin {
        align-items: center;
    }

    .navbar-admin-item {
        align-items: center;
        width: 100%;
        padding: 15px 0px 15px 50px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
        position: relative;
        border-bottom: 1px dashed #fff;
    }

    .sidebar-collapsed .navbar-admin-item {
        padding: 15px 0px 15px 10px;
        text-align: center;
        justify-content: center;
    }

    .sidebar-collapsed .navbar-admin-item a span i:after {
        display: none;
    }

    .sidebar-collapsed .navbar-admin-item:hover::after {
        display: none;
    }

    .navbar-admin-item::after {
        content: '\f061';
        font-family: 'FontAwesome';
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all ease-in-out 0.3s;
    }

    .navbar-admin-item:hover::after {
        left: 15px;
        opacity: 1;
    }

    .navbar-admin-item:hover {
        background-color: #F58F5D;
    }

    .navbar-admin-item a {
        color: #FFF;
    }

    .navbar-admin-item a i {
        margin-right: 10px;
    }

    .navbar-admin-item a span i {
        margin-left: 5px;
        display: inline-block;
        transform: rotate(0deg);
        transition: transform 0.3s ease;
    }

    .navbar-admin-item:hover a span i {
        transform: rotate(180deg);
    }


    /* submenu */
    .submenu-admin {
        position: absolute;
        top: 100%;
        left: 50%;
        width: 100%;
        background-color: #4ABAB6;
        transition: transform 0.3s ease, opacity 0.3s ease;
        transform: translate(-50%, -20px);
        opacity: 0;
        pointer-events: none;
        z-index: 100;
    }

    .navbar-admin-item:hover .submenu-admin {
        transform: translate(-50%, 0);
        opacity: 1;
        pointer-events: auto;
    }

    .submenu-admin-item {
        padding: 15px 20px;
        position: relative;
    }

    .submenu-admin-item:hover {
        background-color: #3B8D8A;
    }


    .submenu-admin-item::before {
        content: '\f060';
        font-family: 'FontAwesome';
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all ease-in-out 0.3s;
    }

    .submenu-admin-item:hover::before {
        opacity: 1;
        right: 10px;
    }

    .sidebar-collapsed .submenu-admin {
        display: none;
        /* Ẩn submenu khi thanh sidebar thu nhỏ */
    }
</style>

<script>
    document.getElementById("show-hide-sidebar-admin").addEventListener("click", function () {
        var sidebar = document.querySelector(".container-sidebar-admin");
        var main = document.querySelector(".main-admin-page");
        var h3 = document.querySelector(".sidebar-top-admin h3");
        var spans = document.querySelectorAll(".sidebar-bottom-admin span");
        var topSidebarIcon = document.querySelector(".sidebar-top-admin button i");

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