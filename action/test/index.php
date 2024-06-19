<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Classifier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Color Classifier</h1>
        <form method="post">
            <label for="hexColor">Enter HEX Color:</label>
            <input type="text" id="hexColor" name="hexColor" placeholder="#F0E8CA" required>
            <button type="submit">Classify Color</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hexColor = htmlspecialchars($_POST['hexColor']);
            echo "<div class='result'>";
            echo "<p>HEX Color: $hexColor</p>";
            echo "<p>Group: <span id='colorGroup'></span></p>";
            echo "<div class='color-box' style='background-color: $hexColor;'></div>";
            echo "</div>";
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.1.0/chroma.min.js"></script>
    <script src="colors.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($hexColor)): ?>
            let color = '<?php echo $hexColor; ?>';
            let group = getColorGroup(color);
            document.getElementById('colorGroup').innerText = group;
            <?php endif; ?>
        });
    </script>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

input[type="text"] {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-right: 10px;
}

button {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    background-color: #007BFF;
    color: white;
    cursor: pointer;
}

.result {
    margin-top: 20px;
}

.color-box {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 4px;
}

</style>