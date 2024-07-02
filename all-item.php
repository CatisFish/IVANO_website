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


    <title>Sản Phẩm | IVANO</title>
</head>

<style>
    .form-show-all-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        font-size: 15px;
    }

    form label {
        text-align: left;
        margin-top: 10px;
    }

    form select,
    form button {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 13px;
    }

    form select:focus,
    form button:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    form select,
    form button {
        cursor: pointer;
    }

    .selected-filters {
        margin-top: 40px;
    }

    .selected-filters p {
        text-align: center;
        font-size: 17px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .list-selected-filter {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .selected-filter-item {
        background-color: #55D5D2;
        color: #FFF;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 600;
        margin-bottom: 10px;
    }
</style>

<body>
    <?php
    include "assets/header.php";
    ?>

    <main id="main-all-item">
        <section class="header-all-item">
            <div class="header-link">
                <a href="index.php">Trang Chủ</a> <i class="fa-solid fa-angle-right" style="margin: 0 5px;"></i> <a
                    href="all-item.php">Sản Phẩm</a>
            </div>

            <div class="container-filter-btn">
                <label for="sort">Bộ sắp xếp:</label>
                <select id="sort">
                    <option>Chọn 1 cách sắp xếp</option>
                    <option value="product-price-asc">Thứ tự theo giá: Thấp đến Cao</option>
                    <option value="product-price-desc">Thứ tự theo giá: Cao xuống Thấp</option>
                </select>
            </div>
        </section>

        <section class="content-all-item">
            <div class="left-content-all-item">
                <div class="container-brands-all-item">
                    <h3>Bộ Lọc</h3>

                    <?php
                    // Kết nối đến cơ sở dữ liệu
                    include 'php/conection.php';

                    // Lấy danh sách các thương hiệu
                    $sql_brands = "SELECT * FROM brands";
                    $result_brands = $conn->query($sql_brands);
                    $brands = array();
                    if ($result_brands->num_rows > 0) {
                        while ($row = $result_brands->fetch_assoc()) {
                            $brands[] = $row;
                        }
                    }

                    // Lấy danh sách các kích thước
                    $sql_sizes = "SELECT * FROM sizes";
                    $result_sizes = $conn->query($sql_sizes);
                    $sizes = array();
                    if ($result_sizes->num_rows > 0) {
                        while ($row = $result_sizes->fetch_assoc()) {
                            $sizes[] = $row;
                        }
                    }

                    // Lấy nhãn hiệu, kích thước và sắp xếp đã chọn từ biểu mẫu
                    $selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : '';
                    $selectedSize = isset($_GET['size']) ? $_GET['size'] : '';
                    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : '';
                    ?>

                    <form method="GET" action="" class="form-show-all-item">
                        <label for="brand">Chọn thương hiệu:</label>
                        <select class="option_brand" name="brand" id="brand">
                            <option value="">Tất cả</option>
                            <?php foreach ($brands as $brand): ?>
                                <option class="option_brand" value="<?php echo $brand['brand_id']; ?>" <?php if ($brand['brand_id'] == $selectedBrand)
                                       echo 'selected'; ?>>
                                    <?php echo $brand['brand_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="size">Chọn kích thước:</label>
                        <select class="option_size" name="size" id="size">
                            <option value="">Tất cả</option>
                            <?php foreach ($sizes as $size): ?>
                                <option class="option_size" value="<?php echo $size['size_id']; ?>" <?php if ($size['size_id'] == $selectedSize)
                                       echo 'selected'; ?>>
                                    <?php echo $size['size_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <button class="option_size_brand_btn" type="submit">Lọc</button>
                    </form>

                    <div class="selected-filters">
                        <p>Đang lọc theo</p>
                        <ul class="list-selected-filter">
                            <?php if ($selectedBrand != ''): ?>
                                <li class="selected-filter-item">
                                    <?php echo $brands[array_search($selectedBrand, array_column($brands, 'brand_id'))]['brand_name']; ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($selectedSize != ''): ?>
                                <li class="selected-filter-item">
                                    <?php echo $sizes[array_search($selectedSize, array_column($sizes, 'size_id'))]['size_name']; ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($sortOrder == 'asc'): ?>
                                <li>Sắp xếp giá: Thấp đến cao</li>
                            <?php elseif ($sortOrder == 'desc'): ?>
                                <li>Sắp xếp giá: Cao đến thấp</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="right-content-all-item">
                <?php include "assets/show-all-item.php"; ?>
            </div>
        </section>
    </main>

    <?php include "assets/footer.php"; ?>
</body>

</html>

<style>
    #main-all-item {
        width: 90%;
        margin: 0px auto;
        font-size: 20px;
    }

    .option_size,
    .option_brand {
        font-size: 16px;
        margin-top: 5px;
    }

    .option_size_brand_btn {
        padding: 10px;
        display: inline-block;
        border: none;
        color: #FFF;
        background-color: #55D5D2;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
        margin-top: 30px;
    }

    .option_size_brand_btn:hover {
        background-color: #DD9933;
    }

    .header-all-item {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        padding: 10px 0;
        align-items: center;
        font-weight: 600;
        font-size: 18px;
        transition: all ease-in-out 0.3s;
    }

    .header-all-item a:hover {
        color: #DD9933;
    }

    .content-all-item {
        display: flex;
        position: relative;
        margin-bottom: 50px;
    }

    .container-filter-btn {
        align-items: center;
    }

    .container-filter-btn label {
        font-weight: bold;
        margin-right: 20px;
    }

    .container-filter-btn select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .container-filter-btn select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .container-filter-btn select {
        cursor: pointer;
    }

    .right-content-all-item {
        width: 80%;
        margin-left: 25%;
    }
</style>

<style>
    .left-content-all-item {
        width: 20%;
        position: absolute;
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 10px;
    }

    .left-content-all-item h3 {
        font-size: 18px;
        margin-bottom: 30px;
        text-align: center;
    }
</style>

</html>