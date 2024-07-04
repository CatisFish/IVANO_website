<?php
// Kết nối đến cơ sở dữ liệu
include '../connectDB.php';

// Xóa các voucher có trạng thái "used" và tồn tại hơn 1 ngày
$sql_delete_old_vouchers = "DELETE FROM vouchers WHERE status = 'used' AND create_date < NOW() - INTERVAL 1 DAY";
if ($conn->query($sql_delete_old_vouchers) === TRUE) {
    echo "Các voucher cũ đã được xóa thành công.";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>

<!-- Mở terminal và nhập lệnh crontab -e để mở trình chỉnh sửa cron job.

Thêm dòng sau vào file crontab:

sh
Sao chép mã
0 0 * * * /usr/bin/php /path/to/your/delete_old_vouchers.php
Dòng này sẽ chạy script PHP mỗi ngày vào lúc 00:00 (nửa đêm).

Thay /path/to/your/delete_old_vouchers.php bằng đường dẫn đầy đủ: C:\xampp\htdocs\IVANO_website\admin\action-admin\delete_old_vouchers.php bằng đường dẫn này.

Lưu và thoát khỏi trình chỉnh sửa.

Với thiết lập này, script PHP delete_old_vouchers.php sẽ tự động chạy mỗi ngày và xóa các voucher có trạng thái "used" đã tồn tại hơn 1 ngày.

 -->
