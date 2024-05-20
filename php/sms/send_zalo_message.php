<?php
//acc

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openapi.zalo.me/v2.0/oa/message");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accessToken // Thêm OA Access Token vào header
));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    'recipient' => array('user_id' => $recipientId),
    'message' => array('text' => $message)
)));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
