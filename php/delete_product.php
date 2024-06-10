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
// Kiểm tra xem đã nhận ID sản phẩm cần xóa chưa
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // Lấy thông tin sản phẩm để xóa ảnh
    $stmt_product = $conn->prepare("SELECT * FROM products WHERE id_sanpham = ?");
    $stmt_product->bind_param("i", $delete_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product = $result_product->fetch_assoc();

    if ($product) {
        // Xóa dữ liệu từ bảng product_size dựa trên id_sanpham
        $sql_delete_product_size = "DELETE FROM product_size WHERE id_sanpham = ?";
        $stmt_delete_product_size = $conn->prepare($sql_delete_product_size);
        $stmt_delete_product_size->bind_param("i", $delete_id);

        if ($stmt_delete_product_size->execute()) {
            // Tiếp tục xóa dữ liệu từ bảng product_images dựa trên id_sanpham
            $sql_delete_product_images = "DELETE FROM product_images WHERE id_sanpham = ?";
            $stmt_delete_product_images = $conn->prepare($sql_delete_product_images);
            $stmt_delete_product_images->bind_param("i", $delete_id);

            // Lấy đường dẫn của thư mục chứa hình ảnh
            $upload_directory = "../admin/uploads/";

            // Xóa ảnh từ thư mục
            $stmt_delete_images = $conn->prepare("SELECT path_image FROM product_images WHERE id_sanpham = ?");
            $stmt_delete_images->bind_param("i", $delete_id);
            $stmt_delete_images->execute();
            $result_delete_images = $stmt_delete_images->get_result();

            while ($row = $result_delete_images->fetch_assoc()) {
                $image_path = $row['path_image'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            if ($stmt_delete_product_images->execute()) {
                // Tiếp tục xóa sản phẩm từ bảng products
                $sql_delete_product = "DELETE FROM products WHERE id_sanpham = ?";
                $stmt_delete_product = $conn->prepare($sql_delete_product);
                $stmt_delete_product->bind_param("i", $delete_id);

                if ($stmt_delete_product->execute()) {
                    // Xóa thành công, chuyển hướng về trang products.php
                    header("Location: products.php");
                    exit();
                } else {
                    // Lỗi khi xóa sản phẩm từ bảng products
                    echo "Lỗi khi xóa sản phẩm từ bảng products: " . $stmt_delete_product->error;
                }
            } else {
                // Lỗi khi xóa dữ liệu từ bảng product_images
                echo "Lỗi khi xóa dữ liệu từ bảng product_images: " . $stmt_delete_product_images->error;
            }
        } else {
            // Lỗi khi xóa dữ liệu từ bảng product_size
            echo "Lỗi khi xóa dữ liệu từ bảng product_size: " . $stmt_delete_product_size->error;
        }
    } else {
        // Không tìm thấy sản phẩm để xóa
        echo "Sản phẩm không tồn tại!";
    }
} else {
    // Không nhận được ID sản phẩm cần xóa
    echo "ID sản phẩm không hợp lệ!";
}
