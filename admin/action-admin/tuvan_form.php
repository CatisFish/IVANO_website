<?php
include'../connectDB.php';

// Xử lý cập nhật
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $trangthai = $_POST['trangthai'];

    $sql_update = "UPDATE tuvan_form SET TrangThai = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $trangthai, $id);

    if ($stmt_update->execute()) {
        $success_message = "Cập nhật trạng thái thành công.";
        // Cập nhật lại danh sách
        header("Refresh:0"); // Tải lại trang sau khi cập nhật
    } else {
        $error_message = "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }
    $stmt_update->close();
}

// Xử lý xóa
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql_delete = "DELETE FROM tuvan_form WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("s", $id);

    if ($stmt_delete->execute()) {
        $success_message = "Xóa form tư vấn thành công.";
        // Cập nhật lại danh sách
        header("Refresh:0"); // Tải lại trang sau khi xóa
    } else {
        $error_message = "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }
    $stmt_delete->close();
}

// Xử lý thêm mới
if (isset($_POST['insert'])) {
    $ten = $_POST['ten'];
    $sodienthoai = $_POST['sodienthoai'];
    $trangthai = $_POST['trangthai'];

    $sql_insert = "INSERT INTO tuvan_form (ten, so_dien_thoai, TrangThai) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sss", $ten, $sodienthoai, $trangthai);

    if ($stmt_insert->execute()) {
        $success_message = "Thêm mới form tư vấn thành công.";
        // Cập nhật lại danh sách
        header("Refresh:0"); // Tải lại trang sau khi thêm mới
    } else {
        $error_message = "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }
    $stmt_insert->close();
}

// Lấy thông tin từ bảng tuvan_form và bảng trangthai
$sql = "SELECT tuvan_form.id, tuvan_form.ten, tuvan_form.so_dien_thoai, tuvan_form.ngay_gui, trangthai.ten_tt 
        FROM tuvan_form 
        LEFT JOIN trangthai ON tuvan_form.TrangThai = trangthai.id_tt
        ORDER BY tuvan_form.ngay_gui DESC";
$result = $conn->query($sql);

// Mảng chứa dữ liệu từ bảng tuvan_form
$tuvan_list = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tuvan_list[] = $row;
    }
}

// Lấy thông tin từ bảng trangthai
$sql_trangthai = "SELECT * FROM trangthai";
$result_trangthai = $conn->query($sql_trangthai);

// Mảng chứa dữ liệu từ bảng trangthai
$trangthai_list = [];
if ($result_trangthai->num_rows > 0) {
    while ($row = $result_trangthai->fetch_assoc()) {
        $trangthai_list[] = $row;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tư Vấn</title>
    <!-- Add your CSS styles here -->
    <style>
        .need-advice {
            color: red;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            padding: 20px 0;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin: 10px 0;
        }

        table {
            width: 80%;
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

        select, button {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
        }

        button:hover {
            background-color: #45a049;
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
    <h2>Danh Sách Tư Vấn</h2>
    <?php if (isset($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ Tên</th>
                <th>Số Điện Thoại</th>
                <th>Ngày Gửi</th>
                <th>Trạng Thái</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tuvan_list as $tuvan): ?>
                <tr>
                    <td><?php echo $tuvan['id']; ?></td>
                    <td><?php echo $tuvan['ten']; ?></td>
                    <td><?php echo $tuvan['so_dien_thoai']; ?></td>
                    <td><?php echo $tuvan['ngay_gui']; ?></td>
                    <td><?php echo isset($tuvan['ten_tt']) ? $tuvan['ten_tt'] : ''; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $tuvan['id']; ?>">
                            <select name="trangthai">
                                <?php foreach ($trangthai_list as $trangthai): ?>
                                    <option value="<?php echo $trangthai['id_tt']; ?>" <?php if (isset($tuvan['TrangThai']) && $tuvan['TrangThai'] == $trangthai['id_tt']) echo 'selected'; ?>>
                                        <?php echo $trangthai['ten_tt']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="update">Cập Nhật</button>
                            <button type="submit" name="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- <h2>Thêm Mới Form Tư Vấn</h2>
    <form method="POST" action="">
        <label for="ten">Họ Tên:</label>
        <input type="text" id="ten" name="ten" required>
        <label for="sodienthoai">Số Điện Thoại:</label>
        <input type="text" id="sodienthoai" name="sodienthoai" required>
        <label for="trangthai">Trạng Thái:</label>
        <select id="trangthai" name="trangthai" required>
            <?php foreach ($trangthai_list as $trangthai): ?>
                <option value="<?php echo $trangthai['id_tt']; ?>"><?php echo $trangthai['ten_tt']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="insert">Thêm Mới</button>

        </form> -->
    <script>
        // JavaScript confirmation for delete action
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa?');
        }
    </script></body>
<?php
include'../action-admin/agency_form.php';
?>
</html>
