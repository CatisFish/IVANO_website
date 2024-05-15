<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | IVANO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">
</head>

<body>
    <div class="wrapper-login">
        <form method="POST" class="login-form">
            <h1>WELCOME TO IVANO WEBSITE</h1>
            <div class="user-name">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username..." required>
            </div>
            <div class="password">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password..." required>
                <button class="show-hide-password" type="button"><i class="fa-regular fa-eye"></i></button>
            </div>
            <div class="remember-forgot">
                <div class="container-remember">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember Me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <button type="submit" class="login-button">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="register.html">Sign Up</a></p>
            </div>
        </form>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.querySelector('#password');
            const togglePasswordButton = document.querySelector('.show-hide-password');
            const eyeIcon = togglePasswordButton.querySelector('i');
        
            togglePasswordButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }); 
    </script>

<?php
// Kiểm tra dữ liệu được gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {

        include '../php/conection.php';

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

</body>
</html>
