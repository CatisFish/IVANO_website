<?php
session_start();

if (isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];

    if (isset($loggedInUsername)) {
        $initial = substr($loggedInUsername, 0, 1);
    } else {
        echo "Không có tên người dùng đăng nhập";
    }
}
?>

<?php
include 'connectDB.php';

$message = "";

// Xử lý thêm màu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_colors'])) {
    $colors = $_POST['colors'];
    $stmt_add = $conn->prepare("INSERT INTO colors (color_code, color_hex, color_group, color_group_main) VALUES (?, ?, ?, ?)");
    $stmt_check = $conn->prepare("SELECT color_code FROM colors WHERE color_code = ?");

    foreach ($colors as $color) {
        $color_code = $color['color_code'];
        $color_hex = $color['color_hex'];
        $color_group = $color['color_group'];
        $color_group_main = $color['color_group_main'];

        // Kiểm tra xem color_code đã tồn tại hay chưa
        $stmt_check->bind_param("s", $color_code);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $message .= "Màu với mã code $color_code đã tồn tại.<br>";
        } else {
            $stmt_add->bind_param("ssss", $color_code, $color_hex, $color_group, $color_group_main);
            $stmt_add->execute();
        }
    }

    $stmt_add->close();
    $stmt_check->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global-style-ad.css">
    <link rel="stylesheet" href="css/custom-scroll.css">

    <title>Color Management</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    .main-admin-page {
        margin-left: 18%;
        border-left: 1px solid #fff;
        width: 82%;
        transition: all ease-in-out 0.3s;
    }

    .main-top-admin-page {
        top: 0;
        position: sticky;
        background: url('images/BacksAndBeyond_Images_Learning_2-2000x700-1-1400x490.jpg') no-repeat center center;
    }

    .main-info {
        display: flex;
        margin: auto;
    }

    .left-info {
        margin: 20px;
    }

    .oders_tal {
        width: 100%;
    }

    .count-info {
        display: flex;
        width: 100%;
    }
</style>

<body>
    <?php include "assets/sidebar.php"; ?>

    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="#">Trang Quản Trị</a>
            </div>

            <?php include "assets/hello-user.php"; ?>
        </section>

        <section class="content-manage-colors">
            <form method="POST" action="" id="addColorsForm">
                <div id="colorFieldsContainer">
                    <div class="color-field">
                        <label for="color_code[]">Mã màu:</label>
                        <input type="text" name="colors[0][color_code]" class="color_code" required>

                        <label for="color_hex[]">Màu HEX:</label>
                        <div class="color_hex_container">
                            <input type="text" name="colors[0][color_hex]" class="color_hex" required>
                            <span class="color_preview"></span>
                        </div>

                        <label for="color_group[]">Nhóm màu:</label>
                        <input type="text" name="colors[0][color_group]" class="color_group" required>

                        <label for="color_group_main[]">Nhóm màu chính:</label>
                        <input type="text" name="colors[0][color_group_main]" class="color_group_main" required>
                    </div>
                </div>
                <button type="submit" name="add_colors" class="add-colors">Thêm màu</button>
            </form>

            <h2 class="title-color-table">Danh sách màu sắc</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã màu</th>
                        <th>Màu DEMO</th>
                        <th>Mã HEX</th>

                        <th>Nhóm màu</th>
                        <th>Nhóm màu chính</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($colors as $color): ?>
                        <tr>

                            <td><?php echo htmlspecialchars($color['color_code']); ?></td>
                            <td>
                                <div
                                    style="background-color: <?php echo htmlspecialchars($color['color_hex']); ?>; width: 100%; height: 20px;">
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($color['color_hex']); ?></td>

                            <td><?php echo htmlspecialchars($color['color_group']); ?></td>
                            <td><?php echo htmlspecialchars($color['color_group_main']); ?></td>
                            <td>
                                <a href="../php/edit_color.php?color_id=<?php echo $color['color_id']; ?>"
                                    class="action-link">Sửa</a>
                                <a href="?delete=<?php echo $color['color_id']; ?>" class="action-link delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa màu này?');">Xóa</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        $(document).ready(function () {
            var colorIndex = 1;
            $('#addMoreColors').click(function () {
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

            $(document).on('input', '.color_hex', function () {
                var hexValue = $(this).val();
                $(this).siblings('.color_preview').css('background-color', hexValue);
            });
        });
    </script>
</body>

</html>
<style>
    .content-manage-colors {
        margin-top: 20px;
    }

    form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        width: 600px;
        margin: 0px auto;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @-webkit-keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    form input[type="text"] {
        width: calc(100% - 12px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .color_hex_container {
        display: flex;
        align-items: center;
    }

    .color_hex_container .color_preview {
        width: 30%;
        height: 30px;
        margin-left: 10px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .add-colors, .action-link {
        background-color: #55D5D2;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 10px;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .add-colors:hover , .action-link:hover{
        background-color: #F58F5D;
    }

    /* Style for table */
    .title-color-table {
        text-align: center;
        margin-top: 30px;
    }

    table {
        width: 90%;
        border-collapse: collapse;
        margin: 10px auto;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    table th {
        background-color: #F58F5D;
        position: sticky;
        top: 72px;
        overflow: hidden;
        color: #FFF;
    }

    tbody {
        overflow-y: auto;
        max-height: 300px;
    }


    .action-link{
        padding: 5px 10px !important;
    }

    .action-link.delete {
    background-color: #dc3545;
    padding: 5px 10px !important;
}

.action-link.delete:hover {
    background-color: #c82333; /* Darker red on hover */
}
</style>