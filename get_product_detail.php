<?php
// Lấy thông tin từ request
$productId = $_GET['product_id'];
$sizeId = $_GET['size_id'];

include 'php/conection.php';

// Truy vấn chi tiết sản phẩm với kích thước cụ thể
$detailQuery = "SELECT ps.price, i.path_image, p.product_name
                FROM product_size ps 
                INNER JOIN product_images i ON ps.product_image_id = i.product_image_id
                INNER JOIN products p ON ps.product_id = p.product_id
                WHERE ps.product_id = ? AND ps.size_id = ?";
$stmt = $conn->prepare($detailQuery);
$stmt->bind_param("ss", $productId, $sizeId);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['success'] = true;
    $response['data'] = array(
        'price' => $row['price'],
        'full_image_path' => 'uploads/' . $row['path_image'],
        'product_name' => $row['product_name']
    );
} else {
    $response['success'] = false;
    $response['message'] = "Không tìm thấy thông tin sản phẩm.";
}

$stmt->close();
$conn->close();

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
