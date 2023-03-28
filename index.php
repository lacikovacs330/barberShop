<?php
include "includes/nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />

    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="css/style.css">


    <style>
        html,
        body {
            position: relative;
            height: 95%;
        }

        body {
            background: #eeeeee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;


            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>
</head>

<body>

<div class="swiper mySwiper" style="background-color:#222227">
    <div class="swiper-wrapper">
        <div  class="swiper-slide"><img src="img/allef-vinicius-IvQeAVeJULw-unsplash.jpg"></div>
        <div class="swiper-slide"><img src="img/mostafa-meraji-9fs1HCHD6F4-unsplash.jpg"></div>
        <div class="swiper-slide"><img src="img/mostafa-meraji-9twmmS4aXlE-unsplash.jpg"></div>
    </div>
    <div class="swiper-button-next" style="color: white"></div>
    <div class="swiper-button-prev" style="color: white"></div>
</div>
<div class="introduction-text" id="introduction"><a><b>Bemutatkozás</b></a></div>
<div class="introduction-text-title"><a><b>BARBER-SHOP</b></a></div>
<div class="introduction">
    <div class="introduction-logo">
        <img src="img/pngwing.com%20(3).png"><br><br>
        <a>Ez az oldal, időpont lefoglásával foglalkozik tőbb fodrászatból!</a>
    </div>
    <div class="introduction-images">
        <img src="img/jason-leung-2seUdPQNy_I-unsplash.jpg">
        <img src="img/delfina-pan-wJoB8D3hnzc-unsplash.jpg">
        <img src="img/apothecary-87-Wg3J83R1YSQ-unsplash.jpg">
    </div>
</div>
<div class="services-text-title" id="services"><a><b>SZOLGÁLTATÁSAINK</b></a></div>
<div class="services23">
    <div class="services-haircut">
        <div class="services-haircut-img">
            <img src="img/pngwing.com.png"><br><br>
            <a><b>Hajvágás</b></a>
        </div>
        <div class="services-haircut-text">
            <a>Akármilyen haj stílust eltudunk késziteni!</a>
        </div>

    </div>

    <div class="services-trimming">
        <div class="services-haircut-img">
            <img src="img/borotva.png"><br><br>
            <a><b>Szakáll vágás</b></a>
        </div>
        <div class="services-haircut-text">
            <a>Akármilyen formát megtudunk szabni a szakálladnak!</a>
        </div>
    </div>

    <div class="services-shaving">
        <div class="services-haircut-img">
            <img src="img/shaver.png"><br><br>
            <a><b>Borotválkozás</b></a>
        </div>
        <div class="services-haircut-text">
            <a>A termékeinkel enyhe marad a bőröd!</a>
        </div>
    </div>
</div>
<div class="introduction-text-title" id="action" style="text-decoration: underline"><a><b>Akcióink</b></a></div>
<div class="center-image-2">
    <img src="img/pngwing.com%20(3).png"> <h5 style="color: #9E8A78; margin-top: 15px">Minden fodrászszalonhoz 20% AKCIÓNK van.</h5>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
</body>
</html>


<?php
include "includes/footer.php";
?>


