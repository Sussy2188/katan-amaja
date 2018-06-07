<?php
/**
 * Contiene la pagina login de katan amaja
 *
 * @package Katan
 */
?>
<?php 
    $_SESSION['title']= "Iniciar Sesion - Katan Amaja";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/cover.css" />
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include 'componentes/coverNavBar.php'; ?>
    <main role="main" class="inner cover">
        <form class="form-signin login-form">
            <h1 class="cover-heading">Katan Amaja</h1>
            <h3 class="cover-heading">Login</h3>
            <br/>
            <p>
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">    
            </p>
            <p>
                No estas registrado? <a href="registrar.php" class="">Registrate aqui</a>                
            </p>
            <button type="submit" class="btn btn-outline-primary btn-block btn-main">Iniciar Sesion</button>
            <a href="index.php" class="btn btn-outline-danger btn-block btn-cancel">Cancelar</a>
        </form>
    </main>
    <?php include 'componentes/coverFootBar.php'; ?>
</div>
<?php include 'footer.php'; ?>
