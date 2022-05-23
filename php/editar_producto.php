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

$nombre = $descripcion = $precio = $tipo = $foto = "";
$nombre_err = $descripcion_err = $precio_err = $tipo_err = $foto_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor ingrese un nombre.";
    } else {
        $nombre = $input_nombre;
    }

    $input_descripcion = trim($_POST["descripcion"]);
    if (empty($input_descripcion)) {
        $descripcion_err = "Por favor ingresa una descripción.";
    } else {
        $descripcion = $input_descripcion;
    }

    $input_precio = trim($_POST["precio"]);
    if (empty($input_precio)) {
        $precio_err = "Por favor ingrese el precio del producto.";
    } elseif (!ctype_digit($input_precio)) {
        $precio_err = "Por favor ingrese un valor positivo y válido.";
    } else {
        $precio = $input_precio;
    }

    $input_tipo = trim($_POST["tipo"]);
    if (empty($input_tipo)) {
        $tipo_err = "Por favor ingrese un tipo.";
    } else {
        $tipo = $input_tipo;
    }

    $foto_guardada = $_POST['foto_guardada'];
    $foto = $_FILES['foto'];

    if (empty($foto['name'])) {
        $foto = $foto_guardada;
    } else {
        $archivo_subido = '../img/' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);
        $foto = $_FILES['foto']['name'];
    }



    if (empty($nombre_err) && empty($descripcion_err) && empty($precio_err) && empty($tipo_err) && empty($foto_err)) {

        $sql = $conn->query("UPDATE producto SET nombre='$nombre', descripcion='$descripcion', precio='$precio', tipo='$tipo', foto='$foto' WHERE id_producto='$id'");


        if ($sql) {

            header("location: productos-admin.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }





    mysqli_close($conn);
} else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id =  trim($_GET["id"]);


        $sql = "SELECT * FROM producto WHERE id_producto = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;

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
    <title>Actualizar Empleado | Pastelería Trébol</title>
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
                <div class="txtcenter">Editar producto</div>
            </div>

            <a class="volver" href="productos-admin"><i class="material-icons">keyboard_arrow_left</i></a>


            <div align="center">
                <p class="txtno">Completa todos los campos</p>
            </div>

           <div class="cont-tabla-admin">
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">cake</i>
                        <input id="icon_prefix" type="text" class="validate" name="nombre" value="<?php echo $nombre ?>">
                        <label for="icon_prefix">Nombre del Producto</label>
                    </div>

                    <div class="input-field col s6">
                         <i class="material-icons prefix">feedback</i>
                        <input id="des" type="text" class="validate" name="descripcion" value="<?php echo $descripcion ?>">
                        <label for="des">Descripción</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">monetization_on</i>
                        <input id="pre" type="number" class="validate" name="precio" value="<?php echo $precio ?>">
                        <label for="pre">Precio</label>
                    </div>

                    <div class="input-field col s12">
                        <select name="tipo" value="<?php echo $tipo ?>" selected>
                            <option value="" disabled>Elige una categoría</option>
                            <option value="Pastel">Pastel</option>
                            <option value="Pay">Pay</option>
                            <option value="Repostería">Repostería</option>
                            <option value="Panadería">Panadería</option>
                            <option value="Artículo">Artículo para fiesta</option>
                        </select>

                        <label>Categoría</label>
                    </div>

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
                    <input type="hidden" name="foto_guardada" value="<?php echo $foto; ?>" />
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="waves-effect waves-light btn" value="EDITAR PRODUCTO">
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

<?php

if (isset($_POST['enviar'])) {
    if ($comprobar == TRUE) {
?>
        <script>
            function actualizar() {
                swal({
                        title: "Oops! Algo salió mal",
                        text: "Intentalo de nuevo mas tarde",
                        icon: "error",
                        dangerMode: true,
                    })
                    .then(function() {
                        window.location = "editar_producto.php";
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
                        text: "¿Estás seguro de actualizar este producto?",
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
                            swal("Producto actualizado exitosamente", {
                                icon: "success",
                            }).then(function() {
                                window.location = "editar_producto.php";
                            });
                        } else {
                            swal("El producto no se ha actualizado");
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