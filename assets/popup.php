<?php
include 'php/conection.php';

$sql = "SELECT * FROM advertisement ORDER BY ad_id DESC LIMIT 1";
$result = $conn->query($sql);

$advertisement = null;
if ($result->num_rows > 0) {
    $advertisement = $result->fetch_assoc();
}
?>

<?php if ($advertisement) : ?>
    <div class="overlay" id="overlay"></div>
    <div class="container-news" id="popup">
        <div class="heading-news">
            <h2>TIN TỨC MỚI</h2>
            <span class="close-btn" id="close-btn"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <a href="#" class="content-news">
            <img src="<?php echo 'admin/' . htmlspecialchars($advertisement['ad_path_img']); ?>" alt="<?php echo htmlspecialchars($advertisement['ad_name']); ?>">

            <div class="container-content">
                <h2><?php echo htmlspecialchars($advertisement['ad_name']); ?></h2>
                <p><?php echo htmlspecialchars($advertisement['ad_description']); ?></p>
            </div>
        </a>
    </div>
<?php else : ?>
    <p>Không có quảng cáo nào.</p>
<?php endif; ?>

<style>
    @keyframes slideInUp {
    from {
        transform: translate(-50%, 100%);
        opacity: 0;
    }

    to {
        transform: translate(-50%, -50%);
        opacity: 1;
    }
}

.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.container-news {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 500px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    z-index: 1000;
    height: 580px;
    animation: slideInUp 0.5s ease-in-out;
}

.heading-news {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.heading-news h2 {
    font-size: 24px;
    color: #333;
}

.close-btn {
    cursor: pointer;
    font-size: 18px;
    color: #999;
}

.close-btn:hover {
    color: #555;
}

.content-news {
    display: block;
    text-decoration: none;
}

.content-news img {
    width: 100%;
    height: 500px;
    border-radius: 8px;
    margin-bottom: 10px;
}

.container-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #999;
    width: 100%;
    padding: 10px 20px;
}

.container-content h2 {
    font-size: 20px;
    color: #fff;
    margin-bottom: 5px;
}

.container-content p {
    font-size: 16px;
    color: #fff;
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var popup = document.getElementById('popup');
    var overlay = document.getElementById('overlay');
    var closeBtn = document.getElementById('close-btn');

    closeBtn.onclick = function() {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }

    setTimeout(function() {
        popup.style.display = 'block';
        overlay.style.display = 'block';
    }, 5000);

    overlay.onclick = function() {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }
});

</script>