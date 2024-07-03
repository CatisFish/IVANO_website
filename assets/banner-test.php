<link rel="stylesheet" href="css/animation.css">

<section class="gallery-slider-container">
    <div class="gallery-slider">
        <div class="gallery-slide">
            <?php
            include "php/conection.php";

            $sql_banner_left = "SELECT banner_title, banner_img, banner_description FROM banners ORDER BY banner_id DESC LIMIT 5";

            $result_banner_left = $conn->query($sql_banner_left);

            if ($result_banner_left->num_rows > 0) {
                while ($row = $result_banner_left->fetch_assoc()) {
                    echo '<div class="gallery-slide-item" style="background-image: url(admin/uploads/' . $row["banner_img"] . ');">';
                    echo '<div class="content">';
                    echo '<div class="name">' . $row["banner_title"] . '</div>';
                    echo '<div class="des">' . $row["banner_description"] . '</div>';
                    // echo '<button class="read-button">See More</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Không có dữ liệu banner.";
            }

            $conn->close();
            ?>
        </div>

        <!-- <div class="container-gallery-slide-button">
            <button class="gallery-slide-button-prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="gallery-slide-button-next"><i class="fa-solid fa-arrow-right"></i></button>
        </div> -->
    </div>
</section>

<style>
    .gallery-slider-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .gallery-slider {
        width: 100%;
        height: 100%;
        background: #f5f5f5;
        box-shadow: 0 30px 50px #dbdbdb;
        overflow: hidden;
    }

    .gallery-slide-item {
        width: 200px;
        height: 270px;
        position: absolute;
        top: 50%;
        transform: translate(0, 5%);
        border-radius: 20px;
        background-position: 50% 50%;
        background-size: cover;
        display: inline-block;
        transition: 0.5s ease-in-out;
        opacity: 1;
        border: 1px solid #FFFF;
    }

    .gallery-slide-item:nth-child(1),
    .gallery-slide-item:nth-child(2) {
        top: 0;
        left: 0;
        transform: translate(0, 0);
        border-radius: 0;
        width: 100%;
        height: 100%;
        opacity: 1;
    }

    .gallery-slide-item:nth-child(3) {
        left: 70%;
        opacity: 1;
    }

    .gallery-slide-item:nth-child(4) {
        left: calc(70% + 220px);
        opacity: 1;
    }

    .gallery-slide-item:nth-child(5) {
        left: calc(70% + 440px);
        opacity: 0;
    }

    .gallery-slide-item:nth-child(n + 6) {
        left: calc(70% + 660px);
        opacity: 0;
        pointer-events: none;
    }

    .content {
        position: absolute;
        top: 50%;
        left: 100px;
        width: 450px;
        text-align: left;
        color: #eee;
        transform: translate(0, -50%);
        font-family: system-ui;
        display: none;
    }

    .gallery-slide-item:nth-child(2) .content {
        display: block;
    }

    .name {
        font-size: 45px;
        line-height: 1.3;
        text-transform: uppercase;
        font-weight: 700;
        -webkit-animation: text-shadow-pop-bottom 0.6s both;
        animation: text-shadow-pop-bottom 0.6s both;
    }

    @-webkit-keyframes text-shadow-pop-bottom {
        0% {
            text-shadow: 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }

        100% {
            text-shadow: 0 1px #555555, 0 2px #555555, 0 3px #555555, 0 4px #555555, 0 5px #555555, 0 6px #555555, 0 7px #555555, 0 8px #555555;
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
        }
    }

    @keyframes text-shadow-pop-bottom {
        0% {
            text-shadow: 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555, 0 0 #555555;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }

        100% {
            text-shadow: 0 1px #555555, 0 2px #555555, 0 3px #555555, 0 4px #555555, 0 5px #555555, 0 6px #555555, 0 7px #555555, 0 8px #555555;
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
        }
    }

    .des {
        font-weight: 500;
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
        -webkit-animation: text-shadow-drop-center 0.6s both;
        animation: text-shadow-drop-center 0.6s both;
    }

    @-webkit-keyframes text-shadow-drop-center {
        0% {
            text-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            text-shadow: 0 0 18px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes text-shadow-drop-center {
        0% {
            text-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            text-shadow: 0 0 18px rgba(0, 0, 0, 0.35);
        }
    }

    /* .read-button {
        padding: 10px 25px;
        border: none;
        cursor: pointer;
        opacity: 0;
        transition: all ease-in-out 0.3s;
        animation: animate 1s ease-in-out 0.6s 1 forwards;
        background-color: #55D5D2;
        color: #fff;
        font-weight: 600;
    }

    .read-button:hover {
        background-color: #F58F5D;

    }


    .container-gallery-slide-button {
        width: 100%;
        text-align: center;
        position: absolute;
        bottom: 30px;
    }

    .gallery-slide-button-prev,
    .gallery-slide-button-next {
        width: 120px;
        height: 45px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin: 0 5px;
        transition: 0.3s;
        color: #fff;
        background-color: #55D5D2;
        transition: all ease-in-out 0.3s;
    }

    .gallery-slide-button-prev:hover,
    .gallery-slide-button-next:hover {
        background-color: #F58F5D;
    } */
</style>

<style>
    @media only screen and (max-width: 600px) {
        .gallery-slider-container {
            position: relative;
            height: 500px;
            overflow: hidden;
        }

        .gallery-slide-item {
            width: 100px;
            height: 100px;
            position: absolute;
            bottom: 0px;
            right: 0px;
            border-radius: 20px;
            background-position: 50% 50%;
            background-size: cover;
            display: inline-block;
            transition: 0.5s ease-in-out;
            opacity: 1;
            border: 1px solid #FFFF;
        }

        .gallery-slide-item:nth-child(3) {
            left: 80%;
            opacity: 1;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50px;
            width: 350px;
            text-align: left;
            color: #eee;
            transform: translate(0, -50%);
            display: none;
        }

        .name {
            font-size: 30px;
        }

        .des {
            font-size: 15px;
        }

    }
</style>

<script>
    // let next = document.querySelector('.gallery-slide-button-next');
    // let prev = document.querySelector('.gallery-slide-button-prev');

    // next.addEventListener('click', function () {
    //     let items = document.querySelectorAll('.gallery-slide-item');
    //     document.querySelector('.gallery-slide').appendChild(items[0]);
    // });

    // prev.addEventListener('click', function () {
    //     let items = document.querySelectorAll('.gallery-slide-item');
    //     document.querySelector('.gallery-slide').prepend(items[items.length - 1]);
    // });

    let slideIndex = 0;
    let items = document.querySelectorAll('.gallery-slide-item');

    function autoSlide() {
        document.querySelector('.gallery-slide').appendChild(items[0]);
        items = document.querySelectorAll('.gallery-slide-item');
    }

    setInterval(autoSlide, 3000);

</script>