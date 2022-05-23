<?php

include("dudas_sugerencias.php");

$id = $_GET['id'];

?>

<script>

function borrar() {
    swal({
            title: "Confirmar",
            text: "¿Estás seguro de eliminar este mensaje?",
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
                swal("Mensaje eliminado exitosamente", {
                        icon: "success",
                    })
                    .then(function() {
                        window.location = "eliminar_duda.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El mensaje no se ha eliminado");
                window.location = "dudas_sugerencias.php";
            }
        });
}
borrar();
</script>
<?php 

?>