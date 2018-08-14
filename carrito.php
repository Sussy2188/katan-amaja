<?php 

?>
<?php
    session_start();
    $username="usuario";
    if(isset($_SESSION['username'])){
        $username=$_SESSION['username'];
    } 
    $id_productos=array();
    $counter="";
    $prodCounter=0;
    if(isset($_SESSION['shopping_cart'])){
        //obtiene el siguiente indice donde se agregaran los productos
        $counter=count($_SESSION['shopping_cart']);

        //crea el arreglo secuencial para los indices y los ids de productos 
        $id_productos= array_column($_SESSION['shopping_cart'], 'id');
    }

    //aqui se maneja cuando se desea eliminar un articulo de la carreta de compras
    if(filter_input(INPUT_GET,'action') == 'delete'){
        //buscar el producto en el arreglo de productos
        foreach($_SESSION['shopping_cart'] as $key => $product){
            if($product['id'] == filter_input(INPUT_GET,'id')){
                //elimina el producto cuando lo encuentra en el array
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
        //resetear el arreglo de productos para que corresponda a los productos
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
?>

<?php 
    $_SESSION['title']= "Carrito de compras | Vinos del Mundo ";
?>

<?php 
    require("tools/conexion.php");
    $queryProductos = mysqli_query($acceso, "SELECT * FROM productos WHERE activo=1 ORDER by id ASC");
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/dashboard.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/catalogo.css" />
<div class="dashboard pt-5">
    <?php include 'componentes/dashboardNavBar.php'; ?>
    <div class="container">
        <div class=" catalogo col-md-12 mt-5">
        <nav class="navbar navbar-dark bg-dark mb-3">
            <a class="navbar-brand">
            Carrito de compras
            </a>
        </nav>
    </div>
    <div class="container bg-dark pl-2 pr-2 pt-4 pb-4">
        <div class="row ">
            <div class="col-md-8 text-white">
                <?php 
                    if ($counter>0):
                        $subtotal=0;
                        if(isset($_SESSION['shopping_cart'])){
                            foreach($_SESSION['shopping_cart'] as $key => $product){
                                $subtotal= $subtotal +($product['quantity'] * $product['price']);
                            }
                        }
                ?>
                <div class="cart-body">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th class="p-1 border-bottom-0" scope="col">PRODUCTO</th>
                            <th class="p-1 border-bottom-0 d-none d-md-block" scope="col">PRECIO</th>
                            <th class="p-1 border-bottom-0" scope="col">CANTIDAD</th>
                            <th class="p-1 border-bottom-0" scope="col">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php 
                                if(isset($_SESSION['shopping_cart'])):
                                    foreach($_SESSION['shopping_cart'] as $key => $product):
                            ?>
                                <td class="p-1">
                                <div class="card flex-row text-white bg-transparent rounded-0 border-0" style="opacity:0.75" >
                                    <img class="card-img-left align-self-center" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [100x125]" style=" height: 80px;" src="<?php echo $product['imagen']?>" data-holder-rendered="true">
                                    <div class="card-body position-relative p-1">
                                        <p class="card-subtitle mb-2"> <?php echo $product['name']?></p>
                                        <a href="carrito.php?action=delete&id=<?php echo $product['id']?>" class="text-danger ">Eliminar</a>
                                    </div>
                                </div>
                                </td>
                                <td class="p-1 d-none d-md-block">Q.<?php echo $product['price']?></td>
                                <td class="p-1">
                                    <?php 
                                        echo $product['quantity'];
                                        $prodCounter=$prodCounter+$product['quantity'];
                                    ?>
                                </td>
                                <td class="p-1"><b class="text-danger"><?php echo $product['quantity']*$product['price']?></b></td>
                            </tr>
                            <?php 
                                    endforeach;
                                endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                else:
                ?>
                <div class="col-12 text-center mt-3 mb-3"> 
                    <h4 class="card-title">No tienes productos en el carrito</h4>
                    <a href="catalogo.php" class="btn btn-primary">Volver al carrito</a>
                </div>
                <?php
                endif;
                ?>
            </div>
            <div class="col-md-4 text-white">
                <div class="cart_totals ">
                    <table cellspacing="0"  class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th class="product-name" colspan="2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="cart-subtotal">
                            <th>Productos</th>
                            <td data-title="Subtotal"><span class="text-center"><span class="woocommerce-Price-currencySymbol"></span><?php echo $prodCounter; ?></span></td>
                        </tr>
                        <tr class="order-total">
                            <th>Total</th>
                            <td data-title="Total"><strong><span class=""><span class="woocommerce-Price-currencySymbol">Q</span><?php echo $subtotal; ?></span></strong> </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="wc-proceed-to-checkout">
                    <a href="catalogo.php?action=pagar" class="btn btn-primary btn-block"> Realizar Pedido</a></div>
                    <a href="catalogo.php" class="btn btn-block btn-cancel">Seguir Comprando</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
