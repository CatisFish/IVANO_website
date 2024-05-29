<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="show-ex-comment">
    <button class="btn-ex-prev" onclick="uniqueShowPrev()"><i class="fa-solid fa-chevron-left"></i></button>
    <div class="ex-comment-container">
        <div class="ex-comment-item">
            <div class="content-ex-cmt-left">
                <img src="images/z3716075312123_b7aec34db52a8b60b0273011cf60ba35.jpg" alt="">
            </div>
            <div class="content-ex-cmt-right">
                <div class="ex-cmt-star"><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-regular fa-star star-no-point"></i></div>
                <div class="ex-cmt-content">Tôi không chỉ tìm địa điểm mua sơn mà còn tìm những đơn vị bán sơn chất
                    lượng tốt, ở IVANO luôn đi kèm chính sách bảo hành, dịch vụ hậu mãi. Đây là cách doanh nghiệp tạo
                    niềm tin cho khách hàng cũng như cho thấy họ quan tâm đến lợi ích người tiêu dùng.</div>
                <div class="ex-cmt-name"><span class="ex-name">Vũ Khánh</span> / <span class="ex-adress">Bến Tre</span>
                </div>
            </div>
        </div>

        <div class="ex-comment-item">
            <div class="content-ex-cmt-left">
                <img src="images/z3716075319228_5eefed20c9b829d36080b94b7296305c.jpg" alt="">
            </div>
            <div class="content-ex-cmt-right">
                <div class="ex-cmt-star"><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-solid fa-star star-point"></i></div>
                <div class="ex-cmt-content">Sơn nội thất và ngoại thất của IVANO đều đạt độ che phủ tốt, bề
                    mặt
                    mịn, láng bóng và có khả năng chống bám bụi, chống rêu mốc và tăng khả năng chùi rửa
                    hiệu quả, nên giúp bảo vệ bề mặt rất tốt và chống vi khuẩn gây hại tồn tại ở bề
                    mặt
                    sơn và sức khỏe con người</div>
                <div class="ex-cmt-name"><span class="ex-name">Ngọc Hân</span> / <span class="ex-adress">Bạc Liêu</span>
                </div>
            </div>
        </div>

        <div class="ex-comment-item">
            <div class="content-ex-cmt-left">
                <img src="images/z3716116718257_84b686a5eb284bfb95299f7f6e2f85a1.jpg" alt="">
            </div>
            <div class="content-ex-cmt-right">
                <div class="ex-cmt-star"><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-solid fa-star star-point"></i><i
                        class="fa-solid fa-star star-point"></i><i class="fa-solid fa-star star-point"></i></div>
                <div class="ex-cmt-content">Những dòng sơn của IVANO VIỆT NAM là những thương hiệu sơn có giá cả
                    cạnh
                    tranh và luôn có sự ưu đãi dành cho khách hàng. Sản phẩm đa dạng phù hợp với túi tiền
                    và
                    nhu cầu của mọi người.</div>
                <div class="ex-cmt-name"><span class="ex-name">Việt Bắc</span> / <span class="ex-adress">Cà Mau</span>
                </div>
            </div>
        </div>

    </div>

    </div>
    <button class="btn-ex-next" onclick="uniqueShowNext()"><i class="fa-solid fa-chevron-right"></i></button>

    <div class="unique-radio-buttons">
        <input type="radio" name="unique-slider" id="unique-radio1" checked>
        <span></span>
        <input type="radio" name="unique-slider" id="unique-radio2">
        <span></span>
        <input type="radio" name="unique-slider" id="unique-radio3">
        <span></span>
</section>

<style>
    .show-ex-comment {
        overflow: hidden;
        margin-top: 50px;
        background-image: url('images/BacksAndBeyond_Images_Learning_2-2000x700-1-1400x490.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
        margin: 50px;
        border-radius: 15px;
    }

    .ex-comment-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 80%;
        margin: 0px auto;
    }

    .ex-comment-item {
        min-width: 100%;
        box-sizing: border-box;
        display: flex;
        gap: 30px;
        padding: 40px 13%;
    }

    .content-ex-cmt-left img {
        width: 120px;
        border-radius: 50%;
    }

    .ex-cmt-star {
        margin-bottom: 15px;
    }

    .star-point,
    .star-no-point {
        color: #FFD400;
    }

    .content-ex-cmt-right {
        color: #fff;
    }

    .ex-cmt-content {
        font-weight: 500;
        font-style: italic;
        font-size: 16px;
    }

    .ex-cmt-name {
        margin-top: 20px;
    }

    .ex-name {
        font-weight: 600;
    }

    .btn-ex-prev,
    .btn-ex-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 30px 15px;
        cursor: pointer;
        border: none;
        z-index: 1;
        user-select: none;
    }

    .btn-ex-prev {
        left: 20px;
        border-radius: 3px 0 0 3px;
    }

    .btn-ex-next {
        right: 20px;
        border-radius: 3px 0 0 3px;
    }

    .unique-radio-buttons {
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        user-select: none;
    }

    .unique-radio-buttons input[type="radio"] {
        display: none;
    }

    .unique-radio-buttons input[type="radio"]+span {
        display: inline-block;
        width: 15px;
        height: 15px;
        background-color: #fff;
        border: 2px solid #fff;
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .unique-radio-buttons input[type="radio"]:hover+span {
        background-color: #ddd;
    }

    .unique-radio-buttons input[type="radio"]:checked+span {
        background-color: #fff;
        border-color: #007bff;
    }
</style>

<script>
    var commentContainer = document.querySelector('.ex-comment-container');
    var currentPosition = 0;
    var commentItems = document.querySelectorAll('.ex-comment-item');
    var totalItems = commentItems.length;
    var radioButtons = document.querySelectorAll('input[name="unique-slider"]');
    var timer;

    function updateRadioButtons() {
        radioButtons.forEach(function(radioButton, index) {
            radioButton.checked = index === currentPosition;
        });
    }

    function uniqueShowNext() {
        currentPosition = (currentPosition + 1) % totalItems;
        slideComments();
    }

    function uniqueShowPrev() {
        currentPosition = (currentPosition - 1 + totalItems) % totalItems;
        slideComments();
    }
    document.querySelector('.btn-ex-prev').addEventListener('click', uniqueShowPrev);
    document.querySelector('.btn-ex-next').addEventListener('click', uniqueShowNext);
    radioButtons.forEach(function(radioButton, index) {
        radioButton.addEventListener('click', function() {
            currentPosition = index;
            slideComments();
        });
    });

    function slideComments() {
        var newPosition = -currentPosition * 100 + '%';
        commentContainer.style.transition = 'transform 0.5s ease-in-out';
        commentContainer.style.transform = 'translateX(' + newPosition + ')';
        updateRadioButtons();
        clearTimeout(timer);
        timer = setTimeout(function() {
            uniqueShowNext();
        }, 5000);
    }
    slideComments();
</script>