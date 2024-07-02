<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include 'php/conection.php';

$flashSaleSql = "
    SELECT f.*, p.product_name, b.brand_name, ps.price, i.path_image, t.start_time, t.end_time, 
           GROUP_CONCAT(DISTINCT s.size_name ORDER BY s.size_id SEPARATOR ', ') as available_sizes, 
           GROUP_CONCAT(DISTINCT cs.color_suffix_name ORDER BY cs.color_suffix_id SEPARATOR ', ') as available_colors_suffix
            FROM time_flashsale t
            INNER JOIN flashsale f ON t.flashsale_id = f.flashsale_id
            INNER JOIN products p ON f.product_id = p.product_id
            INNER JOIN brands b ON p.brand_id = b.brand_id
            INNER JOIN product_size ps ON p.product_id = ps.product_id
            INNER JOIN sizes s ON ps.size_id = s.size_id
            LEFT JOIN product_images i ON p.product_id = i.product_id
            LEFT JOIN colorsuffix cs ON 1 = 1
            GROUP BY f.flashsale_id, p.product_id, ps.price";

$flashSaleResult = $conn->query($flashSaleSql);

?>

<!-- Hiển thị Flash Sale -->
<div class="overlay-fsale" id="overlay-fsale"></div>

<?php
if ($flashSaleResult->num_rows > 0) {
    echo '<div class="container-item-fsale">';

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
        echo '<p class="original-price">' . number_format($originalPrice) . 'đ</p>';
        echo '<p class="fsale-price-new">' . number_format($discountedPrice) . 'đ</p>';
        echo '</div>';

        echo '<p class="available-sizes">Quy cách: ';
        $sizes = explode(',', $row['available_sizes']);
        $unique_sizes = array_unique($sizes);
        echo implode(', ', $unique_sizes);
        echo '</p>';

        echo '<p id="time-' . htmlspecialchars($row['product_id']) . '" data-end-time="' . htmlspecialchars($endTimeStr) . '" class="time-fsale"></p>';

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
        echo '<button class="minus-fsale" type="button"><i class="fa-solid fa-minus"></i></button>';
        echo '<p class="quantity-fsale">1</p>';
        echo '<button class="plus-fsale" type="button"><i class="fa-solid fa-plus"></i></button>';
        echo '</div>';

        echo '<button class="add-to-cart-fsale"><i class="fa-solid fa-basket-shopping add-to-cart-icon"></i></button>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';


    echo '</div>';

} else {
    echo '<p>Không có sản phẩm trong Flash Sale.</p>';
}

$conn->close();
?>

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

    .container-fsale {
        width: 90%;
        margin: 0px auto;
        position: relative;
    }

    .container-item-fsale {
        display: flex;
        gap: 10px;
    }

    .fsale-product {
        border-radius: 10px;
        position: relative;
        padding: 20px;
        width: 20%;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
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

    .quantity-container-fsale {
        display: flex;
        background-color: #55D5D2;
        padding: 10px;
        gap: 10px;
        border-radius: 20px;
        color: #FFF;
        font-weight: 600;
    }

    .minus-fsale {
        padding-right: 20px;
        border: none;
        background: none;
        padding-left: 10px;
        color: #FFF;
        border-right: 1px solid #ddd;
        cursor: pointer;
    }

    .plus-fsale {
        padding-left: 20px;
        border: none;
        background: none;
        padding-right: 10px;
        color: #FFF;
        border-left: 1px solid #ddd;
        cursor: pointer;

    }

    .quantity-fsale {
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
        -webkit-animation: heartbeat 3s ease-in-out infinite both;
        animation: heartbeat 3s ease-in-out infinite both;
    }

    @-webkit-keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        10% {
            -webkit-transform: scale(0.91);
            transform: scale(0.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        17% {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        33% {
            -webkit-transform: scale(0.87);
            transform: scale(0.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }

    @keyframes heartbeat {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: center center;
            transform-origin: center center;
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        10% {
            -webkit-transform: scale(0.91);
            transform: scale(0.91);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        17% {
            -webkit-transform: scale(0.98);
            transform: scale(0.98);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        33% {
            -webkit-transform: scale(0.87);
            transform: scale(0.87);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        45% {
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }

    .add-to-cart-fsale:hover {
        background-color: #F58F5D;
    }
</style>

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

<style>
    @media only screen and (max-width: 600px) {
        .container-fsale {
            margin-bottom: 20px;
        }

        .container-item-fsale {
            display: flex;
            gap: 10px;

        }

        .fsale-product {
            border-radius: 10px;
            position: relative;
            padding: 20px;
            width: 49%;
            -webkit-animation: unset;
            animation: unset;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
    }
</style>

<script>
    if (window.matchMedia("(max-width: 600px)").matches) {
        document.addEventListener('DOMContentLoaded', () => {
            if (window.matchMedia("(max-width: 600px)").matches) {
                const fsaleList = document.querySelector('.container-item-fsale');
                const fsaleItems = document.querySelectorAll('.fsale-product');
                const fsaleItemWidth = fsaleItems[0].offsetWidth + 10;
                const itemsToShow = 2; // Số lượng sản phẩm hiển thị trên mỗi dòng

                let fsaleCurrentIndex = 0;
                let fsaleStartX = 0;
                let fsaleIsDragging = false;

                function fsaleSlideNext() {
                    fsaleList.style.transition = "transform 0.5s ease-in-out";
                    fsaleList.style.transform = `translateX(-${fsaleItemWidth * itemsToShow}px)`;

                    setTimeout(() => {
                        for (let i = 0; i < itemsToShow; i++) {
                            const firstItem = fsaleList.querySelector('.fsale-product:first-child');
                            fsaleList.appendChild(firstItem);
                        }

                        fsaleList.style.transition = "none";
                        fsaleList.style.transform = "translateX(0)";

                        fsaleCurrentIndex = (fsaleCurrentIndex + itemsToShow) % fsaleItems.length;
                    }, 450);
                }

                function fsaleSlidePrev() {
                    fsaleList.style.transition = "none";
                    fsaleList.style.transform = `translateX(-${fsaleItemWidth * itemsToShow}px)`;

                    for (let i = 0; i < itemsToShow; i++) {
                        const lastItem = fsaleList.querySelector('.fsale-product:last-child');
                        fsaleList.insertBefore(lastItem, fsaleList.firstChild);
                    }

                    setTimeout(() => {
                        fsaleList.style.transition = "transform 0.5s ease-in-out";
                        fsaleList.style.transform = "translateX(0)";
                    }, 50);
                }

                fsaleList.addEventListener('mousedown', (event) => {
                    fsaleStartX = event.pageX;
                    fsaleIsDragging = true;
                });

                fsaleList.addEventListener('mousemove', (event) => {
                    if (fsaleIsDragging) {
                        const diffX = event.pageX - fsaleStartX;
                        if (diffX > 50) {
                            fsaleSlidePrev();
                            fsaleIsDragging = false;
                        } else if (diffX < -50) {
                            fsaleSlideNext();
                            fsaleIsDragging = false;
                        }
                    }
                });

                fsaleList.addEventListener('mouseup', () => {
                    fsaleIsDragging = false;
                });

                fsaleList.addEventListener('mouseleave', () => {
                    fsaleIsDragging = false;
                });

                fsaleList.addEventListener('touchstart', (event) => {
                    fsaleStartX = event.touches[0].pageX;
                    fsaleIsDragging = true;
                });

                fsaleList.addEventListener('touchmove', (event) => {
                    if (fsaleIsDragging) {
                        const diffX = event.touches[0].pageX - fsaleStartX;
                        if (diffX > 50) {
                            fsaleSlidePrev();
                            fsaleIsDragging = false;
                        } else if (diffX < -50) {
                            fsaleSlideNext();
                            fsaleIsDragging = false;
                        }
                    }
                });

                fsaleList.addEventListener('touchend', () => {
                    fsaleIsDragging = false;
                });

                fsaleList.addEventListener('touchcancel', () => {
                    fsaleIsDragging = false;
                });
            }
        });
    }
</script>