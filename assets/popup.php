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
    <a href="#" id="popup" class="popup">
        <div class="popup-content">
            <h2>TIN TỨC MỚI</h2>
            <span class="close-btn" id="close-btn"><i class="fa-solid fa-xmark"></i></span>
           
            <img src="<?php echo 'admin/' . htmlspecialchars($advertisement['ad_path_img']); ?>" alt="<?php echo htmlspecialchars($advertisement['ad_name']); ?>">
        
        
            <div class="container-content">
                <h2><?php echo htmlspecialchars($advertisement['ad_name']); ?></h2>
                <p><?php echo htmlspecialchars($advertisement['ad_description']); ?></p>
            </div>
        </div>
    </a>
<?php else : ?>
    <p>Không có quảng cáo nào.</p>
<?php endif; ?>

<style>
    .popup-content img {
        max-width: 100%;
        height: auto;
        margin-top: 20px;
    }

    .container-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        padding: 10px 20px;
    }




</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.getElementById('popup');

        var closeBtn = document.getElementById('close-btn');

        closeBtn.onclick = function() {
            popup.style.display = 'none';
        }

        setTimeout(function() {
            popup.style.display = 'block';
        }, 100);

        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        }
    });
</script>

<style>
    .popup {
        display: none;
        position: fixed;
        z-index: 100;
        top: 0;
        width: 100%;
        height: auto;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .popup-content {
        position: relative;
        background-color: #fff;
        margin: 10px auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        animation: slideInUp 0.5s ease-out;
    }

    /* Animation keyframes */
    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .close-btn {
        position: absolute;
        color: #fff;
        top: 0;
        right: 0;
        background-color: #000;
        padding: 10px 15px;
        font-size: 20px;
        font-weight: bold;
        transition: all ease-in-out 0.3s;
        border: 1px solid #000;
        border-top-right-radius: 5px;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: gray;
        text-decoration: none;
        cursor: pointer;
    }
</style>