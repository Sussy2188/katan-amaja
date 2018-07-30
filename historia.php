<?php
/**
 * Contiene la pagina dashboard de katan amaja
 *
 * @package Katan
 */
?>
<?php
    session_start();
    $username="usuario";
    if(isset($_SESSION['username'])){
        $username=$_SESSION['username'];
    } 
?>
<?php 
    $_SESSION['title']= "Katan Amaja | Vinos de cafe";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/historia.css" />
<div class="historia">
<?php include 'componentes/historiaNavBar.php'; ?>
    <div class="jumbotron transparent bg-hero">
        <div class="container">
        <img class="logo" src="img/logo-pagina-2.png" alt="Generic placeholder image">

   
  </div>
</div>
        
      
  
</div>

<?php include 'footer.php'; ?>
