<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Size</title>
</head>
<body>
    <h2>Danh sách Size</h2>
    <form action="process.php" method="post">
        <label for="size">Chọn Size:</label>
        <select name="size" id="size">
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

            // Truy vấn để lấy danh sách các size
            $sql = "SELECT * FROM sizes";
            $result = $conn->query($sql);

            // Hiển thị danh sách size trong dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['size_id'] . "'>" . $row['size_name'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có size nào</option>";
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
