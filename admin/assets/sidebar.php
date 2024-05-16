<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .nav-icons ul {
            list-style-type: none;
            padding: 0;
        }
     
        
        .submenu {
            display: none;
        }
    </style>
</head>
<body>

<div class="top-sidebar">
    <h2>Dashboard</h2>
    <button id="toggleButton"><i class="fa-solid fa-xmark"></i></button>
</div>

<div class="nav-icons">
    <ul>
        <li><a href="#"><i class="fa fa-home"></i><span>Trang Chủ</span></a></li>
        <li class="product"><a href="#"><i class="fa fa-home"></i><span>Sản Phẩm</span></a>
            <ul class="submenu">
                <li><a href="../php/categories.php">Loại sản phẩm</a></li>
                <li><a href="../php/productCategory.php">Doanh mục loại sản phẩm</a></li>

                <li><a href="../php/brands.php">Thương hiệu</a></li>
                <li><a href="../php/products.php">Sản phẩm</a></li>
            </ul>
        </li>
        <li><a href="../php/ad.php"><i class="fa fa-chart-bar"></i><span>Slider</span></a></li>
        <li><a href="../php/agency.php"><i class="fa fa-file-alt"></i><span>Quản lý nhà cung cấp</span></a></li>
        <li><a href="../php/customer.php"><i class="fa fa-cogs"></i><span>Quản lý khách hàng</span></a></li>
        <li><a href="../php/employee.php"><i class="fa fa-chart-bar"></i><span>Quản lý nhân viên</span></a></li>
        <li><a href="../php/employee.php"><i class="fa fa-chart-bar"></i><span>Thống kê</span></a></li>
            <ul class="submenu">
                <li><a href="../php/categories.php">Doanh thu theo hóa đơn</a></li>
                <li><a href="../php/productCategory.php">Doanh thu theo tháng</a></li>

                <li><a href="../php/brands.php">Thống kê nhân viên</a></li>
                <li><a href="../php/products.php">Số sản phẩm đi</a></li>
            </ul>


    </ul>
</div>

<script>
    // Lắng nghe sự kiện click vào mục "Sản Phẩm"
    document.querySelector('.product').addEventListener('click', function() {
        // Lấy ra submenu của "Sản Phẩm"
        var submenu = document.querySelector('.product .submenu');
        // Kiểm tra nếu submenu đang ẩn thì hiển thị, ngược lại ẩn đi
        if (submenu.style.display === 'none') {
            submenu.style.display = 'block';
        } else {
            submenu.style.display = 'none';
        }
    });
</script>

</body>
</html>
