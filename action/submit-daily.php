<?php
header('Content-Type: application/json');

include ('../php/conection.php');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Đặt múi giờ cho máy chủ là múi giờ của Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

$name = isset($_POST['daily-name']) ? $_POST['daily-name'] : '';
$address = isset($_POST['daily-address']) ? $_POST['daily-address'] : '';
$phone = isset($_POST['daily-tell']) ? $_POST['daily-tell'] : '';
$note = isset($_POST['daily-note']) ? $_POST['daily-note'] : '';

if (empty($name) || empty($address) || empty($phone) || empty($note)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
    exit();
}

// Lấy ngày giờ hiện tại
$current_time = date('Y-m-d H:i:s');

$sql = "INSERT INTO agency (agency_name, agency_address, agency_tell, agency_note, time_input) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $address, $phone, $note, $current_time);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Dữ liệu đã được lưu thành công!";
} else {
    $response['success'] = false;
    $response['message'] = "Đã xảy ra lỗi khi lưu dữ liệu: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
    