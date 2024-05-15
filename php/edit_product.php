<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        form input,
        form textarea,
        form select,
        form button {
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="file"] {
            margin-bottom: 20px;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

    </style>
</head>


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

// Xử lý sửa sản phẩm
if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $product_price = $_POST['product_price'];

    // Cập nhật thông tin sản phẩm trong bảng products
    $sql_update_product = "UPDATE products SET product_name='$product_name', product_description='$product_description', category_id='$category_id', brand_id='$brand_id', product_price='$product_price' WHERE product_id='$product_id'";
    if ($conn->query($sql_update_product) === TRUE) {

        // Xử lý cập nhật ảnh sản phẩm
        if (!empty($_FILES['product_images']['name'][0])) {
            // Xóa ảnh cũ của sản phẩm trong thư mục images và trong bảng product_images
            $sql_select_images = "SELECT path_image FROM product_images WHERE product_id=$product_id";
            $result_select_images = $conn->query($sql_select_images);
            if ($result_select_images->num_rows > 0) {
                while ($row = $result_select_images->fetch_assoc()) {
                    $path_image = $row['path_image'];
                    if (file_exists($path_image)) {
                        unlink($path_image); // Xóa ảnh trong thư mục images
                    }
                }
            }
            $sql_delete_images = "DELETE FROM product_images WHERE product_id=$product_id";
            $conn->query($sql_delete_images);

            // Thêm ảnh mới của sản phẩm vào thư mục images và cập nhật vào bảng product_images
            $product_images = $_FILES['product_images'];
            foreach ($product_images['tmp_name'] as $key => $tmp_name) {
                $image_name = $product_images['name'][$key];
                $image_tmp_name = $product_images['tmp_name'][$key];
                $upload_directory = "../admin/uploads/";
                $target_file = $upload_directory . basename($image_name);
                move_uploaded_file($image_tmp_name, $target_file); // Lưu ảnh vào thư mục images

                // Lưu đường dẫn của ảnh vào cơ sở dữ liệu
                $sql_image = "INSERT INTO product_images (product_id, path_image) VALUES ('$product_id', '$target_file')";
                $conn->query($sql_image);
            }
        }

        header("Location: products.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật sản phẩm: " . $conn->error;
    }
}

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql_get_product = "SELECT * FROM products WHERE product_id='$product_id'";
    $result_get_product = $conn->query($sql_get_product);
    if ($result_get_product->num_rows == 1) {
        $row_product = $result_get_product->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit();
    }
} else {
    echo "ID sản phẩm không được cung cấp.";
    exit();
}

// Lấy danh sách thương hiệu
$sql_brand = "SELECT * FROM brands";
$result_brand = $conn->query($sql_brand);

// Lấy danh sách các danh mục
$sql_category = "SELECT * FROM categories";
$result_category = $conn->query($sql_category);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
</head>

<body>
    <h1>Sửa sản phẩm</h1>

    <!-- Form sửa sản phẩm -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $row_product['product_id']; ?>">
        <input type="text" name="product_name" placeholder="Tên sản phẩm" value="<?php echo $row_product['product_name']; ?>" required><br>
        <textarea name="product_description" placeholder="Mô tả sản phẩm" required><?php echo $row_product['product_description']; ?></textarea><br>
        <input type="number" name="product_price" placeholder="Giá sản phẩm" value="<?php echo $row_product['product_price']; ?>" required><br>
        <select name="category_id" required>
            <option value="" disabled>Chọn danh mục</option>
            <?php while ($row_category = $result_category->fetch_assoc()) : ?>
                <option value="<?php echo $row_category['category_id']; ?>" <?php if ($row_category['category_id'] == $row_product['category_id']) echo "selected"; ?>><?php echo $row_category['category_name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <select name="brand_id" required>
            <option value="" disabled>Chọn thương hiệu</option>
            <?php while ($row_brand = $result_brand->fetch_assoc()) : ?>
                <option value="<?php echo $row_brand['brand_id']; ?>" <?php if ($row_brand['brand_id'] == $row_product['brand_id']) echo "selected"; ?>><?php echo $row_brand['brand_name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="file" name="product_images[]" multiple><br>
        <button type="submit" name="edit_product">Lưu</button>
    </form>

    <?php
    $conn->close();
    ?>
</body>

</html>
