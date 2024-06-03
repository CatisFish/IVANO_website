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

    <div class="radio-buttons-comment">
        <input type="radio" id="side-comment1" name="side-comment" checked>
        <label for="side-comment1"></label>
        <input type="radio" id="side-comment2" name="side-comment">
        <label for="side-comment2"></label>
        <input type="radio" id="side-comment3" name="side-comment">
        <label for="side-comment3"></label>
    </div>
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
        align-items: center;
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 90%;
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

    .radio-buttons-comment {
        display: flex;
        justify-content: center;
        margin: 5px 0 10px 0;
        position: absolute;
        bottom: 10px;
        right: 50%;
        transform: translateY(50%)

    }

    .radio-buttons-comment input {
        display: none;
    }

    .radio-buttons-comment label {
        width: 5px;
        height: 5px;
        background-color: #ccc;
        border-radius: 50%;
        margin: 0px 5px 5px 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .radio-buttons-comment input:checked+label {
        background-color: #007bff;
        transform: scale(1.15);
        box-shadow: 0 0 0 2px #007bff, 0 2px 10px rgba(0, 0, 0, 0.2);
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .show-ex-comment {
            overflow: hidden;
            margin-top: 50px;
            background-image: url('images/BacksAndBeyond_Images_Learning_2-2000x700-1-1400x490.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            margin: 10px;
            border-radius: 15px;
        }

        .ex-comment-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 95%;
            margin: 0px auto;
        }

        .ex-comment-item {
            align-items: center;
            min-width: 100%;
            box-sizing: border-box;
            display: flex;
            gap: 10px;
            padding: 10px 20px;
        }

        .content-ex-cmt-left img {
            width: 75px;
            border-radius: 50%;
        }

        .ex-cmt-star {
            margin-bottom: 15px;
            font-size: 13px;
        }

        .star-point,
        .star-no-point {
            color: #FFD400;
        }

        .content-ex-cmt-right {
            color: #FFF;

        }

        .ex-cmt-content {
            font-weight: 500;
            font-style: italic;
            font-size: 10px;
        }

        .ex-cmt-name {
            margin-top: 15px;
            font-size: 12px;
            margin-bottom: 10px;
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
            padding: 15px 5px;
            cursor: pointer;
            border: none;
            z-index: 1;
            user-select: none;
            font-size: 13px;
        }

        .btn-ex-prev {
            left: 0px;
            border-radius: 3px 0 0 3px;
        }

        .btn-ex-next {
            right: 0px;
            border-radius: 0px 3px 3px 0px;
        }

        .radio-buttons-comment {
            display: flex;
            justify-content: center;
            margin: 5px 0 10px 0;
        }

        .radio-buttons-comment input {
            display: none;
        }

        .radio-buttons-comment label {
            width: 5px;
            height: 5px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0px 5px 5px 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .radio-buttons-comment input:checked+label {
            background-color: #007bff;
            transform: scale(1.15);
            box-shadow: 0 0 0 2px #007bff, 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    }
</style>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        const exCommentContainer = document.querySelector(".ex-comment-container");
        const exRadioButtons = document.querySelectorAll('[name="side-comment"]');
        const exPreBtn = document.querySelector(".btn-ex-prev");
        const exNextBtn = document.querySelector(".btn-ex-next");
        const commentWidth = exCommentContainer.offsetWidth;

        let currentSlideIndex = 0;

        exPreBtn.addEventListener('click', () => {
            const lastItem = exCommentContainer.querySelector(".ex-comment-item:last-child");
            exCommentContainer.insertBefore(lastItem, exCommentContainer.firstChild);
            exCommentContainer.style.transition = "none";
            exCommentContainer.style.transform = `translateX(-${commentWidth}px)`;

            setTimeout(() => {
                exCommentContainer.style.transition = "transform 0.5s ease-in-out";
                exCommentContainer.style.transform = "translateX(0)";
            }, 20);

            currentSlideIndex = (currentSlideIndex - 1 + exRadioButtons.length) % exRadioButtons.length;
            updateRadioButtons();
        });

        exNextBtn.addEventListener('click', () => {
            const firstItem = exCommentContainer.querySelector(".ex-comment-item:first-child");
            exCommentContainer.style.transition = "transform 0.5s ease-in-out";
            exCommentContainer.style.transform = `translateX(-${commentWidth}px)`;

            setTimeout(() => {
                exCommentContainer.appendChild(firstItem);
                exCommentContainer.style.transition = "none";
                exCommentContainer.style.transform = "translateX(0)";
            }, 500);

            currentSlideIndex = (currentSlideIndex + 1) % exRadioButtons.length;
            updateRadioButtons();
        });

        function updateRadioButtons() {
            exRadioButtons.forEach((radioButton, index) => {
                radioButton.checked = index === currentSlideIndex;
            });
        }
    });

</script>