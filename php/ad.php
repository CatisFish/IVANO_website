<?php
include '../php/conection.php';

// Xử lý thêm mới quảng cáo
if (isset($_POST['add_advertisement'])) {
    $ad_name = $_POST['advertisement_name'];
    $ad_description = $_POST['advertisement_description'];

    // Xử lý tải lên hình ảnh
    $target_dir = "../admin/uploads/";
    $target_file = $target_dir . basename($_FILES["advertisement_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Kiểm tra hình ảnh có thực sự là hình ảnh không
    if(isset($_POST["add_advertisement"])) {
        $check = getimagesize($_FILES["advertisement_image"]["tmp_name"]);
        if($check !== false) {
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
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
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
            $ad_image = $target_file;
            $sql = "INSERT INTO advertisement (ad_name, ad_description, ad_image) VALUES ('$ad_name', '$ad_description', '$ad_image')";
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
            <?php if (!empty($advertisements)) : ?>
                <?php foreach ($advertisements as $ad) : ?>
                    <tr>
                        <td><?php echo $ad['ad_id']; ?></td>
                        <td><?php echo $ad['ad_name']; ?></td>
                        <td><?php echo $ad['ad_description']; ?></td>
                        <td>
                            <?php if (!empty($ad['ad_image'])) : ?>
                                <img src="<?php echo $ad['ad_image']; ?>" alt="Quảng cáo" width="100">
                            <?php else: ?>
                                Không có hình ảnh
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="ad.php?delete_advertisement=<?php echo $ad['ad_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa quảng cáo này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
