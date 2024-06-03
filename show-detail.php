<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">
    <title>Thông Tin Sản Phẩm | IVANO</title>
</head>

<body>
    <main id="main-product-detail">
    <?php
include "assets/header.php";

// Kiểm tra xem product_id đã được truyền qua URL hay không
if (isset($_GET['product_id'])) {
    // Lấy product_id từ tham số truyền qua URL
    $productId = $_GET['product_id'];

    // Bao gồm tệp kết nối đến cơ sở dữ liệu
    include 'php/conection.php';

    // Kiểm tra xem product_id có tồn tại trong cơ sở dữ liệu hay không
    $checkProductSql = "SELECT * FROM products WHERE product_id = ?";
    $stmtCheck = $conn->prepare($checkProductSql);
    $stmtCheck->bind_param("s", $productId);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        // Nếu product_id tồn tại, thực hiện cập nhật cột clicks
        $updateClicksSql = "UPDATE products SET clicks = clicks + 1 WHERE product_id = ?";
        $stmtUpdate = $conn->prepare($updateClicksSql);
        $stmtUpdate->bind_param("s", $productId);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // Xử lý khi product_id không tồn tại trong cơ sở dữ liệu
        echo "Product ID không tồn tại";
    }

    $stmtCheck->close();
} else {
    // Xử lý khi không có product_id được truyền qua URL
    echo "Không có product ID được truyền qua URL";
}

// Truy vấn chi tiết sản phẩm
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
        
        // Hiển thị giá sản phẩm (nếu có)
        if (isset($detailRow['price'])) {
            echo '<div class="product-price">' . htmlspecialchars(number_format($detailRow['price'], 0, ',', '.')) . ' VNĐ</div>';
        } else {
            echo '<div class="product-price">Giá không xác định</div>';
        }
        
        echo '<div class="container-product-id-category">';
        echo '<p class="product-id">MSP: ' . htmlspecialchars($detailRow['product_id'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p class="list-category">Danh Mục: ' . htmlspecialchars($detailRow['brand_name'], ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars($detailRow['category_name'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</div>';

       
        // Truy vấn để lấy danh sách kích thước của sản phẩm
        $sizeQuery = "SELECT ps.size_id, s.size_name FROM product_size ps INNER JOIN sizes s ON ps.size_id = s.size_id WHERE ps.product_id = ?";
        $stmtSize = $conn->prepare($sizeQuery);
        $stmtSize->bind_param("s", $productId);
        $stmtSize->execute();
        $sizeResult = $stmtSize->get_result();
        
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
} else {
    echo "<p>Không tìm thấy sản phẩm.</p>";
    }
    ?>
    
    <div class="detail-info-bottom">
        <div class="info-des">
            <h2>Tính năng vượt trội:</h2>
            <!-- Thêm các tính năng vượt trội của sản phẩm ở đây -->
        </div>
    </div>
    </main>
    </body>
    </html>
    <script>
function updateProductDetail() {
    var productId = "<?php echo $productId; ?>"; // Lấy product_id từ PHP
    var selectedSize = document.getElementById("size-select").value;

    // Gửi yêu cầu AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "update_product_detail.php?product_id=" + productId + "&size=" + selectedSize, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Xử lý kết quả trả về
            var response = xhr.responseText;
            // Cập nhật thông tin sản phẩm trên trang
            document.getElementById("size-details").innerHTML = response;
        }
    };
    xhr.send();
}
</script>
   

<div class="detail-info-bottom">
    <div class="info-des">
        <h2>Tính năng vượt trội:</h2>
        <!-- Thêm các tính năng vượt trội của sản phẩm ở đây -->
    </div>
</div>
</main>
</body>
</html>

   
    



<style>
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
        width: 85%;
        display: flex;
        justify-content: space-between;
        margin: 20px auto;
    }

    .detail-left img {
        width: 510px;
        height: 612px;
        margin-right: 20px;
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