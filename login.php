<?php
/**
 * Contiene la pagina login de katan amaja
 *
 * @package Katan
 */
?>
<?php 
    session_start();
    /*  inicia sesion y redirige a index si no existe sesion */
    if(isset($_SESSION['username']))
        header('Location:dashboard.php');

    if(isset($_SESSION['success'])){
        $success=$_SESSION['success'];
    }
?>
<?php 
    require("tools/conexion.php");
    if(isset($_POST['login'])){
        if(!empty($_POST['username'])&&!empty($_POST['password'])){
            $username=mysqli_real_escape_string($acceso,$_POST['username']);
            $password=mysqli_real_escape_string($acceso,$_POST['password']);
            $password=md5($password);
            $sql="SELECT * FROM usuarios WHERE Usuario='".$username."' AND Contrasenia='".$password."'";
            $query=mysqli_query($acceso, $sql);
            if(mysqli_num_rows($query)>0){
                while ($row=mysqli_fetch_assoc($query)) {
                    $dbUsername=$row['Usuario'];
                    $dbPassword=$row['Contrasenia'];
                    $nombreUsuario=$row['Nombre'];
                    $privilegio=$row['id_privilegio'];
                }
                $_SESSION['username']=$dbUsername;
                $_SESSION['nombreUsuario']=$nombreUsuario;
                $_SESSION['privilegio']=$privilegio;
                mysqli_free_result($query);
                switch ($privilegio) {
                    case 1:
                        header("Location:admin.php");
                        break;
                    case 2:
                        header("Location:dashboard.php");
                        break;
                    default:
                        break;
                }
                exit();
            }else{
                $message="Usuario o contraseña invalidos.";
            }
        }
        unset($_POST['login']);
    }
?>
<?php 
    $_SESSION['title']= "Iniciar Sesion - Katan Amaja";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/cover.css" />
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php include 'componentes/coverNavBar.php'; ?>
    <main role="main" class="inner cover">
        <form class="form-signin login-form" action="login.php" method="post" name="loginform" id="loginform">
            <h1 class="cover-heading">Katan Amaja</h1>
            <h3 class="cover-heading">Login</h3>
            <br/>
            <?php   
                if(!empty($success)){
                    echo("<p class='success-msg'>".$success."</p>");
                } 
                if(!empty($message)){
                    echo("<p class='error-msg'>".$message."</p>");
                }
            ?>
            <p>
                <label for="inputUsername" class="sr-only">Nombre de Usuario</label>
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Nombre de Usuario" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">    
            </p>
            <p>
                No estas registrado? <a href="registrar.php" class="">Registrate aqui</a>                
            </p>
            <button type="submit" name="login" class="btn btn-outline-primary btn-block btn-main" value="Entrar">Iniciar Sesion</button>
            <a href="index.php" class="btn btn-outline-danger btn-block btn-cancel">Cancelar</a>
        </form>
    </main>
    <?php include 'componentes/coverFootBar.php'; ?>
</div>
<?php include 'footer.php'; ?>
