<?php
include 'php/conection.php';

$result_main_groups = $conn->query("SELECT DISTINCT color_group_main FROM colors");
$main_groups = $result_main_groups->fetch_all(MYSQLI_ASSOC);

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

function hexToRgb($hex)
{
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

<style>
    .container-color-filter {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        text-align: center;
        width: 600px;
        margin: 140px auto;
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 30px;
    }


    .filter-form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }

    .select-filter-form {
        width: 30%;
        margin: 0px auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        font-size: 16px;
        color: #333;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .select-filter-form:focus {
        border-color: #007BFF;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .option-filter-form {
        padding: 10px;
        font-size: 16px;
        color: #333;
    }

    .select-filter-form option:checked {
        background-color: #007BFF;
        color: #fff;
    }

    .color-info {
        margin-top: 20px;
        text-align: center;
    }

    .color-info h3 {
        margin: 20px 0;
    }

    .color-info p {
        margin-bottom: 10px;
    }

    .color-swatch {
        width: 50px;
        height: 50px;
        display: inline-block;
        margin: 30px 5px 5px 5px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        opacity: 0.7;
    }

    .color-swatch:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 1;
    }

    .color-swatch:not(:hover) {
        opacity: 0.7;
    }

    .color-swatch.selected {
        transform: translateY(-10px) scale(1.3);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        margin: 10px;
        transition: all 0.3s ease-in-out;
    }

    .color-swatch-view {
        width: 100%;
        height: 150px;
        display: block;
        margin: 0 auto;
        border-radius: 20px;
        margin-top: 10px;
    }
</style>

<div class="container-color-filter">
    <form method="get" class="filter-form">
        <label for="group"></label>
        <select name="group" id="group" onchange="this.form.submit()" class="select-filter-form">
            <option value="" class="option-filter-form">Chọn Màu</option>
            <?php foreach ($main_groups as $group): ?>
                <option class="option-filter-form" value="<?php echo $group['color_group_main']; ?>" <?php echo ($group['color_group_main'] == $selected_group) ? 'selected' : ''; ?>>
                    <?php echo $group['color_group_main']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    <?php if ($selected_group && $colors): ?>
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
                <div class="color-swatch-view" style="background-color: <?php echo $selected_color_data['color_hex']; ?>;">
                </div>
            </div>
        <?php endif; ?>
    <?php elseif ($selected_group): ?>
        <p>Không có màu nào trong nhóm này.</p>
    <?php endif; ?>
</div>
