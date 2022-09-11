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
    <link href="../css/userdashboard.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <div class="row  mt-3 mr-5">


                    <div class="col-md-6 sm-4 ">
                        <div class="card bg-light  text-dark elevation-2" style="border-radius:10px;">
                            <span class="circle"></span><br>
                            <div class="top-div">
                                <div class="chip-image ">
                                    <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" />
                                    <br>
                                </div>
                                <div class="plus-sign">
                                    <h4> </h4>
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="card-details text-dark">
                                <div class="card-number text-dark">
                                    <h2>จำนวนเงินที่ลงทุน </h2>
                                    <?php
                                    foreach ($result2 as $results) { ?>
                                        <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                        <h1 class=" text-primary"><?php echo number_format($results["SUM1"]); ?></h1>
                                    <?php }
                                    ?>
                                </div>
                                <div class="date text-dark">
                                    <h4> THB </h4>
                                </div>
                            </div>
                            <div class="ownername">
                                <h4><?php echo $user["name"]; ?></h4>
                                <img class=" img-circle elevation-1" src="<?php echo $user['profile_image']; ?>" />
                            </div>
                            <br><br>
                        </div>
                    </div>




                    <div class="col-md-6 sm-4">
                        <div class="card bg-light text-dark elevation-2 " style="border-radius:10px;">
                            <span class="circle"></span><br>
                            <div class="top-div">
                                <div class="chip-image ">
                                    <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" />
                                    <br>
                                </div>
                                <div class="plus-sign">
                                    <h4> </h4>
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="card-details text-dark">
                                <div class="card-number text-dark">
                                    <h2>จำนวนครั้งที่บันทึก (เทรด) </h2>
                                    <?php
                                    foreach ($result as $results) { ?>
                                        <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                        <h1 class=" text-primary"><?php echo number_format($results["SUM"]); ?></h1>
                                    <?php }
                                    ?>
                                </div>
                                <div class="date text-dark">
                                    <h4> รายการ </h4>
                                </div>
                            </div>
                            <div class="ownername">
                                <h4><?php echo $user["name"]; ?></h4>
                                <img class=" img-circle elevation-1" src="<?php echo $user['profile_image']; ?>" />
                            </div>
                            <br><br>
                        </div> <br>
                    </div>
                    <div class="col-md-6 sm-3">
                        <div class="card bg-success  elevation-2" style="border-radius:10px;">
                            <span class="circle"></span><br>
                            <div class="top-div">
                                <div class="chip-image">
                                    <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" />
                                    <br>
                                </div>
                                <div class="plus-sign">
                                    <h4> </h4>
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="card-details">
                                <div class="card-number">
                                    <h2>จำนวนเงินที่กำไร </h2>
                                    <?php
                                    foreach ($result2 as $results) { ?>
                                        <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                        <h2 class=" text-primary"><?php echo number_format($results["SUM1"]); ?></h2>
                                    <?php }
                                    ?>
                                </div>
                                <div class="date">
                                    <h4> THB </h4>
                                </div>
                            </div>
                            <div class="ownername">
                                <h4><?php echo $user["name"]; ?></h4>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                            </div>
                            <br><br>
                        </div>
                    </div>



                    <div class="col-md-6 sm-4">
                        <div class="card bg-danger  elevation-2" style="border-radius:10px;">
                            <span class="circle"></span><br>
                            <div class="top-div">
                                <div class="chip-image">
                                    <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" />
                                    <br>
                                </div>
                                <div class="plus-sign">
                                    <h4> </h4>
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="card-details">
                                <div class="card-number">
                                    <h2>จำนวนเงินที่ขาดทุน </h2>
                                    <?php
                                    foreach ($result2 as $results) { ?>
                                        <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                        <h2 class=" text-primary"><?php echo number_format($results["SUM1"]); ?></h2>
                                    <?php }
                                    ?>
                                </div>
                                <div class="date">
                                    <h4> THB </h4>
                                </div>
                            </div>
                            <div class="ownername">
                                <h4><?php echo $user["name"]; ?></h4>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <!-- column -->
                <div class="col-12 sm-8 md-6 bg-white">
                    <div class="card-body">
                        <div>
                            <h1 class="card-title">รายการจดบันทึก</h1>
                        </div>
                        <div class="table-responsive">
                            <table class=" table table-striped " id="myTable">
                                <thead class=" text-center table-success">

                                    <th>
                                        สถานะ
                                    </th>
                                    <th>
                                        สินทรัพย์
                                    </th>
                                    <th>
                                        ราคาเข้าซื้อสินทรัพย์ (บาท)
                                    </th>
                                    <th>
                                        ราคาขายสินทรัพย์ (บาท)
                                    </th>
                                    <th>
                                        วันที่ซื้อ
                                    </th>
                                    <th>
                                        วันที่ขาย
                                    </th>

                                    <th>
                                        จำนวนวันที่ถือครอง
                                    </th>
                                    <th>
                                        กำไร/ขาดทุน (บาท)
                                    </th>
                                    <th>
                                        เปอร์เซ็น กำไร/ขาดทุน
                                    </th>

                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $id = $_SESSION['login_id'];
                                    $get_user =
                                        "SELECT 
                                            *
                                            FROM tb_journal 
                                            as j 
                                            INNER JOIN tb_type 
                                            as t 
                                            on j.Assettype_name=t.Assettype_id   
                                            WHERE `ur_id`='$id' 
                                            ORDER BY `t`.`Assettype_name` ASC";

                                    $result = mysqli_query($conn, $get_user);

                                    foreach ($result as $user) {
                                    ?>
                                        <tr class="text-center">
                                            <td><?php echo  $user['options']; ?></td>
                                            <td><?php echo $user['Assettype_name']; ?></td>
                                            <td><?php echo $user['assetname']; ?></td>
                                            <td><?php echo number_format($user['assetprice'], '2'); ?> (บาท) </td>
                                            <td><?php echo number_format($user['assetvolume'], '2'); ?> (หน่วย) </td>
                                            <td><?php echo $user['assetdate']; ?></td>
                                            <td><?php echo $user['assetnote']; ?></td>
                                            <td><?php echo number_format($user['assetsl'], '2'); ?> (บาท) </td>
                                            <td><?php echo number_format($user['assettg'], '2'); ?> (บาท) </td>

                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <script>
            new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                    // labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 5267, 734, 784, 433]
                    }]
                },
            });


            new Chart(document.getElementById("bar-chart-horizontal"), {
                type: 'horizontalBar',
                data: {
                    labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 5267, 734, 784, 433]
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Predicted world population (millions) in 2050'
                    }
                }
            });
        </script>
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