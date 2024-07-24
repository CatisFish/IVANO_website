<div class="container-info">
    <img src="images/orders.png" alt="tag-img">

    <div class="container-show">
        <p>Đơn Hàng</p>
        <?php
        include 'connectDB.php';

        $sql = "SELECT COUNT(*) AS total_orders FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<span>" . $row['total_orders'] . "</span>";
        } else {
            echo "Không có dữ liệu đơn hàng.";
        }

        $conn->close();
        ?>
    </div>
</div>

<style>
    .container-info {
        padding: 10px;
        border: 1px solid #333;
        border-radius: 10px;
    }

    .container-info img {
        width: 130px;
        height: 130px;
    }

    .container-info {
        display: flex;
        align-items: center;
        font-size: 20px;
        font-weight: 700;
    }


    .container-info span {

        color: #1E73BE;
    }
</style>