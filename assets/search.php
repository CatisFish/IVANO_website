<?php
include "header.php";
include "../php/conection.php"; // Kết nối cơ sở dữ liệu

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Truy vấn SQL để tìm kiếm sản phẩm
$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
        FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id
        INNER JOIN categories c ON p.category_id = c.category_id
        INNER JOIN brands b ON p.brand_id = b.brand_id
        INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
        INNER JOIN product_size ps ON p.product_id = ps.product_id
        INNER JOIN sizes s ON ps.size_id = s.size_id
        WHERE p.product_name LIKE '%$searchQuery%' OR c.category_name LIKE '%$searchQuery%' OR b.brand_name LIKE '%$searchQuery%' 
        GROUP BY p.product_id, ps.size_id";

$result = $conn->query($sql);
?>

<main id="main-all-item">
    <section class="header-all-item">
        <div class="header-link">
            <a href="index.php">Trang Chủ</a> <i class="fa-solid fa-angle-right" style="margin: 0 5px;"></i> <a href="search.php">Kết Quả Tìm Kiếm</a>
        </div>
        <div class="container-filter-btn">
            <h2>Kết Quả Tìm Kiếm Cho: "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
        </div>
    </section>

    <section class="content-all-item">
        <div class="right-content-all-item">
            <?php
            // Hiển thị sản phẩm tìm kiếm
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row['path_image'] . "' alt='" . $row['product_name'] . "'>";
                    echo "<p>" . $row['product_name'] . "</p>";
                    echo "<p>Giá: " . $row['price'] . " VND</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Không tìm thấy sản phẩm nào.</p>";
            }
            ?>
        </div>
    </section>
</main>

<?php
include "footer.php";
?>
