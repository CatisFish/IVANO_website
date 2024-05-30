<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "ivano_website";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Định nghĩa hàm kiểm tra xem có form tư vấn nào có trạng thái "Chưa Tư Vấn" hay không
function hasChuaTuvan($conn) {
    $sql = "SELECT COUNT(*) AS count FROM tuvan_form WHERE TrangThai = '2'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
    return false;
}

$hasChuaTuvan = hasChuaTuvan($conn);

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $trangthai = $_POST['trangthai'];

    // Cập nhật trạng thái vào bảng tuvan_form
    $sql_update = "UPDATE tuvan_form SET TrangThai = ? WHERE id = ?";
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
                <th>Chọn Trạng Thái</th>
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
                                    <option value="<?php echo $trangthai['id_tt']; ?>" <?php if (isset($tuvan['TrangThai']) && $tuvan['TrangThai'] == $trangthai['id_tt'])
                                        echo 'selected'; ?>>
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
    <!-- Add your scripts here -->
</body>

</html>
