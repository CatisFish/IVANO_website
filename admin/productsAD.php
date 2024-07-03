<?php
session_start();

if (isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];

    if (isset($loggedInUsername)) {
        $initial = substr($loggedInUsername, 0, 1);
    } else {
        echo "Không có tên người dùng đăng nhập";
    }
}
?>

<?php
include "connectDB.php";

// Truy vấn danh mục sản phẩm
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
$categories = array();
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "Không có danh mục sản phẩm nào được tìm thấy.";
}

// Truy vấn thương hiệu
$sql_brands = "SELECT * FROM brands";
$result_brands = $conn->query($sql_brands);
$brands = array();
if ($result_brands->num_rows > 0) {
    while ($row = $result_brands->fetch_assoc()) {
        $brands[] = $row;
    }
} else {
    echo "Không có thương hiệu nào được tìm thấy.";
}

// Truy vấn loại sản phẩm
$sql_productcategories = "SELECT * FROM productcategory";
$result_productcategories = $conn->query($sql_productcategories);
$productcategories = array();
if ($result_productcategories->num_rows > 0) {
    while ($row = $result_productcategories->fetch_assoc()) {
        $productcategories[] = $row;
    }
} else {
    echo "Không có loại sản phẩm nào được tìm thấy.";
}

// Truy vấn kích thước sản phẩm
$sql_sizes = "SELECT * FROM sizes";
$result_sizes = $conn->query($sql_sizes);
$sizes = array();
if ($result_sizes->num_rows > 0) {
    while ($row = $result_sizes->fetch_assoc()) {
        $sizes[] = $row;
    }
} else {
    echo "Không có kích thước sản phẩm nào được tìm thấy.";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global-style-ad.css">
    <title>Products Management</title>
</head>

<style>
    .main-admin-page {
        margin-left: 18%;
        border-left: 1px solid #fff;
        width: 82%;
        transition: all ease-in-out 0.3s;
    }

    .main-top-admin-page {
        width: 100%;
        display: flex;
        justify-content: space-between;
        background-color: #55D5D2;
        align-items: center;
        height: 10vh;
        font-weight: 600;
        padding: 0 20px;
        border-bottom: 1px solid #fff;
        top: 0;
        position: sticky;
        background: url('images/BacksAndBeyond_Images_Learning_2-2000x700-1-1400x490.jpg') no-repeat center center;
    }

    .main-top-left-admin-page {
        align-items: center;
    }

    .main-top-left-admin-page a {
        color: #FFF;
        transition: all ease-in-out 0.3s;
    }

    .main-top-left-admin-page a:hover {
        color: #000;
    }

    .main-top-right-admin-page {
        display: flex;
        gap: 10px;
        text-align: right;
        align-items: center;
        color: #fff;
    }

    .left-hello-user p {
        font-weight: 500;
        font-size: 13px;
    }

    .right-hello-user {
        border: 1px dashed #fff;
        width: 50px;
        height: 50px;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        display: flex;
    }

    /* ------------------------------------------------ */
    .add-search-btn {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        position: relative;
        position: sticky;
    }

    .open-add-new-form {
        background-color: #55D5D2;
        font-weight: 600;
        color: #fff;
        height: 40px;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .open-add-new-form:hover {
        background-color: #F58F5D;
    }

    .search-categories-box {
        border: 1px dashed #000;
        border-radius: 10px;
        padding-left: 5px;
    }

    .search-categories-text {
        height: 40px;
        padding: 10px;
        width: 300px;
        border: none;
        outline: none;
    }

    .search-categories-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: none;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
        display: none;
    }

    #add-new-product-form {
        visibility: hidden;
        display: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #FFF;
        z-index: 100;
        position: absolute;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        width: 700px;
        margin: 0px auto;
        padding: 10px 30px;
        border-radius: 20px;
    }

    .close-form {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #55D5D2;
        color: #FFF;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        transition: all ease-in-out 0.3s;
    }

    .close-form:hover {
        background-color: #F58F5D;
    }

    @-webkit-keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    #add-new-product-form h2 {
        text-transform: uppercase;
        margin-top: 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    /* ------------------------------------------------ */
    .container-form-group {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        align-items: center;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
        width: 50%;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #55D5D2;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 13px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #55D5D2;
        font-weight: 600;
    }

    .form-group input:focus+label {
        color: #221F20;
    }

    .form-group input:not(:placeholder-shown)+label {
        color: #333;
    }

    /* --------------------------------------------------- */

    .product-des-container label {
        font-weight: bold;
        display: block;
        margin-bottom: -10px;
    }

    #product-des {
        width: 100%;
        height: 100px;
        padding: 10px;
        border: 1px solid #000;
        outline: none;
    }

    .container-category,
    .container-brand,
    .container-product-type,
    .container-product-size {
        margin-bottom: 20px;
        width: 50%;
    }

    .container-category label,
    .container-brand label,
    .container-product-type label,
    .container-product-size label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .container-category select,
    .container-brand select,
    .container-product-type select,
    .container-product-size select {
        width: 100%;
        padding: 8px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .custom-file-input {
        width: 100%;
        height: 40px;
    }

    .preview-container {
        margin-top: 10px;
        border: 1px dashed #000;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50%;
        margin: 0px auto;
        height: 100px;
    }

    .preview-image {
        padding: 10px;
        max-width: 100%;
        max-height: 100px;
        display: block;
    }

    .container-add-new-product {
        margin: 20px 0 10px 0;
        text-align: center;
    }

    .add-new-product-btn {
        cursor: pointer;
        padding: 10px 30px;
        border: none;
        color: #fff;
        background-color: #55D5D2;
        transition: all ease-in-out 0.3s;
        border-radius: 10px;
        font-weight: 600;
    }

    .add-new-product-btn:hover {
        background-color: #F58F5D;
    }

    .show-list-product-item {
        margin-top: 10px;
        padding: 10px;
    }

    .show-list-product-item h3 {
        text-align: center;
        text-transform: uppercase;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .table-container {
        max-height: 520px;
        padding: 0 10px;
        overflow-y: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        position: sticky;
        top: 0;
        z-index: 1;
    }


    thead tr th {
        text-align: center;
        border-bottom: 2px solid #ddd;
        border-left: 1px solid #ddd;
        background-color: #F58F5D;
        color: #FFF;
        font-weight: 600;
        font-size: 13px;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border-left: 1px solid #ddd;
    }

    th:first-child,
    td:first-child {
        border-left: none;
    }

    th {
        background-color: #f2f2f2;
    }


    .product-image {
        width: 100px;
        max-width: 100px;
    }

    .product-id {
        font-weight: 600;
    }

    .product-name {
        color: #F58F5D;
        font-weight: 600;
    }

    .product-des {
        font-size: 12px;
    }

    .category-name,
    .product-type,
    .product-size,
    .product-price {
        font-weight: 500;
        font-size: 14px;
    }

    .brand-name {
        text-transform: uppercase;
        font-weight: 600;
        color: #F58F5D;
    }

    .product-price {
        font-weight: 600;
        color: #1E90FF;
    }
</style>



<body>
    <?php include "assets/sidebar.php"; ?>

    <div class="overlay" id="overlay"></div>
    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="index.php">Trang Quản Trị</a> <i class="fa-solid fa-angle-right"
                    style="color: #000; margin: 0 5px"></i> <a href="#">Sản Phẩm</a>
            </div>

            <?php include "assets/hello-user.php"; ?>
        </section>

        <div class="container-scoll">
            <section class="add-search-btn">
                <button class="open-add-new-form" onclick="openFormAddProduct()">Thêm sản phẩm mới</button>

                <form action="" class="search-categories-box">
                    <input type="text" placeholder="Nhập danh mục cần tìm..." class="search-categories-text">
                    <button class="search-categories-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </section>

            <form id="add-new-product-form" action="action-admin/products-management-action.php" method="POST"
                enctype="multipart/form-data">
                <button class="close-form" type="button"><i class="fa-solid fa-xmark"></i></button>
                <h2>Nhập thông tin sản phẩm</h2>

                <div class="container-form-group">
                    <div class="form-group">
                        <input type="text" id="product-id" name="product-id" required placeholder=" ">
                        <label for="product-id">Mã sản phẩm</label>
                    </div>

                    <div class="form-group">
                        <input type="text" id="product-name" name="product-name" required placeholder=" ">
                        <label for="product-name">Tên sản phẩm</label>
                    </div>
                </div>

                <div class="container-form-group">
                    <div class="container-category">
                        <label for="category_id">Danh mục:</label>
                        <select name="category_id" required>
                            <option selected disabled>Chọn 1 danh mục</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo htmlspecialchars($category['category_id']); ?>">
                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>

                    <div class="container-brand">
                        <label for="brand_id">Thương hiệu:</label>
                        <select name="brand_id" required>
                            <option selected disabled>Chọn 1 thương hiệu</option>
                            <?php foreach ($brands as $brand) { ?>
                                <option value="<?php echo htmlspecialchars($brand['brand_id']); ?>">
                                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="container-form-group">
                    <div class="container-product-type">
                        <label for="productcategory_id">Loại sản phẩm:</label>
                        <select name="productcategory_id" required>
                            <option selected disabled>Chọn 1 loại sản phẩm</option>
                            <?php foreach ($productcategories as $productcategory) { ?>
                                <option value="<?php echo htmlspecialchars($productcategory['ProductCategory_id']); ?>">
                                    <?php echo htmlspecialchars($productcategory['ProductCategory_name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="container-product-size">
                        <label for="size_id">Kích thước:</label>
                        <select name="size_id" required>
                            <option selected disabled>Chọn 1 kích thước</option>
                            <?php foreach ($sizes as $size) { ?>
                                <option value="<?php echo htmlspecialchars($size['size_id']); ?>">
                                    <?php echo htmlspecialchars($size['size_name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="product-des-container">
                    <label for="product-des">Mô tả:</label> <br>
                    <textarea name="product-des" id="product-des" placeholder="Mô tả sản phẩm"></textarea>
                </div>

                <div class="container-form-group" style="margin-top: 10px">
                    <div class="form-group">
                        <input type="text" id="product-price" name="product-price" required placeholder=" ">
                        <label for="product-price">Giá sản phẩm</label>
                    </div>

                    <div class="form-group">
                        <input type="file" class="custom-file-input" id="product_images" name="product_images[]"
                            multiple required>
                    </div>
                </div>

                <div class="preview-container">
                    <img id="previewImage" class="preview-image" src="#" alt="Preview">
                </div>

                <div class="container-add-new-product">
                    <button type="submit" name="add_product" class="add-new-product-btn">Thêm sản phẩm</button>
                </div>
            </form>

            <?php
            include "connectDB.php";

            $sql = "SELECT p.id_sanpham, p.product_id, p.product_name, p.product_description, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
                FROM products p 
                INNER JOIN categories c ON p.category_id = c.category_id
                INNER JOIN brands b ON p.brand_id = b.brand_id
                INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
                INNER JOIN product_size ps ON p.product_id = ps.product_id
                INNER JOIN sizes s ON ps.size_id = s.size_id
                LEFT JOIN product_images i ON p.product_id = i.product_id
                GROUP BY p.product_id, ps.size_id";


            $result = $conn->query($sql);

            $products = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
            } else {
                echo "Không có sản phẩm nào được tìm thấy.";
            }
            ?>
            <section class="show-list-product-item">
                <h3>Danh sách sản phẩm</h3>
                <?php if (!empty($products)) { ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Mã SP</th>
                                    <th>Tên SP</th>
                                    <th>Mô tả</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Loại SP</th>
                                    <th>Kích thước</th>
                                    <th>Giá</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <td><img src="<?php echo htmlspecialchars($product['path_image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                                alt="Ảnh sản phẩm" class="product-image"></td>
                                        <td class="product-id">
                                            <?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="product-name">
                                            <?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="product-des">
                                            <?php echo htmlspecialchars($product['product_description'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="category-name">
                                            <?php echo htmlspecialchars($product['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="brand-name">
                                            <?php echo htmlspecialchars($product['brand_name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="product-type">
                                            <?php echo htmlspecialchars($product['ProductCategory_name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="product-size">
                                            <?php echo htmlspecialchars($product['size_name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="product-price">
                                            <?php echo htmlspecialchars(number_format($product['price'], 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?>
                                            VNĐ
                                        </td>
                                        <td class="action-buttons">
                                            <a href="./action-admin/action-product/edit_product.php?id=<?php echo $product['id_sanpham']; ?>">Sửa</a>
                                            <a href="./action-admin/action-product/delete_product.php?id=<?php echo $product['id_sanpham']; ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p>Không có sản phẩm nào được tìm thấy.</p>
                <?php } ?>
            </section>
        </div>
    </main>
</body>

<script>
    function openFormAddProduct() {
        var overlay = document.querySelector('.overlay');
        var form = document.getElementById('add-new-product-form');

        overlay.style.display = 'block';
        form.style.display = 'block';
        form.style.visibility = 'visible';
    }

    document.addEventListener('DOMContentLoaded', function () {
        var closeButton = document.querySelector('.close-form');
        var form = document.getElementById('add-new-product-form');

        closeButton.addEventListener('click', function () {
            overlay.style.display = 'none';
            form.style.display = 'none';
            form.style.visibility = 'hidden';
        });
    });

</script>

<script>
    document.getElementById('product_images').addEventListener('change', function (e) {
        var files = e.target.files;
        var imageContainer = document.getElementById('previewImage');

        if (files.length > 0) {
            var reader = new FileReader();

            reader.onload = function (event) {
                imageContainer.src = event.target.result;
            };
            reader.readAsDataURL(files[0]);
        } else {
            imageContainer.src = '#';
        }
    });
</script>

</html>