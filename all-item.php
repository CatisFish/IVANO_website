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
                <label for="sort">Bộ sắp xếp:</label>
                <select id="sort" onchange="sortItems()">
                    <option>Chọn 1 cách sắp xếp</option>
                    <option value="product-price-asc">Thứ tự theo giá: Thấp đến Cao</option>
                    <option value="product-price-desc">Thứ tự theo giá: Cao xuống Thấp</option>
                </select>
            </div>
        </section>

        <section class="content-all-item">
            <div class="left-content-all-item">
                <div class="container-brands-all-item">
                    <h3>DANH MỤC</h3>
                    <ul class="menu-all-item">
            <li onclick="toggleSubmenu(this)">Sơn IVANO <i class="fa-solid fa-angle-down"></i>
                <ul class="submenu-all-item">
                    <li onclick="submenuItemClicked(event)">Sơn chống thấm</li>
                    <li onclick="submenuItemClicked(event)">Sơn lót</li>
                </ul>
            </li>
            <li onclick="toggleSubmenu(this)">Sơn MEKONG <i class="fa-solid fa-angle-down"></i>
                <ul class="submenu-all-item">
                    <li onclick="submenuItemClicked(event)">Sơn chống thấm</li>
                    <li onclick="submenuItemClicked(event)">Sơn lót</li>
                </ul>
            </li>
        </ul>
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

    .header-all-item a:hover {
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

    .right-content-all-item {
        width: 80%;
        margin-left: 25%;
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

<style>
    .left-content-all-item {
            width: 20%;
            position: fixed;
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
        .menu-all-item {
            font-size: 16px;
            margin: 10px 0;
            list-style-type: none;
            transition: all ease-in-out 0.3s; 
        }
        .menu-all-item li {
            cursor: pointer;
            margin: 20px 0;
            position: relative;
            font-weight: 600;
            transition: all ease-in-out 0.3s;
        }
        .menu-all-item li i {
           margin-left: 10px;
        }
        .submenu-all-item {
            margin-left: 20px;
            font-size: 14px;
            list-style-type: none;
            opacity: 0;
            visibility: hidden;
            height: 0;
            overflow: hidden;
            transform: translateY(-20px);
            transition: opacity 0.5s ease, visibility 0.5s ease, height 0.5s ease, transform 0.5s ease;
        }
        .submenu-all-item li {
            margin: 20px 0;
            font-weight: 500;
        }
        .menu-all-item li.active .submenu-all-item {
            opacity: 1;
            visibility: visible;
            height: auto;
            transform: translateY(0);
            overflow: visible; 
        }

        /* Hiệu ứng hover cho menu cấp 1 */
.menu-all-item > li:hover {
    color: #DD9933;
}

/* Loại bỏ hiệu ứng hover cho submenu */
.submenu-all-item li:hover {
    color: initial;
}

/* Loại bỏ hiệu ứng hover cho menu cấp 1 khi submenu đang hiển thị */
.menu-all-item > li.active:hover {
    color: initial;
}

/* Hiệu ứng hover cho các mục submenu khi submenu đang hiển thị */
.menu-all-item > li.active .submenu-all-item li:hover {
    color: #DD9933;
}









</style>

<script>
     function toggleSubmenu(element) {
            const menuItems = document.querySelectorAll('.menu-all-item > li');

            menuItems.forEach(item => {
                if (item !== element) {
                    item.classList.remove('active');
                    const submenu = item.querySelector('.submenu-all-item');
                    const icon = item.querySelector('i');
                    if (submenu) {
                        submenu.style.opacity = '0';
                        submenu.style.visibility = 'hidden';
                        submenu.style.height = '0';
                        submenu.style.transform = 'translateY(-20px)';
                        icon.classList.remove('fa-angle-up');
                        icon.classList.add('fa-angle-down');
                    }
                }
            });

            element.classList.toggle('active');
            const submenu = element.querySelector('.submenu-all-item');
            const icon = element.querySelector('i');
            if (submenu) {
                if (element.classList.contains('active')) {
                    submenu.style.opacity = '1';
                    submenu.style.visibility = 'visible';
                    submenu.style.height = 'auto';
                    submenu.style.transform = 'translateY(0)';
                    submenu.style.overflow = 'visible';
                    icon.classList.remove('fa-angle-down');
                    icon.classList.add('fa-angle-up');
                } else {
                    submenu.style.opacity = '0';
                    submenu.style.visibility = 'hidden';
                    submenu.style.height = '0';
                    submenu.style.transform = 'translateY(-20px)';
                    submenu.style.overflow = 'hidden'; 
                    icon.classList.remove('fa-angle-up');
                    icon.classList.add('fa-angle-down');
                }
            }
        }

        function submenuItemClicked(event) {
            event.stopPropagation();
            alert('Submenu item clicked: ' + event.target.textContent);
        }
</script>


</html>