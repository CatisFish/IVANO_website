<?php
include '../php/conection.php';
// Xử lý thêm mới danh mục
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi khi thêm mới: " . $conn->error;
    }
}

// Xử lý xóa danh mục
if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];
    $sql = "DELETE FROM categories WHERE category_id=$category_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
}

// Xử lý cập nhật danh mục
if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $sql = "UPDATE categories SET category_name='$category_name' WHERE category_id=$category_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các danh mục
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

// Kiểm tra xem có dữ liệu được trả về không
if ($result->num_rows > 0) {
    // Đổ dữ liệu từ kết quả truy vấn vào mảng
    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "Không có danh mục nào được tìm thấy.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục sản phẩm</title>
</head>
<style>
    /* CSS cho các phần input và button */
input[type="text"],
button {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

/* CSS cho nút */
button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* CSS cho bảng danh sách danh mục */
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

</style>
<body>
    <h1>Quản lý danh mục sản phẩm</h1>

    <?php
    // Kiểm tra xem có yêu cầu chỉnh sửa danh mục không
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['category_id'])) {
        // Lấy thông tin của danh mục cần chỉnh sửa
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM categories WHERE category_id=$category_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <!-- Biểu mẫu chỉnh sửa danh mục -->
            <h2>Chỉnh sửa danh mục</h2>
            <form method="POST" action="">
                <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
                <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>" required>
                <button type="submit" name="update_category">Cập nhật</button>
            </form>
            <br>
    <?php
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }
    ?>

    <!-- Form thêm mới danh mục -->
    <form method="POST" action="">
        <input type="text" name="category_name" placeholder="Tên danh mục" required>
        <button type="submit" name="add_category">Thêm</button>
    </form>
    <br>

    <!-- Bảng danh sách danh mục -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['category_id']; ?></td>
                    <td><?php echo $category['category_name']; ?></td>
                    <td>
                        <a href="categories.php?action=edit&category_id=<?php echo $category['category_id']; ?>">Sửa</a>
                        <a href="categories.php?delete_category=<?php echo $category['category_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>

