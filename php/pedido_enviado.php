<?php

    include("conexion.php");

    $id = $_REQUEST['id'];

    $lei = $conn->query("UPDATE pedidos_especiales SET estado = 'Enviado' WHERE id_pedido = '$id'");

    if($lei){
        header("location: ver_pedido?id=$id");
    }else{
        echo "Pedido no eliminado";
    }


?>