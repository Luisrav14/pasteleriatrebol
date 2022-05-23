<?php

include("pedidos_especiales_admin.php");

$id = $_GET['id'];

?>

<script>

function borrar() {
    swal({
            title: "Confirmar",
            text: "¿Estás seguro de eliminar este pedido?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancelar",
                    visible: true
                },
                confirm: {
                    text: "Eliminar"
                },
            },
            dangerMode: true,
        })
        .then((borrar) => {
            if (borrar) {
                swal("Pedido eliminado exitosamente", {
                        icon: "success",
                    })
                    .then(function() {
                        window.location = "eliminar_pedido2.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El producto no se ha eliminado");
                window.location = "pedidos_especiales_admin.php";
            }
        });
}
borrar();
</script>
<?php 

?>