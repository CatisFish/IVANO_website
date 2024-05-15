<?php
include '../php/connection.php';

// Kiểm tra dữ liệu được gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Băm mật khẩu trước khi so sánh
        $hashed_password = hash('sha256', $password); // Bạn có thể chọn thuật toán băm phù hợp

        // Kiểm tra kết nối đến cơ sở dữ liệu
        if ($conn) {
            // Sử dụng câu lệnh truy vấn tham số hóa để tránh lỗ hổng SQL Injection
            $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Đăng nhập thành công
                session_start();
                $_SESSION['username'] = $username;
                header("Location: ../index.html");
                exit();
            } else {
                // Đăng nhập không thành công
                $error_message = "Invalid username or password!";
            }
        } else {
            // Xử lý lỗi kết nối đến cơ sở dữ liệu
            $error_message = "Database connection error!";
        }
    } else {
        // Nếu các trường không tồn tại trong $_POST
        $error_message = "Please provide username and password!";
    }
}

// Nếu có lỗi, hiển thị thông báo lỗi
if(isset($error_message)) {
    echo "<script>alert('$error_message');</script>";
}
?>
