<style>
  .container-list-product {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Mỗi hàng chứa 4 sản phẩm */
    grid-gap: 20px; /* Khoảng cách giữa các sản phẩm */
}

.product-item {
    width: 100%; /* Chiều rộng của sản phẩm là 100% của cột */
}

</style>

<?php
// Kết nối đến cơ sở dữ liệu
include '../php/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_flashsale'])) {
        $product_id = $_POST['product_id'];
        $discount = $_POST['discount'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Thêm sản phẩm vào flashsale
        $sql_flashsale = "INSERT INTO flashsale (product_id, discount) VALUES (?, ?)";
        $stmt_flashsale = $conn->prepare($sql_flashsale);
        $stmt_flashsale->bind_param("sd", $product_id, $discount);
        $stmt_flashsale->execute();
        $flashsale_id = $stmt_flashsale->insert_id;
        $stmt_flashsale->close();

        // Thêm thời gian flashsale vào bảng time_flashsale
        $sql_time = "INSERT INTO time_flashsale (flashsale_id, start_time, end_time) VALUES (?, ?, ?)";
        $stmt_time = $conn->prepare($sql_time);
        $stmt_time->bind_param("iss", $flashsale_id, $start_time, $end_time);
        $stmt_time->execute();
        $stmt_time->close();
    } elseif (isset($_POST['update_flashsale'])) {
        $flashsale_id = $_POST['flashsale_id'];
        $product_id = $_POST['product_id'];
        $discount = $_POST['discount'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Cập nhật flashsale
        $sql_flashsale = "UPDATE flashsale SET product_id = ?, discount = ? WHERE flashsale_id = ?";
        $stmt_flashsale = $conn->prepare($sql_flashsale);
        $stmt_flashsale->bind_param("sdi", $product_id, $discount, $flashsale_id);
        $stmt_flashsale->execute();
        $stmt_flashsale->close();

        // Cập nhật thời gian flashsale
        $sql_time = "UPDATE time_flashsale SET start_time = ?, end_time = ? WHERE flashsale_id = ?";
        $stmt_time = $conn->prepare($sql_time);
        $stmt_time->bind_param("ssi", $start_time, $end_time, $flashsale_id);
        $stmt_time->execute();
        $stmt_time->close();
    } elseif (isset($_POST['delete_flashsale'])) {
        $flashsale_id = $_POST['flashsale_id'];

        // Xóa thời gian flashsale
        $sql_time = "DELETE FROM time_flashsale WHERE flashsale_id = ?";
        $stmt_time = $conn->prepare($sql_time);
        $stmt_time->bind_param("i", $flashsale_id);
        $stmt_time->execute();
        $stmt_time->close();

        // Xóa flashsale
        $sql_flashsale = "DELETE FROM flashsale WHERE flashsale_id = ?";
        $stmt_flashsale = $conn->prepare($sql_flashsale);
        $stmt_flashsale->bind_param("i", $flashsale_id);
        $stmt_flashsale->execute();
        $stmt_flashsale->close();
    }
}

// Truy vấn SQL để lấy danh sách sản phẩm flash sale
$flashSaleSql = "
    SELECT f.flashsale_id, f.discount, f.product_id AS id_sanpham, p.product_name, b.brand_name
    FROM flashsale f
    INNER JOIN products p ON f.product_id = p.product_id
    INNER JOIN brands b ON p.brand_id = b.brand_id";
$flashSaleResult = $conn->query($flashSaleSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Flash Sale</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Quản Lý Flash Sale</h1>

    <h2>Thêm Sản Phẩm Flash Sale</h2>
    <form action="manage_flashsale.php" method="POST">
        <input type="hidden" name="add_flashsale" value="1">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" required>
        <labelfor="discount">Discount:</label>
        <input type="number" id="discount" name="discount" step="0.01" required>
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" id="start_time" name="start_time" required>
        <label for="end_time">End Time:</label>
        <input type="datetime-local" id="end_time" name="end_time" required>
        <button type="submit">Thêm</button>
        </form>
        <h2>Danh Sách Sản Phẩm Flash Sale</h2>
<table border="1">
    <tr>
        <th>Flash Sale ID</th>
        <th>Discount</th>
        <th>ID Sản Phẩm</th>
        <th>Product Name</th>
        <th>Brand</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $flashSaleResult->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['flashsale_id']; ?></td>
            <td><?php echo $row['discount']; ?></td>
            <td><?php echo $row['id_sanpham']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['brand_name']; ?></td>
            <td>
                <form action="manage_flashsale.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="flashsale_id" value="<?php echo $row['flashsale_id']; ?>">
                    <button type="submit" name="delete_flashsale" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
                <button onclick="editFlashSale(<?php echo htmlspecialchars(json_encode($row)); ?>)">Sửa</button>
            </td>
        </tr>
    <?php } ?>
</table>

<h2>Danh Sách Sản Phẩm Được Chọn</h2>

<form id="updateForm" action="manage_flashsale.php" method="POST" style="display:none;">
    <input type="hidden" name="update_flashsale" value="1">
    <input type="hidden" id="flashsale_id" name="flashsale_id">
    <label for="edit_product_id">Product ID:</label>
    <input type="text" id="edit_product_id" name="product_id" required>
    <label for="edit_discount">Discount:</label>
    <input type="number" id="edit_discount" name="discount" step="0.01" required>
    <label for="edit_start_time">Start Time:</label>
    <input type="datetime-local" id="edit_start_time" name="start_time" required>
    <label for="edit_end_time">End Time:</label>
    <input type="datetime-local" id="edit_end_time" name="end_time" required>
    <button type="submit">Cập Nhật</button>
</form>
</body>
</html>

<script>
    function editFlashSale(flashsale) {
        document.getElementById('updateForm').style.display = 'block';
        document.getElementById('flashsale_id').value = flashsale.flashsale_id;
        document.getElementById('edit_product_id').value = flashsale.id_sanpham;
        document.getElementById('edit_discount').value = flashsale.discount;
        document.getElementById('edit_start_time').value = flashsale.start_time;
        document.getElementById('edit_end_time').value = flashsale.end_time;
    }
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var productItems = document.querySelectorAll(".product-item");
    var itemsPerPage = 12; // Số lượng sản phẩm mỗi trang
    var pageCount = Math.ceil(productItems.length / itemsPerPage);

    // Ẩn tất cả các sản phẩm
    productItems.forEach(function(item) {
        item.style.display = "none";
    });

    // Hiểnthị sản phẩm cho trang đầu tiên
showPage(1);
// Hàm hiển thị sản phẩm cho mỗi trang
function showPage(page) {
    var startIndex = (page - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;
    for (var i = 0; i < productItems.length; i++) {
        if (i >= startIndex && i < endIndex) {
            productItems[i].style.display = "block";
        } else {
            productItems[i].style.display = "none";
        }
    }
}
});



function editFlashSale(data) {
document.getElementById('flashsale_id').value = data.flashsale_id;
document.getElementById('edit_product_id').value = data.product_id;
document.getElementById('edit_discount').value = data.discount;
document.getElementById('edit_start_time').value = data.start_time.replace(' ', 'T');
document.getElementById('edit_end_time').value = data.end_time.replace(' ', 'T');
document.getElementById('updateForm').style.display = 'block';
window.scrollTo(0, document.getElementById('updateForm').offsetTop);
}
</script>
</body>
</html>