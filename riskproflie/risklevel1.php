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


</head>

<body class="hold-transition sidebar-mini">
    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
        <div class="wrapper " >
            <?php include_once('../pages/sidebar.php') ?>
            <div class="content-wrapper" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  elevation-3 " >
                    <div class="card-header   text-center bg-dark"><br>
                        <h2>
                            คุณ <?php echo $user['name']; ?> คือผู้ลงทุนประเภท </h2>
                    </div>

                    <img style="padding: 10px; width: 1100px; height: 650px;" class="responsive " src="../assets/img/save1.png" alt="risklevel1" />
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title font-weight-bold">เคล็ด (ไม่ลับ)</h4>
                        <h5 class="card-text"> -------------- ‘การจัดพอร์ตลงทุน’ ก็แสนง่าย นั่นคือ ต้องรู้และเข้าใจสินทรัพย์ที่จะลงทุน, ลงทุนในจำนวนที่พอดี ที่เราสามารถดูแลได้ไหว และติดตามข้อมูลข่าวสาร ปรับพอร์ตให้เข้ากับสถานการณ์ ที่สำคัญการจัดพอร์ตกองทุนรวมในปัจจุบันไม่ได้ใช้เงินลงทุนมากอย่างที่คิด สามารถเลือกลงทุนด้วยตัวเองได้ง่าย ๆ หรือ ใครที่จัดพอร์ตไม่เป็น ในปัจจุบันก็มีหลายแห่งที่ให้บริการจัดพอร์ตลงทุนแบบอัตโนมัติผ่าน ‘Robo Advisor’ ซึ่งไม่ได้เสียค่าธรรมเนียมเพิ่มด้วย ซึ่งนักลงทุนที่สนใจสามารถติดตามแนวคิดในเรื่องการจัดพอร์ตลงทุนและข้อมูลที่เกี่ยวกับการลงทุนเพิ่มเติมได้จากเว็บไซต์</h5>
                        <a href="https://www.setinvestnow.com/th/knowledge/article/300-adver7-mf-1b" class="btn btn-primary mb-5 elevation-3">เพิ่มเติม คลิ๊ก!</a>
                    </div>
                </div> <br>
            </div>
        </div>
    </div>
</body>

</html>