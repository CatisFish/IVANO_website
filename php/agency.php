<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý agency</title>

</head>
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
<a href="../admin/index.php">Trở về trang chủ</a>

<body>

    <?php
    // Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối tùy vào cấu hình của bạn)
    include '../php/conection.php';
    include '../php/search_agency.php';
    // Thêm agency mới
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $tell = $_POST["tell"];
        $address = $_POST["address"];
        $note = $_POST["note"];

        // Upload ảnh vào thư mục
        $target_dir = "../admin/upload_agency/";
        $target_file = $target_dir . basename($_FILES["path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Kiểm tra xem tệp có phải là hình ảnh thực sự hay không
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["path"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Đây không phải file hình ảnh.";
                $uploadOk = 0;
            }
        }
        // Kiểm tra nếu tệp đã tồn tại
        if (file_exists($target_file)) {
            echo "Ảnh đã tồn tại.";
            $uploadOk = 0;
        }
        // Kiểm tra kích thước tệp
        if ($_FILES["path"]["size"] > 500000) {
            echo "Kích thước ảnh quá lớn.";
            $uploadOk = 0;
        }
        // Cho phép các định dạng tệp nhất định
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Chỉ hỗ trợ file ảnh JPG, JPEG, PNG & GIF .";
            $uploadOk = 0;
        }
        // Kiểm tra nếu $uploadOk không bị lỗi
        if ($uploadOk == 0) {
            echo "Không thể upload file.";
            // Nếu mọi thứ đều ổn, hãy cố gắng tải lên tệp
        } else {
            if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["path"]["name"])) . " has been uploaded.";
                // Thêm agency vào cơ sở dữ liệu
                $sql = "INSERT INTO agency (agency_name, agency_mail, agency_tell, agency_address, agency_note, agency_path) VALUES ('$name', '$mail', '$tell', '$address', '$note', '$target_file')";
                if ($conn->query($sql) === TRUE) {
                    echo "Đã thêm vào đại lý mới";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Có lỗi trong quá trình tải ảnh.";
            }
        }
    }

    // Xóa agency
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
        $id = $_POST["id"];
        $path = $_POST["path"];
        // Xóa ảnh từ thư mục
        unlink($path);
        // Xóa dữ liệu từ cơ sở dữ liệu
        $sql = "DELETE FROM agency WHERE agency_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa sản phẩm thành công";
        } else {
            echo "Xóa không thành công: " . $conn->error;
        }
    }

    // Chỉnh sửa thông tin agency
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $tell = $_POST["tell"];
        $address = $_POST["address"];
        $note = $_POST["note"];
        $path = $_POST["path"];
        // Nếu có sự thay đổi ảnh
        if ($_FILES["new_path"]["name"] != '') {
            $new_target_file = $target_dir . basename($_FILES["new_path"]["name"]);
            // Upload ảnh mới và xóa ảnh cũ
            unlink($path);
            move_uploaded_file($_FILES["new_path"]["tmp_name"], $new_target_file);
            $path = $new_target_file;
        }
        // Cập nhật thông tin agency trong cơ sở dữ liệu
        $sql = "UPDATE agency SET agency_name='$name', agency_mail='$mail', agency_tell='$tell', agency_address='$address', agency_note='$note', agency_path='$path' WHERE agency_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thông tin đại lý thành công!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT agency_id, agency_name, agency_mail, agency_tell, agency_address, agency_note, agency_path FROM agency";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>STT</th><th>Tên đại lý</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Ghi chú</th><th>Hình ảnh</th><th>Thao tác</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<form method='post' action='' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='" . $row["agency_id"] . "'>";
            echo "<input type='hidden' name='path' value='" . $row["agency_path"] . "'>";
            echo "<td>" . $row["agency_id"] . "</td><td><input type='text' name='name' value='" . $row["agency_name"] . "'></td><td><input type='email' name='mail' value='" . $row["agency_mail"] . "'></td><td><input type='text' name='tell' value='" . $row["agency_tell"] . "'></td><td><input type='text' name='address' value='" . $row["agency_address"] . "'></td><td><input type='text' name='note' value='" . $row["agency_note"] . "'></td>";
            echo "<td><img src='" . $row["agency_path"] . "' height='100'></td>";
            echo "<td>";
            echo "<input type='file' name='new_path'><br>";
            echo "<input type='submit' name='edit' value='Cập nhật'>";
            echo "<input type='submit' name='delete' value='Xóa'>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

    <!-- Form thêm agency mới -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Tên đại lý:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="mail">Email:</label><br>
        <input type="email" id="mail" name="mail"><br>
        <label for="tell">Số điện thoại:</label><br>
        <input type="text" id="tell" name="tell"><br>
        <label for="address">Địa chỉ:</label><br>
        <input type="text" id="address" name="address"><br>
        <label for="note">Ghi chú:</label><br>
        <input type="text" id="note" name="note"><br>
        <label for="path">Hình ảnh:</label><br>
        <input type="file" id="path" name="path"><br><br>
        <input type="submit" name="add" value="Thêm đại lý">
    </form>

</body>

</html>