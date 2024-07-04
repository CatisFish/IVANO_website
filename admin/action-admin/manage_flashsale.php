<?php
// Kết nối đến cơ sở dữ liệu
include '../connectDB.php';

// Xử lý yêu cầu giảm quantity
if (isset($_GET['action']) && $_GET['action'] === 'reduce' && isset($_GET['flashsale_id'])) {
    $flashsale_id = $_GET['flashsale_id'];
    
    // Lấy số lượng hiện tại của flash sale
    $getQuantitySql = "SELECT quantity FROM flashsale WHERE flashsale_id = $flashsale_id";
    $quantityResult = $conn->query($getQuantitySql);
    
    if ($quantityResult->num_rows > 0) {
        $row = $quantityResult->fetch_assoc();
        $currentQuantity = $row['quantity'];
        
        // Giảm số lượng đi 1 (hoặc số lượng tùy vào nhu cầu)
        if ($currentQuantity > 0) {
            $newQuantity = $currentQuantity - 1;
            
            // Cập nhật số lượng mới vào database
            $updateQuantitySql = "UPDATE flashsale SET quantity = $newQuantity WHERE flashsale_id = $flashsale_id";
            if ($conn->query($updateQuantitySql) === TRUE) {
                echo $newQuantity; // Trả về số lượng mới cho phản hồi AJAX
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo $currentQuantity; // Trả về số lượng hiện tại nếu không thể giảm
        }
    } else {
        echo "0"; // Trả về 0 nếu không tìm thấy flash sale
    }
}


// Xử lý yêu cầu AJAX để xóa sản phẩm flash sale đã hết hạn
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_expired_flashsale'])) {
    $flashsale_id = $_POST['delete_expired_flashsale'];

    // Xóa sản phẩm flash sale đã hết hạn từ bảng flashsale
    $sql_delete_expired = "DELETE FROM flashsale WHERE flashsale_id = ?";
    $stmt_delete = $conn->prepare($sql_delete_expired);
    $stmt_delete->bind_param("i", $flashsale_id);
    $stmt_delete->execute();
    $stmt_delete->close();

    // Có thể cập nhật thêm các bảng phụ thuộc khác nếu cần
    // Ví dụ: Xóa dữ liệu từ bảng time_flashsale hoặc các bảng liên quan khác
}


// Xử lý yêu cầu AJAX để lấy danh sách kích thước sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'get_sizes' && isset($_POST['id_sanpham'])) {
        $id_sanpham = $_POST['id_sanpham'];

        $sql = "
            SELECT s.size_id, s.size_name
            FROM product_size ps
            JOIN sizes s ON ps.size_id = s.size_id
            WHERE ps.id_sanpham = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_sanpham);
        $stmt->execute();
        $result = $stmt->get_result();

        $sizes = [];
        while ($row = $result->fetch_assoc()) {
            $sizes[] = $row;
        }

        echo json_encode($sizes);
        exit; // Kết thúc script sau khi trả về JSON
    } elseif ($_POST['action'] == 'get_flashsale' && isset($_POST['id'])) {
        $flashsale_id = $_POST['id'];

        $sql = "
            SELECT f.flashsale_id, f.discount, f.id_sanpham, f.quantity, t.start_time, t.end_time
            FROM flashsale f
            INNER JOIN time_flashsale t ON f.flashsale_id = t.flashsale_id
            WHERE f.flashsale_id = ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $flashsale_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $flashsaleData = $result->fetch_assoc();

        echo json_encode($flashsaleData);
        exit; // Kết thúc script sau khi trả về JSON
    }
}

// Xử lý khi người dùng gửi form thêm, sửa hoặc xóa flash sale
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_flashsale'])) {
        $id_sanpham = $_POST['id_sanpham'];
        $size_id = $_POST['size_id'];
        $discount = $_POST['discount'];
        $quantity = $_POST['quantity'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Thêm sản phẩm vào flashsale
        $sql_flashsale = "INSERT INTO flashsale (id_sanpham, discount, quantity) VALUES (?, ?, ?)";
        $stmt_flashsale = $conn->prepare($sql_flashsale);
        $stmt_flashsale->bind_param("sdi", $id_sanpham, $discount, $quantity);
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
        $id_sanpham = $_POST['id_sanpham'];
        $size_id = $_POST['size_id'];
        $discount = $_POST['discount'];
        $quantity = $_POST['quantity'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Cập nhật flashsale
        $sql_flashsale = "UPDATE flashsale SET id_sanpham = ?, discount = ?, quantity = ? WHERE flashsale_id = ?";
        $stmt_flashsale = $conn->prepare($sql_flashsale);
        $stmt_flashsale->bind_param("sdii", $id_sanpham, $discount, $quantity, $flashsale_id);
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
    SELECT f.flashsale_id, f.discount, f.id_sanpham, p.product_name, b.brand_name, f.quantity, t.start_time, t.end_time, 
           GROUP_CONCAT(s.size_name SEPARATOR ', ') AS product_sizes, i.path_image
    FROM flashsale f
    INNER JOIN products p ON f.id_sanpham = p.id_sanpham
    INNER JOIN brands b ON p.brand_id = b.brand_id
    INNER JOIN time_flashsale t ON f.flashsale_id = t.flashsale_id
    LEFT JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
    LEFT JOIN sizes s ON ps.size_id = s.size_id
    LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham
    GROUP BY f.flashsale_id";


$flashSaleResult = $conn->query($flashSaleSql);

// Truy vấn SQL để lấy danh sách sản phẩm
$productSql = "SELECT id_sanpham, product_name FROM products";
$productResult = $conn->query($productSql);

$conn->close();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Flash Sale</title>
    <style>
        .flashsale-table img {
            max-width: 100px;
            height: auto;
        }
        .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    text-align: center;
    margin-bottom: 20px;
}

.product-flsale-form-container {
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
    max-width: 800px;
    margin: 20px auto;
}

.product-flsale-form-container > * {
    width: 100%;
    margin-bottom: 15px;
}

.product-flsale-name{
    display: flex;
    align-items: center;
    margin: 5px;
}
.product-flsale-time{
    margin: 5px;
}

.product-flsale-dis-quantity{
   
}

.product-flsale-name label,
.product-flsale-dis-quantity label,
.product-flsale-time label {
    flex: 0 0 20%; /* Width for labels */
    text-align: left;
}

.product-flsale-nameselect,
.product-flsale-dis-quantity input[type="number"],
.product-flsale-time input[type="datetime-local"] {
    flex: 65%; /* Width for input/select fields */
}

.product-flsale-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.product-flsale-btn button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-flsale-btn button:hover {
    background-color: #0056b3;
}

.flashsale-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.flashsale-table th, .flashsale-table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ccc;
}

.flashsale-table th {
    background-color: #f0f0f0;
}

.flashsale-table img {
    max-width: 100px;
    height: auto;
}

.update-form {
    display: none;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
    max-width: 800px;
    margin: 20px auto;
}

.update-form h2 {
    text-align: center;
    margin-bottom: 20px;
}

    </style>
</head>

<body>
    <div class="container">
        <h1>Quản Lý Flash Sale</h1>

        <h2>Thêm Sản Phẩm Flash Sale</h2>

        <div class="product-flsale-form-container">
            <form action="manage_flashsale.php" method="POST">
                <input type="hidden" name="add_flashsale" value="1">

                <!-- Tên Và szie -->
                <div class="product-flsale-name">
                    <label for="id_sanpham">Chọn sản phẩm:</label>
                    <select id="id_sanpham" name="id_sanpham" required>
                        <?php while ($row = $productResult->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_sanpham']; ?>"><?php echo $row['product_name']; ?></option>
                        <?php } ?>
                    </select>
                   

                </div>

                <!-- Giảm giá và số lượng -->
                <div class="product-flsale-dis-quantity">
                <label for="size_id">Kích thước:</label>
                    <select id="size_id" name="size_id" required>
                        <!-- Options sẽ được tải bằng JavaScript -->
                    </select>
                    <label for="discount">Giảm giá (%):</label>
                    <input type="number" id="discount" name="discount" step="0.01" required>
                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>

                <!-- Thời Gian -->
                <div class="product-flsale-time">
                    <label for="start_time">Thời gian bắt đầu:</label>
                    <input type="datetime-local" id="start_time" name="start_time" required>
                    <label for="end_time">Thời gian kết thúc:</label>
                    <input type="datetime-local" id="end_time" name="end_time" required>
                </div>

                <div class="product-flsale-btn">
                    <button type="submit">Thêm</button>
                </div>

            </form>
        </div>

        <h2>Danh Sách Sản Phẩm Flash Sale</h2>
        <table class="flashsale-table">
            <tr>
                <th>Mã Flash Sale</th>
                <th>Giảm giá (%)</th>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Thương Hiệu</th>
                <th>Số lượng</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
                <th>Thời gian còn lại</th>
                <th>Hình ảnh</th>
                <th>Kích thước</th>
                <th>Hành động</th>
            </tr>
            <?php while ($row = $flashSaleResult->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['flashsale_id']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td><?php echo $row['id_sanpham']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['brand_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['start_time']; ?></td>
                    <td><?php echo $row['end_time']; ?></td>
                    <td class="remaining-time" data-end-time="<?php echo $row['end_time']; ?>"></td>
                    <td><?php if (!empty($row['path_image'])) { ?>
                            <img src="../<?php echo $row['path_image']; ?>" alt="Product Image">
                        <?php } else { ?>
                            Không có hình ảnh
                        <?php } ?>
                    </td>
                    <td><?php echo $row['product_sizes']; ?></td>
                    <td>
                        <form action="manage_flashsale.php" method="POST">
                            <input type="hidden" name="flashsale_id" value="<?php echo $row['flashsale_id']; ?>">
                            <button type="submit" name="delete_flashsale"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                        <button onclick="openUpdateForm(<?php echo $row['flashsale_id']; ?>)">Sửa</button>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <!-- Form sửa sản phẩm flash sale -->
        <div id="updateForm" class="update-form">
            <h2>Sửa Sản Phẩm Flash Sale</h2>
            <form id="update_flashsale_form" action="manage_flashsale.php" method="POST">
                <input type="hidden" name="update_flashsale" value="1">
                <input type="hidden" id="update_flashsale_id" name="flashsale_id" value="">
                <label for="update_id_sanpham">Chọn Sản Phẩm: </label>

                <div class="product-flsale-name">
                    <select id="update_id_sanpham" name="id_sanpham" required>
                        <?php mysqli_data_seek($productResult, 0); // Đưa con trỏ về đầu dữ liệu ?>
                        <?php while ($row = $productResult->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_sanpham']; ?>"><?php echo $row['product_name']; ?></option>
                        <?php } ?>
                    </select>


                </div>

                <div class="product-flsale-dis-quantity">
                    
                <label for="update_size_id">Kích thước:</label>
                    <select id="update_size_id" name="size_id" required>
                        <!-- Options sẽ được tải bằng JavaScript -->
                    </select>
                    <label for="update_discount">Giảm giá (%):</label>
                    <input type="number" id="update_discount" name="discount" step="0.01" required>
                    <label for="update_quantity">Số lượng:</label>
                </div>

                <div class="product-flsale-time">

                <input type="number" id="update_quantity" name="quantity" required>
                <label for="update_start_time">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="update_start_time" name="start_time" required>
                <label for="update_end_time">Thời gian kết thúc:</label>
                <input type="datetime-local" id="update_end_time" name="end_time" required>
                </div>

                <div class="product-flsale-btn">
                <button type="submit">Lưu</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Function để tải danh sách kích thước dựa vào sản phẩm đã chọn
        function loadProductSizes(id_sanpham, selectElementId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'manage_flashsale.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var sizesSelect = document.getElementById(selectElementId);
                    sizesSelect.innerHTML = ''; // Xóa các option cũ

                    var sizes = JSON.parse(xhr.responseText);
                    sizes.forEach(function (size) {
                        var option = document.createElement('option');
                        option.value = size.size_id;
                        option.textContent = size.size_name;
                        sizesSelect.appendChild(option);
                    });
                }
            };
            xhr.send('action=get_sizes&id_sanpham=' + id_sanpham);
        }

        // Sự kiện khi thay đổi sản phẩm để tải lại danh sách kích thước
        document.getElementById('id_sanpham').addEventListener('change', function () {
            var selectedProductId = this.value;
            if (selectedProductId !== '') {
                loadProductSizes(selectedProductId, 'size_id');
            } else {
                document.getElementById('size_id').innerHTML = ''; // Nếu không có sản phẩm nào được chọn
            }
        });

        // Hàm mở form sửa với dữ liệu flash sale cụ thể
        function openUpdateForm(flashsale_id) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'manage_flashsale.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var flashsaleData = JSON.parse(xhr.responseText);

                    // Đổ dữ liệu vào form sửa
                    document.getElementById('update_flashsale_id').value = flashsale_id;
                    document.getElementById('update_id_sanpham').value = flashsaleData.id_sanpham;
                    loadProductSizes(flashsaleData.id_sanpham, 'update_size_id'); // Tải lại danh sách kích thước

                    document.getElementById('update_discount').value = flashsaleData.discount;
                    document.getElementById('update_quantity').value = flashsaleData.quantity;
                    document.getElementById('update_start_time').value = flashsaleData.start_time.replace(' ', 'T');
                    document.getElementById('update_end_time').value = flashsaleData.end_time.replace(' ', 'T');

                    // Hiển thị form sửa
                    document.getElementById('updateForm').style.display = 'block';
                }
            };
            xhr.send('action=get_flashsale&id=' + flashsale_id);
        }

        // Sự kiện khi thay đổi sản phẩm để tải lại danh sách kích thước (form sửa)
        document.getElementById('update_id_sanpham').addEventListener('change', function () {
            var selectedProductId = this.value;
            if (selectedProductId !== '') {
                loadProductSizes(selectedProductId, 'update_size_id');
            } else {
                document.getElementById('update_size_id').innerHTML = ''; // Nếu không có sản phẩm nào được chọn
            }
        });

        function updateRemainingTime() {
            var now = new Date().getTime();

            document.querySelectorAll('.remaining-time').forEach(function (element) {
                var endTime = new Date(element.getAttribute('data-end-time')).getTime();
                var timeRemaining = endTime - now;

                if (timeRemaining > 0) {
                    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                    element.textContent = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
                } else {
                    element.textContent = "Đã kết thúc";

                    // Lấy flashsale_id của sản phẩm
                    var flashsale_id = element.parentElement.parentElement.querySelector('[name="flashsale_id"]').value;

                    // Gửi yêu cầu AJAX để xóa sản phẩm đã hết hạn
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'manage_flashsale.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            // Xử lý kết quả từ máy chủ (nếu cần)
                        }
                    };
                    xhr.send('delete_expired_flashsale=' + flashsale_id);
                }
            });
        }

        setInterval(updateRemainingTime, 1000);
        updateRemainingTime();

    </script>
</body>

</html>