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
    <title>Dashboard | <?php echo $user['name']; ?> </title>
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
                            <h5 class=" mt-3 m-0 text-dark">User Dashboard - รายงานภาพรวม </h5>
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
                            <div class="row  mb-6 ml-5 ">
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card  shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header bg-info text-white">จำนวนครั้งที่เทรด</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-info">69 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-info"> ครั้ง</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header bg-success text-white">จำนวนครั้งที่ชนะ</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-success">69 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-success"> ครั้ง</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header  bg-danger text-danger">จำนวนครั้งที่แพ้</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-danger">69 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-danger"> ครั้ง</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header  bg-success text-success">กำไร</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-success">69 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-success"> THB</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header  bg-danger text-danger">ขาดทุน</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-danger">69 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-danger"> THB</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3 ml-5 ">
                                    <div class="card text-center shadow-lg  mb-5 bg-white rounded">
                                        <h3 class="text-center card-header  bg-info text-info">ค่าเฉลี่ยวันที่ถือครองสินทรัพย์</h3>
                                        <div class="card-body">
                                            <br>
                                            <br>
                                            <h1 class="text-center text-info"> 9 </h1>
                                            <hr>
                                            <h5 class=" card-text text-center text-info"> วัน</h5>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
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