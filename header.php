<?php
/**
 * Header de la pagina
 *
 * Despliega la seccion <head> y todos los componentes hasta <div id="content">
 *
 * @package Katan
 */
?>
<?php 
    $title ="Bienvenido a Vinos del Mundo";
    if(isset($_SESSION['title']))
        $title =$_SESSION['title'];
        
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo($title); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/external/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" href="css/external/fontawesome-all.min.css" />
</head>
<body class="main_body">