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

$id = $_GET["id"];

if ($priv == "cliente") {
    header("location: login");
}

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "conexion.php";

    $sql = "SELECT * FROM pedidos_especiales WHERE id_pedido = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $usuario = $row["usuario"];
                $descripcion = $row["descripcion"];
                $fecha = $row["fecha"];
                $imagen = $row["imagen"];
                $estado = $row["estado"];
            } else {

                header("location: mror.php");
                exit();
            }
        } else {
            echo "Error";
        }
    }

    mysqli_stmt_close($stmt);

} else {

    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información Producto | Pastelería Trébol</title>
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
    <style type="text/css">
    </style>
</head>

<body>

    <?php require_once('../partials/sidenavapp.php'); ?>

    <div class="content">

        <?php require_once("../partials/headerapp.php"); ?>

        <div class="main">

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Gestión de Pedido</div>
            </div>

            <a class="volver" href="pedidos_especiales_admin"><i class="material-icons">keyboard_arrow_left</i></a>

            <?php
            require_once("conexion.php");

            $consulta = "SELECT * FROM pedidos_especiales WHERE id_pedido = $id";
            if ($result = mysqli_query($conn, $consulta)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='cont-tabla-admin'>";
                    echo "<table class='responsive-table striped centered' id='pedid'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th># Pedido</th>";
                    echo "<th>Usuario solicitante</th>";
                    echo "<th>Descipción</th>";
                    echo "<th>Fecha para pedido</th>";
                    echo "<th>Imagen de Referencia</th>";
                    echo "<th>Estado</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        $idpedido = $row['id_pedido'];
                        echo "<tr>";
                        echo "<td>" . $row['id_pedido'] . "</td>";
                        echo "<td>" . $row['usuario'] . " <a href='ver_usuario?id=". $row['usuario'] ."'>Ver Usuario</a></td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
            ?>
                        <td class="imgpe"> <?php echo "<img class='materialboxed' id='imgped' width='100' src='../img/pe/" . $row['imagen'] .  "'/> " ?></td>
            <?php
                        echo "<td class='estado'>" . $row['estado'] . "</td>";

                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "<div class='center-align'>";
                    echo "<a class='waves-effect waves-light btn' id='btnopcpe' href='pedido_enviado?id=" . $idpedido . "'><i class='material-icons left'>move_to_inbox</i>Marcar como enviado</a>";
                    echo "<a class='waves-effect waves-light btn' id='btnopcpe' href='pedido_leido?id=" . $idpedido . "'><i class='material-icons left'>done_all</i>Marcar como leído</a>";
                    echo "<a class='waves-effect waves-light btn' id='btnopcpe' href='pedido_proceso?id=" . $idpedido . "'><i class='material-icons left'>assignment_turned_in</i>Marcar como En Proceso</a>";
                    echo "<a class='waves-effect waves-light btn' id='btnopcpe' href='pedido_finalizado?id=" . $idpedido . "'><i class='material-icons left'>cake</i>Marcar como finalizado</a>";
                    echo "<a class='waves-effect waves-light btn' id='btnopcpe' href='pedido_cancelado?id=" . $idpedido . "'><i class='material-icons left'>clear</i>Marcar como cancelado</a>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p class='txtno'>No hay ningún pedido especial</p>";
                }
            } else {
                echo "ERROR: Could not able to execute $consulta. " . mysqli_error($conn);
            }

            mysqli_close($conn);

            ?>
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
        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });
    </script>

</body>


</html>