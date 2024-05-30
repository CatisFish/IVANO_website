<?php
include '../php/conection.php';

// Xử lý thêm banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_banner'])) {
    $banner_title = $_POST['banner_title'];
    $banner_date = $_POST['banner_date'];

    // Xử lý upload file
    $target_dir = "../admin/uploads/";
    $target_file = $target_dir . basename($_FILES["banner_img"]["name"]);
    if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file)) {
        $banner_img = $target_file;

        // Thêm banner vào cơ sở dữ liệu
        $sql = "INSERT INTO banners (banner_title, banner_date, banner_img) VALUES ('$banner_title', '$banner_date', '$banner_img')";
        $conn->query($sql);

        header("Location: manage_banners.php");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Xử lý sửa banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_banner'])) {
    $banner_id = $_POST['banner_id'];
    $banner_title = $_POST['banner_title'];
    $banner_date = $_POST['banner_date'];

    if (!empty($_FILES["banner_img"]["name"])) {
        $target_dir = "../admin/uploads/";
        $target_file = $target_dir . basename($_FILES["banner_img"]["name"]);
        if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file)) {
            $banner_img = $target_file;

            $sql = "UPDATE banners SET banner_title='$banner_title', banner_date='$banner_date', banner_img='$banner_img' WHERE banner_id=$banner_id";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $sql = "UPDATE banners SET banner_title='$banner_title', banner_date='$banner_date' WHERE banner_id=$banner_id";
    }

    $conn->query($sql);

    header("Location: manage_banners.php");
    exit();
}

// Xử lý xóa banner
if (isset($_GET['delete_id'])) {
    $banner_id = $_GET['delete_id'];

    // Truy vấn để lấy tên tệp ảnh của banner
    $sql_select_img = "SELECT banner_img FROM banners WHERE banner_id = ?";
    $stmt = $conn->prepare($sql_select_img);
    $stmt->bind_param("i", $banner_id);
    $stmt->execute();
    $stmt->bind_result($banner_img);
    $stmt->fetch();
    $stmt->close();

    // Xóa banner từ cơ sở dữ liệu
    $sql_delete_banner = "DELETE FROM banners WHERE banner_id = ?";
    $stmt = $conn->prepare($sql_delete_banner);
    $stmt->bind_param("i", $banner_id);
    if ($stmt->execute()) {
        $stmt->close();

        // Xóa tệp ảnh từ thư mục uploads
        $filepath = "" . $banner_img;
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        echo "<script>alert('Banner deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete banner');</script>";
    }

    header("Location: ../assets/manage_banners.php");
    exit();
}

// Lấy danh sách các banner
$sql = "SELECT * FROM banners";
$result = $conn->query($sql);

$banners = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $banners[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Management</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h1, h2 {
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
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
input[type="date"],
input[type="file"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
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
    <h1>Banner Management</h1>

    <h2>Banners</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banners as $banner): ?>
            <tr>
                <td><?php echo $banner['banner_id']; ?></td>
                <td><?php echo $banner['banner_title']; ?></td>
                <td><?php echo $banner['banner_date']; ?></td>
                <td><img src="<?php echo $banner['banner_img']; ?>" alt="Banner Image" width="100"></td>
                <td>
                    <button onclick="editBanner(<?php echo $banner['banner_id']; ?>)">Edit</button>
                    <a href="manage_banners.php?delete_id=<?php echo $banner['banner_id']; ?>" onclick="return confirm('Are you sure you want to delete this banner?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 id="form-title">Add Banner</h2>
    <form id="banner-form" action="manage_banners.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="banner_id" name="banner_id">
        <label for="banner_title">Title:</label>
        <input type="text" id="banner_title" name="banner_title" required><br>
        <label for="banner_date">Date:</label>
        <input type="date" id="banner_date" name="banner_date" required><br>
        <label for="banner_img">Image:</label>
        <input type="file" id="banner_img" name="banner_img"><br>
        <input type="submit" id="form-submit" name="add_banner" value="Add Banner">
    </form>

    <script>
        function editBanner(bannerId) {
            // Lấy thông tin banner từ bảng
            var banner = <?php echo json_encode($banners); ?>.find(b => b.banner_id == bannerId);

            // Hiển thị thông tin banner trên form
            document.getElementById('banner_id').value = banner.banner_id;
            document.getElementById('banner_title').value = banner.banner_title;
            document.getElementById('banner_date').value = banner.banner_date;
            document.getElementById('banner_img').required = false;

            document.getElementById('form-title').innerText = "Edit Banner";
            document.getElementById('form-submit').value = "Update Banner";
            document.getElementById('form-submit').name = "edit_banner";
        }
    </script>
</body>
</html>
