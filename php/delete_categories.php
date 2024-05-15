<?php
// Kiểm tra xem có yêu cầu GET từ liên kết không
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category_id'])) {
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

    // Lấy ID danh mục từ yêu cầu GET
    $category_id = $_GET['category_id'];

    // Xóa danh mục từ cơ sở dữ liệu
    $sql = "DELETE FROM categories WHERE category_id=$category_id";

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
