<?php
include 'php/conection.php';

$flashSaleSql = "
        SELECT f.*, p.product_name, b.brand_name, ps.price, i.path_image, t.start_time, t.end_time, f.quantity as remaining_quantity,
            GROUP_CONCAT(DISTINCT s.size_name ORDER BY s.size_id SEPARATOR ', ') as available_sizes, 
            GROUP_CONCAT(DISTINCT cs.color_suffix_name ORDER BY cs.color_suffix_id SEPARATOR ', ') as available_colors_suffix
        FROM time_flashsale t
        INNER JOIN flashsale f ON t.flashsale_id = f.flashsale_id
        INNER JOIN products p ON f.id_sanpham = p.id_sanpham
        INNER JOIN brands b ON p.brand_id = b.brand_id
        INNER JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
        INNER JOIN sizes s ON ps.size_id = s.size_id
        LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham
        LEFT JOIN colorsuffix cs ON 1 = 1
        GROUP BY f.flashsale_id, p.id_sanpham, ps.price, f.quantity, p.product_name, b.brand_name, i.path_image, t.start_time, t.end_time";

$flashSaleResult = $conn->query($flashSaleSql);

if ($flashSaleResult->num_rows > 0) {
    echo '<div class="container-fsale">';
    echo '<div class="list-fsale">';

    while ($row = $flashSaleResult->fetch_assoc()) {
        $endTime = new DateTime($row['end_time']);
        $endTimeStr = $endTime->format('Y-m-d H:i:s');
        $originalPrice = $row['price'];
        $discount = $row['discount'];
        $discountedPrice = $originalPrice - ($originalPrice * $discount / 100);

        echo '<div class="fsale-product">';
        echo '<p class="fsale-percent">- ' . $discount . '%</p>';
        echo '<div class="container-img-fsale">';
        if (!empty($row['path_image'])) {
            echo '<img class="fsale-product-img" src="uploads/' . htmlspecialchars($row['path_image']) . '" alt="Product Image">';
        } else {
            echo 'No Image';
        }
        echo '</div>';

        echo '<p class="product-name-fsale">' . htmlspecialchars($row['product_name']) . '</p>';

        echo '<div class="container-fsale-price">';
        echo '<p class="original-price">' . number_format($originalPrice) . ' VNĐ</p>';
        echo '<p class="fsale-price-new">' . number_format($discountedPrice) . ' VNĐ</p>';
        echo '</div>';

        echo '<p class="available-sizes">Quy cách: ';
        $sizes = explode(',', $row['available_sizes']);
        $unique_sizes = array_unique($sizes);
        echo implode(', ', $unique_sizes);
        echo '<p class="quantity-remaining">Số lượng còn lại: ' . htmlspecialchars($row['remaining_quantity']) . '</p>';

        echo '</p>';

        echo '<p id="time-' . htmlspecialchars($row['id_sanpham']) . '" data-end-time="' . htmlspecialchars($endTimeStr) . '" class="time-fsale"></p>';

        if (!empty($row['available_colors_suffix'])) {
            $colors = explode(',', $row['available_colors_suffix']);
            echo '<div class="available-colors">';
            foreach ($colors as $color) {
                echo '<p class="available-color">' . htmlspecialchars(trim($color)) . '</p>';
            }
            echo '</div>';
        } else {
            echo '<div class="available-colors">';
            echo '<p class="available-color">Không có thông tin màu sắc.</p>';
            echo '</div>';
        }

        echo '<div class="action-fsale">';
        echo '<div class="quantity-container-fsale">';
<<<<<<< HEAD:assets/fsales.php
        echo '<button class="minus-fsale" type="button"><i class="fa-solid fa-minus"></i></button>';
        echo '<p class="quantity-fsale">1</p>';
        echo '<button class="plus-fsale" type="button"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';

        echo '<button class="add-to-cart-fsale"><i class="fa-solid fa-basket-shopping add-to-cart-icon"></i></button>';
=======
        echo '<button class="minus-fsale" type="button" onclick="reduceQuantity(' . $row['flashsale_id'] . ')"><i class="fa-solid fa-minus"></i></button>';
        echo '<p class="quantity-fsale" id="quantity-' . $row['flashsale_id'] . '">' . $row['remaining_quantity'] . '</p>';
        echo '<button class="plus-fsale" type="button"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';

        echo '<button id="cart-icon"  class="add-to-cart-fsale" onclick="addToCart(' . $row['flashsale_id'] . ')"><i class="fa-solid fa-basket-shopping add-to-cart-icon"></i></button>';
>>>>>>> 427d8b78ca8e79a67b0a582f15161364e0a7164c:assets/flsale.php
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

<<<<<<< HEAD:assets/fsales.php

    echo '</div>';
    echo '</div>';

=======
>>>>>>> 427d8b78ca8e79a67b0a582f15161364e0a7164c:assets/flsale.php
} else {
    echo '<p>Không có sản phẩm trong Flash Sale.</p>';
}

$conn->close();
?>

<<<<<<< HEAD:assets/fsales.php
<!-- update time -->
=======


<script>
   document.addEventListener('DOMContentLoaded', function () {
    var flashSaleProducts = document.querySelector('.container-item-fsale');

    if (flashSaleProducts) {
        var productList = flashSaleProducts.querySelectorAll('.fsale-product');

        productList.forEach(function (product) {
            var addToCartBtn = product.querySelector('.add-to-cart-fsale');
            var productName = product.querySelector('.product-name-fsale').textContent;
            var discountedPrice = product.querySelector('.fsale-price-new').textContent;
            var productImage = product.querySelector('.fsale-product-img').getAttribute('src');
            var availableSizesElement = product.querySelector('.available-sizes');
            var availableSizesText = availableSizesElement.textContent.trim();
            var selectedSize = availableSizesText.split(': ')[1]; // Lấy phần kích thước sau dấu hai chấm
            var productID = product.querySelector('.time-fsale').getAttribute('id').replace('time-', '');

            var quantityElement = product.querySelector('.quantity-fsale');
            var minusBtn = product.querySelector('.minus-fsale');
            var plusBtn = product.querySelector('.plus-fsale');

            var cartItems = []; // Mảng chứa các sản phẩm trong giỏ hàng

        // Kiểm tra và load giỏ hàng từ localStorage
        if (localStorage.getItem('cartItems')) {
            cartItems = JSON.parse(localStorage.getItem('cartItems'));
            renderCartItems(); // Render lại danh sách sản phẩm trong giỏ hàng
            updateCartLength(); // Cập nhật lại số lượng sản phẩm trong giỏ hàng trên giao diện
        }

            // Xử lý sự kiện khi nhấn nút "minus"
            minusBtn.addEventListener('click', function () {
                var currentQuantity = parseInt(quantityElement.textContent);
                if (currentQuantity > 1) {
                    quantityElement.textContent = currentQuantity - 1;
                }
            });

            // Xử lý sự kiện khi nhấn nút "plus"
            plusBtn.addEventListener('click', function () {
                var currentQuantity = parseInt(quantityElement.textContent);
                quantityElement.textContent = currentQuantity + 1;
            });

            addToCartBtn.addEventListener('click', function () {
                var availableColorsContainer = product.querySelector('.available-colors');
                availableColorsContainer.style.display = 'block';

                var availableColors = availableColorsContainer.querySelectorAll('.available-color');
                availableColors.forEach(function (colorElement) {
                    colorElement.addEventListener('click', function () {
                        var selectedColor = colorElement.textContent.trim();
                        availableColorsContainer.style.display = 'none';

                        var item = {
                            name: productName,
                            price: discountedPrice,
                            image: productImage,
                            quantity: parseInt(quantityElement.textContent), // Lấy số lượng từ element hiển thị
                            size: selectedSize,
                            color: selectedColor,
                            id: productID
                        };

                        addToCart(item);
                    });
                });
            });
        });
    } else {
        var flashSaleContainer = document.getElementById('flash-sale-container');
        if (flashSaleContainer) {
            flashSaleContainer.innerHTML = '<p>Không có sản phẩm trong Flash Sale.</p>';
        }
    }

    function addToCart(item) {
    var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];

    var existingItemIndex = cartItems.findIndex(function (cartItem) {
        return cartItem.name === item.name &&
            cartItem.size === item.size &&
            cartItem.color === item.color &&
            cartItem.id === item.id;
    });

    if (existingItemIndex !== -1) {
        // Nếu sản phẩm đã tồn tại, cộng thêm số lượng
        cartItems[existingItemIndex].quantity += 1; // Cộng thêm 1 vào số lượng hiện có của sản phẩm
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
        cartItems.push(item);
    }

    // Cập nhật lại dữ liệu trong localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Cập nhật độ dài của giỏ hàng trên giao diện
    updateCartLength();
}


    function updateCartLength() {
        var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
        var cartLength = document.getElementById('lenght-cart');

        if (cartLength) {
            cartLength.textContent = cartItems.reduce(function (total, cartItem) {
                return total + cartItem.quantity;
            }, 0);
        }

        renderCartItems();
    }

    function renderCartItems() {
        var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
        var cartItemsContainer = document.getElementById('cart-items');

        if (cartItemsContainer) {
            cartItemsContainer.innerHTML = '';

            cartItems.forEach(function (cartItem, index) {
                var cartItemHTML = '<div class="cart-item">';
                cartItemHTML += '<img src="' + cartItem.image + '" alt="' + cartItem.name + '" class="cart-item-image">';
                cartItemHTML += '<div class="item-details">';
                cartItemHTML += '<p class="item-name">' + cartItem.name + '</p>';
                cartItemHTML += '<p class="item-price">Tạm tính: ' + cartItem.price + '</p>';
                cartItemHTML += '<p class="item-quantity">Số lượng: ' + cartItem.quantity + '</p>';
                cartItemHTML += '<p class="item-size">Kích Thước: ' + cartItem.size + '</p>';
                cartItemHTML += '<p class="item-color">Đuôi: ' + cartItem.color + '</p>';
                cartItemHTML += '<button class="delete-cart-item" data-index="' + index + '"><i class="fa-regular fa-trash-can"></i></button>';
                cartItemHTML += '</div>';
                cartItemHTML += '</div>';

                cartItemsContainer.innerHTML += cartItemHTML;
            });

            var deleteButtons = cartItemsContainer.querySelectorAll('.delete-cart-item');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    var index = parseInt(event.currentTarget.getAttribute('data-index'));
                    cartItems.splice(index, 1);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    updateCartLength();
                });
            });
        }
    }
});



</script>










>>>>>>> 427d8b78ca8e79a67b0a582f15161364e0a7164c:assets/flsale.php
<script>
    function updateTime() {
        const timeElements = document.querySelectorAll('[id^="time-"]');
        timeElements.forEach(function (element) {
            const endTimeStr = element.getAttribute('data-end-time');
            if (endTimeStr) {
                const endTime = new Date(endTimeStr);
                const currentTime = new Date();
                const diff = endTime - currentTime;

                if (diff > 0) {
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    element.innerHTML = `${days} ngày ${hours} giờ ${minutes} phút ${seconds} giây`;
                } else {
                    element.innerHTML = 'Flash Sale đã kết thúc';
                }
            }
        });
    }

    setInterval(updateTime, 1000);
    window.onload = updateTime;
</script>

<style>
    .container-heading-fsale {
        display: flex;
        justify-content: space-between;
    }

    .title-fsale {
        font-size: 30px;
        color: #FC0000;
        margin: 10px 0 50px 0;
    }

    .see-more-fsale {
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
        height: min-content;
    }

    .see-more-fsale::before {
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

    .see-more-fsale:hover a {
        color: #FC0000;
        transition: transform ease-in-out 0.3s;
    }

    .see-more-fsale:hover::before {
        left: -40px;
        opacity: 1;
        color: #FC0000;
    }

    .fsale {
        width: 90%;
        margin: 0 auto;
        position: relative;
    }

    .container-fsale {
        position: relative;
        overflow: hidden;
        width: 100%;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .list-fsale {
        display: flex;
        max-width: 100%;
        gap: 20px;
        overflow: hidden;
        transition: all ease-in-out 0.5s;
        scroll-behavior: smooth;
    }

    .list-fsale .fsale-product:nth-child(n+5) {
        display: none;
    }

    .fsale-product {
        border-radius: 10px;
        position: relative;
        padding: 15px;
        width: 25%;
        border: 1px solid #ddd;
    }

    .container-img-fsale {
        display: flex;
        height: 180px;
        align-items: flex-end;
        justify-content: center;
        margin-bottom: 10px;
    }

    .fsale-product-img {
        width: 160px;
        transition: transform ease-in-out 0.3s;
    }

    .fsale-percent {
        position: absolute;
        right: 0;
        top: 0px;
        font-weight: 700;
        color: #FFF;
        background-color: #FC0000;
        padding: 5px 5px;
    }

    .product-name-fsale {
        font-weight: 600;
        color: #F58F5D;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        height: 50px;
    }

    .container-fsale-price {
        display: flex;
        justify-content: space-between;
        margin: 5px 0 10px 0;
        align-items: center;
    }

    .original-price {
        text-decoration: line-through;
        color: gray;
        opacity: 0.7;
    }

    .fsale-price-new {
        font-size: 19px;
        color: #f44336;
        font-weight: 700;
    }

    .available-sizes {
        margin-bottom: 10px;
        font-weight: 500;
    }

    .quantity-remaining {
        margin-bottom: 10px;
        font-weight: 500;
    }

    .time-fsale {
        font-size: 12px;
        text-align: left;
        font-weight: 600;
    }

    .available-colors {
        display: none;
        position: absolute;
        background-color: lightgray;
        font-weight: 500;
        bottom: 60px;
        right: 20px;
        border-radius: 10px;
        overflow: hidden;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    .available-color {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .available-color:last-child {
        border-bottom: none;
    }

    .available-color:hover {
        background-color: #FFF;
        cursor: pointer;
    }

    .action-fsale {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .quantity-container-fsale{
        display: flex;
        background-color: #55D5D2;
        padding: 10px;
        gap: 10px;
        border-radius: 20px;
        color: #FFF;
        font-weight: 600;
    }

    .minus-fsale{
        padding-right: 20px;
        border: none;
        background: none;
        padding-left: 10px;
        color: #FFF;
        border-right: 1px solid #ddd;
        cursor: pointer;
    }
    .plus-fsale{
        padding-left: 20px;
        border: none;
        background: none;
        padding-right: 10px;
        color: #FFF;
        border-left: 1px solid #ddd;
        cursor: pointer;

    }

    .quantity-fsale{
        padding: 0 10px;
    }
    .add-to-cart-fsale {
        padding: 10px;
        cursor: pointer;
        border: none;
        background-color: #55D5D2;
        color: #FFF;
        transition: all ease-in-out 0.3s;
        border-radius: 5px;
    }

    .add-to-cart-fsale:hover {
        background-color: #F58F5D;
    }

    .prev-item-fsale,
    .next-item-fsale {
        position: absolute;
        padding: 25px 10px;
        border: none;
        background-color: #221F20;
        color: #fff;
        cursor: pointer;
        top: 50%;
        transform: translateY(-50%);
    }

    .prev-item-fsale {
        left: 0;
    }

    .next-item-fsale {
        right: 0;
    }
</style>

<<<<<<< HEAD:assets/fsales.php
<!-- mobile css -->
<style>
    @media only screen and (max-width: 600px) {
        .fsale {
            width: 95% !important;
        }

        .title-fsale {
            margin: 10px 0 20px 0 !important;
        }

        .container-fsale {
            margin-bottom: 20px !important;
        }

        .list-fsale {
            gap: 10px !important;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }

        .fsale-product {
            border-radius: 10px !important;
            padding: 10px !important;
            width: 50% !important;
            min-width: calc(50% - 10px) !important;
        }
    }
</style>

<script>
    if (window.matchMedia("(max-width: 600px)").matches) {
        document.addEventListener('DOMContentLoaded', () => {
            if (window.matchMedia("(max-width: 600px)").matches) {
                const listProduct = document.querySelector('.list-fsale');
                const items = document.querySelectorAll('.fsale-product');
                const itemWidth = items[0].offsetWidth + 10;

                let currentIndex = 0;
                let startX = 0;
                let isDragging = false;

                function slideNext() {
                    listProduct.style.transition = "transform 0.5s ease-in-out";
                    listProduct.style.transform = `translateX(-${itemWidth}px)`;

                    setTimeout(() => {
                        const firstItem = listProduct.querySelector('.fsale-product:first-child');
                        listProduct.appendChild(firstItem);

                        listProduct.style.transition = "none";
                        listProduct.style.transform = "translateX(0)";

                        currentIndex = (currentIndex + 1) % items.length;
                    }, 450);
                }

                function slidePrev() {
                    listProduct.style.transition = "none";
                    listProduct.style.transform = `translateX(-${itemWidth}px)`;

                    const lastItem = listProduct.querySelector('.fsale-product:last-child');
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

<!-- thêm giỏ hàng fsale -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var flashSaleProducts = document.querySelector('.list-fsale');

        if (flashSaleProducts) {
            var productList = flashSaleProducts.querySelectorAll('.fsale-product');

            productList.forEach(function (product) {
                var addToCartBtn = product.querySelector('.add-to-cart-fsale');
                var productName = product.querySelector('.product-name-fsale').textContent;
                var discountedPrice = product.querySelector('.fsale-price-new').textContent;
                var productImage = product.querySelector('.fsale-product-img').getAttribute('src');
                var availableSizesElement = product.querySelector('.available-sizes');
                var availableSizesText = availableSizesElement.textContent.trim();
                var selectedSize = availableSizesText.split(': ')[1]; // Lấy phần kích thước sau dấu hai chấm
                var productID = product.querySelector('.time-fsale').getAttribute('id').replace('time-', '');

                var quantityElement = product.querySelector('.quantity-fsale');
                var minusBtn = product.querySelector('.minus-fsale');
                var plusBtn = product.querySelector('.plus-fsale');

                // Xử lý sự kiện khi nhấn nút "minus"
                minusBtn.addEventListener('click', function () {
                    var currentQuantity = parseInt(quantityElement.textContent);
                    if (currentQuantity > 1) {
                        quantityElement.textContent = currentQuantity - 1;
                    }
                });

                // Xử lý sự kiện khi nhấn nút "plus"
                plusBtn.addEventListener('click', function () {
                    var currentQuantity = parseInt(quantityElement.textContent);
                    quantityElement.textContent = currentQuantity + 1;
                });

                addToCartBtn.addEventListener('click', function () {
                    var availableColorsContainer = product.querySelector('.available-colors');
                    availableColorsContainer.style.display = 'block';

                    var availableColors = availableColorsContainer.querySelectorAll('.available-color');
                    availableColors.forEach(function (colorElement) {
                        colorElement.addEventListener('click', function () {
                            var selectedColor = colorElement.textContent.trim();
                            availableColorsContainer.style.display = 'none';

                            var item = {
                                name: productName,
                                price: discountedPrice,
                                image: productImage,
                                quantity: parseInt(quantityElement.textContent),
                                size: selectedSize,
                                color: selectedColor,
                                id: productID
                            };

                            addToCart(item);
                        });
                    });
                });
            });
        } else {
            var flashSaleContainer = document.getElementById('flash-sale-container');
            if (flashSaleContainer) {
                flashSaleContainer.innerHTML = '<p>Không có sản phẩm trong Flash Sale.</p>';
            }
        }

        function addToCart(item) {
            var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];

            var existingItemIndex = cartItems.findIndex(function (cartItem) {
                return cartItem.name === item.name &&
                    cartItem.size === item.size &&
                    cartItem.color === item.color &&
                    cartItem.id === item.id;
            });

            if (existingItemIndex !== -1) {
                cartItems[existingItemIndex].quantity += item.quantity;
            } else {
                cartItems.push(item);
            }

            localStorage.setItem('cartItems', JSON.stringify(cartItems));

            updateCartLength();
        }

        function updateCartLength() {
            var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
            var cartLength = document.getElementById('lenght-cart');

            if (cartLength) {
                cartLength.textContent = cartItems.reduce(function (total, cartItem) {
                    return total + cartItem.quantity;
                }, 0);
            }

            renderCartItems();
        }

        function renderCartItems() {
            var cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
            var cartItemsContainer = document.getElementById('cart-items');

            if (cartItemsContainer) {
                cartItemsContainer.innerHTML = '';

                cartItems.forEach(function (cartItem, index) {
                    var cartItemHTML = '<div class="cart-item">';
                    cartItemHTML += '<img src="' + cartItem.image + '" alt="' + cartItem.name + '" class="cart-item-image">';
                    cartItemHTML += '<div class="item-details">';
                    cartItemHTML += '<p class="item-name">' + cartItem.name + '</p>';
                    cartItemHTML += '<p class="item-price">Tạm tính: ' + cartItem.price + '</p>';
                    cartItemHTML += '<p class="item-quantity">Số lượng: ' + cartItem.quantity + '</p>';
                    cartItemHTML += '<p class="item-size">Kích Thước: ' + cartItem.size + '</p>';
                    cartItemHTML += '<p class="item-color">Đuôi: ' + cartItem.color + '</p>';
                    cartItemHTML += '<button class="delete-cart-item" data-index="' + index + '"><i class="fa-regular fa-trash-can"></i></button>';
                    cartItemHTML += '</div>';
                    cartItemHTML += '</div>';

                    cartItemsContainer.innerHTML += cartItemHTML;
                });

                var deleteButtons = cartItemsContainer.querySelectorAll('.delete-cart-item');
                deleteButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        var index = parseInt(event.currentTarget.getAttribute('data-index'));
                        cartItems.splice(index, 1);
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));
                        updateCartLength();
                    });
                });
            }
        }
    });
</script>
=======
<style>
    .overlay-fsale {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
    }
</style>
>>>>>>> 427d8b78ca8e79a67b0a582f15161364e0a7164c:assets/flsale.php
