<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê số lượng sản phẩm</title>
</head>
<body>
    <h1>Số lượng sản phẩm</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Truy vấn số lượng sản phẩm
    $sql = "SELECT product_id, count(product_id) AS total_quantity FROM products ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Tổng số lượng</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>". $row['total_quantity'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>
</body>
</html>
