

<?php
include '../php/conection.php';

// Xử lý thêm mới khách hàng
if (isset($_POST['add_customer'])) {
    $fullname = $_POST['fullname'];
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $created_at = date('Y-m-d H:i:s'); // Ngày giờ hiện tại

    // Thêm khách hàng vào bảng customers
    $sql_customer = "INSERT INTO customers (fullname, user_name, phone, email, password, created_at) VALUES ('$fullname', '$user_name', '$phone', '$email', '$password', '$created_at')";
    if ($conn->query($sql_customer) === TRUE) {
        header("Location: ../php/customer.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới khách hàng: " . $conn->error;
    }
}

// Xử lý xóa khách hàng
if (isset($_GET['delete_customer'])) {
    $customer_id = $_GET['delete_customer'];
    $sql_delete_customer = "DELETE FROM customers WHERE id_customer='$customer_id'";
    if ($conn->query($sql_delete_customer) === TRUE) {
        header("Location: ../php/customer.php");
        exit();
    } else {
        echo "Lỗi khi xóa khách hàng: " . $conn->error;
    }
}

// Xử lý cập nhật thông tin khách hàng
if (isset($_POST['update_customer'])) {
    $customer_id = $_POST['customer_id'];
    $fullname = $_POST['fullname'];
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Cập nhật thông tin khách hàng vào bảng customers
    $sql_update_customer = "UPDATE customers SET fullname='$fullname', user_name='$user_name', phone='$phone', email='$email' WHERE id_customer='$customer_id'";
    if ($conn->query($sql_update_customer) === TRUE) {
        header("Location: ../php/customer.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin khách hàng: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các khách hàng
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $customers = array();
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
} else {
    echo "Không có khách hàng nào được tìm thấy.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách hàng</title>
</head>

<body>
    <h1>Quản lý khách hàng</h1>

    <!-- Form thêm mới khách hàng -->
    <form method="POST" action="">
        <input type="text" name="fullname" placeholder="Họ và tên" required><br>
        <input type="text" name="user_name" placeholder="Tên đăng nhập" required><br>
        <input type="text" name="phone" placeholder="Số điện thoại" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br>
        <button type="submit" name="add_customer">Thêm</button>
    </form>
    <br>

    <!-- Bảng danh sách khách hàng -->
    <table border="1">
        <thead>
            <tr>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Tên đăng nhập</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <form method="POST" action="">
                            <input type="hidden" name="customer_id" value="<?php echo $customer['id_customer']; ?>">
                            <td><?php echo $customer['id_customer']; ?></td>
                            <td><input type="text" name="fullname" value="<?php echo $customer['fullname']; ?>" required></td>
                            <td><input type="text" name="user_name" value="<?php echo $customer['user_name']; ?>" required></td>
                            <td><input type="text" name="phone" value="<?php echo $customer['phone']; ?>" required></td>
                            <td><input type="email" name="email" value="<?php echo $customer['email']; ?>" required></td>
                            <td><?php echo $customer['created_at']; ?></td>
                            <td>
                                <button type="submit" name="update_customer">Cập nhật</button>
                                <a href="../php/customer.php?delete_customer=<?php echo $customer['id_customer']; ?>"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</a>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Không có khách hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    $conn->close();
    ?>
</body>

</html>
