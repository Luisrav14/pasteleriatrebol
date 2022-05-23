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

$nombre = $direccion = "";
$nombre_err = $direccion_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Ingresa el nombre de la sucursal";
    } else {
        $nombre = $input_nombre;
    }

    $input_direccion = trim($_POST["direccion"]);
    if (empty($input_direccion)) {
        $direccion_err = "Ingresa la direccion de la sucursal";
    } else {
        $direccion = $input_direccion;
    }
  
    if (empty($nombre_err) && empty($direccion_err))  {

        $sql = "INSERT INTO sucursal (nombre, direccion) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_direccion);


            $param_nombre = $nombre;
            $param_direccion = $direccion;

            if (mysqli_stmt_execute($stmt)) {

                header("location: sucursales-admin.php");               
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
    <title>Agregar Sucursal | Pastelería Trébol</title>
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
                <div class="txtcenter">Añadir Sucursal</div>
            </div>

            <a class="volver" href="sucursales-admin.php"><i class="material-icons">keyboard_arrow_left</i></a>

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
                        <input id="dir" type="text" class="" name="direccion">
                        <label for="dir">Direccion</label>
                        <span><?echo $direccion_err ?></span>
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