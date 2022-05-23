<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location: login");
} else {
    $us = $_SESSION['user'];
    $ps = $_SESSION['pass'];
    $priv = $_SESSION['priv'];
    $id = $_SESSION['id'];
}

require_once("conexion.php");

$descripcion = $fecha = $foto = "";
$descripcion_err = $fecha_err = $foto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_descripcion = trim($_POST["desc"]);
    if (empty($input_descripcion)) {
        $descripcion_err = "Por favor, ingresa la descripción del pedido";
    } else {
        $descripcion = $input_descripcion;
    }

    $input_fecha = trim($_POST["fecha"]);
    if (empty($input_fecha)) {
        $fecha_err = "Por favor ingresa una dfecha";
    } else {
        $fecha = $input_fecha;
    }

    $input_foto = $_FILES['foto']['name'];
    $foto = $input_foto;

    $destino = '../img/pe/' . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $destino);


    if (empty($descripcion_err) && empty($fecha_err) && empty($foto_err)) {

        $sql = "INSERT INTO pedidos_especiales (usuario, descripcion, fecha, imagen, estado) VALUES ($id, ?, ?, ?, 'Enviado')";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sss", $param_descripcion, $param_fecha, $param_foto);

            $param_descripcion = $descripcion;
            $param_fecha = $fecha;
            $param_foto = $foto;


            if (mysqli_stmt_execute($stmt)) {

                header("location: user.php");
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Especial | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/catalogo.css">
    <link rel="stylesheet" href="../materialize/css/materialize.css">
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
        <div class="txtcenter">Completa los campos</div>
    </div>

    <a class="volver" href="pedidos_especiales"><i class="material-icons">keyboard_arrow_left</i></a>

    <div class="cont-form3">
    <div class="imagenlogo">
      <div class="containerimg">
        <img src="../img/peform.jpg" alt="" class="logologin">
        <div class="txtcenter3">HACEMOS REALIDAD TUS IDEAS</div>
      </div>
    </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

            <div class="input-field col s12">
                <i class="material-icons prefix">emoji_objects</i>
                <textarea id="textarea1" class="materialize-textarea" name="desc"></textarea>
                <label for="textarea1">Descríbenos tu idea</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">event</i>
                <input id="fecha" type="text" class="datepicker" name="fecha">
                <label for="fecha">¿Cual es la fecha de tu evento?</label>
            </div>
            <p class="txtpe">¿Tienes alguna imagen de referencia? ¡Añádela! (Opcional)</p>
            <div class="input-field col s12">
                <i class="material-icons prefix">wallpaper</i>
                <input id="fi" type="file" class="file" name="foto">
            </div>
            <div class="center-align">
        <input type="submit" name="enviar" value="ENVIAR PEDIDO" class="waves-effect waves-light btn" id="submit"></td>
        <input type="reset" name="borrar" value="BORRAR" class="waves-effect waves-light btn" id="submit"></td>
        </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../materialize/js/materialize.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            M.AutoInit();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker();
        });
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