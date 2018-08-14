<?php
/**
 * Contiene la pagina index de Vinos del Mundo
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
    $_SESSION['title']= "Bienvenido a Vinos del Mundo";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/cover.css" />
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include 'componentes/coverNavBar.php'; ?>
    <main role="main" class="inner cover">
    <img class="col-12 col-md-8 col-lg-8" src="img/vinos-del-mundo.png" alg="Vinos del Mundo" />
    <br/>
    <br/>
    <p class="lead">
    “Un buen vino es como una buena película: dura un instante y te deja en la boca un sabor a gloria; es nuevo en cada sorbo y, como ocurre con las películas, nace y renace en cada saboreador.” Federico Fellini.
    </p>
<br/>

    <p class="lead">
        <a href="login.php" class="btn btn-secondary">Iniciar Sesion</a>
        <a href="registrar.php" class="btn btn-secondary">Registrate</a>
    </p>
    </main>
    <?php include 'componentes/coverFootBar.php'; ?>
</div>
<?php include 'footer.php'; ?>
