<?php

    include("conexion.php");

    $id = $_REQUEST['id'];

    $eli = $conn->query("DELETE FROM empleado WHERE id_empleado = '$id'");

    if($eli){
        echo ".:: Registro Eliminado con éxto ::.";
        echo "<script>location.href='empleados.php'</script>";
    }else{
        echo ".:: Registro NO eliminado, por favor verifique... ::.";
    }


?>
