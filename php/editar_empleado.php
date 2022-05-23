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

$nombre = $apellidos = $telefono = $mail = $sucursal = "";
$nombre_err = $apellidos_err = $telefono_err = $mail_err = $sucursal_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $input_nombre = trim($_POST["name"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor ingrese un nombre.";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Por favor ingrese un nombre válido.";
    } else {
        $nombre = $input_nombre;
    }

    $input_apellidos = trim($_POST["lastname"]);
    if (empty($input_apellidos)) {
        $apellidos_err = "Por favor ingrese los apellidos.";
    } elseif (!filter_var($input_apellidos, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $apellidos_err = "Por favor ingrese un nombre válido.";
    } else {
        $apellidos = $input_apellidos;
    }

    $input_telefono = trim($_POST["phone"]);
    if (empty($input_telefono)) {
        $telefono_err = "Por favor ingrese el monto del salario del empleado.";
    } elseif (!ctype_digit($input_telefono)) {
        $telefono_err = "Por favor ingrese un valor positivo y válido.";
    } else {
        $telefono = $input_telefono;
    }

    $input_mail = trim($_POST["mail"]);
    if (empty($input_mail)) {
        $mail_err = "Por favor ingrese una dirección.";
    } else {
        $mail = $input_mail;
    }

    $input_sucursal = trim($_POST["sucursal"]);
    if (empty($input_sucursal)) {
        $sucursal_err = "Por favor ingrese una dirección.";
    } elseif ($input_sucursal == "default") {
        $sucursal_err = "Por favor ingrese una dirección.";
    } else {
        $sucursal = $input_sucursal;
    }



    if (empty($nombre_err) && empty($apellidos_err) && empty($telefono_err) && empty($mail_err) && empty($sucursal_err)) {

        $sql = "UPDATE empleado SET nombre=?, apellidos=?, telefono=?, correo_electronico=?, sucursal=? WHERE id_empleado=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssssi", $param_nombre, $param_apellidos, $param_telefono, $param_mail, $param_sucursal, $param_id);

            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_telefono = $telefono;
            $param_mail = $mail;
            $param_sucursal = $sucursal;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {

                header("location: empleados.php");
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


        $sql = "SELECT * FROM empleado WHERE id_empleado = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $nombre = $row["nombre"];
                    $apellidos = $row["apellidos"];
                    $telefono = $row["telefono"];
                    $mail = $row["correo_electronico"];
                    $sucursal = $row["sucursal"];
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
    
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form <?php echo (!empty($nombre_err)) ? 'error' : ''; ?>" id="box">
                            <label>Nombre:</label>
                            <input type="text" name="name" class="inputedit" value="<?php echo $nombre; ?>">
                            <span class="#"><?php echo $nombre_err; ?></span>
                        </div>
                        <div class="form <?php echo (!empty($apellidos_err)) ? 'error' : ''; ?>" id="box">
                            <label>Apellidos:</label>
                            <input type="text" name="lastname" class="inputedit" value="<?php echo $apellidos; ?>">
                            <span class="#"><?php echo $apellidos_err; ?></span>
                        </div>
                        <div class="form <?php echo (!empty($telefono_err)) ? 'error' : ''; ?>" id="box">
                            <label>Teléfono:</label>
                            <input type="text" name="phone" class="inputedit" value="<?php echo $telefono; ?>">
                            <span class="#"><?php echo $telefono_err; ?></span>
                        </div>
                        <div class="form <?php echo (!empty($mail_err)) ? 'error' : ''; ?>" id="box">
                            <label>Email:</label>
                            <input type="email" name="mail" class="" value="<?php echo $mail; ?>">
                            <span class="#"><?php echo $mail_err; ?></span>
                        </div>
                        <div class="form <?php echo (!empty($sucursal_err)) ? 'error' : ''; ?>" id="box">
                            <label class="texto">Sucursal:</label>
                            <select name="sucursal" class="" value="<?php echo $row["sucursal"]; ?>">
                            <option value="" disabled selected>Selecciona una sucursal</option>
                                <option value="Sahop">Sahop</option>
                                <option value="5 de Febrero">5 de Febrero</option>
                                <option value="Benito Juárez">Benito Juárez</option>
                                <option value="El Edén">El Edén</option>
                                <option value="San Fernanda">Residencial San Fernanda</option>
                                <option value="Guadalupe">Guadalupe</option>
                            </select>
                            <span class="#"><?php echo $sucursal_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" name="enviar" class="btn" value="Guardar Cambios">
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