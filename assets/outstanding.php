<?php
include 'php/conection.php';

// Query to fetch product details along with related category, brand, and image
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, 
               (SELECT i.path_image 
                FROM product_images i 
                WHERE i.product_id = p.product_id 
                ORDER BY i.product_image_id LIMIT 1) as path_image
        FROM products p 
        INNER JOIN categories c ON p.category_id = c.category_id
        INNER JOIN brands b ON p.brand_id = b.brand_id
        INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
        INNER JOIN product_size ps ON p.product_id = ps.product_id
        INNER JOIN sizes s ON ps.size_id = s.size_id
        GROUP BY  ps.product_size_id";

$result = $conn->query($sql);

// Displaying data
if ($result->num_rows > 0) {
    echo '<section class="container-list-product">';
    echo '<div class="list-product">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<a href="show-detail.php?product_id=' . htmlspecialchars($row['product_id'], ENT_QUOTES, 'UTF-8') . '" class="container-info">';
        echo '<img class="product-img" src="admin/' . htmlspecialchars($row['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '">';

        echo '<div class="product-info">';
        echo '<p class="brand-name">' . 'SƠN ' . htmlspecialchars($row['brand_name'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p class="product-name">' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<div class="product-action">';
        echo '<div class="product-price">' . htmlspecialchars(number_format($row['price'], 0, ',', '.')) . ' VNĐ</div>';
        echo '<div class="action-add">';
        echo '<button type="submit" class="view-product">';
        echo '<p>Xem Nhanh</p>';
        echo '</button>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button class="prev-button"><i class="fa-solid fa-chevron-left"></i></button>';
    echo '<button class="next-button"><i class="fa-solid fa-chevron-right"></i></button>';
    echo '</section>';
} else {
    echo "<p class='no-products'>Không có sản phẩm nào.</p>";
}

$conn->close();
?>


<style>
    .see-more {
        display: none;
    }

    .container-outstanding {
        width: 80%;
        margin: 0 auto;
        position: relative;
    }

    .container-outstanding h1 {
        text-align: center;
        font-size: 30px;
        position: relative;
        z-index: 1;
        color: #FC0000;
        text-transform: uppercase;
    }

    .container-outstanding h1::before,
    .container-outstanding h1::after {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 1px;
        /* background-color: rgba(252, 185, 0, 1); */
        width: 35%;
        background-color: #FC0000;
    }

    .container-outstanding h1::before {
        left: 0;
    }

    .container-outstanding h1::after {
        right: 0;
    }

    .container-list-product {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 1200px;
        margin: auto;
        margin: 30px 0;
    }

    .list-product {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .product-item {
        min-width: 25%;
        box-sizing: border-box;
        padding: 0 10px;
        position: relative;
        /* box-shadow: 0 5px 5px 0 rgb(0 0 0 / 10%); */
        border-radius: 20px;
    }

    .product-item img {
        /* width: 100%;
            height: auto; */
        width: 280px;
        height: 320px;
    }

    .brand-name {
        color: #333;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
        margin: 10px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .product-name {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        max-height: 45px;
        font-weight: 700;
        color: #1e73be;
        font-size: 17px;
    }

    .product-price {
        color: #f80000;
        font-weight: 600;
        margin: 10px 0 10px 0;
    }

    .prev-button,
    .next-button {
        position: absolute;
        top: 50%;
        background: none;
        transform: translateY(-50%);
        border: 1px solid #221F20;
        color: #333;
        width: 40px;
        height: 40px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 50%;
        color: #221F20;
        transition: all ease-in-out 0.3s;

    }

    .prev-button {
        left: 0px;
    }

    .next-button {
        right: 0px;
    }

    .prev-button:hover,
    .next-button:hover {
        background-color: #ff6900;
        color: #fff;
        border: 1px solid #ff6900;

    }
</style>

<style>
    .product-action .action-add .view-product {
        opacity: 0;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) translateY(-250%);
        background-color: #ff6900;
        border: none;
        padding: 10px 20px;
        transition: transform 0.3s ease, opacity 0.3s ease;
        width: 100%;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
    }

    .product-item:hover .product-action .action-add .view-product {
        transform: translateX(-50%) translateY(-125px);
        opacity: 1;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .see-more {
            display: block;
        }

        .prev-button,
        .next-button {
            display: none;
        }

        .container-outstanding h1::before,
        .container-outstanding h1::after {
            display: none;
        }

        .container-outstanding {
            width: 95%;
            margin: 25px auto;
            position: relative;
        }

        .container-heading-oustanding {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container-heading-oustanding h1 {
            text-align: center;
            font-size: 22px;
            position: relative;
            z-index: 1;
            color: #FC0000;
            text-transform: uppercase;
        }

        .see-more {
            background-color: #ffffff;
            border: 2px solid #FC0000;
            border-radius: 6px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .see-more a {
            color: #FC0000;
        }

        .container-list-product {
            position: relative;
            overflow: hidden;
            width: 100%;
            margin: auto;
            margin: 20px 0;
            display: flex;
            align-items: center;
        }

        .list-product {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }

        .product-item {
            min-width: 50%;
            box-sizing: border-box;
            padding: 0 10px;
            text-align: center;
        }

        .product-item img {
            width: 100%;
        }

        .brand-name {
            color: #333;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 12px;
            margin: 10px 0;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            text-align: left;
        }

        .product-name {
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            max-height: 45px;
            font-weight: 700;
            color: #1e73be;
            font-size: 15px;
        }

        .product-price {
            color: #f80000;
            font-weight: 600;
            margin: 10px 0 10px 0;
            text-align: left;
        }

        .product-action .action-add {
            display: none;
        }
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productContainer = document.querySelector('.list-product');
        const productItems = document.querySelectorAll('.product-item');
        const prevButton = document.querySelector('.prev-button');
        const nextButton = document.querySelector('.next-button');

        let currentIndex = 0;
        const itemsToShow = 4;
        const additionalItems = 2;
        const totalItems = productItems.length / 2 + additionalItems;

        prevButton.addEventListener('click', () => {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = totalItems - 1;
            }
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            currentIndex += additionalItems;
            if (currentIndex >= totalItems) {
                currentIndex = 0;
            }
            updateCarousel();
        });

        function updateCarousel() {
            let newIndex = currentIndex % totalItems;
            if (newIndex < 0) newIndex += totalItems;

            const newTransformValue = -(newIndex * 100 / itemsToShow) + '%';
            productContainer.style.transform = `translateX(${newTransformValue})`;
        }
    });
</script>

<script>
    if (window.matchMedia("(max-width: 600px)").matches) {
        document.addEventListener('DOMContentLoaded', () => {
            if (window.matchMedia("(max-width: 600px)").matches) {
                const listProduct = document.querySelector('.list-product');
                const items = document.querySelectorAll('.product-item');
                const itemWidth = items[0].offsetWidth + 10;

                let currentIndex = 0;
                let startX = 0;
                let isDragging = false;

                function slideNext() {
                    listProduct.style.transition = "transform 0.5s ease-in-out";
                    listProduct.style.transform = `translateX(-${itemWidth}px)`;

                    setTimeout(() => {
                        const firstItem = listProduct.querySelector('.product-item:first-child');
                        listProduct.appendChild(firstItem);

                        listProduct.style.transition = "none";
                        listProduct.style.transform = "translateX(0)";

                        currentIndex = (currentIndex + 1) % items.length;
                    }, 450);
                }

                function slidePrev() {
                    listProduct.style.transition = "none";
                    listProduct.style.transform = `translateX(-${itemWidth}px)`;

                    const lastItem = listProduct.querySelector('.product-item:last-child');
                    listProduct.insertBefore(lastItem, listProduct.firstChild);

                    setTimeout(() => {
                        listProduct.style.transition = "transform 0.5s ease-in-out";
                        listProduct.style.transform = "translateX(0)";
                    }, 50);
                }


                listProduct.addEventListener('mousedown', (event) => {
                    startX = event.pageX;
                    isDragging = true;
                });

                listProduct.addEventListener('mousemove', (event) => {
                    if (isDragging) {
                        const diffX = event.pageX - startX;
                        if (diffX > 50) {
                            slidePrev();
                            isDragging = false;
                        } else if (diffX < -50) {
                            slideNext();
                            isDragging = false;
                        }
                    }
                });

                listProduct.addEventListener('mouseup', () => {
                    isDragging = false;
                });

                listProduct.addEventListener('mouseleave', () => {
                    isDragging = false;
                });

                // Lắng nghe sự kiện cảm ứng
                listProduct.addEventListener('touchstart', (event) => {
                    startX = event.touches[0].pageX;
                    isDragging = true;
                });

                listProduct.addEventListener('touchmove', (event) => {
                    if (isDragging) {
                        const diffX = event.touches[0].pageX - startX;
                        if (diffX > 50) {
                            slidePrev();
                            isDragging = false;
                        } else if (diffX < -50) {
                            slideNext();
                            isDragging = false;
                        }
                    }
                });

                listProduct.addEventListener('touchend', () => {
                    isDragging = false;
                });

                listProduct.addEventListener('touchcancel', () => {
                    isDragging = false;
                });


            }
        });
    }
</script>