<?php
include '../php/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM comments WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Comment đã được xóa thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
}
?>
