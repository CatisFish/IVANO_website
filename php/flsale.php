<?php
include '../php/conection.php';

$current_time = date('Y-m-d H:i:s');
$flashSaleSql = "
    SELECT f.flashsale_id, f.discount, p.id_sanpham, p.product_name, p.product_price, b.brand_name, f.quantity, t.start_time, t.end_time
    FROM flashsale f
    INNER JOIN products p ON f.id_sanpham = p.id_sanpham
    INNER JOIN brands b ON p.brand_id = b.brand_id
    INNER JOIN time_flashsale t ON f.flashsale_id = t.flashsale_id
    WHERE t.start_time <= ? AND t.end_time >= ? AND f.quantity > 0";
$stmt = $conn->prepare($flashSaleSql);
$stmt->bind_param('ss', $current_time, $current_time);
$stmt->execute();
$flashSaleResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Sale</title>
    <style>
        .container-list-product {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
        }

        .product-item {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Flash Sale</h1>

    <div class="container-list-product">
        <?php while ($row = $flashSaleResult->fetch_assoc()) { ?>
            <div class="product-item">
                <p><strong>Product ID:</strong> <?php echo $row['id_sanpham']; ?></p>
                <p><strong>Product Name:</strong> <?php echo $row['product_name']; ?></p>
                <p><strong>Brand:</strong> <?php echo $row['brand_name']; ?></p>
                <p><strong>Original Price:</strong> <?php echo $row['product_price']; ?> VND</p>
                <p><strong>Discount:</strong> <?php echo $row['discount']; ?>%</p>
                <p><strong>Discounted Price:</strong> <?php echo $row['product_price'] * (1 - $row['discount'] / 100); ?> VND</p>
                <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
                <p><strong>Start Time:</strong> <?php echo $row['start_time']; ?></p>
                <p><strong>End Time:</strong> <?php echo $row['end_time']; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
