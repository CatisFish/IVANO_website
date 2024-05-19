<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        margin-bottom: 20px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="file"] {
        margin-top: 10px;
    }

    button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    td img {
        display: block;
        max-width: 100px;
        height: auto;
        margin: auto;
    }

    .edit-form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .edit-form h2 {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .edit-form input[type="text"],
    .edit-form textarea {
        width: calc(100% - 22px);
        /* Adjust for padding and border */
        margin-bottom: 10px;
    }

    .edit-form button {
        width: 100%;
    }

    .edit-form input[type="file"] {
        margin-top: 10px;
    }

    .edit-form button {
        background-color: #008CBA;
    }

    .edit-form button:hover {
        background-color: #005F6B;
    }
</style>

<?php
include 'php/conection.php';

// Xử lý thêm mới quảng cáo
if (isset($_POST['add_advertisement'])) {
    $ad_name = $_POST['advertisement_name'];
    $ad_description = $_POST['advertisement_description'];

    // Xử lý tải lên hình ảnh
    $target_dir = "../admin/upload_advertisement/";
    $target_file = $target_dir . basename($_FILES["advertisement_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra hình ảnh có thực sự là hình ảnh không
    if (isset($_POST["add_advertisement"])) {
        $check = getimagesize($_FILES["advertisement_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Tập tin không phải là hình ảnh.";
            $uploadOk = 0;
        }
    }

    // Kiểm tra nếu tập tin đã tồn tại
    if (file_exists($target_file)) {
        echo "Xin lỗi, tập tin đã tồn tại.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tập tin
    if ($_FILES["advertisement_image"]["size"] > 500000) {
        echo "Xin lỗi, tập tin quá lớn.";
        $uploadOk = 0;
    }

    // Cho phép các định dạng tập tin được chấp nhận
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Xin lỗi, chỉ cho phép tải lên các tập tin JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk = 0
    if ($uploadOk == 0) {
        echo "Xin lỗi, tập tin của bạn không được tải lên.";
        // nếu mọi thứ đều ok, thì cố gắng tải lên tập tin
    } else {
        if (move_uploaded_file($_FILES["advertisement_image"]["tmp_name"], $target_file)) {
            // Thêm quảng cáo vào bảng advertisement cùng đường dẫn hình ảnh
            $ad_path_img = $target_file;
            $sql = "INSERT INTO advertisement (ad_name, ad_description, ad_path_img) VALUES ('$ad_name', '$ad_description', '$ad_path_img')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ad.php");
                exit();
            } else {
                echo "Lỗi khi thêm mới quảng cáo: " . $conn->error;
            }
        } else {
            echo "Xin lỗi, đã có lỗi xảy ra khi tải lên tập tin của bạn.";
        }
    }
}

// Xử lý xóa quảng cáo
if (isset($_GET['delete_advertisement'])) {
    $ad_id = $_GET['delete_advertisement'];

    // Xóa quảng cáo trong bảng advertisement
    $sql = "DELETE FROM advertisement WHERE ad_id=$ad_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ad.php");
        exit();
    } else {
        echo "Lỗi khi xóa quảng cáo: " . $conn->error;
    }
}

// Xử lý sửa quảng cáo
if (isset($_POST['edit_advertisement'])) {
    $ad_id = $_POST['ad_id'];
    $ad_name = $_POST['advertisement_name'];
    $ad_description = $_POST['advertisement_description'];

    // Kiểm tra xem người dùng có tải lên hình ảnh mới không
    if ($_FILES['advertisement_image']['size'] > 0) {
        $target_dir = "../admin/upload_advertisement/";
        $target_file = $target_dir . basename($_FILES["advertisement_image"]["name"]);
        if (move_uploaded_file($_FILES["advertisement_image"]["tmp_name"], $target_file)) {
            $ad_path_img = $target_file;
        } else {
            echo "Xin lỗi, đã có lỗi xảy ra khi tải lên tập tin mới.";
            exit();
        }
    }

    // Nếu không có hình ảnh mới, giữ nguyên đường dẫn cũ
    else {
        $sql_img = "SELECT ad_path_img FROM advertisement WHERE ad_id = $ad_id";
        $result_img = $conn->query($sql_img);
        if ($result_img->num_rows > 0) {
            $row_img = $result_img->fetch_assoc();
            $ad_path_img = $row_img['ad_path_img'];
        } else {
            echo "Không tìm thấy quảng cáo.";
            exit();
        }
    }

    // Cập nhật thông tin quảng cáo trong cơ sở dữ liệu
    $sql = "UPDATE advertisement SET ad_name='$ad_name', ad_description='$ad_description', ad_path_img='$ad_path_img' WHERE ad_id=$ad_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ad.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật quảng cáo: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các quảng cáo
$sql = "SELECT * FROM advertisement";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $advertisements = array();
    while ($row = $result->fetch_assoc()) {
        $advertisements[] = $row;
    }
} else {
    echo "Không có quảng cáo nào được tìm thấy.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý quảng cáo</title>
    <style>
        /* CSS đã được cung cấp trước đó */

        /* Thêm CSS cho form sửa */
        .edit-form {
            display: none;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>Quản lý quảng cáo</h1>

    <!-- Form thêm mới quảng cáo -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="advertisement_name" placeholder="Tên quảng cáo" required><br>
        <textarea name="advertisement_description" placeholder="Mô tả quảng cáo" required></textarea><br>
        <input type="file" name="advertisement_image"><br>
        <button type="submit" name="add_advertisement">Thêm</button>
    </form>
    <br>

    <!-- Form sửa quảng cáo -->
    <div class="edit-form">
        <h2>Sửa quảng cáo</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="ad_id" value="">
            <input type="text" name="advertisement_name" placeholder="Tên quảng cáo" value="" required><br>
            <textarea name="advertisement_description" placeholder="Mô tả quảng cáo" required></textarea><br>
            <input type="file" name="advertisement_image"><br>
            <button type="submit" name="edit_advertisement">Lưu</button>
        </form>
    </div>

    <!-- Bảng danh sách quảng cáo -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên quảng cáo</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($advertisements)): ?>
                <?php foreach ($advertisements as $ad): ?>
                    <tr>
                        <td><?php echo $ad['ad_id']; ?></td>
                        <td><?php echo $ad['ad_name']; ?></td>
                        <td><?php echo $ad['ad_description']; ?></td>
                        <td>
                            <?php if (!empty($ad['ad_path_img'])): ?>
                                <img src="<?php echo $ad['ad_path_img']; ?>" alt="Quảng cáo" width="100">
                            <?php else: ?>
                                Không có hình ảnh
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" class="edit-link" data-id="<?php echo $ad['ad_id']; ?>">Sửa</a>
                            <a href="ad.php?delete_advertisement=<?php echo $ad['ad_id']; ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa quảng cáo này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        // Hiển thị form sửa khi nhấn vào nút "Sửa"
        document.addEventListener('DOMContentLoaded', function () {
            var editLinks = document.querySelectorAll('.edit-link');
            var editForm = document.querySelector('.edit-form');

            editLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    var adId = this.getAttribute('data-id');
                    var form = document.querySelector('.edit-form form');

                    // Set giá trị cho các trường trong form sửa
                    form.querySelector('input[name="ad_id"]').value = adId;
                    form.querySelector('input[name="advertisement_name"]').value = this.parentElement.parentElement.children[1].innerText;
                    form.querySelector('textarea[name="advertisement_description"]').value = this.parentElement.parentElement.children[2].innerText;

                    // Hiển thị form sửa
                    editForm.style.display = 'block';
                });
            });
        });
    </script>
</body>

</html>

<?php
// Đóng kết nối
$conn->close();
?>