<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

<?php
// Kiểm tra xem form đã được submit chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra sự tồn tại của các trường trước khi truy cập
    $fullname = isset($_POST['fullname']) ? htmlspecialchars(trim($_POST['fullname'])) : '';
    $user_name = isset($_POST['user_name']) ? htmlspecialchars(trim($_POST['user_name'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
    $confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars(trim($_POST['confirm_password'])) : '';

    // Kiểm tra các trường không được để trống
    if (empty($fullname) || empty($user_name) || empty($phone) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi...',
                    text: 'Vui lòng điền đầy đủ thông tin.'
                }).then(function() {
                    window.history.back();
                });
              </script>";
        exit;
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp nhau không
    if ($password !== $confirm_password) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi...',
                    text: 'Mật khẩu và xác nhận mật khẩu không khớp nhau.'
                }).then(function() {
                    window.history.back();
                });
              </script>";
        exit;
    }

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi...',
                    text: 'Địa chỉ email không hợp lệ.'
                }).then(function() {
                    window.history.back();
                });
              </script>";
        exit;
    }

    // Mã hóa mật khẩu (sử dụng password_hash)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    include '../php/conection.php';

    // Chuẩn bị câu lệnh SQL để kiểm tra trùng lặp dữ liệu
    $check_stmt = $conn->prepare("SELECT user_name, email, phone FROM customers WHERE user_name = ? OR email = ? OR phone = ?");
    $check_stmt->bind_param("sss", $user_name, $email, $phone);
    $check_stmt->execute();
    $check_stmt->store_result();

    // Kiểm tra số lượng kết quả trả về
    if ($check_stmt->num_rows > 0) {
        // Đã tồn tại tên đăng nhập, email hoặc số điện thoại
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi...',
                    text: 'Tên đăng nhập, email hoặc số điện thoại đã tồn tại.'
                }).then(function() {
                    window.history.back();
                });
              </script>";
        exit;
    }

    $check_stmt->close();

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu
    $insert_stmt = $conn->prepare("INSERT INTO customers (fullname, user_name, phone, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Giá trị mặc định cho role_id là 3
    $default_role_id = 3;
    
    $insert_stmt->bind_param("sssssi", $fullname, $user_name, $phone, $email, $hashed_password, $default_role_id);

    // Thực thi câu lệnh SQL để chèn dữ liệu mới
    if ($insert_stmt->execute()) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Đăng ký thành công!'
                }).then(function() {
                    window.location = '../login.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi...',
                    text: 'Đã xảy ra lỗi khi đăng ký.'
                }).then(function() {
                    window.history.back();
                });
              </script>";
    }

    // Đóng kết nối
    $insert_stmt->close();
    $conn->close();
}
?>
