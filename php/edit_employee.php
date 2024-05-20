<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin nhân viên</title>
</head>

<body>
    <h1>Sửa thông tin nhân viên</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../php/conection.php';

    // Kiểm tra xem có thông tin nhân viên cần sửa không
    if (isset($_GET['employee_id'])) {
        $employee_id = $_GET['employee_id'];

        // Truy vấn để lấy thông tin của nhân viên cần sửa
        $sql = "SELECT * FROM employees WHERE employee_id='$employee_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Lấy thông tin nhân viên từ kết quả truy vấn
            $employee = $result->fetch_assoc();
        } else {
            echo "Không tìm thấy thông tin của nhân viên.";
            exit(); // Kết thúc script nếu không tìm thấy thông tin nhân viên
        }
    } else {
        echo "Không có mã nhân viên được cung cấp.";
        exit(); // Kết thúc script nếu không có mã nhân viên được cung cấp
    }

    // Xử lý cập nhật thông tin nhân viên
    if (isset($_POST['update_employee'])) {
        $employee_id = $_POST['employee_id'];
        $employee_name = $_POST['employee_name'];
        $employee_email = $_POST['employee_email'];
        $employee_tel = $_POST['employee_tel'];
        $employee_address = $_POST['employee_address'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $nguoiquanly = $_POST['nguoiquanly'];
        $diachivanphong = $_POST['diachivanphong'];
        $nhanhieu_ban = $_POST['nhanhieu_ban'];
        $doanhso = $_POST['doanhso'];
        $kyluat = $_POST['kyluat'];
        $khenthuong = $_POST['khenthuong'];

        // Cập nhật thông tin nhân viên trong cơ sở dữ liệu
        $sql_update = "UPDATE employees SET 
                        employee_name='$employee_name', 
                        employee_email='$employee_email', 
                        employee_tel='$employee_tel', 
                        employee_address='$employee_address', 
                        start_time='$start_time', 
                        end_time='$end_time', 
                        nguoiquanly='$nguoiquanly', 
                        diachivanphong='$diachivanphong', 
                        nhanhieu_ban='$nhanhieu_ban', 
                        doanhso='$doanhso', 
                        kyluat='$kyluat', 
                        khenthuong='$khenthuong' 
                        WHERE employee_id='$employee_id'";

        if ($conn->query($sql_update) === TRUE) {
            echo "Cập nhật thông tin nhân viên thành công!";
            // Sau khi cập nhật thành công, chuyển hướng về trang danh sách nhân viên
            header("Location: ../php/employee.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật thông tin nhân viên: " . $conn->error;
        }
    }
    ?>

    <!-- Form sửa thông tin nhân viên -->
    <form method="POST" action="">
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">
        <input type="text" name="employee_name" value="<?php echo $employee['employee_name']; ?>" placeholder="Tên nhân viên" required><br>
        <input type="email" name="employee_email" value="<?php echo $employee['employee_email']; ?>" placeholder="Email" required><br>
        <input type="tel" name="employee_tel" value="<?php echo $employee['employee_tel']; ?>" placeholder="Số điện thoại" required><br>
        <textarea name="employee_address" placeholder="Địa chỉ" required><?php echo $employee['employee_address']; ?></textarea><br>
        <input type="datetime-local" name="start_time" value="<?php echo date('Y-m-d\TH:i', strtotime($employee['start_time'])); ?>" required><br>
        <input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i', strtotime($employee['end_time'])); ?>" required><br>
        <input type="text" name="nguoiquanly" value="<?php echo $employee['nguoiquanly']; ?>" placeholder="Người quản lý" required><br>
        <input type="text" name="diachivanphong" value="<?php echo $employee['diachivanphong']; ?>" placeholder="Địa chỉ văn phòng" required><br>
        <input type="text" name="nhanhieu_ban" value="<?php echo $employee['nhanhieu_ban']; ?>" placeholder="Nhãn hiệu/Ban" required><br>
        <input type="text" name="doanhso" value="<?php echo $employee['doanhso']; ?>" placeholder="Doanh số" required><br>
        <input type="text" name="kyluat" value="<?php echo $employee['kyluat']; ?>" placeholder="Kỷ luật" required><br>
        <input type="text" name="khenthuong" value="<?php echo $employee['khenthuong']; ?>" placeholder="Khen thưởng" required><br>
        <button type="submit" name="update_employee">Cập nhật</button>
    </form>

</body>

</html>
