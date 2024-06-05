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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll('.nav-icons .product');

        menuItems.forEach(function(item) {
            item.addEventListener('click', function(event) {
               

                const isActive = this.classList.contains('active');

                menuItems.forEach(function(item) {
                    item.classList.remove('active');
                });

                if (!isActive) {
                    this.classList.add('active');
                }
            });
        });
    });
</script>

<?php
// Kiểm tra xem có bất kỳ form tư vấn nào có trạng thái "chưa tư vấn" hay không
// Hàm kiểm tra xem có bất kỳ form tư vấn nào có trạng thái "Chưa Tư Vấn" hay không
function hasChuaTuvan($conn) {
    $sql = "SELECT COUNT(*) AS count FROM tuvan_form WHERE TrangThai = '2'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
    return false;
}

// Tạo kết nối đến cơ sở dữ liệu
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

// Kiểm tra có form tư vấn nào có trạng thái "chưa tư vấn" hay không
$hasChuaTuvan = hasChuaTuvan($conn);

// Đóng kết nối
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SB ADMIN</title>
    <!-- Add your CSS styles here -->
    <style>
        .need-advice {
            color: red;
        }
    </style>
</head>

<body>
    <div class="top-sidebar">
        <h2>SB ADMIN 😍</h2>
        <button id="toggleButton"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="nav-icons">
        <ul>
            <li><a href="index.php"><i class="fa fa-home"></i><span>Trang Chủ</span></a></li>
            <li class="product"><a><i class="fa-solid fa-store"></i><span>Cửa Hàng <i class="fa-solid fa-chevron-down"></i></span></a>
                <ul class="submenu-admin">
                    <li><a href="../php/categories.php">Loại sản phẩm</a></li>
                    <li><a href="../php/productCategory.php">Doanh mục loại sản phẩm</a></li>
                    <li><a href="../php/brands.php">Thương hiệu</a></li>
                    <li><a href="../php/products.php">Sản phẩm</a></li>
                </ul>
            </li>
            <li><a href="../assets/manage_popups.php"><i class="fa-solid fa-photo-film"></i><span>Quản lý Popup</span></a></li>
            <li <?php if ($hasChuaTuvan): ?>class="need-advice"<?php endif; ?>><a href="../assets/tuvan_form.php"><i class="fa-solid fa-photo-film"></i><span>Cần Tư Vấn</span></a></li>

            <li><a href="../assets/manage_banners.php"><i class="fa-solid fa-bell"></i><span>Quản lý Banner</span></a></li>
            <li><a href="../php/manage_flashsale.php"><i class="fa-solid fa-user"></i><span>Quản lý Flashsale</span></a></li>

            <li><a href="../php/agency.php"><i class="fa fa-file-alt"></i><span>Các đại lý</span></a></li>
            <li><a href="../php/customer.php"><i class="fa-solid fa-user"></i><span>Quản lý khách hàng</span></a></li>
            <li><a href="../php/employee.php"><i class="fa-solid fa-users"></i><span>Quản lý nhân viên</span></a></li>
            <li class="statistics"><a><i class="fa fa-chart-bar"></i><span>Thống kê <i class="fa-solid fa-chevron-down"></i></span></a>
                <ul class="submenu-admin">
                    <li><a href="../php/thongke/doanhthu_theohoadon.php">Doanh thu theo hóa đơn</a></li>
                    <li><a href="../php/thongke/donhang_theothang.php">Doanh thu theo thời gian</a></li>
                    <li><a href="../php/thongke/thongke_sodaily.php">Thống kê số lượng đại lý theo ngày</a></li>
                    <li><a href="../php/thongke/quanly_nhanvien.php">Thống kê nhân viên</a></li>
                </ul>
            </li>
            <li><a href="../php/colors.php"><i class="fa-solid fa-paint-roller"></i><span>Quản lý màu</span></a></li>
            <li><a href="../php/table_colors.php"><i class="fa-solid fa-palette"></i><span>Bảng màu</span></a></li>
        </ul>
    </div>
</body>

</html>




<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
    }

    .sidebar {
        width: 18%;
        height: 100%;
        /* background-color: rgb(0, 208, 130); */
        background-color: #7296A4;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        transition: width 0.3s ease;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .sidebar::-webkit-scrollbar {
        display: none;
    }

    .top-sidebar {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #fff;
    }

    .nav-icons{
        margin: 50px 10px 0 10px;
    }
    .nav-icons ul {
        list-style: none;
        padding: 0;
    }

    .nav-icons ul li {
        /* margin: 0 0 10px 10px; */
        font-weight: 600;
        align-items: center;

    }

    .nav-icons ul li a {
        display: block;
        color: #fff;
        text-decoration: none;
        transition: all ease-in-out 0.3s;
        padding: 10px;
    }

    .nav-icons ul li:hover a {
        color: #000;
    }

    .nav-icons ul li a i {
        margin-right: 10px;
        width: 30px;
        height: 30px;
    }

    #toggleButton {
        width: 30px;
        height: 30px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }


    .top-sidebar h2,
    .nav-icons ul li a span {
        transition: transform 0.3s ease;
    }

    .hidden .top-sidebar h2,
    .hidden .nav-icons ul li a span {
        transform: translateX(-100%);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleButton");
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const heading = document.getElementsByClassName("container-heading-admin-page");
        const navIcons = document.querySelector(".nav-icons");
        const dashboardTitle = document.querySelector(".top-sidebar h2");
        const navLinks = document.querySelectorAll(".nav-icons ul li a span");
        const iconLink = document.querySelectorAll(".nav-icons ul li a i")
        const toggleIcon = document.querySelector("#toggleButton i");

        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("hidden");
            if (sidebar.classList.contains("hidden")) {
                sidebar.style.width = "5%";
                dashboardTitle.style.display = "none";
                navIcons.style.width = "100%";
                content.style.marginLeft = "5%";
                navLinks.forEach(function(link) {
                    link.style.display = "none";
                });

                iconLink.forEach(function(icon) {
                    icon.style.textAlign = "center";
                });

                toggleIcon.classList.remove("fa-xmark");
                toggleIcon.classList.add("fa-bars");
            } else {
                sidebar.style.width = "18%";
                dashboardTitle.style.display = "block";
                navIcons.style.width = "100%";
                content.style.marginLeft = "18%";
                navLinks.forEach(function(link) {
                    link.style.display = "inline";
                });
                toggleIcon.classList.remove("fa-bars");
                toggleIcon.classList.add("fa-xmark");
            }
        });
    });
</script>