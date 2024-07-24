<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/config.php'; // Tệp cấu hình kết nối cơ sở dữ liệu của bạn

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (isset($_GET['od_id'])) {
    $od_id = $_GET['od_id'];

    // Kết nối cơ sở dữ liệu
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu đơn hàng
    $sql_order = "SELECT * FROM orders WHERE od_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("s", $od_id);
    $stmt_order->execute();
    $order = $stmt_order->get_result()->fetch_assoc();

    $sql_details = "SELECT * FROM order_details WHERE od_id = ?";
    $stmt_details = $conn->prepare($sql_details);
    $stmt_details->bind_param("s", $od_id);
    $stmt_details->execute();
    $result_details = $stmt_details->get_result();

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    $section->addText('CÔNG TY CỔ PHẦN IVANO VIỆT NAM', array('bold' => true, 'size' => 16));
    $section->addText('Địa chỉ: Số 36, KDC Hàng Bàng, Phường An Khánh, Quận Ninh Kiều, TP Cần Thơ');
    $section->addText('Hotline: 0886 277772');
    $section->addText('PHIẾU XUẤT KHO KÈM HÓA ĐƠN BÁN HÀNG', array('bold' => true, 'size' => 14));

    $section->addText('Tên khách hàng: ' . $order['od_name']);
    $section->addText('Địa chỉ giao hàng: ' . $order['od_address']);
    $section->addText('SDT Người nhận hàng: ' . $order['receiver_tell']);
    $section->addText('Diễn giải: Bán hàng cho NVKD');
    $section->addText('Xuất tại kho: ' . $order['wherehouse']);
    $section->addText('Chành xe: tìm xe hộ');
    $section->addText('Số phiếu đơn hàng: ' . $order['od_id']);
    $section->addText('Người phụ trách đơn hàng: ' . $order['employee_id']);
    $section->addText('SDT: ' . $order['od_tell']);

    $table = $section->addTable();
    $table->addRow();
    $table->addCell(1000)->addText('STT');
    $table->addCell(2000)->addText('Tên Hàng');
    $table->addCell(1000)->addText('DVT');
    $table->addCell(1000)->addText('Thể Tích');
    $table->addCell(1000)->addText('Số Lượng');
    $table->addCell(1000)->addText('Mã Màu');
    $table->addCell(1000)->addText('Đơn Giá');


    $stt = 1;
    while ($detail = $result_details->fetch_assoc()) {
        $details_array = explode(" - ", $detail['od_info']);
        $product_name = $details_array[0] ?? '';
        $product_V = $details_array[1] ?? '';
        $quantity = $details_array[2] ?? '';
        $dvt = $quantity <= 5 ? 'Lon' : 'Thùng';
        $color_code = $details_array[3] ?? '';

        $table->addRow();
        $table->addCell(1000)->addText($stt);
        $table->addCell(2000)->addText($product_name);
        $table->addCell(1000)->addText($dvt);
        $table->addCell(1000)->addText($product_V);
        $table->addCell(1000)->addText($quantity);
        $table->addCell(1000)->addText($color_code);

        $stt++;
    }

    $section->addText('Tổng tiền: ' . $order['od_total_price']);
    $section->addText('Người lập phiếu: __________________');
    $section->addText('Người nhận hàng: __________________');
    $section->addText('Người giao hàng: __________________');
    $section->addText('Thủ kho: __________________');

    $fileName = "Order_" . $order['od_id'] . ".docx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
    exit;
} else {
    echo "Không có mã đơn hàng.";
}
?>
