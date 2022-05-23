//Inicialización de filtrado de tablas y cambio de idioma a español
$(document).ready(function() {
    $('#empleados').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay registros, añade un empleado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Campo vacío o no encontrado",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        }
    });
});

$(document).ready(function() {
    $('#pedidosesp').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay registros, añade un pedido",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Campo vacío o no encontrado",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        }
    });
});

$(document).ready(function() {
    $('#dys').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Campo vacío o no encontrado",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        }
    });
});

$(document).ready(function() {
    $('#productos').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No hay registros, añade un producto",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Campo vacío o no encontrado",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        }
    });
});


//Funciones de copiar y pegar información en app web
function copiarnom() {
    var textCopiado = document.getElementById("nom");
    textCopiado.select();
    textCopiado.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var mensajecopy = document.getElementById("copymensaje");
    mensajecopy.innerHTML = "Texto copiado: " + textCopiado.value;
}

function outNom() {
    var mensajecopy = document.getElementById("copymensaje");
    mensajecopy.innerHTML = "Copiar al portapapeles";
}

function copiarape() {
    var textCopiado2 = document.getElementById("ape");
    textCopiado2.select();
    textCopiado2.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var mensajecopy2 = document.getElementById("copymensaje2");
    mensajecopy2.innerHTML = "Texto copiado: " + textCopiado2.value;
}

function outApe() {
    var mensajecopy2 = document.getElementById("copymensaje2");
    mensajecopy2.innerHTML = "Copiar al portapapeles";
}

function copiartel() {
    var textCopiado3 = document.getElementById("tel");
    textCopiado3.select();
    textCopiado3.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var mensajecopy3 = document.getElementById("copymensaje3");
    mensajecopy3.innerHTML = "Texto copiado: " + textCopiado3.value;
}

function outTel() {
    var mensajecopy3 = document.getElementById("copymensaje3");
    mensajecopy3.innerHTML = "Copiar al portapapeles";
}

function copiarmail() {
    var textCopiado4 = document.getElementById("email");
    textCopiado4.select();
    textCopiado4.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var mensajecopy4 = document.getElementById("copymensaje4");
    mensajecopy4.innerHTML = "Texto copiado: " + textCopiado4.value;
}

function outMail() {
    var mensajecopy4 = document.getElementById("copymensaje4");
    mensajecopy4.innerHTML = "Copiar al portapapeles";
}

function copiarsuc() {
    var textCopiado5 = document.getElementById("suc");
    textCopiado5.select();
    textCopiado5.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var mensajecopy5 = document.getElementById("copymensaje5");
    mensajecopy5.innerHTML = "Texto copiado: " + textCopiado5.value;
}

function outSuc() {
    var mensajecopy5 = document.getElementById("copymensaje5");
    mensajecopy5.innerHTML = "Copiar al portapapeles";
}

$('#consultar').click(function() {
    var userid = $(this).data('id_empleado'); // AJAX request 
    $.ajax({
        url: 'crud/consulta.php',
        type: 'get',
        data: { userid: userid },
        success: function(response) { // Add response in Modal body 
            $('#modalactions').html(response); // Display Modal 
            $('#modalactions').modal('show');
        }
    });
});

//Carousel 
$(document).ready(function() {
    $('.carousel').carousel({
        indicators: true
    });

    autoplay();

    function autoplay() {
        $('.carousel').carousel('next');
        setTimeout(autoplay, 5000);
    }
});

$(".dropdown-trigger").dropdown();

$(document).ready(function() {
    $('.sidenav').sidenav();
});

//Sticky Navbar


var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

//Botón flotante WhatsApp
$(function() {
    $('#WAButton').floatingWhatsApp({
        phone: '5216181444494', //Número de telefono (Con prefijo 521 para México)
        headerTitle: '¡Envíanos un mensaje!', //Título de la ventana
        popupMessage: 'Hola, ¿cómo podemos ayudarte?', //Mensaje de la ventana
        showPopup: true, //Permite que esté visible el botón flotante
        buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" class="imgpop" />', //Button Image
        position: "right"
    });
});

//Parallax 
$(document).ready(function() {
    $('.parallax').parallax();
});

// Mostrar/Ocultar contraseña en login
function contraseña() {
    var x = document.getElementById("passw");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//Select
$(document).ready(function() {
    $('select').formSelect();
});

//Text Area
$('#textarea1').val('New Text');
M.textareaAutoResize($('#textarea1'));