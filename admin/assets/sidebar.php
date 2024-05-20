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

        .nav-icons li {
            cursor: pointer;
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
        <li class="product"><a><i class="fa fa-home"></i><span>Sản Phẩm</span></a>
            <ul class="submenu">
                <li><a href="../php/categories.php">Loại sản phẩm</a></li>
                <li><a href="../php/productCategory.php">Doanh mục loại sản phẩm</a></li>
                <li><a href="../php/brands.php">Thương hiệu</a></li>
                <li><a href="../php/products.php">Sản phẩm</a></li>
            </ul>
        </li>
        <li><a href="../php/ad.php"><i class="fa fa-chart-bar"></i><span>Quản lý Slider</span></a></li>
        <li><a href="../php/news.php"><i class="fa fa-chart-bar"></i><span>Quản lý tin nổi bật</span></a></li>
        <li><a href="../php/agency.php"><i class="fa fa-file-alt"></i><span>Các đại lý</span></a></li>
        <li><a href="../php/customer.php"><i class="fa fa-cogs"></i><span>Quản lý khách hàng</span></a></li>
        <li><a href="../php/employee.php"><i class="fa fa-chart-bar"></i><span>Quản lý nhân viên</span></a></li>
        <li class="statistics"><a><i class="fa fa-chart-bar"></i><span>Thống kê</span></a>
            <ul class="submenu">
                <li><a href="../php/thongke/doanhthu_theohoadon.php">Doanh thu theo hóa đơn</a></li>
                <li><a href="../php/thongke/donhang_theothang.php">Doanh thu theo thời gian</a></li>
                <li><a href="../php/thongke/thongke_sodaily.php">Thống kê số lượng đại lý theo ngày</a></li>
                <li><a href="../php/thongke/quanly_nhanvien.php">Thống kê nhân viên</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    // Lắng nghe sự kiện click vào mục "Sản Phẩm"
    document.querySelector('.product > a').addEventListener('click', function() {
        var submenu = document.querySelector('.product .submenu');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });

    // Lắng nghe sự kiện click vào mục "Thống kê"
    document.querySelector('.statistics > a').addEventListener('click', function() {
        var submenu = document.querySelector('.statistics .submenu');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });
</script>

</body>
</html>
