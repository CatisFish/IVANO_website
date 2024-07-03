<?php
include("../connectDB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_id = $_POST['product-id'];
    $product_name = $_POST['product-name'];
    $product_description = $_POST['product-des'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $productcategory_id = $_POST['productcategory_id'];
    $size_id = $_POST['size_id'];
    $price = $_POST['product-price'];

    $sql_product = "INSERT INTO products (product_id, product_name, product_description, category_id, brand_id, ProductCategory_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("ssssss", $product_id, $product_name, $product_description, $category_id, $brand_id, $productcategory_id);

    if ($stmt_product->execute()) {
        $new_id_sanpham = $conn->insert_id;

        if (!empty($_FILES['product_images']['name'][0])) {
            $product_images = $_FILES['product_images'];
            foreach ($product_images['tmp_name'] as $key => $tmp_name) {
                $image_name = $product_images['name'][$key];
                $image_tmp_name = $product_images['tmp_name'][$key];
                $upload_directory = "../uploads/";
                $target_file = $upload_directory . basename($image_name);

                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    $sql_image = "INSERT INTO product_images (id_sanpham, product_id, path_image) VALUES (?, ?, ?)";
                    $stmt_image = $conn->prepare($sql_image);
                    $stmt_image->bind_param("sss", $new_id_sanpham, $product_id, $target_file);

                    if ($stmt_image->execute()) {
                        $new_product_image_id = $conn->insert_id;

                        $sql_product_size = "INSERT INTO product_size (id_sanpham, product_id, size_id, price, product_image_id) VALUES (?, ?, ?, ?, ?)";
                        $stmt_product_size = $conn->prepare($sql_product_size);
                        $stmt_product_size->bind_param("sssss", $new_id_sanpham, $product_id, $size_id, $price, $new_product_image_id);

                        if ($stmt_product_size->execute()) {
                            echo "Thêm sản phẩm thành công!";
                            header("Location: \IVANO_website\admin\productsAD.php");
                            exit();
                        } else {
                            echo "Lỗi khi thêm giá và kích thước sản phẩm: " . $stmt_product_size->error;
                           
                        }
                    } else {
                        echo "Lỗi khi thêm ảnh sản phẩm: " . $stmt_image->error;
                        
                    }
                } else {
                    echo "Lỗi khi di chuyển ảnh vào thư mục";
                   
                }
            }
        } else {
            echo "Vui lòng chọn ít nhất một ảnh cho sản phẩm!";
           
            
        }
    } else {
        echo "Lỗi khi thêm mới sản phẩm: " . $stmt_product->error;
        header("Location: \IVANO_website\admin\productsAD.php");
        exit();
    }

    $stmt_product->close();

    $conn->close();
}
?>
