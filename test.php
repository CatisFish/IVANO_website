<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Tin Nhắn Zalo</title>
</head>
<body>
    <h2>Gửi Tin Nhắn Zalo</h2>
    <form action="" method="post">
        <label for="phone">Số điện thoại Zalo:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        <input type="submit" value="Gửi Tin Nhắn">
    </form>
</body>
</html>

<?php

$phone = $_POST['phone'];

if (!empty($phone)) {
    $zalo_api_url = 'https://openapi.zalo.me/v3.0/oa/message/cs';

    $access_token = '';

    $data = array(
        'recipient' => array(
            'user_id' => $phone
        ),
        'message' => array(
            'attachment' => array(
                'type' => 'template',
                'payload' => array(
                    'template_type' => 'media',
                    'elements' => array(
                        array(
                            'media_type' => 'sticker',
                            'attachment_id' => 'bfe458bf64fa8da4d4eb'
                        )
                    )
                )
            )
        )
    );

    $json_data = json_encode($data);

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n" .
                        "access_token: $access_token\r\n",
            'content' => $json_data
        )
    );

    $context = stream_context_create($options);

    $result = file_get_contents($zalo_api_url, false, $context);

    if ($result !== FALSE) {
        echo 'Tin nhắn đã được gửi thành công tới số điện thoại Zalo ' . $phone;
    } else {
        echo 'Đã có lỗi xảy ra khi gửi tin nhắn';
        echo '<br>';
        var_dump($result);
    }
} else {
    echo 'Vui lòng nhập số điện thoại';
}
?>
