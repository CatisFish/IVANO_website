<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">

    <title>Checkout | IVANO</title>
</head>

<body>
    <main id="main-checkout-page">
        <section class="checkout-page-left">
            <form action="action/orders-action.php" class="orders-form" method="post">
                <h3>Thông Tin Của Bạn</h3>
                <p>Vui lòng điền đầy đủ thông tin để tiến hành đặt hàng</p>

                <div class="form-group">
                    <input type="text" id="name-orders" name="name-orders" required placeholder=" ">
                    <label>Họ và tên</label>
                </div>
                <div class="form-group">
                    <input type="tel" id="od_tel" name="od_tel" required placeholder=" ">
                    <label>Số điện thoại đặt hàng</label>
                </div>

                <div class="form-group">
                    <input type="tel" id="receiver_tell" name="receiver_tell" required placeholder=" ">
                    <label>Số điện thoại nhận hàng</label>
                </div>

                <div class="form-group">
                    <input type="tel" id="street" name="street" required placeholder=" ">
                    <label>Số nhà/ tên đường</label>
                </div>

                <div class="form-group">
                    <input type="text" id="ward" name="ward" required placeholder=" ">
                    <label>Xã / phường</label>
                </div>

                <div class="form-group">
                    <input type="text" id="district" name="district" required placeholder=" ">
                    <label>Quận / huyện</label>
                </div>

                <div class="form-group">
                    <input type="text" id="city" name="city" required placeholder=" ">
                    <label>Tỉnh / TP</label>
                </div>
                <div class="form-group">
                    <textarea id="note" name="note" placeholder="Lưu ý cho công ty"></textarea>
                </div>

                <div class="payment">
                    <label>Phương thức thanh toán</label>
                    <div class="container-check-pay">
                        <input type="radio" name="payment-method" checked>
                        <p>Thanh toán khi nhận hàng</p>
                    </div>

                    <div class="container-check-pay">
                        <input type="radio" name="payment-method">
                        <p>Thanh toán online (liên hệ)</p>
                    </div>
                </div>

                <div class="container-submit-orders">
                    <button type="submit" class="orders-btn">Đặt hàng</button>
                </div>
            </form>

            <p class="note-checkout">Chúng tôi kiến nghị khách hàng nên đặt cọc trước một phần trên tổng đơn hàng. <br>
                Điều này sẽ được thông tin đến bạn khi chúng tôi xác nhận đơn hàng này.</p>
        </section>

        <section class="checkout-page-right">
            <div class="container-discount">
                <div class="form-discount">
                    <input type="text" id="discount-text" class="discount-text" name="discount" placeholder=" ">
                    <label>Mã giảm giá</label>
                </div>
                <button class="discount-btn">Kiểm Tra</button>
            </div>

            <div class="container-cartItem">
                <div class="cart-header">
                    <div class="product-info"><span>Sản phẩm</span></div>
                    <div class="cart-header-price"><span>Thành tiền</span></div>
                </div>

                <div class="container-cart-item">
                    <!-- item show here -->
                </div>

                <div class="cart-bottom">
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
        </section>
    </main>

    <?php include "assets/footer.php"; ?>
</body>

<!-- ok -->
<style>
    #main-checkout-page {
        display: flex;
        width: 90%;
        margin: 50px auto;
    }

    .checkout-page-left {
        width: 40%;
    }

    .note-checkout {
        width: 95%;
        margin: 0 auto;
        font-size: 12px;
        font-weight: 500;
    }

    .orders-form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        max-width: 520px;
        width: 100%;
        animation: slideInUp 0.5s ease;
        position: relative;
    }

    .orders-form h3 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .orders-form p {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
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

    .payment {
        margin-bottom: 20px;
    }

    .payment label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .container-check-pay {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .container-check-pay input[type="radio"] {
        margin-right: 10px;
    }

    .container-check-pay p {
        margin: 0;
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

    .orders-btn:hover,
    .discount-btn:hover {
        background-color: #F58F5D;
    }
</style>
<!-- ok -->
<style>
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
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item-image {
        width: 15%;
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
</style>

<style>
    .checkout-page-right {
        background-color: #ffffff;
        padding: 40px;
        border-left: 1px solid #000;
        width: 60%;
        animation: slideInUp 0.5s ease;
        position: relative;
    }

    .container-discount {
        width: 100%;
        display: flex;
        padding: 10px;
        justify-content: space-between;
    }

    .form-discount {
        width: 80%;
        position: relative;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .discount-text {
        height: 50px;
        width: 100%;
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
        align-self: center;
        padding: 10px 30px;
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

    .container-cartItem {
        margin-top: 20px;
    }

    .container-cart-item {
        overflow-y: auto;
        max-height: 500px;
    }

    .container-cart-item::-webkit-scrollbar {
        display: none;
    }
</style>

<style>
    .cart-bottom {
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

    .orders-form textarea {
        resize: vertical;
        min-height: 100px;
        width: 100%;
        padding: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        var cartProduct = document.querySelector('.container-cart-item');
        var temporaryPriceElement = document.querySelector('.temporary-price span');
        var transportFeeElement = document.querySelector('.transport-fee span');
        var discountPriceElement = document.querySelector('.discount-price span');
        var totalPriceElement = document.querySelector('.total-price span');

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

        function updateCartItems() {
            if (cartProduct) {
                cartProduct.innerHTML = '';
                var hiddenInputValue = ''; // Initialize hiddenInputValue

                cartItems.forEach(function (cartItem, index) {
                    var totalPrice = currencyStringToNumber(cartItem.price);
                    var unitPrice = totalPrice / cartItem.quantity;

                    var cartItemHTML = `
                    <div class="cart-item">
                        <img src="${cartItem.image}" alt="${cartItem.name}" class="cart-item-image">
                        <div class="product-info">
                            <div class="product-details">
                                <span class="cart-item-name">${cartItem.name}</span>
                                <span class="size-color">Quy cách: ${cartItem.size} - Đuôi ${cartItem.color}</span>
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

                var temporaryPrice = calculateTemporaryPrice();
                temporaryPriceElement.textContent = formatCurrency(temporaryPrice);

                var totalPrice = calculateTotalPrice();
                totalPriceElement.textContent = formatCurrency(totalPrice);

                // Create hidden input for order information
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'orders-info';
                hiddenInput.value = hiddenInputValue;
                document.querySelector('form').appendChild(hiddenInput);

                var totalPriceInput = document.createElement('input');
                totalPriceInput.type = 'hidden';
                totalPriceInput.name = 'od-total-price';
                totalPriceInput.value = formatCurrency(calculateTotalPrice());
                document.querySelector('form').appendChild(totalPriceInput);
            }
        }

        updateCartItems();
    });

</script>

</html>