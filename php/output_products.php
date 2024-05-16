<?php
include '../php/conection.php';

// Truy vấn để lấy danh sách các sản phẩm, size và đuôi màu
$sql = "SELECT p.*, i.path_image, s.size_name, c.color_suffix_name FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id 
        LEFT JOIN sizes s ON p.size_id = s.size_id
        LEFT JOIN colorsuffix c ON p.color_suffix_id = c.color_suffix_id";
$result = $conn->query($sql);

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['product_description'] . "</td>";
        echo "<td>" . $row['product_price'] . "</td>";
        echo "<td>" . $row['size_name'] . "</td>";
        echo "<td>" . $row['color_suffix_name'] . "</td>";
        echo "<td>";
        if (!empty($row['path_image'])) {
            echo '<img src="../admin/' . $row['path_image'] . '" width="100" height="100">';
        } else {
            echo "Không có ảnh";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Không có sản phẩm nào.</td></tr>";
}

// Đóng kết nối
$conn->close();
?>