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

    $_SESSION['dashboardActive']="true";
?>
<?php 
    require("tools/conexion.php");
    $totalUsuarios=0;
    $queryUsuario = mysqli_query($acceso, "SELECT COUNT(id_usuario) AS total FROM usuarios");
    while ($row=mysqli_fetch_assoc($queryUsuario)) {
        $totalUsuarios=$row['total'];
    }
?>
<?php 
    $_SESSION['title']= "Dashboard Administrador | Katan Amaja - Vinos de cafe";
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
            <a class="navbar-brand " href="admin.php">Dashboard</a>
        </div>
    </nav>
    <div class="row p-15">
        <div class="col-sm">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fas fa-user-astronaut f-s-40 color-danger"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $totalUsuarios; ?></h2>
                        <p class="m-b-0">Usuarios</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2>1178</h2>
                        <p class="m-b-0">Ventas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fas fa-dollar-sign f-s-40 color-primary"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2>568120</h2>
                        <p class="m-b-0">Ganancias</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div class="col-sm">
        One of three columns
        </div>
        <div class="col-sm">
        One of three columns
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

<?php include 'footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>