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

require_once("conexion.php");

$sql = "SELECT nombre, apellidos, genero, telefono, correo_electronico, AES_DECRYPT(UNHEX(password), 'pwd') AS password, privilegio FROM usuarios_pass WHERE ID = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {

    mysqli_stmt_bind_param($stmt, "i", $param_id);

    $param_id = trim($id);

    if (mysqli_stmt_execute($stmt)) {

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $genero = $row["genero"];
            $telefono = $row["telefono"];
            $correo = $row["correo_electronico"];
            $contraseña = $row["password"];
            $privilegio = $row["privilegio"];
        }
    } else {
        echo "Error";
    }
    mysqli_stmt_close($stmt);
} else {
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Usuario | Pastelería Trébol</title>
    <link rel="icon" href="../img/trebol-icon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/catalogo.css">
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
    <div class="arribabtn">
        <a id="button" class="icon-chevron-up"></a>
    </div>
    <!-- Facebook Messenger Script (Es necesario que vaya aquí) -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="221230121235233" theme_color="#0084ff" logged_in_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje." logged_out_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje.">
    </div>

    <div class="ctrls">
        <div id="WAButton"></div>
    </div>

    <?php

    require_once("../partials/header.php");

    ?>

    <div class="containerimg">
        <img src="../img/titlecover2.png" alt="" class="imgtitle">
        <div class="txtcenter">Usuario <?php echo $us ?></div>
    </div>

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#test1">Información de Usuario</a></li>
                <li class="tab col s3"><a href="#test2">Mis pedidos especiales</a></li>
            </ul>
        </div>

        <div id="test1" class="col s12">
            <div class="cont-infous">
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $nombre ?>">
                        <label for="icon_prefix">Nombre(s)</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">supervised_user_circle</i>
                        <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $apellidos ?>">
                        <label for="icon_prefix">Apellidos</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">wc</i>
                        <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $genero ?>">
                        <label for="icon_prefix">Género</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">call</i>
                        <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $telefono ?>">
                        <label for="icon_prefix">Teléfono</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">mail</i>
                        <input readonly id="icon_prefix" type="text" class="#" value="<?php echo $correo ?>">
                        <label for="icon_prefix">Correo Electrónico</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">dialpad</i>
                        <input readonly id="passw" type="password" class="#" value="<?php echo $contraseña ?>">
                        <label for="passw">Contraseña</label>
                    </div>
                    <?php
                    if ($priv == "administrador" || $priv == "estandar") {
                        echo "<div class='input-field col s6'>";
                        echo "<i class='material-icons prefix'>stars</i>";
                        echo "<input readonly id='icon_prefix' type='text' class='#' value=' $privilegio '>";
                        echo "<label for='icon_prefix'>Privilegio</label>";
                        echo "</div>";
                    }
                    ?>
                    <div class="center-align">
                        <a class="waves-effect waves-light btn" href="editar_pass-user?id=<?php echo $id ?>"><i class="material-icons left">dialpad</i>CAMBIAR CONTRASEÑA</a>
                        <?php
                        if ($priv == "administrador" || $priv == "estandar") {
                        echo "<a class='waves-effect waves-light btn' href='indexapp'><i class='material-icons left'>settings_applications</i>IR A APLICACIÓN WEB</a>";

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="test2" class="col s12">

            <div class="center-align" id="btncrear">
                <a class="waves-effect waves-light btn" href="form-pedido"><i class="material-icons left">cake</i>Realizar un pedido especial</a>
            </div>

            <?php
            require_once("conexion.php");

            $consulta = "SELECT * FROM pedidos_especiales WHERE usuario = $id";
            if ($result = mysqli_query($conn, $consulta)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='cont-tablape'>";
                    echo "<table class='responsive-table striped centered' id='pedidosesp'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th># Pedido</th>";
                    echo "<th>Descipción</th>";
                    echo "<th>Fecha para pedido</th>";
                    echo "<th>Imagen de Referencia</th>";
                    echo "<th>Estado</th>";
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pedido'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
            ?>
                        <td class="imgpe"> <?php echo "<img class='materialboxed' id='imgped' width='100' src='../img/pe/" . $row['imagen'] .  "'/> " ?></td>
            <?php
                        echo "<td class='estado'>" . $row['estado'] . "</td>";
                        echo "<td><a class='borrar' href='conf-elim-pedido?id=" . $row['id_pedido'] . " title='Borrar'><span class='icon-trash'></span></a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p class='txtno'>No tienes ningún pedido especial, ¡haz uno ahora!</p>";
                }
            } else {
                echo "ERROR: Could not able to execute $consulta. " . mysqli_error($conn);
            }

            mysqli_close($conn);

            ?>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/app.js"></script>
    <script>
        var btn = $('#button');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.materialboxed').materialbox();
        });
    </script>
    <script>
        $(function() {
            $('#WAButton').floatingWhatsApp({
                phone: '5216181444494', //Número de telefono (Con prefijo 521 para México)
                headerTitle: '¡Envíanos un mensaje!', //Título de la ventana
                popupMessage: 'Hola, ¿cómo podemos ayudarte?', //Mensaje de la ventana
                showPopup: true, //Permite que esté visible el botón flotante
                buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" class="imgpop" />', //Button Image
                position: "right"
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.tabs').tabs();
        });

        $(document).ready(function() {
            $('select').formSelect();
        });
    </script>
</body>

</html>