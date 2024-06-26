<section class="gallery-slider-container">
    <div class="gallery-slider">
        <div class="gallery-slide">
            <?php
            include "php/conection.php";

            $sql_banner_left = "SELECT banner_title, banner_img FROM banners ORDER BY banner_id DESC LIMIT 5";

            $result_banner_left = $conn->query($sql_banner_left);

            if ($result_banner_left->num_rows > 0) {
                while ($row = $result_banner_left->fetch_assoc()) {
                    echo '<div class="gallery-slide-item" style="background-image: url(admin/uploads/' . $row["banner_img"] . ');">';
                    echo '<div class="content">';
                    echo '<div class="name">' . $row["banner_title"] . '</div>';
                    echo '<div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>';
                    echo '<button class="read-button">See More</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Không có dữ liệu banner.";
            }

            $conn->close();
            ?>
        </div>

        <div class="container-gallery-slide-button">
            <button class="gallery-slide-button-prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="gallery-slide-button-next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
</section>

<style>
    .gallery-slider-container {
        position: relative;
        height: 630px;
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
        width: 400px;
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
        font-size: 40px;
        text-transform: uppercase;
        font-weight: bold;
        opacity: 0;
        animation: animate 1s ease-in-out 1 forwards;
    }

    .des {
        margin-top: 10px;
        margin-bottom: 20px;
        opacity: 0;
        animation: animate 1s ease-in-out 0.3s 1 forwards;
    }

    .read-button {
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
    .read-button:hover{
        background-color: #F58F5D;
        
    }

    @keyframes animate {
        from {
            opacity: 0;
            transform: translate(0, 100px);
            filter: blur(33px);
        }

        to {
            opacity: 1;
            transform: translate(0);
            filter: blur(0);
        }
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
    .gallery-slide-button-next:hover{
        background-color: #F58F5D;
    }

</style>

<script>
    let next = document.querySelector('.gallery-slide-button-next');
    let prev = document.querySelector('.gallery-slide-button-prev');

    next.addEventListener('click', function () {
        let items = document.querySelectorAll('.gallery-slide-item');
        document.querySelector('.gallery-slide').appendChild(items[0]);
    });

    prev.addEventListener('click', function () {
        let items = document.querySelectorAll('.gallery-slide-item');
        document.querySelector('.gallery-slide').prepend(items[items.length - 1]); // here the length of items = 6
    });


</script>