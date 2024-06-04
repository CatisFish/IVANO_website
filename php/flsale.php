<style>
    .productfs-details {
    display: none; /* Ban đầu ẩn đi */
    position: fixed; /* Hiển thị ở giữa màn hình */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff; /* Màu nền trắng */
    padding: 20px; /* Khoảng cách bên trong */
    border-radius: 10px; /* Bo góc */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    z-index: 1000; /* Hiển thị trên cùng */
    max-width: 90%;
    max-height: 90%;
    overflow-y: auto; /* Cuộn dọc nếu nội dung quá dài */
}

.productfs-details h3 {
    margin-top: 0; /* Loại bỏ khoảng cách trên */
}

.productfs-details img {
    max-width: 100%; /* Giới hạn chiều rộng tối đa */
    height: auto; /* Giữ tỉ lệ ảnh */
    margin-top: 10px; /* Khoảng cách trên */
}

.productfs-details .close-btn {
    background-color: #f44336; /* Màu nền đỏ */
    color: white; /* Màu chữ trắng */
    border: none; /* Không viền */
    padding: 10px 20px; /* Khoảng cách bên trong */
    border-radius: 5px; /* Bo góc */
    cursor: pointer; /* Thay đổi con trỏ chuột */
    position: absolute; /* Vị trí tuyệt đối */
    top: 10px; /* Cách trên 10px */
    right: 10px; /* Cách phải 10px */
}

.productfs-details .close-btn:hover {
    background-color: #d32f2f; /* Màu nền khi hover */
}

.productfs-details .product-info {
    margin-bottom: 20px; /* Khoảng cách dưới */
}

.productfs-details .original-price {
    text-decoration: line-through; /* Gạch ngang */
    color: gray; /* Màu xám */
}

.productfs-details .discounted-price {
    color: #f44336; /* Màu đỏ */
    font-weight: bold; /* In đậm */
}

    .banner-container {
    position: relative;
    width: 80%;
    margin: auto;
    overflow: hidden;
    border: 1px solid #ddd;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.original-price {
        text-decoration: line-through;
        color: gray;
    }
.banner {
    display: flex;
    transition: transform 0.5s ease;
}

.productfs-details{

}
.product {
    min-width: 25%;
    box-sizing: border-box;
    padding: 10px;
    text-align: center;
}

.product img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px;
}

.prev {
    left: 0;
}

.next {
    right: 0;
}



.original-price {
    text-decoration: line-through;
    opacity: 0.7; /* Độ mờ */
}
</style>
<?php
// Kết nối đến cơ sở dữ liệu
include 'php/conection.php';

// Truy vấn SQL để lấy danh sách sản phẩm flash sale
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

// Truy vấn SQL để lấy danh sách sản phẩm
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

<h2>Flash Sale</h2>

<div class="banner-container">
    <div class="banner">
        <?php 
        $flashSaleResult->data_seek(0); // Reset pointer
        while ($row = $flashSaleResult->fetch_assoc()) { 
            $endTime = new DateTime($row['end_time']);
            $endTimeStr = $endTime->format('Y-m-d H:i:s');
            $originalPrice = $row['price'];
            $discount = $row['discount'];
            $discountedPrice = $originalPrice - ($originalPrice * $discount / 100);
            ?>
            <div class="product" id="product-<?php echo $row['product_id']; ?>">
                <p>Giảm <?php echo $discount; ?>%</p>
                <div>
                    <?php if (!empty($row['path_image'])): ?>
                        <img src="uploads/<?php echo $row['path_image']; ?>" alt="Product Image">
                    <?php else: ?>
                        No Image
                    <?php endif; ?>
                </div>
                <p class="original-price"><?php echo number_format($originalPrice); ?>đ</p>
                <p><?php echo number_format($discountedPrice); ?>đ</p>
                <p id="time-<?php echo $row['product_id']; ?>" data-end-time="<?php echo $endTimeStr; ?>" data-product-id="<?php echo $row['product_id']; ?>"></p>
                <button onclick="showDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">Chi tiết</button>
                <button onclick="addToCart(<?php echo $row['product_id']; ?>)">Thêm vào giỏ hàng</button>
            </div>
        <?php } ?>
    </div>
    <button class="prev" onclick="moveLeft()">&#10094;</button>
    <button class="next" onclick="moveRight()">&#10095;</button>
</div>

<div class="productfs-details" id="product-details" style="display: none;">
    <h3>Chi tiết sản phẩm</h3>
    <div id="details-content" class="product-info"></div>
    <button class="close-btn" onclick="closeDetails()">Đóng</button>
</div>


<script>
   function updateTime() {
    const timeElements = document.querySelectorAll('[id^="time-"]');
    timeElements.forEach(function(element) {
        const endTimeStr = element.getAttribute('data-end-time');
        const productId = element.getAttribute('data-product-id'); // Lấy product ID
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

    let bannerIndex = 0;

    function moveRight() {
        const banner = document.querySelector('.banner');
        const products = document.querySelectorAll('.product');
        const productWidth = products[0].offsetWidth;
        bannerIndex++;
        if (bannerIndex > products.length - 4) {
            bannerIndex = 0;
        }
        banner.style.transform = `translateX(-${bannerIndex * productWidth}px)`;
    }

    function moveLeft() {
        const banner = document.querySelector('.banner');
        const products = document.querySelectorAll('.product');
        const productWidth = products[0].offsetWidth;
        bannerIndex--;
        if (bannerIndex < 0) {
            bannerIndex = products.length - 4;
        }
        banner.style.transform = `translateX(-${bannerIndex * productWidth}px)`;
    }

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

    function addToCart(productId) {
        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert('Sản phẩm đã được thêm vào giỏ hàng');
            }
        };
        xhr.send('product_id=' + productId);
    }
</script>

