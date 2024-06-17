<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../php/conection.php";

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
        $od_id = "OD000001"; 
    }

    $conn->begin_transaction();

    try {
        $sql_insert_orders = "INSERT INTO orders (od_id, od_name, od_tell, receiver_tell, od_address, od_note, od_total_price, payment_method, wherehouse, employee_id)
            VALUES ('$od_id', '$od_name', '$od_tell', '$receiver_tell', '$address', '$od_note', '$od_total_price', '$payment_method', '$wherehouse', '$employee_id')";

        if (!$conn->query($sql_insert_orders)) {
            throw new Exception("Lỗi khi chèn dữ liệu vào bảng orders: " . $conn->error);
        }

        $sql_insert_order_details = "INSERT INTO order_details (od_id, od_info) VALUES ('$od_id', '$od_info')";

        if (!$conn->query($sql_insert_order_details)) {
            throw new Exception("Lỗi khi chèn dữ liệu vào bảng order_details: " . $conn->error);
        }

        $conn->commit();
        
        echo "Thêm đơn hàng thành công.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Lỗi: " . $e->getMessage();
    }

    $conn->close();
}
?>
