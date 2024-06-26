<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">
    <link rel="stylesheet" href="css/checkout.css">

    <title>Checkout | IVANO</title>
</head>

<body>
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

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'action/orders-action.php', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Đặt hàng thành công!',
                            text: 'Mã đơn hàng của bạn là: ' + response.od_id,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            // Xoá local storage (nếu có)
                            localStorage.clear();

                            // Chuyển người dùng về trang index.php
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
            var errorMsg = document.getElementById('discount-error');
            var correctMsg = document.getElementById('discount-correct');

            // Clear previous styles and messages
            if (voucherCodeInput) {
                voucherCodeInput.style.border = '';
            }
            if (errorMsg) {
                errorMsg.style.display = 'none';
                errorMsg.textContent = '';
            }
            if (correctMsg) {
                correctMsg.style.display = 'none';
                correctMsg.textContent = '';
            }

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
            var formData = 'voucher_code=' + encodeURIComponent(voucherCode);
            xhr.send(formData);
        });

        updateCartItems();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</html>