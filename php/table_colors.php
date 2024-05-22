<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Màu và Mã Hex</title>
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            border: 1px solid #000;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<?php
include './conection.php';

$sql = "SELECT * FROM colors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='color-box' style='background-color:" . $row['color_hex'] . ";'>" . $row['color_hex'] . "</div>";
    }
} else {
    echo "Không có dữ liệu.";
}

$conn->close();
?>

</body>
</html>
