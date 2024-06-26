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

    <link rel="stylesheet" href="css/global-style-ad.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Sizes - Colors Management</title>

    <style>
       table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ddd; /* Viền ngoài của bảng */
            font-family: Arial, sans-serif;
        }

        table, th, td {
            border: 1px solid #ddd; /* Viền của các ô */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<!-- global-main css -->
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
        top: 0;
        position: sticky;
        background: url('images/BacksAndBeyond_Images_Learning_2-2000x700-1-1400x490.jpg') no-repeat center center;
    }

    .main-top-left-admin-page {
        align-items: center;
    }

    .main-top-left-admin-page a {
        color: #FFF;
        transition: all ease-in-out 0.3s;
    }

    .main-top-left-admin-page a:hover {
        color: #55D5D2;
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

<!-- nút thêm -->
<style>
    .container-size-color-page {
        padding: 20px;
        position: relative;
    }

    .container-add-new-btn {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 50%;
        margin: 0px auto;
    }

    .button-add-new-sizes,
    .button-add-new-colors {
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

    .button-add-new-sizes:hover,
    .button-add-new-colors:hover {
        background-color: #F58F5D;
    }
</style>

<style>
    .container-sizes-colors {
        display: flex;
        justify-content: space-around;
        margin-top: 50px;
        gap: 50px;
    }

    .container-show-sizes {
        width: 50%;
        max-height: 500px;
        overflow-y: auto;
    }

    .container-show-sizes::-webkit-scrollbar {
        width: 0px;
    }

    .container-show-sizes h3,
    .container-show-colors {
        text-align: center;

    }

    .container-show-colors {
        width: 50%;
        max-height: 500px;
        overflow-y: auto;
    }

    .container-show-colors::-webkit-scrollbar {
        width: 0px;
    }

    .container-show-sizes table,
    .container-show-colors table {
        width: 100%;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
    }

    .container-show-sizes th,
    .container-show-sizes td,
    .container-show-colors th,
    .container-show-colors td {
        padding: 10px;
        text-align: left;
    }

    .container-show-sizes th,
    .container-show-colors th {
        background-color: #F58F5D;
        color: white;
    }

    .container-show-sizes td,
    .container-show-colors td {
        border-bottom: 1px solid #ddd;
    }

    .container-show-sizes tr:nth-child(even),
    .container-show-colors tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .container-show-sizes tr:hover,
    .container-show-colors tr:hover {
        background-color: #ddd;
    }

    .container-show-sizes .actions,
    .container-show-colors .actions {
        white-space: nowrap;
    }

    .container-show-sizes .actions a,
    .container-show-colors .actions a {
        margin-right: 5px;
        color: #4CAF50;
        text-decoration: none;
    }

    .container-show-sizes .actions a:hover,
    .container-show-colors .actions a:hover {
        text-decoration: underline;
        color: #333;
    }
</style>

<!-- nút sửa xoá -->
<style>
    .edit-size-btn,
    .delete-size-btn,
    .edit-color-btn,
    .delete-color-btn {
        padding: 5px 10px;
        background-color: #55D5D2;
        color: #FFF;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        margin: 0 10px;
    }

    .edit-size-btn:hover,
    .delete-size-btn:hover,
    .edit-color-btn:hover,
    .delete-color-btn:hover {
        background-color: #F58F5D;
    }
</style>

<body>
    <?php include "assets/sidebar.php"; ?>

    <main class="main-admin-page">
        <section class="main-top-admin-page">
            <div class="main-top-left-admin-page">
                <a href="index.php">Trang Quản Trị</a> <i class="fa-solid fa-angle-right"
                    style="color: #000; margin: 0 5px"></i> <a href="#">Kích thước - Màu sắc</a>
            </div>

            <?php include "assets/hello-user.php"; ?>
        </section>

        <section class="container-size-color-page">
            <div class="container-add-new-btn">
                <button class="button-add-new-sizes" onclick="addSizes()">Thêm kích thước mới</button>
                <button class="button-add-new-colors" onclick="addColors()">Thêm đuôi màu mới</button>
            </div>

            <div class="container-sizes-colors">
                <div class="container-show-sizes">
                    <h3>Danh sách Sizes</h3>
                    <?php
                    include 'connectDB.php';

                    $sqlSizes = "SELECT * FROM sizes ORDER BY size_id DESC";
                    $resultSizes = $conn->query($sqlSizes);

                    if ($resultSizes->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th style='text-align: center'>ID</th><th style='text-align: center'>Tên Size</th><th style='text-align: center'>Thao tác</th></tr>";
                        while ($row = $resultSizes->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='width: 10%; text-align: center'>" . $row["size_id"] . "</td>";
                            echo "<td style='width: 62%'>" . $row["size_name"] . "</td>";
                            echo "<td style='width: 28%; text-align: center'>";
                            echo "<button class='edit-size-btn' data-size-id='" . $row["size_id"] . "' data-size-name='" . htmlspecialchars($row["size_name"], ENT_QUOTES, 'UTF-8') . "'>Sửa</button>";
                            echo "<button class='delete-size-btn' data-size-id='" . $row["size_id"] . "'>Xóa</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Không có dữ liệu Size.</p>";
                    }

                    $conn->close();
                    ?>
                </div>

                <div class="container-show-colors">
                    <h3>Danh sách Colors Suffix</h3>
                    <?php
                    include 'connectDB.php';

                    $sqlColorSuffix = "SELECT * FROM colorsuffix ORDER BY color_suffix_id DESC";
                    $resultColorSuffix = $conn->query($sqlColorSuffix);

                    if ($resultColorSuffix->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th style='text-align: center'>ID</th><th style='text-align: center'>Tên Color Suffix</th><th style='text-align: center'>Thao tác</th></tr>";
                        while ($row = $resultColorSuffix->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='width: 10%; text-align: center'>" . $row["color_suffix_id"] . "</td>";
                            echo "<td style='width: 62%'>" . $row["color_suffix_name"] . "</td>";
                            echo "<td style='width: 28%; text-align: center'>";
                            echo "<button class='edit-color-btn' data-color-suffix-id='" . $row["color_suffix_id"] . "' data-color-suffix-name='" . htmlspecialchars($row["color_suffix_name"]) . "'>Sửa</button>";

                            echo "<button class='delete-color-btn' data-color-suffix-id='" . $row["color_suffix_id"] . "'>Xóa</button>";

                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Không có dữ liệu Color Suffix.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </section>
        </div>
    </main>
</body>

<!-- add size -->
<script>
    function addSizes() {
        Swal.fire({
            title: 'Thêm mới Size',
            html: `
                    <input type="text" id="size-name" class="swal2-input" placeholder="Nhập tên Size" required>
                `,
            confirmButtonText: 'Thêm Size',
            showCancelButton: true,
            preConfirm: () => {
                const sizeName = Swal.getPopup().querySelector('#size-name').value;
                if (!sizeName) {
                    Swal.showValidationMessage(`Vui lòng nhập tên Size`);
                }
                return { sizeName: sizeName };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('action-admin/sizes-colors-management-action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `add_size=true&size_name=${encodeURIComponent(result.value.sizeName)}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire('Thành công', 'Size đã được thêm', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Lỗi', 'Có lỗi xảy ra khi thêm Size', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Lỗi', 'Có lỗi xảy ra khi thêm Size', 'error');
                    });
            }
        });
    }
</script>

<!-- edit size -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-size-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sizeId = this.getAttribute('data-size-id');
                const currentSizeName = this.getAttribute('data-size-name');

                Swal.fire({
                    title: 'Chỉnh sửa Size',
                    html: `
                        <input type="text" id="new-size-name" class="swal2-input" value="${currentSizeName}" required>
                    `,
                    confirmButtonText: 'Lưu',
                    showCancelButton: true,
                    preConfirm: () => {
                        const newSizeName = Swal.getPopup().querySelector('#new-size-name').value;
                        if (!newSizeName) {
                            Swal.showValidationMessage(`Vui lòng nhập tên Size`);
                        }
                        return { newSizeName: newSizeName };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('action-admin/sizes-colors-management-action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `edit_size=true&size_id=${encodeURIComponent(sizeId)}&new_size_name=${encodeURIComponent(result.value.newSizeName)}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Thành công', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Lỗi', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Lỗi', 'Có lỗi xảy ra khi chỉnh sửa Size', 'error');
                            });
                    }
                });
            });
        });
    });
</script>

<!-- delete size -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-size-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sizeId = this.getAttribute('data-size-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: 'Hành động này sẽ xóa Size này khỏi danh sách!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('action-admin/sizes-colors-management-action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `delete_size=true&size_id=${encodeURIComponent(sizeId)}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Thành công', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Lỗi', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Lỗi', 'Có lỗi xảy ra khi xóa Size', 'error');
                            });
                    }
                });
            });
        });
    });
</script>

<!-- ------------------------------------ -->

<!-- add-color -->
<script>
    function addColors() {
        Swal.fire({
            title: 'Thêm mới Color Suffix',
            html: `
                    <input type="text" id="color-suffix-name" class="swal2-input" placeholder="Nhập tên Color Suffix" required>
                `,
            confirmButtonText: 'Thêm Color Suffix',
            showCancelButton: true,
            preConfirm: () => {
                const colorSuffixName = Swal.getPopup().querySelector('#color-suffix-name').value;
                if (!colorSuffixName) {
                    Swal.showValidationMessage(`Vui lòng nhập tên Color Suffix`);
                }
                return { colorSuffixName: colorSuffixName };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('action-admin/sizes-colors-management-action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `add_color_suffix=true&color_suffix_name=${encodeURIComponent(result.value.colorSuffixName)}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire('Thành công', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Lỗi', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Lỗi', 'Có lỗi xảy ra khi thêm Color Suffix', 'error');
                    });
            }
        });
    }
</script>

<!-- edit color -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-color-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const colorSuffixId = this.getAttribute('data-color-suffix-id');
                const currentColorSuffixName = this.getAttribute('data-color-suffix-name');

                Swal.fire({
                    title: 'Chỉnh sửa Color Suffix',
                    html: `
                        <input type="text" id="new-color-suffix-name" class="swal2-input" value="${currentColorSuffixName}" required>
                    `,
                    confirmButtonText: 'Lưu',
                    showCancelButton: true,
                    preConfirm: () => {
                        const newColorSuffixName = Swal.getPopup().querySelector('#new-color-suffix-name').value;
                        if (!newColorSuffixName) {
                            Swal.showValidationMessage(`Vui lòng nhập tên Color Suffix`);
                        }
                        return { newColorSuffixName: newColorSuffixName };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('action-admin/sizes-colors-management-action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `edit_color_suffix=true&color_suffix_id=${encodeURIComponent(colorSuffixId)}&new_color_suffix_name=${encodeURIComponent(result.value.newColorSuffixName)}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Thành công', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Lỗi', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Lỗi', 'Có lỗi xảy ra khi chỉnh sửa Color Suffix', 'error');
                            });
                    }
                });
            });
        });
    });
</script>

<!-- delete color -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-color-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const colorSuffixId = this.getAttribute('data-color-suffix-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: 'Hành động này sẽ xóa màu này khỏi danh sách!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('action-admin/sizes-colors-management-action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `delete_color_suffix=true&color_suffix_id=${encodeURIComponent(colorSuffixId)}`
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Thành công', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Lỗi', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Lỗi', 'Có lỗi xảy ra khi xóa Color Suffix', 'error');
                            });
                    }
                });
            });
        });
    });
</script>

</html>