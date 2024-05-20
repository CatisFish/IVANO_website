<?php
// Kết nối đến cơ sở dữ liệu
include '../php/conection.php';

// Xử lý thêm mới khách hàng
if (isset($_POST['add_customer'])) {
    $customer_id = $_POST['customer_id'];
    $fullname = $_POST['fullname'];
    $customer_address = $_POST['customer_address'];
    $customer_tell = $_POST['customer_tell'];
    $customer_gender = $_POST['customer_gender'];
    $customer_email = $_POST['customer_email'];

    // Thêm khách hàng vào bảng customers
    $sql_customer = "INSERT INTO customers (customer_id, fullname, customer_address, customer_tell, customer_gender, customer_email) VALUES ('$customer_id', '$fullname', '$customer_address', '$customer_tell', '$customer_gender', '$customer_email')";
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
    $sql_delete_customer = "DELETE FROM customers WHERE customer_id='$customer_id'";
    if ($conn->query($sql_delete_customer) === TRUE) {
        header("Location: ../php/customer.php");
        exit();
    } else {
        echo "Lỗi khi xóa khách hàng: " . $conn->error;
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
        <input type="text" name="customer_id" placeholder="Mã khách hàng" required><br>
        <input type="text" name="fullname" placeholder="Họ và tên" required><br>
        <input type="text" name="customer_address" placeholder="Địa chỉ" required><br>
        <input type="tel" name="customer_tell" placeholder="Số điện thoại" required><br>
        <select name="customer_gender" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br>
        <input type="email" name="customer_email" placeholder="Email" required><br>
        <button type="submit" name="add_customer">Thêm</button>
    </form>
    <br>

    <!-- Bảng danh sách khách hàng -->
    <table border="1">
        <thead>
            <tr>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['customer_id']; ?></td>
                        <td><?php echo $customer['fullname']; ?></td>
                        <td><?php echo $customer['customer_address']; ?></td>
                        <td><?php echo $customer['customer_tell']; ?></td>
                        <td><?php echo $customer['customer_gender']; ?></td>
                        <td><?php echo $customer['customer_email']; ?></td>
                        <td>
                            <a href="customer.php?delete_customer=<?php echo $customer['customer_id']; ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')">Xóa</a>
                        </td>
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
