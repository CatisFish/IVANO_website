<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê số đơn hàng</title>
</head>
<body>
    <h1>Thống kê số đơn hàng</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Truy vấn số lượng đơn hàng
    $sql = "SELECT COUNT(*) AS total_orders FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Tổng số đơn hàng: " . $row['total_orders'] . "</p>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>
</body>
</html>
