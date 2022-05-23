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

require_once "conexion.php";

$nombre = $apellidos = $telefono = $email = $sucursal = "";
$nombre_err = $apellidos_err = $telefono_err = $email_err = $sucursal_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Ingresa el nombre del Empleado";
    } else {
        $nombre = $input_nombre;
    }

    $input_apellidos = trim($_POST["apellidos"]);
    if (empty($input_apellidos)) {
        $apellidos_err = "Ingresa los apellidos del empleado";
    } else {
        $apellidos = $input_apellidos;
    }

    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono_err = "Por favor, ingresa el número telefónico del empleado.";
    } elseif (!ctype_digit($input_telefono)) {
        $telefono_err = "Por favor, ingresa un valor de número telefónico correcto y positivo.";
    } else {
        $telefono = $input_telefono;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Por favor, ingresa una dirección de correo electrónico.";
    } else {
        $email = $input_email;
    }

    $input_sucursal = trim($_POST["sucursal"]);
    if (empty($input_sucursal)) {
    } elseif ($input_sucursal == "default") {
        $sucursal_err = "Por favor, selecciona una sucursal válida.";
    } else {
        $sucursal = $input_sucursal;
    }

    if (empty($nombre_err) && empty($apellidos_err) && empty($telefono_err) && empty($email_err) && empty($sucursal_err)) {

        $sql = "INSERT INTO empleado (nombre, apellidos, telefono, correo_electronico, sucursal) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssss", $param_nombre, $param_apellidos, $param_telefono, $param_email, $param_sucursal);


            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_sucursal = $sucursal;


            if (mysqli_stmt_execute($stmt)) {

                header("location: empleados");
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
    <title>Agregar Empleado | Pastelería Trébol</title>
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
                <div class="txtcenter">Añadir un empleado</div>
            </div>

            <a class="volver" href="empleados"><i class="material-icons">keyboard_arrow_left</i></a>

            <div align="center">
                <p class="txtno">Completa todos los campos</p>
            </div>

            <div class="cont-tabla-admin">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="nom" type="text" class="" name="nombre">
                        <label for="nom">Nombre(s)</label>
                        <span><?echo $nombre_err ?></span>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">supervisor_account</i>
                        <input id="ape" type="text" class="" name="apellidos">
                        <label for="ape">Apellidos</label>
                        <span><?echo $apellidos_err ?></span>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">call</i>
                        <input id="tel" type="number" class="" name="telefono">
                        <label for="tel">Teléfono</label>
                        <span><?echo $telefono_err ?></span>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">mail</i>
                        <input id="ma" type="text" class="" name="email">
                        <label for="ma">Correo Electrónico</label>
                    </div>

                    <div class="input-field col s12">
                        <select name="sucursal">
                            <option value="default" selected>Elige una sucursal</option>
                            <?php
                            require_once "conexion.php";

                            $sql = "SELECT * FROM sucursal";

                            if($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value=" . $row['id_sucursal'] . "> #" . $row['id_sucursal'] . " " . $row['nombre'] . "</option>";
                                    }
                                    mysqli_free_result($result);
                                } else {
                                    echo "<option>No hay sucursales registradas</option>";
                                }
                            } else {
                                echo "ERROR: $sql " . mysqli_error($conn);
                            }
                            ?>
                        </select>

                        <label>Categoría</label>
                    </div>


                    <input type="submit" class="waves-effect waves-light btn" value="Añadir">
                </form>
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