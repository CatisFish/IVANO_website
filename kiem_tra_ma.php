<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối đến cơ sở dữ liệu
include 'php/conection.php'; // Đảm bảo rằng tệp connection.php nằm trong đúng thư mục và đã chứa thông tin kết nối

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

    // SQL query để kiểm tra mã giảm giá
    $sql = "SELECT * FROM vouchers WHERE voucher_code = '$voucher_code' AND status = 'issued'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Mã giảm giá tồn tại và có hiệu lực
        $row = mysqli_fetch_assoc($result);
        
        // Lấy thông tin giảm giá từ cơ sở dữ liệu
        $discount_amount = $row['discount_amount'];
        $discount_percentage = $row['discount_percentage'];

        // Trả về dữ liệu dưới dạng JSON
        $response = array(
            'success' => true,
            'discount_amount' => $discount_amount,
            'discount_percentage' => $discount_percentage
        );
        echo json_encode($response);
    } else {
        // Mã giảm giá không tồn tại hoặc không có hiệu lực
        $response = array(
            'success' => false,
            'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
        );
        echo json_encode($response);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
