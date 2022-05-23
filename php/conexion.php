<?php

// Conexión a servidor local
$server = "localhost";
$user = "root";
$pass = "Root1";
$db = "1006416-22";

//Conexión a pasteleriatrebol.com
//$server = "192.185.131.131";
//$user = "pastel20_admin";
//$pass = "Admin123";
//$db = "pastel20_pasteleria_trebol";



//Creando conexión
$conn = new mysqli($server, $user, $pass, $db);

//Revisando conexión
if ($conn->connect_error) {
  die("Connexión Fallida: " . $conn->connect_error);
}
