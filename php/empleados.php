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

    $input_nombre = trim($_POST["name"]);
    if (empty($input_nombre)) {
        $nombre_err = "Ingresa el nombre del Empleado";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Por favor, ingresa un nombre válido.";
    } else {
        $nombre = $input_nombre;
    }

    $input_apellidos = trim($_POST["lastname"]);
    if (empty($input_apellidos)) {
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $apellidos_err = "Por favor, ingresa un valor válido.";
    } else {
        $apellidos = $input_apellidos;
    }

    $input_telefono = trim($_POST["phone"]);
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
}
?>

<?php
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "conexion.php";

    $sql2 = "SELECT * FROM empleado WHERE id_empleado = ?";

    if ($stmt2 = mysqli_prepare($conn, $sql2)) {

        mysqli_stmt_bind_param($stmt2, "i", $param_id2);

        $param_id2 = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt2)) {
            $result2 = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result2) == 1) {
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                $nombre = $row2["nombre"];
                $apellidos = $row2["apellidos"];
                $telefono = $row2["telefono"];
                $email = $row2["correo_electronico"];
                $suc = $row2["sucursal"];
            } else {

                header("location: mror.php");
                exit();
            }
        } else {
            echo "Error";
        }
    }

    mysqli_stmt_close($stmt2);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados | Pastelería Trébol</title>
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
    ?>

    <?php require_once("../partials/headerapp.php"); ?>

    <div class="main">


        <div class="content">

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Gestión de Empleados</div>
            </div>

            <a class="waves-effect waves-light btn right" href="crear_empleado"><i class="material-icons left">account_circle</i>Añadir un empleado</a>
            <a class="waves-effect waves-light btn right" href="pdf_empleados" id="btnci" target="_blank"><i class="material-icons left">picture_as_pdf</i>Generar reporte PDF</a>


                <?php require_once("conexion.php");
                $sql = "SELECT * FROM empleado";
                if ($result = mysqli_query(
                    $conn,
                    $sql
                )) {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<div class='cont-tabla-admin'>";
                        echo "<table class='responsive-table striped centered' id='empleados'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='icon-sort'>ID</th>";
                        echo "<th class='icon-sort'>Nombre</th>";
                        echo "<th class='icon-sort'>Apellidos</th>";
                        echo "<th class='icon-sort'>Teléfono</th>";
                        echo "<th class='icon-sort'>Correo electrónico</th>";
                        echo "<th class='icon-sort'>Sucursal</th>";
                        echo "<th class='#'>Acciones</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td class='idcolumn' id='id_empleado'>" . $row['id_empleado'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['apellidos'] . "</td>";
                            echo "<td>" . $row['telefono'] . "</td>";
                            echo "<td>" . $row['correo_electronico'] . "</td>";
                            echo "<td>" . $row['sucursal'] . " <a href='ver_sucursal?id=". $row['sucursal'] ."'>Ver Sucursal</a></td>";                            echo "<td class='filaopc'>";
                            // echo "<span class='icon-eye' id='consultar'></span>";
                            echo "<a class='ver' href='verempcopy?id=" . $row['id_empleado'] . "' title='Ver Información'><span class='icon-eye'></span></a>";
                            if ($priv == "administrador") {                                                                        
                                echo "<a class='editar' href='editar_empleado?id=" . $row['id_empleado'] . "' title='Actualizar'><span class='icon-pencil'></span></a>";
                                echo "<a class='borrar' href='eliminar_empleado?id=" . $row['id_empleado'] . " title='Borrar'><span class='icon-trash'></span></a>";
                                }
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        mysqli_free_result($result);
                    } else {
                        echo "<p class='texto'>Los registros de empleados se encuentran vacíos</p>";
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }

                mysqli_close($conn);
                ?></div>

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