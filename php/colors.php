<?php
include '../php/conection.php';

// Xử lý thêm màu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_colors'])) {
    $colors = $_POST['colors'];
    $stmt_add = $conn->prepare("INSERT INTO colors (color_code, color_hex, color_group, color_group_main) VALUES (?, ?, ?, ?)");

    foreach ($colors as $color) {
        $color_code = $color['color_code'];
        $color_hex = $color['color_hex'];
        $color_group = $color['color_group'];
        $color_group_main = $color['color_group_main'];
        $stmt_add->bind_param("ssss", $color_code, $color_hex, $color_group, $color_group_main);
        $stmt_add->execute();
    }
    $stmt_add->close();
}

// Xử lý sửa màu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_color'])) {
    $color_id = $_POST['color_id'];
    $color_code = $_POST['color_code'];
    $color_hex = $_POST['color_hex'];
    $color_group = $_POST['color_group'];
    $color_group_main = $_POST['color_group_main'];

    $sql_edit = "UPDATE colors SET color_code = ?, color_hex = ?, color_group = ?, color_group_main = ? WHERE color_id = ?";
    $stmt_edit = $conn->prepare($sql_edit);
    $stmt_edit->bind_param("ssssi", $color_code, $color_hex, $color_group, $color_group_main, $color_id);
    $stmt_edit->execute();
    $stmt_edit->close();
}

// Xử lý xóa màu
if (isset($_GET['delete'])) {
    $color_id = $_GET['delete'];
    $sql_delete = "DELETE FROM colors WHERE color_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $color_id);
    $stmt_delete->execute();
    $stmt_delete->close();
}

// Lấy danh sách các màu sắc và nhóm màu
$sql_colors = "SELECT color_id, color_code, color_hex, color_group, color_group_main FROM colors ORDER BY color_group_main, color_group";
$result_colors = $conn->query($sql_colors);

$colors = array();
if ($result_colors->num_rows > 0) {
    while ($row = $result_colors->fetch_assoc()) {
        $colors[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý màu sắc</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Đường dẫn đến file CSS của bạn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main id="main-manage-colors">
        <section class="header-manage-colors">
            <h1>Quản lý màu sắc</h1>
        </section>

        <section class="content-manage-colors">
            <h2>Thêm màu mới</h2>
            <form method="POST" action="" id="addColorsForm">
                <div id="colorFieldsContainer">
                    <div class="color-field">
                        <label for="color_code[]">Mã màu:</label>
                        <input type="text" name="colors[0][color_code]" class="color_code" required>
                        
                        <label for="color_hex[]">Màu HEX:</label>
                        <input type="text" name="colors[0][color_hex]" class="color_hex" required>
                        <span class="color_preview" style="display: inline-block; width: 50px; height: 20px;"></span>

                        <label for="color_group[]">Nhóm màu:</label>
                        <input type="text" name="colors[0][color_group]" class="color_group" required>

                        <label for="color_group_main[]">Nhóm màu chính:</label>
                        <input type="text" name="colors[0][color_group_main]" class="color_group_main" required>
                    </div>
                </div>
                <button type="button" id="addMoreColors">Thêm màu khác</button>
                <button type="submit" name="add_colors">Thêm màu</button>
            </form>

            <h2>Danh sách màu sắc</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã màu</th>
                        <th>Màu HEX</th>
                        <th>Nhóm màu</th>
                        <th>Nhóm màu chính</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($colors as $color): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($color['color_code']); ?></td>
                            <td><div style="background-color: <?php echo htmlspecialchars($color['color_hex']); ?>; width: 50px; height: 20px;"></div></td>
                            <td><?php echo htmlspecialchars($color['color_group']); ?></td>
                            <td><?php echo htmlspecialchars($color['color_group_main']); ?></td>
                            <td>
                                <a href="edit_color.php?color_id=<?php echo $color['color_id']; ?>">Sửa</a>
                                <a href="colors.php?delete=<?php echo $color['color_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa màu này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            var colorIndex = 1;
            $('#addMoreColors').click(function() {
                var newField = `
                    <div class="color-field">
                        <label for="color_code[]">Mã màu:</label>
                        <input type="text" name="colors[${colorIndex}][color_code]" class="color_code" required>
                        
                        <label for="color_hex[]">Màu HEX:</label>
                        <input type="text" name="colors[${colorIndex}][color_hex]" class="color_hex" required>
                        <span class="color_preview" style="display: inline-block; width: 50px; height: 20px;"></span>

                        <label for="color_group[]">Nhóm màu:</label>
                        <input type="text" name="colors[${colorIndex}][color_group]" class="color_group" required>

                        <label for="color_group_main[]">Nhóm màu chính:</label>
                        <input type="text" name="colors[${colorIndex}][color_group_main]" class="color_group_main" required>
                    </div>`;
                $('#colorFieldsContainer').append(newField);
                colorIndex++;
            });

            $(document).on('input', '.color_hex', function() {
                var hexValue = $(this).val();
                $(this).siblings('.color_preview').css('background-color', hexValue);
            });
        });
    </script>
</body>
</html>
