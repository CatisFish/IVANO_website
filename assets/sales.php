<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <section class="sales-container">
        <ul class="list-sales">
            <li class="sale-item">
                <a href="">
                    <img src="images/sales.png" alt="img" class="img-sale">
                    <p class="content-sale">Voucher Giảm Giá Cho Đại Lý Mới</p>
                </a>
            </li>

            <li class="sale-item">
                <a href="">
                    <img src="images/sales.png" alt="img" class="img-sale">
                    <p class="content-sale">Ưu Đãi</p>
                </a>
            </li>

            <li class="sale-item">
                <a href="">
                    <img src="images/sales.png" alt="img" class="img-sale">
                    <p class="content-sale">Voucher Giảm Đến 1 Triệu</p>
                </a>
            </li>

            <li class="sale-item">
                <a href="">
                    <img src="images/sales.png" alt="img" class="img-sale">
                    <p class="content-sale">Voucher Giảm Đến 1 Triệu</p>
                </a>
            </li>
            <li class="sale-item">
                <a href="">
                    <img src="images/sales.png" alt="img" class="img-sale">
                    <p class="content-sale">Voucher Giảm Đến 1 Triệu</p>
                </a>
            </li>   
        </ul>
    </section>
</body>

<style>
    .sales-container{
        width: 90%;
        margin: 20px auto;
        box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.1);
    }
    .list-sales {
        display: flex;
        justify-content: space-around;
        background-color: #fff;
        width: 1200px;
        margin: 10px auto 0;
        min-height: 108px;
    }

    .sale-item{
        text-align: center;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .img-sale {
        width: 50px;
        height: 50px;
        background-size: contain;
        background-repeat: no-repeat;
        margin-bottom: 10px; 
    }

    .sale-item:hover .img-sale{
        transform: translateY(-10px);
        transition: all ease-in-out 0.3s;
    }

    .content-sale {
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        font-size: .8125rem;
        line-height: .875rem;
        max-width: 150px;
        margin-bottom: 8px;
        word-wrap: break-word;
        overflow: hidden;
        white-space: pre-line;
        text-align: center;
        font-weight: 600;
    }

    .sale-item:hover .content-sale{
        color: #fb9c0d;
    }

</style>

</html>