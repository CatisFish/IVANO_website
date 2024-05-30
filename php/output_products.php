<?php
include 'php/conection.php';

$sql = "SELECT p.*, i.path_image, b.brand_name FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id
        LEFT JOIN brands b ON p.brand_id = b.brand_id
        ORDER BY RAND() LIMIT 8";
$result = $conn->query($sql);

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo '<section class="container-list-product">';
    echo '<div class="list-product">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<a href="show-detail.php?product_id=' . $row['product_id'] . '" class="container-info">';
        echo '<img class="product-img" src="admin/' . $row['path_image'] . '" alt="' . $row['product_name'] . '">';

        echo '<div class="product-info">';
        // Hiển thị tên thương hiệu với chuỗi 'SƠN' trước
        echo '<p class="brand-name">' . 'SƠN ' . $row['brand_name'] . '</p>';
        echo '<p class="product-name">' . $row['product_name'] . '</p>';

        echo '<div class="product-action">';
        // Hiển thị giá sản phẩm được định dạng
        echo '<div class="product-price">' . number_format($row['product_price'], 0, '', '.') . ' VND</div>';

        echo '<div class="action-add">';
        echo '<button type="submit" class="view-product">';
        echo '<p>Xem Nhanh</p>';
        echo '</button>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button class="prev-button"><i class="fa-solid fa-chevron-left"></i></button>';
    echo '<button class="next-button"><i class="fa-solid fa-chevron-right"></i></button>';
    echo '</section>';
} else {
    echo "<p class='no-products'>Không có sản phẩm nào.</p>";
}

$conn->close();
?>
