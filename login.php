<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">

    <title>Login | IVANO</title>
</head>

<style>

</style>

<body>
    <?php include "assets/header.php"; ?>

    <div class="wrapper-login">
        <form action="../action/login.php" method="POST" class="login-form">
            <h1>WELCOM TO IVANO WEBSITE</h1>

            <div class="form-group">
                <input type="text" id="username" name="username" required placeholder=" ">
                <label for="name">UserName</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" required placeholder=" ">
                <label for="address">Password</label>
                <button class="show-hide-password" type="button" onclick="togglePassword()">
                    <i class="fa-regular fa-eye"></i>
                </button>
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
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </form>
    </div>
</body>

<style>
    .wrapper-login {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        padding: 30px;
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
        margin-bottom: 50px;
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
        border-color: #1E90FF;
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
    }

    .form-group input:focus+label {
        color: #1E90FF;
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
        background-color: #1E90FF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .login-button:hover {
        background-color: #0073e6;
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