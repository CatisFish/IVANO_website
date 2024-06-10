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
    <title>Giỏ Hàng</title>
</head>

<style>
    #main-cart-page {
        width: 90%;
        margin: 20px auto;
    }

    .title-cart-page {
        text-transform: uppercase;
        text-align-last: left;
    }

    .container-cart-product {
        display: flex;
        gap: 20px;
        margin-top: 30px;
        height: 530px;
    }

    .cart-product-left {
        width: 75%;
        max-height: 530px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .cart-product-left::-webkit-scrollbar {
        width: 5px;
    }

    .cart-product-left::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .cart-product-left::-webkit-scrollbar-thumb {
        background: #888;
    }

    .cart-product-left::-webkit-scrollbar-thumb:hover {
        background: #555;
        cursor: pointer;
    }

    .cart-header,
    .cart-item {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .cart-header div {
        font-weight: bold;
    }

    .cart-header .checkbox,
    .cart-item .checkbox {
        width: 5%;
        display: flex;
        justify-content: center;
    }

    .cart-header .product-info,
    .cart-item .product-info {
        width: 40%;
        display: flex;
        align-items: center;
    }

    .cart-header .product-info span,
    .cart-item .product-info img {
        margin-right: 10px;
    }

    .name {
        font-weight: 700;
        color: #dd9933;
        margin-bottom: 10px;
    }

    .size-color {
        font-size: 13px;
        font-weight: 600;
        margin-top: 10px;
    }

    .cart-item .price {
        color: #1E90FF;
        font-weight: 600;
    }

    .cart-header .price,
    .cart-item .price,
    .cart-header .quantity,
    .cart-header .total,
    .cart-item .total {
        text-align: left;
        padding: 10px 20px;
    }

    .cart-header .price,
    .cart-item .price {
        width: 25%;
        text-align: center;
    }

    .cart-header .quantity,
    .cart-item .quantity {
        width: 10%;
    }

    .cart-header .total,
    .cart-item .total {
        width: 25%;
        text-align: center;
    }

    .cart-item img {
        width: 100px;
        height: auto;
    }

    .cart-header .quantity {
        text-align: center;
    }

    .cart-item .quantity {
        display: flex;
        border-radius: 25px;
        justify-content: space-around;
        background-color: #FFF;
        align-items: center;
        font-weight: 600;
        border: 1px solid #55D5D2;
        padding: 10px 0;
    }

    .quantity-btn {
        background: none;
        border: none;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        color: #55D5D2;
    }

    .container-btn-order-cart {
        display: flex;
        margin-top: 30px;
        gap: 30px;
    }

    .delete-product,
    .return-buy {
        padding: 10px 30px;
        font-weight: 600;
        border-radius: 20px;
        border: none;
        background: none;
        cursor: pointer;
    }

    .delete-product {
        background-color: #d9d9d9;
        color: #eee;
        cursor: no-drop;
    }

    .return-buy {
        background-color: #55D5D2;
        transition: all ease-in-out 0.3s;
    }

    .return-buy a {
        color: #FFF;
    }
    .return-buy:hover{
        background-color: #f58f5d;
    }

.return-buy a i {
    display: inline-block;
    transform: rotate(0deg); 
    transition: transform 0.3s ease;
    margin-right: 10px;
}

.return-buy:hover a i {
    transform: rotate(360deg);
}

</style>

<style>
    .cart-product-right {
        width: 25%;
        padding: 50px 30px;
        background-color: #f3f3f3;
        height: auto;
    }

    .title-cart-order {
        text-align: center;
        margin-bottom: 20px;
    }

    .cart-product-order {
        width: 90%;
        margin: 0px auto;
    }

    .total-product,
    .provisional {
        padding: 20px 0px;
        display: flex;
        border-bottom: 1px dashed #333;
        justify-content: space-between;
    }

    .container-checkout-btn {
        margin: 40px 0;
        text-align: center;
        cursor: pointer;
    }

    .checkout {
        padding: 10px 30px;
        background-color: #55D5D2;
        border: none;
        border-radius: 20px;
        transition: all ease-in-out 0.3s;
    }

    .checkout a {
        color: #fff;
        font-weight: 600;
    }

    .checkout:hover {
        background-color: #f58f5d;
    }

    .checkout i {
    display: inline-block;
    transform: rotate(0deg); 
    transition: transform 0.3s ease;
    margin-left: 10px;
}

.checkout:hover a i {
    transform: rotate(360deg);
}
</style>

<body>
    <?php include "assets/header.php"; ?>
    <main id="main-cart-page">
        <section class="container-img-cart-page">
            <img src="" alt="">
            <p></p>
        </section>

        <section class="cart-page">
            <h3 class="title-cart-pagge">Sản Phẩm</h3>

            <div class="container-cart-product">
                <div class="cart-product-left">
                    <div class="cart-header">
                        <div class="checkbox"><input type="checkbox" id="select-all"></div>
                        <div class="product-info"><span>Thông tin sản phẩm</span></div>
                        <div class="price"><span>Giá</span></div>
                        <div class="quantity"><span>SL</span></div>
                        <div class="total"><span>Tổng tiền</span></div>
                    </div>

                    <div class="container-cart-item">
                        <!-- Cart items will be inserted here -->
                    </div>
                </div>

                <div class="cart-product-right">
                    <h3 class="title-cart-order">Tóm Tắt Đơn Hàng</h3>

                    <div class="cart-product-order">
                        <div class="total-product">
                            <h4>Sản phẩm</h4>
                            <span></span>
                        </div>
                        <div class="provisional">
                            <h4>Tạm tính</h4>
                            <span></span>
                        </div>

                        <div class="container-checkout-btn">
                            <button class="checkout">
                                <a href="checkout.php">Thanh toán <i class="fa-solid fa-arrow-right"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-btn-order-cart">
                <button class="delete-product">Xoá Sản phẩm đã chọn</button>
                <button class="return-buy"><a href="all-item.php"><i class="fa-solid fa-arrow-left"></i> Tiếp tục mua hàng</a></button>
            </div>
        </section>
    </main>

    <?php include "assets/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cartItems = [];
            var cartProductLeft = document.querySelector('.container-cart-item');
            var selectAllCheckbox = document.getElementById('select-all');
            var totalProductElement = document.querySelector('.total-product span');
            var provisionalElement = document.querySelector('.provisional span');

            if (localStorage.getItem('cartItems')) {
                cartItems = JSON.parse(localStorage.getItem('cartItems'));

                updateCartItems();
                updateSummary();
            }

            function updateCartItems() {
                if (cartProductLeft) {
                    cartProductLeft.innerHTML = ''; // Xóa bỏ nội dung hiện có trong container

                    cartItems.forEach(function (cartItem, index) {
                        var totalPrice = parseFloat(cartItem.price) * cartItem.quantity;

                        var cartItemHTML = '<div class="cart-item">';
                        cartItemHTML += '<div class="checkbox"><input type="checkbox" class="item-checkbox" data-index="' + index + '"></div>';
                        cartItemHTML += '<div class="product-info">';
                        cartItemHTML += '<img src="' + cartItem.image + '" alt="' + cartItem.name + '">';
                        cartItemHTML += '<div class="product-details">';
                        cartItemHTML += '<span class="name">' + cartItem.name + '</span> <br>';
                        cartItemHTML += '<span class="size-color">Quy cách ' + cartItem.size + ' - Đuôi ' + cartItem.color + '</span>';
                        cartItemHTML += '</div>';
                        cartItemHTML += '</div>';
                        cartItemHTML += '<div class="price"><span>' + cartItem.price + '</span></div>';
                        cartItemHTML += '<div class="quantity">';
                        cartItemHTML += '<button class="quantity-btn decrease"><i class="fa-solid fa-minus"></i></button>';
                        cartItemHTML += '<span class="quantity-value">' + cartItem.quantity + '</span>';
                        cartItemHTML += '<button class="quantity-btn increase"><i class="fa-solid fa-plus"></i></button>';
                        cartItemHTML += '</div>';

                        cartItemHTML += '<div class="total"><span>' + totalPrice.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></div>';
                        cartItemHTML += '</div>';

                        cartProductLeft.innerHTML += cartItemHTML;
                    });

                    var itemCheckboxes = document.querySelectorAll('.item-checkbox');

                    selectAllCheckbox.addEventListener('change', function () {
                        var isChecked = this.checked;
                        itemCheckboxes.forEach(function (checkbox) {
                            checkbox.checked = isChecked;
                        });
                    });
                }
            }

            function updateSummary() {
                var totalProducts = cartItems.length;
                var provisional = cartItems.reduce(function (total
                    , item) {
                    return total + (parseFloat(item.price) * item.quantity);
                }, 0);

                totalProductElement.textContent = totalProducts;
                provisionalElement.textContent = provisional.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        });

    </script>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var cartItems = [];
    var cartProductLeft = document.querySelector('.container-cart-item');
    var selectAllCheckbox = document.getElementById('select-all');
    var totalProductElement = document.querySelector('.total-product span');
    var provisionalElement = document.querySelector('.provisional span');
    var deleteProductButton = document.querySelector('.delete-product');

    if (localStorage.getItem('cartItems')) {
        cartItems = JSON.parse(localStorage.getItem('cartItems'));
        updateCartItems();
        updateSummary();
    }

    function updateCartItems() {
        if (cartProductLeft) {
            cartProductLeft.innerHTML = '';

            cartItems.forEach(function (cartItem, index) {
                var totalPrice = parseFloat(cartItem.price) * cartItem.quantity;

                var cartItemHTML = '<div class="cart-item">';
                cartItemHTML += '<div class="checkbox"><input type="checkbox" class="item-checkbox" data-index="' + index + '"></div>';
                cartItemHTML += '<div class="product-info">';
                cartItemHTML += '<img src="' + cartItem.image + '" alt="' + cartItem.name + '">';
                cartItemHTML += '<div class="product-details">';
                cartItemHTML += '<span class="name">' + cartItem.name + '</span> <br>';
                cartItemHTML += '<span class="size-color">Quy cách ' + cartItem.size + ' - Đuôi ' + cartItem.color + '</span>';
                cartItemHTML += '</div>';
                cartItemHTML += '</div>';
                cartItemHTML += '<div class="price"><span>' + cartItem.price + '</span></div>';
                cartItemHTML += '<div class="quantity">';
                cartItemHTML += '<button class="quantity-btn decrease"><i class="fa-solid fa-minus"></i></button>';
                cartItemHTML += '<span class="quantity-value">' + cartItem.quantity + '</span>';
                cartItemHTML += '<button class="quantity-btn increase"><i class="fa-solid fa-plus"></i></button>';
                cartItemHTML += '</div>';
                cartItemHTML += '<div class="total"><span>' + totalPrice.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></div>';
                cartItemHTML += '</div>';

                cartProductLeft.innerHTML += cartItemHTML;
            });

            var itemCheckboxes = document.querySelectorAll('.item-checkbox');

            itemCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateDeleteProductButtonState();
                });
            });

            selectAllCheckbox.addEventListener('change', function () {
                var isChecked = this.checked;
                itemCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
                updateDeleteProductButtonState();
            });
            selectAllCheckbox.checked = false;
        }
    }

    function updateDeleteProductButtonState() {
        var checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        if (checkedCheckboxes.length > 0) {
            deleteProductButton.style.cursor = 'pointer';
            deleteProductButton.style.color = '#221F20';
            deleteProductButton.style.backgroundColor = '#FFF';
            deleteProductButton.style.border = '1px solid #d9d9d9';
        } else {
            deleteProductButton.style.cursor = 'no-drop';
            deleteProductButton.style.color = '#eee';
            deleteProductButton.style.backgroundColor = '#d9d9d9';
            deleteProductButton.style.border = 'd9d9d9';
        }
    }

    deleteProductButton.addEventListener('click', function () {
        var checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
        if (checkedCheckboxes.length > 0) {
            var checkedIndexes = Array.from(checkedCheckboxes).map(function (checkbox) {
                return parseInt(checkbox.dataset.index);
            });
            cartItems = cartItems.filter(function (item, index) {
                return !checkedIndexes.includes(index);
            });

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartItems();
            updateSummary();
            updateDeleteProductButtonState();
        }
    });

    function updateSummary() {
        var totalProducts = cartItems.length;
        var provisional = cartItems.reduce(function (total, item) {
            return total + (parseFloat(item.price) * item.quantity);
        }, 0);

        totalProductElement.textContent = totalProducts;
        provisionalElement.textContent = provisional.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
});

</script>

</html>