<?php

session_start();

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "conexion.php";

    $sql = "SELECT * FROM empleado WHERE id_empleado = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $nombre = $row["nombre"];
                $apellidos = $row["apellidos"];
                $telefono = $row["telefono"];
                $email = $row["correo_electronico"];
                $suc = $row["sucursal"];
            } else {

                header("location: mror.php");
                exit();
            }
        } else {
            echo "Error";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
} else {

    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Información de Empleado | Pastelería Trébol</title>
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
    <style type="text/css"></style>
</head>

<body>

    <?php require_once('../partials/sidenavapp.php');
    require_once("../partials/headerapp.php"); ?>

    <div class="main">


        <div class="content">
            <?php

            require_once("conexion.php");

            ?>

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter"><?php echo $row["nombre"]; ?></div>
            </div>

            <a class="volver" href="empleados"><i class="material-icons">keyboard_arrow_left</i></a>

            <div class="cont-tabla-admin">
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $nombre ?>">
                    <label for="icon_prefix">Nombre(s)</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">supervisor_account</i>
                    <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $apellidos ?>">
                    <label for="icon_prefix">Nombre(s)</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">call</i>
                    <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $telefono ?>">
                    <label for="icon_prefix">Teléfono</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">mail</i>
                    <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $email ?>">
                    <label for="icon_prefix">Nombre(s)</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">store</i>
                    <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $suc ?>">
                    <label for="icon_prefix">Sucursal</label>
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
</body>

</html>
