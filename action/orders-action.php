<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../php/conection.php";

    // Lấy dữ liệu từ form
    $od_name = $_POST['name-orders'];
    $od_tell = $_POST['od_tel'];
    $receiver_tell = $_POST['receiver_tell'];

    $street = $_POST['street'];
    $ward = $_POST['ward'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $address = "$street, $ward, $district, $city";

    $od_info = $_POST["orders-info"];
    $od_note = $_POST['note'];
    $od_total_price = $_POST['od-total-price'];

    $payment_method = $_POST['payment-method'];

    $wherehouse = ""; // Nếu không có dữ liệu kho
    $employee_id = ""; // Nếu không có dữ liệu mã nhân viên

    // Bắt đầu transaction
    $conn->begin_transaction();

    try {
        // Tạo câu truy vấn để chèn dữ liệu vào bảng orders
        $sql_insert_orders = "INSERT INTO orders (od_id, od_name, od_tell, receiver_tell, od_address, od_note, od_total_price, payment_method, wherehouse, employee_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Sử dụng prepared statement để tránh SQL Injection
        $stmt_orders = $conn->prepare($sql_insert_orders);
        $stmt_orders->bind_param("ssssssssss", $od_id, $od_name, $od_tell, $receiver_tell, $address, $od_note, $od_total_price, $payment_method, $wherehouse, $employee_id);

        // Tạo ID đơn hàng dựa vào số lượng hiện tại trong bảng
        $sql_count = "SELECT COUNT(*) as count FROM orders";
        $result_count = $conn->query($sql_count);

        if ($result_count && $result_count->num_rows > 0) {
            $row = $result_count->fetch_assoc();
            $count = $row['count'] + 1;

            if ($count < 10) {
                $od_id = "OD00000" . $count;
            } elseif ($count < 100) {
                $od_id = "OD0000" . $count;
            } elseif ($count < 1000) {
                $od_id = "OD000" . $count;
            } else {
                $od_id = "OD" . $count;
            }
        } else {
            $od_id = "OD000001"; // Nếu không có dữ liệu, gán mặc định
        }

        // Thực thi câu truy vấn chèn đơn hàng
        $stmt_orders->execute();

        // Chèn dữ liệu vào bảng order_details
        $sql_insert_order_details = "INSERT INTO order_details (od_id, od_info) VALUES (?, ?)";
        $stmt_order_details = $conn->prepare($sql_insert_order_details);
        $stmt_order_details->bind_param("ss", $od_id, $od_info);
        $stmt_order_details->execute();

        // Cập nhật trạng thái voucher
        $voucher_code = $_POST['voucher_code'];
        if (!empty($voucher_code)) {
            $sql_update_voucher = "UPDATE vouchers SET status = 'Đã sử dụng' WHERE voucher_code = ?";
            $stmt_update_voucher = $conn->prepare($sql_update_voucher);
            $stmt_update_voucher->bind_param("s", $voucher_code);
            $stmt_update_voucher->execute();
            $stmt_update_voucher->close();
        }

        // Hoàn thành transaction
        $conn->commit();

        // Đóng prepared statement
        $stmt_orders->close();
        $stmt_order_details->close();

        // Trả về phản hồi JSON
        $response = array('status' => 'success', 'message' => 'Đặt hàng thành công!', 'od_id' => $od_id);
        echo json_encode($response);

    } catch (Exception $e) {
        // Nếu xảy ra lỗi, rollback transaction và trả về thông báo lỗi
        $conn->rollback();
        $response = array('status' => 'error', 'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage());
        echo json_encode($response);
    }

    // Đóng kết nối CSDL
    $conn->close();
}
?>
