<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("location: login");
} else {
    $us = $_SESSION['user'];
    $ps = $_SESSION['pass'];
    $priv = $_SESSION['priv'];
}

if ($priv == "cliente") {
  header("location: login");
}

require_once "conexion.php";

$comprobar = FALSE;

$nombre = $direccion = "";
$nombre_err = $direccion_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

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

        $sql = "UPDATE sucursal SET nombre=?, direccion=? WHERE id_sucursal=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_direccion, $param_id);

            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {

                header("location: sucursales-admin");
                exit();
            } else {
                echo "Algo salió mal. Inténtalo de nuevo";
            }
        }


        mysqli_stmt_close($stmt);
    }


    mysqli_close($conn);
} else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id =  trim($_GET["id"]);


        $sql = "SELECT * FROM sucursal WHERE id_sucursal = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $nombre = $row["nombre"];
                    $direccion = $row["direccion"];
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
    <title>Actualizar Empleado | Pastelería Trébol</title>
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

    <?php require_once('../partials/sidenavapp.php'); ?>

        <div class="content">
    
            <div>
                <header class="encabezado">
                    <h1 class="tituloheader">ADMINISTRADOR PASTELERÍA TRÉBOL</h1>
                </header>
            </div>
            <nav class="navegacion">
                <li><a class='icon-logout' href='logoutapp' title='Cerrar Sesión'></a></li>
                <li class="#"><a class='icon-user' href='userapp' title='Usuario'></a></li>
                <p class="textbienv"><?php echo "Bienvenido, " . $us ?></p>
            </nav>

            <div class="main">
            <div class="containerimg">
                <img src="../img/titlecover2.png" alt="" class="imgtitle">
                <div class="txtcenter">Editar Sucursal</div>
            </div>

            <a class="volver" href="sucursales-admin"><i class="material-icons">keyboard_arrow_left</i></a>

            <div align="center">
                <p class="txtno">Completa todos los campos</p>
            </div>
                <?php

                require_once("conexion.php");

                ?>

                <div class="formulario-editar">
                    <p>Edita los campos:</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">store</i>
                        <input id="nom" type="text" class="" name="nombre" value="<?php echo $nombre; ?>">
                        <label for="nom">Nombre(s)</label>
                        <span><?echo $nombre_err ?></span>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <input id="dir" type="text" class="" name="direccion" value="<?php echo $direccion; ?>">
                        <label for="dir">Dirección</label>
                        <span><?echo $direccion_err ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" name="enviar" class="waves-effect waves-light btn" value="Actualizar">
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
</body>

<?php

if (isset($_POST['enviar'])) {
    if ($comprobar == TRUE) {
?>
        <script>
            function actualizar() {
                swal({
                        title: "Oops! Algo salió mal",
                        text: "¡Intentalo de nuevo, mas tarde!",
                        icon: "error",
                        dangerMode: true,
                    })
                    .then(function() {
                        window.location = "editar_empleado.php";
                    });
            }
            actualizar();
        </script>
    <?php
    } elseif ($comprobar == FALSE) {
    ?>
        <script>
            function actualizar() {
                swal({
                        title: "Guardar Cambios",
                        text: "¿Estás seguro de actualizar este alumno?",
                        icon: "info",
                        buttons: {
                            cancel: {
                                text: "Cancelar",
                                visible: true
                            },
                            confirm: {
                                text: "Actualizar"
                            }
                        },
                    })
                    .then((actualizar) => {
                        if (actualizar) {
                            swal("Alumno actualizado exitosamente", {
                                icon: "success",
                            }).then(function() {
                                window.location = "empleados.php";
                            });
                        } else {
                            swal("Registro no se ha actualizado");
                        }
                    });
            }
            actualizar();
        </script>
<?php

    }
}
?>

</html>