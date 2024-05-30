<?php
// Kết nối đến cơ sở dữ liệu
include'../php/conection.php';

// Truy vấn để lấy danh sách các size
$sql = "SELECT * FROM sizes";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $sizes = array();
    while ($row = $result->fetch_assoc()) {
        $sizes[] = $row;
    }
} else {
    echo "Không có size nào được tìm thấy.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Thêm Sản Phẩm</title>
</head>

<body>
    <h3>Chọn thể tích</h3>

    <!-- Form thêm mới sản phẩm -->
    <form method="POST" action="" enctype="multipart/form-data">
        <!-- Các trường thông tin sản phẩm -->
        <!-- ... -->
        
        <!-- Lựa chọn size -->
        <?php if (!empty($sizes)): ?>
            <?php foreach ($sizes as $size): ?>
                <input type="checkbox" name="sizes[]" value="<?php echo $size['size_id']; ?>"> <?php echo $size['size_name']; ?><br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có size nào được tìm thấy.</p>
        <?php endif; ?>

        <!-- Các trường thông tin khác và nút thêm sản phẩm -->
        <!-- ... -->
    </form>
</body>

</html>

<?php
// Đóng kết nối
?>
