<?php
    $id_productos=array();
    $counter="";
    if(isset($_SESSION['shopping_cart'])){
        //obtiene el siguiente indice donde se agregaran los productos
        $counter=count($_SESSION['shopping_cart']);

        //crea el arreglo secuencial para los indices y los ids de productos 
        $id_productos= array_column($_SESSION['shopping_cart'], 'id');
    }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-white">
            <?php 
                $subtotal=0;
                if(isset($_SESSION['shopping_cart'])){
                    foreach($_SESSION['shopping_cart'] as $key => $product){
                        $subtotal= $subtotal +($product['quantity'] * $product['price']);
                    }
                }
            ?>
            <h5 class="card-title">Subtotal Q. <?php echo $subtotal; ?></h5>
            <div class="cart-body">
                <?php 
                    if(isset($_SESSION['shopping_cart'])):
                        foreach($_SESSION['shopping_cart'] as $key => $product):
                ?>
                            <div class="card flex-row text-white bg-dark rounded-0" style="opacity:0.75" >
                                <img class="card-img-left align-self-center" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [100x125]" style=" height: 80px;" src="<?php echo $product['imagen']?>" data-holder-rendered="true">
                                <div class="card-body position-relative">
                                    <h6 class="card-subtitle mb-2"> <?php echo $product['name']?></h6>
                                    <p class="card-text"><small class="text-white-50"><?php echo $product['quantity']?> x Q.<?php echo $product['price']?> </small>= <b class="text-danger"><?php echo $product['quantity']*$product['price']?></b> </p>
                                    <a href="catalogo.php?action=delete&id=<?php echo $product['id']?>" class="btn btn-danger position-absolute m-2 cart-close">X</a>
                                </div>
                            </div>
                <?php 
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>