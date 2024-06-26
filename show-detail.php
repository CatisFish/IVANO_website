<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">
    <title>Thông Tin Sản Phẩm | IVANO</title>
</head>

<body>
    <main id="main-product-detail">
        <?php
        include "assets/header.php";

        // Kiểm tra xem product_id có tồn tại trong URL không
        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];
            include 'php/conection.php';

            // Kiểm tra xem product_id có tồn tại trong cơ sở dữ liệu không
            $checkProductSql = "SELECT * FROM products WHERE product_id = ?";
            $stmtCheck = $conn->prepare($checkProductSql);
            if (!$stmtCheck) {
                echo "Lỗi prepare statement: " . $conn->error;
                exit();
            }
            $stmtCheck->bind_param("s", $productId);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                // Tăng số lượng click cho sản phẩm
                $updateClicksSql = "UPDATE products SET clicks = clicks + 1 WHERE product_id = ?";
                $stmtUpdate = $conn->prepare($updateClicksSql);
                if (!$stmtUpdate) {
                    echo "Lỗi prepare statement: " . $conn->error;
                    exit();
                }
                $stmtUpdate->bind_param("s", $productId);
                if ($stmtUpdate->execute()) {
                    echo "Số lần click đã được cập nhật.";
                } else {
                    echo "Lỗi khi cập nhật số lần click: " . $stmtUpdate->error;
                }
                $stmtUpdate->close();
            } else {
                echo "Product ID không tồn tại";
            }

            $stmtCheck->close();
        } else {
            echo "Không có product ID được truyền qua URL";
        }

        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];

            include "php/conection.php";

            $detailSql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
            FROM products p 
            LEFT JOIN product_images i ON p.product_id = i.product_id
            INNER JOIN categories c ON p.category_id = c.category_id
            INNER JOIN brands b ON p.brand_id = b.brand_id
            INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
            INNER JOIN product_size ps ON p.product_id = ps.product_id
            INNER JOIN sizes s ON ps.size_id = s.size_id
            WHERE p.product_id = ?
            GROUP BY p.product_id, ps.size_id
            LIMIT 3";

            $stmt = $conn->prepare($detailSql);
            $stmt->bind_param("s", $productId);
            $stmt->execute();
            $detailResult = $stmt->get_result();

            if ($detailResult->num_rows > 0) {
                $detailRow = $detailResult->fetch_assoc();
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

                echo '<div class="container-product-id-category">';
                echo '<p class="product-id">MSP: ' . htmlspecialchars($detailRow['product_id'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '<p class="list-category">Danh Mục: ' . htmlspecialchars($detailRow['brand_name'], ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars($detailRow['category_name'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</div>';

                // Hiển thị giá sản phẩm (nếu có)
                if (isset($detailRow['price'])) {
                    $formattedPrice = number_format($detailRow['price'], 0, ',', '.');
                    echo '<div class="product-price" data-base-price="' . htmlspecialchars($detailRow['price'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($formattedPrice, ENT_QUOTES, 'UTF-8') . ' VNĐ</div>';
                } else {
                    echo '<div class="product-price" data-base-price="0">Giá không xác định</div>';
                }

                // Truy vấn để lấy danh sách kích thước của sản phẩm
                $sizeQuery = "SELECT ps.size_id, s.size_name FROM product_size ps INNER JOIN sizes s ON ps.size_id = s.size_id WHERE ps.product_id = ?";
                $stmtSize = $conn->prepare($sizeQuery);
                $stmtSize->bind_param("s", $productId);
                $stmtSize->execute();
                $sizeResult = $stmtSize->get_result();

                echo '<div class="container-size-color">';
                // Hiển thị danh sách kích thước của sản phẩm
                echo '<div class="product-size">';
                echo '<p class="label-detail">Kích Thước:</p>';
                echo '<select name="size" id="size-select" onchange="updateProductDetail()">';
                echo '<option value="">Chọn kích thước</option>';

                // Hiển thị danh sách kích thước trong dropdown
                if ($sizeResult->num_rows > 0) {
                    while ($row = $sizeResult->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['size_id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['size_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có kích thước</option>";
                }

                echo '</select>';
                echo '</div>';

                // Hiển thị thông tin chi tiết về kích thước sẽ được cập nhật bằng JavaScript
                echo '<div id="size-details"></div>';

                echo '<div class="product-color">';
                echo '<p class="label-detail">Đuôi Màu:</p>';
                echo '<select name="color" id="color-select">';
                echo '<option value="">Chọn 1 đuôi màu</option>';
                $colorSql = "SELECT * FROM colorsuffix";
                $colorResult = $conn->query($colorSql);

                // Hiển thị danh sách color suffix trong dropdown
                if ($colorResult->num_rows > 0) {
                    while ($row = $colorResult->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['color_suffix_name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['color_suffix_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có color suffix nào</option>";
                }

                echo '</select>';
                echo '</div>';
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
                echo "<p>Không tìm thấy sản phẩm.</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <script>
            function updateProductDetail() {
                const sizeSelect = document.getElementById('size-select');
                const sizeId = sizeSelect.value;
                const productId = "<?php echo $productId; ?>";

                if (sizeId) {
                    fetch(`get_product_detail.php?product_id=${productId}&size_id=${sizeId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Lỗi mạng');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Cập nhật giá sản phẩm
                                document.querySelector('.product-price').innerText = Number(data.data.price).toLocaleString('vi-VN') + ' VNĐ';
                                document.querySelector('.product-price').dataset.basePrice = data.data.price; // Cập nhật giá cơ bản

                                // Cập nhật hình ảnh sản phẩm
                                document.querySelector('.detail-product-img').src = data.data.full_image_path;
                                document.querySelector('.detail-product-img').alt = data.data.product_name; // Cập nhật alt cho hình ảnh

                            } else {
                                console.error('Lỗi khi cập nhật chi tiết sản phẩm:', data.message);
                                // Xử lý lỗi hiển thị cho người dùng (nếu cần)
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi Fetch:', error);
                            //
                        });
                } else {
                    // Xử lý trường hợp không có size nào được chọn 
                    document.querySelector('.product-price').innerText = "Vui lòng chọn size"; // Hoặc thông báo lỗi khác
                    document.querySelector('.detail-product-img').src = "đường_dẫn_hình_ảnh_mặc_định"; // Hiển thị hình ảnh mặc định
                }
            }

            document.getElementById('color-select').addEventListener('change', function () {
                updatePrice();
            });

            document.querySelector('.product-quantity input').addEventListener('change', function () {
                updatePrice();
            });

            // Lấy các phần tử nút tăng và giảm
            var plusButton = document.querySelector('.plus-quantity');
            var minusButton = document.querySelector('.minus-quantity');
            var quantityInput = document.querySelector('.product-quantity input');

            // Lắng nghe sự kiện click vào nút tăng
            plusButton.addEventListener('click', function () {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                quantityInput.dispatchEvent(new Event('change'));
            });

            // Lắng nghe sự kiện click vào nút giảm
            minusButton.addEventListener('click', function () {
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    quantityInput.dispatchEvent(new Event('change'));
                }
            });

            function updatePrice() {
                var colorSuffix = document.getElementById('color-select').value;
                var basePrice = parseFloat(document.querySelector('.product-price').dataset.basePrice);
                var quantity = parseInt(document.querySelector('.product-quantity input').value);

                var updatedPrice = basePrice;

                switch (colorSuffix) {
                    case 'T':
                        updatedPrice *= 1.1;
                        break;
                    case 'D':
                        updatedPrice *= 1.2;
                        break;
                    case 'A':
                        updatedPrice *= 1.3;
                        break;
                    default:
                        break;
                }

                updatedPrice *= quantity;

                document.querySelector('.product-price').innerText = updatedPrice.toLocaleString('vi-VN') + ' VNĐ';
            }
        </script>

        <div class="detail-info-bottom">
            <div class="info-des">
                <?php include "assets/show-des-plus.php"; ?>
            </div>
        </div>

    </main>
    <?php include "assets/footer.php"; ?>
</body>

</html>

<style>
    #main-product-detail{
        padding-top: 150px;
    }
    .product-detail-container {
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
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin: 20px auto;
    }

    .detail-left {
        width: 500px;
        height: 500px;
        margin-right: 20px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        border-right: 1px solid #000;

    }

    .detail-left img {
        width: 450px;
    }

    .detail-right {
        margin-left: 20px;
    }

    .product-name {
        font-size: 24px;
        text-transform: uppercase;
        font-weight: 700;
        color: #dd9933;
    }

    .product-price {
        font-size: 20px;
        color: #ED1C24;
        font-weight: 600;
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
        margin-bottom: 15px;
    }

    .container-size-color {
        display: flex;
        gap: 10%;
    }

    .product-size,
    .product-color {
        margin-top: 20px;
        font-size: 15px;
    }


    #size-select,
    #color-select {
        margin-top: -5px;
        font-size: 15px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
        width: 200px;
        cursor: pointer;
        outline: none;
        color: #333;
    }

    #size-select:focus,
    #color-select:focus {
        border-color: #4caf50;
    }


    #size-select,
    #color-select {
        transition: all 0.3s ease;
    }

    #size-select:active,
    #color-select:active {
        border-color: #4caf50;
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
        color: #fff;
        transition: all ease-in-out 0.3s;
        background-color: #55D5D2;
    }

    .minus-quantity:hover,
    .plus-quantity:hover {
        background-color: #F58F5D;
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
        text-align: center;
    }

    .add-to-cart {
        padding: 20px 70px;
        background-color: #55D5D2;
        color: #fff;
        border: none;
        font-weight: 700;
        cursor: pointer;
        text-transform: uppercase;
        transition: all ease-in-out 0.3s;
        border-radius: 20px;
    }

    .add-to-cart:hover {
        background-color: #F58F5D;
    }
</style>