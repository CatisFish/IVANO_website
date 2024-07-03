<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối đến cơ sở dữ liệu
include 'php/conection.php'; // Đảm bảo rằng tệp connection.php nằm trong đúng thư mục và đã chứa thông tin kết nối

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy mã giảm giá và tổng tiền đơn hàng từ form
    $voucher_code = $_POST['voucher_code'];
    $total_order_amount = $_POST['total_order_amount'];

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        $response = array(
            'success' => false,
            'message' => 'Không thể kết nối đến cơ sở dữ liệu.'
        );
        echo json_encode($response);
        exit;
    }

    // SQL query để kiểm tra mã giảm giá và thông tin về giảm giá
    $sql = "SELECT v.discount_amount, v.discount_percentage, ib.max_discount, ib.total_amount
            FROM vouchers v 
            JOIN issue_batches ib ON v.batch_id = ib.batch_id 
            WHERE v.voucher_code = '$voucher_code' AND v.status = 'issued'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Mã giảm giá tồn tại và có hiệu lực
        $row = mysqli_fetch_assoc($result);

        // Lấy thông tin giảm giá từ cơ sở dữ liệu
        $discount_amount = $row['discount_amount'];
        $discount_percentage = $row['discount_percentage'];
        $max_discount = $row['max_discount'];
        $issue_batch_total_amount = $row['total_amount'];

        // Kiểm tra nếu tổng tiền đơn hàng đủ điều kiện áp dụng mã giảm giá
        if ($total_order_amount >= $issue_batch_total_amount) {
            // Tính toán giảm giá dựa trên tổng tiền đơn hàng và phần trăm giảm giá
            if ($discount_percentage > 0) {
                $calculated_discount = $total_order_amount * ($discount_percentage / 100);
                $discount_amount = min($max_discount, $calculated_discount);
            }

            // Nếu giảm giá tính được vượt quá giá trị giảm giá tối đa, sử dụng giảm giá tối đa
            $discount_amount = min($discount_amount, $max_discount);

            // Trả về dữ liệu dưới dạng JSON
            $response = array(
                'success' => true,
                'discount_amount' => $discount_amount,
                'discount_percentage' => $discount_percentage
            );
            echo json_encode($response);
        } else {
            // Đơn hàng không đủ điều kiện áp dụng mã giảm giá
            $response = array(
                'success' => false,
                'message' => 'Tổng tiền đơn hàng chưa đạt yêu cầu để áp dụng mã giảm giá.'
            );
            echo json_encode($response);
        }
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
