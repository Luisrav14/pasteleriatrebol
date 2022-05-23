<?php

include("usuarios-admin.php");

$id = $_GET['id'];

?>

<script>

function borrar() {
    swal({
            title: "Confirmar",
            text: "¿Estás seguro de eliminar este usuario?",
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
                swal("Usuario eliminado exitosamente", {
                        icon: "success",
                    })
                    .then(function() {
                        window.location = "eliminar-usuario.php?id=<?php echo $id; ?>"
                    });
            } else {
                swal("El usuario no se ha eliminado");
                window.location = "usuarios-admin.php";
            }
        });
}
borrar();
</script>
<?php 

?>