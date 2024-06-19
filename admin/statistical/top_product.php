<style>
    /* CSS cho top_product.php */
.container-top-products {
    margin-top: 20px;
    text-align: center;
}

.top-products-list {
    list-style: none;
    padding: 0;
}

.product-item {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
    
}

.product-item:hover {
    transform: translateY(-5px);
}

.product-link {
    text-decoration: none;
    color: inherit;
    display: block;
    
}

.product-image {
    width: 100%; /* Để hình ảnh đầy đủ chiều rộng của phần tử cha */
    max-width: 150px; /* Giới hạn chiều rộng tối đa của hình ảnh */
    height: auto; /* Đảm bảo chiều cao tự động điều chỉnh theo tỷ lệ của hình ảnh */
    display: block; /* Đảm bảo hình ảnh là phần tử block để có thể căn giữa */
    margin: 0 auto; /* Căn giữa hình ảnh theo chiều ngang */
    border-radius: 5px;
}
.product-info {
    margin-top: 10px;
    
}

.product-name {
    font-weight: bold;
    margin-bottom: 5px;
}
.top-products-list {
    width: 250px;
    height: 350px;
    margin: 20px;
    
}
.brand-name {
    margin-bottom: 5px;
}

.clicks {
    font-style: italic;
    color: #888;
}
.info-products{
    font-size: 15px;
}


</style>


<?php
// Bao gồm tệp kết nối đến cơ sở dữ liệu
include '../php/conection.php';

// Truy vấn SQL để lấy ra top sản phẩm theo số lượt nhấp
$topProductsSql = "
    SELECT 
        p.product_id, 
        p.product_name, 
        p.clicks, 
        b.brand_name, 
        i.path_image
    FROM 
        products p
    INNER JOIN 
        brands b ON p.brand_id = b.brand_id
    LEFT JOIN 
        product_images i ON p.product_id = i.product_id
    GROUP BY 
        p.product_id
    ORDER BY 
        p.clicks DESC
    LIMIT 
        4"; // Lấy ra top 5 sản phẩm
$result = $conn->query($topProductsSql);
echo '<div class = "info-products"> ';
// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo '<section class="container-top-products">';
    echo '<h2>Top Sản Phẩm</h2>';
    echo '<ul class="top-products-list">';
    while ($row = $result->fetch_assoc()) {
        echo '<li class="product-item">';
        echo '<a href="../show-detail.php?product_id=' . htmlspecialchars($row['product_id'], ENT_QUOTES, 'UTF-8') . '" class="product-link">';
        // Hiển thị ảnh sản phẩm
        if ($row['path_image']) {
            echo '<img src="' . htmlspecialchars($row['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '" class="product-image">';
        } else {
            echo '<img  src="placeholder.jpg" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '" class="product-image">';
        }
        // Hiển thị thông tin sản phẩm
        echo '<h3 class="product-name">' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '</h3>';
        echo '<p class="brand-name">Thương hiệu: ' . htmlspecialchars($row['brand_name'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p class="clicks">Số lượt nhấn: ' . htmlspecialchars($row['clicks'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</section>';
} else {
    echo "<p>Không có sản phẩm nào.</p>";
}
echo '</div>';
$conn->close();
?>

