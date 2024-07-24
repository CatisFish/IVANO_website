<?php
// Kết nối đến cơ sở dữ liệu
include '../connectDB.php';

// Xử lý thêm mới nhân viên
if (isset($_POST['add_employee'])) {
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $employee_email = $_POST['employee_email'];
    $employee_tel = $_POST['employee_tel'];
    $employee_address = $_POST['employee_address'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $nguoiquanly = $_POST['nguoiquanly'];
    $diachivanphong = $_POST['diachivanphong'];
    $nhanhieuban = $_POST['nhanhieu_ban'];
    $doanhso = $_POST['doanhso'];
    $kyluat = $_POST['kyluat'];
    $khenthuong = $_POST['khenthuong'];

    // Thêm nhân viên vào bảng employees
    $sql_employee = "INSERT INTO employees (employee_id, employee_name, employee_email, employee_tel, employee_address, start_time, end_time, nguoiquanly, diachivanphong, nhanhieu_ban, doanhso, kyluat, khenthuong) VALUES ('$employee_id', '$employee_name', '$employee_email', '$employee_tel', '$employee_address', '$start_time', '$end_time', '$nguoiquanly', '$diachivanphong', '$nhanhieuban', '$doanhso', '$kyluat', '$khenthuong')";
    if ($conn->query($sql_employee) === TRUE) {
        header("Location: ..employee.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới nhân viên: " . $conn->error;
    }
}

// Xử lý xóa nhân viên
if (isset($_GET['delete_employee'])) {
    $employee_id = $_GET['delete_employee'];
    $sql_delete_employee = "DELETE FROM employees WHERE employee_id='$employee_id'";
    if ($conn->query($sql_delete_employee) === TRUE) {
        header("Location: employee.php");
        exit();
    } else {
        echo "Lỗi khi xóa nhân viên: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các nhân viên
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $employees = array();
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
} else {
    echo "Không có nhân viên nào được tìm thấy.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<a href="../../admin/index.php">Quay về trang chính</a>

    <h1>Quản lý nhân viên</h1>

    <!-- Button to toggle add employee form -->
    <button class="add-emloyee-btn" onclick="toggleAddEmployeeForm()">Thêm nhân viên mới +</button>

    <!-- Form thêm mới nhân viên -->
    <div id="addEmployeeForm" style="display: none;">
        <form method="POST" action="">
            <input type="text" name="employee_id" placeholder="Mã nhân viên" required><br>
            <input type="text" name="employee_name" placeholder="Tên nhân viên" required><br>
            <input type="email" name="employee_email" placeholder="Email" required><br>
            <input type="tel" name="employee_tel" placeholder="Số điện thoại" required><br>
            <textarea name="employee_address" placeholder="Địa chỉ" required></textarea><br>
            <input type="datetime-local" name="start_time" required><br>
            <input type="datetime-local" name="end_time" required><br>
            <input type="text" name="nguoiquanly" placeholder="Người quản lý" required><br>
            <input type="text" name="diachivanphong" placeholder="Địa chỉ văn phòng" required><br>
            <input type="text" name="nhanhieu_ban" placeholder="Nhãn hiệu/Ban" required><br>
            <input type="text" name="doanhso" placeholder="Doanh số" required><br>
            <input type="text" name="kyluat" placeholder="Kỷ luật" required><br>
            <input type="text" name="khenthuong" placeholder="Khen thưởng" required><br>
            <button class="add-emloyee-btn" type="submit" name="add_employee">Thêm</button>
        </form>
    </div>

    <!-- Bảng danh sách nhân viên -->
    <table border="1">
        <thead>
            <tr>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
                <th>Người quản lý</th>
                <th>Địa chỉ văn phòng</th>
                <th>Nhãn hiệu/Ban</th>
                <th>Doanh số</th>
                <th>Kỷ luật</th>
                <th>Khen thưởng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($employees)): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee['employee_id']; ?></td>
                        <td><?php echo $employee['employee_name']; ?></td>
                        <td><?php echo $employee['employee_email']; ?></td>
                        <td><?php echo $employee['employee_tel']; ?></td>
                        <td><?php echo $employee['employee_address']; ?></td>
                        <td><?php echo $employee['start_time']; ?></td>
                        <td><?php echo $employee['end_time']; ?></td>
                        <td><?php echo $employee['nguoiquanly']; ?></td>
                        <td><?php echo $employee['diachivanphong']; ?></td>
                        <td><?php echo $employee['nhanhieu_ban']; ?></td>
                        <td><?php echo $employee['doanhso']; ?></td>
                        <td><?php echo $employee['kyluat']; ?></td>
                        <td><?php echo $employee['khenthuong']; ?></td>
                        <td>

                            <a class="edit-btn"
                                href="edit_employee.php?employee_id=<?php echo $employee['employee_id']; ?>">Sửa</a>
                            <a class="delete-btn" href="employee.php?delete_employee=<?php echo $employee['employee_id']; ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">Xóa</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13">Không có nhân viên nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


    <?php
    $conn->close();
    ?>

</body>

</html>


<style>

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f2f2f2;
        margin: 20px;
    }

    h1 {
        text-align: center;
    }

    button.add-emloyee-btn {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button.add-emloyee-btn:hover {
        background-color: #00FF00;
    }

    #addEmployeeForm {
        margin: 20px auto;
        padding: 10px;
        width: 50%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    form input,
    form textarea,
    form button {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    form button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    form button:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    thead {
        background-color: #f2f2f2;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    td {
        vertical-align: middle;
    }

    td a {
        padding: 8px 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border-radius: 5px;
        margin: 5px;
    }

    td a.edit-btn {
        background-color: #0000FF;
        color: white;
        border: none;
    }

    td a.delete-btn {
        background-color: #f44336;
        color: white;
        border: none;
    }

    td a.edit-btn:hover {
        background-color: #45a049;
    }

    td a.delete-btn:hover {
        background-color: #d32f2f;
    }
</style>
<script>
    function toggleAddEmployeeForm() {
        var form = document.getElementById("addEmployeeForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }
</script>