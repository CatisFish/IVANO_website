<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">

    <title>Blog | IVANO</title>
</head>

<style>
    #main-page-blog {
        padding: 150px 5% 30px 5%;
        background: linear-gradient(to top right, #D7F8F8 0%, #FFFFFF 50%, #FFFFFF 70%, #FFC8B0 120%);
        display: flex;
        justify-content: space-between;
    }

    .sidebar-blog {
        width: 25%;
        padding-right: 20px;
        border-right: 1px solid #ddd;
    }

    .top-sidebar-blog {
        margin-bottom: 50px;
    }

    .title-top-sidebar-blog,
    .title-bottom-sidebar-blog {
        margin-bottom: 15px;
        padding-bottom: 10px;
        position: relative;
    }

    .title-top-sidebar-blog::after,
    .title-bottom-sidebar-blog::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 20%;
        height: 2px;
        background-color: #dd9933;
    }

    .container-option p {
        font-weight: 500;
        color: #F58F5D;
        border-bottom: 1px dashed #000;
        padding: 10px 0;
        position: relative;
        cursor: pointer;
    }

    .container-option p::before {
        content: "\f060";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: -10px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: right 0.5s, opacity 0.5s;
        font-size: 15px;
    }

    .container-option p:hover::before {
        opacity: 1;
        right: 10px;
    }

    .container-option p span {
        color: #000;
    }








    .blog-container {
        margin-left: 20px;
    }
</style>

<!-- bài viết mới -->
<style>
    .new-blog {
        display: flex;
        gap: 20px;
        padding: 0 20px 0 40px;
    }

    .new-blog-item {
        width: 50%;
        text-decoration: none;
        color: #333;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        border: 1px solid #ddd;
    }

    .new-blog-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .new-container-img-blog {
        overflow: hidden;
        max-width: 100%;
        max-height: 350px;
    }

    .new-container-img-blog img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
        object-fit: cover;
    }

    .new-blog-item:hover .new-container-img-blog img {
        transform: scale(1.1);
    }

    .new-demo-blog {
        padding: 15px;
        font-size: 1.2em;
        font-weight: bold;
        color: #444;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        /* Số dòng tối đa */
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .new-bottom-blog-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        border-top: 1px solid #eee;
        font-size: 0.9em;
        color: #777;
    }

    .new-bottom-blog-item p {
        margin: 0;
    }

    .new-bottom-blog-item .user-posted span {
        color: #007BFF;
    }

    .user-posted {
        display: flex;
    }

    .new-bottom-blog-item .new-date-post {
        display: flex;
        align-items: center;
    }

    .new-bottom-blog-item .new-date-post i {
        margin-right: 5px;
        color: #007BFF;
    }
</style>

<!-- các bài viết cũ hơn -->
<style>
    .blog-container {
        display: grid;
        grid-template-columns: auto auto auto;
        gap: 20px;
        padding: 20px;
    }

    .blog-item {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none;
        color: #333;
        transition: all 0.5s ease-in-out;
    }


    .blog-item:nth-child(1),
    .blog-item:nth-child(4) {
        margin-bottom: 20%;
    }

    /* Chỉnh margin-top cho cột thứ hai */
    .blog-item:nth-child(2),
    .blog-item:nth-child(5) {
        margin-top: 10%;
        margin-bottom: 10%;
    }

    /* Chỉnh margin-top cho cột thứ ba */
    .blog-item:nth-child(3),
    .blog-item:nth-child(6) {
        margin-top: 20%;
    }

    .blog-item:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .blog-item:hover .demo-blog {
        color: #FF6600;
    }

    .container-img-blog {
        overflow: hidden;
        position: relative;
        max-width: 100%;
        max-height: 400px;
        height: 300px;
    }

    .category-blog-tag {
        display: inline-block;
        padding: 10px 20px;
        background-color: #f0c14b;
        color: #111;
        font-size: 13px;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 0px;
        left: 0;
        margin: 10px;
    }

    .category-blog-tag:after {
        content: '';
        position: absolute;
        border-style: solid;
    }

    .category-blog-tag:after {
        top: 50%;
        right: -10px;
        border-width: 10px 0 10px 15px;
        border-color: transparent transparent transparent #f0c14b;
        transform: translateY(-50%);
    }

    .blog-category {
        margin-left: 5px;
    }

    .blog-item img {
        height: auto;
        width: 100%;
        object-fit: cover;
        transition: all ease-in-out 0.3s;
    }

    .blog-item:hover img {
        transform: scale(1.05) rotate(10deg);
    }


    .demo-blog {
        padding: 20px;

    }

    .demo-blog p {
        transition: all 0.5s ease-in-out;
        margin: 0;
        font-size: 1.2em;
        font-weight: bold;
    }

    .bottom-blog-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .user-posted {
        font-weight: 500;
        color: #F58F5D;
        display: flex;
        flex-direction: column;
        font-size: 13px;
    }

    .user-posted span {
        font-weight: 600;
        color: #FF2600;
        margin-top: 5px;
        font-size: 18px;
    }

    .date-post {
        padding: 10px 20px;
        background-color: #55D5D2;
        border-radius: 20px;
        font-weight: 500;
        color: #FFF;
    }

    .date-post i {
        margin-right: 10px;
    }
</style>

<body>
    <?php include "assets/header.php"; ?>

    <main id="main-page-blog">
        <div class="sidebar-blog">
            <div class="top-sidebar-blog">
                <h3 class="title-top-sidebar-blog">Chuyên mục</h3>

                <div class="container-option">
                    <p>Tin Tức <span class="quantity-option-blog">(2)</span></p>
                    <p>Sự Kiện <span class="quantity-option-blog">(3)</span></p>
                </div>
            </div>

            <div class="bottom-sidebar-blog">
                <h3 class="title-bottom-sidebar-blog">Lưu trữ</h3>

                <div class="container-option">
                    <p>01/2023 <span class="quantity-option-blog">(2)</span></p>
                    <p>01/2024 <span class="quantity-option-blog">(3)</span></p>
                </div>
            </div>
        </div>

        <div class="container-content">
            <!-- bài viết mới -->
            <?php
            include "php/conection.php";

            $sql = "SELECT category_blog, title_blog, user_post, create_time, img_blog FROM blog ORDER BY create_time DESC LIMIT 2";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="new-blog">';
                while ($row = $result->fetch_assoc()) {

                    echo '<a href="" class="new-blog-item">';
                    echo '<div class="new-container-img-blog">';
                    echo '<img src="admin/uploads/' . $row["img_blog"] . '" alt="">';
                    echo '<div class="category-blog-tag">';
                    echo '<span class="blog-category">' . $row["category_blog"] . '</span>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="new-demo-blog">';
                    echo '<p class="title">' . $row["title_blog"] . '</p>';
                    echo '</div>';

                    echo '<div class="new-bottom-blog-item">';
                    echo '<p class="user-posted">';
                    echo 'Posted by <span>' . $row["user_post"] . '</span>';
                    echo '</p>';

                    echo '<p class="new-date-post">';
                    echo '<i class="fa-regular fa-calendar-days"></i>';
                    echo '<span>' . date("d/m/Y", strtotime($row["create_time"])) . '</span>';
                    echo '</p>';
                    echo '</div>';

                    echo '</a>';

                }
                echo '</div>';
            } else {
                echo "Không có bài viết nào.";
            }

            $conn->close();
            ?>

            <!-- các  bài cũ hơn -->
            <?php
            include "php/conection.php";

            $sql = "SELECT category_blog, title_blog, img_blog, user_post, create_time FROM blog ORDER BY create_time DESC LIMIT 7 OFFSET 2";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="blog-container">';

                while ($row = $result->fetch_assoc()) {
                    echo '<a href="" class="blog-item">';
                    echo '<div class="container-img-blog">';
                    echo '<img src="admin/uploads/' . $row["img_blog"] . '" alt="">';
                    echo '<div class="category-blog-tag">';
                    echo '<span class="blog-category">' . $row["category_blog"] . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="demo-blog">';
                    echo '<p>' . $row["title_blog"] . '</p>';
                    echo '</div>';
                    echo '<div class="bottom-blog-item">';
                    echo '<p class="user-posted">';
                    echo 'Posted by <span>' . $row["user_post"] . '</span>';
                    echo '</p>';
                    echo '<p class="date-post">';
                    echo '<i class="fa-regular fa-calendar-days"></i>';
                    echo '<span>' . date("d/m/Y", strtotime($row["create_time"])) . '</span>';
                    echo '</p>';
                    echo '</div>';
                    echo '</a>';
                }

                echo '</div>';
            } else {
                echo "Không có bài viết nào.";
            }

            $conn->close();
            ?>

        </div>
    </main>
</body>

</html>