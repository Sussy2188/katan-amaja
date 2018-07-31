<?php
/**
 * Contiene Listado de productos de la pagina katan amaja
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
    $success="";
    if (isset($_SESSION['success'])) {
        $success=$_SESSION['success'];
    }
    $message="";
    if (isset($_SESSION['message'])) {
        $message=$_SESSION['message'];
    }
    if ($privilegio>1) {
        header("Location:dashboard.php");
    }

    $_SESSION['productosActive']="true";
    unset($_SESSION['success']);
    unset($_SESSION['message']);
?>
<?php 
    require("tools/conexion.php");
    $totalUsuarios=0;
    $queryUsuario = mysqli_query($acceso, "SELECT * FROM listado_productos");
?>
<?php
    if (isset($_GET['deleteUser'])) {
        $id_userToDelete=$_GET['deleteUser'];
        $getUsername=$_GET['userName'];
        $sql = "DELETE FROM usuarios WHERE id_usuario=".$id_userToDelete;
        $deleteScript = mysqli_query($acceso, $sql);
        if($deleteScript==TRUE){
            $_SESSION['success']="Usuario <b>".$getUsername."</b> eliminado satisfactoriamente";
        }else{
            $_SESSION['message']="Ha ocurrido un error, intente de nuevo";
        }
        unset($_GET['deleteUser']);
        unset($_GET['userName']);
        header("Location:listadoProductos.php");
    }
?>
<?php 
    $_SESSION['title']= "Listado de Productos | Katan Amaja - Vinos de cafe";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/helper.css" />

<div class="wrapper">
    <?php include 'componentes/adminSidebar.php'; ?>
    <div id="content">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button type="button" id="sidebarCollapse" class="btn btn-danger navbar-btn">
            <i class="fas fa-bars"></i>
        </button>
        <div class="container">
            <a class="navbar-brand " href="listadoProductos.php">Listado de Productos</a>
        </div>
    </nav>
    <div class="row p-15">
        <?php   
            if(!empty($success)){
                echo("<p class='success-msg'>".$success."</p>");
            } 
            if(!empty($message)){
                echo("<p class='error-msg'>".$message."</p>");
            }
        ?>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Nombre de producto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Activo</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($row=mysqli_fetch_assoc($queryUsuario)) {
                        $id=$row['id'];
                        echo '<tr><td>'.$row['nombre'].'</td>
                        <td>'.$row['nombre_categoria'].'</td>
                        <td>'.$row['precio'].'</td>
                        <td>'.$row['activo'].'</td>
                        <td><a href="agregarUsuario.php"><i class="fas fa-file-alt" title="Nuevo"></i></a>
                        <a href="editarUsuario.php?id_usuario='.$id.'"><i class="fas fa-edit" title="Editar"></i></a>
                        <a href="#" onclick="removeUser('.$id.',\''.$row['nombre'].'\')"><i class="fas fa-cut" title="Eliminar"></i></a></td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
    function removeUser(id,userName){
        var result=confirm("Esta seguro de eliminar al usuario"+userName+"?");
        if (result == true) {
            window.location="listadoUsuarios.php?deleteUser="+id+"&userName="+userName;
        }
    }
</script>