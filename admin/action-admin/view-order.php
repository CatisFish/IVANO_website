<?php
include "../connectDB.php";

if (isset($_GET['od_id'])) {
    $od_id = $_GET['od_id'];

    $sql = "SELECT * FROM orders WHERE od_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $od_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "Order not found.";
        exit;
    }
} else {
    echo "Order ID is required.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 1000px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
            height: 100px;
            background-color: orange;
        }
        .company-info h1 {
            font-size: 24px;
            margin: 0;
        }
        .company-info p {
            margin: 5px 0;
        }
        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .left, .right {
            width: 48%;
        }
        .left p, .right p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .footer p {
            margin: 10px 0;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <img src="../../images/logo.png"  alt="Company Logo" class="logo">
            <div class="company-info">
                <h1>CÔNG TY CỔ PHẦN IVANO VIỆT NAM</h1>
                <p>Địa chỉ: Số 36, KDC Hàng Bàng, Phường An Khánh, Quận Ninh Kiều, TP Cần Thơ</p>
                <p>Hotline: 0886 277772</p>
            </div>
        </div>
        <h2>PHIẾU XUẤT KHO KÈM HÓA ĐƠN BÁN HÀNG</h2>
        <div class="order-info">
            <div class="left">
                <p>Tên khách hàng: <?php echo $order['od_name']; ?></p>
                <p>Địa chỉ giao hàng: <?php echo $order['od_address']; ?></p>
                <p>SDT Người nhận hàng: <?php echo $order['receiver_tell']; ?></p>
                <p>Diễn giải: Bán hàng cho NVKD</p>
                <p>Xuất tại kho: <?php echo $order['wherehouse']; ?></p>
                <p>Chành xe: tìm xe hộ</p>
            </div>
            <div class="right">
                <p>Số phiếu đơn hàng: <?php echo $order['od_id']; ?></p>
                <p>Người phụ trách đơn hàng: <?php echo $order['employee_id']; ?></p>
                <p>SDT: <?php echo $order['od_tell']; ?></p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Hàng</th>
                    <th>DVT</th>
                    <th>Thể Tích</th>
                    <th>Số Lượng</th>
                    <th>Mã Màu</th>
                    <th>Đơn Giá</th>

                    
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_details = "SELECT * FROM order_details WHERE od_id = ?";
                $stmt_details = $conn->prepare($sql_details);
                $stmt_details->bind_param("s", $od_id);
                $stmt_details->execute();
                $result_details = $stmt_details->get_result();
                $stt = 1;

                if ($result_details->num_rows > 0) {
                    while ($detail = $result_details->fetch_assoc()) {
                        $details_array = explode(" - ", $detail['od_info']);

                        $product_name = $details_array[0] ?? '';
                        $product_V = $details_array[1] ?? '';
                        $product_duoimau = $details_array[2] ?? '';
                        $quantity = $details_array[3] ?? '';


                        $dvt = $quantity <= 5 ? 'Lon' : 'Thùng';
                        $color_code = $details_array[4] ?? '';

                        echo "<tr>
                                <td>{$stt}</td>                            
                                <td>{$product_name}</td>
                                <td>{$dvt}</td>
                                <td>{$product_V}</td>
                                <td>{$quantity}</td>

                                <td>{$color_code}</td>
                                
                            </tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No details found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php

?>

<div class="footer">
    <p>Tổng tiền: <?php echo $order['od_total_price']; ?></p>
    <p>Người lập phiếu: __________________</p>
    <p>Người nhận hàng: __________________</p>
    <p>Người giao hàng: __________________</p>
    <p>Thủ kho: __________________</p>
</div>

    </div>
    <button onclick="window.print()">Print Order</button>
    <a href="export_to_word.php?od_id=<?php echo $order['od_id']; ?>" class="btn btn-primary">Tải thành file Word</a>
</body>
</html>
