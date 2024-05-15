<?php
session_start();
// Kết nối đến MySQL
include './conection.php';


// // Kiểm tra trạng thái đăng nhập, nếu đã đăng nhập thì chuyển hướng đến trang index.html
// if (isset($_SESSION['username'])) {
//     header("Location: ./php/index.html");
//     exit();
// }

// Kiểm tra dữ liệu được gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra kết nối đến cơ sở dữ liệu
        if ($conn) {
            // Sử dụng câu lệnh truy vấn tham số hóa để tránh lỗ hổng SQL Injection
            $sql = "SELECT * FROM users WHERE username = ? AND password = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                    // Lấy thông tin người dùng từ kết quả truy vấn
                $user = $result->fetch_assoc();
    
                    // Kiểm tra role_id để xác định quyền truy cập và chuyển hướng tương ứng
                if ($user['role_id'] == 1) {
                        // Nếu role_id bằng 1, chuyển hướng đến trang ../admin/index.php
                     header("Location: ../admin/index.php");
                 } else {
                        // Nếu role_id khác 1, chuyển hướng đến trang index.php
                    header("Location: ../index.php");
                }
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

?>

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


<style>

        .wrapper-login {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 520px;
            width: 100%;
            animation: slideInUp 0.5s ease;
            position: relative;
        }

        .login-form h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            opacity: 0;
            animation: slideInDown 0.5s ease forwards;
        }

        .user-name,
        .password {
            margin-bottom: 30px;
        }

        .user-name label,
        .password label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333333;
        }

        .user-name input,
        .password input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            box-sizing: border-box;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .user-name input[type="text"]::placeholder,
        .password input[type="password"]::placeholder {
            color: #999999;
        }

        .user-name input:focus,
        .password input:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        .user-name input[type="text"]::-webkit-input-placeholder,
        .password input[type="password"]::-webkit-input-placeholder {
            color: #999999;
        }

        .login-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 15px;
            width: 100%;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #0056b3;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-50%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .show-hide-password {
            width: 30px;
            height: 30px;
            position: absolute;
            background-color: transparent;
            border: none;
            cursor: pointer;
            right: 50px;
            top: 50%;
            
        }

        .show-hide-password i{
        font-weight: 600;
        }

        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        #remember-me{
            cursor: pointer;
        }

        .forgot-password {
            text-decoration: none;
            color: #E98D9e;
            transition: color 0.3s ease;
            font-weight: 600;
        }

        .forgot-password:hover {
            color: #C12346;
        }

        .register-link{
            margin-top: 20px;
        }

        .register-link a{
            color:  #E98D9e;
            font-weight: 600;
        }

        .register-link a:hover{
            color: #C12346;
        }
</style>

<body>
    <div class="wrapper-login">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="login-form">
            <h1>WELCOM TO IVANO WEBSITE</h1>

            <div class="user-name">
                <label for="username">UserName:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username..." required>
            </div>
            <div class="password">
                <label for="password">PassWord:</label>
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
    // Kiểm tra nếu có biến PHP error_message tồn tại và không rỗng
    <?php if(isset($error_message) && !empty($error_message)) { ?>
        // Hiển thị cửa sổ cảnh báo với thông điệp lỗi
        alert("<?php echo $error_message; ?>");
    <?php } ?>
</script>

</body>
</html>
