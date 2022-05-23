<?php

    include("conexion.php");
    
    $id = $_GET["id"];

    $eli = $conn->query("DELETE FROM galeria WHERE id_foto = '$id'");

    if($eli){
        echo "<script>location.href='galeria-admin.php'</script>";
    }else{
        echo "<script>location.href='galeria-admin.php'</script>";
        echo "<script> alert('Registro NO eliminado');</script>";
        
    }
?>