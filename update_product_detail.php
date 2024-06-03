<?php
// Lấy product_id và size_id từ yêu cầu GET
if (isset($_GET['product_id']) && isset($_GET['size'])) {
    $productId = $_GET['product_id'];
    $selectedSize = $_GET['size'];

    // Bao gồm tệp kết nối đến cơ sở dữ liệu
    include 'php/conection.php';

    // Truy vấn để lấy thông tin sản phẩm dựa trên product_id và size_id mới
    $detailQuery = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
            FROM products p 
            LEFT JOIN product_images i ON p.product_id = i.product_id
            INNER JOIN categories c ON p.category_id = c.category_id
            INNER JOIN brands b ON p.brand_id = b.brand_id
            INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
            INNER JOIN product_size ps ON p.product_id = ps.product_id
            INNER JOIN sizes s ON ps.size_id = s.size_id
            WHERE p.product_id = ? AND ps.size_id = ?
            LIMIT 1";
    $stmtDetail = $conn->prepare($detailQuery);
    $stmtDetail->bind_param("ss", $productId, $selectedSize);
    $stmtDetail->execute();
    $detailResult = $stmtDetail->get_result();

    if ($detailResult->num_rows > 0) {
        // Hiển thị thông tin chi tiết sản phẩm dựa trên kích thước mới
        $detailRow = $detailResult->fetch_assoc();
        echo "<img src='uploads/" . htmlspecialchars($detailRow['path_image'], ENT_QUOTES, 'UTF-8') . "' alt='Hình ảnh " . htmlspecialchars($detailRow['product_name'], ENT_QUOTES, 'UTF-8') . "'>";
        // Các phần tử HTML khác cũng cần được cập nhật tương tự
    } else {
        echo "Không tìm thấy thông tin sản phẩm.";
    }

    $stmtDetail->close();
    $conn->close();
} else {
    echo "Thiếu thông tin cần thiết.";
}
?>
