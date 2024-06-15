document.addEventListener('DOMContentLoaded', function () {
    var cartItems = [];
    var cartItemsContainer = document.getElementById('cart-items');
    var totalCartPrice = document.querySelector('.cart-total span');
    var cartLength = document.getElementById('lenght-cart');

    if (localStorage.getItem('cartItems')) {
        cartItems = JSON.parse(localStorage.getItem('cartItems'));
        updateCartLength();
        updateCartItems();
        calculateTotalPrice();
    } else {
        cartLength.textContent = '0';
        totalCartPrice.textContent = '0 VNĐ';
    }

    function checkCartEmpty() {
        if (cartItems.length === 0) {
            if (cartItemsContainer) {
                cartItemsContainer.innerHTML = '<p class="title-none-cart">Giỏ hàng trống !!!</p>';
            }
        }
    }

    function parseFormattedPrice(price) {
        return parseFloat(price.replace(/\./g, '').replace(' VNĐ', '').replace(',', '.'));
    }

    function formatPrice(price) {
        return price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' VNĐ';
    }

    function calculateTotalPrice() {
        var totalPrice = 0;
        cartItems.forEach(function (cartItem) {
            totalPrice += parseFormattedPrice(cartItem.price);
        });
        totalCartPrice.textContent = formatPrice(totalPrice); 
        return totalPrice;
    }

    function calculateTotalQuantity() {
        var totalQuantity = 0;
        cartItems.forEach(function (cartItem) {
            totalQuantity += cartItem.quantity;
        });
        return totalQuantity;
    }

    function updateCartLength() {
        var totalQuantity = calculateTotalQuantity();
        cartLength.textContent = totalQuantity;
    }

    checkCartEmpty();

    var addToCartBtn = document.querySelector('.add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function () {
            var productName = document.querySelector('.product-name').textContent;
            var productPrice = document.querySelector('.product-price').textContent;
            var productImage = document.querySelector('.detail-product-img').getAttribute('src');
            var productQuantity = parseInt(document.querySelector('.product-quantity input').value);
            var selectedSizeElement = document.getElementById('size-select');
            var selectedSize = selectedSizeElement.selectedOptions[0].textContent;
            var selectedColor = document.getElementById('color-select').value;

            if (!selectedSize || !selectedColor) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn kích thước và màu sắc trước khi thêm vào giỏ hàng!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            var basePrice = parseFormattedPrice(productPrice);
            var itemPrice = basePrice / productQuantity; // Giá của mỗi sản phẩm

            var existingItemIndex = cartItems.findIndex(function (item) {
                return item.name === productName && item.size === selectedSize && item.color === selectedColor;
            });

            if (existingItemIndex !== -1) {
                cartItems[existingItemIndex].quantity += productQuantity;
                cartItems[existingItemIndex].price = formatPrice(itemPrice * cartItems[existingItemIndex].quantity);
            } else {
                var item = {
                    name: productName,
                    price: formatPrice(basePrice),
                    image: productImage,
                    quantity: productQuantity,
                    size: selectedSize,
                    color: selectedColor
                };
                cartItems.push(item);
            }

            updateCartLength();

            calculateTotalPrice();

            localStorage.setItem('cartItems', JSON.stringify(cartItems));

            updateCartItems();

            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: 'Sản phẩm đã được thêm vào giỏ hàng!',
                confirmButtonText: 'OK'
            });
        });
    }

    function updateCartItems() {
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

            var deleteButtons = document.querySelectorAll('.delete-cart-item');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    var index = event.currentTarget.getAttribute('data-index');
                    Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn có chắc chắn muốn xoá sản phẩm này khỏi giỏ hàng?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy'
                    }).then((result)=> {
                        if (result.isConfirmed) {
                            cartItems.splice(index, 1);
                            updateCartLength();
                            calculateTotalPrice();
                            updateCartItems();
                            checkCartEmpty();
                            localStorage.setItem('cartItems', JSON.stringify(cartItems));
                        }
                    });
                });
            });
        }
    }

    var clearCartBtn = document.querySelector('.clear-cart-btn');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function () {
            if (cartItems.length > 0) {
                Swal.fire({
                    title: 'Xác nhận',
                    text: 'Bạn có chắc chắn muốn xóa tất cả sản phẩm khỏi giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cartItems = [];
                        updateCartLength();
                        totalCartPrice.textContent = '0';
                        checkCartEmpty();
                        updateCartItems();
                        calculateTotalPrice();

                        localStorage.removeItem('cartItems');
                        checkCartEmpty();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Giỏ hàng đã trống',
                    text: 'Không có sản phẩm nào trong giỏ hàng để xóa.',
                    confirmButtonText: 'OK'
                });

                localStorage.removeItem('cartItems');
                totalCartPrice.textContent = '0 VNĐ';
            }
        });
    }
});
