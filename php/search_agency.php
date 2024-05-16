<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý agency</title>
</head>

<style>
    /* CSS đã được cung cấp trước đó */

    /* Thêm CSS cho thanh tìm kiếm */
    .search-container {
        margin-bottom: 20px;
    }

    .search-container input[type=text] {
        width: 30%;
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .search-container input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-container input[type=submit]:hover {
        background-color: #45a049;
    }
</style>

<body>

    <?php
    // Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối tùy vào cấu hình của bạn)
    include '../php/conection.php';

    // Tìm kiếm trên cơ sở dữ liệu
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
        $searchKeyword = $_GET["search"];
        $sql = "SELECT agency_id, agency_name, agency_mail, agency_tell, agency_address, agency_note, agency_path 
                FROM agency 
                WHERE agency_name LIKE '%$searchKeyword%'"; // Sử dụng LIKE để tìm kiếm một phần của tên

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị kết quả tìm kiếm
            echo "<table>";
            echo "<tr><th>STT</th><th>Tên đại lý</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Ghi chú</th><th>Hình ảnh</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["agency_id"] . "</td><td>" . $row["agency_name"] . "</td><td>" . $row["agency_mail"] . "</td><td>" . $row["agency_tell"] . "</td><td>" . $row["agency_address"] . "</td><td>" . $row["agency_note"] . "</td><td><img src='" . $row["agency_path"] . "' height='100'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Không tìm thấy kết quả phù hợp.";
        }
    }
    ?>

    <!-- Form tìm kiếm -->
    <div class="search-container">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" placeholder="Nhập từ khóa..." name="search" required>
            <input type="submit" value="Tìm kiếm">
        </form>
    </div>

</body>

</html>
