<?php
// Kiểm tra xem có yêu cầu POST từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
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

    // Lấy thông tin từ form
    $category_name = $_POST['category_name'];

    // Thêm mới danh mục vào cơ sở dữ liệu
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
