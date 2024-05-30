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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
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

// Kiểm tra xem người dùng đã nhấn nút "Thêm" chưa
if (isset($_POST['add_product'])) {
    // Lấy thông tin sản phẩm từ form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $productcategory_id = $_POST['productcategory_id'];
    $product_size_id = $_POST['product_size_id']; // Thêm lấy thông tin product_size_id từ form

    // Lấy giá sản phẩm từ form
    $price = $_POST['price'];

    // Thêm sản phẩm vào bảng products
    $sql_product = "INSERT INTO products (product_id, product_name, product_description, category_id, brand_id, ProductCategory_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("ssssss", $product_id, $product_name, $product_description, $category_id, $brand_id, $productcategory_id);

    // Thực thi câu lệnh SQL
    if ($stmt_product->execute()) {
        // Lưu giá trị product_id vào bảng products thành công
        // Tiếp tục thêm giá và kích thước của sản phẩm vào bảng product_size

        // Thêm giá và kích thước của sản phẩm vào bảng product_size
        $sql_product_size = "INSERT INTO product_size (product_id, size_id, price) VALUES (?, ?, ?)";
        $stmt_product_size = $conn->prepare($sql_product_size);
        $stmt_product_size->bind_param("sss", $product_id, $product_size_id, $price);

        // Thực thi câu lệnh SQL
        if ($stmt_product_size->execute()) {
            // Lưu giá và kích thước sản phẩm vào bảng product_size thành công
            // Tiếp tục thêm ảnh sản phẩm vào bảng product_images

            // Xử lý tải lên ảnh và lưu đường dẫn vào cơ sở dữ liệu
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
                    $stmt_image->bind_param("ss", $product_id, $target_file);

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
        } else {
            // Lỗi khi thêm giá và kích thước sản phẩm vào bảng product_size
            echo "Lỗi khi thêm giá và kích thước sản phẩm: " . $stmt_product_size->error;
        }
    } else {
        // Lỗi khi thêm sản phẩm vào bảng products
        echo "Lỗi khi thêm mới sản phẩm: " . $stmt_product->error;
    }

    // Đóng câu lệnh prepare
    $stmt_product->close();
    $stmt_product_size->close();
}

// Truy vấn để lấy danh sách các sản phẩm và đường dẫn ảnh sản phẩm
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
FROM products p 
INNER JOIN categories c ON p.category_id = c.category_id
INNER JOIN brands b ON p.brand_id = b.brand_id
INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
INNER JOIN product_size ps ON p.product_id = ps.product_id
INNER JOIN sizes s ON ps.size_id = s.size_id
LEFT JOIN product_images i ON p.product_id = i.product_id
GROUP BY p.product_id, ps.size_id;";

$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Đóng kết nối
$result->close();

// Lấy danh sách các danh mục, thương hiệu, loại sản phẩm và kích thước
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
$categories = array();
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}

$sql_brands = "SELECT * FROM brands";
$result_brands = $conn->query($sql_brands);
$brands = array();
if ($result_brands->num_rows > 0) {
    while ($row = $result_brands->fetch_assoc()) {
        $brands[] = $row;
    }
}

$sql_productcategories = "SELECT * FROM productcategory";
$result_productcategories = $conn->query($sql_productcategories);
$productcategories = array();
if ($result_productcategories->num_rows > 0) {
    while ($row = $result_productcategories->fetch_assoc()) {
        $productcategories[] = $row;
    }
}

$sql_sizes = "SELECT * FROM sizes";
$result_sizes = $conn->query($sql_sizes);
$sizes = array();
if ($result_sizes->num_rows > 0) {
    while ($row = $result_sizes->fetch_assoc()) {
        $sizes[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>
<?php
// Xử lý yêu cầu tìm kiếm
if (isset($_GET['search'])) {
    $keyword = $_GET['keyword'];

    // Truy vấn để lấy danh sách sản phẩm phù hợp với từ khóa tìm kiếm
    $sql_search = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
    FROM products p 
    INNER JOIN categories c ON p.category_id = c.category_id
    INNER JOIN brands b ON p.brand_id = b.brand_id
    INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
    INNER JOIN product_size ps ON p.product_id = ps.product_id
    INNER JOIN sizes s ON ps.size_id = s.size_id
    LEFT JOIN product_images i ON p.product_id = i.product_id
    WHERE p.product_name LIKE '%$keyword%' OR p.product_description LIKE '%$keyword%'
    GROUP BY p.product_id, ps.size_id;";

    $result_search = $conn->query($sql_search);

    // Kiểm tra xem có dữ liệu được trả về không
    $search_products = array();
    if ($result_search->num_rows > 0) {
        while ($row = $result_search->fetch_assoc()) {
            $search_products[] = $row;
        }
    }
}
?>

<!-- Form tìm kiếm -->
<form method="GET" action="">
    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
    <button type="submit" name="search">Tìm kiếm</button>
</form>

<?php
// Hiển thị kết quả tìm kiếm (nếu có)
if (isset($search_products) && !empty($search_products)) {
    echo "<h2>Kết quả tìm kiếm cho từ khóa: " . $keyword . "</h2>";
    // Hiển thị danh sách sản phẩm tìm kiếm
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Tên sản phẩm</th>';
    echo '<th>Mô tả</th>';
    echo '<th>Danh mục</th>';
    echo '<th>Thương hiệu</th>';
    echo '<th>Loại sản phẩm</th>';
    echo '<th>Kích thước</th>';
    echo '<th>Giá</th>';
    echo '<th>Ảnh</th>';
    echo '<th>Hành động</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($search_products as $product) {
        echo '<tr>';
        echo '<td>' . $product['product_id'] . '</td>';
        echo '<td>' . $product['product_name'] . '</td>';
        echo '<td>' . $product['product_description'] . '</td>';
        echo '<td>' . $product['category_name'] . '</td>';
        echo '<td>' . $product['brand_name'] . '</td>';
        echo '<td>' . $product['ProductCategory_name'] . '</td>';
        echo '<td>' . $product['size_name'] . '</td>';
        echo '<td>' . $product['price'] . '</td>';
        echo '<td>';
        if (!empty($product['path_image'])) {
            echo '<img src="' . $product['path_image'] . '" width="100" height="100" alt="Product Image">';
        } else {
            echo 'No Image';
        }
        echo '</td>';
        echo '<td>';
        echo '<a href="delete_product.php?id=' . $product['product_id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm này không?\')">Xóa</a>';
        echo '<a href="edit_product.php?id=' . $product['product_id'] . '">Sửa</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    // Hiển thị thông báo khi không có kết quả tìm kiếm
    echo "<p>Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm.</p>";
}
?>

<body>
    <!-- Form thêm mới sản phẩm -->
    <h2>Thêm sản phẩm mới</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="product_id" placeholder="Mã sản phẩm" required><br>
        <input type="text" name="product_name" placeholder="Tên sản phẩm" required><br>
        <textarea name="product_description" placeholder="Mô tả sản phẩm" required></textarea><br>
        <select name="category_id" required>
            <option value="">Chọn danh mục</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <select name="brand_id" required>
            <option value="">Chọn thương hiệu</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <select name="productcategory_id" required>
            <option value="">Chọn loại sản phẩm</option>
            <?php foreach ($productcategories as $productcategory): ?>
                <option value="<?php echo $productcategory['ProductCategory_id']; ?>">
                    <?php echo $productcategory['ProductCategory_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <select name="product_size_id" required>
            <option value="">Chọn kích thước</option>
            <?php foreach ($sizes as $size): ?>
                <option value="<?php echo $size['size_id']; ?>"><?php echo $size['size_name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="number" name="price" placeholder="Giá sản phẩm" required><br>
        <input type="file" name="product_images[]" multiple required><br>
        <button type="submit" name="add_product">Thêm sản phẩm</button>
    </form>
    <h1>Quản lý sản phẩm</h1>

    <!-- Bảng danh sách sản phẩm -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Loại sản phẩm</th>
                <th>Kích thước</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td><?php echo $product['category_name']; ?></td>
                    <td><?php echo $product['brand_name']; ?></td>
                    <td><?php echo $product['ProductCategory_name']; ?></td>
                    <td><?php echo $product['size_name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td>
                        <?php if (!empty($product['path_image'])): ?>
                            <img src="<?php echo $product['path_image']; ?>" width="100" height="100" alt="Product Image">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="delete_product.php?id=<?php echo $product['product_id']; ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                        <a href="edit_product.php?id=<?php echo $product['product_id']; ?>">Sửa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>
<?php $conn->close(); ?>