<?php
include '../php/conection.php';

$response = array('status' => 'error', 'message' => 'An error occurred');

// Thêm
if (isset($_POST['add'])) {
    $name = trim($_POST["name"]);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO ProductCategory (ProductCategory_name) VALUES (?)");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'Thêm loại sản phẩm mới thành công!');
        } else {
            $response = array('status' => 'error', 'message' => 'Lỗi khi thêm loại sản phẩm: ' . $conn->error);
        }
        $stmt->close();
    } else {
        $response['message'] = 'Tên loại sản phẩm không được để trống.';
    }
}

// Sửa
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT ProductCategory_name FROM ProductCategory WHERE ProductCategory_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(array("status" => "success", "ProductCategory_name" => $row['ProductCategory_name']));
            exit;
        } else {
            $response = array('status' => 'error', 'message' => 'Không tìm thấy loại sản phẩm.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Lỗi truy vấn.');
    }
    $stmt->close();
}

// Cập nhật
if (isset($_POST['update'])) {
    $id = intval($_POST["id"]);
    $name = trim($_POST["name"]);
    if (!empty($name)) {
        $stmt = $conn->prepare("UPDATE ProductCategory SET ProductCategory_name = ? WHERE ProductCategory_id = ?");
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            $response = array('status' => 'success', 'message' => 'Cập nhật thông tin loại sản phẩm thành công!');
        } else {
            $response = array('status' => 'error', 'message' => 'Lỗi khi cập nhật thông tin loại sản phẩm: ' . $conn->error);
        }
        $stmt->close();
    } else {
        $response['message'] = 'Tên loại sản phẩm không được để trống.';
    }
}

// Xóa
if (isset($_POST["delete"])) {
    $id = intval($_POST["id"]);
    $stmt = $conn->prepare("DELETE FROM ProductCategory WHERE ProductCategory_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Xóa loại sản phẩm thành công!');
    } else {
        $response = array('status' => 'error', 'message' => 'Lỗi khi xóa loại sản phẩm: ' . $conn->error);
    }
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
