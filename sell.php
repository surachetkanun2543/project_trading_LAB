<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//error_reporting(0);
session_start();
include "../service/user_connect_PDO.php";


if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}

$id = $_SESSION['login_id'];
$deletestmt = $conn->query("SELECT * FROM `tb_user` WHERE `google_id`='$id'");
$deletestmt->execute();
$data1 = $deletestmt->fetch();

if (isset($_POST['sell'])) {

    $userid = $_SESSION['login_id'];

    $assetname = $_POST['assetname'];
    $options = $_POST['options'];
    $assetpricesell = $_POST['assetpricesell'];
    $assetvolumesell = $_POST['assetvolumesell'];
    $assetdatesell = $_POST['assetdatesell'];
    $assetnote = $_POST['assetnote'];
    $ur_id = $_POST['ur_id'];
    $j_id = $_POST['j_id'];

    echo header('Location: index.php');;
    $sqll = "INSERT INTO tb_sell
    (assetname, options, assetpricesell,assetvolumesell,assetdatesell,assetnote,ur_id,j_id) 
   VALUES 
   (:assetname, :options, :assetpricesell, :assetvolumesell, :assetdatesell, :assetnote, :userid, :j_id )";

    echo 'ur_id ==>' . $ur_id;
    $sql = $conn->prepare($sqll);

    // $sql->bindParam(":id", $id, PDO::PARAM_INT);
    $sql->bindParam(":assetname", $assetname, PDO::PARAM_STR);
    $sql->bindParam(":options", $options, PDO::PARAM_STR);
    $sql->bindParam(":assetpricesell", $assetpricesell, PDO::PARAM_INT);
    $sql->bindParam(":assetvolumesell", $assetvolumesell, PDO::PARAM_INT);
    $sql->bindParam(":assetdatesell", $assetdatesell, PDO::PARAM_STR);
    $sql->bindParam(":assetnote", $assetnote, PDO::PARAM_STR);
    $sql->bindParam(":userid", $userid, PDO::PARAM_STR);
    $sql->bindParam(":j_id", $j_id, PDO::PARAM_INT);
    $sql->execute();

    if ($sql) {

        echo "<script> 
        $(document).ready(function(){
            Swal.fire({ 
                title: 'สำเร็จ!',
                text: 'ขายรายการเรียบร้อย !',
                icon: 'success',
                timer: 1000,
                showConfirmButton : false
            });
        });
        </script>";
        header("refresh:1 url=index.php");
    } else {
        $_SESSION['error'] = "ผิดพลาด";
        header("location: index.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PROFILE SETTING | <?php echo $user['name']; ?> </title>
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
    <div class="container mt-5">
        <h1>ขายสินทรัพย์</h1>
        <hr>
        <form action="sell.php" method="post" enctype="multipart/form-data">

            <?php
            if (isset($_GET['id'])) {
                $id = $_SESSION['login_id'];
                $stmt = $conn->query(
                    "SELECT 
                *
                FROM tb_journal 
                as j 
                INNER JOIN tb_type 
                as t 
                on j.Assettype_name=t.Assettype_id
                WHERE id = '{$_GET['id']}'"
                );

                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>

            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1"></span></label>
                <input type="hidden" name="j_id" id="j_id" class="form-control" readonly value="<?php echo $data['id']; ?>" />
            </div>

            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1"></span></label>
                <input class="form-control" readonly value="<?php echo $data['assetname']; ?>" id="assetname" name="assetname" type="text" placeholder="crypto 2, stock 1" required="" />
            </div>


            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="assetvolume">จำนวนที่ซื้อ<span class="text-danger ml-1"></span></label>
                <input class="form-control" readonly value="<?php echo $data['assetvolume']; ?>" id="assetvolume" name="assetvolume" type="number" placeholder="" required="">
            </div>

            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="assetprice">ราคาที่ซื้อ<span class="text-danger ml-1"></span></label>
                <input class="form-control" readonly value="<?php echo $data['assetprice']; ?>" id="assetprice" name="assetprice" type="number" placeholder="" required="">
            </div>
            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="options">สถานะ<span class="text-danger ml-1">*</span></label>
                <input class="form-control" id="options" name="options" type="text" placeholder="" required="sell" />
            </div>


            <div class="form-group col-lg-6">
                <label class="font-weight-bold text-small" for="assetpricesell">ราคาที่ขาย<span class="text-danger ml-1">*</span></label>
                <input class="form-control" id="assetpricesell" name="assetpricesell" type="number" placeholder="" required="" />
            </div>

            <div class="form-group col-lg-6">
                <label class="font-weight-bold text-small" for="assetvolumesell">จำนวนที่ขาย<span class="text-danger ml-1">*</span></label>
                <input class="form-control" id="assetvolumesell" name="assetvolumesell" type="number" placeholder="" required="" />
            </div>

            <div class="form-group col-lg-6">
                <label class="font-weight-bold text-small" for="assetdatesell">วันเดือนปีที่ขาย<span class="text-danger ml-1">*</span></label>
                <input class="form-control" id="assetdatesell" name="assetdatesell" type="date" placeholder="2022-08-31" />
            </div>


            <div class="form-group col-lg-12">
                <label class="font-weight-bold text-small" for="assetnote">บันทึกเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                <textarea class="form-control" id="assetnote" name="assetnote" rows="5" placeholder="" required=""></textarea>
            </div>

            <div class="form-group col-lg-12 ">
                <input type="hidden" name="ur_id" id="ur_id">
                <button type="submit" name="sell" class="btn btn-success text-light " name="j_id" id="j_id">ยืนยัน</button>
                <a href="index.php" class="btn btn-danger text-light">ยกเลิก</a>
            </div>
    </div>
    </form>
    </div>
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
</body>

</html>