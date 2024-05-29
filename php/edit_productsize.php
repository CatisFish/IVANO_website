<?php
// Kết nối đến cơ sở dữ liệu của bạn
include '../php/conection.php' ;

// Xử lý thêm dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $product_id = $_POST['product_id'];
    $size_id = $_POST['size_id'];
    $price = $_POST['price'];

    $sql = "INSERT INTO product_size (product_id, size_id, price) VALUES ('$product_id', '$size_id', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm dữ liệu thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý sửa dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $product_size_id = $_POST['product_size_id'];
    $product_id = $_POST['product_id'];
    $size_id = $_POST['size_id'];
    $price = $_POST['price'];

    $sql = "UPDATE product_size SET product_id='$product_id', size_id='$size_id', price='$price' WHERE product_size_id=$product_size_id";

    if ($conn->query($sql) === TRUE) {
        echo "Sửa dữ liệu thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Xử lý xóa dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $product_size_id = $_POST['product_size_id'];

    $sql = "DELETE FROM product_size WHERE product_size_id=$product_size_id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa dữ liệu thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Product Size</title>
</head>
<body>
    <h2>Thêm Product Size</h2>
    <form method="post">
        Product ID: <input type="text" name="product_id"><br>
        Size ID: <input type="text" name="size_id"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" name="add" value="Thêm">
    </form>

    <h2>Sửa Product Size</h2>
    <form method="post">
        Product Size ID: <input type="text" name="product_size_id"><br>
        Product ID: <input type="text" name="product_id"><br>
        Size ID: <input type="text" name="size_id"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" name="edit" value="Sửa">
    </form>

    <h2>Xóa Product Size</h2>
    <form method="post">
        Product Size ID: <input type="text" name="product_size_id"><br>
        <input type="submit" name="delete" value="Xóa">
    </form>
</body>
</html>
