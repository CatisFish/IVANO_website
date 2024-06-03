<section class="banner-page">
    <div id="banner-left" class="banner-left">
        <div class="container-banner-left">
            <?php
            include "php/conection.php";

            $sql_banner_left = "SELECT banner_title, banner_img FROM banners ORDER BY banner_id DESC LIMIT 3";

            $result_banner_left = $conn->query($sql_banner_left);

            if ($result_banner_left->num_rows > 0) {
                while ($row = $result_banner_left->fetch_assoc()) {
                    echo '<div class="banner-left-item">';
                    echo '<img src="uploads/' . $row["banner_img"] . '" alt="Banner Image">';
                    echo '</div>';
                }
            } else {
                echo "Không có dữ liệu banner.";
            }

            $conn->close();
            ?>
        </div>
        <button class="prev-banner-button"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="next-banner-button"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <div class="banner-right">
        <?php
        include "php/conection.php";

        $sql_right = "SELECT banner_img FROM banners ORDER BY RAND() LIMIT 2";

        $result_right = $conn->query($sql_right);

        if ($result_right->num_rows > 0) {
            while ($row = $result_right->fetch_assoc()) {
                echo '<img src="uploads/' . $row["banner_img"] . '" alt="" class="banner-right-item">';
            }
        } else {
            echo "Không có dữ liệu banner.";
        }

        $conn->close();
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
        transition: all ease-in-out 0.3s;
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

    .banner-left:hover .prev-banner-button,
    .banner-left:hover .next-banner-button {
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
    }

    .prev-banner-button,
    .next-banner-button {
        position: absolute;
        background: none;
        top: 50%;
        transform: translateY(-50%);
        color: #221F20;
        border: none;
        padding: 30px 10px;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
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