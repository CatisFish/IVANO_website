<?php
include "../connectDB.php";

if (isset($_GET['od_id'])) {
    $od_id = $_GET['od_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $od_name = $_POST['od_name'];
        $od_tell = $_POST['od_tell'];
        $receiver_tell = $_POST['receiver_tell'];
        $address = $_POST['address'];
        $od_total_price = $_POST['od_total_price'];
        $payment_method = $_POST['payment_method'];
        $od_note = $_POST['od_note'];

        $sql_update = "UPDATE orders SET od_name = ?, od_tell = ?, receiver_tell = ?, od_address = ?, od_total_price = ?, payment_method = ?, od_note = ? WHERE od_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssss", $od_name, $od_tell, $receiver_tell, $address, $od_total_price, $payment_method, $od_note, $od_id);

        if ($stmt_update->execute()) {
            echo "Order updated successfully.";
        } else {
            echo "Error updating order.";
        }
    } else {
        $sql = "SELECT * FROM orders WHERE od_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $od_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
        } else {
            echo "Order not found.";
            exit;
        }
    }
} else {
    echo "Order ID is required.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <a href="../../admin/index.php">Quay về trang chính</a>

    <title>Edit Order</title>
</head>
<body>
<a href="../../admin/index.php">Quay về trang chính</a>

    <h1>Edit Order</h1>
    <form action="" method="POST">
        <label for="od_name">Customer Name:</label>
        <input type="text" id="od_name" name="od_name" value="<?php echo $order['od_name']; ?>" required><br>

        <label for="od_tell">Customer Phone:</label>
        <input type="text" id="od_tell" name="od_tell" value="<?php echo $order['od_tell']; ?>" required><br>

        <label for="receiver_tell">Receiver Phone:</label>
        <input type="text" id="receiver_tell" name="receiver_tell" value="<?php echo $order['receiver_tell']; ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $order['od_address']; ?>" required><br>

        <label for="od_total_price">Total Price:</label>
        <input type="text" id="od_total_price" name="od_total_price" value="<?php echo $order['od_total_price']; ?>" required><br>

        <label for="payment_method">Payment Method:</label>
        <input type="text" id="payment_method" name="payment_method" value="<?php echo $order['payment_method']; ?>" required><br>

        <label for="od_note">Note:</label>
        <textarea id="od_note" name="od_note" required><?php echo $order['od_note']; ?></textarea><br>

        <button type="submit">Update Order</button>
    </form>
</body>
</html>
