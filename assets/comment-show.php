<?php
include 'php/conection.php';

// Query to fetch comments from the database
$sql = "SELECT * FROM comments";
$result = $conn->query($sql);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


<section class="show-ex-comment">
    <button class="btn-ex-prev" onclick="uniqueShowPrev()"><i class="fa-solid fa-chevron-left"></i></button>
    <div class="ex-comment-container">
        <?php
        // Loop through each comment retrieved from the database
        while($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $phone = $row['phone'];
            $comment = $row['comment'];
            $image_path = $row['path_img'];
        ?>
        <div class="ex-comment-item">
            <div class="content-ex-cmt-left">
                <img src="<?php echo $image_path; ?>" alt="">
            </div>
            <div class="content-ex-cmt-right">
                <div class="ex-cmt-content"><?php echo $comment; ?></div>
                <div class="ex-cmt-name"><span class="ex-name"><?php echo $name; ?></span> / <span class="ex-adress"><?php echo $phone; ?></span></div>
            </div>
        </div>
        <?php
        }
        ?>
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

<?php
// Đóng kết nối với cơ sở dữ liệu
$conn->close();
?>


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