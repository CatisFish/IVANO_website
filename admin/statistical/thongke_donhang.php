<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê đơn hàng</title>
    <style>
        /* CSS cho biểu đồ */
        .chart-container {
            width: 60%;
            margin: 20px auto;
           
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php
    include 'connectDB.php';

    // Thống kê đơn hàng theo tháng
    $query_month = "SELECT YEAR(create_time) AS year, MONTH(create_time) AS month, COUNT(*) AS total_orders 
                    FROM orders 
                    GROUP BY YEAR(create_time), MONTH(create_time)";
    $result_month = $conn->query($query_month);

    $months = [];
    $orders_month = [];

    if ($result_month->num_rows > 0) {
        while ($row = $result_month->fetch_assoc()) {
            $months[] = $row['month'] . '/' . $row['year'];
            $orders_month[] = $row['total_orders'];
        }
    } else {
        echo "Không có dữ liệu đơn hàng.";
    }

    // Thống kê đơn hàng theo năm
    $query_year = "SELECT YEAR(create_time) AS year, COUNT(*) AS total_orders FROM orders GROUP BY YEAR(create_time)";
    $result_year = $conn->query($query_year);

    $years = [];
    $orders_year = [];

    if ($result_year->num_rows > 0) {
        while ($row = $result_year->fetch_assoc()) {
            $years[] = $row['year'];
            $orders_year[] = $row['total_orders'];
        }
    } else {
        echo "Không có dữ liệu đơn hàng.";
    }

    $conn->close();
    ?>

    <div class="chart-container">
        <canvas id="ordersChartMonth"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="ordersChartYear"></canvas>
    </div>

    <script>
        // Biểu đồ thống kê đơn hàng theo tháng
        const ctx_month = document.getElementById('ordersChartMonth').getContext('2d');
        const months = <?php echo json_encode($months); ?>;
        const orders_month = <?php echo json_encode($orders_month); ?>;
        
        const data_month = {
            labels: months,
            datasets: [{
                label: 'Số đơn hàng',
                data: orders_month,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        const config_month = {
            type: 'bar',
            data: data_month,
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng/Năm'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Số đơn hàng'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Thống kê số lượng đơn hàng theo tháng'
                    }
                }
            },
        };

        const ordersChartMonth = new Chart(ctx_month, config_month);

        // Biểu đồ thống kê đơn hàng theo năm
        const ctx_year = document.getElementById('ordersChartYear').getContext('2d');
        const years = <?php echo json_encode($years); ?>;
        const orders_year = <?php echo json_encode($orders_year); ?>;
        
        const data_year = {
            labels: years,
            datasets: [{
                label: 'Số đơn hàng',
                data: orders_year,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config_year = {
            type: 'bar',
            data: data_year,
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Năm'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Số đơn hàng'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Thống kê số lượng đơn hàng theo năm'
                    }
                }
            },
        };

        const ordersChartYear = new Chart(ctx_year, config_year);
    </script>
</body>
</html>
