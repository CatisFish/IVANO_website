<?php
include 'php/conection.php';

if (isset($_GET['product_id']) && isset($_GET['size_id'])) {
    $productId = $_GET['product_id'];
    $sizeId = $_GET['size_id'];

    $detailSql = "SELECT p.*, ps.price, s.size_name, i.path_image 
                  FROM products p 
                  INNER JOIN product_size ps ON p.product_id = ps.product_id 
                  INNER JOIN sizes s ON ps.size_id = s.size_id 
                  LEFT JOIN product_images i ON p.product_id = i.product_id 
                  WHERE p.product_id = ? AND s.size_id = ? 
                  LIMIT 1";

    $stmt = $conn->prepare($detailSql);
    $stmt->bind_param("ss", $productId, $sizeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $productDetail = $result->fetch_assoc();
        
        // Xây dựng đường dẫn đầy đủ đến hình ảnh
        $productDetail['full_image_path'] = 'uploads/' . $productDetail['path_image'];

        echo json_encode(['success' => true, 'data' => $productDetail]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu tham số product_id hoặc size_id']);
}

$conn->close();
?>
