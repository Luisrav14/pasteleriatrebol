<?php

    include("conexion.php");

    $id = $_GET['id'];

    $eli = $conn->query("DELETE FROM sucursal WHERE id_sucursal = '$id'");

    if($eli){        
        echo "<script>location.href='sucursales-admin.php'
                alert('Registro eliminado');
        </script>";
    }else{
        echo "Pedido no eliminado";
    }


?>