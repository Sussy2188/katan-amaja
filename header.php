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
    /*  inicia sesion y redirige a index si no existe sesion */
    if(isset($_SESSION['username']))
        header('Location:dashboard.php');
?>
<?php 
    $title ="Bienvenido a Katan Amaja";
    if(isset($_SESSION['title']))
        $title =$_SESSION['title'];
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
</head>
<body class="main_body">