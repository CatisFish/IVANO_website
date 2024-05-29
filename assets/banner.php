

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ivano_website";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get only one banner for the left carousel
    $sql_left = "SELECT banner_title, banner_img FROM banners";
    $result_left = $conn->query($sql_left);
?>

<section class="banner-page">
    <div id="infiniteCarousel" class="carousel banner-left">
        <div class="carousel-inner">
            <?php
                // Check if there are any banners
                if ($result_left && $result_left->num_rows > 0) {
                    // Output data of each row
                    while($row_left = $result_left->fetch_assoc()) {
                        echo '<div class="carousel-item">';
                        echo '<img src="./images/' . $row_left['banner_img'] . '" alt="' . $row_left['banner_title'] . '">';
                        echo '<div class="carousel-caption">';
                        echo '<h1>' . $row_left['banner_title'] . '</h1>';
                        // Add description if available
                        echo '<p>Mô tả cho ' . $row_left['banner_title'] . '</p>';
                        echo '</div></div>';
                    }
                } else {
                    echo '<p>No banners available</p>';
                }
            ?>
        </div>
        <button class="prev-banner-button"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="next-banner-button"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <div class="banner-right">
        <?php
            // Display banners in the right section (assuming you want to display all banners)
            $sql_right = "SELECT banner_title, banner_img FROM banners";
            $result_right = $conn->query($sql_right);
            if ($result_right && $result_right->num_rows > 0) {
                while($row_right = $result_right->fetch_assoc()) {
                    echo '<img src="./images/' . $row_right['banner_img'] . '" alt="' . $row_right['banner_title'] . '" class="banner-right-item">';
                }
            } else {
                echo '<p>No banners available</p>';
            }
        ?>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselInner = document.querySelector(".carousel-inner");
        var items = document.querySelectorAll(".carousel-item");
        var totalItems = items.length;
        var currentIndex = 0;
        var slideInterval;

        function shiftAndMove() {
            carouselInner.style.transition = "transform 1s ease-in-out";
            carouselInner.style.transform = "translateX(-100%)";

            setTimeout(function() {
                var firstItem = document.querySelector(".carousel-item:first-child");
                carouselInner.appendChild(firstItem);
                carouselInner.style.transition = "none";
                carouselInner.style.transform = "translateX(0)";
                currentIndex = (currentIndex + 1) % totalItems;
            }, 1000);
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalItems;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalItems) % totalItems;
            updateCarousel();
        }

        function updateCarousel() {
            const offset = -currentIndex * 100;
            carouselInner.style.transition = 'transform 1s ease-in-out';
            carouselInner.style.transform = `translateX(${offset}%)`;
        }

        function startSlide() {
            slideInterval = setInterval(shiftAndMove, 3000);
        }

        function stopSlide() {
            clearInterval(slideInterval);
        }

        startSlide();

        document.querySelector(".next-banner-button").addEventListener("click", function() {
            nextSlide();
            stopSlide();
            startSlide();
        });

        document.querySelector(".prev-banner-button").addEventListener("click", function() {
            prevSlide();
            stopSlide();
            startSlide();
        });
    });
</script>

<style>
    .banner-page {
        position: relative;
        display: flex;
        width: 90%;
        margin: 10px auto;
    }

    .carousel {
        position: relative;
        width: 70%;
        height: 280px;
        overflow: hidden;
    }

    .carousel-inner {
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-item {
        flex: 0 0 auto;
        width: 100%;
        position: relative;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
        margin: 0 auto;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.7);
        padding: 10px;
        box-sizing: border-box;
        color: white;
        text-align: center;
        transition: bottom 0.5s ease-in-out;
        transform: translateY(100%);

    }

    .carousel-item:hover .carousel-caption {
        bottom: 0;
        transform: translateY(0%);
    }

    .banner-right {
        width: 30%;
        margin-left: 10px;
    }

    
    .banner-right-item {
        width: 100%;
        height: 135px;
        margin-bottom: 5px;
    }

    .prev-banner-button,
    .next-banner-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 20pX 10px;
        cursor: pointer;
        border: none;
        z-index: 1;
    }

    .prev-banner-button {
        left: 10px;
    }

    .next-banner-button {
        right: 10px;
    }
</style>


<!-- <style>
    .banner-page{
        display: flex;
        width: 90%;
        margin: 10px auto;
    }

    .banner-left{
        width: 70%;
        height: 280px;
        margin-right: 10px;
        position: relative;
    }

    .prev-banner-button, .next-banner-button{
        position: absolute;
        top: 50%;
        background: #000;
        transform: translateY(-50%);
        cursor: pointer;
        color: #fff;
        height: 50px;
        padding: 0 10px;
        border: none;
    }
    
    .prev-banner-button{
        left: 0;
    }

    .next-banner-button{
    right: 0;
    }

    .carousel-inner {
        display: flex;
        width: 100%;
    }

    .carousel-item {
        flex: 0 0 auto;
        width: 100%;
        position: relative;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
        margin: 0 auto;
    }

    .carousel-caption {
        position: absolute;
        bottom: -50%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: white;
        animation: slideUp 1.5s ease forwards;
    }

    @keyframes slideUp {
        from {
            bottom: -50%;
        }

        to {
            bottom: 50%;
        }
    }

    .carousel-caption h1 {
        font-size: 20px;
        font-weight: bold;
        text-shadow: 10px 10px 30px rgba(0, 0, 0, 1.9);
    }

    .carousel-caption p {
        font-size: 15px;
        margin-top: 20px;
        text-shadow: 10px 10px 30px rgba(0, 0, 0, 1.9);
    }

    .banner-right{
        width: 30%;
    }

    .banner-right-item{
        width: 400px;
        height: 135px;
    }

    .banner-right img:last-child{
        margin-top: 5px;
    }
</style> -->

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselInner = document.querySelector(".carousel-inner");

        function shiftAndMove() {
            carouselInner.style.transition = "transform 1s ease-in-out";
            carouselInner.style.transform = "translateX(-100%)";

            setTimeout(function() {
                var firstItem = document.querySelector(".carousel-item:first-child");
                carouselInner.appendChild(firstItem);
                carouselInner.style.transition = "none";
                carouselInner.style.transform = "translateX(0)";
            }, 1000);
        }

        setInterval(shiftAndMove, 30000);
    });
</script> -->