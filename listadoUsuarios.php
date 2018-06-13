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
    $totalUsuarios=0;
    $queryUsuario = mysqli_query($acceso, "SELECT * FROM usuarios");
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
            <a class="navbar-brand " href="listadoUsuarios.php">Listado de Usuarios</a>
        </div>
    </nav>
    <div class="row p-15">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Username</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col">Privilegio</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($row=mysqli_fetch_assoc($queryUsuario)) {
                        $id=$row['id_usuario'];
                        echo '<tr><td>'.$row['Usuario'].'</td>
                        <td>'.$row['Nombre'].'</td>
                        <td>'.$row['Email'].'</td>
                        <td>'.$row['id_privilegio'].'</td>
                        <td><a href="agregarUsuario.php"><i class="fas fa-file-alt" title="Nuevo"></i></a>
                        <a href="editarUsuario.php?id='.$id.'"><i class="fas fa-edit" title="Editar"></i></a>
                        <a href="eliminarUsuario.php?id='.$id.'"><i class="fas fa-cut" title="Eliminar"></i></a></td></tr>';
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
</script>