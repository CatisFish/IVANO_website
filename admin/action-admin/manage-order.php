<?php
include "../connectDB.php";

// Handling adding a new order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_order'])) {
    $od_name = isset($_POST['od_name']) ? $_POST['od_name'] : '';
    $od_tell = isset($_POST['od_tell']) ? $_POST['od_tell'] : '';
    $receiver_tell = isset($_POST['receiver_tell']) ? $_POST['receiver_tell'] : '';
    $street = isset($_POST['street']) ? $_POST['street'] : '';
    $ward = isset($_POST['ward']) ? $_POST['ward'] : '';
    $district = isset($_POST['district']) ? $_POST['district'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $od_address = "$street, $ward, $district, $city";
    $od_note = isset($_POST['od_note']) ? $_POST['od_note'] : '';
    $od_total_price = isset($_POST['od_total_price']) ? $_POST['od_total_price'] : 0;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $wherehouse = isset($_POST['wherehouse']) ? $_POST['wherehouse'] : '';
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';

    // Prepare and execute SQL for inserting new order
    $sql_insert_order = "INSERT INTO orders (od_name, od_tell, receiver_tell, od_address, od_note, od_total_price, payment_method, wherehouse, employee_id, create_time)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt_insert_order = $conn->prepare($sql_insert_order);
    $stmt_insert_order->bind_param("sssssdssi", $od_name, $od_tell, $receiver_tell, $od_address, $od_note, $od_total_price, $payment_method, $wherehouse, $employee_id);
    
    if ($stmt_insert_order->execute()) {
        $last_id = $stmt_insert_order->insert_id;
        $stmt_insert_order->close();

        // Insert order details into order_details table
        $od_info = isset($_POST['od_info']) ? $_POST['od_info'] : '';
        $prepay = isset($_POST['prepay']) ? $_POST['prepay'] : 0;

        $sql_insert_order_detail = "INSERT INTO order_details (od_id, prepay, od_info) VALUES (?, ?, ?)";
        $stmt_insert_order_detail = $conn->prepare($sql_insert_order_detail);
        $stmt_insert_order_detail->bind_param("isd", $last_id, $prepay, $od_info);
        $stmt_insert_order_detail->execute();
        $stmt_insert_order_detail->close();

        // Return success response
        $response = array('status' => 'success', 'message' => 'Đã thêm đơn hàng thành công!', 'od_id' => $last_id);
    } else {
        // Return error message if insertion fails
        $response = array('status' => 'error', 'message' => 'Đã xảy ra lỗi khi thêm đơn hàng: ' . $conn->error);
    }

    echo json_encode($response);
    exit;
}

// Handling editing an existing order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_order'])) {
    $od_id = $_POST['od_id'];
    $od_name = isset($_POST['od_name']) ? $_POST['od_name'] : '';
    $od_tell = isset($_POST['od_tell']) ? $_POST['od_tell'] : '';
    $receiver_tell = isset($_POST['receiver_tell']) ? $_POST['receiver_tell'] : '';
    $street = isset($_POST['street']) ? $_POST['street'] : '';
    $ward = isset($_POST['ward']) ? $_POST['ward'] : '';
    $district = isset($_POST['district']) ? $_POST['district'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $od_address = "$street, $ward, $district, $city";
    $od_note = isset($_POST['od_note']) ? $_POST['od_note'] : '';
    $od_total_price = isset($_POST['od_total_price']) ? $_POST['od_total_price'] : 0;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $wherehouse = isset($_POST['wherehouse']) ? $_POST['wherehouse'] : '';
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';

    // Prepare and execute SQL for updating existing order
    $sql_update_order = "UPDATE orders SET od_name = ?, od_tell = ?, receiver_tell = ?, od_address = ?, od_note = ?, od_total_price = ?, payment_method = ?, wherehouse = ?, employee_id = ?
        WHERE od_id = ?";
    $stmt_update_order = $conn->prepare($sql_update_order);
    $stmt_update_order->bind_param("sssssdssis", $od_name, $od_tell, $receiver_tell, $od_address, $od_note, $od_total_price, $payment_method, $wherehouse, $employee_id, $od_id);
    
    if ($stmt_update_order->execute()) {
        $stmt_update_order->close();

        // Update order details in order_details table
        $od_info = isset($_POST['od_info']) ? $_POST['od_info'] : '';
        $prepay = isset($_POST['prepay']) ? $_POST['prepay'] : 0;

        $sql_update_order_detail = "UPDATE order_details SET prepay = ?, od_info = ? WHERE od_id = ?";
        $stmt_update_order_detail = $conn->prepare($sql_update_order_detail);
        $stmt_update_order_detail->bind_param("dsi", $prepay, $od_info, $od_id);
        $stmt_update_order_detail->execute();
        $stmt_update_order_detail->close();

        // Return success response
        $response = array('status' => 'success', 'message' => 'Đã cập nhật đơn hàng thành công!', 'od_id' => $od_id);
    } else {
        // Return error message if update fails
        $response = array('status' => 'error', 'message' => 'Đã xảy ra lỗi khi cập nhật đơn hàng: ' . $conn->error);
    }

    echo json_encode($response);
    exit;
}

// Handling deleting an order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $od_id = $_POST['od_id'];

    // Delete order from orders table
    $sql_delete_order = "DELETE FROM orders WHERE od_id = ?";
    $stmt_delete_order = $conn->prepare($sql_delete_order);
    $stmt_delete_order->bind_param("i", $od_id);
    
    if ($stmt_delete_order->execute()) {
        $stmt_delete_order->close();

        // Delete order details from order_details table
        $sql_delete_order_detail = "DELETE FROM order_details WHERE od_id = ?";
        $stmt_delete_order_detail = $conn->prepare($sql_delete_order_detail);
        $stmt_delete_order_detail->bind_param("i", $od_id);
        $stmt_delete_order_detail->execute();
        $stmt_delete_order_detail->close();

        // Return success response
        $response = array('status' => 'success', 'message' => 'Đã xóa đơn hàng thành công!', 'od_id' => $od_id);
    } else {
        // Return error message if deletion fails
        $response = array('status' => 'error', 'message' => 'Đã xảy ra lỗi khi xóa đơn hàng: ' . $conn->error);
    }

    echo json_encode($response);
    exit;
}

// Fetching list of orders from orders and order_details tables
$sql_select_orders = "SELECT o.od_id, o.od_name, o.od_tell, o.receiver_tell, o.od_address, o.od_note, o.od_total_price, o.payment_method, o.wherehouse, o.employee_id, o.create_time,
                        od.prepay, od.od_info
                        FROM orders o
                        LEFT JOIN order_details od ON o.od_id = od.od_id
                        ORDER BY o.create_time DESC";
$result_orders = $conn->query($sql_select_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Quản lý đơn hàng</h2>

    <!-- Form thêm đơn hàng mới -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">Thêm đơn hàng mới</button>
    </div>

    <!-- Modal thêm đơn hàng mới -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addOrderForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOrderModalLabel">Thêm đơn hàng mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="od_name" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" id="od_name" name="od_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="od_tell" class="form-label">Số điện thoại liên hệ</label>
                            <input type="tel" class="form-control" id="od_tell" name="od_tell" required>
                        </div>
                        <div class="mb-3">
                            <label for="receiver_tell" class="form-label">Số điện thoại người nhận</label>
                            <input type="tel" class="form-control" id="receiver_tell" name="receiver_tell" required>
                        </div>
                        <div class="mb-3">
                            <label for="street" class="form-label">Đường</label>
                            <input type="text" class="form-control" id="street" name="street" required>
                        </div>
                        <div class="mb-3">
                            <label for="ward" class="form-label">Phường/Xã</label>
                            <input type="text" class="form-control" id="ward" name="ward" required>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">Quận/Huyện</label>
                            <input type="text" class="form-control" id="district" name="district" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Tỉnh/Thành phố</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="od_note" class="form-label">Ghi chú đơn hàng</label>
                            <textarea class="form-control" id="od_note" name="od_note"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="od_total_price" class="form-label">Tổng giá trị đơn hàng</label>
                            <input type="number" class="form-control" id="od_total_price" name="od_total_price" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                            <input type="text" class="form-control" id="payment_method" name="payment_method" required>
                        </div>
                        <div class="mb-3">
                            <label for="wherehouse" class="form-label">Kho hàng</label>
                            <input type="text" class="form-control" id="wherehouse" name="wherehouse" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Mã nhân viên xử lý</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="od_info" class="form-label">Thông tin chi tiết đơn hàng</label>
                            <textarea class="form-control" id="od_info" name="od_info"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="prepay" class="form-label">Số tiền đã đặt cọc</label>
                            <input type="number" class="form-control" id="prepay" name="prepay" min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="add_order">Thêm đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bảng danh sách đơn hàng -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại liên hệ</th>
                    <th>Số điện thoại người nhận</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Ghi chú</th>
                    <th>Tổng giá trị</th>
                    <th>Phương thức thanh toán</th>
                    <th>Kho hàng</th>
                    <th>Mã nhân viên</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_orders->num_rows > 0) {
                    while ($row = $result_orders->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['od_id']; ?></td>
                            <td><?php echo $row['od_name']; ?></td>
                            <td><?php echo $row['od_tell']; ?></td>
                            <td><?php echo $row['receiver_tell']; ?></td>
                            <td><?php echo $row['od_address']; ?></td>
                            <td><?php echo $row['od_note']; ?></td>
                            <td><?php echo number_format($row['od_total_price']); ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td><?php echo $row['wherehouse']; ?></td>
                            <td><?php echo $row['employee_id']; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($row['create_time'])); ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning edit-order-btn" data-bs-toggle="modal" data-bs-target="#editOrderModal" data-odid="<?php echo $row['od_id']; ?>">Sửa</button>
                                <button type="button" class="btn btn-sm btn-danger delete-order-btn" data-odid="<?php echo $row['od_id']; ?>">Xóa</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="12" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal sửa đơn hàng -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editOrderForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel">Sửa đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung sửa đơn hàng sẽ được thực hiện qua AJAX -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="edit_order">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="../js/orders.js"></script>

</body>
</html>
