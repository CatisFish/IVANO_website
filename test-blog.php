<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Bài Viết</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function addSection() {
            const sectionsContainer = document.getElementById('sections-container');
            const sectionCount = sectionsContainer.children.length;
            const newSection = `
                <div class="section">
                    <label for="content_${sectionCount}">Nội Dung:</label>
                    <textarea id="content_${sectionCount}" name="contents[]" rows="4" required></textarea>
                    <label for="image_${sectionCount}">Hình Ảnh Mô Tả:</label>
                    <input type="file" id="image_${sectionCount}" name="images[]">
                </div>
            `;
            sectionsContainer.insertAdjacentHTML('beforeend', newSection);
        }
    </script>
</head>
<body>
    <h1>Thêm Bài Viết Mới</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="title">Tiêu Đề:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div id="sections-container">
            <div class="section">
                <label for="content_0">Nội Dung:</label>
                <textarea id="content_0" name="contents[]" rows="4" required></textarea>
                <label for="image_0">Hình Ảnh Mô Tả:</label>
                <input type="file" id="image_0" name="images[]">
            </div>
        </div>
        <button type="button" onclick="addSection()">Thêm Phần</button>
        <button type="submit">Thêm Bài Viết</button>
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);

    // Thêm bài viết vào bảng posts
    $sql = "INSERT INTO posts (title) VALUES ('$title')";
    if ($conn->query($sql) === TRUE) {
        $post_id = $conn->insert_id;
        $contents = $_POST['contents'];
        $image_paths = $_FILES['images'];

        for ($i = 0; $i < count($contents); $i++) {
            $content = $conn->real_escape_string($contents[$i]);
            $image_path = '';

            if (!empty($image_paths['name'][$i])) {
                $upload_dir = 'uploads/';
                $file_name = basename($image_paths['name'][$i]);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($image_paths['tmp_name'][$i], $target_file)) {
                    $image_path = $target_file;
                }
            }

            // Thêm phần bài viết vào bảng post_sections
            $sql = "INSERT INTO post_sections (post_id, content, image_path) VALUES ($post_id, '$content', '$image_path')";
            $conn->query($sql);
        }

        echo "Bài viết đã được thêm thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
