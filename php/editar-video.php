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


if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $video_guardado = $_POST['video_guardado'];
    $video = $_FILES['video'];

    if (empty($video['name'])) {
        $video = $video_guardado;
    } else {
        $archivo_subido = '../video/' . $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], $archivo_subido);
        $video = $_FILES['video']['name'];
    }

        $sql = $conn->query("UPDATE video SET video='$video' WHERE id_video='$id'");


        if ($sql) {

            header("location: inicio-admin.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later." . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id =  trim($_GET["id"]);


        $sql = "SELECT * FROM video WHERE id_video = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $video = $row["video"];
                } else {

                    echo "error";

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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Video | Pastelería Trébol</title>
    <link rel="stylesheet" href="../css/appweb2.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Poppins:ital,wght@0,200;0,300;0,600;0,800;1,600&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
</head>

<body>

    <?php require_once('../partials/sidenavapp.php'); ?>

    <div class="content">

        <?php require_once("../partials/headerapp.php") ?>
        <div class="main">

            <?php

            require_once("conexion.php");

            ?>

            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Editar video inicio</div>
            </div>

            <a class="volver" href="inicio-admin"><i class="material-icons">keyboard_arrow_left</i></a>


            <div align="center">
                <p class="txtno">Completa el campo</p>
            </div>

           <div class="cont-tabla-admin">
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">


                    <div class="file-field input-field" <?php echo (!empty($foto_err)) ? 'error' : ''; ?>" id="box">
                        <div class="btn">
                            <span>Video</span>
                            <input type="file" name="video" id="btn" class="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Subir Imágen">
                        </div>
                    </div>

                    <div class="center-align">
                    <input type="hidden" name="video_guardado" value="<?php echo $video; ?>" />
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="waves-effect waves-light btn" value="EDITAR video">
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
    </script>
</body>
</html>