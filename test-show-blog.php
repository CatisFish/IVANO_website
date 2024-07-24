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

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Trang Blog của Tôi</h1>
    </header>
    <main>
        <?php while($row = $result->fetch_assoc()): ?>
            <article class="blog-post">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <?php
                $post_id = $row['id'];
                $section_sql = "SELECT content, image_path FROM post_sections WHERE post_id = $post_id";
                $section_result = $conn->query($section_sql);
                while ($section_row = $section_result->fetch_assoc()): ?>
                    <p><?php echo nl2br(htmlspecialchars($section_row['content'])); ?></p>
                    <?php if (!empty($section_row['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($section_row['image_path']); ?>" alt="Mô tả hình ảnh" class="inline-img">
                    <?php endif; ?>
                <?php endwhile; ?>
                <p>Được đăng vào: <?php echo $row['created_at']; ?></p>
            </article>
        <?php endwhile; ?>
    </main>
    <footer>
        <p>Bản quyền © 2024 Trang Blog của Tôi</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

<style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

main {
    padding: 20px;
}

.blog-post {
    background: #fff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.blog-post h2 {
    color: #333;
}

.inline-img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 10px 0;
}

footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
}

form div {
    margin-bottom: 15px;
}

form label {
    display: block;
    font-weight: bold;
}

form input, form textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

form button {
    padding: 10px 20px;
    background: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background: #0056b3;
}
    
</style>