<?php
include "php/connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn lấy thông tin từ bảng blog và bảng blog_section
    $sql = "SELECT b.*, bs.blog_section_des, bs.blog_section_content, bs.blog_section_img
            FROM blog AS b
            LEFT JOIN blog_section AS bs ON b.blog_id = bs.blog_id
            WHERE b.blog_id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="blog-post">';
            echo '<h2>' . $row["title_blog"] . '</h2>';
            echo '<div class="blog-meta">';
            echo '<p>Posted by <span>' . $row["user_post"] . '</span> on ' . date("d/m/Y", strtotime($row["create_time"])) . '</p>';
            echo '</div>';
            echo '<div class="blog-content">';
            echo '<img src="admin/uploads/' . $row["img_blog"] . '" alt="' . $row["title_blog"] . '">';
            echo '<p>' . $row["content_blog"] . '</p>';
            echo '</div>';

            // Hiển thị các phần trong bài viết từ bảng blog_section
            echo '<div class="blog-sections">';
            echo '<h3>Sections</h3>';
            echo '<ul>';
            // Duyệt qua các phần trong bài viết
            do {
                echo '<li>';
                echo '<h4>' . $row["blog_section_des"] . '</h4>';
                echo '<p>' . $row["blog_section_content"] . '</p>';
                echo '<img src="admin/uploads/' . $row["blog_section_img"] . '" alt="' . $row["blog_section_des"] . '">';
                echo '</li>';
            } while ($row = $result->fetch_assoc());
            echo '</ul>';
            echo '</div>';

            echo '</div>'; // Kết thúc blog-post
        }
    } else {
        echo "Không tìm thấy bài viết.";
    }

    $conn->close();
} else {
    echo "ID bài viết không hợp lệ.";
}
?>
