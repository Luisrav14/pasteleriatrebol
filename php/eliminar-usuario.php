<?php

    include("conexion.php");

    $id = $_REQUEST['id'];

    $eli = $conn->query("DELETE FROM usuarios_pass WHERE ID = '$id'");

    if($eli){
        echo ".:: Registro Eliminado con éxto ::.";
        echo "<script>location.href='usuarios-admin.php'</script>";
    }else{
        echo ".:: Registro NO eliminado, por favor verifique... ::.";
    }


?>