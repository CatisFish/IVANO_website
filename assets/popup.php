<style>
    .popup-custom {
        opacity: 0;
        width: 1000px;
        height: 500px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        background-size: cover;
        transition: all 0.3s ease-in-out;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1100;
    }

    .popup-header-custom {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    .close-popup-custom {
        position: absolute;
        top: 5px;
        right: 5px;
        padding: 10px 15px;
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .close-popup-custom:hover {
        background-color: #c82333;
    }

    .carousel-custom {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease-in-out;
    }

    .slide-custom {
        min-width: 100%;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
    }

    .left-custom {
        width: 100%;
        padding: 20px;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .left-custom h1 {
        margin: 0 0 10px;
        font-size: 24px;
        letter-spacing: 1px;
        width: 100%;
        font-weight: 700;
        -webkit-animation: tracking-in-expand 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) both 1s;
        animation: tracking-in-expand 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) both 1s;
    }

    @-webkit-keyframes tracking-in-expand {
        0% {
            letter-spacing: -0.5em;
            opacity: 0;
        }

        40% {
            opacity: 0.6;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes tracking-in-expand {
        0% {
            letter-spacing: -0.5em;
            opacity: 0;
        }

        40% {
            opacity: 0.6;
        }

        100% {
            opacity: 1;
        }
    }

    .left-custom p {
        margin: 10px 0;
        font-size: 16px;
        line-height: 1.5;
        width: 100%;
        -webkit-animation: focus-in-contract-bck 1s cubic-bezier(0.250, 0.460, 0.450, 0.940) both 1.5s;
        animation: focus-in-contract-bck 1s cubic-bezier(0.250, 0.460, 0.450, 0.940) both 1.5s;
    }

    @-webkit-keyframes focus-in-contract-bck {
        0% {
            letter-spacing: 1em;
            -webkit-transform: translateZ(300px);
            transform: translateZ(300px);
            -webkit-filter: blur(12px);
            filter: blur(12px);
            opacity: 0;
        }

        100% {
            -webkit-transform: translateZ(12px);
            transform: translateZ(12px);
            -webkit-filter: blur(0);
            filter: blur(0);
            opacity: 1;
        }
    }

    @keyframes focus-in-contract-bck {
        0% {
            letter-spacing: 1em;
            -webkit-transform: translateZ(300px);
            transform: translateZ(300px);
            -webkit-filter: blur(12px);
            filter: blur(12px);
            opacity: 0;
        }

        100% {
            -webkit-transform: translateZ(12px);
            transform: translateZ(12px);
            -webkit-filter: blur(0);
            filter: blur(0);
            opacity: 1;
        }
    }

    .signup-btn-custom {
        margin-top: 20px;
        padding: 10px 40px;
        background-color: #55D5D2;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
        -webkit-animation: shake-bottom 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both 2s;
        animation: shake-bottom 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both 2s;
    }

    @-webkit-keyframes shake-bottom {

        0%,
        100% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
        }

        10% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }

        20%,
        40%,
        60% {
            -webkit-transform: rotate(-4deg);
            transform: rotate(-4deg);
        }

        30%,
        50%,
        70% {
            -webkit-transform: rotate(4deg);
            transform: rotate(4deg);
        }

        80% {
            -webkit-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }

        90% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
    }

    @keyframes shake-bottom {

        0%,
        100% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
        }

        10% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }

        20%,
        40%,
        60% {
            -webkit-transform: rotate(-4deg);
            transform: rotate(-4deg);
        }

        30%,
        50%,
        70% {
            -webkit-transform: rotate(4deg);
            transform: rotate(4deg);
        }

        80% {
            -webkit-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }

        90% {
            -webkit-transform: rotate(2deg);
            transform: rotate(2deg);
        }
    }

    .signup-btn-custom:hover {
        background-color: #F58F5D;
    }

    .carousel-controls-custom {
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: space-between;
        top: 50%;
        transform: translateY(-50%);
    }

    .carousel-controls-custom button {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 30px 10px;
        transition: all ease-in-out 0.3s;
    }

    .carousel-controls-custom button:hover {
        background: rgba(0, 0, 0, 0.7);
    }

    .form-container-custom {
        position: relative;
        width: 30%;
        background: #f9f9f9;
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-left: 1px solid #ccc;
        z-index: 11;
        font-weight: 600;
    }

    .form-container-custom.active {
        transform: translateX(0);
    }

    .form-container-custom.active~.left-custom {
        width: 70%;
    }

    .form-container-custom h2 {
        margin-top: 0;
        font-size: 22px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-container-custom form {
        display: flex;
        flex-direction: column;
    }

    .form-container-custom form input {
        margin-bottom: 15px;
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-container-custom form input:focus {
        border-color: #007bff;
        outline: none;
    }

    .form-container-custom form button {
        padding: 12px 15px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-container-custom form button:hover {
        background-color: #0056b3;
    }

    .form-container-custom form .cancel-button {
        position: absolute;
        right: 10px;
        top: 10px;
        padding: 10px 15px;
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        z-index: 100;
    }

    .form-container-custom form .cancel-button:hover {
        background-color: #c82333;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1009;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .popup-custom {
            opacity: 0;
            width: 400px;
            height: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            background-size: cover;
            transition: all 0.3s ease-in-out;
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 1000;
        }

        .form-container-custom {
            position: relative;
            width: 100%;
            background: #f9f9f9;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-left: 1px solid #ccc;
            z-index: 11;
            font-weight: 600;
        }
    }
</style>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ivano_website";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get popup content
$sql_popup = "SELECT popup_content, popup_img, popup_description FROM popups "; // Replace '1' with the desired popup_id
$result_popup = $conn->query($sql_popup);

// Initialize variables with default values
$popup_title = "Popup Title";
$popup_img = "default_popup_img.jpg";
$popup_description = "Popup Description";


if ($result_popup && $result_popup->num_rows > 0) {
    $row_popup = $result_popup->fetch_assoc();
    $popup_title = $row_popup['popup_content'];
    $popup_img = "admin/" . $row_popup['popup_img'];
    $popup_description = $row_popup['popup_description'];
}
?>


<div class="overlay" id="overlay"></div>

<div class="popup-custom" id="popup-custom">
    <div class="popup-header-custom">
        <button type="button" class="close-popup-custom" onclick="hidePopUpCustom()"><i
                class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="carousel-custom" id="carousel-custom">
        <div class="slide-custom" style="background-image: url('<?php echo $popup_img; ?>');">
            <div class="left-custom" id="left-container-custom-1">
                <h1><?php echo $popup_title; ?></h1>
                <p><?php echo $popup_description; ?></p>
                <button class="signup-btn-custom" onclick="showFormCustom()">Nhận Ngay</button>
            </div>
        </div>
    </div>

    <div class="carousel-controls-custom">
        <!-- No need for carousel controls if only one slide -->
    </div>
    <div class="form-container-custom" id="form-container-custom">
        <h2>Thông Tin Của Bạn</h2>
        <form method="post" action="" id="tuvan-form">
            <button type="button" class="cancel-button" onclick="hideFormCustom()"><i
                    class="fa-solid fa-xmark"></i></button>
            <input type="text" name="ten" placeholder="Họ Tên" required>
            <input type="tel" name="so_dien_thoai" placeholder="Số điện thoại (Đăng ký zalo)" required>
            <button type="submit">Gửi</button>
        </form>
    </div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentSlideCustom = 0;
        var overlay = document.getElementById('overlay');

        setTimeout(function () {
            document.getElementById('popup-custom').style.opacity = '1';
            overlay.style.display = 'block';
            document.getElementById('popup-custom').classList.add('show');
        }, 100);
    });

    function hidePopUpCustom() {
        document.getElementById('popup-custom').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showFormCustom() {
        document.getElementById('form-container-custom').classList.add('active');
        document.querySelector('.left-custom').style.width = "70%";
    }

    function hideFormCustom() {
        document.getElementById('form-container-custom').classList.remove('active');
        document.querySelector('.left-custom').style.width = "100%";
    }

    document.getElementById('tuvan-form').addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('action/popup-action.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("Thông tin của bạn đã được gửi thành công.");
            document.getElementById('form-container-custom').innerHTML = data;
            hidePopUpCustom();
        })
        .catch(error => console.error('Error:', error));
    });
</script>
