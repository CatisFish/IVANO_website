<?php
$accessToken = 'rTkcMDhxBKpIqwDKsVyaJDdMgLdIuI8UlBNDHBNE6I6vdjDSqjq2H8Mtx23At2j1beEa0Uh8IM-ckhaHw9L-T8V9kItLcsjAmDQO5OkZJs7B-wCEdgiePjwAhWk8osXWteAtDO3iSK2EZVydqQGbEyJnhbYQsIWhxFNUJfY36bRjpjmMk-0oIS71s0EywpbZr8VHE9sp6dF9xP9km89A2fVPZdIVWG4vYlw6Vy7AO26nYknIplyd6RIsr0RvdHDQbEZK9UZSMb7ZYB4ohDv0L-w8pKo2-WS5xQ_jSRFxPXh1hxu7mU0tV8k1tphngp5C-CQv3hgcTqlu_FylfeuCRkZ7YoIUx0LbaOoC2Z1dE1c-BDdiAqO';
$recipientId = '2970163350482099819';
$message = 'Hello, this is a test message from Zalo!';

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
