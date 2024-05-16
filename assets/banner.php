<!-- <section class="banner-page">
    <div id="infiniteCarousel" class="carousel banner-page">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="./images/banner1.jpeg" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="./images/banner2.jpeg" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="./images/banner3.gif" alt="Image 3">
            </div>
        </div>
    </div>
</section> -->



<style>
    .carousel {
        position: relative;
        overflow: hidden;
        width: 100%;
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
        position: relative;
    }

    .carousel-item img {
        width: 100%;
        height: 750px;
        margin: 0px auto;    
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

        setInterval(shiftAndMove, 30000);
    });
</script>

<section class="banner-page">
    <div id="infiniteCarousel" class="carousel banner-page">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="./images/banner1.jpeg" alt="Image 1">
                <div class="carousel-caption">
                    <h1>HỢP TÁC KHOA HỌC VIỆT - NHẬT </h1>
                    <p>KHẲNG ĐỊNH CHẤT LƯỢNG TRONG TỪNG CÔNG TRÌNH</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/banner2.jpeg" alt="Image 2">
                <div class="carousel-caption">
                    <h3>Banner 2</h3>
                    <p>Mô tả cho Banner 2</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/banner3.gif" alt="Image 3">
                <div class="carousel-caption">
                    <h3>Banner 3</h3>
                    <p>Mô tả cho Banner 3</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
   .carousel-caption {
    position: absolute;
    bottom: -50%; 
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: white;
    animation: slideUp 1.5s ease forwards;
}

@keyframes slideUp {
    from {
        bottom: -50%;
    }
    to {
        bottom: 50%; 
    }
}

.carousel-caption h1 {
    font-size: 40px; 
    font-weight: bold; 
    text-shadow: 10px 10px 30px rgba(0, 0, 0, 1.9);  
}

.carousel-caption p {
    font-size: 20px; 
    margin-top: 20px; 
    text-shadow: 10px 10px 30px rgba(0, 0, 0, 1.9);  
}

</style>