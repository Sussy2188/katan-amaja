<?php
/**
 * Sidebar
 *
 * @package Katan
 */
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Katan Amaja</h3>
        <p>Administrador</p>
    </div>
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false"><?php echo $username; ?></a>
            <ul class="collapse list-unstyled" id="userSubmenu">
                <li><a href='perfil.php?username='>Ver Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesion</a></li>
            </ul>
        </li>
    </ul>
    <ul class="list-unstyled components">
        <li>
            <a href="admin.php">Dashboard</a>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="#">Home 1</a></li>
                <li><a href="#">Home 2</a></li>
                <li><a href="#">Home 3</a></li>
            </ul>
        </li>
        <li>
            
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Portfolio</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>

   
</nav>