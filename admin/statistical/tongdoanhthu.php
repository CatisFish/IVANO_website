<div class="container-info">
    <img src="images/pay.png" alt="tag-img">

    <div class="container-show">
        <p>Doanh Thu</p>
        <?php
        include 'connectDB.php';

        $sql = "SELECT SUM(od_total_price) AS od_total_price FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $formatted_revenue = number_format($row['od_total_price']);
            echo "<span>" . $formatted_revenue . "</span>";
        } else {
            echo "Không có dữ liệu doanh thu. ";
        }

        $conn->close();
        ?>
    </div>
</div>

<style>
    .container-info {
        padding: 10px;
        border: 1px solid #000;
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
