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
                cartItemHTML += '<span class="size-color">Quy cách: ' + cartItem.size + ' - Đuôi ' + cartItem.color + '</span>';
                cartItemHTML += '</div>';
                cartItemHTML += '</div>';
                cartItemHTML += '<div class="price"><span>' + cartItem.price + '</span></div>';
                cartItemHTML += '<div class="quantity">';
                cartItemHTML += '<button class="quantity-btn decrease"><i class="fa-solid fa-minus"></i></button>';
                cartItemHTML += '<span class="quantity-value">' + cartItem.quantity + '</span>';
                cartItemHTML += '<button class="quantity-btn increase"><i class="fa-solid fa-plus"></i></button>';
                cartItemHTML += '</div>';
                cartItemHTML += '<div class="total"><span>' + cartItem.price + '</span></div>';
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
        provisionalElement.textContent = provisional;
    }
});
