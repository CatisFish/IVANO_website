<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Tên máy chủ cơ sở dữ liệu
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$database = "ivano_website"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý thêm mới thương hiệu
if (isset($_POST['add_brand'])) {
    $brand_name = $_POST['brand_name'];
    $sql = "INSERT INTO brands (brand_name) VALUES ('$brand_name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới: " . $conn->error;
    }
}

// Xử lý xóa thương hiệu
if (isset($_GET['delete_brand'])) {
    $brand_id = $_GET['delete_brand'];
    $sql = "DELETE FROM brands WHERE brand_id=$brand_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
}

// Xử lý cập nhật thương hiệu
if (isset($_POST['update_brand'])) {
    $brand_id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];
    $sql = "UPDATE brands SET brand_name='$brand_name' WHERE brand_id=$brand_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các thương hiệu
$sql = "SELECT * FROM brands";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $brands = array();
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
} else {
    echo "Không có thương hiệu nào được tìm thấy.";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thương hiệu</title>
</head>
<style>
    /* CSS cho các phần input và button */
input[type="text"],
button {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

/* CSS cho nút */
button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* CSS cho bảng danh sách thương hiệu */
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

</style>
<body>
    <h1>Quản lý thương hiệu</h1>

    <?php
    // Kiểm tra xem có yêu cầu chỉnh sửa thương hiệu không
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        // Lấy thông tin của thương hiệu cần chỉnh sửa
        if (isset($_GET['brand_id'])) {
            $brand_id = $_GET['brand_id'];
            $sql = "SELECT * FROM brands WHERE brand_id=$brand_id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
    ?>
                <!-- Biểu mẫu chỉnh sửa thương hiệu -->
                <h2>Chỉnh sửa thương hiệu</h2>
                <form method="POST" action="">
                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id']; ?>">
                    <input type="text" name="brand_name" value="<?php echo $row['brand_name']; ?>" required>
                    <button type="submit" name="update_brand">Cập nhật</button>
                </form>
                <br>
    <?php
            } else {
                echo "Không tìm thấy thương hiệu.";
            }
        }
    }
    // Đóng kết nối
    $conn->close();
    ?>

    <!-- Form thêm mới thương hiệu -->
    <form method="POST" action="">
        <input type="text" name="brand_name" placeholder="Tên thương hiệu" required>
        <button type="submit" name="add_brand">Thêm</button>
    </form>
    <br>

    <!-- Bảng danh sách thương hiệu -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên thương hiệu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand) : ?>
                <tr>
                    <td><?php echo $brand['brand_id']; ?></td>
                    <td><?php echo $brand['brand_name']; ?></td>
                    <td>
                        <a href="brands.php?action=edit&brand_id=<?php echo $brand['brand_id']; ?>">Sửa</a>
                        <a href="brands.php?delete_brand=<?php echo $brand['brand_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
