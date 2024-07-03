<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab Navigation Example</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="tab-container">
        <nav>
            <div class="nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-target="#nav-home" type="button" role="tab"
                    aria-controls="nav-home" aria-selected="true">Mô Tả Chi Tiết</button>
                <button class="nav-link" id="nav-profile-tab" data-target="#nav-profile" type="button" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Thông Tin Bổ Sung</button>
                <button class="nav-link" id="nav-contact-tab" data-target="#nav-contact" type="button" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Đánh Giá</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4>Tính Năng Vượt Trội <i class="fa-solid fa-feather"></i></h4>
                <ul class="tab1-list">
                    <li>Màng sơn bóng đẹp.</li>
                    <li>Lau chùi thoải mái, chống nấm mốc, rong rêu.</li>
                    <li>Đã được nhiệt đới hóa phù hợp với điều kiện thời tiết khắc nghiệt của Việt Nam.</li>
                    <li>Độ phủ cao – tiết kiệm chi phí trên từng m2.</li>
                    <li>Kháng khuẩn vượt trội.</li>
                    <li>Thi công dễ dàng, thân thiện với môi trường.</li>
                    <li>Phù hợp TCVN: 6934-2001.</li>
                </ul>

                <h4>Thi Công <i class="fa-solid fa-feather"></i></h4>
                <ol class="tab1-list">
                    <li>
                        Chuẩn bị bề mặt
                        <p>– Bề mặt mới: Để khô bề mặt sau 28 ngày trong điều kiện bình thường (nhiệt độ tối thiểu bề
                            mặt phải đạt từ 10°C và ít nhất phải lớn hơn 3°C so với điểm sương của không khí, độ ẩm
                            tương đối 80%), độ ẩm bề mặt phải nhỏ hơn 16% (đo bằng Protimeter). Loại bỏ hết bụi bẩn, dầu
                            mỡ khỏi bề mặt cần sơn để có bề mặt nhẵn mịn.</p>
                        <p>– Bề mặt cũ: Làm sạch bề mặt loại bỏ bụi bẩn, lớp sơn cũ. Xử lý bề mặt bị rong rêu, nấm mốc
                            bằng hóa chất thích hợp. Rửa sạch bề mặt (nếu cần) và để khô ráo hoàn toàn, độ ẩm bề mặt
                            phải nhỏ hơn 16% (đo bằng Protimeter).</p>
                    </li>

                    <li>Khuấy đều thùng sơn trước khi sử dụng. Dùng Rulo, cọ lăn hay Máy phun sơn để thi công.</li>
                    <li>Sau khi mở nắp phải sử dụng hết, làm sạch những nơi bị dính sơn bằng nước sạch ngay khi sơn
                        xong.</li>
                </ol>

                <h4>Hệ thống sơn đề nghị <i class="fa-solid fa-feather"></i></h4>
                <p>Bột trét tường 1-2 lớp => Bột bả nội thất</p>
                <p>Sơn lót 1-2 lớp => Sơn lót kháng kiềm nội thất – PRIME.INT</p>
                <p>Sơn phủ 02 lớp => Sơn bóng nội thất – IN FLAT</p>

                <h4>Lưu ý <i class="fa-solid fa-feather"></i></h4>
                <p>Không thi công khi nhiệt độ không khí dưới12°C và độ ẩm tương đối lớn hơn 85%.</p>
            </div>
            <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <ul>
                    <li>Quy Cách: 18 Lít, 5 Lít</li>
                    <li>Đuôi Màu: D, P, T</li>
                </ul>
            </div>
            <div class="tab-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <form class="custom-form">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Anh/ Chị</label>
                        <input type="text" class="form-control" id="nameInput" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Thông tin liên lạc</label>
                        <input type="tel" class="form-control" id="phoneInput" placeholder="Nhập số điện thoại của bạn"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="commentTextarea" class="form-label">Nhận xét</label>
                        <textarea class="form-control" id="commentTextarea" rows="3" placeholder="Nhập nhận xét của bạn"
                            required></textarea>
                    </div>
                    <input class="btn-submit" type="submit" value="Gửi">
                </form>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>

</html>

<style>
    .tab-container {
        width: 100%;
        margin: 50px auto;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        overflow: hidden;
    }

    .nav-tabs {
        display: flex;
        border-bottom: 2px solid #ddd;
        background-color: #FFF;
        padding: 10px 20px;

    }

    .nav-link {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        cursor: pointer;
        border: 1px solid transparent;
        border-bottom: none;
        background-color: #55D5D2;
        margin-right: 5px;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 8px 8px 0 0;
        font-weight: 600;
        color: #fff;
    }

    .nav-link.active {
        background-color: #F58F5D;
        color: #fff;
        border-color: #ddd;
    }

    .nav-link:hover {
        background-color: #F58F5D;
        color: #fff;
    }

    .tab-content {
        border-top: none;
        padding: 20px;
        background-color: #fff;
        overflow-y: auto;
        max-height: 550px;

    }

    .tab-content::-webkit-scrollbar {
        display: none;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.show {
        display: block;
    }


    /* tab1 */
    .tab-pane h4 {
        color: #ed1c24;
        font-weight: 600;
        font-size: 22px;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .tab-pane h4 i {
        margin-left: 10px;
    }

    .tab-pane p {
        margin-bottom: 10px;
        margin-left: 10px;
        line-height: 1.5;
    }

    .tab1-list {
        margin: 10px 0 20px 0;
    }

    .tab1-list li {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
        line-height: 1.5;
    }

    /* tab2 */



    /* tab3 */
    .custom-form {
        max-width: 680px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fdfdfd;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-form .mb-3 {
        margin-bottom: 20px;
    }

    .custom-form .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .custom-form .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .custom-form .form-control:focus {
        border-color: #55D5D2;
        box-shadow: 0 0 5px rgba(237, 28, 36, 0.5);
        outline: none;
    }

    .custom-form .btn-submit {
        background-color: #55D5D2;
        border: none;
        padding: 12px 20px;
        font-weight: bold;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
        width: 100%;
    }

    .custom-form .btn-submit:hover {
        background-color: #F58F5D;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- mobile css -->
<style>
    @media only screen and (max-width: 600px) {
        .nav-tabs{
            padding: 0 !important;
        }

        .nav-link:last-child{
            margin-right: 0 !important;
        }

        .tab-pane h4{   
            font-size: 15px !important;
        }

        .tab1-list, .tab-pane p, .tab-pane ul{
            font-size: 13px !important;
        }

        .tab-pane ul{
            line-height: 1.5;
            margin-bottom: 5px;
        }


    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');
        const tabPanes = document.querySelectorAll('.tab-pane');

        navLinks.forEach(navLink => {
            navLink.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');

                navLinks.forEach(link => link.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('show', 'active'));

                this.classList.add('active');
                document.querySelector(targetId).classList.add('show', 'active');
            });
        });
    });

</script>