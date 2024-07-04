<?php
include'../connectDB.php';
// Định nghĩa hàm kiểm tra xem có form tư vấn nào có trạng thái "Chưa Tư Vấn" hay không
function hasCauTuvan($conn) {
    $sql = "SELECT COUNT(*) AS count FROM agency WHERE TrangThai = '2'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    return 0;
}


$hasCauTuvan = hasCauTuvan($conn);
// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $trangthai = $_POST['trangthai'];

    // Cập nhật trạng thái vào bảng agency
    $sql_update = "UPDATE agency SET TrangThai = ? WHERE agency_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $trangthai, $id);

    // Thực thi câu lệnh SQL
    if ($stmt_update->execute()) {
        $success_message = "Cập nhật trạng thái thành công.";
    } else {
        $error_message = "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }

    // Đóng câu lệnh prepare
    $stmt_update->close();
}

// Lấy thông tin từ bảng agency và bảng trangthai
$sql = "SELECT agency.agency_id, agency.agency_name, agency.agency_tell, agency.agency_address, trangthai.ten_tt 
        FROM agency 
        LEFT JOIN trangthai ON agency.TrangThai = trangthai.id_tt
        ORDER BY agency.agency_id DESC";
$result = $conn->query($sql);

// Mảng chứa dữ liệu từ bảng agency
$agency_list = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agency_list[] = $row;
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
    <title>Danh Sách Đại Lý</title>
   
</head>

<body>
    <h2>Danh Sách Đại Lý</h2>
    <?php if (isset($success_message)): ?>
        <p class="message success"><?php echo $success_message; ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <p class="message error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Đại Lý</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Trạng Thái</th>
                <th>Chọn Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agency_list as $agency): ?>
                <tr>
                    <td><?php echo $agency['agency_id']; ?></td>
                    <td><?php echo $agency['agency_name']; ?></td>
                    <td><?php echo $agency['agency_tell']; ?></td>
                    <td><?php echo $agency['agency_address']; ?></td>
                    <td><?php echo isset($agency['ten_tt']) ? $agency['ten_tt'] : ''; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $agency['agency_id']; ?>">
                            <select name="trangthai">
                                <?php foreach ($trangthai_list as $trangthai): ?>
                                    <option value="<?php echo $trangthai['id_tt']; ?>" <?php if (isset($agency['TrangThai']) && $agency['TrangThai'] == $trangthai['id_tt']) echo 'selected'; ?>>
                                        <?php echo $trangthai['ten_tt']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Cập Nhật</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

