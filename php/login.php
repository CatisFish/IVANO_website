
    <div class="wrapper-login">
        <form  method="POST" class="login-form">
            <h1>WELCOME TO IVANO WEBSITE</h1>
            <div class="user-name">
                <label for="">UserName:</label>
                <input type="text" name="username" placeholder="Enter your username..." required>
            </div>

            <div class="password">
                <label for="">PassWord:</label>
                <input type="password" name="password" placeholder="Enter your password..." required>
                <button class="show-hide-password" type="button"><i class="fa-regular fa-eye"></i></button>
            </div>

            <div class="remember-forgot">
                <div class="container-remmember">
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

    <?php
    include '../php/connection.php';

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Truy vấn kiểm tra tên người dùng và mật khẩu
        $sql = "SELECT * FROM users WHERE user_name = '$username' AND pass_word = '$password' and role_id = 1 ";
        $result = $conn->query($sql);

        // Kiểm tra kết quả truy vấn
        if ($result && $result->num_rows > 0) {
            // Đăng nhập thành công
            // Chuyển hướng tới trang index
            header("Location: ../index.php");
            exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau khi chuyển hướng
        } else {
            // Đăng nhập không thành công
            echo "Invalid username or password!";
        }
    }
?>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.querySelector('.password input[type="password"]');
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
</body>
</html>
