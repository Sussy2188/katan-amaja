<?php
/**
 * Contiene la pagina dashboard de Vinos del Mundo
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
    $_SESSION['title']= "Vinos del Mundo | Vinos de cafe";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/dashboard.css" />
<div class="dashboard">
<?php include 'componentes/dashboardNavBar.php'; ?>
    <div class="jumbotron transparent bg-hero hero-image pb-0 pt-5 mt-5">
        <div class="row align-items-end">
            <div class="align-self-strech col-lg-4 col-md-4 col-sm-5  logo">
            </div>
        </div>
        
    </div>
    <div class="jumbotron dark hero-menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-xs-12">
                </div>
                <div class="col-lg-5 col-xs-12">
                    <div class="list-group2 bg-dark">
                        <a href="catalogo.php" class="list-group-item list-group-item-action text-white bg-dark rounded-0">
                            <div class="float-left menu-imagen fas fa-wine-glass"></div>
                            <h4>Catalogo</h4>
                            <p>En esta seccion encontraras todos nuestros vinos, hechos especialmente para ti.</p>
                        </a>
                        <a href="historia" class="list-group-item list-group-item-action text-white bg-dark rounded-0">
                            <div class="float-left menu-imagen fas fa-coffee"></div>                        
                            <h4>Nuestra Historia</h4>
                            <p>Hacer vino es un privilegio increíble. Es algo que todos esperamos hacer todos los días. </p>
                        </a>
                        <a href="promociones" class="list-group-item list-group-item-action text-white bg-dark rounded-0">
                            <div class="float-left menu-imagen fas fa-piggy-bank"></div>
                            <h4>Promociones</h4>
                            <p>Encuentra las mejores promociones, hechas especialmente para ti.</p>
                        </a>
                        
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
    <div class="jumbotron hero-testimonio">
        <div class="fuid-container col-lg-2 col-md-4 col-sm-6 bg-dark p-3">
            <p>El protagonista de las mejores frases y citas sobre el café no es otro que el grano molido o sin moler. ¿Pero desde cuándo su aroma cautiva el paladar de quienes con su boca le regalan poesía?</p>
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
