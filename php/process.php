<?php
// Kết nối đến cơ sở dữ liệu
include '../php/conection.php';

// Thêm màu mới
if (isset($_POST['add_color'])) {
    $colorCode = $_POST['color_code'];
    $sql = "INSERT INTO colors (code_color) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $colorCode);
    if ($stmt->execute()) {
        echo "Màu đã được thêm thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

// Thêm nhiều màu mới
if (isset($_POST['add_multiple_colors'])) {
    $colorCodes = explode(',', $_POST['multiple_colors']);
    $sql = "INSERT INTO colors (code_color) VALUES (?)";
    $stmt = $conn->prepare($sql);
    foreach ($colorCodes as $colorCode) {
        $colorCode = trim($colorCode);
        if (!empty($colorCode)) {
            $stmt->bind_param("s", $colorCode);
            if (!$stmt->execute()) {
                echo "Lỗi: " . $stmt->error . " khi thêm màu " . $colorCode . "<br>";
            }
        }
    }
    $stmt->close();
    echo "Màu đã được thêm thành công.";
}

// Xóa màu
if (isset($_GET['delete'])) {
    $colorId = $_GET['delete'];
    $sql = "DELETE FROM colors WHERE color_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $colorId);
    if ($stmt->execute()) {
        echo "Màu đã được xóa thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

// Đóng kết nối
$conn->close();

// Chuyển hướng về trang quản lý màu
header("Location: ../php/colors.php");
exit();
?>
