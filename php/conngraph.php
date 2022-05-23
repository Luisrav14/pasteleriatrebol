<?php

//Datos de conexión
$server = "localhost";
$user = "root";
$pass = "Root1";
$db = "1006416-22";

//Conexión a pasteleriatrebol.com
//$server = "192.185.131.131";
//$user = "pastel20_admin";
//$pass = "Admin123";
//$db = "pastel20_pasteleria_trebol";


//Estableciendo conexión (Método Orientado a Objetos)
$conex = new mysqli($server, $user, $pass, $db);

if ($conex->connect_error) {
    die("Conexion Fallida: " . $conex->connect_error);
}

//Consulta SQL
$sql = "SELECT * FROM genero_usuarios";

$result = $conex->query($sql);

if ($result->num_rows > 0) {

    // Buscando registros
    $final_array = array();
    while ($row = $result->fetch_assoc()) {

        $arr = array(
            'Genero' => $row['Género'],
            'Cantidad' => $row['Cantidad']
        );
        $final_array[] = $arr;
    }

    //Convirtiendo datos a formato JSON
    return json_encode($final_array);
} else {
    return "Error";
}
