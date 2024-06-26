<?php
include "../connectDB.php";

// thêm size
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_size"])) {
    header('Content-Type: application/json');

    $sizeName = htmlspecialchars($_POST["size_name"], ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("INSERT INTO sizes (size_name) VALUES (?)");
    $stmt->bind_param("s", $sizeName);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Thêm Size thành công']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}

//sửa size
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_size"])) {
    header('Content-Type: application/json');

    $sizeId = $_POST["size_id"];
    $newSizeName = htmlspecialchars($_POST["new_size_name"], ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("UPDATE sizes SET size_name=? WHERE size_id=?");
    $stmt->bind_param("si", $newSizeName, $sizeId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Cập nhật Size thành công']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Xóa Size
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_size"])) {
    header('Content-Type: application/json');

    $sizeId = htmlspecialchars($_POST["size_id"], ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("DELETE FROM sizes WHERE size_id = ?");
    $stmt->bind_param("i", $sizeId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Size đã được xóa thành công']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}

// --------------------------------------------------------------------------------------

// thêm màu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_color_suffix"])) {
    header('Content-Type: application/json');

    $colorSuffixName = htmlspecialchars($_POST["color_suffix_name"], ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("INSERT INTO colorsuffix (color_suffix_name) VALUES (?)");
    $stmt->bind_param("s", $colorSuffixName);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Thêm Color Suffix thành công']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}

//sửa màu 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_color_suffix"])) {
    $colorSuffixId = $_POST["color_suffix_id"];
    $newColorSuffixName = $_POST["new_color_suffix_name"];

    $sql = "UPDATE colorsuffix SET color_suffix_name='$newColorSuffixName' WHERE color_suffix_id='$colorSuffixId'";
    $result = $conn->query($sql);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'Cập nhật Color Suffix thành công'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Lỗi: ' . $conn->error
        );
        echo json_encode($response);
    }
    $conn->close();
}

// xoá màu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_color_suffix"])) {
    $colorSuffixId = $_POST["color_suffix_id"];

    $sql = "DELETE FROM colorsuffix WHERE color_suffix_id='$colorSuffixId'";
    $result = $conn->query($sql);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'Xóa Color Suffix thành công'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Lỗi: ' . $conn->error
        );
        echo json_encode($response);
    }

    $conn->close();
}

?>