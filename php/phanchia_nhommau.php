<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhiều Màu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            width: 50%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            resize: vertical;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Thêm Nhiều Màu</h2>

    <!-- Form thêm nhiều màu -->
    <form action="save_color.php" method="post">
        <div class="form-group">
            <label for="multiple_colors">Nhiều mã màu (mỗi dòng chứa một cặp mã màu và mã hex, cách nhau bằng dấu hai chấm):</label>
            <textarea id="multiple_colors" name="multiple_colors" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Thêm Nhiều Màu" name="add_multiple_colors">
        </div>
    </form>
</div>

</body>
</html>
