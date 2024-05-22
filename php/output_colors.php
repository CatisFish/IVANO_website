<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị Màu và Mã Hex</title>
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            border: 1px solid #000;
            margin-right: 10px;
            margin-bottom: 10px; /* Add margin-bottom for better spacing */
            display: inline-block;
        }

        .color-container {
            max-height: 300px; /* Set max-height to enable vertical scrolling */
            overflow: auto; /* Enable both horizontal and vertical scrolling */
        }

        #selected-color {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
include './conection.php';

$sql = "SELECT * FROM colors";
$result = $conn->query($sql);

echo "<div class='color-container'>"; // Container for all colors

$colors = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($colors, $row['color_hex']); // Store color hex codes in an array
    }

    // Shuffle the array to display random colors initially
    shuffle($colors);

    // Display all colors initially
    foreach ($colors as $color) {
        echo "<div class='color-box all-colors' style='background-color:" . $color . ";'>" . $color . "</div>";
    }
} else {
    echo "Không có dữ liệu.";
}

echo "</div>"; // Close color container

$conn->close();
?>

<div id='selected-color'></div>

<button onclick="selectAnotherColor()">Chọn lại màu</button>

<script>
    var colorBoxes = document.querySelectorAll('.color-box');
    var selectedColorContainer = document.getElementById("selected-color");

    // Check if there is a selected color stored in localStorage
    var selectedColorHex = localStorage.getItem('selectedColor');
    if (selectedColorHex) {
        var selectedColorBox = document.querySelector(".color-box.all-colors[style='background-color:" + selectedColorHex + ";']");
        if (selectedColorBox) {
            var selectedColor = selectedColorBox.cloneNode(true);
            selectedColorContainer.appendChild(selectedColor);
            selectedColorBox.style.display = "block";
        }
    }

    function selectAnotherColor() {
        selectedColorContainer.innerHTML = ""; // Clear selected color

        // Show all color boxes
        colorBoxes.forEach(function(box) {
            box.style.display = "inline-block"; // Display color boxes inline
        });

        // Remove selected color from localStorage
        localStorage.removeItem('selectedColor');
    }

    colorBoxes.forEach(function(box) {
        box.addEventListener('click', function() {
            var selectedColor = this.cloneNode(true);
            selectedColorContainer.innerHTML = ""; // Clear previous selection
            selectedColorContainer.appendChild(selectedColor);

            // Hide all color boxes except the one clicked
            colorBoxes.forEach(function(box) {
                box.style.display = "none";
            });

            // Show only the clicked color
            this.style.display = "inline-block"; // Display the selected color inline

            // Store selected color in localStorage
            localStorage.setItem('selectedColor', this.style.backgroundColor);
        });
    });

    colorBoxes.forEach(function(box) {
    box.addEventListener('click', function() {
        console.log("Clicked!"); // Debug: Check if the click event is fired
        var selectedColor = this.cloneNode(true);
        selectedColorContainer.innerHTML = ""; // Clear previous selection
        selectedColorContainer.appendChild(selectedColor);

        // Hide all color boxes except the one clicked
        colorBoxes.forEach(function(box) {
            box.style.display = "none";
        });

        // Show only the clicked color
        this.style.display = "inline-block"; // Display the selected color inline

        // Store selected color in localStorage
        localStorage.setItem('selectedColor', this.style.backgroundColor);
    });
});

</script>

</body>
</html>
