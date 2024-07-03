<?php
include 'php/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sanpham = $_POST['id_sanpham'];

    // Xóa thời gian flashsale trước
    $sql_time = "DELETE FROM time_flashsale WHERE flashsale_id IN (SELECT flashsale_id FROM flashsale WHERE id_sanpham = ?)";
    $stmt_time = $conn->prepare($sql_time);
    $stmt_time->bind_param("i", $id_sanpham);
    $stmt_time->execute();
    $stmt_time->close();

    // Xóa flashsale
    $sql_flashsale = "DELETE FROM flashsale WHERE id_sanpham = ?";
    $stmt_flashsale = $conn->prepare($sql_flashsale);
    $stmt_flashsale->bind_param("i", $id_sanpham);
    $stmt_flashsale->execute();
    $stmt_flashsale->close();
}

$conn->close();
?>
