<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            padding: 20px 0;
        }

        form {
            width: 60%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input,
        form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Sửa thông tin nhân viên</h1>

    <?php
    // Kết nối đến cơ sở dữ liệu
    include '../connectDB.php';

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
            header("Location: employee.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật thông tin nhân viên: " . $conn->error;
        }
    }
    ?>

    <!-- Form sửa thông tin nhân viên -->
    <form method="POST" action="">
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

        <label for="employee_name">Tên nhân viên:</label>
        <input type="text" id="employee_name" name="employee_name" value="<?php echo $employee['employee_name']; ?>" required><br>

        <label for="employee_email">Email:</label>
        <input type="email" id="employee_email" name="employee_email" value="<?php echo $employee['employee_email']; ?>" required><br>

        <label for="employee_tel">Số điện thoại:</label>
        <input type="tel" id="employee_tel" name="employee_tel" value="<?php echo $employee['employee_tel']; ?>" required><br>

        <label for="employee_address">Địa chỉ:</label>
        <textarea id="employee_address" name="employee_address" required><?php echo $employee['employee_address']; ?></textarea><br>

        <label for="start_time">Ngày bắt đầu:</label>
        <input type="datetime-local" id="start_time" name="start_time" value="<?php echo date('Y-m-d\TH:i', strtotime($employee['start_time'])); ?>" required><br>

        <label for="end_time">Ngày kết thúc:</label>
        <input type="datetime-local" id="end_time" name="end_time" value="<?php echo date('Y-m-d\TH:i', strtotime($employee['end_time'])); ?>" required><br>

        <label for="nguoiquanly">Người quản lý:</label>
        <input type="text" id="nguoiquanly" name="nguoiquanly" value="<?php echo $employee['nguoiquanly']; ?>" required><br>

        <label for="diachivanphong">Địa chỉ văn phòng:</label>
        <input type="text" id="diachivanphong" name="diachivanphong" value="<?php echo $employee['diachivanphong']; ?>" required><br>

        <label for="nhanhieu_ban">Nhãn hiệu/Ban:</label>
        <input type="text" id="nhanhieu_ban" name="nhanhieu_ban" value="<?php echo $employee['nhanhieu_ban']; ?>" required><br>

        <label for="doanhso">Doanh số:</label>
        <input type="text" id="doanhso" name="doanhso" value="<?php echo $employee['doanhso']; ?>" required><br>

        <label for="kyluat">Kỷ luật:</label>
        <input type="text" id="kyluat" name="kyluat" value="<?php echo $employee['kyluat']; ?>" required><br>

        <label for="khenthuong">Khen thưởng:</label>
        <input type="text" id="khenthuong" name="khenthuong" value="<?php echo $employee['khenthuong']; ?>" required><br>

        <button type="submit" name="update_employee">Cập nhật</button>
    </form>

</body>

</html>
