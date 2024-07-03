<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">

    <link rel="stylesheet" href="css/test-show-detail2.css">
    <title>Checkout | IVANO</title>
</head>

<style>
    .container-img-cart-page {
        height: 650px;
        position: relative;
    }

    .container-img-cart-page img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .container-img-cart-page p {
        position: absolute;
        bottom: 30%;
        left: 10%;
        color: #FFF;
        font-size: 50px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .title-cart-page {
        text-transform: capitalize;
        text-align-last: left;
        position: absolute;
        left: 10%;
        bottom: 20%;
        color: #FFF;
        align-items: center;
        display: flex;
    }

    .title-cart-page i {
        margin: 0 15px;
        font-size: 10px;
        color: #81C8C2;
    }

    .title-cart-page a {
        position: relative;
        display: inline-block;
        color: #fff;
        text-decoration: none;
    }
</style>

<style>
    #main-checkout-page {
        padding: 0 5%;
        background: linear-gradient(to top right, #D7F8F8 0%, #FFFFFF 50%, #FFFFFF 70%, #FFC8B0 120%);
    }

    .container-cart-item-checkout {
        padding: 40px;
        width: 80%;
        margin: 0px auto;
        animation: slideInUp 0.5s ease;
        position: relative;
    }

    .container-discount {
        width: 50%;
        margin: 0px auto;
        display: flex;
        padding: 10px 0 20px 0;
        justify-content: space-between;
        position: relative;
    }

    .form-discount {
        width: 80%;
        position: relative;
    }

    .discount-text {
        height: 50px;
        width: 95%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .discount-text:focus {
        border-color: #55D5D2;
    }

    .form-discount label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .discount-text:focus+label,
    .discount-text:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #1E90FF;
        font-weight: 600;
    }

    .discount-text:focus+label {
        color: #221F20;
    }

    .discount-text:not(:placeholder-shown)+label {
        color: #333;
    }

    .discount-btn {
        height: 50px;
        width: 30%;
        padding: 10px 20px;
        background-color: #55D5D2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .discount-btn:hover {
        background-color: #F58F5D;
    }

    #discount-error,
    #discount-correct {
        position: absolute;
        bottom: -5px;
        font-size: 13px;
    }

    /* item trong cart */
    .container-cart-product {
        width: 95%;
        margin: 0 auto;
    }

    .cart-product-left,
    .cart-summary {
        padding: 5px;
        border: 1px solid #ccc;
        margin-top: 10px;
    }

    .cart-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        padding: 10px 10px;
        border-bottom: 1px solid #ccc;
    }

    .container-cart-item {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 20px;
    }

    .container-cart-item::-webkit-scrollbar {
        width: 5px;
    }

    .container-cart-item::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        border-radius: 10px;
    }

    .container-cart-item::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
    }

    .container-cart-item::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item-image {
        width: 13%;
        margin-right: 10px;
    }

    .product-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-info {
        display: flex;
    }

    .product-details {
        margin-bottom: 5px;
        display: flex;
        font-weight: 500;
        flex-direction: column;
    }

    .cart-item-name {
        font-weight: 700;
        color: #F58F5D;
    }

    .size-color {
        margin-top: 5px;
        font-size: 13px;
        font-weight: 500;
    }

    .quantity {
        display: flex;
        align-items: center;
    }

    .price {
        font-weight: 600;
        text-align: right;
        color: #1E90FF;
    }

    /*  */
    .cart-bottom-checkout {
        width: 50%;
        margin: 0px auto;
        margin-top: 30px;
        background-color: #F3F3F3;
        padding: 20px;
        border-radius: 20px;

    }

    .temporary-price,
    .transport-fee,
    .discount-price,
    .total-price {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .total-price {
        margin-bottom: 0;
        padding-top: 20px;
        border-top: 1px dashed #000;
    }

    .temporary-price p,
    .transport-fee p,
    .discount-price p,
    .total-price p {
        font-weight: 600;
    }

    .temporary-price span,
    .transport-fee span,
    .discount-price span,
    .total-price span {
        font-weight: 500;
        color: #55D5D2;
    }

    /*  */
    .show-form-btn {
        display: block;
        padding: 15px 50px;
        width: 50%;
        color: #FFF;
        margin: 30px auto;
        text-align: center;
        cursor: pointer;
        border: 0;
        background-color: #55D5D2;
        transition: all ease-in-out 0.3s;
        font-weight: 600;
    }

    .show-form-btn:hover {
        background-color: #F58F5D;
    }

    /* form info */

    .orders-form {
        width: 80%;
        margin: 0px auto;
        display: none;
        padding: 20px;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        margin-bottom: 20px;
        background-color: #FFF;
        border-radius: 10px;
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

    .orders-form h3 {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 10px;
        font-size: 25px;
    }

    .orders-form p {
        text-align: center;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .container-form-group {
        display: flex;
        justify-content: space-between;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .flex-form-group {
        width: 49% !important;
    }

    .form-group input {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #55D5D2;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #1E90FF;
        font-weight: 600;
    }

    .form-group input:focus+label {
        color: #221F20;
    }

    .form-group input:not(:placeholder-shown)+label {
        color: #333;
    }

    .orders-form textarea {
        resize: vertical;
        min-height: 100px;
        width: 100%;
        padding: 10px;
    }

    .payment {
        margin-bottom: 20px;
    }

    .payment h3 {
        display: block;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .container-check-pay {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .container-check-pay input[type="radio"] {
        margin-right: 10px;
    }

    .orders-btn {
        width: 100%;
        padding: 15px 20px;
        background-color: #55D5D2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .orders-btn:hover {
        background-color: #F58F5D;
    }

    .note-checkout {
        text-align: center;
        font-size: 13px;
    }
</style>

<!-- mobile css -->
<style>
    @media only screen and (max-width: 600px) {
        .container-img-cart-page {
            width: 100% !important;
            height: 400px !important;
        }

        .container-img-cart-page img {
            height: 100% !important;
            object-fit: cover;
        }

        .container-img-cart-page p {
            font-size: 30px !important;
        }

        .title-cart-page {
            font-size: 15px;
        }

        #main-checkout-page {
            padding: 0 !important;
        }

        .container-cart-item-checkout {
            padding: 10px !important;
            width: 100% !important;
            margin: 0px auto;
            animation: slideInUp 0.5s ease;
            position: relative;
        }

        .container-discount {
            width: 95% !important;
            margin-bottom: 20px !important;
        }

        .container-cart-product {
            width: 100% !important;
        }

        .cart-header {
            font-size: 13px;
        }

        .cart-item-name {
            font-size: 13px;
        }

        .size-color {
            font-size: 11px;
        }

        .price {
            width: 20% !important;
            font-size: 13px;
        }

        .cart-bottom-checkout {
            width: 80% !important;
            font-size: 15px;
        }

        .show-form-btn {
            width: 100% !important;
            font-size: 13px;
        }

        .orders-form {
            width: 100% !important;
            padding: 20px;
            margin-bottom: 20px;
        }

        .orders-form h3 {
            font-size: 20px;
        }

        .note-checkout {
            font-size: 10px !important;
            font-weight: 500;
        }

        .container-check-pay {
            font-size: 13px;
            font-weight: 500;
        }

        .orders-btn {
            font-size: 13px !important;
        }
    }
</style>

<body>
    <?php include "assets/header.php"; ?>

    <section class="container-img-cart-page">
        <img src="images/bg-banner-about-us.jpeg" alt="">
        <p>Giỏ hàng</p>

        <h3 class="title-cart-page">
            <a href="index.php">Trang chủ</a> <i class="fa-solid fa-circle"></i> <a class="second-link"
                href="cart-page.php">Giỏ Hàng</a> <i class="fa-solid fa-circle"></i> <a class="second-link"
                href="#">Thanh Toán</a>
        </h3>
    </section>

    <main id="main-checkout-page">
        <section class="container-cart-item-checkout">
            <div class="container-discount">
                <div class="form-discount   ">
                    <input type="text" id="discount-text" class="discount-text" name="discount" placeholder=" ">
                    <label>Mã giảm giá</label>
                </div>
                <button class="discount-btn">Kiểm Tra</button>
                <p id="discount-error" style="display:none; color:red;"></p>
                <p id="discount-correct" style="display:none; color:green;"></p>
            </div>

            <div class="container-cartItem">
                <div class="cart-header">
                    <div class="product-info"><span>Sản phẩm</span></div>
                    <div class="cart-header-price"><span>Thành tiền</span></div>
                </div>

                <div class="container-cart-item">
                    <!-- item show here -->
                </div>

                <div class="cart-bottom-checkout">
                    <div class="temporary-price">
                        <p>Tạm tính</p>
                        <span></span>
                    </div>

                    <div class="transport-fee">
                        <p>Phí vận chuyển</p>
                        <span>30.000 VND</span>
                    </div>

                    <div class="discount-price">
                        <p>Giảm</p>
                        <span>0 VNĐ</span>
                    </div>

                    <div class="total-price">
                        <p>Tổng tiền</p>
                        <span></span>
                    </div>
                </div>
            </div>

            <button class="show-form-btn" onclick="toggleUserInfoForm()">Điền thông tin nhận hàng</button>

            <form class="orders-form" method="post">
                <h3>Thông Tin Của Bạn</h3>
                <p>Vui lòng điền đầy đủ thông tin để tiến hành đặt hàng</p>

                <div class="form-group">
                    <input type="text" id="name-orders" name="name-orders" required placeholder=" ">
                    <label>Họ và tên</label>
                </div>
                <div class="container-form-group">
                    <div class="form-group flex-form-group">
                        <input type="tel" id="od_tel" name="od_tel" required placeholder=" ">
                        <label>Số điện thoại đặt hàng</label>
                    </div>

                    <div class="form-group flex-form-group">
                        <input type="tel" id="receiver_tell" name="receiver_tell" required placeholder=" ">
                        <label>Số điện thoại nhận hàng</label>
                    </div>
                </div>

                <div class="container-form-group">
                    <div class="form-group flex-form-group">
                        <input type="tel" id="street" name="street" required placeholder=" ">
                        <label>Số nhà/ tên đường</label>
                    </div>

                    <div class="form-group flex-form-group">
                        <input type="text" id="ward" name="ward" required placeholder=" ">
                        <label>Xã / phường</label>
                    </div>
                </div>

                <div class="container-form-group">
                    <div class="form-group flex-form-group">
                        <input type="text" id="district" name="district" required placeholder=" ">
                        <label>Quận / huyện</label>
                    </div>

                    <div class="form-group flex-form-group">
                        <input type="text" id="city" name="city" required placeholder=" ">
                        <label>Tỉnh / TP</label>
                    </div>
                </div>

                <div class="form-group">
                    <textarea id="note" name="note" placeholder="Lưu ý cho công ty"></textarea>
                </div>

                <div class="payment">
                    <h3>Phương thức thanh toán</h3>
                    <div class="container-check-pay">
                        <input type="radio" name="payment-method" id="payment-cod" value="cash_on_delivery" checked>
                        <label class="label-payment" for="payment-cod">Thanh toán khi nhận hàng</label>
                    </div>

                    <div class="container-check-pay">
                        <input type="radio" name="payment-method" id="payment-online" value="online_payment">
                        <label class="label-payment" for="payment-online">Thanh toán online (liên hệ)</label>
                    </div>
                </div>

                <div class="container-submit-orders">
                    <button type="submit" class="orders-btn">Đặt hàng</button>
                </div>
            </form>

            <p class="note-checkout">
                Chúng tôi kiến nghị khách hàng nên đặt cọc trước một phần trên tổng đơn hàng. <br>
                Điều này sẽ được thông tin đến bạn khi chúng tôi xác nhận đơn hàng này.
            </p>
        </section>
    </main>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.orders-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(form);
        var voucherCode = document.getElementById('discount-text').value;
        formData.append('voucher_code', voucherCode);  // Đảm bảo voucher_code được thêm vào

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action/orders-action.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đặt hàng thành công!',
                            text: 'Mã đơn hàng của bạn là: ' + response.od_id,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            localStorage.clear();
                            window.location.href = 'index.php';
                        });

                        form.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Đặt hàng thất bại!',
                            text: 'Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại sau.',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e, xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Đã xảy ra lỗi khi xử lý phản hồi từ máy chủ.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi khi kết nối đến server.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        };
        xhr.onerror = function () {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Đã xảy ra lỗi không xác định.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        };
        xhr.send(formData);
    });
});



</script>

<script>
    function toggleUserInfoForm() {
        var form = document.querySelector(".orders-form");
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        var cartProduct = document.querySelector('.container-cart-item');
        var temporaryPriceElement = document.querySelector('.temporary-price span');
        var transportFeeElement = document.querySelector('.transport-fee span');
        var discountPriceElement = document.querySelector('.discount-price span');
        var totalPriceElement = document.querySelector('.total-price span');
        var discountBtn = document.querySelector('.discount-btn');
        var ordersForm = document.querySelector('.orders-form');

        function currencyStringToNumber(currencyString) {
            return parseInt(currencyString.replace(/[^\d]/g, ''));
        }

        function formatCurrency(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
        }

        function calculateTemporaryPrice() {
            return cartItems.reduce(function (total, cartItem) {
                return total + currencyStringToNumber(cartItem.price);
            }, 0);
        }

        function calculateTotalPrice() {
            var temporaryPrice = currencyStringToNumber(temporaryPriceElement.textContent);
            var transportFee = currencyStringToNumber(transportFeeElement.textContent);
            var discountAmount = currencyStringToNumber(discountPriceElement.textContent);
            return temporaryPrice + transportFee - discountAmount;
        }

        function applyDiscountToCart(discountAmount) {
            var temporaryPrice = calculateTemporaryPrice();
            var totalPrice = temporaryPrice + currencyStringToNumber(transportFeeElement.textContent) - discountAmount;

            discountPriceElement.textContent = formatCurrency(discountAmount);
            totalPriceElement.textContent = formatCurrency(totalPrice);

            // Update od-total-price input value
            var totalPriceInput = document.querySelector('input[name="od-total-price"]');
            if (totalPriceInput) {
                totalPriceInput.value = formatCurrency(totalPrice);
            }
        }

        function updateCartItems() {
            if (cartProduct) {
                cartProduct.innerHTML = '';
                var hiddenInputValue = '';

                cartItems.forEach(function (cartItem, index) {
                    var totalPrice = currencyStringToNumber(cartItem.price);
                    var cartItemHTML = `
                    <div class="cart-item">
                        <img src="${cartItem.image}" alt="${cartItem.name}" class="cart-item-image">
                        <div class="product-info">
                            <div class="product-details">
                                <span class="cart-item-name">${cartItem.name}</span>
                                <span class="size-color">${cartItem.size} - Đuôi ${cartItem.color}</span>
                            </div>
                            <div class="quantity">x<span class="quantity-value">${cartItem.quantity}</span></div>
                        </div>
                        <div class="price"><span>${formatCurrency(totalPrice)}</span></div>
                    </div>
                `;

                    cartProduct.innerHTML += cartItemHTML;

                    var itemDetails = `${cartItem.name} - ${cartItem.size} - Đuôi ${cartItem.color} - x${cartItem.quantity}`;
                    hiddenInputValue += itemDetails;

                    if (index < cartItems.length - 1) {
                        hiddenInputValue += ' || ';
                    }
                });

                temporaryPriceElement.textContent = formatCurrency(calculateTemporaryPrice());
                var total = calculateTotalPrice();
                totalPriceElement.textContent = formatCurrency(total);

                // Update od-total-price input value
                var totalPriceInput = document.querySelector('input[name="od-total-price"]');
                if (totalPriceInput) {
                    totalPriceInput.value = formatCurrency(total);
                }

                var hiddenInputs = ordersForm.querySelectorAll('input[type="hidden"]');
                hiddenInputs.forEach(function (input) {
                    input.remove();
                });

                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'orders-info';
                hiddenInput.value = hiddenInputValue;
                ordersForm.appendChild(hiddenInput);

                var totalPriceInput = document.createElement('input');
                totalPriceInput.type = 'hidden';
                totalPriceInput.name = 'od-total-price';
                totalPriceInput.value = formatCurrency(total);
                ordersForm.appendChild(totalPriceInput);

                var paymentRadios = document.querySelectorAll('input[name="payment-method"]');
                var paymentMethodInput = document.createElement('input');
                paymentMethodInput.type = 'hidden';
                paymentMethodInput.name = 'payment-method';

                initializePaymentMethod();

                function createAndUpdateHiddenInput(value) {
                    paymentMethodInput.value = value;
                }

                function handlePaymentMethodChange() {
                    paymentRadios.forEach(function (radio) {
                        if (radio.checked) {
                            var paymentMethodLabel = radio.nextElementSibling.textContent.trim();
                            createAndUpdateHiddenInput(paymentMethodLabel);
                        }
                    });
                }

                paymentRadios.forEach(function (radio) {
                    radio.addEventListener('change', handlePaymentMethodChange);
                });

                function initializePaymentMethod() {
                    var defaultCheckedRadio = document.querySelector('input[name="payment-method"]:checked');
                    if (!defaultCheckedRadio) {
                        var firstRadio = document.querySelector('input[name="payment-method"]');
                        if (firstRadio) {
                            firstRadio.checked = true;
                            var defaultPaymentMethodLabel = firstRadio.nextElementSibling.textContent.trim();
                            createAndUpdateHiddenInput(defaultPaymentMethodLabel);
                        }
                    } else {
                        var defaultPaymentMethodLabel = defaultCheckedRadio.nextElementSibling.textContent.trim();
                        createAndUpdateHiddenInput(defaultPaymentMethodLabel);
                    }
                }

                ordersForm.appendChild(paymentMethodInput);
            }
        }

        discountBtn.addEventListener('click', function (event) {
        event.preventDefault();

        var voucherCodeInput = document.getElementById('discount-text');
        var voucherCode = voucherCodeInput.value;
        var totalOrderAmount = calculateTemporaryPrice();
        var errorMsg = document.getElementById('discount-error');
        var correctMsg = document.getElementById('discount-correct');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'kiem_tra_ma.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);

                    if (response.success) {
                        var discountAmount = response.discount_amount;
                        var discountPercentage = response.discount_percentage;
                        var temporaryPrice = calculateTemporaryPrice();

                        if (discountPercentage > 0) {
                            discountAmount = Math.max(discountAmount, (temporaryPrice * discountPercentage / 100));
                        }

                        console.log('Discount Amount:', discountAmount);

                        applyDiscountToCart(discountAmount);

                        // Set green border and show success message
                        if (voucherCodeInput) {
                            voucherCodeInput.style.border = '2px solid green';
                        }
                        if (correctMsg) {
                            correctMsg.textContent = "Đã áp dụng mã giảm giá";
                            correctMsg.style.display = 'block';
                        }
                    } else {
                        // Set red border and show error message
                        if (voucherCodeInput) {
                            voucherCodeInput.style.border = '2px solid red';
                        }
                        if (errorMsg) {
                            errorMsg.textContent = response.message;
                            errorMsg.style.display = 'block';
                        }
                    }
                } catch (e) {
                    console.error("Không thể phân tích dữ liệu JSON: ", e);
                    console.log(xhr.responseText);
                    // Handle JSON parse error
                    if (voucherCodeInput) {
                        voucherCodeInput.style.border = '2px solid red';
                    }
                    if (errorMsg) {
                        errorMsg.textContent = "Có lỗi xảy ra. Vui lòng thử lại.";
                        errorMsg.style.display = 'block';
                    }
                }
            } else {
                console.error("Lỗi kết nối đến máy chủ.");
                // Handle server error
                if (voucherCodeInput) {
                    voucherCodeInput.style.border = '2px solid red';
                }
                if (errorMsg) {
                    errorMsg.textContent = "Lỗi kết nối đến máy chủ.";
                    errorMsg.style.display = 'block';
                }
            }
        };
        var formData = 'voucher_code=' + encodeURIComponent(voucherCode) + '&total_order_amount=' + totalOrderAmount;
        xhr.send(formData);
    });

        updateCartItems();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</html>