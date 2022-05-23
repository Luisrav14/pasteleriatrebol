<?php

    include("conexion.php");

    $id = $_REQUEST['id'];

    $eli = $conn->query("DELETE FROM pedidos_especiales WHERE id_pedido = '$id'");

    if($eli){
        echo ".:: Registro Eliminado con éxto ::.";
        echo "<script>location.href='pedidos_especiales_admin'</script>";
    }else{
        echo "Pedido no eliminado";
    }


?>