<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="css/global.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Register | IVANO</title>
</head>

<style>

</style>

<body>
    <?php include "assets/header.php"; ?>

    <div class="wrapper-register">
        <form action="./action/register-action.php" method="POST" class="register-form">
            <h1>Đăng Ký</h1>
            <p>Đăng ký tài khoản để nhận nhiều ưu đãi hơn</p>
            <div class="form-group">
                <input type="text" id="fullname" name="fullname" required placeholder=" ">
                <label for="fullname">Họ Và Tên</label>
            </div>
            <div class="form-group">
                <input type="text" id="user_name" name="user_name" required placeholder=" ">
                <label for="user_name">Tên Đăng Nhập</label>
            </div>
            <div class="form-group">
                <input type="tel" id="phone" name="phone" required placeholder=" ">
                <label for="phone">Số Điện Thoại</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" required placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="password">Mật Khẩu</label>
                <button class="show-hide-password" type="button" onclick="togglePassword()">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <div class="form-group">
                <input type="password" id="confirm_password" name="confirm_password" required placeholder=" ">
                <label for="confirm_password">Nhập Lại Mật Khẩu</label>
                <button class="show-hide-password" type="button" onclick="toggleConfirmPassword()">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>

            <button type="submit" class="register-button">Đăng Ký</button>

            <div class="go-login">
                <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
            </div>
        </form>
    </div>

    <?php include "assets/footer.php";?>
</body>



<style>
    .container-nav-right-item {
        align-items: center !important;
    }

    .wrapper-register {
        padding: 150px 0 30px 0;
        background: linear-gradient(to top right, #D7F8F8 0%, #FFFFFF 50%, #FFFFFF 70%, #FFC8B0 120%);
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .register-form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        max-width: 520px;
        width: 100%;
        animation: slideInUp 0.5s ease;
        position: relative;
    }

    .register-form h1 {
        text-align: center;
        font-size: 24px;
       margin-bottom: 10px;
    }

    .register-form p{
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
        color: #1E90FF;
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

    .register-button {
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

    .register-button:hover {
        background-color: #F58F5D;
    }


    .go-login {
        text-align: center;
        margin-top: 20px;
    }

    .go-login a {
        color: #E98D9e;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
        text-decoration: underline;
    }

    .go-login a:hover {
        color: #C12346;
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
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.querySelector('.form-group.password .show-hide-password i');
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

    function toggleConfirmPassword() {
        const confirmPasswordInput = document.getElementById('confirm-password');
        const confirmPasswordToggle = document.querySelector('.form-group.confirm-password .show-hide-password i');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            confirmPasswordToggle.classList.remove('fa-eye');
            confirmPasswordToggle.classList.add('fa-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            confirmPasswordToggle.classList.remove('fa-eye-slash');
            confirmPasswordToggle.classList.add('fa-eye');
        }
    }
</script>

</html>
