<?php
/**
 * Contiene la pagina dashboard de Vinos del Mundo
 *
 * @package Katan
 */
?>
<?php
    session_start();
    require("tools/conexion.php");

    $username="usuario";
    if(isset($_SESSION['username'])){
        $username=$_SESSION['username'];
    } 
    $globalCounter="";
    $id_productos=array();
    if(isset($_SESSION['shopping_cart'])){
        //obtiene el siguiente indice donde se agregaran los productos
        $globalCounter=count($_SESSION['shopping_cart']);
    }
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
        
        if ($globalCounter>0){
            $idUsuario=$_SESSION['idUsuario'];
            if(!isset($idUsuario)){
                header('Location:login.php');
                unset($_SESSION['shopping_cart']);
            }
            $insertTotal=0;
            if(isset($_SESSION['shopping_cart'])){
                foreach($_SESSION['shopping_cart'] as $key => $product){
                    $insertTotal= $insertTotal +($product['quantity'] * $product['price']);
                }
            }
            $insertScript="INSERT INTO orden (id_usuario,id_tipo_pago,id_status,id_direccion,total) VALUES('".$idUsuario."','1','2','1','".$insertTotal."')";
            $result=mysqli_query($acceso,$insertScript);
            if($result){
                $getLastInsert="SELECT id FROM `orden` ORDER BY id DESC LIMIT 1";
                $queryLastOrder = mysqli_query($acceso, $getLastInsert);
                if(mysqli_num_rows($queryLastOrder)>0){
                    $idOrden="";
                    while ($row=mysqli_fetch_assoc($queryLastOrder)) {
                        $idOrden=$row['id'];
                    }
                    $insertItemScript="INSERT INTO orden_items (id_orden,id_producto,cantidad) VALUES";
                    foreach($_SESSION['shopping_cart'] as $key => $product){
                        $insertItemScript=$insertItemScript." ('".$idOrden."','".$product['id']."',".$product['quantity']."),";
                    }
                    $insertItemScript = rtrim($insertItemScript, ',');
                    $itemsResult=mysqli_query($acceso,$insertItemScript);
                    if($itemsResult){
                        $success="Gracias por realizar su pedido, siga comprando";
                        unset($_SESSION['shopping_cart']);
                    }else{
                        $message="Ha ocurrido un error en detalle, intente de nuevo";
                    }
                   
                }else{
                    $message="Ha ocurrido un error en detalle, intente de nuevo";
                }
            }else{
                $message="Ha ocurrido un error, intente de nuevo";            
            }
        }
    }
?>
<?php 
    $_SESSION['title']= "Catalogo de productos | Vinos del Mundo ";
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
        <?php   
            if(!empty($success)){
                echo("<p class='success-msg'>".$success."</p>");
            } 
            if(!empty($message)){
                echo("<p class='error-msg'>".$message."</p>");
            }
        ?>
        <nav class="navbar navbar-dark bg-dark mb-3">
            <a class="navbar-brand">Catalogo</a>
        </nav>
            <?php 
                if($queryProductos){
                    if(mysqli_num_rows($queryProductos)>0){
                        echo '<div class="row mb-2">';
                            while ($row=mysqli_fetch_assoc($queryProductos)) {
                                echo '<div class="col-md-4 col-lg-3 col-sm-6 mb-3">
                                        <form method="post" action="catalogo.php?action=add&id='.$row['id'].'">
                                            <div class="card align-items-center">
                                                <img class="card-img-top" 
                                                    data-src="holder.js/200x250?theme=thumb" 
                                                    alt="Thumbnail [200x250]" 
                                                    style="width: auto; height: 250px;" 
                                                    src="'.$row['imagen'].'"
                                                     data-holder-rendered="true">
                                                <div class="card-body d-flex flex-column ">
                                                    <h4 class="mb-0">
                                                        <a class="text-white" href="#">'.$row['nombre'].'</a>
                                                    </h4>
                                                    <p class="card-text mb-auto text-justify">'.$row['descripcion'].'</p>
                                                    <h5 class="">Q.'.$row['precio'].'</h5>
                                                    <div>
                                                        <div class="cantidad-container mt-2 mb-2">
                                                            <input type="button" onclick="decreaseSpinner(\'spinner-'.$row['id'].'\')" class="btn" value="-" />
                                                            <input type="text" id="spinner-'.$row['id'].'" name="quantity" placeholder="cantidad" class="form-control cantidad" value="1" readonly/>
                                                            <input type="button" onclick="increaseSpinner(\'spinner-'.$row['id'].'\')" class="btn" value="+" />
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="name" value="'.$row['nombre'].'" />
                                                    <input type="hidden" name="price" value="'.$row['precio'].'" />
                                                    <input type="hidden" name="imagen" value="'.$row['imagen'].'" />
                                                    <input type="submit" name="add_to_cart" class="btn btn-block" value="Agregar al Carrito" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>';
                            }
                        echo '</div>';
                    }
                }
                
            ?>
        
        </div>
        
        
    </div>
</div>
<script type="application/javascript">
    var increaseSpinner = function(id){
        var input = $("#"+id);
        input.val(parseInt(input.val())+1);
    }
    var decreaseSpinner = function(id){
        var input = $("#"+id);
        if(input.val()>1)
            input.val(parseInt(input.val())-1);
    }
</script>
<?php include 'footer.php'; ?>
