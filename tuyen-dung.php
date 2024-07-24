<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuyển Dụng | IVANO</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/custom-scroll.css">

</head>

<style>
    #main-tuyen-dung {
        background: linear-gradient(to top right, #D7F8F8 0%, #FFFFFF 50%, #FFFFFF 70%, #FFC8B0 120%);
        padding: 150px 5% 50px 5%;
    }

    .one h2 {
        text-align: right;
        margin-right: 250px;
        font-size: 30px;
        text-transform: capitalize;
    }

    .one h2 span {
        display: block;
        margin-top: 20px;
        text-transform: uppercase;
        font-size: 50px;
        color: #FF2600;
    }

    .two {
        display: flex;
        gap: 20px;
        margin: 20px;
        padding: 20px;
        border-radius: 8px;
    }

    .two-left img {
        max-width: 100%;
        height: auto;
        transform: translateY(-230px);
    }

    .two-right {
        flex: 1;
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    .two-right p {
        margin-bottom: 15px;
    }

    .two-right p span {
        font-weight: 600;
    }

    .two-right button {
        margin-top: 20px;
        padding: 15px 30px;
        background-color: #55D5D2;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: all ease-in-out 0.3s;
    }

    .two-right button a {
        color: #FFF;
    }

    .two-right button:hover {
        background-color: #F58F5D;
    }

    /* three */

    .three {
        width: 80%;
        margin: 0px auto;
        background-color: rgb(242, 238, 241);
        padding: 30px;
        border-radius: 20px;
        transform: translateY(-200px);
    }

    .three h2 {
        text-align: center;
        color: #F58F5D;
        font-size: 25px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .des-job-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .des-job-item {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        text-align: center;
    }

    .des-job-item p {
        font-weight: 500;
        text-align: left;
    }

    .circle-container {
        position: relative;
        width: 50px;
        height: 50px;
        margin: 20px auto;
    }

    .circle-svg {
        width: 100%;
        height: 100%;
        transform: rotate(0deg);
    }

    .circle-bg {
        fill: none;
        stroke: #e6e6e6;
        stroke-width: 2.8;
    }

    .circle {
        fill: none;
        stroke: #00cc00;
        stroke-width: 2.8;
        stroke-dasharray: 100, 100;
        stroke-dashoffset: 100;
        transition: stroke-dashoffset 1s linear;
    }

    .checkmark {
        fill: none;
        stroke: #00cc00;
        stroke-width: 2.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 29;
        stroke-dashoffset: 29;
        transition: stroke-dashoffset 0.5s ease 1s;
    }

    .animate .circle {
        stroke-dashoffset: 0;
    }

    .animate .checkmark {
        stroke-dashoffset: 0;
    }
</style>

<style>
    .top-four {
        background-color: #006994;
        padding: 30px 30px 150px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transform: translateY(-130px);
    }

    .top-four h3 {
        text-transform: uppercase;
        font-size: 25px;
        color: #FFFF00;
    }

    .top-four .go-submit {
        padding: 20px 45px;
        background-color: #55D5D2;
        color: #FFF;
        font-weight: 700;
        border: none;
        cursor: pointer;
        border-radius: 15px;
        transition: all ease-in-out 0.3s;
    }

    .top-four .go-submit:hover {
        background-color: #F58F5D;
    }

    .four img {
        height: 450px;
        width: 80%;
        display: block;
        margin: 0 auto;
        object-fit: cover;
        transform: translateY(-230px);
        border-radius: 20px;
    }

    .bottom-four {}

    .bottom-four h2 {
        text-align: center;
        color: #F58F5D;
        text-transform: uppercase;
        font-size: 30px;
        transform: translateY(-150px);
    }

    .container-job {
        font-size: 18px;
        width: 50%;
        margin: 0 auto;
        transform: translateY(-100px);
        line-height: 1.5;
        font-weight: 500;
    }

    .job-item,
    .job-sub-item {
        list-style: unset;
        margin-bottom: 15px;
        align-items: center;
        padding-left: 10px;
    }

    /* .job-item::marker {
            content: '👉 ';
            font-size: 30px;
            margin-right: 20px;
        } */

    .job-sub-item {
        margin-top: 10px;
        margin-left: 50px;
    }
</style>

<style>
    .application-form {
        display: flex;
        width: 70%;
        margin: 0px auto;
        justify-content: space-between;
        background-color: #FFF;
        padding: 30px;
        border-radius: 10px;
        -webkit-animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: shadow-drop-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @-webkit-keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    @keyframes shadow-drop-center {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.35);
        }
    }

    .application-form img {
        width: 400px;
    }
</style>

<body>
    <?php include "assets/header.php"; ?>

    <main id="main-tuyen-dung">
        <section class="one">
            <h2>Công ty ivano Việt Nam <span>Tuyển dụng</span></h2>
        </section>

        <section class="two">
            <div class="two-left">
                <img src="images/z3778580980186_a2d5b0e343c2b2a5250f942a42f798b2-removebg-preview-4.png" alt="">
            </div>

            <div class="two-right">
                <p><span style="color: #FF2600; font-weight: 600">CTCP IVANO VIỆT NAM</span> <span
                        style="color: #0000FF;">tự hào là 1 trong những công ty uy tín hàng đầu Việt Nam trong
                        lĩnh vực sơn nước
                        và chống thấm.</span> Chúng tôi chuyên cung cấp các dòng sản phẩm sơn <span>cao cấp, chất lượng
                        cao, có độ bền,
                        đẹp vượt thời gian.</span> Với giá thành phù hợp cho các <span>công trình dân dụng</span> và các
                    <span>hạng mục công trình
                        lớn.</span>
                </p>

                <p>Nhằm mục đích mở rộng thị trường trên toàn quốc, <span>CTCP IVANO VIỆT NAM</span> cần tuyển dụng một
                    số vị trí: <span>Nhân Viên Kinh Doanh Thị Trường, Giám Đốc Kinh Doanh, Giám đốc miền, Giám sát bán
                        hàng…</span> trên toàn quốc. Ứng tuyển tại đây.</p>

                <button>
                    <a href="gioi-thieu.php">Xem thêm về chúng tôi</a>
                </button>
            </div>
        </section>

        <section class="three">
            <h2>Mô Tả công việc</h2>

            <div class="des-job-container">
                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Tìm kiếm và phát triển hệ thống Kênh Phân Phối (Đại lý, Nhà phân phối, Tổng Kho…) trên phạm vi
                        toàn quốc.</p>
                </div>

                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Tư vấn, giới thiệu sản phẩm đến quý Đại lý, Nhà Phân Phối, khách hàng lẻ tại địa bàn được giao
                    </p>
                </div>

                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Hỗ trợ khách hàng đặt hàng, thanh toán đối với khách hàng mình quản lý.</p>
                </div>

                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Chăm sóc khách hàng đã hợp tác, đang hợp tác và sau bán hàng. Nắm bắt tâm tư, nguyện vọng, ý kiến
                        phản hồi của quý khách hàng.</p>
                </div>

                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Tham mưu, đề xuất phương án, chính sách phát triển thị trường tại khu vực được giao.</p>
                </div>

                <div class="des-job-item">
                    <div class="notification-container" id="notification-container">
                        <div class="circle-container">
                            <svg class="circle-svg" viewBox="0 0 36 36">
                                <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" id="circle" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <polyline class="checkmark" points="10,18 15,23 26,12" />
                            </svg>
                        </div>
                    </div>
                    <p>Công việc chi tiết hơn trao đổi trực tiếp khi phỏng vấn.</p>
                </div>
            </div>
        </section>

        <section class="four">
            <div class="top-four">
                <h3>Mọi Nỗ Lực Sẽ Được Đền Đáp Xứng Đáng</h3>

                <button type="button" class="go-submit">Đăng Ký Ngay</button>
            </div>

            <img src="images/gaelle-marcel-Ld6bx4-axwo-unsplash-1198x800.jpg" alt="">

            <div class="bottom-four">
                <h2>Quyền Lợi</h2>

                <ul class="container-job">
                    <li class="job-item">
                        <span>Không đòi hỏi, phân biệt bằng cấp, kinh nghiệm, giới tính,… chúng tôi tuyển người biết
                            nghĩ, biết làm, có ý chí và tinh thần cầu tiến.</span>
                    </li>
                    <li class="job-item"><span>Lương không giới hạn theo năng lực và sự cống hiến của nhân sự.</span>
                    </li>
                    <li class="job-item">
                        <span>
                            Điều kiện hưởng lương và chế độ quy định <span style="color: #FF6600">theo cơ chế doanh
                                thu</span> (trao đổi trực tiếp khi phỏng
                            vấn).
                        </span>

                        <ol class="job-sub">
                            <li class="job-sub-item">Giám đốc Kinh doanh (20 – 30 triệu/tháng, KPI: 670 triệu/tháng)
                            </li>
                            <li class="job-sub-item">Giám đốc Miền ( 15 – 25 triệu/tháng, KPI: 380 triệu/tháng)</li>
                            <li class="job-sub-item">Giám sát bán hàng ( 7 – 20 triệu/tháng, KPI: đạt 75 triệu/tháng)
                            </li>
                            <li class="job-sub-item">Nhân viên kinh doanh ( 4.5 – 7 triệu/tháng, KPI: 22,5 triệu/tháng)
                            </li>
                        </ol>
                    </li>
                    <li class="job-item">
                        <span>
                            Ngoài ra, nhân viên còn được hưởng các khoản <span style="color: #FF6600">thưởng doanh
                                thu</span>, thưởng <span style="color: #FF6600">quý</span>, thưởng <span
                                style="color: #FF6600">năm</span> nếu
                            đạt KPI và hoàn thành tốt công việc.
                        </span>
                    </li>
                    <li class="job-item">
                        <span>
                            Cơ hội thăng tiến cao.
                        </span>
                    </li>
                    <li class="job-item">
                        <span>
                            Cơ hội được <span style="color: #0000FF">tham gia tất cả các khóa phát triển cá nhân</span>
                            do Công ty tổ chức và các khóa đào
                            tạo bên ngoài nhằm phát triển chuyên môn và kỹ năng cần thiết
                        </span>
                    </li>
                    <li class="job-item">
                        <span>
                            Địa điểm làm việc linh động theo nơi ở
                        </span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="five">
            <form action="" class="application-form">
                <div class="left-application-form">
                    <img src="images/tuyen-dung-655x800.jpg" alt="">
                </div>

                <div class="right-application-form">
                    <h2>Phiếu Đăng Ký Ứng Tuyển</h2>
                    <div class="form-group">
                        <input type="text" id="name" name="apply-name" required placeholder=" ">
                        <label for="name">Họ tên</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="address" name="apply-address" required placeholder=" ">
                        <label for="address">Địa chỉ</label>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" name="apply-tell" required placeholder=" ">
                        <label for="phone">Số điện thoại</label>
                    </div>
                    <div class="form-group">
                        <textarea id="content" name="apply-note" required placeholder=" "></textarea>
                        <label for="content">Nội dung</label>
                    </div>
                    <button type="submit" class="submit-btn">Gửi</button>
                </div>
            </form>
        </section>
    </main>

    <?php include "assets/footer.php"; ?>

</body>

<style>
    .right-application-form {
        width: 50%;
    }

    .right-application-form h2 {
        margin-bottom: 30px;
        font-size: 24px;
        color: #FF6600;
        text-align: center;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .form-group textarea {
        resize: vertical;
        height: 100px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #1E90FF;
    }

    .form-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 5px;
        color: #aaa;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:focus+label,
    .form-group textarea:not(:placeholder-shown)+label {
        top: 0px;
        font-size: 12px;
        color: #1E90FF;
    }

    .form-group input:focus+label,
    .form-group textarea:focus+label {
        color: #1E90FF;
    }

    .form-group input:not(:placeholder-shown)+label,
    .form-group textarea:not(:placeholder-shown)+label {
        color: #333;
    }

    .submit-btn {
        width: 100%;
        padding: 10px 20px;
        background-color: #55D5D2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #F58F5D;
    }
</style>

<!-- mobile css -->
<style>
    @media only screen and (max-width: 600px) {
        #main-tuyen-dung {
            padding: 80px 5% 50px 5% !important;
        }

        .one h2 {
            margin: 0 !important;
            font-size: 15px !important;
            text-align: center !important;
        }

        .one h2 span {
            font-size: 20px;
        }

        .two-left img {
            display: none !important;
        }

        .two {
            display: unset !important;
            padding: 20px 0 !important;
            width: 100% !important;
        }

        .two-right button {
            padding: 10px 20px !important;
            font-size: 15px !important;
            text-align: right !important;
            margin-left: auto !important;
        }

        .three {
            width: 100% !important;
            padding: 15px !important;
            border-radius: 10px !important;
            transform: translateY(0) !important;
        }

        .three h2 {
            font-size: 18px !important;
            margin-bottom: 10px !important;
        }

        .des-job-container {
            font-size: 13px !important;
            display: unset !important;
        }

        .four {
            margin-top: 20px;
        }

        .top-four {
            margin-top: 20px !important;
            transform: translateY(0) !important;
            display: block !important;
        }

        .top-four h3 {
            text-align: center !important;
            font-size: 18px !important;
        }

        .go-submit {
            display: none;
        }

        .four img {
            width: 90% !important;
            height: 250px !important;
            transform: translateY(-100px) !important;
        }

        .bottom-four {
            transform: translateY(-50px) !important;
        }

        .bottom-four h2 {
            transform: translateY(0) !important;
            font-size: 18px !important;
            margin-bottom: 10px !important;
        }

        .container-job {
            width: 95% !important;
            font-size: 13px !important;
            transform: translateY(0) !important;
        }

        .application-form {
            display: unset;
            width: 90% !important;
        }

        .application-form img {
            display: none;
        }

        .right-application-form {
            width: 100% !important;
        }

        .right-application-form h2 {
            font-size: 18px !important;
        }

    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const circles = document.querySelectorAll('.circle-container');

        circles.forEach(circle => {
            setTimeout(() => {
                circle.classList.add('animate');
            }, 500);
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.querySelector('.go-submit');
        const form = document.querySelector('.application-form');

        button.addEventListener('click', function () {
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

</script>

</html>