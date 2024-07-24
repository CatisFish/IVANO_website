<div class="container-banner-news">
    <section class="banner-news">
        <a href="blog.php" class="news-item">
            <img src="images/1.jpg" alt="">
            <span>
                <h1>TIN TỨC</h1>
                <p>Nổi Bật</p>
            </span>
        </a>

        <a href="gioi-thieu.php" class="news-item">
            <img src="images/2.jpg" alt="">
            <span>
                <h1>GIỚI THIỆU</h1>
                <p>Về Chúng Tôi</p>
            </span>
        </a>

        <a href="dai-ly.php" class="news-item">
            <img src="images/3c.jpg" alt="">
            <span>
                <h1>ĐĂNG KÝ</h1>
                <p>Đại Lý</p>
            </span>
        </a>
    </section>
</div>
<style>
    .container-banner-news {
        margin: 50px 0;
    }

    .banner-news {
        display: flex;
        justify-content: space-between;
        width: 80%;
        margin: 0 auto;
    }

    .news-item {
        position: relative;
        width: 32%;
        height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
    }

    .news-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
        z-index: 0;
    }

    .news-item:hover img {
        transform: scale(1.05);
    }

    .news-item span {
        position: relative;
        z-index: 1;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .news-item span::after {
        content: "";
        display: block;
        width: 20px;
        height: 2px;
        background-color: white;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
    }


    .news-item h1 {
        font-size: 1.3em;
        font-weight: 700;
        margin: 0;
    }

    .news-item p {
        font-size: 1em;
        font-weight: 600;
        margin: 0;
        margin-top: 10px;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .container-banner-news {
            width: 100%;
            margin: 10px auto;
        }

        .banner-news {
            display: flex;
            justify-content: space-between;
            width: 95%;
        }

        .news-item {
            position: relative;
            width: 32%;
            height: 85px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            border-radius: 10px;
        }

        .news-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
            z-index: 0;
        }

        .news-item:hover img {
            transform: scale(1.05);
        }

        .news-item span {
            position: relative;
            z-index: 1;
            /* background-color: rgba(0, 0, 0, 0.5); */
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .news-item span::after {
            content: "";
            display: block;
            width: 20px;
            height: 2px;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .news-item h1 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .news-item p {
            font-size: 12px;
            font-weight: 500;
            margin: 0;
            margin-top: 10px;
        }
    }
</style>