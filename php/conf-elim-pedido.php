<?php

include("user.php");

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
                        window.location = "eliminar_pedido.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El producto no se ha eliminado");
                window.location = "user.php";
            }
        });
}
borrar();
</script>
<?php 

?>