<section class="banner-page">
    <div id="infiniteCarousel" class="carousel banner-left">
        <div class="carousel-inner">
            <?php
            // Include file connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ivano_website";
        
            $conn = new mysqli($servername, $username, $password, $database);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to get only one banner for the left carousel
            $sql_left = "SELECT banner_title, banner_img FROM banners LIMIT 1";
            $result_left = $conn->query($sql_left);

            // Check if there are any banners for the left carousel
            if ($result_left && $result_left->num_rows > 0) {
                // Output data of the left banner
                $row_left = $result_left->fetch_assoc();
                echo '<div class="carousel-item">';
                echo '<img src="uploads/' . $row_left['banner_img'] . '" alt="' . $row_left['banner_title'] . '">';
                echo '<div class="carousel-caption">';
                echo '<h1>' . $row_left['banner_title'] . '</h1>';
                echo '</div></div>';
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
        // Query to get two banners for the right carousel
        $sql_right = "SELECT banner_title, banner_img FROM banners LIMIT 1, 2";
        $result_right = $conn->query($sql_right);

        // Check if there are any banners for the right carousel
        if ($result_right && $result_right->num_rows > 0) {
            // Output data of each row for the right banners
            while($row_right = $result_right->fetch_assoc()) {
                echo '<img src="uploads/' . $row_right['banner_img'] . '" alt="' . $row_right['banner_title'] . '" class="banner-right-item">';
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
            slideInterval = setInterval(nextSlide, 3000);
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
