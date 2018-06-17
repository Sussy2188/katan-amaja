<?php
/**
 * Sidebar
 *
 * @package Katan
 */
?>
<?php
    $dashboardActive="";
    if(isset($_SESSION['dashboardActive'])){ 
        $dashboardActive='active';
    } 
    $usersActive="";
    if (isset($_SESSION['usersActive'])) {
        $usersActive='active';
    }
    
    unset($_SESSION['dashboardActive']);
    unset($_SESSION['usersActive']);
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Katan Amaja</h3>
        <p>Administrador</p>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false"><?php echo $username; ?></a>
            <ul class="collapse list-unstyled" id="userSubmenu">
                <li><a href='perfil.php?username='>Ver Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesion</a></li>
            </ul>
        </li>
    </ul>
    <ul class="list-unstyled components">
        <li class="<?php echo $dashboardActive; ?>">
            <a href="admin.php">Dashboard</a>
        </li>
        <li class="<?php echo $usersActive; ?>">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Usuarios</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="listadoUsuarios.php">Lista de usuarios</a></li>
                <li><a href="agregarUsuario.php">Agregar Usuario</a></li>
            </ul>
        </li>
        <li>
            
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Productos</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="#">Lista de productos</a></li>
                <li><a href="#">Agregar producto</a></li>
                <li><a href="#">Modificar producto</a></li>
                <li><a href="#">Eliminar producto</a></li>
            </ul>
        </li>
    </ul>

   
</nav>