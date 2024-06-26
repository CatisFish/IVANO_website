<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Sizes - Colors Management</title>

    <style>
        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            width: 50%;
        }
        .form-container input[type=text] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-container input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .form-container input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- Form thêm mới Size -->
        <div class="form-container">
            <h3>Thêm mới Size</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="size_name" placeholder="Nhập tên Size" required>
                <input type="submit" name="add_size" value="Thêm Size">
            </form>
        </div>

        <!-- Form thêm mới Color Suffix -->
        <div class="form-container">
            <h3>Thêm mới Color Suffix</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="color_suffix_name" placeholder="Nhập tên Color Suffix" required>
                <input type="submit" name="add_color_suffix" value="Thêm Color Suffix">
            </form>
        </div>

        <!-- Danh sách Sizes -->
        <h3>Danh sách Sizes</h3>
        <?php
        include '../php/conection.php';

        // Thêm mới Size
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_size"])) {
            $sizeName = $_POST["size_name"];

            $sql = "INSERT INTO sizes (size_name) VALUES ('$sizeName')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Thêm Size thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Xóa Size
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_size"])) {
            $sizeId = $_POST["size_id"];

            $sql = "DELETE FROM sizes WHERE size_id='$sizeId'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Xóa Size thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Sửa đổi Size
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_size"])) {
            $sizeId = $_POST["size_id"];
            $newSizeName = $_POST["new_size_name"];

            $sql = "UPDATE sizes SET size_name='$newSizeName' WHERE size_id='$sizeId'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Cập nhật Size thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Danh sách Sizes
        $sqlSizes = "SELECT * FROM sizes";
        $resultSizes = $conn->query($sqlSizes);

        if ($resultSizes->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Tên Size</th><th>Thao tác</th></tr>";
            while ($row = $resultSizes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["size_id"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='size_id' value='" . $row["size_id"] . "'>";
                echo "<input type='text' name='new_size_name' value='" . $row["size_name"] . "' required>";
                echo "</td>";
                echo "<td>";
                echo "<input type='submit' name='edit_size' value='Cập nhật'>";
                echo "<input type='submit' name='delete_size' value='Xóa'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Không có dữ liệu Size.</p>";
        }

        // Thêm mới Color Suffix
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_color_suffix"])) {
            $colorSuffixName = $_POST["color_suffix_name"];

            $sql = "INSERT INTO colorsuffix (color_suffix_name) VALUES ('$colorSuffixName')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Thêm Color Suffix thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Xóa Color Suffix
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_color_suffix"])) {
            $colorSuffixId = $_POST["color_suffix_id"];

            $sql = "DELETE FROM colorsuffix WHERE color_suffix_id='$colorSuffixId'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Xóa Color Suffix thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Sửa đổi Color Suffix
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_color_suffix"])) {
            $colorSuffixId = $_POST["color_suffix_id"];
            $newColorSuffixName = $_POST["new_color_suffix_name"];

            $sql = "UPDATE colorsuffix SET color_suffix_name='$newColorSuffixName' WHERE color_suffix_id='$colorSuffixId'";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Cập nhật Color Suffix thành công</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Danh sách Color Suffix
        $sqlColorSuffix = "SELECT * FROM colorsuffix";
        $resultColorSuffix = $conn->query($sqlColorSuffix);

        if ($resultColorSuffix->num_rows > 0) {
            echo "<h3>Danh sách Color Suffix</h3>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Tên Color Suffix</th><th>Thao tác</th></tr>";
            while ($row = $resultColorSuffix->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["color_suffix_id"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='color_suffix_id' value='" . $row["color_suffix_id"] . "'>";
                echo "<input type='text' name='new_color_suffix_name' value='" . $row["color_suffix_name"] . "' required>";
                echo "</td>";
                echo "<td>";
                echo "<input type='submit' name='edit_color_suffix' value='Cập nhật'>";
                echo "<input type='submit' name='delete_color_suffix' value='Xóa'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                }
                echo "</table>";
                } else {
                echo "<p>Không có dữ liệu Color Suffix.</p>";
                }
                $conn->close();
                ?>
            </div>
            </body>
            </html>
