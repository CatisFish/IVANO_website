<?php
// Kết nối CSDL và kiểm tra kết nối
include '../php/conection.php';

// Lấy dữ liệu từ form
$name = $_POST['name'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];
$image = $_FILES['image'];

// Kiểm tra dữ liệu được gửi từ form
echo "Tên: " . $name . "<br>";
echo "Số điện thoại: " . $phone . "<br>";
echo "Comment: " . $comment . "<br>";
echo "Ảnh: " . print_r($image, true) . "<br>";

// Xử lý và lưu ảnh vào thư mục uploads
$uploadDir = '../admin/images/';
$uploadFile = $uploadDir . basename($image['name']);

if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
    echo "File ảnh đã được lưu tại: " . $uploadFile . "<br>";
} else {
    echo "Lỗi khi lưu file ảnh.<br>";
}

// Thêm dữ liệu vào CSDL
$sql = "INSERT INTO comments (name, phone, comment, path_img) VALUES ('$name', '$phone', '$comment', '$uploadFile')";

echo "Câu lệnh SQL: " . $sql . "<br>";

if ($conn->query($sql) === TRUE) {
    echo 'Thêm nhận xét thành công<br>';
} else {
    echo 'Lỗi khi thêm nhận xét: ' . $conn->error . "<br>";
}

$conn->close();
?>
