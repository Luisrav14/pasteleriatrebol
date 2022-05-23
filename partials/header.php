<link rel="stylesheet" href="css/style.css">

<ul id="prd" class="dropdown-content">
    <li><a href="productos"><i class='material-icons'>menu_book</i>Productos</a></li>
    <li class="divider"></li>
    <li><a href="pedidos_especiales"><i class='material-icons'>cake</i>Pedidos especiales</a></li>
    <li class="divider"></li>
    <li><a href="galeria"><i class='material-icons'>collections</i>Galería</a></li>
</ul>

<ul id="ctc" class="dropdown-content">
    <li><a href="cont-suc-dys#redes-sociales"><i class='material-icons'>perm_device_information</i>Redes Sociales</a></li>
    <li class="divider"></li>
    <li><a href="cont-suc-dys#sucursales"><i class='material-icons'>store</i>Sucursales</a></li>
    <li class="divider"></li>
    <li><a href="cont-suc-dys#dys"><i class='material-icons'>comment</i>Dudas y Sugerencias</a></li>
</ul>

<?php

if (isset($_SESSION['user'])) {
    echo "<ul id='usr' class='dropdown-content'>";
    echo "<li><a href='user'><i class='material-icons'>account_box</i>Usuario</a></li>";
    echo "<li class='divider'></li>";
    echo "<li><a href='logout'><i class='material-icons'>logout</i>Cerrar Sesión</a></li>";
    echo "<li class='divider'></li>";
    echo "</ul>";
} else {
    echo "<ul id='usr' class='dropdown-content'>";
    echo "<li><a href='login'><i class='material-icons'>login</i>Inicia Sesión</a></li>";
    echo "<li class='divider'></li>";
    echo "<li><a href='signup'><i class='material-icons'>face</i>Registrarse</a></li>";
    echo "</ul>";
}

?>

<div class="navbar-fixed">
    <nav class="navgreen">
        <div class="nav-wrapper">
            <a href="../index.php">
                <img src="../img/trebol-icon-white.png" class="imgheader2">
                <a href="../index.php" class="brand-logo">Pastelería Trébol</a>
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<li class='bienvhead'>Bienvenido(a), " . $us . "</li>'";
                }
                ?>
                <li><a href="../index#nosotros">Nosotros</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="prd">Catálogo</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="ctc">Contacto</a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="usr"><i class="material-icons">account_circle</i></a></li>
            </ul>
        </div>
    </nav>
</div>

<ul class="sidenav" id="mobile-demo">
    <div class="titleside">
        <h2 class="titleside">Menú</h2>
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        echo "<li class='txtside' id='benv' href='index'>Bienvenido, $us </li>";
    }
    ?>
    <h2 class="subside">Secciones</h2>
    <li><a class="txtside" href="../index"><i class="material-icons">home</i>Inicio</a></li>
    <li><a class="txtside" href="../index#nosotros"><i class="material-icons">supervisor_account</i>Nosotros</a></li>
    <div class="divider"></div>
    <h2 class="subside2">Catálogo</h2>
    <li><a class="txtside" href="productos"><i class='material-icons'>menu_book</i>Productos</a></li>
    <li><a class="txtside" href="pedidos_especiales"><i class='material-icons'>cake</i>Pedidos especiales</a></li>
    <li><a class="txtside" href="galeria"><i class='material-icons'>collections</i>Galería</a></li>
    <div class="divider"></div>
    <h2 class="subside2">Contacto</h2>
    <li><a class="txtside" href="cont-suc-dys#redes-sociales"><i class='material-icons'>perm_device_information</i>Redes Sociales</a></li>
    <li><a class="txtside" href="cont-suc-dys#sucursales"><i class='material-icons'>store</i>Sucursales</a></li>
    <li><a class="txtside" href="cont-suc-dys#dys"><i class='material-icons'>comment</i>Dudas y Sugerencias</a></li>
    <div class="divider"></div>
    <h2 class="subside">Usuario</h2>
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<li><a class='txtside' href='login.php' title=''><i class='material-icons'>login</i>Inicia Sesión</a></li>";
        echo "<li><a class='txtside' href='signup.php' title=''><i class='material-icons'>face</i>Regístrate</a></li>";
    } else {
        echo "<li><a class='txtside' href='user.php' title=''><i class='material-icons'>account_circle</i>Usuario</a></li>";
        echo "<li><a class='txtside' href='logout.php' title=''><i class='material-icons'>login</i>Cerrar Sesión</a></li>";
    }
    ?>
</ul>