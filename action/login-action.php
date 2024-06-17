<?php
session_start();

include '../php/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($conn) {
            $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
    
                $_SESSION['username'] = $username;
    
                if ($user['role_id'] == 1) {
                    header("Location: ../admin/index.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                $error_message = "Invalid username or password!";
            }
        } else {
            $error_message = "Database connection error!";
        }
    } else {
        $error_message = "Please provide username and password!";
    }
}
?>
