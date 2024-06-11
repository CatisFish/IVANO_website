<?php
include 'php/conection.php';

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
        GROUP BY  p.product_id
        LIMIT 4";

$result = $conn->query($sql);

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
        echo '<div class="product-price"><span>' . htmlspecialchars(number_format($row['price'], 0, ',', '.')) . ' VNĐ </span><i class="fa-solid fa-arrow-right"></i></div>';

        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo "<p class='no-products'>Không có sản phẩm nào.</p>";
}

$conn->close();
?>


<style>
    .container-outstanding {
        width: 90%;
        margin: 0 auto;
        position: relative;
    }

    .container-heading-oustanding {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .container-heading-oustanding h1 {
        text-align: left;
        font-size: 30px;
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
        position: relative;
    }

    .see-more::before {
        content: "\f061";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: -80px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: left 0.5s, opacity 0.5s;
        font-size: 25px;
    }

    .see-more:hover a {
        color: #FC0000;
        transition: transform ease-in-out 0.3s;
    }

    .see-more:hover::before {
        left: -40px;
        opacity: 1;
        color: #FC0000;
    }

    .container-list-product {
        position: relative;
        margin: 30px 0;
    }

    .list-product {
        max-width: 100%;
        gap: 20px;
        display: flex;
    }

    .product-item {
        padding: 0 10px;
        width: 25%;
        position: relative;
        border-radius: 20px;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    .product-item:hover .product-img {
        transform: translateY(-35px);
    }

    .product-item:hover .product-name {
        color: #F58F5D;
        transition: all ease-in-out 0.3s;
    }

    .product-item:hover .product-price {
        background-color: #F58F5D;
        transition: all ease-in-out 0.3s;
    }

    @-webkit-keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    .product-item img {
        width: 100%;
        height: auto;
        /* width: 280px;
        height: 320px; */
        transition: transform ease-in-out 0.3s;
    }

    .product-info {
        padding: 0 5px;
        margin-top: -10px;
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
        color: #221F20;
        font-size: 17px;
    }

    .product-price {
        display: flex;
        color: #FFF;
        font-weight: 600;
        margin: 10px 0 10px 0;
        justify-content: space-between;
        padding: 15px 15px;
        background-color: #55D5D2;
        border-radius: 25px;
        align-items: center;
    }

    .product-price i {
        display: inline-block;
        transform: rotate(315deg);
        transition: transform 0.3s ease;
    }

    .product-item:hover .product-price i {
        transform: rotate(0deg);
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .see-more {
            display: block;
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