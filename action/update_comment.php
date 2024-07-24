<?php
include '../php/conection.php'; // Đảm bảo tên file kết nối và thư mục đúng

// Kiểm tra và lấy dữ liệu từ form
if (isset($_POST['id'], $_POST['name'], $_POST['phone'], $_POST['comment'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    // Kiểm tra và xử lý ảnh nếu được cập nhật
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../admin/images/';
            $uploadFile = $uploadDir . basename($image['name']);
            
            // Di chuyển file ảnh tải lên vào thư mục uploads
            if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                // Cập nhật dữ liệu với ảnh mới vào cơ sở dữ liệu
                $sql = "UPDATE comments SET name='$name', phone='$phone', comment='$comment', path_img='$uploadFile' WHERE id=$id";
            } else {
                echo 'Không thể tải lên ảnh.';
                exit();
            }
        } else {
            echo 'Lỗi khi tải lên ảnh: ' . $image['error'];
            exit();
        }
    } else {
        // Cập nhật dữ liệu khi không có ảnh mới
        $sql = "UPDATE comments SET name='$name', phone='$phone', comment='$comment' WHERE id=$id";
    }

    // Thực thi truy vấn cập nhật
    if ($conn->query($sql) === TRUE) {
        echo 'Cập nhật nhận xét thành công.';
    } else {
        echo 'Lỗi khi cập nhật nhận xét: ' . $conn->error;
    }
} else {
    echo 'Dữ liệu không hợp lệ.';
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
