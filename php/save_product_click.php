<?php
include 'conection.php';

// Lấy dữ liệu từ yêu cầu Ajax
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];

// Kiểm tra xem product_id đã tồn tại trong bảng products_click chưa
$sql_check = "SELECT * FROM products_click WHERE product_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $product_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Nếu tồn tại, cập nhật click_count
    $sql_update = "UPDATE products_click SET click_count = click_count + 1 WHERE product_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $product_id);
    if ($stmt_update->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    // Nếu không tồn tại, thêm mới
    $sql_insert = "INSERT INTO products_click (product_id, click_count) VALUES (?, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("i", $product_id);
    if ($stmt_insert->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

// Đóng kết nối
$conn->close();
?>
