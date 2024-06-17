<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "ivano_website";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn để lấy sản phẩm có id_sanpham lớn nhất
$sql_max_id = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
               FROM products p 
               INNER JOIN categories c ON p.category_id = c.category_id
               INNER JOIN brands b ON p.brand_id = b.brand_id
               INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
               INNER JOIN product_size ps ON p.id_sanpham = ps.id_sanpham
               INNER JOIN sizes s ON ps.size_id = s.size_id
               LEFT JOIN product_images i ON p.id_sanpham = i.id_sanpham
               WHERE p.id_sanpham = (SELECT MAX(id_sanpham) FROM products)";

$result_max_id = $conn->query($sql_max_id);


$max_id_product = null;
if ($result_max_id->num_rows > 0) {
    $max_id_product = $result_max_id->fetch_assoc();
}

if ($max_id_product) {
    echo '<table border="1">';
   
    echo '<tbody>';
    echo '<tr>';
    echo '<td>' . htmlspecialchars($max_id_product['product_id'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['product_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['product_description'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['category_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['brand_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['ProductCategory_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($max_id_product['size_name'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars(number_format($max_id_product['price'], 0, ',', '.'), ENT_QUOTES, 'UTF-8') . ' VNĐ</td>';
    echo '<td><img src="' . htmlspecialchars($max_id_product['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh sản phẩm" style="width:100px;"></td>';
    echo '<td><a href="edit_product.php?id=' . htmlspecialchars($max_id_product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '">Sửa</a> | <a href="delete_product.php?id=' . htmlspecialchars($max_id_product['id_sanpham'], ENT_QUOTES, 'UTF-8') . '">Xóa</a></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Không tìm thấy sản phẩm nào.</p>';
}

$conn->close();
?>


<style>
    .product,
    .statistics {
        position: relative;
    }


    .nav-icons {
        overflow-y: auto;
    }

    .nav-icons::-webkit-scrollbar {
        width: 0;
    }

    .nav-icons li {
        cursor: pointer;
    }

    .submenu-admin {
        display: none;
        padding: 10px 0;
        z-index: 1000;
    }

    .submenu-admin li {
        padding: 10px 10px;
    }

    .nav-icons ul li.active .submenu-admin {
        display: block;
    }

    .nav-icons ul li {
        position: relative;
    }

    .nav-icons ul li .fa-chevron-down {
        transition: transform 0.4s ease;
    }

    .nav-icons ul li.active .fa-chevron-down {
        transform: rotate(180deg);
    }
</style>



