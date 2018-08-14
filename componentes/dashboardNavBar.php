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
    $cartCounter="";
    if(isset($_SESSION['shopping_cart'])){
        //obtiene el siguiente indice donde se agregaran los productos
        $cartCounter=count($_SESSION['shopping_cart']);
    }

?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-navbar">
    <div class="container">
        <a class="navbar-brand katan-logo" href="dashboard.php"></a>
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
                            <a class="nav-link" href="catalogo.php">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="carrito.php">Carrito</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Sitio de Administrador</a>
                        </li>
                        ');
                        break;
                    case 2:
                        echo ('
                        <li class="nav-item">
                            <a class="nav-link" href="catalogo.php">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="carrito.php">Carrito</a>
                        </li>
                        ');
                        break;
                    default:
                        break;
                }
            ?>
            </ul>
            <ul class="navbar-nav mt-2 mt-md-0">
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle user-dropdown" href="usuario" id="usuarioDD" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo $username; ?>
                    </a>
                    <div class="dropdown-menu " aria-labelledby="usuarioDD">
                        <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
                    </div>
                </li>
                <li class="nav-item" >
                    <a href="#" class="nav-link fas fa-shopping-cart active mt-1" data-toggle="modal" data-target="#cartModal">
                        <span class="mt-1"><?php echo $cartCounter; ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade " id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content  bg-secondary ">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalTitle">Carrito de Compras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'cartbody.php'; ?>
      </div>
      <div class="modal-footer">
        <a href="carrito.php" class="btn btn-success">Ver Carrito</a>
        <a href="catalogo.php?action=pagar" class="btn btn-primary">Realizar pedido</a>
      </div>
    </div>
  </div>
</div>