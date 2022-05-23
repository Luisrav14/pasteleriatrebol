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

$json_data = include('conngraph.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista General | Pastelería Trébol</title>
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

  <?php require_once('../partials/sidenavapp.php');
  require_once('../partials/headerapp.php');
  include('conexion.php'); ?>

  <div class="content">

    <div class="main">


      <div class="containerimg">
        <img src="../img/titlecover2.png" alt="" class="imgtitle">
        <div class="txtcenter">Vista general</div>
      </div>

      <div class="center-align">

        <br> <a class="waves-effect waves-light btn" href="../index"><i class="material-icons left">web</i>IR AL SITIO WEB</a>
        <br>
        <br>
      </div>


      <div class="info row">

        <div class="col s12 m7">
          <div class="card">
            <div class="card-content">
              <h3>Pedidos</h3>
              <?php
                           require_once 'conexion.php';
                $sql = "SELECT COUNT(*) total FROM pedidos_especiales";
                          $result = mysqli_query($conn, $sql);
                          $fila = mysqli_fetch_assoc($result);
                          echo '<h4> ' . $fila['total']; 
              ?>
            </div>
            <div class="card-action">
              <a href="pedidos_especiales_admin">Ver Pedidos</a>
            </div>
          </div>
        </div>

        <div class="col s12 m7">
          <div class="card">
            <div class="card-content">
              <h3>Usuarios</h3>
              <?php
              require_once 'conexion.php';
              $sql = "SELECT COUNT(*) total FROM usuarios_pass";
              $result = mysqli_query($conn, $sql);
              $fila = mysqli_fetch_assoc($result);
              echo '<h4> ' . $fila['total'];
              ?>
            </div>
            <div class="card-action">
              <a href="usuarios-admin">Ver Usuarios</a>
            </div>
          </div>
        </div>

        <div class="col s12 m7">
          <div class="card">
            <div class="card-content">
              <h3>Comentarios</h3>
              <?php
              require_once 'conexion.php';
              $con = "SELECT COUNT(*) total FROM dudas_sugerencias";
              $result = mysqli_query($conn, $con);
              $fila = mysqli_fetch_assoc($result);
              echo '<h4> ' . $fila['total'];
              ?>
            </div>
            <div class="card-action">
              <a href="dudas_sugerencias">Ver Comentarios</a>
            </div>
          </div>
        </div>
      </div>
<!--
      <div class="contenedor-graficas">
        <h3>Usuarios</h3>
        <div class="grafica" id="chartdiv"></div>
      </div>
-->


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
      </script>
      <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
      <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
      <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
        function am4themes_myTheme(target) {
          if (target instanceof am4core.ColorSet) {
            target.list = [
              am4core.color("#1c92d8"),
              am4core.color("#f06c6b"),
              am4core.color("#fca903")
            ];
          }
        }

        am4core.ready(function() {

          // Themes begin
          am4core.useTheme(am4themes_animated);
          am4core.useTheme(am4themes_myTheme);
          // Themes end

          var chart = am4core.create("chartdiv", am4charts.PieChart);
          chart.hiddenState.properties.opacity = 0;

          chart.data = <?= $json_data ?>;

          chart.radius = am4core.percent(100);
          chart.innerRadius = am4core.percent(40);
          chart.startAngle = 180;
          chart.endAngle = 360;

          var series = chart.series.push(new am4charts.PieSeries());
          series.dataFields.value = "Cantidad";
          series.dataFields.category = "Genero";

          series.slices.template.cornerRadius = 10;
          series.slices.template.innerCornerRadius = 7;
          series.slices.template.draggable = true;
          series.slices.template.inert = true;
          series.alignLabels = false;

          series.hiddenState.properties.startAngle = 90;
          series.hiddenState.properties.endAngle = 90;

          chart.legend = new am4charts.Legend();

        }); // end am4core.ready()
      </script>

</body>

</html>