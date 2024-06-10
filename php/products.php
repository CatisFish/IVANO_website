<style>

     /* scroll */

     .product-table-container {
        max-height: 400px; /* Chiều cao tối đa của bảng */
        overflow-y: auto; /* Cho phép cuộn theo trục y */
    }
    table {
        width: 100%; /* Đảm bảo bảng chiếm hết chiều rộng của container */
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    thead {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }

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

// Truy vấn để lấy danh sách các sản phẩm và đường dẫn ảnh sản phẩm
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
        FROM products p 
        INNER JOIN categories c ON p.category_id = c.category_id
        INNER JOIN brands b ON p.brand_id = b.brand_id
        INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
        INNER JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
        INNER JOIN sizes s ON ps.size_id = s.size_id
        LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham
        GROUP BY p.id_sanpham, ps.size_id";

$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    // Xử lý trường hợp không có sản phẩm nào được trả về
    echo "Không có sản phẩm nào được tìm thấy.";
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
    $size_id = $_POST['size_id'];
    $price = $_POST['price'];

    // Thêm sản phẩm vào bảng products
    $sql_product = "INSERT INTO products (product_id, product_name, product_description, category_id, brand_id, ProductCategory_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("ssssss", $product_id, $product_name, $product_description, $category_id, $brand_id, $productcategory_id);

    // Thực thi câu lệnh SQL thêm sản phẩm
    if ($stmt_product->execute()) {
        // Lấy ID sản phẩm mới được thêm vào
        $new_id_sanpham = $conn->insert_id;

        // Lặp qua danh sách các ảnh sản phẩm đã được tải lên và lưu chúng vào bảng product_images
        $product_images = $_FILES['product_images'];
        foreach ($product_images['tmp_name'] as $key => $tmp_name) {
            $image_name = $product_images['name'][$key];
            $image_tmp_name = $product_images['tmp_name'][$key];
            $upload_directory = "../admin/uploads/";
            $target_file = $upload_directory . basename($image_name);

            // Di chuyển và lưu ảnh vào thư mục uploads
            if (move_uploaded_file($image_tmp_name, $target_file)) {
                // Thêm đường dẫn ảnh vào bảng product_images
                $sql_image = "INSERT INTO product_images (id_sanpham, product_id, path_image) VALUES (?, ?, ?)";
                $stmt_image = $conn->prepare($sql_image);
                $stmt_image->bind_param("sss", $new_id_sanpham, $product_id, $target_file);

                if ($stmt_image->execute()) {
                    // Lấy ID của ảnh mới được thêm vào
                    $new_product_image_id = $conn->insert_id;

                    // Thêm giá và kích thước vào bảng product_size
                    $sql_product_size = "INSERT INTO product_size (id_sanpham, product_id, size_id, price, product_image_id) VALUES (?, ?, ?, ?, ?)";
                    $stmt_product_size = $conn->prepare($sql_product_size);
                    $stmt_product_size->bind_param("sssss", $new_id_sanpham, $product_id, $size_id, $price, $new_product_image_id);

                    if ($stmt_product_size->execute()) {
                        // Thêm sản phẩm thành công
                        echo "Thêm sản phẩm thành công!";
                    } else {
                        echo "Lỗi khi thêm giá và kích thước sản phẩm: " . $stmt_product_size->error;
                    }
                } else {
                    echo "Lỗi khi thêm ảnh sản phẩm: " . $stmt_image->error;
                }
            } else {
                echo "Lỗi khi di chuyển ảnh vào thư mục";
            }
        }
    } else {
        echo "Lỗi khi thêm mới sản phẩm: " . $stmt_product->error;
    }

    // Đóng câu lệnh prepare
    $stmt_product->close();
}

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

<body>
    <!-- Form tìm kiếm -->
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit" name="search">Tìm kiếm</button>
    </form>
<?php
include 'idmoinhat.php'
?>
     <!-- Form thêm mới sản phẩm -->
     <h2>Thêm mới sản phẩm</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="product_id">ID sản phẩm:</label>
        <input type="text" name="product_id" required><br>

        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" name="product_name" required><br>

        <label for="product_description">Mô tả sản phẩm:</label>
        <textarea name="product_description" required></textarea><br>

        <label for="category_id">Danh mục:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="brand_id">Thương hiệu:</label>
        <select name="brand_id" required>
            <?php foreach ($brands as $brand) { ?>
                <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="productcategory_id">Loại sản phẩm:</label>
        <select name="productcategory_id" required>
            <?php foreach ($productcategories as $productcategory) { ?>
                <option value="<?php echo $productcategory['ProductCategory_id']; ?>">
                    <?php echo $productcategory['ProductCategory_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="size_id">Kích thước:</label>
        <select name="size_id" required>
            <?php foreach ($sizes as $size) { ?>
                <option value="<?php echo $size['size_id']; ?>"><?php echo $size['size_name']; ?></option>
            <?php } ?>
        </select><br>

        <label for="price">Giá:</label>
        <input type="number" name="price" required><br>

        <label for="product_images">Ảnh sản phẩm:</label>
        <input type="file" name="product_images[]" multiple required><br>

        <button type="submit" name="add_product">Thêm sản phẩm</button>
    </form>

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

    // Xử lý yêu cầu tìm kiếm
    if (isset($_GET['search'])) {
        $keyword = $_GET['keyword'];

        // Truy vấn để lấy danh sách sản phẩm phù hợp với từ khóa tìm kiếm
        $sql_search = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
                   FROM products p 
                   INNER JOIN categories c ON p.category_id = c.category_id
                   INNER JOIN brands b ON p.brand_id = b.brand_id
                   INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
                   INNER JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
                   INNER JOIN sizes s ON ps.size_id = s.size_id
                   LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham
                   WHERE p.product_name LIKE '%$keyword%' OR p.product_description LIKE '%$keyword%'
                   GROUP BY p.id_sanpham, ps.size_id, i.product_image_id";

        $result_search = $conn->query($sql_search);

        // Kiểm tra xem có dữ liệu được trả về không
        $search_products = array();
        if ($result_search->num_rows > 0) {
            while ($row = $result_search->fetch_assoc()) {
                $search_products[] = $row;
            }
        }

        // Hiển thị kết quả tìm kiếm (nếu có)
        if (!empty($search_products)) {
            echo "<h2>Kết quả tìm kiếm cho từ khóa: " . $keyword . "</h2>";
            echo '<table border="1">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID sản phẩm</th>';
            echo '<th>ID Sản Phẩm</th>';
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
                echo '<td>' . $product['id_sanpham'] . '</td>';
                echo '<td>' . $product['product_name'] . '</td>';
                echo '<td>' . $product['product_description'] . '</td>';
                echo '<td>' . $product['category_name'] . '</td>';
                echo '<td>' . $product['brand_name'] . '</td>';
                echo '<td>' . $product['ProductCategory_name'] . '</td>';
                echo '<td>' . $product['size_name'] . '</td>';
                echo '<td>' . $product['price'] . '</td>';
                echo '<td><img src="' . $product['path_image'] . '" alt="Ảnh sản phẩm" style="width:100px;"></td>';
                echo '<td><a href="edit_product.php?id=' . $product['id_sanpham'] . '">Sửa</a> | <a href="delete_product.php?id=' . $product['id_sanpham'] . '">Xóa</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>Không tìm thấy sản phẩm nào với từ khóa: " . $keyword . "</p>";
        }
    } else {
        // Hiển thị danh sách sản phẩm mặc định nếu không có yêu cầu tìm kiếm
        // Cập nhật truy vấn để lấy danh sách sản phẩm
        $sql_default = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
                    FROM products p 
                    INNER JOIN categories c ON p.category_id = c.category_id
                    INNER JOIN brands b ON p.brand_id = b.brand_id
                    INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
                    INNER JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
                    INNER JOIN sizes s ON ps.size_id = s.size_id
                    LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham";

        $result_default = $conn->query($sql_default);

        // Kiểm tra xem có dữ liệu được trả về không
        $default_products = array();
        if ($result_default->num_rows > 0) {
            while ($row = $result_default->fetch_assoc()) {
                $default_products[] = $row;
            }
        }

          // Hiển thị danh sách sản phẩm mặc định
    echo '<h2>Danh sách sản phẩm</h2>';
    echo '<div class="product-table-container">';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID sản phẩm</th>';
    echo '<th>ID Sản Phẩm</th>';
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
    foreach ($default_products as $product) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['product_description'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['category_name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['brand_name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['ProductCategory_name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($product['size_name'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars(number_format($product['price'], 0, ',', '.'), ENT_QUOTES, 'UTF-8') . ' VNĐ</td>';
        echo '<td><img src="' . htmlspecialchars($product['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh sản phẩm" style="width:100px;"></td>';
        echo '<td><a href="edit_product.php?id=' . htmlspecialchars($product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '">Sửa</a> | <a href="delete_product.php?id=' . htmlspecialchars($product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '">Xóa</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

    ?>



   
</body>

</html>

<?php
// Đóng kết nối
$conn->close();
?>