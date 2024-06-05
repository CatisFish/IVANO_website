<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .submit-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form class="daily-form" id="daily-form">
        <h2>Phiếu Đăng Ký</h2>
        <div class="form-group">
            <input type="text" id="name" name="daily-name" required placeholder=" ">
            <label for="name">Họ tên</label>
        </div>
        <div class="form-group">
            <input type="text" id="address" name="daily-address" required placeholder=" ">
            <label for="address">Địa chỉ</label>
        </div>
        <div class="form-group">
            <input type="tel" id="phone" name="daily-tel" required placeholder=" ">
            <label for="phone">Số điện thoại</label>
        </div>
        <div class="form-group">
            <textarea id="content" name="daily-note" required placeholder=" "></textarea>
            <label for="content">Nội dung</label>
        </div>
        <button type="submit" class="submit-btn">Gửi</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('daily-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form mặc định

                // Thu thập dữ liệu từ form
                const formData = new FormData(form);

                // Gửi dữ liệu sử dụng Fetch API
                fetch('submit-daily.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Kiểm tra phản hồi từ máy chủ
                    if (data.success) {
                        // Hiển thị thông báo SweetAlert khi form được gửi thành công
                        Swal.fire({
                            title: "Thành Công!",
                            text: "Hãy đợi chúng tôi liên hệ với bạn qua thông tin trên!",
                            icon: "success",
                            allowOutsideClick: false // Ngăn chặn đóng cửa sổ khi nhấp vào bên ngoài
                        });
                    } else {
                        // Xử lý lỗi (nếu có)
                        Swal.fire({
                            title: "Lỗi!",
                            text: data.message,
                            icon: "error",
                            allowOutsideClick: false
                        });
                    }
                })
                .catch(error => {
                    // Xử lý lỗi nếu có vấn đề khi gửi yêu cầu
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Đã xảy ra lỗi khi gửi dữ liệu. Vui lòng thử lại.",
                        icon: "error",
                        allowOutsideClick: false
                    });
                });
            });
        });
    </script>
</body>
</html>
