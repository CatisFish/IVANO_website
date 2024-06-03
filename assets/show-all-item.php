<?php
// Kết nối đến cơ sở dữ liệu
include 'php/conection.php';

// Lấy nhãn hiệu, kích thước, sắp xếp và từ khóa tìm kiếm đã chọn từ biểu mẫu
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
$selectedSize = isset($_GET['size']) ? $_GET['size'] : '';
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Truy vấn SQL để lấy thông tin sản phẩm, hình ảnh và thương hiệu
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
        FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id
        INNER JOIN categories c ON p.category_id = c.category_id
        INNER JOIN brands b ON p.brand_id = b.brand_id
        INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
        INNER JOIN product_size ps ON p.product_id = ps.product_id
        INNER JOIN sizes s ON ps.size_id = s.size_id";

// Xây dựng các điều kiện WHERE
$whereConditions = array();

if ($selectedBrand != '') {
    $whereConditions[] = "p.brand_id = ?";
}
if ($selectedSize != '') {
    $whereConditions[] = "s.size_id = ?";
}
if ($searchQuery != '') {
    $whereConditions[] = "(p.product_name LIKE ? OR c.category_name LIKE ? OR b.brand_name LIKE ?)";
}

// Thêm các điều kiện WHERE vào truy vấn
if (count($whereConditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

// Thêm điều kiện sắp xếp vào truy vấn
if ($sortOrder == 'asc') {
    $sql .= " ORDER BY ps.price ASC";
} elseif ($sortOrder == 'desc') {
    $sql .= " ORDER BY ps.price DESC";
}

$sql .= " GROUP BY p.product_id, ps.size_id";

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);

// Liên kết các tham số nếu có
$params = array();
$types = "";

if ($selectedBrand != '') {
    $params[] = $selectedBrand;
    $types .= "i";
}
if ($selectedSize != '') {
    $params[] = $selectedSize;
    $types .= "i";
}
if ($searchQuery != '') {
    $searchParam = "%$searchQuery%";
    $params[] = $searchParam;
    $params[] = $searchParam;
    $params[] = $searchParam;
    $types .= "sss";
}

if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo '<section class="container-list-all-product">';
    echo '<div class="list-all-product">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item-all-item">';
        echo '<a href="show-detail.php?product_id=' . $row['product_id'] . '" class="container-info-all-item">';

        // Kiểm tra xem có hình ảnh không
        $imagePath = !empty($row['path_image']) ? 'admin/' . $row['path_image'] : 'path/to/default/image.jpg';
        echo '<img class="product-img-all-item" src="' . $imagePath . '" alt="' . $row['product_name'] . '">';

        echo '<div class="product-info-all-item">';
        echo '<p class="brand-name-all-item">' . 'SƠN ' . $row['brand_name'] . '</p>';
        echo '<p class="product-name-all-item">' . $row['product_name'] . '</p>';

        echo '<div class="product-action-all-item">';
        echo '<div class="product-price">' . htmlspecialchars($row['price']) . '</div>';
        echo '</div>'; // Đóng product-action
        echo '</div>'; // Đóng product-info
        echo '</a>';

        echo '<div class="container-product-color-add-to-cart">';

        //size
        echo '<select name="" id="color-select-all-item">';
        echo '<option value="">Chọn 1 đuôi màu</option>';
        $colorSql = "SELECT * FROM colorsuffix";
        $colorResult = $conn->query($colorSql);

        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                echo "<option value='" . $colorRow['color_suffix_name'] . "'>" . $colorRow['color_suffix_name'] . "</option>";
            }
        } else {
            echo "<option value=''>Không có color suffix nào</option>";
        }
        echo '</select>';

        //add-to-cart
        echo '<button type="button" class="add-to-cart-all-item"><i class="fa-solid fa-cart-plus"></i></button>';
        echo '</div>';

        //màu
        echo '<div class="product-size-all-item">';
        $sizeSql = "SELECT * FROM sizes";
        $sizeResult = $conn->query($sizeSql);

        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                echo "<p class='size-item-all-item'>" . $sizeRow['size_name'] . "</p>";
            }
        } else {
            echo "<p class='no-sizes'>Không có size nào</p>";
        }
        echo '</div>';
        echo '</div>'; // Đóng product-item
    }
    echo '</div>'; // Đóng list-all-product
    echo '</section>'; // Đóng container-list-all-product
} else {
    echo "<p class='no-products'>Không có sản phẩm nào.</p>";
}

$conn->close();
?>

<style>
    .list-all-product {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .product-item-all-item {
        width: calc(25% - 10px);
        box-shadow: 0 5px 5px 0 rgb(0 0 0 / 10%);
        border-radius: 20px;
        box-sizing: border-box;
        margin-bottom: 30px;
        position: relative;
    }

    .product-img-all-item {
        width: 100%;
    }

    .product-info-all-item {
        padding: 0px 10px 10px 10px;
    }

    .brand-name-all-item {
        color: #333;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
        margin: 10px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .product-name-all-item {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        max-height: 45px;
        font-weight: 700;
        color: #1e73be;
        font-size: 17px;
    }

    .product-price-all-item {
        color: #f80000;
        font-weight: 600;
        margin: 10px 0 10px 0;
    }

    .container-product-color-add-to-cart {
        display: flex;
        padding: 0 10px;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .container-product-color-add-to-cart select {
        width: 80%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .container-product-color-add-to-cart select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .add-to-cart-all-item {
        padding: 8px 12px;
        cursor: pointer;
        border: none;
        background-color: #E91E63;
        color: #fff;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .add-to-cart-all-item:hover {
        background-color: #C2185B;
    }

    .product-size-all-item {
        position: absolute;
        width: 150px;
        background-color: #C2185B;
        text-align: center;
        right: 0;
        bottom: 30%;
        opacity: 0;
    }

    .size-item-all-item {
        padding: 10px 0;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
    }

    .size-item-all-item:hover {
        background-color: #f80000;
    }
</style>

