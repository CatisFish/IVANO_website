<style>
    body{
    width: 20%;
    size: 10px;
    font-size: 12px;
}
</style>
<?php
include'conection.php';
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


// Xử lý yêu cầu tìm kiếm
$search_products = array();
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
    if ($result_search->num_rows > 0) {
        while ($row = $result_search->fetch_assoc()) {
            $search_products[] = $row;
        }
    }
}

// Truy vấn SQL để lấy danh sách sản phẩm
$productSql = "
    SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
    FROM products p 
    LEFT JOIN product_images i ON p.product_id = i.product_id
    INNER JOIN categories c ON p.category_id = c.category_id
    INNER JOIN brands b ON p.brand_id = b.brand_id
    INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
    INNER JOIN product_size ps ON p.product_id = ps.product_id
    INNER JOIN sizes s ON ps.size_id = s.size_id
    GROUP BY p.product_id, ps.size_id";
$productResult = $conn->query($productSql);

$conn->close();
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

    <!-- Form tìm kiếm -->
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit" name="search">Tìm kiếm</button>
    </form>

    <!-- Hiển thị kết quả tìm kiếm (nếu có) -->
    <?php if (isset($search_products) && !empty($search_products)) { ?>
        <h2>Kết quả tìm kiếm cho từ khóa: <?php echo htmlspecialchars($keyword); ?></h2>
        <?php $products = $search_products; ?>
    <?php } else { ?>
        <?php $products = $productResult->fetch_all(MYSQLI_ASSOC); ?>
    <?php } ?>

    <!-- Bảng danh sách sản phẩm -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <!-- <th>Mô tả</th> -->
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Loại sản phẩm</th>
                <th>Kích thước</th>
                <th>Giá</th>
                <th>Ảnh</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <!-- <td><?php echo $product['product_description']; ?></td> -->
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
                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


