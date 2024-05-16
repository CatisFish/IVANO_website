<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
        /* CSS cho các phần input và button */
        input[type="text"],
        textarea,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="file"] {
            margin-top: 10px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #f2f2f2;
        }

        table img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }

        table td a {
            text-decoration: none;
            margin-right: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
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

// Xử lý thêm mới sản phẩm
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $product_price = $_POST['product_price'];

    // Thêm sản phẩm vào bảng products
    $sql_product = "INSERT INTO products (product_name, product_description, category_id, brand_id, product_price) VALUES ('$product_name', '$product_description', '$category_id', '$brand_id', '$product_price')";
    if ($conn->query($sql_product) === TRUE) {
        $last_product_id = $conn->insert_id; // Lấy ID của sản phẩm vừa thêm

        // Thêm ảnh sản phẩm vào thư mục images và lưu đường dẫn vào cơ sở dữ liệu
        $product_images = $_FILES['product_images']; // Danh sách ảnh đã upload
        $uploaded_images = array();
        foreach ($product_images['tmp_name'] as $key => $tmp_name) {
            $image_name = $product_images['name'][$key];
            $image_tmp_name = $product_images['tmp_name'][$key];
            $upload_directory = "../admin/uploads/";
            $target_file = $upload_directory . basename($image_name);
            move_uploaded_file($image_tmp_name, $target_file); // Lưu ảnh vào thư mục images

            // Lưu đường dẫn của ảnh vào cơ sở dữ liệu
            $uploaded_images[] = $target_file;
            $sql_image = "INSERT INTO product_images (product_id, path_image) VALUES ('$last_product_id', '$target_file')";
            $conn->query($sql_image);
        }

        header("Location: products.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới sản phẩm: " . $conn->error;
    }
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete_product'])) {
    $product_id = $_GET['delete_product'];
    // Xóa sản phẩm trong bảng products
    $sql_delete_product = "DELETE FROM products WHERE product_id=$product_id";
    if ($conn->query($sql_delete_product) === TRUE) {
        // Xóa ảnh của sản phẩm trong thư mục images và trong bảng product_images
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

        header("Location: products.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các sản phẩm và đường dẫn ảnh sản phẩm
$sql = "SELECT p.*, i.path_image FROM products p LEFT JOIN product_images i ON p.product_id = i.product_id";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $products = array();
    while ($row = $result->fetch_assoc()) {
        // Tạo một mảng chứa thông tin của sản phẩm và ảnh
        $product_info = array(
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'product_description' => $row['product_description'],
            'category_id' => $row['category_id'],
            'brand_id' => $row['brand_id'],
            'product_price' => $row['product_price'],
            'path_image' => $row['path_image'] // Đường dẫn của ảnh sản phẩm
        );
        $products[] = $product_info;
    }
} else {
    echo "Không có sản phẩm nào được tìm thấy.";
}

// Lấy danh sách thương hiệu
$sql_brand = "SELECT * FROM brands";
$result_brand = $conn->query($sql_brand);

// Kiểm tra xem có dữ liệu được trả về không
if ($result_brand->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $brands = array();
    while ($row_brand = $result_brand->fetch_assoc()) {
        $brands[] = $row_brand;
    }
} else {
    echo "Không có thương hiệu nào được tìm thấy.";
}

// Lấy danh sách các danh mục
$sql_category = "SELECT * FROM categories";
$result_category = $conn->query($sql_category);

// Kiểm tra xem có dữ liệu được trả về không
if ($result_category->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $categories = array();
    while ($row_category = $result_category->fetch_assoc()) {
        $categories[] = $row_category;
    }
} else {
    echo "Không có danh mục nào được tìm thấy.";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <h1>Quản lý sản phẩm</h1>
    

    <!-- Form thêm mới sản phẩm -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="product_name" placeholder="Tên sản phẩm" required><br>
        <textarea name="product_description" placeholder="Mô tả sản phẩm" required></textarea><br>
        <input type="number" name="product_price" placeholder="Giá sản phẩm" required><br>
        <select name="category_id" required>
            <option value="" disabled selected>Chọn danh mục</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <select name="brand_id" required>
            <option value="" disabled selected>Chọn thương hiệu</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="file" name="product_images[]" multiple required><br>
        <button type="submit" name="add_product">Thêm</button>
    </form>
    <br>

    <!-- Bảng danh sách sản phẩm -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo $product['product_description']; ?></td>
                        <td><?php echo $product['product_price']; ?></td>
                        <td>
                            <?php
                            // Lấy tên danh mục của sản phẩm
                            $product_category_id = $product['category_id'];
                            $sql_category_name = "SELECT category_name FROM categories WHERE category_id=$product_category_id";
                            $result_category_name = $conn->query($sql_category_name);
                            if ($result_category_name->num_rows == 1) {
                                $row_category_name = $result_category_name->fetch_assoc();
                                echo $row_category_name['category_name'];
                            } else {
                                echo "Không xác định";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Lấy tên thương hiệu của sản phẩm
                            $product_brand_id = $product['brand_id'];
                            $sql_brand_name = "SELECT brand_name FROM brands WHERE brand_id=$product_brand_id";
                            $result_brand_name = $conn->query($sql_brand_name);
                            if ($result_brand_name->num_rows == 1) {
                                $row_brand_name = $result_brand_name->fetch_assoc();
                                echo $row_brand_name['brand_name'];
                            } else {
                                echo "Không xác định";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Hiển thị ảnh sản phẩm
                            if (!empty($product['path_image'])) {
                                echo '<img src="../admin/' . $product['path_image'] . '" width="100" height="100">';
                            } else {
                                echo "Không có ảnh";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="products.php?delete_product=<?php echo $product['product_id']; ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                            <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Sửa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Không có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    $conn->close();
    ?>
</body>

</html>