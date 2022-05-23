<?php
session_start();

$comprobar = FALSE;

if (isset($_SESSION['user'])) {
  header("location: ../index");
}

$mail_err = $pass_err = $general_err = "";

require_once("environment.php");

  $site_key = $_ENV['SITE_KEY'];
  $secret_key = $_ENV['SECRET_KEY'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $us = $_POST['login'];
  $ps = $_POST['password'];

  require_once("conexion.php");

  if (empty($_POST['login'])) {
    $mail_err = "Por favor, ingresa el correo electrónico";
  } else {
    $general_err = "El usuario y/o contraseña no coiniciden";
  }

  if (empty($_POST['password'])) {
    $pass_err = "Por favor, ingresa la contraseña";
  } else {
    $general_err = "El usuario y/o contraseña no coiniciden";
  }


  if (empty($mail_err) && empty($pass_err)) {
    $consulta = "SELECT ID, nombre, AES_DECRYPT(UNHEX(password), 'pwd'), privilegio FROM usuarios_pass WHERE correo_electronico='$us' AND AES_DECRYPT(UNHEX(password), 'pwd')='$ps'";

    //ejecutar la consulta
    $query = mysqli_query($conn, $consulta) or die("Error al ejecutar la consulta");

    if ($row = mysqli_fetch_array($query)) {
      $priv = $row['privilegio'];
      $nom = $row['nombre'];
      $id = $row['ID'];
      $ps = $row['password'];
    }

    if (mysqli_num_rows($query) > 0) {
      session_start();
      $_SESSION['user'] = $nom;
      $_SESSION['pass'] = $ps;
      $_SESSION['priv'] = $priv;
      $_SESSION['id'] = $id;



      if ($priv == "administrador") {
        $_SESSION['priv'] = "administrador";
        header('location: indexapp.php');
      } else if ($priv == "estandar") {
        $_SESSION['priv'] = "estandar";
        header('location: indexapp.php');
      } else if ($priv == "cliente") {
        $_SESSION['priv'] = "cliente";
        header('location: ../index.php');
      }
    }
  } else {

    $comprobar = TRUE;
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión | Pastelería Trébol</title>
  <link rel="icon" href="../img/trebol-icon.ico">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Zilla Slab' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Poppins:ital,wght@0,200;0,300;0,600;0,800;1,600&family=Sacramento&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
  <script>

  </script>

  <!-- Your Chat Plugin code -->
  <div class="fb-customerchat" attribution=setup_tool page_id="221230121235233" theme_color="#0084ff" logged_in_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje." logged_out_greeting="Hola, ¡gracias por contactarnos!, en breve responderemos tu mensaje.">
  </div>

  <div class="ctrls">
    <div id="WAButton"></div>
  </div>


  <?php
  $site_key = $_ENV['SITE_KEY'];
  $secret_key = $_ENV['SECRET_KEY'];

  if (isset($_POST['submit'])) {
    $response = $_POST['g-recaptcha-response'];
    $payload = file_get_contents('https://www.google.com/recaptcha/api/siteverify?
        secret=' . $secret_key . '&response=' . $response);
    $result = json_decode($payload, TRUE);
    if ($result['success'] != 1) {
      return false;
    }
  }
  ?>


  <section class="section-login">

    <?php
    require_once("../partials/header.php");
    ?>




    <?php if (!empty($message)) : ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <div class="cont-form">
      <div class="imagenlogo">
        <div class="containerimg">
          <img src="../img/grdnt.png" alt="" class="logologin">
          <div class="txtcenter2">INICIA SESIÓN</div>
        </div>
      </div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-field col s6">
          <i class="material-icons prefix">mail</i>
          <input id="us" type="email" name="login" required>
          <label for="us">Correo electrónico</label>
          <span class="msj-ayuda"><?php echo $mail_err; ?></span>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">dialpad</i>
          <input id="passw" type="password" name="password" required>
          <label for="passw">Contraseña</label>
          <span class="msj-ayuda"><?php echo $pass_err; ?></span>
          <div class="mostrarocultar">
            <label>
              <input type="checkbox" class="filled-in" onclick="contraseña()">
              <span class="mo">Mostrar Contraseña</span>
            </label>
          </div>
        </div>
        <p class="msj-ayuda2"><?php echo $general_err; ?></p>
        <div class="recaptcha" id="recap">
          <div class="g-recaptcha" data-callback="captchaVerified" data-expired-callback="captchaExpired" data-sitekey=<?php echo $site_key; ?>></div>
        </div>
        <div class="center-align">
          <input type="submit" name="enviar" value="ENTRAR" class="waves-effect waves-light btn" id="submit" disabled></td>
          <input type="reset" name="borrar" value="BORRAR" class="waves-effect waves-light btn" id="submit"></td>
        </div>
      </form>
      <div class="reg">
        <div class="center-align">
          <span class="msg1">¿Eres nuevo?<a class="msg" href="../php/signup.php">Regístrate</a>
        </div>
      </div>
    </div>

  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../js/app.js"></script>
  <script>
    // Verification function
    function captchaVerified() {
      var submitBtn = document.getElementById('submit');
      submitBtn.removeAttribute('disabled');
    }
    // reCAPTCHA Expired callback function
    function captchaExpired() {
      window.location.reload();
    }
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
</body>

</html>