<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối đến cơ sở dữ liệu
include '../php/conection.php'; // Đảm bảo rằng tệp conection.php nằm trong đúng thư mục

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy mã giảm giá từ form
    $voucher_code = $_POST['voucher_code'];

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        $response = array(
            'success' => false,
            'message' => 'Không thể kết nối đến cơ sở dữ liệu.'
        );
        echo json_encode($response);
        exit;
    }

    // SQL query để cập nhật trạng thái mã giảm giá
    $sql = "UPDATE vouchers SET status = 'used' WHERE voucher_code = '$voucher_code'";
    if (mysqli_query($conn, $sql)) {
        $response = array(
            'success' => true,
            'message' => 'Mã giảm giá đã được cập nhật thành công.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Cập nhật mã giảm giá thất bại.'
        );
    }
    echo json_encode($response);

    // Đóng kết nối
    mysqli_close($conn);
}
?>
