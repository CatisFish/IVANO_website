<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css  ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<!-- style.css -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .sidebar {
        width: 15%;
        height: 100%;
        background-color: #333;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        transition: width 0.3s ease;
        overflow-y: auto;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
    }

    .content {
        margin-left: 15%;
        padding: 20px;
        transition: margin-left 0.3s ease;
        height: 100%;
    }

    .top-sidebar {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #fff;
    }

    .nav-icons ul {
        list-style: none;
        padding: 0;
        margin: 50px 0 0 10px;
    }

    .nav-icons ul li {
        margin: 0 0 25px 10px;
    }

    .nav-icons ul li a {
        display: block;
        color: #fff;
        text-decoration: none;
    }

    .nav-icons ul li a i {
        margin-right: 10px;
        width: 30px;
        height: 30px;
    }

    #toggleButton {
        width: 30px;
        height: 30px;
        cursor: pointer;
    }


    .top-sidebar h2,
    .nav-icons ul li a span {
        transition: transform 0.3s ease;
    }

    .hidden .top-sidebar h2,
    .hidden .nav-icons ul li a span {
        transform: translateX(-100%);
    }
</style>

<body>
    <div class="sidebar" id="sidebar">
        <?php
            include "assets/sidebar.php";
        ?>
    </div>

    <div class="content" id="content">
        <h2>Welcome to Dashboard</h2>
        <p>This is the main content area.</p>
    </div>

    <script src="js/app.js"></script>
</body>

</html>