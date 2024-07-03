<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | IVANO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="css/custom-scroll.css">
        <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <?php include "assets/header.php"; ?>

    <div class="wrapper-login">
        <form action="action/login-action.php" method="POST" class="login-form">
            <h1>Đăng Nhập</h1>
            <p>Đăng nhập để xem thêm nhiều ưu đãi hơn</p>

            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']); // Xóa thông báo lỗi sau khi đã hiển thị
            }
            ?>

            <div class="form-group">
                <input type="text" id="user_name" name="user_name" required placeholder=" ">
                <label for="user_name">UserName</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Password</label>
                <button class="show-hide-password" type="button" onclick="togglePassword()">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>

            <div class="remember-forgot">
                <div class="container-remmember">
                    <input type="checkbox" id="remember-me" name="remember_me">
                    <label for="remember-me">Ghi nhớ đăng nhập</label>
                </div>
                <a href="#" class="forgot-password">Bạn quên mật khẩu?</a>
            </div>

            <button type="submit" class="login-button">Login</button>

            <div class="register-link">
                <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
            </div>
        </form>
    </div>

    <?php include "assets/footer.php"; ?>
</body>

<style>
    .wrapper-login {
         background: linear-gradient(to top right, #D7F8F8 0%, #FFFFFF 50%, #FFFFFF 70%, #FFC8B0 120%);
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        padding: 130px 30px 30px 30px;
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
        margin-bottom: 10px;
       
    }

    .login-form p{
        text-align: center;
        margin-bottom: 40px;

    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group input{
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #55D5D2;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #55D5D2;
        font-weight: 600;
    }

    .form-group input:focus+label {
        color: #221F20;
    }

    .form-group input:not(:placeholder-shown)+label {
        color: #333;
    }

    .show-hide-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .show-hide-password i {
        font-size: 16px;
        color: #aaa;
    }

    .login-button {
        width: 100%;
        padding: 10px 20px;
        background-color: #55D5D2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .login-button:hover {
        background-color: #F58F5D;
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

    .remember-forgot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    #remember-me {
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

    .register-link {
        margin-top: 20px;
    }

    .register-link a {
        color: #E98D9e;
        font-weight: 600;
    }

    .register-link a:hover {
        color: #C12346;
    }
</style>

<script>
   function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.querySelector('.show-hide-password i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye');
    }
}
</script>

</html>