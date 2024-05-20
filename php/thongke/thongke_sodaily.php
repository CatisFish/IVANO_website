<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê số đại lý</title>
</head>
<body>
    <h1>Thống kê số đại lý</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Truy vấn số lượng đại lý
    $sql = "SELECT COUNT(*) AS total_agents FROM agency";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Tổng số đại lý: " . $row['total_agents'] . "</p>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>
</body>
</html>
