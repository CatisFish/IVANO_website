<?php
session_start();

include '../php/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['user_name']) && isset($_POST['password'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if ($conn) {
            // Câu lệnh SQL để lấy thông tin người dùng theo tên đăng nhập
            $sql = "SELECT * FROM customers WHERE user_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
                // Kiểm tra mật khẩu
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_name'] = $user_name;

                    if ($user['role_id'] == 1) {
                        header("Location: ../admin/index.php");
                        exit(); // Dừng việc thực thi sau khi chuyển hướng
                    } else {
                        header("Location: ../index.php");
                        exit(); // Dừng việc thực thi sau khi chuyển hướng
                    }
                } else {
                    $_SESSION['error_message'] = "Tài khoản hoặc mật khẩu không chính xác!";
                    header("Location: ../login.php");
                    exit(); // Dừng việc thực thi sau khi chuyển hướng
                }
            } else {
                $_SESSION['error_message'] = "Tài khoản hoặc mật khẩu không chính xác!";
                header("Location: ../login.php");
                exit(); // Dừng việc thực thi sau khi chuyển hướng
            }
        }
    } else {
        $_SESSION['error_message'] = "Vui lòng điền đầy đủ thông tin!";
        header("Location: ../login.php");
        exit(); // Dừng việc thực thi sau khi chuyển hướng
    }
}
?>
