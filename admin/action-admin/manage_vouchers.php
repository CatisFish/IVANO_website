<?php
// Kết nối đến cơ sở dữ liệu
include '../connectDB.php';

// Hàm để tạo mã voucher ngẫu nhiên
function generateVoucherCode($prefix, $length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = $prefix;

    for ($i = strlen($prefix); $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

// Xử lý yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_batch'])) {
        $batch_name = $_POST['batch_name'];
        $total_amount = $_POST['total_amount'];
        $max_discount = $_POST['max_discount'];
        $status = $_POST['status'];
        $apply_to = $_POST['apply_to'];
        $valid_from = $_POST['valid_from'];
        $valid_to = $_POST['valid_to'];
        $voucher_prefix = $_POST['voucher_prefix'];
        $discount_amount = !empty($_POST['discount_amount']) ? $_POST['discount_amount'] : NULL;
        $discount_percentage = !empty($_POST['discount_percentage']) ? $_POST['discount_percentage'] : NULL;
        $number_of_vouchers = $_POST['number_of_vouchers'];

        // Kiểm tra rằng chỉ có một trong hai giá trị giảm được nhập
        if ($discount_amount && $discount_percentage) {
            die("Chỉ được nhập một trong hai giá trị giảm giá: số tiền hoặc phần trăm.");
        }

        // Thêm đợt phát hành voucher
        $sql_add_batch = "INSERT INTO issue_batches (batch_name, total_amount, max_discount, status, apply_to, valid_from, valid_to) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_add_batch = $conn->prepare($sql_add_batch);
        $stmt_add_batch->bind_param("sddssss", $batch_name, $total_amount, $max_discount, $status, $apply_to, $valid_from, $valid_to);
        $stmt_add_batch->execute();
        $batch_id = $stmt_add_batch->insert_id;
        $stmt_add_batch->close();

        // Tạo voucher tự động
        $sql_add_voucher = "INSERT INTO vouchers (batch_id, voucher_code, discount_amount, discount_percentage) VALUES (?, ?, ?, ?)";
        $stmt_add_voucher = $conn->prepare($sql_add_voucher);
        for ($i = 0; $i < $number_of_vouchers; $i++) {
            $voucher_code = generateVoucherCode($voucher_prefix);
            $stmt_add_voucher->bind_param("isdd", $batch_id, $voucher_code, $discount_amount, $discount_percentage);
            $stmt_add_voucher->execute();
        }
        $stmt_add_voucher->close();
    } elseif (isset($_POST['update_voucher'])) {
        $voucher_id = $_POST['voucher_id'];
        $new_status = $_POST['new_status'];

        // Cập nhật trạng thái của voucher
        $sql_update_voucher = "UPDATE vouchers SET status = ? WHERE voucher_id = ?";
        $stmt_update_voucher = $conn->prepare($sql_update_voucher);
        $stmt_update_voucher->bind_param("si", $new_status, $voucher_id);
        $stmt_update_voucher->execute();
        $stmt_update_voucher->close();
    }
}

// Truy vấn SQL để lấy danh sách đợt phát hành voucher
$batchSql = "SELECT * FROM issue_batches";
$batchResult = $conn->query($batchSql);

// Xử lý tìm kiếm
$voucherSql = "SELECT * FROM vouchers";
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $voucherSql .= " WHERE voucher_code LIKE '%$search_query%'";
}
$voucherResult = $conn->query($voucherSql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Voucher</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Quản Lý Voucher</h1>

    <h2>Thêm Đợt Phát Hành Voucher</h2>
    <form action="manage_vouchers.php" method="POST">
        <input type="hidden" name="add_batch" value="1">
        <label for="batch_name">Tên Đợt Phát Hành:</label>
        <input type="text" id="batch_name" name="batch_name" required>
        <label for="total_amount">Tổng Tiền Hàng:</label>
        <input type="number" id="total_amount" name="total_amount" step="0.01" required>
        <label for="max_discount">Giảm Giá Tối Đa:</label>
        <input type="number" id="max_discount" name="max_discount" step="0.01" required>
        <label for="status">Tình Trạng:</label>
        <select id="status" name="status">
            <option value="active">Hoạt động</option>
            <option value="inactive">Ngừng hoạt động</option>
        </select>
        <label for="apply_to">Áp Dụng:</label>
        <select id="apply_to" name="apply_to">
            <option value="all">Toàn bộ sản phẩm</option>
            <option value="specific">Sản phẩm cụ thể</option>
        </select>
        <label for="valid_from">Hiệu Lực Từ:</label>
        <input type="datetime-local" id="valid_from" name="valid_from" required>
        <label for="valid_to">Hiệu Lực Đến:</label>
        <input type="datetime-local" id="valid_to" name="valid_to" required>
        <label for="voucher_prefix">Prefix Mã Voucher:</label>
        <input type="text" id="voucher_prefix" name="voucher_prefix" required>
        <label for="discount_amount">Giá Trị Giảm Giá (Số Tiền):</label>
        <input type="number" id="discount_amount" name="discount_amount" step="0.01">
        <label for="discount_percentage">Giá Trị Giảm Giá (Phần Trăm):</label>
        <input type="number" id="discount_percentage" name="discount_percentage" step="0.01">
        <label for="number_of_vouchers">Số Lượng Voucher:</label>
        <input type="number" id="number_of_vouchers" name="number_of_vouchers" required>
        <button type="submit">Thêm Đợt Phát Hành</button>
    </form>

    <h2>Danh Sách Đợt Phát Hành Voucher</h2>
    <table border="1">
        <tr>
            <th>Batch ID</th>
            <th>Tên Đợt Phát Hành</th>
            <th>Tổng Tiền Hàng</th>
            <th>Giảm Giá Tối Đa</th>
            <th>Tình Trạng</th>
            <th>Áp Dụng</th>
            <th>Hiệu Lực Từ</th>
            <th>Hiệu Lực Đến</th>
        </tr>
        <?php while ($row = $batchResult->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['batch_id']; ?></td>
                <td><?php echo $row['batch_name']; ?></td>
                <td><?php echo $row['total_amount']; ?></td>
                <td><?php echo $row['max_discount']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['apply_to']; ?></td>
                <td><?php echo $row['valid_from']; ?></td>
                <td><?php echo $row['valid_to']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Tìm Kiếm Voucher</h2>
    <form method="GET" action="manage_vouchers.php">
        <label for="search_query">Tìm kiếm:</label>
       
        <input type="text" id="search_query" name="search_query">
<button type="submit">Tìm Kiếm</button>
</form>

<h2>Danh Sách Voucher</h2>
<table border="1">
    <tr>
        <th>Voucher ID</th>
        <th>Batch ID</th>
        <th>Mã Voucher</th>
        <th>Giá Trị Giảm Giá (Số Tiền)</th>
        <th>Giá Trị Giảm Giá (Phần Trăm)</th>
        <th>Tình Trạng</th>
        <th>Ngày Tạo</th>
        <th>Thao Tác</th>
    </tr>
    <?php while ($row = $voucherResult->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['voucher_id']; ?></td>
            <td><?php echo $row['batch_id']; ?></td>
            <td><?php echo $row['voucher_code']; ?></td>
            <td><?php echo $row['discount_amount'] !== null ? $row['discount_amount'] . ' VNĐ' : ''; ?></td>
            <td><?php echo $row['discount_percentage'] !== null ? $row['discount_percentage'] . ' %' : ''; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['create_date']; ?></td>
            <td>
                <form action="manage_vouchers.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="voucher_id" value="<?php echo $row['voucher_id']; ?>">
                    <input type="hidden" name="new_status" value="issued">
                    <button type="submit" name="update_voucher">Phát Hành</button>
                </form>
                <form action="manage_vouchers.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="voucher_id" value="<?php echo $row['voucher_id']; ?>">
                    <input type="hidden" name="new_status" value="printed">
                    <button type="submit" name="update_voucher">In</button>
                </form>
                <form action="manage_vouchers.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="voucher_id" value="<?php echo $row['voucher_id']; ?>">
                    <input type="hidden" name="new_status" value="returned">
                    <button type="submit" name="update_voucher">Trả</button>
                </form>
              

            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
