<?php
session_start();
include "../connectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Orders</h1>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by Customer Name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Receiver Phone</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $sql = "SELECT * FROM orders WHERE od_id LIKE ?";
            $stmt = $conn->prepare($sql);
            $search_param = "%$search%";
            $stmt->bind_param("s", $search_param);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['od_id']}</td>
                            <td>{$row['od_name']}</td>
                            <td>{$row['od_tell']}</td>
                            <td>{$row['receiver_tell']}</td>
                            <td>{$row['od_address']}</td>
                            <td>{$row['od_total_price']}</td>
                            <td>{$row['payment_method']}</td>
                            <td>{$row['od_note']}</td>
                            <td>
                                <a href='view-order.php?od_id={$row['od_id']}'>View</a> |
                                <a href='edit-order.php?od_id={$row['od_id']}'>Edit</a> |
                                <a href='delete-order.php?od_id={$row['od_id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
