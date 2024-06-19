<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include 'php/conection.php';

$flashSaleSql = "
    SELECT f.*, p.product_name, b.brand_name, ps.price, i.path_image, t.start_time, t.end_time
    FROM time_flashsale t
    INNER JOIN flashsale f ON t.flashsale_id = f.flashsale_id
    INNER JOIN products p ON f.product_id = p.product_id
    INNER JOIN brands b ON p.brand_id = b.brand_id
    INNER JOIN product_size ps ON p.product_id = ps.product_id
    LEFT JOIN product_images i ON p.product_id = i.product_id
    GROUP BY p.product_id, ps.size_id";

$flashSaleResult = $conn->query($flashSaleSql);

$conn->close();
?>

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
            echo '<img class="fsale-product-img" src="uploads/' . $row['path_image'] . '" alt="Product Image">';
        } else {
            echo 'No Image';
        }
        echo '</div>';
        echo '<div class="container-fsale-price">';
        echo '<p class="original-price">' . number_format($originalPrice) . 'đ</p>';
        echo '<p class="fsale-price-new">' . number_format($discountedPrice) . 'đ</p>';
        echo '</div>';
        echo '<p id="time-' . $row['product_id'] . '" data-end-time="' . $endTimeStr . '" class="time-fsale"></p>';
        echo '<div class="action-fsale">';
        echo '<button class="show-detail-fsale" onclick="showDetails(' . htmlspecialchars(json_encode($row)) . ')">Xem Chi Tiết</button>';
        echo '<button class="add-to-cart-fsale" onclick="addToCart(' . $row['product_id'] . ')"><i class="fa-solid fa-basket-shopping add-to-cart-icon"></i></button>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

    echo '<div class="product-detail-fsale" id="product-detail-fsale">';
    echo '<h3>Chi tiết sản phẩm</h3>';
    echo '<div id="detail-fsale-content" class="product-info-fsale"></div>';
    echo '<button class="close-btn-detail-fsale" onclick="closeDetails()"><i class="fa-solid fa-xmark"></i></button>';
    echo '</div>';

    echo '</div>';
} else {
    echo '<p>Không có sản phẩm trong Flash Sale.</p>';
}
?>









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

    .container-fsale-price {
        display: flex;
        justify-content: space-around;
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

    .time-fsale {
        font-size: 12px;
        text-align: left;
        font-weight: 600;
    }

    .action-fsale {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .show-detail-fsale {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        background-color: #55D5D2;
        color: #FFF;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
        border-radius: 10px;
    }

    .show-detail-fsale:hover {
        background-color: #F58F5D;
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

<style>
    .product-detail-fsale {
        transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        opacity: 0;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        z-index: 101;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 600px;
        height: 450px;
        visibility: hidden;
    }

    .product-detail-fsale h3 {
        margin-top: 0;
        text-transform: capitalize;
    }

    .product-detail-fsale img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;

    }

    .close-btn-detail-fsale {
        background-color: #55D5D2;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
        transition: all ease-in-out 0.3s;
    }

    .close-btn-detail-fsale:hover {
        background-color: #F58F5D;
    }

    .container-detail-fsale {
        display: flex;
        margin: 20px;
        align-items: center;
    }

    .imgfs {
        width: 450px;
        align-items: center;
    }

    .name-fsale {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 25px;
        color: #F58F5D;
    }

    .container-price-fsale {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-top: 15px;
    }

    .original-price {
        text-decoration: line-through;
        color: gray;
    }

    .price-new-fsale {
        font-size: 20px;
        color: #1E90FF;
        font-weight: 700;
    }

    .end-time {
        margin-top: 15px;
    }

    .end-time span {
        font-weight: 600;
        color: #f44336;
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

    function showDetails(product) {
        const overlayFsale = document.getElementById('overlay-fsale');
        const detailsContainer = document.getElementById('product-detail-fsale');
        const detailsContent = document.getElementById('detail-fsale-content');
        const endTime = new Date(product.end_time);
        const endTimeStr = endTime.toLocaleString();
        const originalPrice = product.price;
        const discount = product.discount;
        const discountedPrice = originalPrice - (originalPrice * discount / 100);

        detailsContent.innerHTML = `
            <div class="container-detail-fsale">
                <div class="imgfs">
                    <img class="imgfs" src="uploads/${product.path_image}" alt="Product Image" style="max-width: 100%;">
                </div>

                <div class="container-right-detail-fsale">
                    <p class="name-fsale">${product.product_name}</p>
                    <p class="brand-fsale">Thương hiệu: ${product.brand_name}</p>

                    <div class="container-price-fsale">
                        <p><span class="original-price">${originalPrice.toLocaleString()}đ</span></p>
                        <p class="price-new-fsale">${discountedPrice.toLocaleString()}đ</p>
                    </div>
                    <p class="end-time">Kết thúc sales: <span>${endTimeStr}</span></p>
                </div>

                <div class="overlay"></div>
            </div>
        `;

        detailsContainer.style.transform = 'translate(-50%, -50%)';
        detailsContainer.style.opacity = '1';
        overlayFsale.style.display = 'block';
        detailsContainer.style.visibility = 'visible';
    }

    function closeDetails() {
        const overlayFsaleClose = document.getElementById('overlay-fsale');

        overlayFsaleClose.style.display = 'none';

        document.getElementById('product-detail-fsale').style.opacity = '0';
        document.getElementById('product-detail-fsale').style.transform = 'translate(-50%, 50%)';
    }
</script>

