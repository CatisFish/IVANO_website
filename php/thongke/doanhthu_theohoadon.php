<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê doanh thu theo hóa đơn</title>
</head>
<body>
    <h1>Doanh thu theo số hóa đơn</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Truy vấn doanh thu theo hóa đơn
    $sql = "SELECT order_id, count(order_id) as total_orders, SUM(total_price) AS total_price FROM orders ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Số lượng hóa đơn</th><th>Tổng doanh thu</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['total_orders'] . "</td><td>" . $row['total_price'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>
</body>
</html>
