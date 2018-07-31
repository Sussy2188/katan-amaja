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
<link rel="stylesheet" type="text/css" media="screen" href="css/dashboard.css" />
<div class="dashboard">
<?php include 'componentes/dashboardNavBar.php'; ?>
    <div class="jumbotron transparent bg-hero">
        <div class="container">
        <img class="logo" src="img/logo-pagina-2.png" alt="Generic placeholder image">
    </div>
    <div class="jumbotron dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img class="" src="img/icon/nueva_historia.png" alt="Generic placeholder image" width="146" height="180">
                    <h2>Nuestra Historia</h2>
                    <p>Hacer vino es un privilegio increíble. Es algo que todos esperamos hacer todos los días. </p>
                    <p><a class="btn btn-secondary" href="historia" role="button">leer mas »</a></p>
              </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="" src="img/icon/promociones.png" alt="Generic placeholder image" width="74" height="175">
                    <h2>Promociones</h2>
                    <p>Encuentra las mejores promociones, hechas especialmente para ti.</p>
                    <p><a class="btn btn-secondary" href="promociones" role="button">Ver promociones »</a></p>
              </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="" src="img/icon/catalogo.png" alt="Generic placeholder image" width="240" height="177">
                    <h2>Catalogo</h2>
                    <p>En esta seccion encontraras todos nuestros vinos, hechos especialmente para ti.</p>
                    <p><a class="btn btn-secondary" href="catalogo" role="button">Ver catalogo»</a></p>
              </div><!-- /.col-lg-4 -->
            </div>
        </div>
    </div>
    <div class="jumbotron transparent">
        <div class="container">
            <h1 class="display-3">Hello, world!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
        </div>
    </div>
    
    <div class="jumbotron dark">
    	<div class="container">
  <div class="row">
    <div class="col-sm informacion">
   <div> 
            	<h1>Direccion</h1>
            	<p>
                Suscribete para estar enterado de nuestras promociones 
            	</p>
            </div>
    </div>
    
    <div class="col-sm horarios">
      <div> 
            	<h1>Horarios</h1>
            	<p>
                Suscribete para estar enterado de nuestras promociones 
            	</p>
            </div>
    </div>
    
    <div class="col-sm suscripcion">
      <form action="">
        	<div> 
            	<h1>Suscribete</h1>
            	<p>
                Suscribete para estar enterado de nuestras promociones 
            	</p>
            </div>
            <input type="text" name="suscripcion" placeholder="email">
            <input type="button" value="suscribirme" id="suscripcion"
            
      </form>      
        
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
