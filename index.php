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
    <title>Pastelería Trébol | Inicio</title>
    <link rel="icon" href="img/trebol-icon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
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
    <script>

    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="221230121235233" theme_color="#0084ff" logged_in_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje." logged_out_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje.">
    </div>

    <div class="ctrls">
        <div id="WAButton"></div>
    </div>

    <?php


    ?>
    <ul id="prd" class="dropdown-content">
        <li><a href="php/productos"><i class='material-icons'>menu_book</i>Productos</a></li>
        <li class="divider"></li>
        <li><a href="php/pedidos_especiales"><i class='material-icons'>cake</i>Pedidos especiales</a></li>
        <li class="divider"></li>
        <li><a href="php/galeria"><i class='material-icons'>collections</i>Galería</a></li>
    </ul>

    <ul id="ctc" class="dropdown-content">
        <li><a href="php/cont-suc-dys#redes-sociales"><i class='material-icons'>perm_device_information</i>Redes Sociales</a></li>
        <li class="divider"></li>
        <li><a href="php/cont-suc-dys#sucursales"><i class='material-icons'>store</i>Sucursales</a></li>
        <li class="divider"></li>
        <li><a href="php/cont-suc-dys#dys"><i class='material-icons'>comment</i>Dudas y Sugerencias</a></li>
    </ul>

    <?php

    if (isset($_SESSION['user'])) {
        echo "<ul id='usr' class='dropdown-content'>";
        echo "<li><a href='php/user'><i class='material-icons'>account_box</i>Usuario</a></li>";
        echo "<li class='divider'></li>";
        echo "<li><a href='php/logout'><i class='material-icons'>logout</i>Cerrar Sesión</a></li>";
        echo "<li class='divider'></li>";
        echo "</ul>";
    } else {
        echo "<ul id='usr' class='dropdown-content'>";
        echo "<li><a href='php/login'><i class='material-icons'>login</i>Inicia Sesión</a></li>";
        echo "<li class='divider'></li>";
        echo "<li><a href='php/signup'><i class='material-icons'>face</i>Registrarse</a></li>";
        echo "</ul>";
    }

    ?>

    <nav class="navinicio">
        <div class="nav-wrapper">
            <a href="index.php">
                <img src="img/trebol-icon-white.png" class="imgheader">
                <a href="index.php" class="brand-logo">Pastelería Trébol</a>
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<li class='bienvhead'>Bienvenido(a), " . $us . "</li>'";
                }
                ?>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="prd">Catálogo</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="ctc">Contacto</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="usr"><i class="material-icons">account_circle</i></a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <div class="titleside">
            <h2 class="titleside">Menú</h2>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
            echo "<li class='txtside' id='benv' href='index'>Bienvenido, $us </li>";
        }
        ?>
        <h2 class="subside">Secciones</h2>
        <li><a class="txtside" href="index"><i class="material-icons">home</i>Inicio</a></li>
        <li><a class="txtside" href="#nosotros"><i class="material-icons">supervisor_account</i>Nosotros</a></li>
        <div class="divider"></div>
        <h2 class="subside2">Catálogo</h2>
        <li><a class="txtside" href="php/productos"><i class='material-icons'>menu_book</i>Productos</a></li>
        <li><a class="txtside" href="php/pedidos_especiales"><i class='material-icons'>cake</i>Pedidos especiales</a></li>
        <li><a class="txtside" href="php/galeria"><i class='material-icons'>collections</i>Galería</a></li>
        <div class="divider"></div>
        <h2 class="subside2">Contacto</h2>
        <li><a class="txtside" href="php/cont-suc-dys#redes-sociales"><i class='material-icons'>perm_device_information</i>Redes Sociales</a></li>
        <li><a class="txtside" href="php/cont-suc-dys#sucursales"><i class='material-icons'>store</i>Sucursales</a></li>
        <li><a class="txtside" href="php/cont-suc-dys#dys"><i class='material-icons'>comment</i>Dudas y Sugerencias</a></li>
        <div class="divider"></div>
        <h2 class="subside">Usuario</h2>
        <?php
        if (!isset($_SESSION['user'])) {
            echo "<li><a class='txtside' href='php/login.php' title=''><i class='material-icons'>login</i>Inicia Sesión</a></li>";
            echo "<li><a class='txtside' href='php/signup.php' title=''><i class='material-icons'>face</i>Regístrate</a></li>";
        } else {
            echo "<li><a class='txtside' href='php/user.php' title=''><i class='material-icons'>account_circle</i>Usuario</a></li>";
            echo "<li><a class='txtside' href='php/logout.php' title=''><i class='material-icons'>login</i>Cerrar Sesión</a></li>";
        }
        ?>
    </ul>

    <section class="iniciosec">

        <div class="centro">

        </div>
        <div class="txtuno">
            <h1>Celebrando juntos</h1>
        </div>
        <div class="txtdos">
            <h1>Durante más de 35 años</h1>
        </div>
        <?php 

        require_once "php/conexion.php";

        $sql = "SELECT * FROM video";

        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
            echo "<div class='txttres'>";
            while ($row = mysqli_fetch_array($result)) {

                echo "<video id='video' class='videoinicio' controls autoplay controlslist='nodownload' autoplay loop muted playsinline>";
                echo "<source src='video/". $row['video'] . "' type='video/mp4'>";
                echo "</video>";

            }

            echo "</div>";
            }
        }   

        ?>

    </section>

    <div class="carousel carousel-slider">
        <a class="carousel-item" id="carimg" href="tel:+5216188119055"></a>
        <a class="carousel-item" id="carimg2" href="#two!"></a>
        <a class="carousel-item" id="carimg3" href="php/cont-suc-dys#sucursales"></a>
    </div>

    <section class="prev">
        <div class="cont-prev">
            <div class="cont-previmgs">
                <img src="img/prev1.png" alt="" class="imgprev">
                <img src="img/prev2.png" alt="" class="imgprev">
                <img src="img/prev3.png" alt="" class="imgprev">
            </div>
            <h2>¡Conoce nuestros productos!</h2>
            <div class="cont-link">
                <a class="waves-effect waves-light btn" id="ir" href="php/productos"><i class="material-icons left">menu_book</i>IR AL CATÁLOGO</a>
            </div>
        </div>
    </section>

    <div class="parallax-container" id="nosotros">
        <div class="parallax"><img src="img/mis.png" data-max-width-481="misresp.png" alt=""></div>
        <h1 class="titmv" id="">Misión</h1>
        <p class="txtmv">Ofrecer productos de pastelería y repostería de la más alta calidad,
            hechos de manera tradicional sin conservadores, con un excelente sabor y a un precio accesible. Hemos permanecido por <b>35 años</b>
            en el mercado duranguense utilizando las mejores materias primas del mercado para satisfacer a nuestros clientes.</p>
    </div>
    <div class="section white" id="">
        <div class="row container">
            <img src="img/trebol-icon-white.png" alt="" class="imgtr">
            <h2 class="header" id="">Nosotros</h2>
        </div>
    </div>
    <div class="parallax-container">
        <div class="parallax"><img src="img/vis.png"></div>
        <h1 class="titmv2">Visión</h1>
        <p class="txtmv2"> Nuestra visión consiste en aumentar nuestra capacidad de producción y distribución sin
            sacrificar la calidad de nuestros productos y de esta manera seguir siendo una empresa familiar, como lo ha sido por décadas
            <b>#ConsumeLocal</b>.
    </div>
    </div>

    <?php

    require_once("partials/footer.php");

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/app.js"></script>
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
        $(document).ready(function() {

            $(window).scroll(function() {

                if ($(window).scrollTop() > 1) {
                    $('nav').addClass('navgreen');
                } else {
                    $('nav').removeClass('navgreen');
                }

            });

        });

        $(document).ready(function() {
            $('.parallax').parallax();
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
</body>

</html>