<?php

session_start();
if (!isset($_SESSION['user'])) {
} else {
    $us = $_SESSION['user'];
    $ps = $_SESSION['pass'];
    $priv = $_SESSION['priv'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta charset="UTF-8">
  <title>Productos | Pastelería Trébol</title>
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
    <div class="txtcenter">Productos</div>
  </div>

  <div id="myBtnContainer" class="center-align contbtnspr">
    <button class="waves-effect waves-light btn active" id="btncit" onclick="filterSelection('all')">Mostrar todo</button>
    <button class="waves-effect waves-light btn" id="btncit" onclick="filterSelection('Pastel')">Pasteles</button>
    <button class="waves-effect waves-light btn" id="btncit" onclick="filterSelection('Pay')">Pays</button>
    <button class="waves-effect waves-light btn" id="btncit" onclick="filterSelection('Repostería')">Repostería</button>
    <button class="waves-effect waves-light btn" id="btncit" onclick="filterSelection('Panadería')">Panadería</button>
    <button class="waves-effect waves-light btn" id="btncit" onclick="filterSelection('Artículo')">Artículos para fiesta</button>
  </div>

  <?php

  require_once("conexion.php");

  $sql = "SELECT * FROM producto";
  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {

      echo '<div class="container">';

      while ($row = mysqli_fetch_array($result)) {

        $nombre = $row['nombre'];
        $stripped = trim(preg_replace('/20/', '20', $nombre));

        echo "<div class='item " . $row['tipo'] . "'>";
        echo "<img src='../img/" . $row["foto"] . "' alt='' class='item-img'>";
        echo '<div class="item-text">';
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p class='descpr'>" . $row['descripcion'] . "</p>";
        echo "<p class='precio'>$" . $row['precio'] . ".00 MXN</p>";
        echo "<div class='contwp'>";
        echo "<a class='enlacewp' href='https://wa.me/526181444494?text=¡Hola!%20me%20interesa%20comprar%20" . $stripped .".' target='_blank'><span class='icon-whatsapp'></span> Ordenar por WhatsApp</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }

      echo '</div>';
    }
  }

  ?>

  <?php
  require_once("../partials/footerphp.php");
  ?>

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
    filterSelection("all")

    function filterSelection(c) {
      var x, i;
      x = document.getElementsByClassName("item");
      if (c == "all") c = "";
      for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
      }
    }

    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }

    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }


    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }
  </script>
</body>

</html>