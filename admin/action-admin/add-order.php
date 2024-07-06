<?php
include "../php/conection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $od_name = $_POST['od_name'];
    $od_tell = $_POST['od_tell'];
    $receiver_tell = $_POST['receiver_tell'];
    $street = $_POST['street'];
    $ward = $_POST['ward'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $address = "$street, $ward, $district, $city";
    $od_info = $_POST['od_info'];
    $od_note = $_POST['od_note'];
    $od_total_price = $_POST['od_total_price'];
    $payment_method = $_POST['payment_method'];
    $wherehouse = ""; 
    $employee_id = ""; 

    $conn->begin_transaction();

    try {
        // Tạo mã đơn hàng
        $sql_insert_orders = "INSERT INTO orders (od_id, od_name, od_tell, receiver_tell, od_address, od_note, od_total_price, payment_method, wherehouse, employee_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_orders = $conn->prepare($sql_insert_orders);
        $stmt_orders->bind_param("ssssssssss", $od_id, $od_name, $od_tell, $receiver_tell, $address, $od_note, $od_total_price, $payment_method, $wherehouse, $employee_id);

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

        $stmt_orders->execute();

        // Lưu chi tiết đơn hàng
        $sql_insert_order_details = "INSERT INTO order_details (od_id, od_info) VALUES (?, ?)";
        $stmt_order_details = $conn->prepare($sql_insert_order_details);
        $stmt_order_details->bind_param("ss", $od_id, $od_info);
        $stmt_order_details->execute();

        // Commit transaction
        $conn->commit();

        echo "Order added successfully.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error adding order: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
</head>
<body>
    <h1>Add New Order</h1>
    <form action="" method="POST">
        <label for="od_name">Customer Name:</label>
        <input type="text" id="od_name" name="od_name" required><br>

        <label for="od_tell">Customer Phone:</label>
        <input type="text" id="od_tell" name="od_tell" required><br>

        <label for="receiver_tell">Receiver Phone:</label>
        <input type="text" id="receiver_tell" name="receiver_tell" required><br>

        <label for="street">Street:</label>
        <input type="text" id="street" name="street" required><br>

        <label for="ward">Ward:</label>
        <input type="text" id="ward" name="ward" required><br>

        <label for="district">District:</label>
        <input type="text" id="district" name="district" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="od_info">Order Info:</label>
        <textarea id="od_info" name="od_info" required></textarea><br>

        <label for="od_note">Note:</label>
        <textarea id="od_note" name="od_note" required></textarea><br>

        <label for="od_total_price">Total Price:</label>
        <input type="text" id="od_total_price" name="od_total_price" required><br>

        <label for="payment_method">Payment Method:</label>
        <input type="text" id="payment_method" name="payment_method" required><br>

        <button type="submit">Add Order</button>
    </form>
</body>
</html>
