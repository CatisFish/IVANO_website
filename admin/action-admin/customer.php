
<?php
include '../connectDB.php';

// Xử lý thêm mới khách hàng
if (isset($_POST['add_customer'])) {
    $fullname = $_POST['fullname'];
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
    $role_id = $_POST['role_id'];
    $created_at = date('Y-m-d H:i:s'); // Ngày giờ hiện tại

    // Thêm khách hàng vào bảng customers
    $sql_customer = "INSERT INTO customers (fullname, user_name, phone, email, password, role_id, created_at) VALUES ('$fullname', '$user_name', '$phone', '$email', '$password', '$role_id', '$created_at')";
    if ($conn->query($sql_customer) === TRUE) {
        header("Location: customer.php");
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
        header("Location: customer.php");
        exit();
    } else {
        echo "Lỗi khi xóa người dùng: " . $conn->error;
    }
}

// Xử lý cập nhật thông tin khách hàng
if (isset($_POST['update_customer'])) {
    $customer_id = $_POST['customer_id'];
    $fullname = $_POST['fullname'];
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    // Cập nhật thông tin khách hàng vào bảng customers
    $sql_update_customer = "UPDATE customers SET fullname='$fullname', user_name='$user_name', phone='$phone', email='$email', role_id='$role_id' WHERE id_customer='$customer_id'";
    if ($conn->query($sql_update_customer) === TRUE) {
        header("Location: customer.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin người dùng: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các khách hàng
$sql = "SELECT * FROM customers WHERE role_id <> 1";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $customers = array();
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
} else {
    echo "Không có người dùng nào được tìm thấy.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="add-customer">
            <h2>Thêm mới người dùng</h2>
            <form method="POST" action="">
                <input type="text" name="fullname" placeholder="Họ và tên" required><br>
                <input type="text" name="user_name" placeholder="Tên đăng nhập" required><br>
                <input type="text" name="phone" placeholder="Số điện thoại" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Mật khẩu" required><br>
                <select name="role_id" required>
                    <option value="2">Nhân Viên</option>
                    <option value="3">Đại Lý</option>
                    <option value="4">Khách Hàng</option>
                </select><br>
                <button type="submit" name="add_customer">Thêm</button>
            </form>
        </div>

        <div class="customer-list">
            <h2>Danh sách người dùng</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã người dùng</th>
                        <th>Họ và tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Vai trò</th>
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
                                    <td>
                                        <select name="role_id" required>
                                            <option value="2" <?php if ($customer['role_id'] == 2) echo 'selected'; ?>>Nhân Viên</option>
                                            <option value="3" <?php if ($customer['role_id'] == 3) echo 'selected'; ?>>Đại Lý</option>
                                            <option value="4" <?php if ($customer['role_id'] == 4) echo 'selected'; ?>>Khách Hàng</option>
                                        </select>
                                    </td>
                                    <td><?php echo $customer['created_at']; ?></td>
                                    <td>
                                        <button type="submit" name="update_customer">Cập nhật</button>
                                        <a href="customer.php?delete_customer=<?php echo $customer['id_customer']; ?>"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</a>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Không có người dùng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

  




    <?php
    $conn->close();
    ?>
</body>

</html>



<style>
  body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f2f2f2;
    margin: 20px;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.add-customer {
    width: calc(20% - 10px);
    padding: 10px;
    box-sizing: border-box;
    background-color: #fff;
    border: 1px solid #ddd;
    margin-bottom: 20px; /* Thêm khoảng trống dưới form để nó không sát bảng */
}

.customer-list {
    width: calc(80% - 10px);
    padding: 10px;
    box-sizing: border-box;
    background-color: #fff;
    border: 1px solid #ddd;
    overflow-x: auto; /* Thêm thanh cuộn ngang nếu bảng quá rộng */
    margin-bottom: 20px; /* Thêm khoảng trống dưới form để nó không sát bảng */

}

.add-customer h2, .customer-list h2 {
    text-align: center;
    margin-bottom: 10px;
}

form {
    margin-bottom: 20px;
}

form input {
    padding: 8px;
    margin-bottom: 10px;
    width: calc(100% - 20px); /* Để input dài hơn và căn đều */
    box-sizing: border-box; /* Thêm box-sizing để tính toán chiều rộng chính xác */
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ddd;
    box-sizing: border-box; /* Đảm bảo chiều rộng và chiều cao chính xác */
}

thead {
    background-color: #f2f2f2;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: #4CAF50;
    color: white;
}

td {
    vertical-align: top; /* Để input nằm đúng hàng */
}

td input[type="text"], td input[type="email"] {
    width: 100%; /* Đảm bảo input chiếm 100% chiều rộng của ô */
    padding: 5px; /* Thêm padding để input dễ nhìn hơn */
    box-sizing: border-box; /* Đảm bảo tính toán đúng chiều rộng */
}

td button, td a {
    padding: 8px 10px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
}

td button {
    background-color: blue;
    color: white;
    border: none;
    margin: 5px;
    border-radius: 5px;
}

td a {
    background-color: #f44336;
    color: white;
    border: none;
    margin: 5px;
    padding: 5px 10px;
    border-radius: 5px;
}

td a:hover {
    background-color: #d32f2f;
}

td button:hover {
    background-color: #45a049;
}

</style>

