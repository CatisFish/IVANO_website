<?php
include 'php/conection.php';

$productsPerPage = 9;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $productsPerPage;

$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
$selectedSize = isset($_GET['size']) ? $_GET['size'] : '';
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT p.*, c.category_name, b.brand_name, pc.ProductCategory_name, ps.price, s.size_name, i.path_image 
        FROM products p 
        LEFT JOIN product_images i ON p.product_id = i.product_id
        INNER JOIN categories c ON p.category_id = c.category_id
        INNER JOIN brands b ON p.brand_id = b.brand_id

        INNER JOIN productcategory pc ON p.ProductCategory_id = pc.ProductCategory_id
        INNER JOIN product_size ps ON p.product_id = ps.product_id
        INNER JOIN sizes s ON ps.size_id = s.size_id";

$whereConditions = array();

if ($selectedBrand != '') {
    $whereConditions[] = "p.brand_id = ?";
}
if ($selectedSize != '') {
    $whereConditions[] = "s.size_id = ?";
}
if ($searchQuery != '') {
    $whereConditions[] = "(p.product_name LIKE ? OR c.category_name LIKE ? OR b.brand_name LIKE ?)";
}

if (count($whereConditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $whereConditions);
}

if ($sortOrder == 'asc') {
    $sql .= " ORDER BY ps.price ASC";
} elseif ($sortOrder == 'desc') {
    $sql .= " ORDER BY ps.price DESC";
}

$sql .= " GROUP BY p.product_id, ps.size_id";

$sql .= " LIMIT $productsPerPage OFFSET $offset";

$stmt = $conn->prepare($sql);

$params = array();
$types = "";

if ($selectedBrand != '') {
    $params[] = $selectedBrand;
    $types .= "i";
}
if ($selectedSize != '') {
    $params[] = $selectedSize;
    $types .= "i";
}
if ($searchQuery != '') {
    $searchParam = "%$searchQuery%";
    $params[] = $searchParam;
    $params[] = $searchParam;
    $params[] = $searchParam;
    $types .= "sss";
}

if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<section class="container-list-all-product">';
    echo '<div class="list-all-product">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item-all-item">';
        echo '<a href="show-detail.php?product_id=' . $row['product_id'] . '" class="container-info-all-item">';

        echo '<div class="container-img-all-item">';
        echo '<img class="product-img-all-item" src="admin/' . htmlspecialchars($row['path_image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '">';
        echo '</div>';

        echo '<div class="product-info-all-item">';
        echo '<p class="brand-name-all-item">' . 'SƠN ' . htmlspecialchars($row['brand_name'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p class="product-name-all-item">' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<div class="product-price-item"><span>' . htmlspecialchars(number_format($row['price'], 0, ',', '.')) . ' VNĐ </span><i class="fa-solid fa-arrow-right"></i></div>';
        echo '</div>';
        echo '</a>';
        echo '</div>'; // Đóng product-item
    }
    echo '</div>'; // Đóng list-all-product
    echo '</section>'; // Đóng container-list-all-product
} else {
    echo "<p class='no-products'>Không có sản phẩm nào.</p>";
}

$totalProductsSQL = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = $conn->query($totalProductsSQL);
$totalProductsRow = $totalProductsResult->fetch_assoc();
$totalProducts = $totalProductsRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

echo '<div class="pagination">';

if ($current_page > 1) {
    echo "<a href='?page=" . ($current_page - 1) . "'><i class='fa-solid fa-angles-left'></i> Previous</a> ";
}

for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $current_page) ? 'active' : '';
    echo "<a href='?page=$i' class='$activeClass'>$i</a> ";
}

if ($current_page < $totalPages) {
    echo "<a href='?page=" . ($current_page + 1) . "'>Next <i class='fa-solid fa-angles-right'></i></a>";
}

echo '</div>';

$conn->close();
?>

<style>
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        font-size: 15px;
        display: inline-block;
        padding: 10px 15px;
        margin: 0 5px;
        background-color: #55D5D2;
        color: #FFF;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
    }

    .pagination a:hover {
        background-color: #F58F5D;
    }

    .pagination .active {
        background-color: #F58F5D;
    }
</style>

<style>
    .list-all-product {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-item-all-item {
        width: calc(33% - 15px);
        border-radius: 20px;
        box-sizing: border-box;
        margin-bottom: 30px;
        position: relative;
        padding: 0 10px;
        transition: transform ease-in-out 0.3s;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @-webkit-keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    .product-item-all-item:hover .container-img-all-item .product-img-all-item {
        transform: translateY(-35px);
    }

    .product-item-all-item:hover .product-name-all-item {
        color: #F58F5D;
    }

    .container-img-all-item {
        height: 350px;
        display: flex;
        align-items: flex-end;
    }

    .product-img-all-item {
        width: 100%;
        height: auto;
        transition: transform ease-in-out 0.3s;
    }

    .product-info-all-item {
        padding: 0 5px;
        margin-top: -10px;
    }

    .brand-name-all-item {
        color: #333;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
        margin: 10px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .product-name-all-item {
        margin-bottom: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        max-height: 45px;
        font-weight: 700;
        color: #221F20;
        font-size: 16px;
        transition: color ease-in-out 0.3s;
    }

    .product-price-item {
        display: flex;
        color: #FFF;
        font-weight: 600;
        margin: 10px 0 10px 0;
        justify-content: space-between;
        padding: 15px 15px;
        background-color: #55D5D2;
        border-radius: 25px;
        align-items: center;
        transition: all ease-in-out 0.3s;
    }

    .product-item-all-item:hover .product-price-item {
        background-color: #F58F5D;
    }

    .product-price-item i {
        display: inline-block;
        transform: rotate(315deg);
        transition: transform 0.3s ease;
    }

    .product-item-all-item:hover .product-price-item i {
        transform: rotate(0deg);
    }
</style>