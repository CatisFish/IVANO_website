<?php
// Kết nối đến cơ sở dữ liệu
include '../php/conection.php';

$response = array('status' => 'error', 'message' => 'An error occurred');

// Thêm mới thương hiệu
if (isset($_POST['add_brand'])) {
    $brand_name = $_POST['brand_name'];
    $sql = "INSERT INTO brands (brand_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $brand_name);
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Thêm thương hiệu mới thành công!');
    } else {
        $response = array('status' => 'error', 'message' => 'Lỗi khi thêm thương hiệu: ' . $stmt->error);
    }
    $stmt->close();
}

// Xóa thương hiệu
if (isset($_POST['delete_brand'])) {
    $brand_id = $_POST['id'];
    $sql = "DELETE FROM brands WHERE brand_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $brand_id);
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Xóa thương hiệu thành công!');
    } else {
        $response = array('status' => 'error', 'message' => 'Lỗi khi xóa thương hiệu: ' . $stmt->error);
    }
    $stmt->close();
}

// Cập nhật thương hiệu
if (isset($_GET['edit_brand'])) {
    $brand_id = $_GET['edit_brand'];
    $stmt = $conn->prepare("SELECT brand_name FROM brands WHERE brand_id = ?");
    $stmt->bind_param("i", $brand_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(array("status" => "success", "brand_name" => $row['brand_name']));
        } else {
            echo json_encode(array("status" => "error", "message" => "Không tìm thấy thương hiệu."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Lỗi truy vấn."));
    }
    $stmt->close();
}

if (isset($_POST['update_brand'])) {
    $brand_id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];
    $stmt = $conn->prepare("UPDATE brands SET brand_name = ? WHERE brand_id = ?");
    $stmt->bind_param("si", $brand_name, $brand_id);
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Thương hiệu đã được cập nhật."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Không thể cập nhật thương hiệu."));
    }
    $stmt->close();
}

$conn->close();

echo json_encode($response);
?>
