<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../admin/css/custom-sweetalert.css">

    <title>Loại Sản Phẩm | IVANO</title>

    <?php
    include ("../php/conection.php");
    $sql = "SELECT * FROM categories ORDER BY category_id DESC";
    $result = $conn->query($sql);
    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    } else {
        echo "Không có danh mục nào được tìm thấy.";
    }
    ?>

</head>

<body>
    <?php include "../admin/assets/sidebar.php"; ?>

    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="../../ivano_website/admin/index.php">Trang Quản Trị</a> <i class="fa-solid fa-angle-right"
                    style="color: #000; margin: 0 5px"></i> <a href="#">Loại Sản Phẩm</a>
            </div>

            <a href="" class="main-top-right-admin-page">
                <div class="left-hello-user">
                    <p>Hi</p>
                    <span>Admin</span>
                </div>

                <div class="right-hello-user">
                    <span>A</span>
                </div>
            </a>
        </section>

        <style>
            .content-page-categories {
                padding: 20px;
                position: relative;
            }

            .container-add-new-btn {
                margin-bottom: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .button-add-new-categories {
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

            .button-add-new-categories:hover {
                background-color: #F58F5D;
            }

            .search-categories-box {
                border: 1px dashed #000;
                border-radius: 10px;
                padding-left: 5px;
            }

            .search-categories-text {
                height: 40px;
                padding: 10px;
                width: 300px;
                border: none;
                outline: none;
            }

            .search-categories-btn {
                width: 40px;
                height: 40px;
                border: none;
                background: none;
                cursor: pointer;
                transition: all ease-in-out 0.3s;
            }

            .categories-page-table {
                width: 100%;
                border-collapse: collapse;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .categories-page-table thead {
                background-color: #F58F5D;
                position: sticky;
                top: 0;
                color: white;
                border-bottom: 1px solid #000;
            }

            .categories-page-table th:nth-child(1),
            .categories-page-table td:nth-child(1) {
                width: 5%;
                /* Chiều rộng của cột ID */
                text-align: center;
                border-right: 1px solid #000;
            }

            .categories-page-table th:nth-child(2),
            .categories-page-table td:nth-child(2) {
                width: 85%;
                /* Chiều rộng của cột Tên */
            }

            .categories-page-table th:nth-child(3),
            .categories-page-table td:nth-child(3) {
                width: 10%;
                /* Chiều rộng của cột Action */
                text-align: center;
                border-left: 1px solid #000;
            }


            .categories-page-table th,
            .categories-page-table td {
                padding: 12px;
                text-align: left;
            }

            .categories-page-table tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .categories-page-table tbody tr {
                border-bottom: 1px solid #000;
            }

            .categories-page-table tbody tr:hover {
                background-color: #ddd;
            }

            .edit-categories,
            .delete-categories {
                color: #000;
                font-size: 20px;
                margin: 0 10px;
                transition: all ease-in-out 0.3s;

            }

            .edit-categories:hover {
                color: #008000;
            }

            .delete-categories:hover {
                color: red;
            }

            .table-container {
                max-height: 550px;
                overflow-y: auto;
            }
        </style>

        <section class="content-page-categories">
            <div class="container-add-new-btn">
                <button class="button-add-new-categories" onclick="addCategory()">Thêm loại sản phẩm</button>

                <form action="" class="search-categories-box">
                    <input type="text" placeholder="Nhập danh mục cần tìm..." class="search-categories-text">
                    <button class="search-categories-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <div class="table-container">
                <table class="categories-page-table">
                    <thead class="categories-table-thead">
                        <tr class="categories-table-thead-tr">
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="categories-table-tbody">
                        <?php if (isset($categories) && is_array($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr class="categories-table-tbody-tr">
                                    <td class="categories-table-tbody-td">
                                        <?php echo htmlspecialchars($category['category_id']); ?>
                                    </td>
                                    <td class="categories-table-tbody-td">
                                        <?php echo htmlspecialchars($category['category_name']); ?>
                                    </td>
                                    <td class="categories-table-tbody-td">
                                        <a class="categories-table-action-link edit-categories" href="#"
                                            onclick="editCategory(<?php echo htmlspecialchars($category['category_id']); ?>)"><i
                                                class="fa-solid fa-pencil"></i></a>
                                        <a class="categories-table-action-link delete-categories" href="#"
                                            onclick="deleteCategory(<?php echo htmlspecialchars($category['category_id']); ?>)"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="content-page__table-row categories-page-table__row">
                                <td class="categories-table-tbody-td" colspan="3">Không có danh mục
                                    nào được tìm thấy.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

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

    <script>
        function addCategory() {
            Swal.fire({
                title: 'Thêm danh mục mới',
                html: `
                    <input type="text" id="category_name" placeholder="Tên danh mục" required class="swal2-input">
                `,
                showCancelButton: true,
                confirmButtonText: 'Thêm',
                cancelButtonText: 'Hủy',
                preConfirm: () => {
                    const categoryName = document.getElementById('category_name').value;
                    if (!categoryName) {
                        Swal.showValidationMessage('Vui lòng nhập tên danh mục');
                    } else {
                        return fetch('../action/categories-action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'add_category=true&category_name=' + encodeURIComponent(categoryName)
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
                            });
                    }
                }
            });
        }

        function editCategory(category_id) {
            fetch('../action/categories-action.php?edit_category=' + category_id)
                .then(response => response.json())
                .then(data => {
                    if (data && data.status === 'success') {
                        Swal.fire({
                            title: 'Chỉnh sửa danh mục',
                            html: `
                        <input type="text" id="category_name" value="${data.category_name}" required class="swal2-input">
                    `,
                            showCancelButton: true,
                            confirmButtonText: 'Cập nhật',
                            cancelButtonText: 'Hủy',
                            preConfirm: () => {
                                const categoryName = document.getElementById('category_name').value;
                                if (!categoryName) {
                                    Swal.showValidationMessage('Vui lòng nhập tên danh mục');
                                } else {
                                    return fetch('../action/categories-action.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: 'update_category=true&category_id=' + category_id + '&category_name=' + encodeURIComponent(categoryName)
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data && data.status === 'success') {
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
                                        });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: data ? data.message : 'Có lỗi xảy ra khi cập nhật danh mục.',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Đã xảy ra lỗi:', error);
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra khi cập nhật danh mục.',
                        icon: 'error'
                    });
                });
        }

        function deleteCategory(category_id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa danh mục này không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../action/categories-action.php?delete_category=' + category_id)
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
                        });
                }
            });
        }
    </script>
</body>

</html>