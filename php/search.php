<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <style>
        /* CSS cho các phần input và button */
        input[type="text"],
        textarea,
        select,
        button {
            width: calc(100% - 22px);
            /* Độ rộng của phần tử input và select */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            /* Loại bỏ viền xung quanh khi focus */
        }

        input[type="file"] {
            margin-top: 10px;
        }

        /* CSS cho nút */
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #f2f2f2;
        }

        table img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }

        table td a {
            text-decoration: none;
            margin-right: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Kết quả tìm kiếm</h1>

    <!-- Thanh tìm kiếm -->
    <form method="GET" action="search.php">
        <input type="text" name="search" placeholder="Tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách sản phẩm -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <!-- Thêm cột cho danh mục và thương hiệu nếu cần -->
                <th>Ảnh</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kết nối đến cơ sở dữ liệu
            include 'conection.php'; // Thay đổi tên file và đường dẫn nếu cần
            
            // Khởi tạo biến mảng chứa kết quả tìm kiếm
            $search_results = array();

            // Xử lý tìm kiếm
            if (isset($_GET['search'])) {
                $keyword = $_GET['search'];
                // Viết câu truy vấn SQL để lọc sản phẩm dựa trên từ khóa tìm kiếm
                $sql = "SELECT p.*, i.path_image FROM products p LEFT JOIN product_images i ON p.product_id = i.product_id WHERE p.product_name LIKE '%$keyword%' OR p.product_description LIKE '%$keyword%'";
                $result = $conn->query($sql);

                // Kiểm tra kết quả trả về
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Thêm dòng dữ liệu vào mảng kết quả
                        $search_results[] = $row;
                    }
                }
            }

            // Hiển thị kết quả tìm kiếm
            if (!empty($search_results)) {
                foreach ($search_results as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['product_id'] . "</td>";
                    echo "<td>" . $product['product_name'] . "</td>";
                    echo "<td>" . $product['product_description'] . "</td>";
                    echo "<td>" . $product['product_price'] . "</td>";
                    // Hiển thị ảnh sản phẩm nếu có
                    echo "<td>";
                    if (!empty($product['path_image'])) {
                        echo '<img src="../admin/' . $product['path_image'] . '" width="100" height="100">';
                    } else {
                        echo "Không có ảnh";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có kết quả tìm kiếm.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $conn->close(); // Đóng kết nối đến cơ sở dữ liệu
    ?>
</body>

</html>