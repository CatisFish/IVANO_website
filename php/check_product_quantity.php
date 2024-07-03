<?php
include 'php/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sanpham = $_POST['id_sanpham'];

    // Truy vấn để lấy số lượng sản phẩm còn lại
    $sql = "SELECT quantity FROM flashsale WHERE id_sanpham = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sanpham);
    $stmt->execute();
    $stmt->bind_result($quantity);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(array("quantity" => $quantity));
}

$conn->close();
?>
