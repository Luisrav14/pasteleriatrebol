<?php

    include("conexion.php");

    $id = $_REQUEST['id'];

    $eli = $conn->query("DELETE FROM dudas_sugerencias WHERE id_comentario = '$id'");

    if($eli){
        echo ".:: Registro Eliminado con éxto ::.";
        echo "<script>location.href='dudas_sugerencias'</script>";
    }else{
        echo ".:: Registro NO eliminado, por favor verifique... ::.";
    }


?>
