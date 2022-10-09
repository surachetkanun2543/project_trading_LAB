<?php

require '../service/user_connect.php';


$query = "SELECT * FROM `tb_type` ORDER BY `tb_type`.`Assettype_id` ASC";
$result = mysqli_query($conn, $query);

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


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $$delete_id = $_GET['delete'];
    $deletestmt = mysqli_query($db_connection, "DELETE FROM tb_journal WHERE id = $delete_id");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>REPORT | <?php echo $user['name']; ?> </title>
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

<div class="wrapper">
    <?php include_once('../pages/sidebar.php') ?>
    <div class="content-wrapper  bg-dark">
        <br>
        <div class="content-header ml-4 " >
            <div class="container-fluid">
                <div class="row">
                    <div class="page-wrapper elevation-3 col-lg-3" style="border-radius:10px;">
                        <div class=" col-lg-10 ">
                            <br>
                            <h4 class="ml-4 text-dark"> ตั้งค่าโปรไฟล์ </h4>
                            <p class="ml-4 text-dark"> ( Profile setting ) </p>

                        </div>
                    </div>
                    <br> <br>
                </div>
            </div>
        </div>
        <main class="col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4">
            <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                    <div class="card  bg-dark elevation-3">
                        <div class="card-body text-center ">
                            <a  href="report-pdf.php" class="text-light btn btn-danger elevation-3 mr-4" style="border-radius:8px;">
                                <h5><i class="fa fa-file-pdf" aria-hidden="true"> </i></h5>
                                <h5 >รายงาน PDF</h5>
                            </a>
                            <a href="report-csv.php" class="text-light btn btn-success elevation-3" style="border-radius:8px;">
                                <h5><i class="fa fa-file-csv" aria-hidden="true"> </i></h5>
                                <h5>รายงาน CSV</h5>
                            </a>
                            <div  class="table-responsive" >
                                    <table class="table table-striped" id="myTable" style="width: 100%;">
                                        <thead class=" text-center table-secondary mb-1">
                                        <p></p>
                                        <th class=" text-dark ">
                                            สถานะ
                                        </th>
                                        <th class=" text-dark ">
                                            หมวดหมู่
                                        </th>
                                        <th class=" text-dark ">
                                            สินทรัพย์
                                        </th>
                                        <th class=" text-dark ">
                                            ราคาสินทรัพย์ที่ซื้อ (บาท)
                                        </th>

                                        <th class=" text-dark ">
                                            จำนวนสินทรัพย์ (หน่วย)
                                        </th>
                                        <th class=" text-dark ">
                                            วันที่ซื้อ
                                        </th>
                                        <th class=" text-dark ">
                                            บันทึก
                                        </th>

                                        <th class=" text-dark ">
                                            ราคาตัดขาดทุน (บาท)
                                        </th>
                                        <th class=" text-dark ">
                                            ราคาขายทำกำไร (บาท)
                                        </th>


                                    </thead>
                                    <tbody>
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
                                           <tr class="text-center text-light">
                                                <td><?php echo  $user['options']; ?></td>
                                                <td><?php echo $user['Assettype_name']; ?></td>
                                                <td><?php echo $user['assetname']; ?></td>
                                                <td><?php echo number_format($user['assetprice'], '2'); ?> บาท</td>
                                                <td><?php echo number_format($user['assetvolume'], '2'); ?> หน่วย</td>
                                                <td><?php echo $user['assetdate']; ?></td>
                                                <td><?php echo $user['assetnote']; ?></td>
                                                <td><?php echo number_format($user['assetsl'], '2'); ?> บาท</td>
                                                <td><?php echo number_format($user['assettg'], '2'); ?> บาท </td>



                                            </tr>
                                        <?php }  ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- JavaScript Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                        <script>
                            $(document).ready(function() {
                                $('#').DataTable();
                            });
                        </script>

                        <script>
                            let imgInput = document.getElementById('imgInput');
                            let previewImg = document.getElementById('previewImg');

                            imgInput.onchange = evt => {
                                const [file] = imgInput.files;
                                if (file) {
                                    previewImg.src = URL.createObjectURL(file)
                                }
                            }
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