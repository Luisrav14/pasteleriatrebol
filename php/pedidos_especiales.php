<?php

session_start();
if (!isset($_SESSION['user'])) {
} else {
    $us = $_SESSION['user'];
    $ps = $_SESSION['pass'];
    $priv = $_SESSION['priv'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Especiales | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Poppins:ital,wght@0,200;0,300;0,600;0,800;1,600&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
</head>

<body>
    <div class="arribabtn">
        <a id="button" class="icon-chevron-up"></a>
    </div>
    <!-- Facebook Messenger Script (Es necesario que vaya aquí) -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="221230121235233" theme_color="#0084ff" logged_in_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje." logged_out_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje.">
    </div>

    <div class="ctrls">
        <div id="WAButton"></div>
    </div>

    <?php

    require_once("../partials/header.php");

    ?>

    <div class="containerimg">
        <img src="../img/titlecover2.png" alt="" class="imgtitle">
        <div class="txtcenter">Pedidos Especiales</div>
    </div>

    <section class="section-iniciope">

        <div class="imgspd">
            <img class="materialboxed" id="imgpd" src="../img/galeria-img/gal1.jpg">
            <img class="materialboxed" id="imgpd" src="../img/galeria-img/gal21.jpg">
            <img class="materialboxed" id="imgpd" src="../img/pd3.jpg">
        </div>

        <p class="text">¡Bienvenido(a) a nuestra sección de pedidos especiales!, en esta parte nos puedes solicitar un pedido especial
            de nuestros productos, solo describenos la idea que tienes y nos pondremos en contacto contigo para llevar
            a cabo tu idea.
        </p>

        <?php
        if (isset($_SESSION["user"])) {
            echo " <div class='contenedor-boton'>
            <a class='waves-effect waves-light btn-large' id='btnpe' href='form-pedido'><i class='material-icons left'>description</i>Cotizar pedido</a>
            </div>";
        }

        if (!isset($_SESSION["user"])) {
            echo " <div class='contenedor-boton'>
            <a class='waves-effect waves-light btn-large' id='btnpe' href='login'><i class='material-icons left'>description</i>Cotizar pedido</a>
            </div>";
        }
        ?>

    </section>

    <?php require_once("../partials/footerphp.php"); ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script>
        var btn = $('#button');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
    <script>
        $(function() {
            $('#WAButton').floatingWhatsApp({
                phone: '5216181444494', //Número de telefono (Con prefijo 521 para México)
                headerTitle: '¡Envíanos un mensaje!', //Título de la ventana
                popupMessage: 'Hola, ¿cómo podemos ayudarte?', //Mensaje de la ventana
                showPopup: true, //Permite que esté visible el botón flotante
                buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" class="imgpop" />', //Button Image
                position: "right"
            });
        });
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');
        var modal2 = document.getElementById('myModal2');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        var img2 = document.getElementById('myImg2');
        var modalImg2 = document.getElementById("img02");
        var captionText2 = document.getElementById("caption2");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        img2.onclick = function() {
            modal2.style.display = "block";
            modalImg2.src = this.src;
            captionText2.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var span2 = document.getElementsByClassName("close2")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        span2.onclick = function() {
            modal2.style.display = "none";
        }


        // Get the modal
        var modal3 = document.getElementById('myModal3');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img3 = document.getElementById('myImg3');
        var modalImg3 = document.getElementById("img03");
        var captionText3 = document.getElementById("caption3");
        img3.onclick = function() {
            modal3.style.display = "block";
            modalImg3.src = this.src;
            captionText3.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span3 = document.getElementsByClassName("close3")[0];

        // When the user clicks on <span> (x), close the modal
        span3.onclick = function() {
            modal3.style.display = "none";
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });
    </script>
</body>