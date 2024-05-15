<?php
// Kết nối đến MySQL
$servername = "localhost";
$username = "root";
$password = "";
$database = "ivano_website";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
