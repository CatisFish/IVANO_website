<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "ivano_website";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $delete_product_id = $_GET['id'];

    // Bắt đầu giao dịch
    $conn->begin_transaction();

    try {
        // Xóa ảnh sản phẩm từ bảng product_images
        $stmt_delete_images = $conn->prepare("DELETE FROM product_images WHERE product_id = ?");
        $stmt_delete_images->bind_param("s", $delete_product_id);
        $stmt_delete_images->execute();

        // Xóa kích thước sản phẩm từ bảng product_size
        $stmt_delete_sizes = $conn->prepare("DELETE FROM product_size WHERE product_id = ?");
        $stmt_delete_sizes->bind_param("s", $delete_product_id);
        $stmt_delete_sizes->execute();

        // Xóa sản phẩm từ bảng products
        $stmt_delete_product = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt_delete_product->bind_param("s", $delete_product_id);
        $stmt_delete_product->execute();

        // Xác nhận giao dịch
        $conn->commit();
        echo "Xóa sản phẩm thành công!";
    } catch (Exception $e) {
        // Rollback giao dịch nếu có lỗi
        $conn->rollback();
        echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
}

// Đóng kết nối
$conn->close();

// Chuyển hướng về trang chính sau khi xóa
header("Location: products.php");
exit();
?>
