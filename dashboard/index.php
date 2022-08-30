<?php
error_reporting(error_reporting() & ~E_NOTICE);
require '../service/user_connect.php';


if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JOURNAL | <?php echo $user['name']; ?> </title>
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="manifest" href="../assetsuser/img/favicons/site.webmanifest">
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../assetsuser/img/favicons/browserconfig.xml">

    <!-- stylesheet -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mali">
    <link rel="stylesheet" href="../plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="../assetsuser/css/adminlte.min.css">
    <link rel="stylesheet" href="../assetsuser/css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once('../pages/sidebar.php') ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row my-4 ml-4 mb-4 ">
                        <div class="col-sm-6">
                            <h5 class=" mt-3 m-0 text-dark">User Dashboard - รายงานภาพรวมของเว็บไซต์ </h5>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row my-1 mb-6 ml-5 ">
                                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="card-header bg-success text-white">WIN no.</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="card-title text-success">69 no.</h1>
                                            <br>
                                            <br>
                                            <p class="card-text text-success">18.2% increase since last month</p>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ml-5">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="card-header bg-success text-white">WIN no.</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="card-title text-success">69 no.</h1>
                                            <br>
                                            <br>
                                            <p class="card-text text-success">18.2% increase since last month</p>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ml-5">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="card-header bg-success text-white">WIN no.</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="card-title text-success">69 no.</h1>
                                            <br>
                                            <br>
                                            <p class="card-text text-success">18.2% increase since last month</p>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ml-5 ">
                            <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                <h3 class="card-header bg-danger text-white">LOSS no.</h3>
                                <div class="card-body">
                                    <br>
                                    <br>
                                    <h1 class="card-title text-danger">40 no.</h1>
                                    <br>
                                    <br>
                                    <p class="card-text text-danger">18.2% increase since last month</p>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ml-4 ">
                            <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                <h3 class="card-header bg-danger text-white">LOSS no.</h3>
                                <div class="card-body">
                                    <br>
                                    <br>
                                    <h1 class="card-title text-danger">40 no.</h1>
                                    <br>
                                    <br>
                                    <p class="card-text text-danger">18.2% increase since last month</p>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 ml-5 ">
                            <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                <h3 class="card-header bg-danger text-white">LOSS no.</h3>
                                <div class="card-body">
                                    <br>
                                    <br>
                                    <h1 class="card-title text-danger">40 no.</h1>
                                    <br>
                                    <br>
                                    <p class="card-text text-danger">18.2% increase since last month</p>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- SCRIPTS -->
            <script src="../plugins/jquery/jquery.min.js"></script>
            <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../assetsuser/js/adminlte.min.js"></script>


            <!-- OPTIONAL SCRIPTS -->
            <script src="../plugins/chart.js/Chart.min.js"></script>
            <script src="../assetsuser/js/pages/dashboard.js"></script>


</body>

</html>