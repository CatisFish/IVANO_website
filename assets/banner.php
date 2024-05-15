<section class="banner-page">
    <div id="infiniteCarousel" class="carousel banner-page">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="./images/banner1.png" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="./images/banner2.png" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="./images/banner3.png" alt="Image 3">
            </div>
        </div>
    </div>
</section>

<style>
    .carousel {
        position: relative;
        overflow: hidden;
        width: 90%;
        margin: 0px auto; 
    }

    .carousel-inner {
        width: 100%;
        display: flex;
        transition: transform 0.5s ease-in-out;
        text-align: center;
    }

    .carousel-item {
        flex: 0 0 auto;
        width: 100%;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        margin: 0px auto;
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselInner = document.querySelector(".carousel-inner");

        function shiftAndMove() {
            carouselInner.style.transition = "transform 1s ease-in-out";
            carouselInner.style.transform = "translateX(-100%)";

            setTimeout(function() {
                var firstItem = document.querySelector(".carousel-item:first-child");
                carouselInner.appendChild(firstItem);
                carouselInner.style.transition = "none";
                carouselInner.style.transform = "translateX(0)";
            }, 1000);
        }

        setInterval(shiftAndMove, 3000);
    });
</script>