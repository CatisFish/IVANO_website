<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/global.css">
    <title>Thông Tin Sản Phẩm | IVANO</title>
</head>

<body>
    <main id="main-product-detail">
        <?php
        include "assets/header.php";

        // Kiểm tra xem product_id đã được truyền qua URL hay không
        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];

            include "php/conection.php";

            // Cập nhật số lần click cho sản phẩm có product_id tương ứng
            $updateClicksSql = "UPDATE products SET clicks = clicks + 1 WHERE product_id = ?";
            $stmt = $conn->prepare($updateClicksSql);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $stmt->close();

            // Truy vấn chi tiết sản phẩm
            $detailSql = "SELECT p.*, pi.path_image, b.brand_name, c.category_name
                        FROM products p
                        LEFT JOIN product_images pi ON p.product_id = pi.product_id
                        LEFT JOIN brands b ON p.brand_id = b.brand_id
                        LEFT JOIN categories c ON p.category_id = c.category_id
                        WHERE p.product_id = ?
                        LIMIT 1";

            $stmt = $conn->prepare($detailSql);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $detailResult = $stmt->get_result();
        }
        if ($detailResult->num_rows > 0) {
            $detailRow = $detailResult->fetch_assoc();

            // Hiển thị thông tin chi tiết sản phẩm
            echo '<div class="product-detail-container">';
            echo '<div class="product-detail-link">';
            echo '<a href="index.php">Trang Chủ</a> <i class="fa-solid fa-chevron-right"></i> ';
            echo '<a href="#">' . htmlspecialchars($detailRow['brand_name'], ENT_QUOTES, 'UTF-8') . '</a> <i class="fa-solid fa-chevron-right"></i> ';
            echo '<a href="#">' . htmlspecialchars($detailRow['product_name'], ENT_QUOTES, 'UTF-8') . '</a>';
            echo '</div>';

            echo '<div class="product-detail">';
            echo '<div class="detail-left">';
            echo "<img class='detail-product-img' src='uploads/" . htmlspecialchars($detailRow['path_image'], ENT_QUOTES, 'UTF-8') . "' alt='Hình ảnh " . htmlspecialchars($detailRow["product_name"], ENT_QUOTES, 'UTF-8') . "'>";
            echo '</div>';

            echo '<div class="detail-right">';
            echo '<div class="product-name">' . htmlspecialchars($detailRow['product_name'], ENT_QUOTES, 'UTF-8') . '</div>';
            echo '<p class="product-price">Giá: ' . htmlspecialchars($detailRow['product_price'], ENT_QUOTES, 'UTF-8') . '</p>';

            echo '<div class="container-product-id-category">';
            echo '<p class="product-id">MSP: ' . htmlspecialchars($detailRow['product_id'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="list-category">Danh Mục: ' . htmlspecialchars($detailRow['brand_name'], ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars($detailRow['category_name'], ENT_QUOTES, 'UTF-8') . '</p>';

            echo '</div>';

            echo '<div class="product-size">';
            echo '<p class="label-detail">Kích Thước:</p>';
            echo '<select name="" id="size-select">';
            echo '<option value="">Chọn kích thước</option>';

            $sql = "SELECT * FROM sizes";
            $result = $conn->query($sql);

            // Hiển thị danh sách size trong dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['size_id'] . "'>" . $row['size_name'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có size nào</option>";
            }
            echo '</select>';
            echo '</div>';

            echo '<div class="product-color">';
            echo '<p class="label-detail">Đuôi Màu:</p>';
            echo '<select name="" id="color-select">';
            echo '<option value="">Chọn 1 đuôi màu</option>';

            $sql = "SELECT * FROM colorsuffix";
            $result = $conn->query($sql);

            // Hiển thị danh sách color suffix trong dropdown
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['color_suffix_name'] . "'>" . $row['color_suffix_name'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có color suffix nào</option>";
            }

            echo '</select>';
            echo '</div>';

            echo '<div class="product-quantity">';
            echo '<button class="minus-quantity"><i class="fa-solid fa-minus"></i></button>';
            echo '<input type="number" min="1" max="100" value="1">';
            echo '<button class="plus-quantity"><i class="fa-solid fa-plus"></i></button>';
            echo '</div>';

            echo '<div class="product-des">';
            echo '<p>' . htmlspecialchars($detailRow['product_description'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '</div>';

            echo '<p class="id-language">Mã: <span> N/A </span></p>';

            echo '<div class="container-btn-add">';
            echo '<button type="submit" class="add-to-cart">Thêm Vào Giỏ Hàng</button>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }

        $stmt->close();
        $conn->close();

        ?>
        <div class="detail-info-bottom">
            <div class="info-des">
                <h2>Tính năng vượt trội:</h2>
                <!-- Thêm các tính năng vượt trội của sản phẩm ở đây -->
            </div>
        </div>
    </main>
</body>

<style>
    <style>.product-detail-container {
        width: 90%;
        margin: 20px auto;
    }

    .product-detail-link {
        color: #dd9933;
        transition: all ease-in-out 0.3s;
    }

    .product-detail-link a {
        font-size: 18px;
        font-weight: 600;
        color: #221F20;
        transition: all ease-in-out 0.3s;
    }

    .product-detail-link a:hover {
        color: #dd9933;
    }

    .product-detail {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .detail-left img {
        width: 510px;
        height: 612px;
    }

    .detail-right {}

    .product-name {
        font-size: 24px;
        text-transform: uppercase;
        font-weight: 700;
        color: #dd9933;
    }

    .product-price {
        font-size: 20px;
        color: #ED1C24;
        font-weight: 500;
        margin-top: 20px;
    }

    .container-product-id-category {
        margin-top: 20px;
        display: flex;
        font-size: 18px;
        gap: 30px;
        color: #1E90FF;
        font-weight: 500;
    }

    .label-detail {
        font-weight: 600;

    }

    .product-size,
    .product-color {
        margin-top: 20px;
        font-size: 15px;
    }

    #size-select,
    #color-select {
        margin-top: 10px;
        font-size: 15px;
    }

    .product-quantity {
        margin-top: 20px;
    }

    .product-quantity input[type=number] {
        width: 100px;
        height: 30px;
        padding: 0 10px;
        margin: 0 20px;
    }

    .minus-quantity,
    .plus-quantity {
        width: 50px;
        height: 30px;
        cursor: pointer;
        border: none;
        background-color: #dd9933;
        color: #fff;
        transition: all ease-in-out 0.3s;
    }

    .minus-quantity:hover,
    .plus-quantity:hover {
        background-color: #fb9c0d;
    }

    .product-des {
        margin-top: 20px;
    }

    .id-language {
        margin-top: 20px;
        color: #1E90FF;
        font-weight: 600;
    }

    .container-btn-add {
        margin-top: 20px;
    }

    .add-to-cart {
        padding: 20px 70px;
        background-color: #dd9933;
        color: #fff;
        border: none;
        font-weight: 700;
        cursor: pointer;
        text-transform: uppercase;
        transition: all ease-in-out 0.3s;
    }

    .add-to-cart:hover {
        background-color: #fb9c0d;
    }
</style>

</html>