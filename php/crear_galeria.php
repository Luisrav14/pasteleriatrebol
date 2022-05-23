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

$comprobar = FALSE;

$foto = "";
$foto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $foto = $_FILES['foto'];

    $archivo_subido = '../img/galeria-img/' . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);
    $foto = $_FILES['foto']['name'];



    if (empty($nombre_err) && empty($descripcion_err) && empty($precio_err) && empty($tipo_err) && empty($foto_err)) {

        $sql = mysqli_query($conn, "INSERT INTO galeria (foto) VALUES ('$foto')");


        if ($sql) {

            header("location: galeria-admin.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later." . $conn->error;
        }
    }


    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Imagen | Pastelería Trébol</title>
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
    ?>

<?php require_once('../partials/headerapp.php'); ?>

    <div class="content">


        <?php

        require_once("conexion.php");

        ?>

        <div class="main">

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Añadir Imagen</div>
            </div>

            <a class="volver" href="productos-admin"><i class="material-icons">keyboard_arrow_left</i></a>


            <div align="center">
                <p class="txtno">Selecciona una imagen</p>
            </div>

            <div class="cont-tabla-admin">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">       
                    <div class="file-field input-field" <?php echo (!empty($foto_err)) ? 'error' : ''; ?>" id="box">
                        <div class="btn">
                            <span>Imágen</span>
                            <input type="file" name="foto" id="btn" class="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Subir Imágen">
                        </div>
                    </div>

                    <div class="center-align">
                    <input type="submit" class="waves-effect waves-light btn" value="GUARDAR IMÁGEN">
                    </div>

                </form>
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