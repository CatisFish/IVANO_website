<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ivano_website";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ho_ten = $_POST['ten'];
        $so_dien_thoai = $_POST['so_dien_thoai'];

        $thoi_gian_gui = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tuvan_form (ten, so_dien_thoai, ngay_gui) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $ho_ten, $so_dien_thoai, $thoi_gian_gui);

        if ($stmt->execute()) {
            echo "<p>Thông tin của bạn đã được gửi thành công.</p>";
        } else {
            echo "<p>Có lỗi xảy ra. Vui lòng thử lại sau.</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>