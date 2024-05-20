<?php
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Thông tin tài khoản Twilio


// Số điện thoại của người nhận
$recipient_number = '+84372762988';

// Nội dung tin nhắn
$message = 'Xin chào từ Twilio! Đây là tin nhắn thử nghiệm.';
// 2970163350482099819
// Khởi tạo đối tượng Twilio Client
$client = new Client($sid, $token);

try {
    // Gửi tin nhắn
    $client->messages->create(
        $recipient_number,
        [
            'from' => $twilio_number,
            'body' => $message
        ]
    );

    echo "Tin nhắn đã được gửi thành công!";
} catch (Exception $e) {
    echo "Có lỗi xảy ra: " . $e->getMessage();
}
?>
