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

// Kiểm tra xem có yêu cầu POST từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    // Cập nhật thông tin danh mục trong cơ sở dữ liệu
    $sql = "UPDATE categories SET category_name='$category_name' WHERE category_id=$category_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Lấy ID danh mục từ yêu cầu GET
$category_id = $_GET['category_id'];

// Truy vấn để lấy thông tin của danh mục cần sửa
$sql = "SELECT * FROM categories WHERE category_id=$category_id";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    $category = $result->fetch_assoc();
} else {
    echo "Không có danh mục nào được tìm thấy.";
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục sản phẩm</title>
</head>

<body>
    <h1>Sửa danh mục sản phẩm</h1>
    <form method="POST" action="">
        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
        <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" placeholder="Tên danh mục" required>
        <button type="submit">Lưu</button>
    </form>
</body>

</html>
