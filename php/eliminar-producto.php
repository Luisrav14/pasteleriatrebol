<?php

    include("conexion.php");
    
    $id = $_GET["id"];

    $eli = $conn->query("DELETE FROM producto WHERE id_producto = '$id'");

    if($eli){
        echo "<script>location.href='productos-admin.php'</script>";
    }else{
        echo "Registro NO eliminado";
    }

?>

