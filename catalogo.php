<!DOCTYPE html>
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

    $id_productos=array();
    //verificar si el boton de agregar al carrito fue presionado
    if (filter_input(INPUT_POST, 'add_to_cart')){
        if(isset($_SESSION['shopping_cart'])){
            //obtiene el siguiente indice donde se agregaran los productos
            $counter=count($_SESSION['shopping_cart']);

            //crea el arreglo secuencial para los indices y los ids de productos 
            $id_productos= array_column($_SESSION['shopping_cart'], 'id');

            //verifica que el producto no exista en el carrito
            if (!in_array(filter_input(INPUT_GET,'id'),$id_productos)){
                $_SESSION['shopping_cart'][$counter]= array
                (
                    'id' => filter_input(INPUT_GET,'id'),
                    'name' => filter_input(INPUT_POST,'name'),
                    'price' => filter_input(INPUT_POST,'price'),
                    'imagen' => filter_input(INPUT_POST,'imagen'),
                    'quantity' => filter_input(INPUT_POST,'quantity')
                );
            } else {// si el producto ya esta en el carrito solo aumenta la cantidad 
                //busca el producto en el arreglo secuencial de productos
                for ($i = 0; $i < count($id_productos); $i++) {
                    if($id_productos[$i]== filter_input(INPUT_GET, 'id')){
                        //aumenta la cantidad del producto que ya existe en el carrito
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                    }
                }
            }           
        } else {// si el carrito de compras no existe, entonces lo creamos con el primer producto
            // en el index 0, crear un arreglo usando la data enviada por el formulario 
            $_SESSION['shopping_cart'][0]= array
            (
                'id' => filter_input(INPUT_GET,'id'),
                'name' => filter_input(INPUT_POST,'name'),
                'price' => filter_input(INPUT_POST,'price'),
                'imagen' => filter_input(INPUT_POST,'imagen'),
                'quantity' => filter_input(INPUT_POST,'quantity')
            );
        }
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
    // borra el carrito de compras cuando presiona pagar
    if(filter_input(INPUT_GET,'action') == 'pagar'){
        unset($_SESSION['shopping_cart']);
    }
?>
<?php 
    $_SESSION['title']= "Catalogo de productos | Katan Amaja ";
?>

<?php 
    require("tools/conexion.php");
    $queryProductos = mysqli_query($acceso, "SELECT * FROM productos WHERE activo=1 ORDER by id ASC");
?>

<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/dashboard.css" />
<div class="dashboard pt-5">
    <?php include 'componentes/dashboardNavBar.php'; ?>
    <div class="row p-0 m-0" style="height:100%">
        <div class="container col-md-7 mt-5">

            <?php 
                if($queryProductos){
                    if(mysqli_num_rows($queryProductos)>0){
                        echo '<div class="row mb-2" style="overflow: auto;height: 97%;">';
                            while ($row=mysqli_fetch_assoc($queryProductos)) {
                                echo '<div class="col-md-6">
                                        <form method="post" action="catalogo.php?action=add&id='.$row['id'].'">
                                            <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                                <div class="card-body d-flex flex-column align-items-start">
                                                    <h3 class="mb-0">
                                                        <a class="text-dark" href="#">'.$row['nombre'].'</a>
                                                    </h3>
                                                    <p class="card-text mb-auto text-body">'.$row['descripcion'].'</p>
                                                    <div class="mb-1 row pl-3">
                                                        <input type="number" name="quantity" placeholder="cantidad" class="form-control col-3 mt-1 mb-1" value="1" /> 
                                                        <span class="text-muted col-7 pt-2">
                                                        x Q.'.$row['precio'].'
                                                        </span>
                                                    </div>
                                                    <input type="hidden" name="name" value="'.$row['nombre'].'" />
                                                    <input type="hidden" name="price" value="'.$row['precio'].'" />
                                                    <input type="hidden" name="imagen" value="'.$row['imagen'].'" />
                                                    <input type="submit" name="add_to_cart" class="btn btn-outline-primary btn-block" value="Agregar al Carrito" />
                                                </div>
                                                <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="'.$row['imagen'].'" data-holder-rendered="true">
                                            </div>
                                        </form>
                                    </div>';
                            }
                        echo '</div>';
                    }
                }
                
            ?>
        
        </div>
        <div class="col-md-3  text-white bg-secondary mb-3 ">
            <div class="card-header">
                Carrito de Compras
            </div>
            <div class="card-body">
                <?php 
                    $subtotal=0;
                    if(isset($_SESSION['shopping_cart'])){
                        foreach($_SESSION['shopping_cart'] as $key => $product){
                            $subtotal= $subtotal +($product['quantity'] * $product['price']);
                        }
                    }
                    
                    
                ?>
                <h5 class="card-title">Subtotal Q. <?php echo $subtotal; ?></h5>
                <a href="catalogo.php?action=pagar" class="btn btn-primary btn-block">Pagar la compra</a>
            </div>
            
                <?php 
                    if(isset($_SESSION['shopping_cart'])):
                        foreach($_SESSION['shopping_cart'] as $key => $product):
                ?>
                            <div class="card flex-md-row text-white bg-dark" style="opacity:0.75" >
                                <img class="card-img-left flex-auto d-none d-lg-block " data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [100x125]" style=" height: 125px;" src="<?php echo $product['imagen']?>" data-holder-rendered="true">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2"> <?php echo $product['name']?></h6>
                                    <p class="card-text"><small class="text-white-50"><?php echo $product['quantity']?> x Q.<?php echo $product['price']?> </small>= <b class="text-danger"><?php echo $product['quantity']*$product['price']?></b> </p>
                                    <a href="catalogo.php?action=delete&id=<?php echo $product['id']?>" class="btn btn-danger btn-block">Eliminar</a>
                                </div>
                            </div>
                <?php 
                        endforeach;
                    endif;
                ?>
            
        </div>
        
    </div>
</div>

<?php include 'footer.php'; ?>
