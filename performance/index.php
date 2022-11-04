<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

require '../service/user_connect.php';

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
    <title>performance | <?php echo $user['name']; ?> </title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Charts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SCRIPTS -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>


    <!-- OPTIONAL SCRIPTS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>

</head>



<body class="hold-transition sidebar-mini">
    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
        <div class="wrapper bg-transparent">
            <?php include_once('../pages/sidebar.php') ?>
            <div class="content-wrapper bg-transparent">
                <br>
                <div class="content-header ml-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" elevation-3 bg-dark col-lg-3" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                <div class=" col-lg-10 ">
                                    <br>
                                    <h4 class="ml-4 text-light">สรุปรายการซื้อขาย </h4>
                                    <p class="ml-4 text-light"> (summary journal) </p>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <main class=" col-md-7 ml-sm-auto col-lg-12 px-md-4 py-4 ">
                    <div class="row">
                        <div class="col-lg-12  mb-4 mb-lg-0">
                            <div class="card" style="border-radius:45px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 20%, rgba(40,38,38,0.6713060224089635) 100%);">
                                <div class="card-body  elevation-4" style="border-radius:45px; background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">

                                    <button type="button" class="elevation-4  bg-transparent text-light btn btn-info mb-3 pt-3 text-right  mr-4" style="border-radius:40px;">
                                        <h5> รายการวิเคราะห์
                                        </h5>
                                    </button>
                                    <table class=" table table-striped" id="myTable" style="width: 100%;" style="border-radius:45px;">
                                        <thead class=" text-center thead-dark text-light mb-1">

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
                                                จำนวนสินทรัพย์ (หน่วย)
                                            </th>
                                            <th>
                                                วันที่ซื้อ
                                            </th>
                                            <th>
                                                วันที่ขาย
                                            </th>
                                            <th>
                                                จำนวนวันที่ถือครอง (วัน)
                                            </th>
                                            <th>
                                                <h5>กำไร/ขาดทุน (บาท)</h5>
                                            </th>
                                            <th>
                                                <h5> เปอร์เซ็น กำไร/ขาดทุน</h5>
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $get_tablesell = ("SELECT * FROM tb_sell 
                                                as j 
                                                INNER JOIN tb_journal 
                                                as t 
                                                on j.j_id=t.id 
                                                ORDER BY `t`.`id`"
                                            );

                                            $result_tablesell = mysqli_query($conn, $get_tablesell);

                                            foreach ($result_tablesell as $results) {


                                                $earlier = new DateTime($results['assetdate']);
                                                $later = new DateTime($results['assetdatesell']);

                                                $assetdate =  $results['assetdate']; // $_POST['startdate'] 
                                                $assetdatesell = $results['assetdatesell']; // $_POST['enddate']

                                                // n1 จำนวนที่ซื้อ n2 ราคาซื้อ
                                                //ซื้อ
                                                $N = $results['assetvolume'] * $results['assetprice'];
                                                //ขาย
                                                $Y = $results['assetvolumesell'] * $results['assetpricesell'];


                                                if ($Y > $N) {

                                                    $p = $Y - $N;

                                                    $pp = ($p * 100) / $N;

                                                    //แสดงเงินกำไร
                                                    $res .= " <h4 class='text-light btn btn-outline-success pt-2 pb-2' style='border-radius:30px' ;>  " . " กำไร  " . number_format($p) . " บาท" . "</h4>";

                                                    //แสดงเปอร์เซ้นกำไร
                                                    $ress .= "<h4 class='text-light btn btn-outline-success pt-2 pb-2' style='border-radius:30px' ;>  " . "   " .  $pp .  " %" .  "</h5>";


                                                    //ถ้าราคาซื้อมากกว่าราคาขาย ขาดทุน
                                                } else {
                                                    //ราคาต้นทุนลบราคาขาย
                                                    $l = $N - $Y;

                                                    $lp = ($l * 100) / $N;

                                                    //แสดงเงินขาดทุน
                                                    $res .= " <h4 class='text-light btn btn-outline-danger pt-2 pb-2' style='border-radius:30px' ;>  " . " ขาดทุน  " . number_format($l) . " บาท" . "</p>";

                                                    //แสดงเปอร์เซ้นกำไร
                                                    $ress .= "<h4 class='text-light btn btn-outline-danger  pt-2 pb-2' style='border-radius:30px' ;>   " . "   " .  $lp .  " %" .  "<p>";
                                                }


                                            ?>
                                                <tr class="text-center text-light">

                                                    <!-- ชื่อสินทรัพย์ -->
                                                    <td><?php echo $results['assetname']; ?></td>

                                                    <!-- ราคาซื้อสินทรัพย์ -->
                                                    <td><?php echo number_format($results['assetprice']); ?></td>

                                                    <!-- ราคาขายสินทรัพย์ -->
                                                    <td><?php echo number_format($results['assetpricesell']); ?></td>

                                                    <!-- จำนวนสินทรัพย์ -->
                                                    <td><?php echo $results['assetvolumesell']; ?></td>

                                                    <!-- จำนวนที่ซื้อสินทรัพย์ -->
                                                    <td><?php echo $results['assetdate']; ?></td>

                                                    <!-- จำนวนที่ขายสินทรัพย์ -->
                                                    <td><?php echo $results['assetdatesell']; ?></td>

                                                    <!-- จำนวนที่ถือครองสินทรัพย์ -->

                                                    <td>
                                                        <?php echo $pos_diff = $earlier->diff($later)->format("%r%a"); ?>
                                                    </td>

                                                    <!-- จำนวนเงินกำไร/ขาดทุน -->
                                                    <td>
                                                        <?php echo $res; ?>
                                                    </td>

                                                    <!-- จำนวนเปอร์เซ็นกำไร/ขาดทุน -->
                                                    <td><?php echo $ress; ?></td>


                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- JavaScript Bundle with Popper -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <script>
                        $(document).ready(function() {
                            $('#myTable').DataTable();
                        });
                    </script>
                    <!-- SCRIPTS -->
                    <script src="../plugins/jquery/jquery.min.js"></script>
                    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="../assetsuser/js/adminlte.min.js"></script>


                    <!-- OPTIONAL SCRIPTS -->
                    <script src="../plugins/chart.js/Chart.min.js"></script>
                    <script src="../assetsuser/js/pages/dashboard.js"></script>
</body>

</html>