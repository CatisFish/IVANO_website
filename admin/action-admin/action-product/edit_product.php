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
include'../../connectDB.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];

    // Lấy thông tin sản phẩm hiện tại dựa vào ID
    $stmt_product = $conn->prepare("SELECT * FROM products WHERE id_sanpham = ?");
    $stmt_product->bind_param("i", $edit_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product = $result_product->fetch_assoc();

    if ($product) {
        $id_sanpham = $product['id_sanpham'];

        // Lấy thông tin giá và kích thước hiện tại
        $stmt_product_size = $conn->prepare("SELECT * FROM product_size WHERE id_sanpham = ?");
        $stmt_product_size->bind_param("i", $id_sanpham);
        $stmt_product_size->execute();
        $result_product_size = $stmt_product_size->get_result();
        $product_size = $result_product_size->fetch_assoc();

        // Lấy danh sách các danh mục
        $sql_categories = "SELECT * FROM categories";
        $result_categories = $conn->query($sql_categories);
        $categories = $result_categories->fetch_all(MYSQLI_ASSOC);

        // Lấy danh sách các thương hiệu
        $sql_brands = "SELECT * FROM brands";
        $result_brands = $conn->query($sql_brands);
        $brands = $result_brands->fetch_all(MYSQLI_ASSOC);

        // Lấy danh sách các loại sản phẩm
        $sql_productcategories = "SELECT * FROM productcategory";
        $result_productcategories = $conn->query($sql_productcategories);
        $productcategories = $result_productcategories->fetch_all(MYSQLI_ASSOC);

        // Lấy danh sách các kích thước
        $sql_sizes = "SELECT * FROM sizes";
        $result_sizes = $conn->query($sql_sizes);
        $sizes = $result_sizes->fetch_all(MYSQLI_ASSOC);

        // Kiểm tra xem người dùng đã nhấn nút "Cập nhật" chưa
        if (isset($_POST['update_product'])) {
            // Lấy thông tin sản phẩm từ form
            $product_name = $_POST['product_name'];
            $product_description = $_POST['product_description'];
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $productcategory_id = $_POST['productcategory_id'];
            $size_id = $_POST['product_size_id'];
            $price = $_POST['price'];

            // Kiểm tra xem có sự thay đổi trong dữ liệu không
            if (
                $product_name != $product['product_name'] ||
                $product_description != $product['product_description'] ||
                $category_id != $product['category_id'] ||
                $brand_id != $product['brand_id'] ||
                $productcategory_id != $product['ProductCategory_id'] ||
                $size_id != $product_size['size_id'] ||
                $price != $product_size['price']
                || !empty($_FILES['product_images']['name'][0]) // Kiểm tra xem có ảnh mới được tải lên không
            ) {
                // Cập nhật sản phẩm vào bảng products
                $sql_update_product = "UPDATE products SET product_name = ?, product_description = ?, category_id = ?, brand_id = ?, ProductCategory_id = ? WHERE id_sanpham = ?";
                $stmt_update_product = $conn->prepare($sql_update_product);
                $stmt_update_product->bind_param("sssssi", $product_name, $product_description, $category_id, $brand_id, $productcategory_id, $edit_id);

                // Thực thi câu lệnh SQL
                if ($stmt_update_product->execute()) {
                    // Cập nhật giá và kích thước của sản phẩm vào bảng product_size
                    $sql_update_product_size = "UPDATE product_size SET size_id = ?, price = ? WHERE id_sanpham = ?";
                    $stmt_update_product_size = $conn->prepare($sql_update_product_size);
                    $stmt_update_product_size->bind_param("sss", $size_id, $price, $id_sanpham);

                    // Thực thi câu lệnh SQL
                    if ($stmt_update_product_size->execute()) {
                        // Kiểm tra xem có ảnh mới được tải lên không
                        if (!empty($_FILES['product_images']['name'][0])) {
                            // Tiến hành xóa ảnh cũ trước khi tải lên ảnh mới và lưu vào cơ sở dữ liệu
                            $sql_delete_old_images = "DELETE FROM product_images WHERE id_sanpham = ?";
                            $stmt_delete_old_images = $conn->prepare($sql_delete_old_images);
                            $stmt_delete_old_images->bind_param("s", $id_sanpham);

                            // Thực thi câu lệnh SQL để xóa ảnh cũ
                            if ($stmt_delete_old_images->execute()) {
                                // Tiến hành tải lên ảnh mới và lưu vào cơ sở dữ liệu
                                foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
                                    $image_name = $_FILES['product_images']['name'][$key];
                                    $image_tmp_name = $_FILES['product_images']['tmp_name'][$key];
                                    $upload_directory = "../admin/uploads/";
                                    $target_file = $upload_directory . basename($image_name);

                                    // Di chuyển và lưu ảnh vào thư mục uploads
                                    if (move_uploaded_file($image_tmp_name, $target_file)) {
                                        // Lưu đường dẫn của ảnh vào cơ sở dữ liệu
                                        $sql_image = "INSERT INTO product_images (id_sanpham, path_image) VALUES (?, ?)";
                                        $stmt_image = $conn->prepare($sql_image);
                                        $stmt_image->bind_param("ss", $id_sanpham, $target_file);

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
    // Lỗi khi xóa ảnh cũ
    echo "Lỗi khi xóa ảnh cũ: " . $stmt_delete_old_images->error;
    }
    }                   
     echo "Cập nhật sản phẩm thành công!";
     header("Location: \IVANO_website\admin\productsAD.php");
exit();
} else {
    // Lỗi khi cập nhật giá và kích thước sản phẩm vào bảng product_size
    echo "Lỗi khi cập nhật giá và kích thước sản phẩm: " . $stmt_update_product_size->error;
}
} else {
// Lỗi khi cập nhật sản phẩm vào bảng products
echo "Lỗi khi cập nhật sản phẩm: " . $stmt_update_product->error;
}
} else {
// Nếu không có sự thay đổi, không cần thực hiện bất kỳ hành động nào
echo "Không có sự thay đổi trong dữ liệu!";
header("Location: \IVANO_website\admin\productsAD.php");
exit();
}
}
} else {
echo "Sản phẩm không tồn tại!";
}} 
else {
    echo "ID sản phẩm không hợp lệ!";
    }
    ?>



<h1>Chỉnh sửa sản phẩm</h1>

<!-- Form chỉnh sửa sản phẩm -->
<form action="" method="POST" enctype="multipart/form-data">
    <label for="product_name">Tên sản phẩm:</label>
    <input type="text" name="product_name" id="product_name"
        value="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
    <label for="product_description">Mô tả:</label>
    <textarea name="product_description" id="product_description"
        required><?php echo htmlspecialchars($product['product_description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
    <label for="category_id">Danh mục:</label>
    <select name="category_id" id="category_id" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($category['category_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="brand_id">Thương hiệu:</label>
    <select name="brand_id" id="brand_id" required>
        <?php foreach ($brands as $brand): ?>
            <option value="<?php echo htmlspecialchars($brand['brand_id'], ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($brand['brand_id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($brand['brand_name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="productcategory_id">Loại sản phẩm:</label>
    <select name="productcategory_id" id="productcategory_id" required>
        <?php foreach ($productcategories as $productcategory): ?>
            <option value="<?php echo htmlspecialchars($productcategory['ProductCategory_id'], ENT_QUOTES, 'UTF-8'); ?>"
                <?php echo ($productcategory['ProductCategory_id'] == $product['ProductCategory_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($productcategory['ProductCategory_name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="productcategory_id">Loại sản phẩm:</label>
    <select name="productcategory_id" id="productcategory_id" required>
        <?php foreach ($productcategories as $productcategory): ?>
            <option value="<?php echo htmlspecialchars($productcategory['ProductCategory_id'], ENT_QUOTES, 'UTF-8'); ?>"
                <?php echo ($productcategory['ProductCategory_id'] == $product['ProductCategory_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($productcategory['ProductCategory_name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="product_size_id">Kích thước:</label>
    <select name="product_size_id" id="product_size_id" required>
        <?php foreach ($sizes as $size): ?>
            <option value="<?php echo htmlspecialchars($size['size_id'], ENT_QUOTES, 'UTF-8'); ?>"
                <?php echo ($size['size_id'] == $product_size['size_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($size['size_name'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="price">Giá:</label>
    <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($product_size['price'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
    <label for="product_images">Hình ảnh:</label>
    <input type="file" name="product_images[]" id="product_images" multiple><br><br>
    <?php
    // Hiển thị các hình ảnh hiện tại của sản phẩm
    $sql_product_images = "SELECT * FROM product_images WHERE id_sanpham = $id_sanpham";
    $result_product_images = $conn->query($sql_product_images);
    if ($result_product_images->num_rows > 0) {
        while ($row = $result_product_images->fetch_assoc()) {
            echo '<img src="../../' . htmlspecialchars($row['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="Product Image" style="width:150px;height:150px;margin-right:10px;">';
        }
    } else {
        echo "Không có hình ảnh nào.";
    }
    ?><br><br>
    <input type="submit" name="update_product" value="Cập nhật">
</form>
