<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


<!-- custom loại bỏ các css của bootstrap lên header -->
<style>
    a {
        text-decoration: none;
        color: #221F20;
    }

    dl,
    ol,
    ul {
        margin-top: unset;
        margin-bottom: unset;
        padding-left: unset;
    }

    .container-nav-right-item {
        align-items: center;
    }
</style>

<style>
    .bootstrap-container .tab-content {
        margin-top: 20px;
    }

    .custom-tab-pane {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-tab-pane h5 {
        color: #ed1c24;
        font-weight: 600;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .custom-tab-pane ul {
        list-style: none;
        padding-left: 0;
    }

    .custom-tab-pane ul li {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
    }

    .custom-tab-pane ul li::before {
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: #ed1c24;
    }



    /* Custom CSS for the form */
    .nav-comment-custom {
        max-width: 680px;
        margin: 0px auto;
    }

    .custom-tab-pane .form-label {
        font-weight: 600;
        color: #333;
    }

    .custom-tab-pane .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .custom-tab-pane .form-control:focus {
        border-color: #ed1c24;
        box-shadow: 0 0 5px rgba(237, 28, 36, 0.5);
    }

    .custom-tab-pane .btn-primary {
        background-color: #ed1c24;
        border-color: #ed1c24;
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 5px;
    }

    .custom-tab-pane .btn-primary:hover {
        background-color: #c4161c;
        border-color: #c4161c;
    }
</style>

<div class="bootstrap-container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Mô Tả Chi Tiết</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Thông Tin Bổ Sung</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Đánh Giá</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active custom-tab-pane" id="nav-home" role="tabpanel"
            aria-labelledby="nav-home-tab" tabindex="0">
            <h5>Tính Năng Vượt Trội</h5>
            <ul>
                <li>Màng sơn bóng đẹp.</li>
                <li>Lau chùi thoải mái, chống nấm mốc, rong rêu.</li>
                <li>Đã được nhiệt đới hóa phù hợp với điều kiện thời tiết khắc nghiệt của Việt Nam.</li>
                <li>Độ phủ cao – tiết kiệm chi phí trên từng m2.</li>
                <li>Kháng khuẩn vượt trội.</li>
                <li>Thi công dễ dàng, thân thiện với môi trường.</li>
                <li>Phù hợp TCVN: 6934-2001.</li>
            </ul>
        </div>

        <div class="tab-pane fade custom-tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
            tabindex="0">
            <h5>Thông Tin Bổ Sung</h5>
            <ul>
                <li>Quy Cách: 18 Lít, 5 Lít</li>
                <li>Đuôi Màu: D, P, T</li>
            </ul>
        </div>

        <div class="tab-pane fade custom-tab-pane nav-comment-custom" id="nav-contact" role="tabpanel"
            aria-labelledby="nav-contact-tab" tabindex="0">
            <form class="custom-form">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Anh/ Chị</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2"
                        placeholder="Nhập tên của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Số Điện Thoại</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2"
                        placeholder="Nhập số điện thoại của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Bình Luận</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Nhập bình luận của bạn" required></textarea>
                </div>
                <input class="btn btn-primary" type="submit" value="Đăng">
            </form>
        </div>
    </div>
</div>