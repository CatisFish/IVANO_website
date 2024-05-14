<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/global.css">

    <title>Register | IVANO</title>
</head>
<body>
    <div class="wrapper-register">
        <form action="#" class="register-form">
            <h1>Register</h1>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username..." required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password..." required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password..." required>
            </div>
            <button type="submit" class="register-button">Register</button>
            <div class="login-link">
                <p>Already have an account? <a href="index.html">Login</a></p>
            </div>
        </form>
    </div>
    <?php
            // Xử lý khi form được gửi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];

            // Kiểm tra mật khẩu trùng khớp
            if ($password !== $confirm_password) {
                echo "Password and confirm password do not match!";
                exit();
            }

            // Kiểm tra xem username đã tồn tại chưa
            $check_username_sql = "SELECT * FROM users WHERE user_name = '$username'";
            $result_username = $conn->query($check_username_sql);
            if ($result_username->num_rows > 0) {
                echo "Username already exists!";
                exit();
            }

            // Kiểm tra xem email đã tồn tại chưa
            $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
            $result_email = $conn->query($check_email_sql);
            if ($result_email->num_rows > 0) {
                echo "Email already exists!";
                exit();
            }

            // Nếu không có vấn đề gì, thêm người dùng vào cơ sở dữ liệu
            $insert_sql = "INSERT INTO users (user_name, pass_word, email) VALUES ('$username', '$email', '$password')";
            if ($conn->query($insert_sql) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }
    ?>

    
</body>
</html>