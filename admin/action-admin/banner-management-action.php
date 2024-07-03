<?php
include("../connectDB.php");

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// thêm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_banner'])) {
    $banner_title = $_POST['banner_title'];
    $banner_description = $_POST['banner_des']; // Chỉnh sửa thành 'banner_des'

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $banner_date = date('Y-m-d H:i:s');

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["banner_img"]["name"]);

    if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file)) {
        $banner_img = $target_file;

        $sql = "INSERT INTO banners (banner_title, banner_date, banner_img, banner_description) VALUES ('$banner_title', '$banner_date', '$banner_img', '$banner_description')";

        if ($conn->query($sql) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Banner đã được thêm thành công!'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi thêm banner: ' . $conn->error
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Sorry, there was an error uploading your file.'
        ];
        echo json_encode($response);
    }
}


// Xử lý yêu cầu lấy thông tin banner để sửa
if (isset($_GET['get_banner'])) {
    $banner_id = $_GET['get_banner'];

    $sql_select = "SELECT banner_title, banner_description, banner_img FROM banners WHERE banner_id = $banner_id";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $banner_title = $row['banner_title'];
        $banner_description = $row['banner_description'];
        $banner_img = $row['banner_img'];

        $response = [
            'banner_title' => $banner_title,
            'banner_description' => $banner_description,
            'banner_img' => $banner_img
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Không tìm thấy banner để sửa.'
        ];
        echo json_encode($response);
    }
}


// Xử lý yêu cầu sửa banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_banner'])) {
    $banner_id = $_POST['banner_id'];
    $banner_title = $_POST['banner_title'];
    $banner_description = $_POST['banner_description']; // Thêm lấy mô tả

    if (!empty($_FILES['banner_img']['name'])) {
        // Xử lý hình ảnh nếu người dùng thay đổi
        $sql_select_old_img = "SELECT banner_img FROM banners WHERE banner_id = $banner_id";
        $result_select_old_img = $conn->query($sql_select_old_img);

        if ($result_select_old_img->num_rows > 0) {
            $row_old_img = $result_select_old_img->fetch_assoc();
            $old_img_path = $row_old_img['banner_img'];

            if (file_exists($old_img_path)) {
                unlink($old_img_path);
            }
        }

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["banner_img"]["name"]);

        if (move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file)) {
            $banner_img = $target_file;

            $sql_update = "UPDATE banners SET banner_title = '$banner_title', banner_description = '$banner_description', banner_img = '$banner_img' WHERE banner_id = $banner_id";

            if ($conn->query($sql_update) === TRUE) {
                $response = [
                    'status' => 'success',
                    'message' => 'Banner đã được sửa và lưu thành công!'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi khi cập nhật banner: ' . $conn->error
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Sorry, there was an error uploading your file.'
            ];
            echo json_encode($response);
        }
    } else {
        $sql_update = "UPDATE banners SET banner_title = '$banner_title', banner_description = '$banner_description' WHERE banner_id = $banner_id";

        if ($conn->query($sql_update) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Banner đã được sửa và lưu thành công!'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi cập nhật banner: ' . $conn->error
            ];
            echo json_encode($response);
        }
    }
}



// Xử lý yêu cầu xoá banner
if (isset($_POST['delete_banner'])) {
    $banner_id = $_POST['banner_id'];

    $sql_select = "SELECT banner_img FROM banners WHERE banner_id = $banner_id";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $banner_img = $row['banner_img'];

        $sql_delete = "DELETE FROM banners WHERE banner_id = $banner_id";

        if ($conn->query($sql_delete) === TRUE) {
            if (file_exists($banner_img)) {
                unlink($banner_img);
            }

            $response = [
                'status' => 'success',
                'message' => 'Banner đã được xoá thành công!'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi xoá banner: ' . $conn->error
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Không tìm thấy banner để xoá.'
        ];
        echo json_encode($response);
    }
}


$conn->close();
?>
