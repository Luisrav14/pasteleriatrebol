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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Sucursales | Pastelería Trébol</title>
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

    <?php
    require_once('../partials/sidenavapp.php');

    require_once('../partials/headerapp.php');
    ?>

    <div class="main">

        <div class="content">

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Gestión de Sucursales</div>
            </div>

            <?php  if ($priv == "administrador") {    ?>  
            <a class="waves-effect waves-light btn right" href="crear_sucursal.php"><i class="material-icons left">add_location</i>Añadir un Sucursal</a>
            <?php   }     ?>

            <a class="waves-effect waves-light btn right" href="pdf_sucursales" id="btnci" target="_blank"><i class="material-icons left">picture_as_pdf</i>Generar reporte PDF</a>
            
            <?php

            require_once("conexion.php");

            $sql = "SELECT * FROM sucursal";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='cont-tabla-admin'>";
                    echo "<table class='responsive-table striped centered' id='productos'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Dirección</th>";     
                    if ($priv == "administrador") {              
                    echo "<th>Acciones</th>"; }
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_sucursal'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";                                  
                        echo "<td>";
                        echo "<a class='ver' href='ver_sucursal.php?id=" . $row['id_sucursal'] . "' title='Ver Información'><span class='icon-eye'></span></a>";
                        if ($priv == "administrador") {                                                                        
                        echo "<a class='editar' href='editar-sucursal.php?id=" . $row['id_sucursal'] . "' title='Actualizar'><span class='icon-pencil'></span></a>";
                        echo "<a class='borrar' href='eliminar_sucursal.php?id=" . $row['id_sucursal'] . " title='Borrar'><span class='icon-trash'></span></a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";

                    mysqli_free_result($result);
                } else {
                    echo "<p class='txtno'>No se ha registrado ningún producto. ¡Registra uno ahora!</p>";
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }


            mysqli_close($conn);
            ?>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript">
        function ConfirmDelete(); {
            var respuesta = confirm(" ¿Estas seguro de borrar este producto?");

            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

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
        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });
    </script>

</body>

</html>