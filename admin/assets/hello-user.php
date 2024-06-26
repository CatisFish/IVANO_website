<div class="main-top-right-admin-page">
    <div class="left-hello-user">
        <p>Hi</p>
        <span><?php echo htmlspecialchars($loggedInUsername); ?></span>
    </div>

    <div class="right-hello-user">
        <span><?php echo htmlspecialchars($initial); ?></span>
    </div>

    <div class="container-setting">
        <a href="setting.php">Chỉnh sửa thông tin</a>
        <a href="logout.php">Đăng xuất</a>
    </div>
</div>

<style>
    .main-top-right-admin-page:hover .container-setting {
        opacity: 1;
        top: 130%;
        visibility: visible; 
    }

    .container-setting {
        width: 250px;
        position: absolute;
        top: 150%;
        right: 0;
        background-color: #4ABAB6;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        overflow: visible;
        opacity: 0;
        transition: all ease-in-out 0.3s;
        visibility: hidden;
    }

    .container-setting::before {
        content: '';
        position: absolute;
        top: -29px;
        right: 10px;
        border-width: 15px;
        border-style: solid;
        border-color: transparent transparent #4ABAB6 transparent;
        z-index: 1001;
    }

    .container-setting a {
        display: block;
        text-decoration: none;
        color: #fff;
        padding: 8px 0;
        transition: background-color 0.3s ease;
        padding: 15px;
        position: relative;
    }

    .container-setting a:hover {
        background-color: #3B8D8A;
    }

    .container-setting a::after {
        content: '\f061';
        font-family: 'FontAwesome';
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all ease-in-out 0.3s;
    }

    .container-setting a:hover::after {
        left: 15px;
        opacity: 1;
    }
</style>

<style>
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
    }

    .main-top-left-admin-page {
        align-items: center;
    }

    .main-top-left-admin-page a {
        color: #FFF;
        transition: all ease-in-out 0.3s;
    }

    .main-top-left-admin-page a:hover {
        color: #000;
    }

    .main-top-right-admin-page {
        display: flex;
        gap: 10px;
        text-align: right;
        align-items: center;
        color: #fff;
        position: relative;
        cursor: pointer;
    }

    .left-hello-user p {
        font-weight: 500;
        font-size: 13px;
    }

    .left-hello-user span {
        text-transform: capitalize;
    }

    .right-hello-user {
        border: 1px dashed #fff;
        width: 50px;
        height: 50px;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        display: flex;
        text-transform: uppercase;

    }
</style>