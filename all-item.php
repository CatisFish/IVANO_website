<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">


    <title>Sản Phẩm | IVANO</title>
</head>

<body>
    <?php
    include "assets/header.php";
    ?>

    <main id="main-all-item">
        <section class="header-all-item">
            <div class="header-link">
                <a href="index.php">Trang Chủ</a> <i class="fa-solid fa-angle-right" style="margin: 0 5px;"></i> <a href="all-item.php">Sản Phẩm</a>
            </div>

            <div class="container-filter-btn">
                <label for="sort">Bộ lọc:</label>
                <select id="sort" onchange="sortItems()">
                    <option>Chọn 1 cách lọc</option>
                    <option value="product-price-asc">Thứ tự theo giá: Thấp đến Cao</option>
                    <option value="product-price-desc">Thứ tự theo giá: Cao xuống Thấp</option>
                </select>
            </div>
        </section>

        <section class="content-all-item">
            <div class="left-content-all-item">
                <div class="container-brands-all-item">
                    <h3>DANH MỤC</h3>
                    <p>Sơn IVANO</p>
                    <p>Sơn MEKONG</p>
                </div>
            </div>

            <div class="right-content-all-item">
                <?php include "assets/show-all-item.php"; ?>
            </div>
        </section>
    </main>
</body>

<style>
    #main-all-item {
        width: 90%;
        margin: 0px auto;
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

    .header-all-item a:hover{
        color: #DD9933;
    }

    .content-all-item {
        display: flex;
        position: relative;
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

    .left-content-all-item {
        width: 20%;
        position: fixed;
    }

    .right-content-all-item {
        width: 80%;
        margin-left: 20%;
    }
</style>

<script>
    function sortItems() {
        var sortValue = document.getElementById("sort").value;
        var productList = document.querySelectorAll(".product-item-all-item");

        var productListArray = Array.from(productList);

        if (sortValue === "product-price-asc") {
            productListArray.sort((a, b) => {
                var priceA = parseFloat(a.querySelector(".product-price-all-item").textContent.replace(/\D/g, ''));
                var priceB = parseFloat(b.querySelector(".product-price-all-item").textContent.replace(/\D/g, ''));
                return priceA - priceB;
            });
        } else if (sortValue === "product-price-desc") {
            productListArray.sort((a, b) => {
                var priceA = parseFloat(a.querySelector(".product-price-all-item").textContent.replace(/\D/g, ''));
                var priceB = parseFloat(b.querySelector(".product-price-all-item").textContent.replace(/\D/g, ''));
                return priceA - priceB;
            });
            productListArray.reverse(); // Đảo ngược kết quả sắp xếp
        }

        var parent = document.querySelector(".list-all-product");
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }

        productListArray.forEach(product => {
            parent.appendChild(product);
        });
    }
</script>

</html>