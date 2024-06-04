<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom-scroll.css">
    <title>Đại Lý | IVANO</title>
</head>

<style>
    #main-daily-page {
        width: 90%;
        margin: 0px auto;
        padding: 20px 0;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .content-left-daily {
        width: 500px;
    }

    .container-daily-right {
        font-weight: 500;
    }

    .container-daily-right h2 {
        color: #ff0000;
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 20px;
    }


    .daily-right-item {
        display: flex;
        margin-bottom: 5px;
    }

    .daily-right-item i {
        color: #1E90FF;
    }

    @keyframes moveLeftRight {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(50px);
        }
    }

    @keyframes moveRightLeft {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(-50px);
        }
    }

    .container-action-daily {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
        margin: 50px 0 0 0;
    }

    .container-action-daily i {
        font-size: 24px;
        color: #f44336;
        animation-duration: 0.5s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
    }

    .container-action-daily i.fa-hand-point-right {
        animation-name: moveLeftRight;
    }

    .container-action-daily i.fa-hand-point-left {
        animation-name: moveRightLeft;
    }

    .daily-action {
        background-color: #1E90FF;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .daily-action:hover {
        background-color: #0073e6;
        cursor: pointer;
    }
</style>

<?php
include("php/conection.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape the user input to prevent SQL injection attacks
    $agency_name = $mysqli->real_escape_string($_POST["daily-name"]);
    $agency_address = $mysqli->real_escape_string($_POST["daily-address"]);
    $agency_phone = $mysqli->real_escape_string($_POST["daily-tel"]);
    $agency_note = $mysqli->real_escape_string($_POST["daily-note"]);

    // Prepare the query to select all rows from the agency table
    if ($stmt = $mysqli->prepare("SELECT * FROM agency")) {
        // Execute the query
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($col1, $col2, $col3, $col4);

        // Fetch the results
        while ($stmt->fetch()) {
            // Do something with the fetched data
        }

        // Close the statement
        $stmt->close();
    }

    // Prepare the query to insert data into the agency table
    if ($stmt = $mysqli->prepare("INSERT INTO agency(agency_name, agency_address, agency_tel, agency_note) VALUES(?, ?, ?, ?)")) {
        // Bind the parameters
        $stmt->bind_param("ssss", $agency_name, $agency_address, $agency_phone, $agency_note);

        // Execute the query
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $mysqli->close();
}
?>

<body>
    <?php include "assets/header.php"; ?>

    <main id="main-daily-page">
        <img class="content-left-daily" src="images/306930053_116006734575335_6139861973453833401_n-801x800.jpg" alt="">

        <div class="container-daily-right">
            <h2>Ưu đãi cho đại lý</h2>

            <p style="margin-bottom: 20px"><span style=" color: #f99b1c; font-weight: 700;">NHƯỢNG QUYỀN 0 ĐỒNG</span>
                nhận nhiều ưu đãi khi kí kết hợp đồng trở thành <span style=" color: #f99b1c; font-weight: 700;">ĐẠI
                    LÝ</span> của Công ty.</p>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Thưởng doanh số <span style=" color: #f99b1c; font-weight: 700;">THÁNG, QUÝ, NĂM.</span></p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Tặng <span style=" color: #f99b1c; font-weight: 700;">xe ÔTÔ, SH150i, IPHONE</span> và nhiều phần
                    <span style=" color: #f99b1c; font-weight: 700;">QUÀ GIÁ TRỊ</span> khác.
                </p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Hỗ trợ <span style=" color: #f99b1c; font-weight: 700;">BIỂN HIỆU ĐẠI LÝ</span>, hoặc <span
                        style=" color: #f99b1c; font-weight: 700;">SHOWROOM</span> theo hợp đồng.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Hỗ trợ cấp <span style=" color: #f99b1c; font-weight: 700;">MÁY PHA MÀU</span> cho Đại lý.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Hỗ trợ cung cấp <span style=" color: #f99b1c; font-weight: 700;">BẢNG MÀU, BẢNG GIÁ</span> hàng tháng
                    cho Đại lý.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Hỗ trợ in <span style=" color: #f99b1c; font-weight: 700;">NAMECARD</span> hàng tháng cho Đại lý.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Hỗ trợ <span style=" color: #f99b1c; font-weight: 700;">SƠN DÙNG THỬ</span> cho khách hàng.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Được đảm bảo <span style=" color: #f99b1c; font-weight: 700;">100%</span> hàng hóa, sản phẩm được sản
                    xuất <span style=" color: #f99b1c; font-weight: 700;">MỚI TRỰC TIẾP TỪ NHÀ MÁY.</span></p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Được đảm bảo <span style=" color: #f99b1c; font-weight: 700;">100%</span> hàng hóa, sản phẩm được
                    <span style=" color: #f99b1c; font-weight: 700;">KIỂM ĐỊNH CHẤT LƯỢNG</span> theo quy định.
                </p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Được <span style=" color: #f99b1c; font-weight: 700;">BẢO HÀNH CÔNG TRÌNH</span> nếu khách hàng đăng
                    ký bảo hành.</p>
            </span>

            <span class="daily-right-item">
                <i class="fa-solid fa-hand-point-right"></i>
                <p>Được <span style=" color: #f99b1c; font-weight: 700;">THU HỒI HÀNG</span> nếu Đại lý trả hàng hoặc
                    ngừng kinh doanh.</p>
            </span>

            <p style="color: #ff0000; font-weight: 600; margin: 20px 0 20px 0;">VÀ HÀNG NGHÌN ƯU ĐÃI KHÁC…</p>

            <div class="container-action-daily">
                <!-- <i class="fa-solid fa-hand-point-right"></i> -->
                <button class="daily-action">Đăng Ký Ngay</button>
                <!-- <i class="fa-solid fa-hand-point-left"></i> -->
            </div>
        </div>

        <form class="daily-form" action="" method="POST">
            <button class="close-btn-daily-form" onclick="closeDailyForm()" type="button"><i
                    class="fa-solid fa-xmark"></i></button>

            <h2>Phiếu Đăng Ký</h2>
            <div class="form-group">
                <input type="text" id="name" name="daily-name" required placeholder=" ">
                <label for="name">Họ tên</label>
            </div>

            <div class="form-group">
                <input type="text" id="address" name="daily-address" required placeholder=" ">
                <label for="address">Địa chỉ</label>
            </div>

            <div class="form-group">
                <input type="tel" id="phone" name="daily-tel" required placeholder=" ">
                <label for="phone">Số điện thoại</label>
            </div>

            <div class="form-group">
                <textarea id="content" name="daily-note" required placeholder=" "></textarea>
                <label for="content">Nội dung</label>
            </div>

            <button type="submit" class="submit-btn">Gửi</button>

        </form>
    </main>

    <div class="overlay-daily" id="overlay-daily"></div>

    <?php include "assets/footer.php"; ?>
</body>

<style>
    .overlay-daily {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
    }
    .close-btn-daily-form {
        position: absolute;
        width: 30px;
        height: 30px;
        right: 10px;
        top: 10px;
        cursor: pointer;
        background-color: #f44336;
        border: none;
        border-radius: 5px;
        color: #fff;
    }

    .daily-form {
        position: relative;
        transform: translate(-50%, 50%);
        transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        background: #fff;
        padding: 20px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        opacity: 0;
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 101;
    }

    .daily-form h2 {
        margin-bottom: 30px;
        font-size: 24px;
        color: #333;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .form-group textarea {
        resize: vertical;
        height: 100px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #1E90FF;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:focus+label,
    .form-group textarea:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #1E90FF;
    }

    .form-group input:focus+label,
    .form-group textarea:focus+label {
        color: #1E90FF;
    }

    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:not(:placeholder-shown)+label {
        color: #333;
    }

    .submit-btn {
        width: 100%;
        padding: 10px 20px;
        background-color: #1E90FF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0073e6;
    }
</style>

<script>
    document.querySelector('.daily-action').addEventListener('click', function () {
        const daiLyForm = document.querySelector('.daily-form');
        daiLyForm.style.opacity = '1';
        daiLyForm.style.transform = 'translate(-50%, -50%)';

        const overlayDailyClose = document.getElementById('overlay-daily');

        overlayDailyClose.style.display = 'block';

    });

    function closeDailyForm() {
        const closeDailyForm = document.querySelector('.close-btn-daily-form');
        closeDailyForm.addEventListener('click', function () {
            const daiLyForm = document.querySelector('.daily-form');
            daiLyForm.style.opacity = '0';
            daiLyForm.style.transform = 'translate(-50%, 50%)';

            const overlayDailyClose = document.getElementById('overlay-daily');

            overlayDailyClose.style.display = 'none';

        });
    }
</script>

</html>