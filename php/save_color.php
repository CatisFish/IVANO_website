<?php
// Kết nối đến cơ sở dữ liệu
include './conection.php';

// Hàm để xác định nhóm màu dựa trên mã hex
function getColorGroup($hex) {
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    if ($r > 200 && $g < 100 && $b < 100) {
        return 'red';
    } elseif ($r > 200 && $g > 200 && $b < 150) {
        return 'yellow';
    } elseif ($r < 150 && $g > 200 && $b < 150) {
        return 'green';
    } elseif ($r < 150 && $g < 150 && $b > 200) {
        return 'blue';
    } elseif ($r > 150 && $g < 100 && $b > 150) {
        return 'indigo';
    } elseif ($r > 200 && $g < 150 && $b > 200) {
        return 'violet';
    } else {
        return 'other';
    }
}

// Thêm màu mới
if (isset($_POST['add_color'])) {
    $colorCode = $_POST['color_code'];
    $colorHex = $_POST['color_hex'];
    $colorGroup = getColorGroup($colorHex); // Xác định nhóm màu
    $sql = "INSERT INTO colors (color_code, color_hex, color_group) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $colorCode, $colorHex, $colorGroup);
    if ($stmt->execute()) {
        echo "Màu đã được thêm thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

// Thêm nhiều màu mới
if (isset($_POST['add_multiple_colors'])) {
    $colorData = explode("\n", $_POST['multiple_colors']);
    $sql = "INSERT INTO colors (color_code, color_hex, color_group) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    foreach ($colorData as $color) {
        $colorDetails = explode(':', $color);
        $colorCode = trim($colorDetails[0]);
        $colorHex = trim($colorDetails[1]);
        $colorGroup = getColorGroup($colorHex); // Xác định nhóm màu
        $stmt->bind_param("sss", $colorCode, $colorHex, $colorGroup);
        if (!$stmt->execute()) {
            echo "Lỗi: " . $stmt->error . " khi thêm màu " . $colorCode . "<br>";
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

// Xóa nhiều màu cùng lúc
if (isset($_POST['delete_selected'])) {
    // Kiểm tra xem checkbox nào được chọn để xóa
    if (isset($_POST['color_ids']) && is_array($_POST['color_ids'])) {
        $color_ids = $_POST['color_ids'];

        // Chuyển mảng ID sang chuỗi để sử dụng trong câu truy vấn
        $ids_str = implode(',', $color_ids);

        // Xóa các màu có ID trong mảng đã chọn
        $sql = "DELETE FROM colors WHERE color_id IN ($ids_str)";
        if ($conn->query($sql) === TRUE) {
            echo "Đã xóa " . count($color_ids) . " màu thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Không có màu nào được chọn để xóa.";
    }
}

// Xóa tất cả các màu
if (isset($_POST['delete_all'])) {
    // Xóa tất cả các màu từ bảng
    $sql = "DELETE FROM colors";
    if ($conn->query($sql) === TRUE) {
        echo "Đã xóa tất cả màu thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
header("Location: colors.php");
exit();
?>
