<?php
// Kết nối đến cơ sở dữ liệu
include 'php/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];

    // Xóa sản phẩm khỏi bảng flash_sale
    $deleteSql = "DELETE FROM flash_sale WHERE product_id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $productId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi Flash Sale']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm hoặc không thể xóa']);
    }

    $stmt->close();
}

$conn->close();
?>
