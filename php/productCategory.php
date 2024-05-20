<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }

        .container {
            width: 40%;
            margin: 20px;
            padding: 20px;
        }

        .table-container {
            width: 55%;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
        }

        input[type=text],
        input[type=email],
        input[type=file] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-top: 4px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        img {
            max-width: 80px;
            max-height: 80px;
        }
    </style>
</head>
<a href="../admin/index.php">Trở về trang chủ</a>


<body>

    <?php
    // Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối tùy vào cấu hình của bạn)
    include '../php/conection.php';

    // Thêm loại sản phẩm mới
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
        $name = $_POST["name"];

        // Thêm loại sản phẩm vào cơ sở dữ liệu
        $sql = "INSERT INTO ProductCategory (ProductCategory_name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            echo "Thêm loại sản phẩm mới thành công!";
        } else {
            echo "Lỗi khi thêm loại sản phẩm: " . $conn->error;
        }
    }

    // Xóa loại sản phẩm
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
        $id = $_POST["id"];
        
        // Xóa loại sản phẩm khỏi cơ sở dữ liệu
        $sql = "DELETE FROM ProductCategory WHERE ProductCategory_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa loại sản phẩm thành công!";
        } else {
            echo "Lỗi khi xóa loại sản phẩm: " . $conn->error;
        }
    }

    // Sửa loại sản phẩm
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];

        // Cập nhật thông tin loại sản phẩm trong cơ sở dữ liệu
        $sql = "UPDATE ProductCategory SET ProductCategory_name='$name' WHERE ProductCategory_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thông tin loại sản phẩm thành công!";
        } else {
            echo "Lỗi khi cập nhật thông tin loại sản phẩm: " . $conn->error;
        }
    }

    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT ProductCategory_id, ProductCategory_name FROM ProductCategory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Tên loại sản phẩm</th><th>Thao tác</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='id' value='" . $row["ProductCategory_id"] . "'>";
            echo "<td>" . $row["ProductCategory_id"] . "</td><td><input type='text' name='name' value='" . $row["ProductCategory_name"] . "'></td>";
            echo "<td><input type='submit' name='edit' value='Lưu'><input type='submit' name='delete' value='Xóa'></td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    $conn->close();
    ?>

    <!-- Form thêm loại sản phẩm mới -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Tên loại sản phẩm:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <input type="submit" name="add" value="Thêm loại sản phẩm">
    </form>

</body>

</html>
