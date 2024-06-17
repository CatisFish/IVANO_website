<?php
include '../php/conection.php';

// Thêm
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Danh mục đã được thêm."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Không thể thêm danh mục."));
    }
    $stmt->close();
}

// Sửa
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $stmt = $conn->prepare("SELECT category_name FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(array("status" => "success", "category_name" => $row['category_name']));
        } else {
            echo json_encode(array("status" => "error", "message" => "Không tìm thấy danh mục."));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Lỗi truy vấn."));
    }
    $stmt->close();
}

if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $stmt = $conn->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
    $stmt->bind_param("si", $category_name, $category_id);
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Danh mục đã được cập nhật."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Không thể cập nhật danh mục."));
    }
    $stmt->close();
}

// Xoá
if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];
    $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Danh mục đã được xóa."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Không thể xóa danh mục."));
    }
    $stmt->close();
}


?>
