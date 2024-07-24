<?php
include "../connectDB.php";

if (isset($_GET['od_id'])) {
    $od_id = $_GET['od_id'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Delete from order_details first
        $sql_delete_details = "DELETE FROM order_details WHERE od_id = ?";
        $stmt_delete_details = $conn->prepare($sql_delete_details);
        $stmt_delete_details->bind_param("s", $od_id);
        $stmt_delete_details->execute();

        // Delete from orders
        $sql_delete_order = "DELETE FROM orders WHERE od_id = ?";
        $stmt_delete_order = $conn->prepare($sql_delete_order);
        $stmt_delete_order->bind_param("s", $od_id);
        $stmt_delete_order->execute();

        // Commit transaction
        $conn->commit();

        echo "Order deleted successfully.";
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo "Error deleting order: " . $e->getMessage();
    }
} else {
    echo "Order ID is required.";
}
?>
