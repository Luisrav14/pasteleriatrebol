<?php

session_start();
if (!isset($_SESSION['user'])) {
} else {
    $us = $_SESSION['user'];
    $ps = $_SESSION['pass'];
    $priv = $_SESSION['priv'];
}

require_once "conexion.php";

$nombres = $apellidos = $telefono = $correo = $mensaje = "";
$nombres_err = $apellidos_err = $telefono_err = $correo_err = $mensaje_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombres = trim($_POST["nombres"]);
    if (empty($input_nombres)) {
        $nombres_err = "Ingresa tu nombre";
    } elseif (!filter_var($input_nombres, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombres_err = "Por favor, ingresa un nombre válido";
    } else {
        $nombres = $input_nombres;
    }

    $input_apellidos = trim($_POST["apellidos"]);
    if (empty($input_apellidos)) {
        $apellidos_err = "Ingresa tus apellidos";
    } elseif (!filter_var($input_apellidos, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $apellidos_err = "Por favor, ingresa un nombre válido";
    } else {
        $apellidos = $input_apellidos;
    }

    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono_err = "Por favor, ingresa tu número telefónico";
    } elseif (!ctype_digit($input_telefono)) {
        $telefono_err = "Por favor, ingresa un valor de número telefónico correcto y positivo.";
    } else {
        $telefono = $input_telefono;
    }

    $input_correo = trim($_POST["email"]);
    if (empty($input_correo)) {
        $correo_err = "Por favor, ingresa una dirección de correo electrónico.";
    } else {
        $correo = $input_correo;
    }

    $input_mensaje = trim($_POST["mensaje"]);
    if (empty($input_mensaje)) {
        $mensaje_err = "Por favor, ingresa tu duda y/o sugerencia";
    } else {
        $mensaje = $input_mensaje;
    }

    if (empty($nombres_err) && empty($apellidos_err) && empty($telefono_err) && empty($correo_err) && empty($mensaje_err)) {

        $sql = "INSERT INTO dudas_sugerencias (nombre, apellidos, teléfono, correo, descripcion) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssss", $param_nombres, $param_apellidos, $param_telefono, $param_correo, $param_mensaje);


            $param_nombres = $nombres;
            $param_apellidos = $apellidos;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_mensaje = $mensaje;


            if (mysqli_stmt_execute($stmt)) {

                header("location: cont-suc-dys.php");

                exit();
            } else {
                echo "Error";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contacto.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:wght@700&display=swap" rel="stylesheet">
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

    <?php require_once("../partials/header.php"); ?>

    <section class="section-redessociales" id="redes-sociales">
        <div class="containerimg">
            <img src="../img/titlecover2.png" alt="" class="imgtitle">
            <div class="txtcenter">Redes Sociales</div>
        </div>

        <div class="contact-info">

            <div class="card">
                <div class="card-image">
                    <img src="../img/fbtrebol.png">
                </div>
                <div class="card-actio">
                    <a class="fblink" href="https://www.facebook.com/pasteleriatrebol" target="_blank"><i class="icon-facebook-square"></i>¡Danos me gusta en Facebook!</a>
                </div>
            </div>


            <div class="card">
                <div class="card-image">
                    <img src="../img/igtrebol.png">
                </div>
                <div class="card-actio">
                    <a class="iglink" href="https://www.instagram.com/pasteleriatrebol/" target="_blank"><i class="icon-instagram"></i>¡Síguenos en Instagram!</a>
                </div>
            </div>


        </div>

    </section>

    <section class="section-sucursales" id="sucursales">
        <div class="containerimg">
            <img src="../img/titlecover2.png" alt="" class="imgtitle">
            <div class="txtcenter">Sucursales</div>
        </div>
        <div class="colcont">
            <button class="collapsible">Sucursal Sahop<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d58321.91306849106!2d-104.67349483277077!3d23.991554548915513!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bc7ff9cf24ac1%3A0x3e08d0276e9ee72b!2zVHLDqWJvbCBQYXN0ZWxlcsOtYQ!5e0!3m2!1ses-419!2smx!4v1598165244795!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal Sahop</h1>
                    <p class="txtsuc">Calle Escorpión No. 304 Fraccionamiento Sahop, Durango, Dgo.</p>
                    <p class="txtsuc">C.P. 34190<p>
                    <p class="txtsuc"><i class="material-icons">call</i>811-9055</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Trébol+Pastelería,+Escorpión+304,+Sahop,+34190+Durango,+Dgo./@23.999126,-104.659606,12z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bc7ff9cf24ac1:0x3e08d0276e9ee72b!2m2!1d-104.659606!2d23.999126!3e0?hl=es-419" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216188293031"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
            <button class="collapsible">Sucursal 5 de Febrero<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29152.31441248207!2d-104.68798720638667!3d24.029679202889653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb7dbaf45e71b%3A0xe35a4b30dc351b6f!2sPasteler%C3%ADa%20Trebol!5e0!3m2!1ses-419!2smx!4v1598165097228!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal 5 de Febrero</h1>
                    <p class="txtsuc">Calle 5 de Febrero No. 1011 Guillermina, Durango, Dgo.</p>
                    <p class="txtsuc">C.P. 34270<p>
                    <p class="txtsuc"><i class="material-icons">call</i>829-3031</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Pastelería+Trebol,+Calle+5+de+Febrero+1011,+Guillermina,+34270+Durango,+Dgo./@24.026522,-104.650515,13z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bb7dbaf45e71b:0xe35a4b30dc351b6f!2m2!1d-104.6505153!2d24.0265216!3e0?hl=es-419" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216188293031"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
            <button class="collapsible">Sucursal Benito Juárez<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29152.331744448496!2d-104.68790136044922!3d24.029602799999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bc82354c7f4d1%3A0x7afd2f3e59276969!2zUGFzdGVsZXLDrWEgVHLDqWJvbA!5e0!3m2!1ses-419!2smx!4v1598164863458!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal Benito Juárez</h1>
                    <p class="txtsuc">Calle Lic. Benito Juárez No. 234 Zona Centro, Durango, Dgo.</p>
                    <p class="txtsuc">C.P. 34000<p>
                    <p class="txtsuc"><i class="material-icons">call</i>811-5044</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Pastelería+Trébol,+Calle+Lic.+Benito+Juárez+234,+Zona+Centro,+34000+Durango,+Dgo./@24.029603,-104.670392,13z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bc82354c7f4d1:0x7afd2f3e59276969!2m2!1d-104.6703919!2d24.0296028!3e0?hl=es-419" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216188115044"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
            <button class="collapsible">Sucursal San Fernanda<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.667826038145!2d-104.68174708501374!3d24.007504284463224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bc94e910f8f93%3A0xa50a046b664a9eec!2zUGFzdGVsZXLDrWEgVHLDqWJvbA!5e0!3m2!1ses-419!2smx!4v1598164656276!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal San Fernanda</h1>
                    <p class="txtsuc">Residencial San Fernanda, Francisco Villa esquina, Primo de Verdad Plaza, Durango, Dgo.</p>
                    <p class="txtsuc">C.P. 34138<p>
                    <p class="txtsuc"><i class="material-icons">call</i>835-0945</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Pastelería+Trébol,+Residencial+San+Fernanda,+Francisco+Villa+esquina,+Primo+de+Verdad+Plaza,+34138+Durango,+Dgo./@24.007504,-104.679558,16z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bc94e910f8f93:0xa50a046b664a9eec!2m2!1d-104.6795584!2d24.0075043!3e0?hl=es-419" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216188350945"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
            <button class="collapsible">Sucursal Guadalupe<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.6107635862304!2d-104.62686628501304!3d24.04478738444503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb70e280627b5%3A0x86adc6c92d39cfb5!2zUGFzdGVsZXLDrWEgVHLDqWJvbA!5e0!3m2!1ses-419!2smx!4v1598160971906!5m2!1ses-419!2=es-MX" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal Guadalupe</h1>
                    <p class="txtsuc">Calle México No. 116 Fraccionamiento Guadalupe, Durango Dgo.</p>
                    <p class="txtsuc">C.P. 34220<p>
                    <p class="txtsuc"><i class="material-icons">call</i>618-143-1423</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Pastelería+Trébol,+Calle+México+%23116,+Guadalupe,+34220+Durango,+Dgo./@24.0447874,-104.6268663,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bb70e280627b5:0x86adc6c92d39cfb5!2m2!1d-104.6246776!2d24.0447874!3e0?hl=es-MX" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216181431423"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
            <button class="collapsible">Sucursal El Edén<span class="icon-chevron-down"></span></button>
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d58321.91306849106!2d-104.67349483277077!3d23.991554548915513!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bc7ff9cf24ac1%3A0x3e08d0276e9ee72b!2zVHLDqWJvbCBQYXN0ZWxlcsOtYQ!5e0!3m2!1ses-419!2smx!4v1598164550058!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="infosuc">
                    <h1 class="titsuc">Sucursal El Edén</h1>
                    <p class="txtsuc">Avenida Cuitláhuac No. 452 Fraccionamiento El Edén, Durango Dgo.</p>
                    <p class="txtsuc">C.P. 34160<p>
                    <p class="txtsuc"><i class="material-icons">call</i>812-1316</p>
                            <div class="btnssuc">
                                <a class="waves-effect waves-light btn" href="https://www.google.com/maps/dir//Pastelería+Trébol,+Av.+Cuitláhuac+%23452,+El+Edén,+34160+Durango,+Dgo./@24.004277,-104.653442,20z/data=!4m9!4m8!1m0!1m5!1m1!1s0x869bb7d340562e17:0x64549bde0c464acc!2m2!1d-104.6534417!2d24.0042768!3e0?hl=es-MX" target="_blank"><i class="material-icons left">directions</i>¿Cómo llegar?</a>
                                <a class="waves-effect waves-light btn" href="tel:+5216188121316"><i class="material-icons left">local_phone</i>Llamar</a>
                            </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-dys" id="dys">
        <div class="containerimg">
            <img src="../img/titlecover2.png" alt="" class="imgtitle">
            <div class="txtcenter">Dudas y Sugerencias</div>
        </div>
        <section class="form_wrap">

            <section class="cantact_info">
                <section class="info_title">
                    <span class="fa fa-user-circle"></span>
                    <h2>TUS COMENTARIOS  SON IMPORTANTES PARA NOSOTROS</h2>
                </section>
            </section>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form_contact" method="post">
                <h2>Envia un mensaje</h2>
                <div class="user_info">
                    <label for="names">Nombre/s *</label>
                    <input type="text" id="names" name="nombres" value="<?php echo $nombres; ?>">
                    <span class="#"><?php echo $nombres_err; ?></span>

                    <label for="names">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>">
                    <span class="#"><?php echo $apellidos_err; ?></span>

                    <label for="phone">Teléfono / Celular *</label>
                    <input type="number" id="phone" name="telefono" value="<?php echo $telefono; ?>">
                    <span class="#"><?php echo $telefono_err; ?></span>

                    <label for="email">Correo electrónico *</label>
                    <input type="email" id="email" name="email" value="<?php echo $correo; ?>">
                    <span class="#"><?php echo $correo_err; ?></span>

                    <label for="mensaje">Mensaje *</label>
                    <textarea id="mensaje" name="mensaje" value="<?php echo $mensaje; ?>"></textarea>
                    <span class="#"><?php echo $mensaje_err; ?></span>

                    <input type="submit" value="Enviar Mensaje" class="waves-effect waves-light btn" id="" name="enviards" onclick="mensaje()">
                </div>
            </form>
        </section>

    </section>

    <?php require_once("../partials/footerphp.php"); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>
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
</body>

</html>