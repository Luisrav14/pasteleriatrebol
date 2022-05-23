<?php

include("empleados.php");

$id = $_GET['id'];

?>

<script>

function borrar() {
    swal({
            title: "Confirmar",
            text: "¿Estás seguro de eliminar este contacto?",
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
                swal("Contacto eliminado exitosamente", {
                        icon: "success",
                    })
                    .then(function() {
                        window.location = "eliminar_empleado.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El registro no se ha eliminado");
                window.location = "empleados.php";
            }
        });
}
borrar();
</script>
<?php 

?>