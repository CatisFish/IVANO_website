<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Mã Màu</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td.color {
            width: 50px;
        }

        .container {
            margin: 20px auto;
            width: 50%;
        }

        form {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Quản lý Mã Màu</h2>

    <!-- Tìm kiếm màu -->
    <form class="search-bar" action="../php/colors.php" method="get">
        <div class="form-group">
            <label for="search">Tìm kiếm mã màu:</label>
            <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>

    <!-- Form thêm màu -->
    <form action="process.php" method="post">
        <div class="form-group">
            <label for="color_code">Mã màu:</label>
            <input type="text" id="color_code" name="color_code" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Thêm Màu" name="add_color">
        </div>
    </form>

    <!-- Form thêm nhiều màu -->
    <form action="process.php" method="post">
        <div class="form-group">
            <label for="multiple_colors">Nhiều mã màu (cách nhau bằng dấu phẩy):</label>
            <textarea id="multiple_colors" name="multiple_colors" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Thêm Nhiều Màu" name="add_multiple_colors">
        </div>
    </form>

    <!-- Hiển thị danh sách màu -->
    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Kiểm tra xem có từ khóa tìm kiếm không
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Truy vấn dữ liệu từ bảng colors
    if ($search) {
        $sql = "SELECT * FROM colors WHERE code_color LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = '%' . $search . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM colors";
        $result = $conn->query($sql);
    }

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Mã màu</th><th>Xóa</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['color_id'] . "</td><td class='color' style='background-color:" . $row['code_color'] . ";'>" . $row['code_color'] . "</td><td><a href='process.php?delete=" . $row['color_id'] . "'>Xóa</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    ?>
</div>

</body>
</html>
