<?php
include '../php/conection.php';

// Lấy danh sách nhóm màu chính
$result_main_groups = $conn->query("SELECT DISTINCT color_group_main FROM colors");
$main_groups = $result_main_groups->fetch_all(MYSQLI_ASSOC);

// Xử lý khi chọn nhóm màu chính
$selected_group = isset($_GET['group']) ? $_GET['group'] : '';
$selected_color = isset($_GET['color']) ? $_GET['color'] : '';
$colors = [];
$selected_color_data = null;

if ($selected_group) {
    $stmt_colors = $conn->prepare("SELECT * FROM colors WHERE color_group_main = ?");
    $stmt_colors->bind_param("s", $selected_group);
    $stmt_colors->execute();
    $result_colors = $stmt_colors->get_result();
    $colors = $result_colors->fetch_all(MYSQLI_ASSOC);
    $stmt_colors->close();
}

if ($selected_color) {
    $stmt_color = $conn->prepare("SELECT * FROM colors WHERE color_id = ?");
    $stmt_color->bind_param("i", $selected_color);
    $stmt_color->execute();
    $result_color = $stmt_color->get_result();
    $selected_color_data = $result_color->fetch_assoc();
    $stmt_color->close();
}

function hexToRgb($hex) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    return "$r, $g, $b";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lọc Màu Theo Nhóm Chính</title>
    <style>
        .color-swatch {
            width: 50px;
            height: 50px;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border-radius: 5px;
        }
        .color-swatch:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .color-swatch.selected {
            transform: scale(1.5);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }
        .color-info {
            margin-top: 20px;
            text-align: center;
        }
        .color-info .color-swatch {
            width: 100%;
            height: 150px;
            display: block;
            margin: 0 auto;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        select {
            padding: 8px;
            margin: 10px 0;
        }

        .color-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 600px; /* Adjust based on your design */
        }

        .color-container > .color-swatch:nth-child(10n+1) {
            clear: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="get">
            <label for="group"></label>
            <select name="group" id="group" onchange="this.form.submit()">
                <option value="">Chọn Màu</option>
                <?php foreach ($main_groups as $group): ?>
                    <option value="<?php echo $group['color_group_main']; ?>" <?php echo ($group['color_group_main'] == $selected_group) ? 'selected' : ''; ?>>
                        <?php echo $group['color_group_main']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <?php if ($selected_group && $colors): ?>
            <h2><?php echo $selected_group; ?></h2>
            <form method="get">
                <input type="hidden" name="group" value="<?php echo $selected_group; ?>">
                <div class="color-container">
                    <?php foreach ($colors as $color): ?>
                        <div class="color-swatch <?php echo ($color['color_id'] == $selected_color) ? 'selected' : ''; ?>"
                             style="background-color: <?php echo $color['color_hex']; ?>;"
                             onclick="document.location.href='?group=<?php echo $selected_group; ?>&color=<?php echo $color['color_id']; ?>'">
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
            <?php if ($selected_color_data): ?>
                <div class="color-info">
                    <h3>Thông tin màu đã chọn:</h3>
                    <p>Mã màu: <?php echo $selected_color_data['color_code']; ?></p>
                    <p>Mã hex: <?php echo $selected_color_data['color_hex']; ?></p>

                    <p>Mã rgb: <?php echo hexToRgb($selected_color_data['color_hex']); ?></p>
                    <div class="color-swatch"
                         style="background-color: <?php echo $selected_color_data['color_hex']; ?>;"></div>
                </div>
            <?php endif; ?>
        <?php elseif ($selected_group): ?>
            <p>Không có màu nào trong nhóm này.</p>
        <?php endif; ?>
    </div>
</body>
</html>
