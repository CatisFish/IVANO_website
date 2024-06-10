<?php
include "php/conection.php";

$sql_mekong = "SELECT COUNT(DISTINCT product_id) AS quantity_mekong FROM products WHERE brand_id = (SELECT brand_id FROM brands WHERE brand_name = 'MEKONG')";

$result_mekong = $conn->query($sql_mekong);
if ($result_mekong === false) {
    die("Error executing query: " . $conn->error);
}
$row_mekong = $result_mekong->fetch_assoc();
$quantity_mekong = $row_mekong["quantity_mekong"];

$sql_ivano = "SELECT COUNT(DISTINCT product_id) AS quantity_ivano 
              FROM products 
              WHERE brand_id = (SELECT brand_id FROM brands WHERE brand_name = 'IVANO')";

$result_ivano = $conn->query($sql_ivano);
if ($result_ivano === false) {
    die("Error executing query: " . $conn->error);
}
$row_ivano = $result_ivano->fetch_assoc();
$quantity_ivano = $row_ivano["quantity_ivano"];

$conn->close();
?>

<div class="category-item-container">
    <a class="category-item" href="all-item.php">
        <img src="images/MK9.3-18-681x800.png" alt="img" class="category-item-img">

        <div class="container-heading">
            <p class="show-brand-name">SƠN MEKONG</p>
            <span class="quantity-item"><?php echo $quantity_mekong; ?> SẢN PHẨM</span>
        </div>
    </a>

    <a class="category-item" href="all-item.php">
        <img src="images/I9.28-18-681x800.png" alt="img" class="category-item-img">

        <div class="container-heading">
            <p class="show-brand-name">SƠN IVANO</p>
            <span class="quantity-item"><?php echo $quantity_ivano; ?> SẢN PHẨM</span>
        </div>
    </a>
</div>

<style>
    .container-show-list-category {
        width: 80%;
        margin: 50px auto;
        position: relative;
    }

    .container-show-list-category h1 {
        text-align: center;
        font-size: 30px;
        position: relative;
        z-index: 1;
        color: #FC0000;
        text-transform: uppercase;
    }

    .container-show-list-category h1::before,
    .container-show-list-category h1::after {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 1px;
        /* background-color: rgba(252, 185, 0, 1); */
        width: 33%;
        background-color: #FC0000;
    }

    .container-show-list-category h1::before {
        left: 0;
    }

    .container-show-list-category h1::after {
        right: 0;
    }

    .container-show-list-category {
        text-align: center;
    }

    .category-item-container {
        margin-top: 40px;
    }

    .category-item {
        position: relative;
        display: inline-block;
        margin: 0 20px;
        vertical-align: top;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .category-item-img {
        width: 280px;
        height: 320px;
    }

    .container-heading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.8);
        padding: 10px;
        width: 100%;
        text-align: center;
        color: #DD9963;
        transition: all ease-in-out 0.3s;
    }

    .show-brand-name {
        font-size: 20px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .quantity-item {
        font-size: 14px;
    }

    .category-item:hover .container-heading {
        color: #fff;
        background-color: #FF8000;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
    .container-show-list-category {
        width: 95%;
        margin: 30px auto;
        position: relative;
    }

    .container-show-list-category h1 {
        text-align: center;
        font-size: 22px;
        position: relative;
        z-index: 1;
        color: #FC0000;
        text-transform: uppercase;
    }

    .container-show-list-category h1::before,
    .container-show-list-category h1::after {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 1px;
        width: 23%;
        background-color: #FC0000;
    }

    .container-show-list-category h1::before {
        left: 0;
    }

    .container-show-list-category h1::after {
        right: 0;
    }

    .category-item-container {
        display: flex;
        margin-top: 10px;
        gap: 10px;
    }

    .category-item {
        width: 50%;
        position: relative;
        transition: all ease-in-out 0.3s;
    }

    .category-item-img {
        width: 100%;
        height: auto;
    }

    .container-heading {
        position: absolute;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 128, 0, 0.8);
        padding: 10px;
        width: 100%;
        text-align: center;
        color: #fff;
        transition: all ease-in-out 0.3s;
    }

    .show-brand-name {
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .quantity-item {
        font-size: 12px;
    }
}
</style>