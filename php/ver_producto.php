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

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "conexion.php";

    $sql = "SELECT * FROM producto WHERE id_producto = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $nombre = $row["nombre"];
                $descripcion = $row["descripcion"];
                $precio = $row["precio"];
                $tipo = $row["tipo"];
                $foto = $row["foto"];
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
                <div class="txtcenter"><?php echo $row["nombre"]; ?></div>
            </div>

            <a class="volver" href="productos-admin"><i class="material-icons">keyboard_arrow_left</i></a>

            <?php
            require_once("conexion.php");
            ?>

            <div class="cont-tabla-admin">
            <div class="row">
            <label class="eti">Nombre</label>
            <p class="txtver"><?php echo $row["nombre"]; ?></p>
            </div>

            <div class="row">
                <label class="eti">Descripción</label>
                <p class="txtver"><?php echo $row["descripcion"]; ?></p>
            </div>
            <div class="row">
                <label class="eti">Precio</label>
                <p class="txtver"><?php echo $row["precio"]; ?></p>
            </div>
            <div class="row">
                <label class="eti">Tipo</label>
                <p class="txtver"><?php echo $row["tipo"]; ?></p>
            </div>
            <div class="row">
                <label class="eti">Imagen</label>
                <?php echo "<img src='../img/" . $row['foto'] . "'/>"?>
            </div>     
            </div>
               
        </div>
    </div>

</body>


</html>