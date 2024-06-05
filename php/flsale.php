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

$productSql = "
            SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
            FROM products p 
            LEFT JOIN product_images i ON p.product_id = i.product_id
            INNER JOIN categories c ON p.category_id = c.category_id
            INNER JOIN brands b ON p.brand_id = b.brand_id
            INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
            INNER JOIN product_size ps ON p.product_id = ps.product_id
            INNER JOIN sizes s ON ps.size_id = s.size_id
            GROUP BY p.product_id";

$productResult = $conn->query($productSql);

// Kiểm tra xem có dữ liệu được trả về không
$products = array();
if ($productResult->num_rows > 0) {
    while ($row = $productResult->fetch_assoc()) {
        $products[] = $row;
    }
}

// Lấy danh sách các danh mục, thương hiệu, loại sản phẩm và kích thước
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
$categories = array();
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}

$sql_brands = "SELECT * FROM brands";
$result_brands = $conn->query($sql_brands);
$brands = array();
if ($result_brands->num_rows > 0) {
    while ($row = $result_brands->fetch_assoc()) {
        $brands[] = $row;
    }
}

$sql_productcategories = "SELECT * FROM productcategory";
$result_productcategories = $conn->query($sql_productcategories);
$productcategories = array();
if ($result_productcategories->num_rows > 0) {
    while ($row = $result_productcategories->fetch_assoc()) {
        $productcategories[] = $row;
    }
}

$sql_sizes = "SELECT * FROM sizes";
$result_sizes = $conn->query($sql_sizes);
$sizes = array();
if ($result_sizes->num_rows > 0) {
    while ($row = $result_sizes->fetch_assoc()) {
        $sizes[] = $row;
    }
}

$conn->close();
?>


<h2 class="title-fsale">Flash Sale</h2>

<div class="container-fsale">
    <div class="container-item-fsale">
        <?php
        $flashSaleResult->data_seek(0);
        while ($row = $flashSaleResult->fetch_assoc()) {
            $endTime = new DateTime($row['end_time']);
            $endTimeStr = $endTime->format('Y-m-d H:i:s');
            $originalPrice = $row['price'];
            $discount = $row['discount'];
            $discountedPrice = $originalPrice - ($originalPrice * $discount / 100);
            ?>
<<<<<<< HEAD
            <div class="product" id="product-<?php echo $row['product_id']; ?>">
                <p>Giảm <?php echo $discount; ?>%</p>
                <div>
=======

            <div class="fsale-product">
                <p class="fsale-percent">- <?php echo $discount; ?>%</p>
                <div class="container-img-fsale">
>>>>>>> 8fdbe7c37e544106448e305aabeef04f64ae7bdb
                    <?php if (!empty($row['path_image'])): ?>
                        <img class="fsale-product-img" src="uploads/<?php echo $row['path_image']; ?>" alt="Product Image">
                    <?php else: ?>
                        No Image
                    <?php endif; ?>
                </div>
<<<<<<< HEAD
                <p class="original-price"><?php echo number_format($originalPrice); ?>đ</p>
                <p><?php echo number_format($discountedPrice); ?>đ</p>
                <p id="time-<?php echo $row['product_id']; ?>" data-end-time="<?php echo $endTimeStr; ?>" data-product-id="<?php echo $row['product_id']; ?>"></p>
                <button onclick="showDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">Chi tiết</button>
                <button onclick="addToCart(<?php echo $row['product_id']; ?>)">Thêm vào giỏ hàng</button>
=======
                <div class="container-fsale-price">
                    <p class="original-price"><?php echo number_format($originalPrice); ?>đ</p>
                    <p class="fsale-price-new"><?php echo number_format($discountedPrice); ?>đ</p>
                </div>
                <p id="time-<?php echo $row['product_id']; ?>" data-end-time="<?php echo $endTimeStr; ?>"
                    class="time-fsale">
                </p>
                <div class="action-fsale">
                    <button class="show-detail-fsale"
                        onclick="showDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">Xem Chi Tiết</button>
                    <button class="add-to-cart-fsale" onclick="addToCart(<?php echo $row['product_id']; ?>)"><i
                            class="fa-solid fa-basket-shopping add-to-cart-icon"></i></button>
                </div>
>>>>>>> 8fdbe7c37e544106448e305aabeef04f64ae7bdb
            </div>
        <?php } ?>

    </div>

    <button class="prev-item-fsale"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="next-item-fsale"><i class="fa-solid fa-chevron-right"></i></button>

    <div class="productfs-details" id="product-details" style="display: none;">
        <h3>Chi tiết sản phẩm</h3>
        <div id="details-content" class="product-info"></div>
        <button class="close-btn" onclick="closeDetails()"><i class="fa-solid fa-xmark"></i></button>
    </div>
</div>



<script>
<<<<<<< HEAD
   function updateTime() {
    const timeElements = document.querySelectorAll('[id^="time-"]');
    timeElements.forEach(function(element) {
        const endTimeStr = element.getAttribute('data-end-time');
        const productId = element.getAttribute('data-product-id'); // Lấy product ID
        if (endTimeStr) {
            const endTime = new Date(endTimeStr);
            const currentTime = new Date();
            const diff = endTime - currentTime;
=======
    function updateTime() {
        const timeElements = document.querySelectorAll('[id^="time-"]');
        timeElements.forEach(function (element) {
            const endTimeStr = element.getAttribute('data-end-time');
            if (endTimeStr) {
                const endTime = new Date(endTimeStr);
                const currentTime = new Date();
                const diff = endTime - currentTime;
>>>>>>> 8fdbe7c37e544106448e305aabeef04f64ae7bdb

            if (diff > 0) {
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                element.innerHTML = `${days} ngày ${hours} giờ ${minutes} phút ${seconds} giây`;
            } else {
                element.innerHTML = 'Flash Sale đã kết thúc';
                removeProductFromFlashSale(productId); // Gọi hàm để xóa sản phẩm
            }
        }
    });
}

function removeProductFromFlashSale(productId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "remove_from_flashsale.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById(`product-${productId}`).remove(); // Xóa sản phẩm khỏi giao diện
        }
    };
    xhr.send("product_id=" + productId);
}

setInterval(updateTime, 1000); // Cập nhật mỗi giây
window.onload = updateTime; // Cập nhật ngay khi tải trang
    setInterval(updateTime, 1000); // Cập nhật mỗi giây
    window.onload = updateTime; // Cập nhật ngay khi tải trang

    function showDetails(product) {
        const detailsContainer = document.getElementById('product-details');
        const detailsContent = document.getElementById('details-content');
        const endTime = new Date(product.end_time);
        const endTimeStr = endTime.toLocaleString();
        const originalPrice = product.price;
        const discount = product.discount;
        const discountedPrice = originalPrice - (originalPrice * discount / 100);

        detailsContent.innerHTML = `
            <p>Tên sản phẩm: ${product.product_name}</p>
            <p>Thương hiệu: ${product.brand_name}</p>
            <p>Giá gốc: <span class="original-price">${originalPrice.toLocaleString()}đ</span></p>
            <p>Giá khuyến mãi: ${discountedPrice.toLocaleString()}đ</p>
            <p>Thời gian kết thúc: ${endTimeStr}</p>
            <div class="imgfs">
                <img src="uploads/${product.path_image}" alt="Product Image" style="max-width: 100%;">
            </div>
        `;
        detailsContainer.style.display = 'block';
    }

    function closeDetails() {
        document.getElementById('product-details').style.display = 'none';
    }
</script>

<style>

    .title-fsale {
        font-size: 30px;
        text-align: center;
        color: #FC0000;
        margin: 10px 0 20px 0;
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


    .container-fsale {
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 90%;
        margin: auto;
        overflow: hidden;
        padding: 20px 10px;
    }

    .container-item-fsale {
        display: flex;
        gap: 15px;
        position: relative;
        padding: 15px;
        overflow: hidden;
        transition: transform 0.5s ease;

    }

    .fsale-product {
        flex-shrink: 0;
        width: calc(20% - 15px);
        padding: 10px;
        text-align: center;
        position: relative;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }


    .container-img-fsale {
        display: flex;
        height: 180px;
        align-items: flex-end;
        justify-content: center;
        margin-bottom: 10px;
    }

    .fsale-product-img {
        width: 150px;
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
        background-color: #FFD400;
        color: #221F20;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
    }

    .show-detail-fsale:hover {}

    .add-to-cart-fsale {
        padding: 10px;
        cursor: pointer;
        border: none;
        background-color: #FFD400;
        color: #221F20;
        transition: all ease-in-out 0.3s;
        border-radius: 5px;
    }

    .add-to-cart-fsale:hover {
        background-color: #221F20;
        color: #FFD400;
    }
</style>

<style>
    .productfs-details {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        z-index: 150;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 600px;
        height: 450px;
    }

    .productfs-details h3 {
        margin-top: 0;
        /* Loại bỏ khoảng cách trên */
    }

    .productfs-details img {
        max-width: 100%;
        /* Giới hạn chiều rộng tối đa */
        height: auto;
        /* Giữ tỉ lệ ảnh */
        margin-top: 10px;
        /* Khoảng cách trên */
    }

    .productfs-details .close-btn {
        background-color: #f44336;

        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .productfs-details .close-btn:hover {
        background-color: #d32f2f;
    }

    .productfs-details .original-price {
        text-decoration: line-through;
        /* Gạch ngang */
        color: gray;
        /* Màu xám */
    }

    .productfs-details .discounted-price {
        color: #f44336;
        /* Màu đỏ */
        font-weight: bold;
        /* In đậm */
    }


    #details-content {
        margin-top: 20px;
        align-items: center;
    }

    .container-item-fsale {
        display: flex;
    }

    .imgfs {
        width: 450px;
        align-items: center;
    }

    .container-price-fsale {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .new-price {
        font-size: 20px;
        color: #f44336;
        font-weight: 700;
    }
</style>