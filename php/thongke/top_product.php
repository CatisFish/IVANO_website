<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Sản phẩm bán chạy và được quan tâm</h1>
    <a href="../admin/index.php">Trở về trang chủ</a>

    <?php
    include('../php/conection.php');

    // Truy vấn để lấy sản phẩm hot dựa trên số lượng sản phẩm bán được
    $sql_hot_products = "
        SELECT p.product_id, p.product_name, SUM(od.quantity) AS total_sold
        FROM products p
        JOIN order_details od ON p.product_id = od.product_id
        GROUP BY p.product_id, p.product_name
        ORDER BY total_sold DESC
        LIMIT 5";
    
    $result_hot_products = $conn->query($sql_hot_products);

    echo "<h2>Sản phẩm bán chạy (dựa trên số lượng bán được)</h2>";
    if ($result_hot_products->num_rows > 0) {
        echo "<table>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng bán</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result_hot_products->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['total_sold']}</td>
                  </tr>";
        }
        echo "</tbody>
              </table>";
    } else {
        echo "Không có sản phẩm hot nào.";
    }

    // Truy vấn để lấy sản phẩm được quan tâm dựa trên số lượng click
    $sql_interested_products = "
        SELECT p.product_id, p.product_name, p.clicks
        FROM products p
        ORDER BY p.clicks DESC
        LIMIT 5";

    $result_interested_products = $conn->query($sql_interested_products);

    echo "<h2>Sản phẩm được quan tâm (dựa trên số lượng truy cập vào)</h2>";
    if ($result_interested_products->num_rows > 0) {
        echo "<table>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượt truy cập</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result_interested_products->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['clicks']}</td>
                  </tr>";
        }
        echo "</tbody>
              </table>";
    } else {
        echo "Không có sản phẩm nào được quan tâm.";
    }

    $conn->close();
    ?>
</body>
</html>
