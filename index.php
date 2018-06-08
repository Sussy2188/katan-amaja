<?php
/**
 * Contiene la pagina index de katan amaja
 *
 * @package Katan
 */
?>
<?php 
    session_start();
    /*  inicia sesion y redirige a index si no existe sesion */
    if(isset($_SESSION['username']))
        header('Location:dashboard.php');
?>
<?php 
    $_SESSION['title']= "Bienvenido a Katan Amaja";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/cover.css" />
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include 'componentes/coverNavBar.php'; ?>
    <main role="main" class="inner cover">
    <h1 class="cover-heading">Katan Amaja</h1>
    <h3 class="cover-heading">Vinos de cafe</h3>

    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
    <p class="lead">
        <a href="login.php" class="btn btn-secondary">Iniciar Sesion</a>
        <a href="registrar.php" class="btn btn-secondary">Registrate</a>
    </p>
    </main>
    <?php include 'componentes/coverFootBar.php'; ?>
</div>
<?php include 'footer.php'; ?>
