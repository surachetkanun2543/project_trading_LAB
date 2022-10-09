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
    <div class=" bg-dark">
        <?php include_once('../pages/sidebar.php') ?>
        <main class="bg-dark col-md-3 ml-sm-auto col-lg-10 ">
        <br>
        <div class="page-wrapper elevation-3 col-lg-3" style="border-radius:10px;">
                <div class="row">
                    <div class=" col-lg-10 ">
                        <br>
                        <h4 class="ml-4 text-dark"> Dashboard </h4>
                        <p class="ml-4 text-dark"> (User Dashboard) </p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-3 mr-5">
                <div class="col-md-6 sm-6  ">
                    <div class="card bg-light  text-dark elevation-4" style="border-radius:10px;">
                        <span class="bg-dark circle"></span><br>
                        <div class="top-div">
                            <div class="chip-image ">
                                <!-- <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" /> -->
                                <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details text-dark">
                            <div class="card-number text-dark">
                                <h1>จำนวนเงินที่ลงทุน </h1>
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
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>


                <div class="col-md-6 sm-3 col-lg-6">
                    <div class="card bg-light text-dark elevation-4 " style="border-radius:10px; background-color: #256D85;">
                        <span class="bg-dark circle"></span><br>
                        <div class="top-div">
                            <div class="chip-image ">
                                <!-- <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" /> -->
                                <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details text-dark">
                            <div class="card-number text-dark">
                                <h1>จำนวนครั้งที่บันทึก (เทรด) </h1>
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
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div> <br>
                </div>
                <div class="col-md-3 sm-3">
                    <div class="card bg-success  elevation-4" style="border-radius:10px;">
                        <span class="bg-dark circle"></span>
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



                <div class="col-md-3 sm-4">
                    <div class="card   elevation-4" style="border-radius:10px; background-color: #E94560;">
                        <span class="bg-dark circle"></span>
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


                <div class="col-md-3 sm-3">
                    <div class="card bg-success elevation-4" style="border-radius:10px; background-color: #256D85;">
                        <span class="bg-dark circle"></span>
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
                                <h2>จำนวนครั้งที่กำไร </h2>
                                <?php
                                foreach ($result2 as $results) { ?>
                                    <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                    <h2 class=" text-primary">3</h2>
                                    </h2>
                                <?php }
                                ?>
                            </div>
                            <div class="date">
                                <h4> ครั้ง </h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <h4><?php echo $user["name"]; ?></h4>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>


                <div class="col-md-3 sm-4">
                    <div class="card   elevation-4" style="border-radius:10px; background-color: #E94560;">
                        <span class="bg-dark circle"></span>
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
                                <h2>จำนวนครั้งที่ขาดทุน </h2>
                                <?php
                                foreach ($result2 as $results) { ?>
                                    <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                    <h2 class=" text-primary">78</h2>
                                    </h2>
                                <?php }
                                ?>
                            </div>
                            <div class="date">
                                <h4> ครั้ง </h4>
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
            <br>
            <br>
            <br>
            <br>
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