<?php
include'../php/conection.php';

// Truy vấn để lấy danh sách các sản phẩm và đường dẫn ảnh sản phẩm
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
FROM products p 
INNER JOIN categories c ON p.category_id = c.category_id
INNER JOIN brands b ON p.brand_id = b.brand_id
INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
INNER JOIN product_size ps ON p.product_id = ps.product_id
INNER JOIN sizes s ON ps.size_id = s.size_id
LEFT JOIN product_images i ON p.product_id = i.product_id
GROUP BY p.product_id, ps.size_id";


$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_description']); ?></td>
                    <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['ProductCategory_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['size_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td>
                        <?php if (!empty($product['path_image'])): ?>
                            <img src="<?php echo htmlspecialchars($product['path_image']); ?>" width="100" height="100" alt="Product Image">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
