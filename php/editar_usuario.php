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

if ($priv == "cliente") {
    header("location: login");
}

require_once('conexion.php');

$name = $apes = $telefono = $password = $mail = $genero = $privilegio = "";
$name_err = $apes_err = $telefono_err = $password_err = $mail_err = $genero_err = $privilegio_err = "";


if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

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

    $input_privilegio = trim($_POST["privilegio"]);
    if ($input_privilegio == "default") {
        $privilegio_err = "Ingresa tu privilegio";
    } else {
        $privilegio = $input_privilegio;
    }

    if (empty($privilegio_err) && empty($name_err) && empty($apes_err) && empty($telefono_err) && empty($password_err) && empty($mail_err) && empty($genero_err)) {

        $sql = "UPDATE usuarios_pass SET nombre=?, password=HEX(AES_ENCRYPT(?, 'pwd')), apellidos=?, genero=?, telefono=?, correo_electronico=?, privilegio=? WHERE ID=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssssssi", $param_nombre, $param_pas, $param_ape, $param_gen, $param_tel, $param_mail, $param_priv, $param_id);

            $param_nombre = $name;
            $param_pas = $password;
            $param_ape = $apes;
            $param_gen = $genero;
            $param_tel = $telefono;
            $param_mail = $mail;
            $param_priv = $privilegio;
            $param_id = $id;


            if (mysqli_stmt_execute($stmt)) {

                header("location: usuarios-admin");
                exit();
            } else {
                echo "Something went wrong. Please try again later." . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id =  trim($_GET["id"]);


        $sql = "SELECT ID, nombre, apellidos, genero, telefono, correo_electronico, AES_DECRYPT(UNHEX(password), 'pwd') AS password, privilegio FROM usuarios_pass WHERE ID = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $name = $row['nombre'];
                    $apes = $row['apellidos'];
                    $genero = $row['genero'];
                    $telefono = $row['telefono'];
                    $mail = $row['correo_electronico'];
                    $privilegio = $row['privilegio'];
                    $password = $row['password'];
                } else {

                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    } else {

        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/appweb2.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Poppins:ital,wght@0,200;0,300;0,600;0,800;1,600&family=Sacramento&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    require_once('../partials/sidenavapp.php');
    require_once('../partials/headerapp.php');
    ?>

    <div class="content">


        <div class="main">

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Editar usuario</div>
            </div>

            <a class="volver" href="usuarios-admin"><i class="material-icons">keyboard_arrow_left</i></a>

            <div align="center">
                <p class="txtno">Completa todos los campos</p>
            </div>

            <div class="cont-tabla-admin">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">face</i>
                        <input id="nom" type="text" name="name" value="<?php echo $name ?>" required>
                        <label for="nom">Nombre(s)</label>
                        <p class="msj-ayuda2"><?php echo $name_err ?></p>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">supervised_user_circle</i>
                        <input id="ma" type="text" name="apes" value="<?php echo $apes ?>">
                        <label for="ma">Apellidos</label>
                        <p class="msj-ayuda2"><?php echo $apes_err ?></p>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">call</i>
                        <input id="tel" type="number" name="phone" value="<?php echo $telefono ?>">
                        <label for="tel">Teléfono/Celular</label>
                        <p class="msj-ayuda2"><?php echo $telefono_err ?></p>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">mail</i>
                        <input id="em" type="email" name="mail" value="<?php echo $mail ?>">
                        <label for="em">Correo Electrónico</label>
                        <p class="msj-ayuda2"><?php echo $mail_err ?></p>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">dialpad</i>
                        <input id="passw" type="password" name="password" value="<?php echo $password ?>">
                        <label for="passw">Contraseña</label>
                        <p class="msj-ayuda2"><?php echo $password_err ?></p>
                        <div class="mostrarocultar">
                            <label>
                                <input type="checkbox" class="filled-in" onclick="contraseña()">
                                <span class="mo">Mostrar Contraseña</span>
                            </label>
                        </div>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">lock</i>
                        <input id="passw2" type="password" name="password2" value="<?php echo $password ?>">
                        <label for="passw2">Confirmar contraseña</label>
                        <p class="msj-ayuda2"><?php echo $password_err ?></p>
                    </div>

                    <div class="input-field col s12">
                        <select name="genero" value="<?php echo $genero ?>" selected required>
                            <option value="default" disabled>Elige una opción</option>
                            <div class="divider"></div>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <label>Género</label>
                        <p class="msj-ayuda2"><?php echo $genero_err ?></p>
                    </div>

                    <div class="input-field col s12">
                        <select name="privilegio" value="<?php echo $privilegio ?>" selected required>
                            <option value="default" disabled>Elige una opción</option>
                            <div class="divider"></div>
                            <option value="administrador">Administrador (Todas las acciones)</option>
                            <option value="estandar">Estandar (Solo Consultas)</option>
                            <option value="cliente">Cliente</option>
                        </select>
                        <label>Privilegio</label>
                        <p class="msj-ayuda2"><?php echo $privilegio_err ?></p>
                    </div>

                    <div class="align-center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" name="enviar" class="waves-effect waves-light btn" value="Editar usuario">
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('select').formSelect();
        });
    </script>
</body>

</html>