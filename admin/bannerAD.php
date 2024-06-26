<?php
session_start();

if (isset($_SESSION['user_name'])) {
    $loggedInUsername = $_SESSION['user_name'];

    if (isset($loggedInUsername)) {
        $initial = substr($loggedInUsername, 0, 1);
    } else {
        echo "Không có tên người dùng đăng nhập";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="css/global-style-ad.css">
    <title>Banner Management</title>
</head>

<style>
    .main-admin-page {
        margin-left: 18%;
        border-left: 1px solid #fff;
        width: 82%;
        transition: all ease-in-out 0.3s;
    }

    .main-top-admin-page {
        width: 100%;
        display: flex;
        justify-content: space-between;
        background-color: #55D5D2;
        align-items: center;
        height: 10vh;
        font-weight: 600;
        padding: 0 20px;
        border-bottom: 1px solid #fff;
    }

    .main-top-left-admin-page {
        align-items: center;
    }

    .main-top-left-admin-page a {
        color: #FFF;
        transition: all ease-in-out 0.3s;
    }

    .main-top-left-admin-page a:hover {
        color: #000;
    }

    .main-top-right-admin-page {
        display: flex;
        gap: 10px;
        text-align: right;
        align-items: center;
        color: #fff;
    }

    .left-hello-user p {
        font-weight: 500;
        font-size: 13px;
    }

    .right-hello-user {
        border: 1px dashed #fff;
        width: 50px;
        height: 50px;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        display: flex;
    }
</style>

<style>
    .content-page-banner {
        padding: 20px;
        position: relative;
    }

    .container-add-new-btn {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .button-add-new-banner {
        background-color: #55D5D2;
        font-weight: 600;
        color: #fff;
        height: 40px;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-add-new-banner:hover {
        background-color: #F58F5D;
    }

    .search-banner-box {
        border: 1px dashed #000;
        border-radius: 10px;
        padding-left: 5px;
    }

    .search-banner-text {
        height: 40px;
        padding: 10px;
        width: 300px;
        border: none;
        outline: none;
    }

    .search-banner-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: none;
        cursor: pointer;
        transition: all ease-in-out 0.3s;
    }
</style>

<body>
    <?php include "assets/sidebar.php"; ?>

    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="index.php">Trang Quản Trị</a> <i class="fa-solid fa-angle-right"
                    style="color: #000; margin: 0 5px"></i> <a href="#">Banner</a>
            </div>

            <?php include "assets/hello-user.php"; ?>
        </section>

        <section class="content-page-banner">
            <div class="container-add-new-btn">
                <button class="button-add-new-banner" onclick="addBanner()">Thêm banner mới</button>
            </div>

            <div class="container-list-banner">
                <?php
                include ("connectDB.php");

                // Truy vấn lấy danh sách các banner từ cơ sở dữ liệu
                $sql = "SELECT * FROM banners ORDER BY banner_date DESC";
                $result = $conn->query($sql);

                // Kiểm tra số lượng banner có trong cơ sở dữ liệu
                if ($result->num_rows > 0) {
                    echo '
                        <div class="container-list-banner">
                            <table class="banner-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngày đăng</th>
                                        
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                            <tbody>
                        ';

                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        $banner_id = $row['banner_id'];
                        $banner_title = htmlspecialchars($row['banner_title']);
                        $banner_date = htmlspecialchars($row['banner_date']);
                        $banner_img = htmlspecialchars($row['banner_img']);

                        echo '
                            <tr>
                                <td style="width: 5%">' . $count . '</td>
                                <td><img src="uploads/' . $banner_img . '" alt="Banner Image" style="max-width: 100px;"></td>

                                <td style="width: 50%">' . $banner_title . '</td>
                                <td>' . $banner_date . '</td>
                                <td style="width: 10%">
                                    <button onclick="editBanner(' . $banner_id . ')"><i class="fa-solid fa-pencil"></i></button>
                                    <button onclick="deleteBanner(' . $banner_id . ')"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                        ';
                        $count++;
                    }

                    echo '
                        </tbody>
                            </table>
                                </div>
                    ';
                } else {
                    echo '<p>Hiện không có banner nào.</p>';
                }

                $conn->close();
                ?>
            </div>
        </section>
    </main>
</body>

<style>
    .container-list-banner {
        margin-top: 5px;
        max-height: 550px;
        overflow-y: auto;
    }

    .banner-table {
        width: 100%;
        border-collapse: collapse;
       
    }

    .container-list-banner::-webkit-scrollbar {
        width: 0;
    }


    .banner-table th,
    .banner-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .banner-table th {
        background-color: #f2f2f2;
    }


    .banner-table img {
        max-width: 100px;
        height: auto;
    }

    .banner-table td button {
        text-align: center;
        padding: 15px;
        font-size: 18px;
        cursor: pointer;
        border: none;
        background: none;
    }

    .fa-pencil:hover {
        color: #008000;
    }

    .fa-trash-can:hover {
        color: red;
    }
</style>

<!-- thêm -->
<script>
    function addBanner() {
        Swal.fire({
            title: 'Thêm banner mới',
            html: `
            <style>
                .swal2-input-container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                .swal2-input-custom {
                    margin-bottom: 10px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    width: 80%;
                    max-width: 400px;
                    box-sizing: border-box;
                }
                #banner_img_preview {
                    margin-top: 10px;
                    max-width: 100%;
                    max-height: 200px;
                    display: none;
                }
            </style>
            <div class="swal2-input-container">
                <input type="text" id="banner_title" placeholder="Tiêu đề banner" required class="swal2-input-custom">
                <input type="file" id="banner_img" class="swal2-input-custom">
                <img id="banner_img_preview" alt="Preview Image">
            </div>
        `,
            showCancelButton: true,
            confirmButtonText: 'Thêm',
            cancelButtonText: 'Hủy',
            preConfirm: () => {
                const bannerTitle = document.getElementById('banner_title').value;
                const bannerImg = document.getElementById('banner_img').files[0];

                if (!bannerTitle || !bannerImg) {
                    Swal.showValidationMessage('Vui lòng nhập đầy đủ thông tin');
                } else {
                    // Sử dụng FormData để gửi dữ liệu file và các trường khác
                    let formData = new FormData();
                    formData.append('add_banner', 'true');
                    formData.append('banner_title', bannerTitle);
                    formData.append('banner_img', bannerImg);

                    return fetch('action-admin/banner-management-action.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Thành công!',
                                    text: data.message,
                                    icon: 'success'
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi thêm banner.',
                                icon: 'error'
                            });
                        });
                }
            },
            didOpen: () => {
                const bannerImgInput = document.getElementById('banner_img');
                const bannerImgPreview = document.getElementById('banner_img_preview');

                bannerImgInput.addEventListener('change', () => {
                    const file = bannerImgInput.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            bannerImgPreview.src = e.target.result;
                            bannerImgPreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        bannerImgPreview.style.display = 'none';
                    }
                });
            }
        });
    }
</script>

<!-- sửa -->
<script>
    function editBanner(banner_id) {
        Swal.fire({
            title: 'Sửa banner',
            html: `
            <style>
                .swal2-input-container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                .swal2-input-custom {
                    margin-bottom: 10px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    width: 80%;
                    max-width: 400px;
                    box-sizing: border-box;
                }
                #edit_banner_img_preview {
                    margin-top: 10px;
                    max-width: 100%;
                    max-height: 200px;
                    display: none;
                }
            </style>
            <div class="swal2-input-container">
                <input type="text" id="edit_banner_title" placeholder="Tiêu đề banner" required class="swal2-input-custom">
                <input type="file" id="edit_banner_img" class="swal2-input-custom">
                <img id="edit_banner_img_preview" alt="Preview Image">
            </div>
        `,
            showCancelButton: true,
            confirmButtonText: 'Lưu',
            cancelButtonText: 'Hủy',
            didOpen: () => {
                fetch(`action-admin/banner-management-action.php?get_banner=${banner_id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_banner_title').value = data.banner_title;
                        const editBannerImgPreview = document.getElementById('edit_banner_img_preview');
                        editBannerImgPreview.src = data.banner_img; 
                        editBannerImgPreview.style.display = 'block'; 
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Đã xảy ra lỗi khi tải dữ liệu banner.',
                            icon: 'error'
                        });
                    });

                const editBannerImgInput = document.getElementById('edit_banner_img');
                const editBannerImgPreview = document.getElementById('edit_banner_img_preview');

                editBannerImgInput.addEventListener('change', () => {
                    const file = editBannerImgInput.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            editBannerImgPreview.src = e.target.result;
                            editBannerImgPreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        editBannerImgPreview.style.display = 'none';
                    }
                });
            },
            preConfirm: () => {
                const bannerTitle = document.getElementById('edit_banner_title').value;
                const bannerImg = document.getElementById('edit_banner_img').files[0];

                if (!bannerTitle) {
                    Swal.showValidationMessage('Vui lòng nhập tiêu đề banner');
                } else {
                    let formData = new FormData();
                    formData.append('edit_banner', 'true');
                    formData.append('banner_id', banner_id);
                    formData.append('banner_title', bannerTitle);
                    if (bannerImg) {
                        formData.append('banner_img', bannerImg);
                    }

                    return fetch('action-admin/banner-management-action.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Thành công!',
                                    text: data.message,
                                    icon: 'success'
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi sửa banner.',
                                icon: 'error'
                            });
                        });
                }
            }
        });
    }
</script>

<!-- xoá -->
<script>
    function deleteBanner(banner_id) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xoá banner này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xoá',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'action-admin/banner-management-action.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Thành công!',
                                    text: data.message,
                                    icon: 'success'
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Lỗi!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        } else {
                            console.error('Error:', xhr.status, xhr.statusText);
                            Swal.fire({
                                title: 'Lỗi!',
                                text: 'Đã xảy ra lỗi khi xoá banner.',
                                icon: 'error'
                            });
                        }
                    }
                };
                var params = 'delete_banner=true&banner_id=' + banner_id;
                xhr.send(params);
            }
        });
    }


</script>

</html>