<?php
header('Content-Type: application/json');

include ('../php/conection.php');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$name = isset($_POST['daily-name']) ? $_POST['daily-name'] : '';
$address = isset($_POST['daily-address']) ? $_POST['daily-address'] : '';
$phone = isset($_POST['daily-tell']) ? $_POST['daily-tell'] : '';
$note = isset($_POST['daily-note']) ? $_POST['daily-note'] : '';

if (empty($name) || empty($address) || empty($phone) || empty($note)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
    exit();
}

$sql = "INSERT INTO agency (agency_name, agency_address, agency_tell, agency_note) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $address, $phone, $note);

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