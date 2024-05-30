

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
<<<<<<< HEAD
    <div id="banner-left" class="banner-left">
        <div class="container-banner-left">
            <div class="banner-left-item">
                <img src="./images/vn-50009109-3b4844af326ff3b9c1e1793d0dbda9f3_xxhdpi.jpg" alt="Image 1">
                <!-- <div class="banner-left-caption">
                    <h1>HỢP TÁC KHOA HỌC VIỆT - NHẬT</h1>
                    <p>KHẲNG ĐỊNH CHẤT LƯỢNG TRONG TỪNG CÔNG TRÌNH</p>
                </div> -->
            </div>
            <div class="banner-left-item">
                <img src="./images/vn-50009109-8ade39b303e98847359dad8e272ff03b_xxhdpi.jpg" alt="Image 2">
                <!-- <div class="banner-left-caption">
                    <h1>Banner 2</h1>
                    <p>Mô tả cho Banner 2</p>
                </div> -->
            </div>
            <div class="banner-left-item">
                <img src="./images/vn-50009109-2f73310fe4fc32b9a2e5fb278fdc7d10_xxhdpi.jpg" alt="Image 3">
                <!-- <div class="banner-left-caption">
                    <h1>Banner 3</h1>
                    <p>Mô tả cho Banner 3</p>
                </div> -->
            </div>
=======
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
>>>>>>> e9a082cdfd155e485f9ddb0c4c31c8e11e068387
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

<style>
.banner-page {
    display: flex;
    gap: 5px;
    width: 90%;
    margin: 5px auto;
    overflow: hidden;
}

.banner-left {
    width: 70%;
    overflow: hidden;
    position: relative;
}

.container-banner-left {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.5s ease-in-out;
}

.banner-left-item {
    min-width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.banner-left-item img {
    width: 100%;
    height: auto;
}

.prev-banner-button,
.next-banner-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 20px 10px;
    cursor: pointer;
}

.prev-banner-button {
    left: 10px;
}

.next-banner-button {
    right: 10px;
}

.banner-right {
    width: 30%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.banner-right-item {
    width: 100%;
    height: calc(50% - 2.5px);
}

.banner-right-item:last-child {
    margin-bottom: 0;
}
</style>

<style>
@media only screen and (max-width: 600px) {
    .banner-page {
        position: relative;
        width: 100%;
        margin: -5px 0;
    }

    .banner-left {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .container-banner-left {
        display: flex;
        transition: transform 0.5s ease;
        position: relative;
        width: 100%;
    }

    .banner-left-item {
        flex: 0 0 100%;
        position: relative;
    }

    .banner-left-item img {
        width: 100%;
        height: 100%;
        /* object-fit: contain; */
    }

    .prev-banner-button,
    .next-banner-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 20px 10px;
        border: none;
        z-index: 1;
    }

    .prev-banner-button {
        left: 5px;
    }

    .next-banner-button {
        right: 5px;
    }

    .banner-right {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const container = document.querySelector('.container-banner-left');
    const items = document.querySelectorAll('.banner-left-item');
    const prevButton = document.querySelector('.prev-banner-button');
    const nextButton = document.querySelector('.next-banner-button');
    let isMoving = false;

    prevButton.addEventListener('click', () => {
        if (isMoving) return;
        isMoving = true;

        const lastItem = container.querySelector(".banner-left-item:last-child");
        container.insertBefore(lastItem, container.firstChild);
        container.style.transition = "none";
        container.style.transform = "translateX(-100%)";

        setTimeout(() => {
            container.style.transition = "transform 0.5s ease-in-out";
            container.style.transform = "translateX(0)";

            container.addEventListener('transitionend', () => {
                isMoving = false;
            }, {
                once: true
            });
        }, 20);
    });

    nextButton.addEventListener('click', () => {
        if (isMoving) return;
        isMoving = true;

        const firstItem = container.querySelector(".banner-left-item:first-child");
        container.style.transition = "transform 0.5s ease-in-out";
        container.style.transform = "translateX(-100%)";

        container.addEventListener('transitionend', () => {
            container.appendChild(firstItem);
            container.style.transition = "none";
            container.style.transform = "translateX(0)";
            isMoving = false;
        }, {
            once: true
        });
    });

    setInterval(() => {
        nextButton.click();
    }, 5000);
});
</script>