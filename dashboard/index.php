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
//รวมแค่การซื้อ
$query = "SELECT COUNT(*) AS SUM FROM tb_journal  WHERE `ur_id`='$id' ORDER BY id" or die;
$result = mysqli_query($db_connection, $query);


$query2 = "SELECT  SUM(assetprice*assetvolume) AS SUM1 FROM tb_journal WHERE `ur_id`='$id' ORDER BY id" or die;
$result2 = mysqli_query($db_connection, $query2);

//รวมแค่การขาย
$query3 = "SELECT COUNT(*) AS SUM2 FROM tb_sell  WHERE `ur_id`='$id' ORDER BY id" or die;
$result3 = mysqli_query($db_connection, $query3);


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
            background-image: linear-gradient(40deg,
                    hsl(0deg 0% 100%) 1%,
                    hsl(158deg 89% 78%) 51%,
                    hsl(159deg 81% 75%) 49%,
                    hsl(270deg 27% 94%) 99%);
            font-size: 17px;
            width: 480px !important;
            height: 430px !important;
            color: black;
        }
    </style>
    <script>
        $(document).ready(function() {
            Swal.fire({
                position: 'top',
                title: 'สวัสดีครับ !',
                text: 'ยินดีต้อนรับเข้าสู่เว็บไซต์จดบันทึกและวิเคราะห์การลงทุน ',
                imageUrl: 'https://static.thenounproject.com/png/1391881-200.png',
                customClass: 'swal-wide',
                timer: 4000,
                showConfirmButton: false
            });
        });
    </script>
    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
        <?php include_once('../pages/sidebar.php') ?>
        <main class="bg-transparent col-md-3 ml-sm-auto col-lg-10 ">
            <div class=" elevation-3 bg-dark col-lg-3" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                <div class="row">
                    <div class=" col-lg-10 ">
                        <br>
                        <h4 class="ml-4 text-light"> Dashboard </h4>
                        <p class="ml-4 text-light"> (User Dashboard) </p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-3 mr-5">
                <div class="col-md-5 sm-3  ">
                    <div class="card text-dark elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(14,10,10,0.8421743697478992) 0%, rgba(7,48,68,1) 71%);">
                        <span class="bg-dark circle"></span><br>
                        <div class="top-div">
                            <div class="chip-image ">
                                <!-- <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details text-light">
                            <div class="card-number text-light">
                                <h1>จำนวนเงินต้นทุน </h1>
                                <?php
                                foreach ($result2 as $results) { ?>
                                    <h3 value="<?php echo $results["admin_id"]; ?>"> </h3>
                                    <h1 class=" text-primary"><?php echo number_format($results["SUM1"]); ?></h1>
                                <?php }
                                ?>
                            </div>
                            <div class="date text-secondary">
                                <h4> THB (ทั้งหมด)</h4>
                            </div>
                        </div>
                        <div class="ownername ">
                            <h4 class="text-secondary"><?php echo $user["name"]; ?></h4>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>


                <div class="col-md-3 sm-3 col-lg-3">
                    <div class="card text-dark elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(14,10,10,0.8421743697478992) 0%, rgba(7,48,68,1) 71%);">
                        <span class="bg-dark circle"></span><br>
                        <div class="top-div">
                            <div class="chip-image ">
                                <!-- <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details text-light">
                            <div class="card-number text-light">
                                <h1>จำนวนครั้งที่ซื้อ  </h1>
                                <?php
                                foreach ($result as $results) { ?>
                                    <h1 class=" text-primary"><?php echo number_format($results["SUM"]); ?></h1>
                                <?php }
                                ?>
                            </div>
                            <div class="date text-secondary">
                                <h4> รายการ (ทั้งหมด)</h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <!-- <h4 class="text-secondary"><?php echo $user["name"]; ?></h4> -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div> <br>
                </div>


                <div class="col-md-4 sm-3 col-lg-4">
                    <div class="card text-dark elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(14,10,10,0.8421743697478992) 0%, rgba(7,48,68,1) 71%);">
                        <span class="bg-dark circle"></span><br>
                        <div class="top-div">
                            <div class="chip-image ">
                                <!-- <img class=" img-circle elevation-1" src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t39.30808-6/303344041_2232491563577148_6468077402251889375_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFmVST8cBKGrzSBcEneu72kdPOow65PdlB086jDrk92UOl6Td2A5eXOtNN8aA3wpe8joY-hYVdJZYIGIDFicDhh&_nc_ohc=Ul-muM9Ve_gAX9FFuzy&tn=Ys56LaKpN2RcL9EF&_nc_ht=scontent.fbkk10-1.fna&oh=00_AT-7alSwnzBrIu8b7gNbNCQ5ju5x8i6WnIb5QzKXEG86jQ&oe=6323BE50" /> -->
                                <!-- <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details text-light">
                            <div class="card-number text-light">
                                <h1>จำนวนครั้งที่ขาย  </h1>
                                <?php
                                foreach ($result3 as $results) { ?>
                                    <h1 class=" text-primary"><?php echo number_format($results["SUM2"]); ?></h1>
                                <?php }
                                ?>
                            </div>
                            <div class="date text-secondary">
                                <h4> รายการ (ทั้งหมด)</h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <!-- <h4 class="text-secondary"><?php echo $user["name"]; ?></h4> -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div> <br>
                </div>


                <div class="col-md-3 sm-3 mt-3">
                    <div class="card  elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(3,1,36,0.8589810924369747) 11%, rgba(5,61,18,1) 90%);">
                        <span class="bg-dark circle"></span>
                        <div class="top-div">
                            <div class="chip-image">
                                <!-- <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details">
                            <div class="card-number">
                                <h2>จำนวนเงินที่กำไร</h2>
                                <?php

                                $queryresultprofit = " SELECT (assetvolumesell * assetpricesell)-(assetvolume * assetprice) c FROM tb_sell as s INNER JOIN tb_journal as j on s.j_id=j.id WHERE s.ur_id ='$id' ORDER BY j.id ASC; ";
                                $resultprofit = mysqli_query($db_connection, $queryresultprofit);

                                $sum = 0;
                                $cout_profit = 0;
                                $cout_loss = 0;



                                foreach ($resultprofit as $results) {
                                    if (intval($results['c']) >  0) {
                                        $sum = $sum + intval($results['c']);
                                        $cout_profit++;

                                ?>

                                <?php } else {

                                        $cout_loss++;
                                    }
                                }
                                ?>
                                <h2 class=" text-primary"><?php echo (number_format($sum)); ?></h2>

                            </div>
                            <div class="date text-secondary">
                                <h4> THB (ทั้งหมด)</h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <!-- <h4 class="text-secondary"><?php echo $user["name"]; ?></h4> -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>
                <div class="col-md-3 sm-4 mt-3">
                    <div class="card   elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(0,0,0,0.7721463585434174) 11%, rgba(68,7,60,1) 71%);">
                        <span class="bg-dark circle"></span>
                        <div class="top-div">
                            <div class="chip-image">
                                <!-- <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details">
                            <div class="card-number">
                                <h2>จำนวนเงินที่ขาดทุน</h2>
                                <?php

                                $count = 0;

                                $queryresultloss = " SELECT (assetvolume * assetprice)-(assetvolumesell * assetpricesell) FROM tb_sell as s INNER JOIN tb_journal as j on s.j_id=j.id WHERE s.ur_id='$id' ORDER BY j.id ASC;";
                                $resultloss = mysqli_query($db_connection, $queryresultloss);

                                foreach ($resultloss as $results) {

                                    if ($count == 2) {

                                ?>
                                        <h2 class=" text-primary"><?php echo number_format($results["(assetvolume * assetprice)-(assetvolumesell * assetpricesell)"]); ?></h2>

                                <?php }
                                    $count++;
                                }
                                ?>


                            </div>
                            <div class="date text-secondary">
                                <h4> THB (ทั้งหมด)</h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <h4 class="text-secondary"><?php echo $user["name"]; ?></h4>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>


                <div class="col-md-3 sm-3 mt-3">
                    <div class="card  elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(3,1,36,0.8589810924369747) 11%, rgba(5,61,18,1) 90%);">
                        <span class="bg-dark circle"></span>
                        <div class="top-div">
                            <div class="chip-image">
                                <!-- <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details">
                            <div class="card-number">
                                <h2>จำนวนครั้งที่กำไร</h2>
                                <?php
                                // $queryresultprofitsum = " SELECT options, SUM(assetprice) AS sums FROM tb_journal WHERE `ur_id`='$id' ORDER BY id DESC";
                                // $sum = mysqli_query($db_connection, $queryresultprofitsum);
                                ?>

                                <h2 class=" text-primary"><?php echo ($cout_profit); ?></h2>


                            </div>
                            <div class="date text-secondary">
                                <h4> ครั้ง (ทั้งหมด) </h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <!-- <h4 class="text-secondary"><?php echo $user["name"]; ?></h4> -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/772px-Mastercard-logo.svg.png" />
                        </div>
                        <br><br>
                    </div>
                </div>

                <div class="col-md-3 sm-4 mt-3">
                    <div class="card   elevation-4" style="border-radius:40px; background: linear-gradient(90deg, rgba(0,0,0,0.7721463585434174) 11%, rgba(68,7,60,1) 71%);">
                        <span class="bg-dark circle"></span>
                        <div class="top-div">
                            <div class="chip-image">
                                <!-- <img src="https://seeklogo.com/images/C/Chip-logo-3C162A3B9B-seeklogo.com.png" /> -->
                                <img src="" />
                                <br>
                            </div>
                            <div class="plus-sign">
                                <h4> </h4>
                                <h4></h4>
                            </div>
                        </div>
                        <div class="card-details">
                            <div class="card-number">
                                <h2>จำนวนครั้งที่ขาดทุน</h2>
                                <?php
                                ?>
                                <h2 class=" text-primary"><?php echo ($cout_loss); ?></h2>
                            </div>
                            <div class="date text-secondary">
                                <h4> ครั้ง (ทั้งหมด) </h4>
                            </div>
                        </div>
                        <div class="ownername">
                            <!-- <h4 class="text-secondary"><?php echo $user["name"]; ?></h4> -->
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
            <br>
            <br>
            <br>
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