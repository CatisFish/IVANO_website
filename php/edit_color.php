<?php
include '../php/conection.php';

if (isset($_GET['color_id'])) {
    $color_id = $_GET['color_id'];

    // Lấy thông tin màu sắc từ cơ sở dữ liệu
    $sql = "SELECT color_code, color_hex, color_group, color_group_main FROM colors WHERE color_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $color_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $color = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: ../assets/manage-colors.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa màu</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Đường dẫn đến file CSS của bạn -->
</head>
<body>
    <main id="main-edit-color">
        <section class="header-edit-color">
            <h1>Sửa màu</h1>
        </section>

        <section class="content-edit-color">
            <form method="POST" action="../assets/manage-colors.php">
                <input type="hidden" name="color_id" value="<?php echo $color_id; ?>">

                <label for="color_code">Mã màu:</label>
                <input type="text" id="color_code" name="color_code" value="<?php echo htmlspecialchars($color['color_code']); ?>" required>

                <label for="color_hex">Màu HEX:</label>
                <input type="text" id="color_hex" name="color_hex" value="<?php echo htmlspecialchars($color['color_hex']); ?>" required>

                <label for="color_group">Nhóm màu:</label>
                <input type="text" id="color_group" name="color_group" value="<?php echo htmlspecialchars($color['color_group']); ?>" required>

                <label for="color_group_main">Nhóm màu chính:</label>
                <input type="text" id="color_group_main" name="color_group_main" value="<?php echo htmlspecialchars($color['color_group_main']); ?>" required>

                <button type="submit" name="edit_color">Lưu thay đổi</button>
            </form>
        </section>
    </main>
</body>
</html>
