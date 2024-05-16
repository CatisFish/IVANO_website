<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Color Suffix</title>
</head>
<body>
    <h2>Danh sách Color Suffix</h2>
    <form action="process.php" method="post">
        <label for="colorsuffix">Chọn Color Suffix:</label>
        <select name="colorsuffix" id="colorsuffix">
            <?php
            // Kết nối đến cơ sở dữ liệu
            $servername = "localhost"; // Tên máy chủ cơ sở dữ liệu
            $username = "root"; // Tên người dùng MySQL
            $password = ""; // Mật khẩu MySQL
            $database = "ivano_website"; // Tên cơ sở dữ liệu

            // Tạo kết nối
            $conn = new mysqli($servername, $username, $password, $database);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            // Truy vấn để lấy danh sách các color suffix
            $sql = "SELECT * FROM colorsuffix";
            $result = $conn->query($sql);

            // Hiển thị danh sách color suffix trong dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['color_suffix_name'] . "'>" . $row['color_suffix_name'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có color suffix nào</option>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </select>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
