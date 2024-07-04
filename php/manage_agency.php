<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý agency</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
    padding: 20px 0;
}

.form-container,
.search-container {
    text-align: center;
    margin-bottom: 20px;
}

/* Thanh tìm kiếm */
.search-container {
    width: 300px;
    margin: 0 auto;
}

.search-container input[type="text"] {
    width: calc(100% - 120px);
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.search-container input[type="submit"] {
    width: 100px;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-container input[type="submit"]:hover {
    background-color: #45a049;
}

/* Bảng */
table {
    width: 100%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #f8f8f8;
    color: #333;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Các form */
form {
    width: 300px;
    margin: 0 auto;
}

form input[type="text"],
form input[type="email"],
form input[type="file"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

form input[type="submit"],
.toggle-button {
    width: 30%;
    margin: 10px;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form input[type="submit"]:hover,
.toggle-button:hover {
    background-color: #45a049;
}
.toggle-button {
    width: 30%;
    margin: 10px;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.toggle-button:hover {
    background-color: #45a049;
}

.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.form-col {
    flex: 1;
    padding: 0 10px;
}

.form-col label {
    display: block;
    margin-bottom: 5px;
}

.form-col input[type="text"],
.form-col input[type="email"],
.form-col input[type="file"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.form-col input[type="submit"] {
    width: 100%;
}

/* Thông báo */
.message {
    text-align: center;
    font-size: 16px;
    margin: 10px 0;
}

.message.success {
    color: green;
}

.message.error {
    color: red;
}

    </style>
</head>

<body>
    <h2>Quản lý agency</h2>

    <?php
    include '../php/conection.php';

    // Thêm agency mới
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $tell = $_POST["tell"];
        $address = $_POST["address"];
        $note = $_POST["note"];

        $target_dir = "../admin/upload_agency/";
        $target_file = $target_dir . basename($_FILES["path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
        
        if (file_exists($target_file)) {
            echo "Ảnh đã tồn tại.";
            $uploadOk = 0;
        }
        
        if ($_FILES["path"]["size"] > 500000) {
            echo "Kích thước ảnh quá lớn.";
            $uploadOk = 0;
        }
        
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Chỉ hỗ trợ file ảnh JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "Không thể upload file.";
        } else {
            if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["path"]["name"])) . " has been uploaded.";
                
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
        
        unlink($path);
        
        $sql = "DELETE FROM agency WHERE agency_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa sản phẩm thành công";
        } else {
            echo "Xóa không thành công: " . $conn->error;
        }
    }

    // Định nghĩa biến $target_dir
    $target_dir = "../admin/upload_agency/";
    // Chỉnh sửa thông tin agency
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $tell = $_POST["tell"];
        $address = $_POST["address"];
        $note = $_POST["note"];
        $path = $_POST["path"];
        
       // Kiểm tra xem có tệp hình ảnh mới được chọn hay không
if ($_FILES["new_path"]["name"] != '') {
    // Nếu có tệp mới, thực hiện di chuyển và cập nhật đường dẫn
    $new_target_file = $target_dir . basename($_FILES["new_path"]["name"]);
    
    unlink($path); // Xóa tệp cũ
    move_uploaded_file($_FILES["new_path"]["tmp_name"], $new_target_file); // Di chuyển tệp mới
    $path = $new_target_file; // Cập nhật đường dẫn mới
}

        
        $sql = "UPDATE agency SET agency_name='$name', agency_mail='$mail', agency_tell='$tell', agency_address='$address', agency_note='$note', agency_path='$path' WHERE agency_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thông tin đại lý thành công!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $searchKeyword = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
        $searchKeyword = $_GET["search"];
    }

    $sql = "SELECT agency_id, agency_name, agency_mail, agency_tell, agency_address, agency_note, agency_path FROM agency";
    if ($searchKeyword != "") {
        $sql .= " WHERE agency_name LIKE '%$searchKeyword%'";
    }
    $result = $conn->query($sql);

    ?>

    <div class="search-container">
        <button class="toggle-button" onclick="toggleForm('search-form')">Tìm kiếm đại lý</button>
        <div id="search-form" style="display:none;">
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="search" placeholder="Tìm kiếm đại lý..." value="<?php echo $searchKeyword; ?>">
                <input type="submit" value="Tìm kiếm">
            </form>
        </div>
    </div>

    <div class="form-container">
    <button class="toggle-button" onclick="toggleForm('add-form')">Thêm đại lý mới</button>
    <div id="add-form" style="display:none;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-col">
                    <label for="name">Tên đại lý:</label><br>
                    <input type="text" id="name" name="name" required><br>
                    <label for="mail">Email:</label><br>
                    <input type="email" id="mail" name="mail" required><br>
                    <label for="tell">Số điện thoại:</label><br>
                    <input type="text" id="tell" name="tell" required><br>
                </div>
                <div class="form-col">
                    <label for="address">Địa chỉ:</label><br>
                    <input type="text" id="address" name="address"><br>
                    <label for="note">Ghi chú:</label><br>
                    <input type="text" id="note" name="note"><br>
                    <label for="path">Hình ảnh:</label><br>
                    <input type="file" id="path" name="path"><br><br>
                </div>
            </div>
            <input type="submit" name="add" value="Thêm đại lý">
        </form>
    </div>
</div>


    <?php
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
        echo "<p class='message error'>Không tìm thấy kết quả</p>";
    }

    $conn->close();
    ?>

    <script>
        function toggleForm(formId) {
            var form = document.getElementById(formId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>

</html>
