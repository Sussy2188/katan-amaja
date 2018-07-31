<?php
/**
 * Contiene la barra de navegacion para la pagina de dashboard
 * 
 * @package Katan
 */
?>
<?php
    $privilegio=99;
    if (isset($_SESSION['privilegio'])) {
        $privilegio=$_SESSION['privilegio'];
    }
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">KATAN AMAJA</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <?php
                switch ($privilegio) {
                    case 1:
                        echo ('
                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Productos</a>
                        </li>
                        ');
                        break;
                    case 2:
                        echo ('
                        <li class="nav-item">
                            <a class="nav-link" href="catalogo.php">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Carrito</a>
                        </li>
                        ');
                        break;
                    default:
                        break;
                }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="contactenos.php">Contactenos</a>
            </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle user-dropdown" href="usuario" id="usuarioDD" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo $username; ?>
                    </a>
                    <div class="dropdown-menu " aria-labelledby="usuarioDD">
                        <a class="dropdown-item" href='perfil.php?username='>Ver Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>