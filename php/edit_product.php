
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        td img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }
        
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        form input[type="text"],
        form textarea,
        form select,
        form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }
        
        form button:hover {
            background-color: #45a049;
        }
        
        a.button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }
        
        a.button:hover {
            background-color: #45a049;
        }
        
        a.delete-button {
            background-color: #f44336;
        }
        
        a.delete-button:hover {
            background-color: #da190b;
        }
    </style>

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
    $edit_product_id = $_GET['id'];

    // Lấy thông tin sản phẩm hiện tại
    $stmt_product = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt_product->bind_param("s", $edit_product_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product = $result_product->fetch_assoc();

    // Lấy thông tin giá và kích thước hiện tại
    $stmt_product_size = $conn->prepare("SELECT * FROM product_size WHERE product_id = ?");
    $stmt_product_size->bind_param("s", $edit_product_id);
    $stmt_product_size->execute();
    $result_product_size = $stmt_product_size->get_result();
    $product_size = $result_product_size->fetch_assoc();

    // Lấy danh sách các danh mục
    $sql_categories = "SELECT * FROM categories";
    $result_categories = $conn->query($sql_categories);
    $categories = array();
    if ($result_categories->num_rows > 0) {
        while ($row = $result_categories->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    // Lấy danh sách các thương hiệu
    $sql_brands = "SELECT * FROM brands";
    $result_brands = $conn->query($sql_brands);
    $brands = array();
    if ($result_brands->num_rows > 0) {
        while ($row = $result_brands->fetch_assoc()) {
            $brands[] = $row;
        }
    }

    // Lấy danh sách các loại sản phẩm
    $sql_productcategories = "SELECT * FROM productcategory";
    $result_productcategories = $conn->query($sql_productcategories);
    $productcategories = array();
    if ($result_productcategories->num_rows > 0) {
        while ($row = $result_productcategories->fetch_assoc()) {
            $productcategories[] = $row;
        }
    }

    // Lấy danh sách các kích thước
    $sql_sizes = "SELECT * FROM sizes";
    $result_sizes = $conn->query($sql_sizes);
    $sizes = array();
    if ($result_sizes->num_rows > 0) {
        while ($row = $result_sizes->fetch_assoc()) {
            $sizes[] = $row;
        }
    }

    // Kiểm tra xem người dùng đã nhấn nút "Cập nhật" chưa
    if (isset($_POST['update_product'])) {
        // Lấy thông tin sản phẩm từ form
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $productcategory_id = $_POST['productcategory_id'];
        $product_size_id = $_POST['product_size_id']; // Thêm lấy thông tin product_size_id từ form

        // Lấy giá sản phẩm từ form
        $price = $_POST['price'];

        // Cập nhật sản phẩm vào bảng products
        $sql_update_product = "UPDATE products SET product_name = ?, product_description = ?, category_id = ?, brand_id = ?, ProductCategory_id = ? WHERE product_id = ?";
        $stmt_update_product = $conn->prepare($sql_update_product);
        $stmt_update_product->bind_param("ssssss", $product_name, $product_description, $category_id, $brand_id, $productcategory_id, $edit_product_id);

        // Thực thi câu lệnh SQL
        if ($stmt_update_product->execute()) {
            // Cập nhật giá và kích thước của sản phẩm vào bảng product_size
            $sql_update_product_size = "UPDATE product_size SET size_id = ?, price = ? WHERE product_id = ?";
            $stmt_update_product_size = $conn->prepare($sql_update_product_size);
            $stmt_update_product_size->bind_param("sss", $product_size_id, $price, $edit_product_id);

            // Thực thi câu lệnh SQL
            if ($stmt_update_product_size->execute()) {
                // Xử lý tải lên ảnh và lưu đường dẫn vào cơ sở dữ liệu nếu có ảnh mới
                if (!empty($_FILES['product_images']['name'][0])) {
                    // Xóa ảnh cũ
                    $stmt_delete_old_images = $conn->prepare("DELETE FROM product_images WHERE product_id = ?");
                    $stmt_delete_old_images->bind_param("s", $edit_product_id);
                    $stmt_delete_old_images->execute();

                    // Thêm ảnh mới
                    $product_images = $_FILES['product_images']; // Danh sách ảnh đã upload
                    foreach ($product_images['tmp_name'] as $key => $tmp_name) {
                        $image_name = $product_images['name'][$key];
                        $image_tmp_name = $product_images['tmp_name'][$key];
                        $upload_directory = "../admin/uploads/";
                        $target_file = $upload_directory . basename($image_name);

                        // Di chuyển và lưu ảnh vào thư mục uploads
                        if (move_uploaded_file($image_tmp_name, $target_file)) {
                            // Lưu đường dẫn của ảnh vào cơ sở dữ liệu
                            $sql_image = "INSERT INTO product_images (product_id, path_image) VALUES (?, ?)";
                            $stmt_image = $conn->prepare($sql_image);
                            $stmt_image->bind_param("ss", $edit_product_id, $target_file);

                            // Thực thi câu lệnh SQL
                            if ($stmt_image->execute()) {
                                // Lưu ảnh sản phẩm vào bảng product_images thành công
                            } else {
                                // Lỗi khi thêm ảnh vào bảng product_images
                                echo "Lỗi khi thêm ảnh sản phẩm: " . $stmt_image->error;
                            }
                        } else {
                            // Lỗi khi di chuyển ảnh vào thư mục
                            echo "Lỗi khi di chuyển ảnh vào thư mục";
                        }
                    }
                }
                echo "Cập nhật sản phẩm thành công!";
            } else {
                // Lỗi khi cập nhật giá và kích thước sản phẩm vào bảng product_size
                echo "Lỗi khi cập nhật giá và kích thước sản phẩm: " . $stmt_update_product_size->error;
            }
        } else {
            // Lỗi khi cập nhật sản phẩm vào bảng products
            echo "Lỗi khi cập nhật sản phẩm: " . $stmt_update_product->error;
        }

        // Đóng câu lệnh prepare
        $stmt_update_product->close();
        $stmt_update_product_size->close();
        // Đóng kết nối
$conn->close();
header("Location: products.php");
exit();
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
</head>

<body>
    <h1>Chỉnh sửa sản phẩm</h1>
    
    <!-- Form chỉnh sửa sản phẩm -->
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" name="product_name" id="product_name" value="<?php echo $product['product_name']; ?>" required><br>
        <label for="product_description">Mô tả:</label>
        <textarea name="product_description" id="product_description" required><?php echo $product['product_description']; ?></textarea><br>
        <label for="category_id">Danh mục:</label>
        <select name="category_id" id="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>" <?php echo ($category['category_id'] == $product['category_id']) ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="brand_id">Thương hiệu:</label>
        <select name="brand_id" id="brand_id" required>
            <?php foreach ($brands as $brand): ?>
                <option value="<?php echo $brand['brand_id']; ?>" <?php echo ($brand['brand_id'] == $product['brand_id']) ? 'selected' : ''; ?>><?php echo $brand['brand_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="productcategory_id">Loại sản phẩm:</label>
        <select name="productcategory_id" id="productcategory_id" required>
            <?php foreach ($productcategories as $productcategory): ?>
                <option value="<?php echo $productcategory['ProductCategory_id']; ?>" <?php echo ($productcategory['ProductCategory_id'] == $product['ProductCategory_id']) ? 'selected' : ''; ?>><?php echo $productcategory['ProductCategory_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="product_size_id">Kích thước:</label>
        <select name="product_size_id" id="product_size_id" required>
            <?php foreach ($sizes as $size): ?>
                <option value="<?php echo $size['size_id']; ?>" <?php echo ($size['size_id'] == $product_size['size_id']) ? 'selected' : ''; ?>><?php echo $size['size_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="price">Giá:</label>
        <input type="text" name="price" id="price" value="<?php echo $product_size['price']; ?>" required><br>
        <label for="product_images">Ảnh sản phẩm:</label>
        <input type="file" name="product_images[]" id="product_images" multiple><br>
        <input type="submit" name="update_product" value="Cập nhật sản phẩm">
    </form>
</body>

</html>
