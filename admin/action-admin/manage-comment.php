<?php
include '../connectDB.php';

$sql = "SELECT * FROM comments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Comment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .modal {
            display: none; /* Ẩn modal mặc định */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Quản lý Comment</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Số điện thoại</th>
        <th>Comment</th>
        <th>Ảnh</th>
        <th>Ngày tạo</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php $index = 0; ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr id="row-<?php echo $row['id']; ?>">
                <td><?php echo ++$index; ?></td> <!-- Thêm cột số thứ tự -->
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td><img src="../../<?php echo $row['path_img']; ?>" alt="User Image" style="max-width: 100px;"></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <input type="radio" id="radio-<?php echo $row['id']; ?>" name="selected-comment"
                           data-id="<?php echo $row['id']; ?>">
                    <button class="btn btn-edit" onclick="openEditModal(<?php echo $row['id']; ?>)">Sửa</button>
                    <button class="btn btn-delete" onclick="deleteComment(<?php echo $row['id']; ?>)">Xóa</button>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Không có nhận xét nào.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<!-- Button to open modal for adding comment -->
<!-- <button class="btn btn-add" onclick="openAddModal()">Thêm Comment</button> -->

<!-- Modal for editing -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Sửa nhận xét</h2>
        <form id="editForm" enctype="multipart/form-data">
            <input type="hidden" id="editId">
            <div class="mb-3">
                <label for="editName" class="form-label">Tên</label>
                <input type="text" class="form-control" id="editName" required>
            </div>
            <div class="mb-3">
                <label for="editPhone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="editPhone" required>
            </div>
            <div class="mb-3">
                <label for="editComment" class="form-label">Comment</label>
                <textarea class="form-control" id="editComment" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="editImage" class="form-label">Chọn ảnh mới</label>
                <input type="file" class="form-control" id="editImage" accept="image/*">
            </div>
            <button type="button" class="btn btn-submit" onclick="submitEdit()">Cập nhật</button>
        </form>
    </div>
</div>

<!-- Modal for adding new comment -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <h2>Thêm nhận xét mới</h2>
        <form id="addForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="addName" class="form-label">Tên</label>
                <input type="text" class="form-control" id="addName" required>
            </div>
            <div class="mb-3">
                <label for="addPhone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="addPhone" required>
            </div>
            <div class="mb-3">
                <label for="addComment" class="form-label">Comment</label>
                <textarea class="form-control" id="addComment" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="addImage" class="form-label">Chọn ảnh</label>
                <input type="file" class="form-control" id="addImage" accept="image/*" required>
            </div>
            <button type="button" class="btn btn-submit" onclick="submitAdd()">Thêm</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id) {
        // Get the data from the table row
        const name = document.querySelector(`#row-${id} td:nth-child(2)`).textContent;
        const phone = document.querySelector(`#row-${id} td:nth-child(3)`).textContent;
        const comment = document.querySelector(`#row-${id} td:nth-child(4)`).textContent;

        // Fill the modal with the data
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editPhone').value = phone;
        document.getElementById('editComment').value = comment;

        // Show the modal
        document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function submitEdit() {
        const id = document.getElementById('editId').value;
        const name = document.getElementById('editName').value;
        const phone = document.getElementById('editPhone').value;
        const comment = document.getElementById('editComment').value;
        const image = document.getElementById('editImage').files[0]; // Get the selected image file

        // Create a FormData object to send both text and file data
        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('comment', comment);
        formData.append('image', image); // Append the image file to FormData

        // Send the data to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../action/update_comment.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the table row with the new data
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.querySelector(`#row-${id} td:nth-child(2)`).textContent = name;
                    document.querySelector(`#row-${id} td:nth-child(3)`).textContent = phone;
                    document.querySelector(`#row-${id} td:nth-child(4)`).textContent = comment;

                    // Close the modal
                    closeEditModal();
                } else {
                    alert(response.message); // Show error message if update fails
                }
            } else {
                alert('Lỗi khi cập nhật nhận xét.');
            }
        };

        // Set the Content-Type header to undefined to let the browser set it automatically for FormData
        xhr.setRequestHeader('Content-Type', undefined);
        xhr.send(formData); // Send FormData containing text and image data
    }

    function deleteComment(id) {
        if (confirm('Bạn có chắc chắn muốn xóa nhận xét này không?')) {
            // Send the request to the server
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../action/delete_comment.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Remove the row from the table
                    document.getElementById(`row-${id}`).remove();
                } else {
                    alert('Lỗi khi xóa nhận xét.');
                }
            };
            xhr.send(`id=${id}`);
        }
    }

    function openAddModal() {
        // Show the add modal
        document.getElementById('addModal').style.display = 'block';
    }

    function closeAddModal() {
        // Hide the add modal
        document.getElementById('addModal').style.display = 'none';
    }

    function submitAdd() {
        const name = document.getElementById('addName').value;
        const phone = document.getElementById('addPhone').value;
        const comment = document.getElementById('addComment').value;
        const image = document.getElementById('addImage').files[0]; // Get the selected image file

        // Create a FormData object to send both text and file data
        const formData = new FormData();
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('comment', comment);
        formData.append('image', image); // Append the image file to FormData

        // Send the data to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../action/add_comment.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to refresh the comment list
                location.reload();
            } else {
                alert('Lỗi khi thêm nhận xét.');
            }
        };

        // Set the Content-Type header to undefined to let the browser set it automatically for FormData
        xhr.setRequestHeader('Content-Type', undefined);
        xhr.send(formData); // Send FormData containing text and image data
    }
</script>


</body>
</html>

