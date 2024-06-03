<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Mã Màu</title>
    <style>
        .checkbox input[type="checkbox"] {
            width: 20px; /* Set width of checkbox */
            height: 20px; /* Set height of checkbox */
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            width: 90%;
        }

        h2 {
            text-align: center;
            color: #333333;
        }

        form {
            margin-bottom: 20px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        td.color {
            width: 100px;
            text-align: center;
        }

        td.hex {
            width: 100px;
            text-align: center;
        }

        td.group {
            width: 100px;
            text-align: center;
        }

        td.checkbox {
            width: 30px; /* Set width for the checkbox column */
            padding: 0 15px; /* Add padding to the left and right of the column */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        tr.selected td {
            background-color: #d1ffd1;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {text-decoration: underline;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
            }

            table, form {
                width: 100%;
            }
        }
    </style>
    <script>
        function toggleSelectAll(source) {
            checkboxes = document.getElementsByName('color_ids[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
                toggleRowHighlight(checkboxes[i]);
            }
        }

        function toggleRowHighlight(checkbox) {
            if (checkbox.checked) {
                checkbox.parentElement.parentElement.classList.add('selected');
            } else {
                checkbox.parentElement.parentElement.classList.remove('selected');
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Quản lý Mã Màu</h2>

     <!-- Tìm kiếm theo mã màu -->
     <form class="search-bar" action="colors.php" method="get">
        <div class="form-group">
            <label for="search_color">Tìm kiếm mã màu:</label>
            <input type="text" id="search_color" name="search_color" value="<?php echo isset($_GET['search_color']) ? htmlspecialchars($_GET['search_color']) : ''; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>

    <!-- Tìm kiếm theo mã hex -->
    <form class="search-bar" action="colors.php" method="get">
        <div class="form-group">
            <label for="search_hex">Tìm kiếm mã hex:</label>
            <input type="text" id="search_hex" name="search_hex" value="<?php echo isset($_GET['search_hex']) ? htmlspecialchars($_GET['search_hex']) : ''; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>
    <!-- Tìm kiếm theo nhóm màu -->
    <form class="search-bar" action="colors.php" method="get">
        <div class="form-group">
            <label for="search_group">Tìm kiếm theo nhóm màu:</label>
            <input type="text" id="search_group" name="search_group" value="<?php echo isset($_GET['search_group']) ? htmlspecialchars($_GET['search_group']) : ''; ?>">
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
            <label for="color_hex">Mã Hex:</label>
            <input type="text" id="color_hex" name="color_hex" required>
        </div>
        <div class="form-group"></div>
        <label for="color_group">Nhóm màu:</label>
            <input type="text" id="color_group" name="color_group" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Thêm Màu" name="add_color">
        </div>
    </form>

    <!-- Form thêm nhiều màu -->
<form action="process.php" method="post">
    <div class="form-group">
        <label for="multiple_colors">Nhiều mã màu (mỗi dòng chứa một cặp mã màu, mã hex và nhóm màu, cách nhau bằng dấu hai chấm):</label>
        <textarea id="multiple_colors" name="multiple_colors" rows="4" required></textarea>
        </div>
    <div class="form-group">
        <input type="submit" value="Thêm Nhiều Màu" name="add_multiple_colors">
    </div>
</form>


<!-- Hiển thị danh sách màu -->
<form action="process.php" method="post">
    <?php
    include './conection.php';

    $search_color = isset($_GET['search_color']) ? $_GET['search_color'] : '';
    $search_hex = isset($_GET['search_hex']) ? $_GET['search_hex'] : '';
    $search_group = isset($_GET['search_group']) ? $_GET['search_group'] : '';

    if ($search_group) {
        $sql = "SELECT * FROM colors WHERE color_group LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = '%' . $search_group . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } elseif ($search_color) {
        // Kiểm tra xem có từ khóa tìm kiếm mã màu không
        $sql = "SELECT * FROM colors WHERE color_code LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = '%' . $search_color . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } elseif ($search_hex) {
        // Kiểm tra xem có từ khóa tìm kiếm mã hex không
        $sql = "SELECT * FROM colors WHERE color_hex LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = '%' . $search_hex . '%';
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Truy vấn mặc định
        $sql = "SELECT * FROM colors";
        $result = $conn->query($sql);
    }
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th class='checkbox'><input type='checkbox' onClick='toggleSelectAll(this)'></th><th class='hidden'>ID</th><th>Mã màu</th><th>Mã Hex</th><th>Nhóm màu</th></tr>";
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            if ($count % 5 == 0) {
                echo "<tr>";
            }echo "<td class='checkbox'><input type='checkbox' name='color_ids[]' value='" . $row['color_id'] . "' onClick='toggleRowHighlight(this)'></td><td class='hidden'>" . $row['color_id'] . "</td><td class='color' style='background-color:" . $row['color_hex'] . ";'>" . $row['color_code'] . "</td><td class='hex'>" . $row['color_hex'] . "</td><td class='group'>" . $row['color_group'] . "</td>";
            $count++;
            if ($count % 5 == 0) {
                echo "</tr>";
            }
        }
        if ($count % 5 != 0) {
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class='form-group'><input type='submit' value='Xóa Màu Đã Chọn' name='delete_selected'></div>";
    } else {
        echo "Không có dữ liệu.";
    }

    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    ?>
</form>
</div>

</body>
</html>