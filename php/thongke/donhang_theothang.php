<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê đơn hàng theo tháng</title>
    <style>
        /* CSS cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <a href="../admin/index.php">Trở về trang chủ</a>
    <h1>Số đơn hàng theo tháng</h1>

    <?php
    include '../php/conection.php';

    $sql = "SELECT YEAR(create_time) AS year, MONTH(create_time) AS month, COUNT(*) AS total_orders FROM orders GROUP BY YEAR(create_time), MONTH(create_time)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Năm</th><th>Tháng</th><th>Tổng số đơn hàng</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['year'] . "</td><td>" . $row['month'] . "</td><td>" . $row['total_orders'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>
</body>
</html>
