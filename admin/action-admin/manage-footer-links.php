<?php
include '../connectDB.php'; // Kết nối đến cơ sở dữ liệu

// Xử lý form khi được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $address = $_POST['address'];
    $mst = $_POST['mst'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $pinterest = $_POST['pinterest'];

    // Cập nhật thông tin footer vào cơ sở dữ liệu
    $sql = "UPDATE footer_info SET phone1='$phone1', phone2='$phone2', address='$address', mst='$mst', email='$email', website='$website', facebook='$facebook', youtube='$youtube', pinterest='$pinterest' WHERE id=1";
    if (mysqli_query($conn, $sql)) {
        $message = "Cập nhật thông tin thành công!";
    } else {
        $message = "Lỗi khi cập nhật thông tin: " . mysqli_error($conn);
    }
}

// Lấy thông tin footer hiện tại từ cơ sở dữ liệu
$sql = "SELECT * FROM footer_info WHERE id=1";
$result = mysqli_query($conn, $sql);
$footer_info = mysqli_fetch_assoc($result);

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý thông tin Footer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Quản lý thông tin Footer</h1>
    <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
    <form method="post" action="manage-footer-links.php">
        <div class="form-group">
            <div class="input-group">
                <label for="phone1">Số điện thoại 1:</label>
                <input type="text" id="phone1" name="phone1" value="<?php echo htmlspecialchars($footer_info['phone1'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="phone2">Số điện thoại 2:</label>
                <input type="text" id="phone2" name="phone2" value="<?php echo htmlspecialchars($footer_info['phone2'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <label for="address">Địa chỉ:</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($footer_info['address'] ?? ''); ?></textarea>
            </div>
            <div class="input-group">
                <label for="mst">MST:</label>
                <input type="text" id="mst" name="mst" value="<?php echo htmlspecialchars($footer_info['mst'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($footer_info['email'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="website">Website:</label>
                <input type="text" id="website" name="website" value="<?php echo htmlspecialchars($footer_info['website'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <label for="facebook">Facebook:</label>
                <input type="text" id="facebook" name="facebook" value="<?php echo htmlspecialchars($footer_info['facebook'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="youtube">YouTube:</label>
                <input type="text" id="youtube" name="youtube" value="<?php echo htmlspecialchars($footer_info['youtube'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="pinterest">Pinterest:</label>
                <input type="text" id="pinterest" name="pinterest" value="<?php echo htmlspecialchars($footer_info['pinterest'] ?? ''); ?>">
            </div>
        </div>

        <div class="button-container">
            <button type="submit">Cập nhật</button>
        </div>
    </form>
</body>
</html>


<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

form {
    max-width: 800px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

textarea {
    height: 80px;
    resize: vertical;
}

.button-container {
    display: flex;
    justify-content: center;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

p {
    color: #008000;
    font-weight: bold;
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
}

</style>