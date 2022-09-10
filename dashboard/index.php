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
$query = "SELECT COUNT(*) AS SUM FROM tb_journal  WHERE `ur_id`='$id' ORDER BY id" or die;
$result = mysqli_query($db_connection, $query);


$query2 = "SELECT  SUM(assetprice*assetvolume) AS SUM1 FROM tb_journal WHERE `ur_id`='$id' ORDER BY id" or die;
$result2 = mysqli_query($db_connection, $query2);


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
    <link rel="stylesheet" href="../plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="../assetsuser/css/adminlte.min.css">
    <link rel="stylesheet" href="../assetsuser/css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body>

    <!-- <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full"> -->
    <style>
        .swal-wide {
            font-size: 20px;
            width: 850px !important;
            height: 400px !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'สำเร็จ!',
                text: 'ยินดีต้อนรับเข้าสู่จดบันทึกและวิเคราะห์การลงทุน',
                imageUrl: 'good.png',
                customClass: 'swal-wide',
                timer: 1000,
                showConfirmButton: false
            });
        });
    </script>

    <?php include_once('../pages/sidebar.php') ?>
    <main class="col-md-8 ml-sm-auto col-lg-10 px-md-3 py-4">
        <div class="page-wrapper">
            <div class="container-fluid bg-white">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-5">
                                <h3 class="ml-4 text-dark"> Dashboard </h3>
                                <p class="ml-4 text-dark"> (User Dashboard) </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card text-center  mb-5 border-primary rounded">
                            <h2 class="text-center card-header bg-primary ">จำนวนเงินที่ลงทุนอยู่</h2>
                            <div class="card-body text-primary">
                                <br>
                                <br>
                                <?php
                                foreach ($result2 as $results) { ?>
                                    <h1 value="<?php echo $results["admin_id"]; ?>"> </h1>
                                    <h1 class="text-center text-primary"><?php echo number_format($results["SUM1"]); ?></h1>
                                <?php }
                                ?>
                                <hr>
                                <h3 class=" card-text "> บาท </h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center   mb-5 bg-success rounded">
                            <h2 class="text-center card-header ">จำนวนครั้งที่ชนะ</h2>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="text-center ">69 </h1>
                                <hr>
                                <h3 class=" card-text text-center "> ครั้ง</h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center   mb-5 bg-danger rounded">
                            <h2 class="text-center card-header text-white">จำนวนครั้งที่แพ้</h2>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="text-center text-white">8 </h1>
                                <hr>
                                <h3 class=" card-text text-center text-white"> ครั้ง</h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col mr-6">
                        <div class="card text-center  mb-5 border-info rounded">
                            <h2 class="text-center card-header bg-info ">จำนวนสินทรัพย์ที่บันทึกอยู่</h2>
                            <div class="card-body text-info">
                                <br>
                                <br>
                                <?php
                                foreach ($result as $results) { ?>
                                    <h1 value="<?php echo $results["admin_id"]; ?>"> </h1>
                                    <h1 class="text-center text-info"><?php echo $results["SUM"]; ?></h1>
                                <?php }
                                ?>
                                <hr>
                                <h3 class=" card-text "> รายการ </h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center   mb-5 bg-success rounded">
                            <h2 class="text-center card-header text-white">จำนวนเงินกำไร</h2>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="text-center text-white">4000 </h1>
                                <hr>
                                <h3 class=" card-text text-center text-white"> บาท </h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center   mb-5 bg-danger rounded">
                            <h2 class="text-center card-header text-white">จำเงินที่ขาดทุน</h2>
                            <div class="card-body">
                                <br>
                                <br>
                                <h1 class="text-center text-white">6000 </h1>
                                <hr>
                                <h3 class=" card-text text-center text-white"> บาท</h3>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h2 class="card-title">รายการจดบันทึก</h2>

                                    </div>
                                    <div class="ms-auto">

                                    </div>
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Products</th>
                                            <th class="border-top-0">License</th>
                                            <th class="border-top-0">Support Agent</th>
                                            <th class="border-top-0">Technology</th>
                                            <th class="border-top-0">Tickets</th>
                                            <th class="border-top-0">Sales</th>
                                            <th class="border-top-0">Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"> Elite Admin</h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Single Use</td>
                                            <td>John Doe</td>
                                            <td>
                                                <label class="label label-danger">Angular</label>
                                            </td>
                                            <td>46</td>
                                            <td>356</td>
                                            <td>
                                                <h5 class="m-b-0">$2850.06</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16">Monster Admin</h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Single Use</td>
                                            <td>Venessa Fern</td>
                                            <td>
                                                <label class="label label-info">Vue Js</label>
                                            </td>
                                            <td>46</td>
                                            <td>356</td>
                                            <td>
                                                <h5 class="m-b-0">$2850.06</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16">Material Pro Admin</h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Single Use</td>
                                            <td>John Doe</td>
                                            <td>
                                                <label class="label label-success">Bootstrap</label>
                                            </td>
                                            <td>46</td>
                                            <td>356</td>
                                            <td>
                                                <h5 class="m-b-0">$2850.06</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16">Ample Admin</h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Single Use</td>
                                            <td>John Doe</td>
                                            <td>
                                                <label class="label label-purple">React</label>
                                            </td>
                                            <td>46</td>
                                            <td>356</td>
                                            <td>
                                                <h5 class="m-b-0">$2850.06</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    </main>
</body>

</html>