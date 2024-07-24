<?php
include '../connectDB.php'; // Thay đổi tên file connection.php nếu cần

// Xử lý thêm popup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_popup'])) {
    $popup_content = $_POST['popup_content'];
    $popup_description = $_POST['popup_description'];

    // Xử lý upload file
    $target_dir = "../../admin/uploads/";
    $target_file = $target_dir . basename($_FILES["popup_img"]["name"]);
    if (move_uploaded_file($_FILES["popup_img"]["tmp_name"], $target_file)) {
        $popup_img = $target_file;

        // Thêm popup vào cơ sở dữ liệu
        $sql = "INSERT INTO popups (popup_content, popup_description, popup_img) VALUES ('$popup_content', '$popup_description', '$popup_img')";
        $conn->query($sql);

        header("Location: manage_popups.php");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Xử lý xóa popup
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Truy vấn để lấy tên tệp ảnh của popup
    $sql_select_img = "SELECT popup_img FROM popups WHERE popup_id = ?";
    $stmt = $conn->prepare($sql_select_img);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->bind_result($popup_img);
    $stmt->fetch();
    $stmt->close();

    // Xóa popup từ cơ sở dữ liệu
    $sql_delete_popup = "DELETE FROM popups WHERE popup_id = ?";
    $stmt = $conn->prepare($sql_delete_popup);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $stmt->close();

        // Xóa tệp ảnh từ thư mục uploads
        $filepath = "" . $popup_img;
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        echo "<script>alert('Popup deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete popup');</script>";
    }
}

// Xử lý sửa popup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_popup'])) {
    $popup_id = $_POST['popup_id'];
    $popup_content = $_POST['popup_content'];
    $popup_description = $_POST['popup_description'];

    if (!empty($_FILES["popup_img"]["name"])) {
        $target_dir = "../../admin/uploads/";
        $target_file = $target_dir . basename($_FILES["popup_img"]["name"]);
        if (move_uploaded_file($_FILES["popup_img"]["tmp_name"], $target_file)) {
            $popup_img = $target_file;

            $sql = "UPDATE popups SET popup_content='$popup_content', popup_description='$popup_description', popup_img='$popup_img' WHERE popup_id=$popup_id";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $sql = "UPDATE popups SET popup_content='$popup_content', popup_description='$popup_description' WHERE popup_id=$popup_id";
    }

    $conn->query($sql);

    header("Location: manage_popups.php");
    exit();
}

// Lấy danh sách các popup
$sql = "SELECT * FROM popups";
$result = $conn->query($sql);

$popups = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $popups[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Management</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1,
        h2 {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #0056b3;
        }

        button {
            margin-right: 10px;
        }
    </style>
</head>

<body>
<a href="../../admin/index.php">Quay về trang chính</a>

    <h1>Popup Management</h1>

    <h2>Popups</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($popups as $popup): ?>
                <tr>
                    <td><?php echo $popup['popup_id']; ?></td>
                    <td><?php echo $popup['popup_content']; ?></td>
                    <td><?php echo $popup['popup_description']; ?></td>
                    <td><img src="<?php echo $popup['popup_img']; ?>" alt="Popup Image" width="100"></td>
                    <td>
                        <button onclick="editPopup(<?php echo $popup['popup_id']; ?>)">Edit</button>
                        <a href="manage_popups.php?delete_id=<?php echo $popup['popup_id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this popup?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 id="form-title">Add Popup</h2>
    <form id="popup-form" action="manage_popups.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="popup_id" name="popup_id">
        <label for="popup_content">Title:</label>
        <input type="text" id="popup_content" name="popup_content" required><br>
        <label for="popup_description">Description:</label>
        <textarea id="popup_description" name="popup_description" required></textarea><br>
        <label for="popup_img">Image:</label>
        <input type="file" id="popup_img" name="popup_img"><br>
        <input type="submit" id="form-submit" name="add_popup" value="Add Popup">
    </form>

    <script>
        function editPopup(popupId) {
            // Lấy thông tin popup từ bảng
            var popup = <?php echo json_encode($popups); ?>.find(p => p.popup_id == popupId);

            // Hiển thịthông tin popup trên form
            document.getElementById('popup_id').value = popup.popup_id;
            document.getElementById('popup_content').value = popup.popup_content;
            document.getElementById('popup_description').value = popup.popup_description;
            document.getElementById('form-title').innerText = "Edit Popup";
            document.getElementById('form-submit').value = "Update Popup";
            document.getElementById('form-submit').name = "edit_popup";
        }
    </script>