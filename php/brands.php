<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quản lý thương hiệu | IVANO</title>

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../admin/css/custom-sweetalert.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .content-page-category {
            padding: 20px;
            position: relative;
        }

        .container-add-new-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .button-add-new-category {
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

        .button-add-new-category:hover {
            background-color: #F58F5D;
        }

        .search-category-box {
            border: 1px dashed #000;
            border-radius: 10px;
            padding-left: 5px;
        }

        .search-category-text {
            height: 40px;
            padding: 10px;
            width: 300px;
            border: none;
            outline: none;
        }

        .search-category-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: none;
            cursor: pointer;
            transition: all ease-in-out 0.3s;
        }

        .table-container {
            width: 100%;
            overflow-y: auto;
        }

        .category-page-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .category-page-table thead {
            background-color: #F58F5D;
            position: sticky;
            top: 0;
            color: white;
            border-bottom: 1px solid #000;
        }

        .category-page-table th:nth-child(1),
        .category-page-table td:nth-child(1) {
            width: 5%;
            text-align: center;
            border-right: 1px solid #000;
        }

        .category-page-table th:nth-child(2),
        .category-page-table td:nth-child(2) {
            width: 85%;
        }

        .category-page-table th:nth-child(3),
        .category-page-table td:nth-child(3) {
            width: 10%;
            text-align: center;
            border-left: 1px solid #000;
        }

        .category-page-table th,
        .category-page-table td {
            padding: 12px;
            text-align: left;
        }

        .category-page-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .category-page-table tbody tr {
            border-bottom: 1px solid #000;
        }

        .category-page-table tbody tr:hover {
            background-color: #ddd;
        }

        .edit-category,
        .delete-category {
            color: #000;
            font-size: 20px;
            margin: 0 10px;
            transition: all ease-in-out 0.3s;
        }

        .edit-category:hover {
            color: #008000;
        }

        .delete-category:hover {
            color: red;
        }

        .table-container {
            max-height: 550px;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <?php include "../admin/assets/sidebar-new.php"; ?>

    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="../../ivano_website/admin/index.php">Trang Quản Trị</a> <i class="fa-solid fa-angle-right"
                    style="color: #000; margin: 0 5px"></i> <a href="#">Thương Hiệu</a>
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

        <section class="content-page-category">
            <div class="container-add-new-btn">
                <button class="button-add-new-category" onclick="addBrand()">Thêm thương hiệu</button>
                <form action="brands-search.php" method="GET" class="search-category-box">
                    <input type="text" name="search" placeholder="Nhập thương hiệu cần tìm..."
                        class="search-category-text">
                    <button type="submit" class="search-category-btn"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <div class="table-container">
                <table class="category-page-table">
                    <thead class="category-table-thead">
                        <tr class="category-table-thead-tr">
                            <th>ID</th>
                            <th>Tên thương hiệu</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="category-table-tbody">
                        <?php
                        include '../php/conection.php';
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $sql = "SELECT brand_id, brand_name FROM brands WHERE brand_name LIKE ?";
                        $stmt = $conn->prepare($sql);
                        $searchTerm = "%{$search}%";
                        $stmt->bind_param("s", $searchTerm);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0):
                            while ($row = $result->fetch_assoc()): ?>
                                <tr class="category-table-tbody-tr">
                                    <td class="category-table-tbody-td">
                                        <?php echo htmlspecialchars($row['brand_id']); ?>
                                    </td>
                                    <td class="category-table-tbody-td">
                                        <?php echo htmlspecialchars($row['brand_name']); ?>
                                    </td>
                                    <td class="category-table-tbody-td">
                                        <a class="category-table-action-link edit-category" href="#"
                                            onclick="editBrand(<?php echo htmlspecialchars($row['brand_id']); ?>, '<?php echo htmlspecialchars($row['brand_name']); ?>')"><i
                                                class="fa-solid fa-pencil"></i></a>
                                        <a class="category-table-action-link delete-category" href="#"
                                            onclick="deleteBrand(<?php echo htmlspecialchars($row['brand_id']); ?>)"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr class="category-table-tbody-tr">
                                <td class="category-table-tbody-td" colspan="3">Không có thương hiệu nào được tìm thấy.</td>
                            </tr>
                        <?php endif;

                        $stmt->close();
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <script>
            function addBrand() {
                Swal.fire({
                    title: 'Thêm thương hiệu mới',
                    html: '<input type="text" id="name" class="swal2-input" placeholder="Tên thương hiệu">',
                    showCancelButton: true,
                    confirmButtonText: 'Thêm',
                    cancelButtonText: 'Hủy',
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#name').value
                        if (!name) {
                            Swal.showValidationMessage('Vui lòng nhập tên thương hiệu')
                        }
                        return { name: name }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('add_brand', true);
                        formData.append('brand_name', result.value.name);

                        fetch('../action/brand-action.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire(data.message);
                                if (data.status === 'success') {
                                    setTimeout(() => location.reload(), 2000);
                                }
                            });
                    }
                })
            }

            function editBrand(id, name) {
                Swal.fire({
                    title: 'Sửa thương hiệu',
                    html
                        : `<input type="text" id="name" class="swal2-input" value="${name}">`,
                    showCancelButton: true,
                    confirmButtonText: 'Lưu',
                    cancelButtonText: 'Hủy',
                    preConfirm: () => {
                        const name = Swal.getPopup().querySelector('#name').value
                        if (!name) {
                            Swal.showValidationMessage('Vui lòng nhập tên thương hiệu')
                        }
                        return { name: name }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('edit_brand', true);
                        formData.append('id', id);
                        formData.append('brand_name', result.value.name);

                        fetch('../action/brand-action.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire(data.message);
                                if (data.status === 'success') {
                                    setTimeout(() => location.reload(), 2000);
                                }
                            });
                    }
                })
            }

            function deleteBrand(id) {
                Swal.fire({
                    title: 'Xóa thương hiệu',
                    text: 'Bạn có chắc chắn muốn xóa thương hiệu này không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('delete_brand', true);
                        formData.append('id', id);

                        fetch('../action/brand-action.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire(data.message);
                                if (data.status === 'success') {
                                    setTimeout(() => location.reload(), 2000);
                                }
                            });
                    }
                })
            }
        </script>
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
</body>

</html>