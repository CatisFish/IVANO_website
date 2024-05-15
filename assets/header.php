<header id="header-page">
            <div class="wrapper-header-top">
                <section class="header-top">
                    <p>ĐIỂM TÔ CUỘC SỐNG - TIẾP BƯỚC THÀNH CÔNG</p>

                    <div class="header-top-right">
                        <a href="" class="recruitment-link">
                            <i class="fa-solid fa-plus"></i> <span>Tuyển Dụng</span>
                        </a>

                        <a href="login-register/index.html" class="login-link">
                            <span>Đăng Nhập</span><i class="fa-regular fa-user"></i>
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

                    <a href="" class="logo-page"><img src="images/logo.png" alt="LOGO"></a>

                    <nav class="nav-right">
                        <ul class="container-nav-item">
                            <li class="nav-item"><a href="">Đại Lý</a></li>
                            <li class="nav-item"><a href="">Bảng Màu</a></li>
                            <li class="nav-item">
                                <form action="assets/search.php" class="search-box">
                                    <input type="text" placeholder="Nhập sản phẩm cần tìm..." class="search-text">
                                    <button type="submit" class="search-btn"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </section>
            </div>
        </header>
        <!-- header-top -->
        <style>
            .wrapper-header-top {
                border-bottom: 1px solid #fe2c55;
            }

            .header-top {
                width: 90%;
                margin: 0px auto;
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                align-items: center;

            }

            .header-top p {
                font-weight: 600;
                font-size: 12px;
            }

            .header-top-right {
                display: flex;
                gap: 20px;
            }

            .recruitment-link,
            .login-link {
                color: #FFF;
                font-weight: 600;
                font-size: 12px;
                background-color: #fe2c55;
                padding: 10px 20px;
                border-radius: 10px;
                padding: 10px 20px;
                transition: all ease-in-out 0.3s;
            }

            .recruitment-link:hover,
            .login-link:hover {
                background-color: rgb(195, 13, 49);
            }

            .recruitment-link i {
                margin-right: 10px;
            }

            .login-link i {
                margin-left: 10px;
            }
        </style>

        <!-- header-bottom -->
        <style>
            .header-bottom {
                width: 90%;
                height: 100px;
                margin: 0px auto;
                display: flex;
                justify-content: space-between;
                position: relative;
                padding: 30px 0;
                align-items: center;
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
                background-color: black;
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

            .nav-item:hover {}

            .nav-right {
                text-align: center;
            }
        </style>

        <!-- search -->
        <style>
            .container-nav-item{
                align-items: center;
            }
            .search-box {
                display: flex;
                height: 40px;
                border: 1px solid #eee;
                border-radius: 10px;
            }

            .search-text{
                width: 200px;
                padding: 10px;
                border: none;
                outline: none;
                margin-left: 5px;
                background: none;
            }

            .search-btn{
                width: 40px;
                height: 40px;
                border: none;
                cursor: pointer;
                border-left: 1px solid #eee;
                border-radius: 10px;      
            }
        </style>