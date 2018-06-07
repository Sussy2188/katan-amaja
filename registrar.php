<?php
/**
 * Contiene la pagina register de katan amaja
 *
 * @package Katan
 */
?>
<?php 
    session_start();
    /*  inicia sesion y redirige a index si no existe sesion */
    if(isset($_SESSION['username']))
        header('Location:dashboard.php');
?>
<?php 
    require("tools/conexion.php");
    if(isset($_POST['registrar'])){
        $username=mysqli_real_escape_string($acceso,$_POST['username']);
        $fullName=mysqli_real_escape_string($acceso,$_POST['fullName']);
        $email=mysqli_real_escape_string($acceso,$_POST['email']);
        $password=mysqli_real_escape_string($acceso,$_POST['password']);
        $rePassword=mysqli_real_escape_string($acceso,$_POST['rePassword']);
        $sql="SELECT * FROM usuarios WHERE Usuario='".$username."'";
        $query=mysqli_query($acceso, $sql);
        if(mysqli_num_rows($query)>0){
            $message="El Usuario ya existe";
        }else{
            if($password!=$rePassword){
                $message="Las contraseñas no coinciden";
            }else{
                $password=md5($password);
                $insertScript="INSERT INTO usuarios (Usuario,Nombre,Email,Contrasenia,id_privilegio) VALUES('".$username."','".$fullName."','".$email."','".$password."','2')";
                $result=mysqli_query($acceso,$insertScript);
                if($result){
                    $_SESSION['success']="Usuario <b>".$username."</b> guardado satisfactoriamente";
                    header("Location:login.php");
                }else{
                    $message="Ha ocurrido un error, intente de nuevo";            
                }
            }
        }
    
        unset($_POST['registrar']);
    }
?>
<?php include 'header.php'; ?>
<?php 
    $_SESSION['title']= "Registrar Usuario - Katan Amaja";
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/cover.css" />
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include 'componentes/coverNavBar.php'; ?>
    <main role="main" class="inner cover">
        <form class="form-signin login-form" action="registrar.php" method="post" name="registerform" id="registerform">
            <h1 class="cover-heading">Katan Amaja</h1>
            <h3 class="cover-heading">Registro de Usuario</h3>
            <?php    
                if(!empty($success)){
                    echo("<p class='success-msg'>".$success."</p>");
                }
                if(!empty($message)){
                    echo("<p class='error-msg'>".$message."</p>");
                }
            ?>
            <br/>
            <p>
                <label for="inputUsername" class="sr-only">Nombre de usuario</label>
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Nombre de Usuario" required="" autofocus="">
                <label for="inputNombre" class="sr-only">Nombre completo</label>
                <input type="text" name="fullName" id="inputNombre" class="form-control" placeholder="Nombre Completo" required="">    
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                <label for="inputRePassword" class="sr-only">Reingrese Password</label>
                <input type="password" name="rePassword" id="inputRePassword" class="form-control" placeholder="Reingrese Password" required="">
            
            </p>
            <p>
                Ya tienes una cuenta? <a href="login.php" class="">Inicia Sesion aqui</a>                
            </p>
            <button type="submit" name="registrar" value="Registrar" class="btn btn-outline-primary btn-block btn-main">Registro</button>
            <a href="index.php" class="btn btn-outline-danger btn-block btn-cancel">Cancelar</a>
        </form>
    </main>
    <?php include 'componentes/coverFootBar.php'; ?>
</div>
<?php include 'footer.php'; ?>
