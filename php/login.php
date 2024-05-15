
<?php
        session_start();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if(isset($_SESSION['username'])) {
            header("Location: ../php/index.php"); // Chuyển hướng đến trang input nếu đã đăng nhập
            exit();
        }

        // Kết nối đến cơ sở dữ liệu MySQL
        $servername = "localhost"; // Thay đổi tùy theo cài đặt của bạn
        $username = "root"; // Thay đổi tùy theo cài đặt của bạn
        $password = ""; // Thay đổi tùy theo cài đặt của bạn
        $dbname = "ivano_website"; // Thay đổi tùy theo cài đặt của bạn

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Xử lý khi người dùng gửi form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra tên người dùng và mật khẩu trong cơ sở dữ liệu
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                // Tìm thấy người dùng, đăng nhập thành công
                $_SESSION['username'] = $username;
                header("Location: ../php/index.php"); // Chuyển hướng đến trang input
                exit();
            } else {
                // Đăng nhập không thành công
                $error = "Tên người dùng hoặc mật khẩu không đúng.";
            }
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">

    <title>Login | IVANO</title>
</head>

<<<<<<< HEAD
<body>
    <div class="wrapper-login">
        <form method="POST" class="login-form">
            <h1>WELCOME TO IVANO WEBSITE</h1>
=======
<style>

</style>

<body>
    <div class="wrapper-login">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="login-form">
            <h1>WELCOM TO IVANO WEBSITE</h1>
>>>>>>> d06063f1c7cb67d617e5e08b26ab205bfa5165e4
            <div class="user-name">
                <label for="">UserName:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username...">
            </div>

            <div class="password">
                <label for="">PassWord:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password...">
                <button class="show-hide-password" type="button"><i class="fa-regular fa-eye"></i></button>
            </div>

            <div class="remember-forgot">
                <div class="container-remmember">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember Me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" value="Đăng nhập" class="login-button">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.html">Sign Up</a></p>
            </div>
        </form>
    </div>
<<<<<<< HEAD
    
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

=======
>>>>>>> d06063f1c7cb67d617e5e08b26ab205bfa5165e4
</body>

    <?php
    if(isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    </body>
    </html>

    <?php
    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
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

</html>