<?php
// Kết nối đến cơ sở dữ liệu
include './conection.php';

// Thêm màu mới
if (isset($_POST['add_color'])) {
    $colorCode = $_POST['color_code'];
    $colorHex = $_POST['color_hex'];
    $colorGroup = $_POST['color_group']; // Thêm dòng này để lấy dữ liệu từ trường color_group
    $sql = "INSERT INTO colors (color_code, color_hex, color_group) VALUES (?, ?, ?)"; // Thêm trường color_group vào câu lệnh SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $colorCode, $colorHex, $colorGroup); // Thêm s vào "sss" để khớp với trường color_group mới
    if ($stmt->execute()) {
        echo "Màu đã được thêm thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

// Thêm nhiều màu cùng lúc
if(isset($_POST['add_multiple_colors'])) {
    $multipleColors = $_POST['multiple_colors'];

    // Tách các cặp mã màu và mã hex bằng dấu xuống dòng
    $colorPairs = explode("\n", $multipleColors);

    // Lặp qua từng cặp và thêm vào cơ sở dữ liệu
    foreach($colorPairs as $colorPair) {
        // Tách mã màu và mã hex từ mỗi cặp
        $colorPair = trim($colorPair); // Loại bỏ khoảng trắng ở đầu và cuối dòng
        list($colorName, $colorHex, $colorGroup) = explode(":", $colorPair); // Thêm trường color_group vào list

        // Thực hiện truy vấn để thêm vào cơ sở dữ liệu
        $stmt = $conn->prepare("INSERT INTO colors (color_code, color_hex, color_group) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $colorName, $colorHex, $colorGroup);
        $stmt->execute();
        $stmt->close();
    }

    // Chuyển hướng người dùng đến trang chính sau khi thêm xong
    header("Location: colors.php");
    exit();
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

// Xóa màu đã chọn
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['color_ids'])) {
        $colorIds = implode(",", $_POST['color_ids']);
        $sql = "DELETE FROM colors WHERE color_id IN ($colorIds)";
        if ($conn->query($sql) === TRUE) {
            echo "Màu đã được xóa thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Vui lòng chọn ít nhất một màu để xóa.";
    }
}
header("Location: colors.php");
exit();

$conn->close();
?>
