<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Bài Viết Mới</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        var sectionCount = 1;

        function addSection() {
            var sectionContainer = document.getElementById('sectionContainer');

            // Tạo các phần tử HTML mới
            var sectionDiv = document.createElement('div');
            sectionDiv.classList.add('section');

            var html = `
                <h3>Section ${sectionCount}</h3>
                <div>
                    <label for="blog_section_des_${sectionCount}">Mô tả:</label>
                    <textarea name="blog_section_des[]" id="blog_section_des_${sectionCount}" rows="4" ></textarea>
                </div>
                <div>
                    <label for="blog_section_content_${sectionCount}">Nội dung:</label>
                    <textarea name="blog_section_content[]" id="blog_section_content_${sectionCount}" rows="8" ></textarea>
                </div>
                <div>
                    <label for="blog_section_img_${sectionCount}">Hình ảnh mô tả:</label>
                    <input type="file" name="blog_section_img[]" id="blog_section_img_${sectionCount}" >
                </div>
            `;

            sectionDiv.innerHTML = html;
            sectionContainer.appendChild(sectionDiv);

            sectionCount++; // Tăng số thứ tự section
        }
    </script>
</head>

<body>
    <h1>Thêm Bài Viết Mới</h1>
    <form id="addBlogForm" method="post" enctype="multipart/form-data">
        <div>
            <label for="category_blog">Danh mục:</label>
            <select id="category_blog" name="category_blog" required>
                <option value="Tin Tức">Tin tức</option>
                <option value="Sự Kiện">Sự kiện</option>
            </select>
        </div>
        <div>
            <label for="title_blog">Tiêu đề:</label>
            <input type="text" id="title_blog" name="title_blog" required>
        </div>
        <div>
            <label for="img_blog">Hình ảnh:</label>
            <input type="file" id="img_blog" name="img_blog" required>
        </div>
        <div>
            <label for="user_post">Người đăng:</label>
            <input type="text" id="user_post" name="user_post" required>
        </div>

        <!-- Container cho các section -->
        <div id="sectionContainer">
            <div class="section">
                <div>
                    <label for="blog_section_des_1">Mô tả:</label>
                    <textarea name="blog_section_des[]" id="blog_section_des_1" rows="4"></textarea>
                </div>
                <div>
                    <label for="blog_section_content_1">Nội dung:</label>
                    <textarea name="blog_section_content[]" id="blog_section_content_1" rows="8" required></textarea>
                </div>
                <div>
                    <label for="blog_section_img_1">Hình ảnh mô tả:</label>
                    <input type="file" name="blog_section_img[]" id="blog_section_img_1">
                </div>
            </div>
        </div>

        <!-- Nút để thêm section mới -->
        <button type="button" onclick="addSection()">Thêm Section</button>

        <!-- Nút submit để gửi form -->
        <button type="submit">Thêm Bài Viết</button>
    </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connectDB.php";

    $category_blog = $_POST['category_blog'];
    $title_blog = $_POST['title_blog'];
    $img_blog = $_FILES['img_blog']['name'];
    $user_post = $_POST['user_post'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["img_blog"]["name"]);

    if (move_uploaded_file($_FILES["img_blog"]["tmp_name"], $target_file)) {
        echo "File ảnh " . htmlspecialchars(basename($_FILES["img_blog"]["name"])) . " đã được tải lên thành công.";
    } else {
        echo "Có lỗi khi tải file ảnh lên.";
    }

    $sql_insert_blog = "INSERT INTO blog (category_blog, title_blog, img_blog, user_post) 
                        VALUES ('$category_blog', '$title_blog', '$img_blog', '$user_post')";

    if ($conn->query($sql_insert_blog) === TRUE) {
        echo "Thêm bài viết mới thành công.";
    } else {
        echo "Lỗi: " . $sql_insert_blog . "<br>" . $conn->error;
    }

    $blog_id = $conn->insert_id;

    if (isset($_POST['blog_section_des']) && isset($_POST['blog_section_content']) && isset($_FILES['blog_section_img'])) {
        $descriptions = $_POST['blog_section_des'];
        $contents = $_POST['blog_section_content'];
        $section_images = $_FILES['blog_section_img'];

        // Lặp qua các section để thêm vào CSDL
        for ($i = 0; $i < count($descriptions); $i++) {
            $section_des = $descriptions[$i];
            $section_content = $contents[$i];
            $section_img = $section_images['name'][$i];

            // Upload file ảnh của section vào thư mục lưu trữ
            $section_target_file = $target_dir . basename($section_images["name"][$i]);
            if (move_uploaded_file($section_images["tmp_name"][$i], $section_target_file)) {
                echo "File ảnh " . htmlspecialchars(basename($section_images["name"][$i])) . " của section $i đã được tải lên thành công.";
            } else {
                echo "Có lỗi khi tải file ảnh của section $i lên.";
            }

            // Thêm dữ liệu của section vào bảng 'blog_section'
            $sql_insert_section = "INSERT INTO blog_section (blog_id, blog_section_des, blog_section_content, blog_section_img) 
                                   VALUES ('$blog_id', '$section_des', '$section_content', '$section_img')";
            if ($conn->query($sql_insert_section) !== TRUE) {
                echo "Lỗi khi thêm section $i: " . $sql_insert_section . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
} else {
    // không được post
}
?>



</html>