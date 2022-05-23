<?php

include("productos-admin.php");

$id = $_GET['id'];

?>

<script>

function borrar() {
    swal({
            title: "Confirmar",
            text: "¿Estás seguro de eliminar este producto?",
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
                swal("Producto eliminado exitosamente", {
                        icon: "success",
                    })
                    .then(function() {
                        window.location = "eliminar-producto.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El producto no se ha eliminado");
                window.location = "productos-admin.php";
            }
        });
}
borrar();
</script>
<?php 

?>