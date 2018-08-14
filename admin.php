<?php
/**
 * Contiene la pagina Usuarios de Vinos del Mundo
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
        header("Location:index.php");
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
    $totalOrdenes=0;
    $queryOrdenes = mysqli_query($acceso, "SELECT COUNT(id) AS total FROM orden");
    while ($row=mysqli_fetch_assoc($queryOrdenes)) {
        $totalOrdenes=$row['total'];
    }
    $totalGanancias=0;
    $queryGanancias = mysqli_query($acceso, "SELECT SUM(total) AS total FROM orden where id_status=2");
    while ($row=mysqli_fetch_assoc($queryGanancias)) {
        $totalGanancias=$row['total'];
    }
?>
<?php 
    $_SESSION['title']= "Dashboard Administrador | Vinos del Mundo - Vinos de cafe";
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/helper.css" />
<script type="application/javascript" src="js/external/Chart.bundle.min.js"></script>

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
                        <h2><?php echo $totalOrdenes; ?></h2>
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
                        <h2><?php echo $totalGanancias; ?></h2>
                        <p class="m-b-0">Ganancias</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <canvas id="myChart" height="400vw" ></canvas>
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        height:200,
        data: {
            
            labels: [
                <?php 
                    $getLastInsert="SELECT id, total FROM `orden`";
                    $queryLastOrder = mysqli_query($acceso, $getLastInsert);
                    if(mysqli_num_rows($queryLastOrder)>0){
                        $indice=0;
                        while ($row=mysqli_fetch_assoc($queryLastOrder)) {
                            
                            if($indice>0) {
                                echo ",'". $row['id']."'";
                            }else{
                                echo "'". $row['id']."'";
                            }
                            $indice=$indice+1;
                        }    
                    }
                ?>
            ],
            datasets: [{
                label: 'Ventas',
                data: [
                    <?php 
                        $indice=0;
                        $queryLastOrder = mysqli_query($acceso, $getLastInsert);
                        if(mysqli_num_rows($queryLastOrder)>0){
                            while ($row=mysqli_fetch_assoc($queryLastOrder)) {
                                
                                if($indice>0) {
                                    echo ",". $row['total'];
                                }else{
                                    echo $row['total'];
                                }
                                $indice=$indice+1;
                            }    
                        }
                    ?>
                ],
                backgroundColor:'rgba(255, 0, 0, 0.2)',
                borderColor: 'rgba(255,0,0,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio:false,
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
<script type="application/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>