<?php
/**
 * Contiene la barra de navegacion para la pagina de dashboard
 * 
 * @package Katan
 */
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">KATAN AMAJA</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactenos">Contactenos</a>
            </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle user-dropdown" href="usuario" id="usuarioDD" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        warroyo33
                    </a>
                    <div class="dropdown-menu show" aria-labelledby="usuarioDD">
                        <a class="dropdown-item" href="user-profile.php">Ver Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>