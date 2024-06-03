<section class="sales-container">
    <ul class="list-sales">
        <li class="sale-item">
            <a href="">
                <img src="images/sales.png" alt="img" class="img-sale">
                <p class="content-sale">Voucher 1</p>
            </a>
        </li>

        <li class="sale-item">
            <a href="">
                <img src="images/sales.png" alt="img" class="img-sale">
                <p class="content-sale">Voucher 2</p>
            </a>
        </li>

        <li class="sale-item">
            <a href="">
                <img src="images/sales.png" alt="img" class="img-sale">
                <p class="content-sale">Voucher 3</p>
            </a>
        </li>

        <li class="sale-item">
            <a href="">
                <img src="images/sales.png" alt="img" class="img-sale">
                <p class="content-sale">Voucher 4</p>
            </a>
        </li>
        <li class="sale-item">
            <a href="">
                <img src="images/sales.png" alt="img" class="img-sale">
                <p class="content-sale">Voucher 5</p>
            </a>
        </li>
    </ul>

    <div class="radio-buttons-sales">
        <input type="radio" id="side-sales1" name="side-sales" checked>
        <label for="side-sales1"></label>
        <input type="radio" id="side-sales2" name="side-sales">
        <label for="side-sales2"></label>
        <input type="radio" id="side-sales3" name="side-sales">
        <label for="side-sales3"></label>
        <input type="radio" id="side-sales4" name="side-sales">
        <label for="side-sales4"></label>
        <input type="radio" id="side-sales5" name="side-sales">
        <label for="side-sales5"></label>
    </div>
</section>

<style>
    .radio-buttons-sales {
        display: none;
    }

    .sales-container {
        width: 90%;
        margin: 30px auto;
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

    .sale-item {
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

    .sale-item:hover .img-sale {
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

    .sale-item:hover .content-sale {
        color: #fb9c0d;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .radio-buttons-sales {
            display: block;
        }

        .sales-container {
            width: 95%;
            margin: 20px auto;
            box-shadow: none;
        }

        .list-sales {
            width: 100%;
            display: flex;
            gap: 10px;
            transition: transform 0.5s ease-in-out;
        }

        .sale-item {
            width: calc(20% - 10px);
            text-align: center;
        }

        .img-sale {
            width: 50px;
        }

        .content-sale {
            margin-top: 3px;
            font-size: 10px;
            font-weight: 500;
            display: -webkit-box;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .radio-buttons-sales {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .radio-buttons-sales input {
            display: none;
        }

        .radio-buttons-sales label {
            width: 5px;
            height: 5px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0px 5px 5px 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .radio-buttons-sales input:checked+label {
            background-color: #007bff;
            transform: scale(1.15);
            box-shadow: 0 0 0 2px #007bff, 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    }
</style>

<script>
    if (window.matchMedia("(max-width: 600px)").matches) {
        document.addEventListener('DOMContentLoaded', () => {
            const listSales = document.querySelector('.list-sales');
            const itemSales = document.querySelectorAll('.sale-item');
            const radios = document.querySelectorAll('.radio-buttons-sales input');
            const itemWidth = itemSales[0].offsetWidth + 10;
            const midIndex = Math.floor(radios.length / 2);

            let currentIndex = midIndex;

            function updateRadioButtons() {
                radios.forEach((radio, index) => {
                    radio.checked = index === currentIndex;
                });
            }

            function slideNext() {
                listSales.style.transition = "transform 0.5s ease-in-out";
                listSales.style.transform = `translateX(-${itemWidth}px)`;

                setTimeout(() => {
                    const firstItem = listSales.querySelector('.sale-item:first-child');
                    listSales.appendChild(firstItem);

                    listSales.style.transition = "none";
                    listSales.style.transform = "translateX(0)";

                    currentIndex = (currentIndex + 1) % itemSales.length;
                    updateRadioButtons();

                    itemSales.forEach(item => {
                        const contentSale = item.querySelector('.content-sale');
                        const isMiddleItem = item === itemSales[currentIndex];
                        contentSale.style.color = isMiddleItem ? "#fb9c0d" : "";
                        contentSale.style.fontWeight = isMiddleItem ? "700" : "normal";
                        item.style.transform = isMiddleItem ? "translateY(-5px)" : "";
                        item.style.transition = isMiddleItem ? "transform 0.5s ease-in-out" : "transform 0.3s ease-in-out";
                    });
                }, 450);
            }

            updateRadioButtons();
            setInterval(slideNext, 3000);
        });
    }

</script>