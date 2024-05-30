<?php
include 'php/conection.php';

$sql = "SELECT p.*, i.path_image, b.brand_name FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id
        LEFT JOIN brands b ON p.brand_id = b.brand_id
        ORDER BY RAND() LIMIT 8";
$result = $conn->query($sql);

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo '<section class="container-list-product">';
    echo '<div class="list-product">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<a href="show-detail.php?product_id=' . $row['product_id'] . '" class="container-info">';
        echo '<img class="product-img" src="admin/' . $row['path_image'] . '" alt="' . $row['product_name'] . '">';

        echo '<div class="product-info">';
        echo '<p class="brand-name">' . 'SƠN ' . $row['brand_name'] . '</p>';
        echo '<p class="product-name">' . $row['product_name'] . '</p>';

        echo '<div class="product-action">';
        echo '<div class="product-price">' . $row['product_price'] . '</div>';

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.querySelector('.list-product');
    const productItems = document.querySelectorAll('.product-item');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');

    let currentIndex = 0;
    const itemsToShow = 4;
    const additionalItems = 2; // Additional items to show when clicking "next"
    const totalItems = productItems.length / 2 + additionalItems; // Adjust total items

    prevButton.addEventListener('click', () => {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalItems - 1;
        }
        updateCarousel();
    });

    nextButton.addEventListener('click', () => {
        currentIndex += additionalItems; // Increment index by additional items
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