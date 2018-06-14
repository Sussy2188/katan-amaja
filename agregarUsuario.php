<?php
/**
 * Contiene la pagina Usuarios de katan amaja
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
    $privilegio=99;
    if (isset($_SESSION['privilegio'])) {
        $privilegio=$_SESSION['privilegio'];
    }
    if ($privilegio>1) {
        header("Location:dashboard.php");
    }

    $_SESSION['usersActive']="true";
?>
<?php 
    require("tools/conexion.php");
    if(isset($_POST['registrar'])){
        $username=mysqli_real_escape_string($acceso,$_POST['username']);
        $fullName=mysqli_real_escape_string($acceso,$_POST['fullName']);
        $email=mysqli_real_escape_string($acceso,$_POST['email']);
        $password=mysqli_real_escape_string($acceso,$_POST['password']);
        $rePassword=mysqli_real_escape_string($acceso,$_POST['rePassword']);
        $privilegio=mysqli_real_escape_string($acceso,$_POST['privilegio']);
        $sql="SELECT * FROM usuarios WHERE Usuario='".$username."'";
        $query=mysqli_query($acceso, $sql);
        if(mysqli_num_rows($query)>0){
            $message="El Usuario ya existe";
        }else{
            if($password!=$rePassword){
                $message="Las contraseñas no coinciden";
            }else{
                $password=md5($password);
                $insertScript="INSERT INTO usuarios (Usuario,Nombre,Email,Contrasenia,id_privilegio) VALUES('".$username."','".$fullName."','".$email."','".$password."','".$privilegio."')";
                $result=mysqli_query($acceso,$insertScript);
                if($result){
                    $success="Usuario <b>".$username."</b> guardado satisfactoriamente";
                }else{
                    $message="Ha ocurrido un error, intente de nuevo";            
                }
            }
        }
    
        unset($_POST['registrar']);
    }
?>
<?php 
    $_SESSION['title']= "Listado de Usuarios | Katan Amaja - Vinos de cafe";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/helper.css" />
<script src="js/external/Chart.bundle.min.js"></script>

<div class="wrapper">
    <?php include 'componentes/adminSidebar.php'; ?>
    <div id="content">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button type="button" id="sidebarCollapse" class="btn btn-danger navbar-btn">
            <i class="fas fa-bars"></i>
        </button>
        <div class="container">
            <a class="navbar-brand " href="listadoUsuarios.php">Agregar Usuario</a>
        </div>
    </nav>
    <div class="row p-15">
        <form class="form-signin add-user-form" action="agregarUsuario.php" method="post" name="registerform" id="registerform">
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
                <label for="privilegio" class="sr-only">Privilegio</label>
                <input type="number" name="privilegio" id="privilegio" class="form-control" placeholder="Privilegio" required="">            
            </p>
            <button type="submit" name="registrar" value="Guardar" class="btn btn-primary btn-block btn-main">Guardar</button>
            <a href="listadoUsuarios.php" class="btn btn-outline-danger btn-block btn-cancel">Cancelar</a>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>