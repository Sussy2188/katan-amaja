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
    $idUsuario="0";
    $dbUsername="";
    $dbEmail="";
    $dbPassword="";
    $dbNombre="";
    $dbPrivilegio="";
    if(isset($_POST['actualizar'])){
        $idUsuario=mysqli_real_escape_string($acceso,$_POST['id_usuario']);
        $fullName=mysqli_real_escape_string($acceso,$_POST['fullName']);
        $email=mysqli_real_escape_string($acceso,$_POST['email']);
        $password=mysqli_real_escape_string($acceso,$_POST['password']);
        $rePassword=mysqli_real_escape_string($acceso,$_POST['rePassword']);
        $oldPassword=mysqli_real_escape_string($acceso,$_POST['old_password']);
        $privilegio=mysqli_real_escape_string($acceso,$_POST['privilegio']);
       
        if($password!=$rePassword){
            $message="Las contraseñas no coinciden";
        }else{
            if ($password!=$oldPassword){
                $password=md5($password);
            }
            $updateQuery="UPDATE usuarios SET Nombre='".$fullName."',Email='".$email."',Contrasenia='".$password."',id_privilegio=".$privilegio." WHERE id_usuario=".$idUsuario;
            $result=mysqli_query($acceso,$updateQuery);
            if($result==TRUE){
                $success="Usuario <b>".$dbUsername."</b> guardado satisfactoriamente";
            }else{
                $message="Ha ocurrido un error, intente de nuevo";            
            }
        }
        unset($_POST['actualizar']);
    }
    
    if(isset($_SESSION['username'])){
        $idUsuario=mysqli_real_escape_string($acceso,$_GET['id_usuario']);
        $sql="SELECT * FROM usuarios WHERE id_usuario=".$idUsuario."";
        $query=mysqli_query($acceso, $sql);
        if(mysqli_num_rows($query)>0){
            while ($row=mysqli_fetch_assoc($query)) {
                $dbUsername=$row['Usuario'];
                $dbEmail=$row['Email'];
                $dbPassword=$row['Contrasenia'];
                $dbNombre=$row['Nombre'];
                $dbPrivilegio=$row['id_privilegio'];
            }
        }else{
            $message="El Usuario no existe";
        }
        unset($_GET['id_usuario']);
    }else{
        unset($_GET['id_usuario']);
    }
?>
<?php 
    $_SESSION['title']= "Editar Usuarios | Katan Amaja - Vinos de cafe";
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
        <form class="form-signin add-user-form" action="editarUsuario.php?id_usuario=<?php echo $idUsuario; ?>" method="post" name="registerform" id="registerform">
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
                <h2><?php echo $dbUsername; ?></h2>
                <input type="hidden" name="id_usuario" value="<?php echo $idUsuario; ?>" />
                <label for="inputNombre" class="sr-only">Nombre completo</label>
                <input value="<?php echo $dbNombre; ?>" type="text" name="fullName" id="inputNombre" class="form-control" placeholder="Nombre Completo" required="">    
                <label for="inputEmail" class="sr-only">Email</label>
                <input value="<?php echo $dbEmail; ?>" type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="hidden" name="old_password" value="<?php echo $dbPassword; ?>" />
                <input value="<?php echo $dbPassword; ?>" type="text" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                <label for="inputRePassword" class="sr-only">Reingrese Password</label>
                <input value="<?php echo $dbPassword; ?>" type="text" name="rePassword" id="inputRePassword" class="form-control" placeholder="Reingrese Password" required="">
                <label for="privilegio" class="sr-only">Privilegio</label>
                <input value="<?php echo $dbPrivilegio; ?>" type="number" name="privilegio" id="privilegio" class="form-control" placeholder="Privilegio" required="">            
            </p>
            <button type="submit" name="actualizar" value="Guardar" class="btn btn-primary btn-block btn-main">Guardar</button>
            <a href="listadoUsuarios.php" class="btn btn-outline-danger btn-block btn-cancel">Regresar</a>
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