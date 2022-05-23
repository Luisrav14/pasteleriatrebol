<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location: ../index");
    }

require_once('conexion.php');
require_once('environment.php');

$name = $apes = $telefono = $password = $mail = $genero = $priv = "";
$name_err = $apes_err = $telefono_err = $password_err = $mail_err = $genero_err = $priv_err = "";


if (isset($_POST['enviar'])) {

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Ingresa tu nombre";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.{4,40}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ-áÁ-éÉ-íÍ-óÓ-úÚ])*$/")))) {
        $name_err = "El nombre ingresado no es válido";
    } else {
        $name = $input_name;
    }

    $input_apes = trim($_POST["apes"]);
    if (empty($input_apes)) {
        $apes_err = "Ingresa tus apellidos";
    } elseif (!filter_var($input_apes, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.{4,40}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ-áÁ-éÉ-íÍ-óÓ-úÚ])*$/")))) {
        $apes_err = "Los apellidos ingresados no son válidos";
    } else {
        $apes = $input_apes;
    }

    $input_telefono = trim($_POST["phone"]);
    if (empty($input_telefono)) {
        $telefono_err = "Por favor, ingresa tu número de teléfono";
    } elseif (!filter_var($input_telefono, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/(52)?[ -]*[ -]*([0-9][ -]*){10}/")))) {
        $telefono_err = "Por favor, ingresa un valor de número telefónico correcto y positivo. (Ej. 6181234567)";
    } else {
        $telefono = $input_telefono;
    }

    $input_mail = trim($_POST["mail"]);
    if (empty($input_mail)) {
        $mail_err = "Por favor, ingresa una dirección de correo electrónico.";
    } elseif (!filter_var($input_mail, FILTER_VALIDATE_EMAIL)) {
        $mail_err = "El correo electrónico no tiene la complexión indicada (Ej. ejemplo@ejemplo.com)";
    } else {
        $mail = $input_mail;
    }

    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Ingresa una contraseña";
    } else {
        $password = $input_password;
    }

    $input_genero = trim($_POST["genero"]);
    if ($input_genero == "default") {
        $genero_err = "Ingresa tu género";
    } else {
        $genero = $input_genero;
    }

    if ($_POST["password"] == $_POST["password2"]) {

        if (empty($user_err) && empty($name_err) && empty($apes_err) && empty($telefono_err) && empty($password_err) && empty($mail_err) && empty($genero_err)) {

            $sql = "INSERT INTO usuarios_pass (nombre, password, apellidos, genero, telefono, correo_electronico, privilegio) VALUES (?, HEX(AES_ENCRYPT(?, 'pwd')),?,?,?,?,?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "sssssss", $param_nombre, $param_pas, $param_ape, $param_gen, $param_tel, $param_mail, $param_priv);

                $param_nombre = $name;
                $param_pas = $password;
                $param_ape = $apes;
                $param_gen = $genero;
                $param_tel = $telefono;
                $param_mail = $mail;
                $param_priv = "cliente";


                if (mysqli_stmt_execute($stmt)) {

                    header("location: login");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Poppins:ital,wght@0,200;0,300;0,600;0,800;1,600&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
    $site_key = $_ENV['SITE_KEY'];
    $secret_key = $_ENV['SECRET_KEY'];

    if (isset($_POST['submit'])) {
        $response = $_POST['g-recaptcha-response'];
        $payload = file_get_contents('https://www.google.com/recaptcha/api/siteverify?
        secret=' . $secret_key . '&response=' . $response);
        echo $payload;
    }
    ?>

    <section class="section-login">
        <?php
        require_once("../partials/header.php");
        ?>
        <div class="cont-form2">
            <div class="containerimg">
                <img src="../img/grdnt.png" alt="" class="logologin" id="lglgin">
                <div class="txtcenter2">REGÍSTRATE</div>
            </div>

            <form id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="cont-forms">
                    <div class="primer">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">face</i>
                            <input id="nom" type="text" name="name" required>
                            <label for="nom">Nombre(s)</label>
                            <p class="msj-ayuda2"><?php echo $name_err ?></p>
                            <p class="msj-ayuda3">Mínimo 4 letras (Ej. Juan)</p>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">supervised_user_circle</i>
                            <input id="ma" type="text" name="apes">
                            <label for="ma">Apellidos</label>
                            <p class="msj-ayuda2"><?php echo $apes_err ?></p>
                            <p class="msj-ayuda3">Mínimo 4 letras (Ej. Rodríguez Soto)</p>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">call</i>
                            <input id="tel" type="number" name="phone">
                            <label for="tel">Teléfono/Celular</label>
                            <p class="msj-ayuda2"><?php echo $telefono_err ?></p>
                            <p class="msj-ayuda3">Número de México (Ej. 6181234567)</p>
                        </div>
                    </div>
                    <div class="primer">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">mail</i>
                            <input id="em" type="email" name="mail">
                            <label for="em">Correo Electrónico</label>
                            <p class="msj-ayuda2"><?php echo $mail_err ?></p>
                            <p class="msj-ayuda3">Correo válido (Ej. juan@gmail.com)</p>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">dialpad</i>
                            <input id="passw" type="password" name="password">
                            <label for="passw">Contraseña</label>
                            <p class="msj-ayuda2"><?php echo $password_err ?></p>
                            <p class="msj-ayuda3">Utiliza mayúsculas y caracteres especiales (Ej. #$%&/!)</p>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">lock</i>
                            <input id="passw2" type="password" name="password2">
                            <label for="passw2">Confirmar contraseña</label>
                            <span class="msj-ayuda"></span>
                        </div>
                        <div class="input-field col s12">
                            <select name="genero" value="<?php echo $genero; ?>" required>
                                <option value="default" disabled selected>Elige una opción</option>
                                <div class="divider"></div>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <label>Género</label>
                        </div>
                    </div>
                </div>

                <div class="centrar">
                    <div class="contabajo">
                        <div class="recaptcha">
                            <div class="g-recaptcha" data-callback="captchaVerified" data-sitekey="6LegdqcZAAAAADtCsf2267nYn627y9U68wIOiLFh"></div>
                        </div>
                        <div class="center-align">
                            <input type="submit" name="enviar" value="REGISTRARSE" class="waves-effect waves-light btn" id="submit" disabled></td>
                            <div class="spaceje"></div>
                            <input type="reset" name="borrar" value="BORRAR" class="waves-effect waves-light btn" id="brrar"></td>
                        </div>
                    </div>

                </div>
            </form>
            <div class="reg">
                <div class="center-align">
                    <span class="msg1">¿Ya eres un usuario?<a class="msg" href="login.php">Inicia Sesión</a>
                </div>
            </div>
            </form>

        </div>


    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script>
        function captchaVerified() {
            var submitBin = document.querySelector('#submit');
            submitBin.removeAttribute('disabled');
        }
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
        $(document).ready(function() {
            $('select').formSelect();
        });
    </script>
</body>

</html>