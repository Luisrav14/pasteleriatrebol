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

$comprobar = FALSE;

require_once "conexion.php";

$pwd = "";
$pwd_err = "";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    $id =  trim($_GET["id"]);


    $sql = "SELECT AES_DECRYPT(UNHEX(password), 'pwd') AS password FROM usuarios_pass WHERE ID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);


        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $pwd_anterior = $row["password"];
            } else {

                exit();
            }
        } else {
        }
    }
} else {

    exit();
}


if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $pwdant = $pwd_anterior;

    $input_pwd = trim($_POST["pwd"]);
    $pwd = $input_pwd;

    $input_pwd = trim($_POST["pwd"]);
    if (empty($input_password)) {
        $pwd_err = "";
    } else {
        $pwd = $input_pwd;
    }

    if ($_POST["pass_anterior"] == $pwdant) {
        if ($_POST["pwd"] == $_POST["pwd2"]) {
            if (empty($pwd_err)) {


                $sql = "UPDATE usuarios_pass SET password=HEX(AES_ENCRYPT(?, 'pwd')) WHERE ID=?";

                if ($stmt = mysqli_prepare($conn, $sql)) {

                    mysqli_stmt_bind_param($stmt, "si", $param_pwd, $param_id);

                    $param_pwd = $pwd;
                    $param_id = $id;

                    if (mysqli_stmt_execute($stmt)) {

                        $comprobar = FALSE;
                    } else {
                    }
                }
            } else {
                $comprobar = TRUE;
            }
        } else {
            $comprobar = TRUE;
        }


        mysqli_stmt_close($stmt);
    } else {
        $comprobar = TRUE;
    }


    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña | Pastelería Trébol</title>
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
        <img src="../img/titlecover.png" alt="" class="imgtitle">
        <div class="txtcenter">Cambiar contraseña</div>
    </div>

    <a class="volver" href="user"><i class="material-icons">keyboard_arrow_left</i></a>

    <div class="cont-form3">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

            <div class="input-field col s6">
                <i class="material-icons prefix">dialpad</i>
                <input id="passw" name="pass_anterior" type="password" class="" value="" required>
                <label for="passw">Contraseña anterior</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">lock_open</i>
                <input id="passw2" name="pwd" type="password" class="" value="" required>
                <label for="passw2">Contraseña nueva</label>
            </div>

            <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <input id="passw3" name="pwd2" type="password" class="" value="" required>
                <label for="passw3">Confirmar contraseña</label>
            </div>

            <div class="mostrarocultar">
                <label>
                    <input type="checkbox" class="filled-in" onclick="contraseña()">
                    <span class="mo">Mostrar Contraseñas</span>
                </label>
            </div>

            <div class="center-align">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" name="enviar" value="ACTUALIZAR CONTRASEÑA" class="waves-effect waves-light btn" id="btn1"></td>
            </div>
        </form>
    </div>

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
        function contraseña() {
            var x = document.getElementById("passw");
            var x2 = document.getElementById("passw2");
            var x3 = document.getElementById("passw3");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            if (x2.type === "password") {
                x2.type = "text";
            } else {
                x2.type = "password";
            }
            if (x3.type === "password") {
                x3.type = "text";
            } else {
                x3.type = "password";
            }
        }
    </script>
</body>

</html>
<?php

if (isset($_POST['enviar'])) {
    if ($comprobar == TRUE) {
?>
        <script>
            function actualizar() {
                swal({
                        title: "Oops! Algo salió mal",
                        text: "Los datos son incorrectos, intentalo de nuevo",
                        icon: "error",
                        dangerMode: true,
                    })
                    .then(function() {

                    });
            }
            actualizar();
        </script>
    <?php
    } elseif ($comprobar == FALSE) {
    ?>
        <script>
            function actualizar() {
                swal({
                        title: "Contraseña actualizada correctamente",
                        text: "Da clic en continuar",
                        icon: "info",
                        buttons: {
                            confirm: {
                                text: "Continuar"
                            }
                        },
                    })
                    .then((actualizar) => {
                        if (actualizar) {
                            swal("Contraseña actualizada exitosamente", {
                                icon: "success",
                            }).then(function() {
                                window.location = "user.php";
                            });
                        } else {
                            swal("La contraseña no se ha actualizado");
                        }
                    });
            }
            actualizar();
        </script>
<?php

    }
}
?>