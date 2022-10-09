<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
include "../service/user_connect_PDO.php";

if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $assetname = $_POST['assetname'];
    $options = $_POST['options'];
    $assetprice = $_POST['assetprice'];
    $assetvolume = $_POST['assetvolume'];
    $assetdate = $_POST['assetdate'];
    $assetnote = $_POST['assetnote'];
    $assetsl = $_POST['assetsl'];
    $assettg = $_POST['assettg'];
    $ur_id = $_POST['ur_id'];
    $assetimge = $_FILES['assetimge'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['assetimge']['name'];

    if ($upload != '') {

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $assetimge['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/' . $fileNew;


        if (in_array($fileActExt, $allow)) {
            if ($assetimge['size'] > 0 && $assetimge['error'] == 0) {
                move_uploaded_file($assetimge['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }

    $sql = $conn->prepare("UPDATE tb_journal SET assetname = :assetname, options = :options, assetprice = :assetprice, 
    assetvolume = :assetvolume,
    assetdate = :assetdate,
    assetnote = :assetnote,
    assetsl = :assetsl,
    assettg = :assettg,
    assetimge = :assetimge
    WHERE id=:id ");

    $sql->bindValue(":id", $id, PDO::PARAM_INT);
    $sql->bindParam(":assetname", $assetname, PDO::PARAM_STR);
    $sql->bindParam(":options", $options, PDO::PARAM_STR);
    $sql->bindParam(":assetprice", $assetprice, PDO::PARAM_STR);
    $sql->bindParam(":assetvolume", $assetvolume, PDO::PARAM_STR);
    $sql->bindParam(":assetdate", $assetdate, PDO::PARAM_STR);
    $sql->bindParam(":assetnote", $assetnote, PDO::PARAM_STR);
    $sql->bindParam(":assetsl", $assetsl, PDO::PARAM_STR);
    $sql->bindValue(":assettg", $assettg, PDO::PARAM_STR);
    $sql->bindParam(":assetimge", $fileNew);
    $sql->execute();




    if ($sql) {

        echo "<script> 
        $(document).ready(function(){
            Swal.fire({ 
                title: 'สำเร็จ!',
                text: 'แก้ไขรายการเรียบร้อย !',
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
    <title>JOURNAL | <?php echo $data1['name']; ?> แก้ไขข้อมูลบันทึก </title>
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

    <!-- Charts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>


<body class="hold-transition sidebar-mini">

    <div class="container mt-5">
        <h1>แก้ไขข้อมูล</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
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
                WHERE `ur_id`=$id ");

                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>

            <div class="row">


                <div class="form-group col-lg-12">
                    <label class="font-weight-bold text-small" for="Assettype_name">ประเภทสินทรัพย์<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" readonly value="<?php echo $data['Assettype_name']; ?>" id="Assettype_name" name="Assettype_name" type="text" placeholder="crypto 2, stock 1" required="" />
                </div>
                <div class="form-group col-lg-6">
                    <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetname']; ?>" id="assetname" name="assetname" type="text" placeholder="" required="" />
                    <input type="hidden" value="<?php echo $data['assetimge']; ?>" required class="form-control" name="img2">
                    <input type="hidden" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id">
                </div>
                <div class="form-group col-lg-12">
                    <label class="font-weight-bold text-small" for="options">สถานะ<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" readonly value="<?php echo $data['options']; ?>" id="options" name="options" type="text" placeholder="buy - sell" required="" />
                </div>
                <div class="form-group col-lg-6">
                    <label class="font-weight-bold text-small" for="assetprice">ราคาสินทรัพย์<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetprice']; ?>" id="assetprice" name="assetprice" type="number" placeholder="" required="">
                </div>
                <div class="form-group col-lg-12">
                    <label class="font-weight-bold text-small" for="assetvolume">จำนวนที่ซื้อ<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetvolume']; ?>" id="assetvolume" name="assetvolume" type="text" placeholder="" required="" />
                </div>
                <div class="form-group col-lg-6">
                    <label class="font-weight-bold text-small" for="assetdate">วันเดือนปีที่ซื้อ<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetdate']; ?>" id="assetdate" name="assetdate" type="text" placeholder="2022-08-31" />
                </div>
                <div class="form-group col-lg-6">
                    <label class="font-weight-bold text-small" for="assetsl">ราคาตัดขาดทุน<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetsl']; ?>" id="assetsl" name="assetsl" type="number" placeholder="" required="" />
                </div>
                <div class="form-group col-lg-6">
                    <label class="font-weight-bold text-small" for="assettg">ราคาทำกำไร<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assettg']; ?>" id="assettg" name="assettg" type="number" placeholder="" required="" /><small class="form-text text-muted"></small>
                </div>
                <div class="form-group col-lg-12">
                    <label class="font-weight-bold text-small" for="assetnote">บันทึกเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                    <input class="form-control" value="<?php echo $data['assetnote']; ?>" id="assetnote" name="assetnote" rows="5" placeholder="" required=""></input>
                </div>
                <div class="form-group col-lg-12">
                    <label class="font-weight-bold text-small" for="assetimge">บันทึกรูปภาพเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                    <input type="file" value="<?php echo $data['assetimge']; ?>" required class="form-control" id="imgInput" name="assetimge">
                    <br>
                    <img loading="lazy" src="uploads/<?php echo $data['assetimge']; ?>" width="100%" id="previewImg" alt="">



                    <hr>
                </div>
                <div class="form-group col-lg-12">
                    <input type="hidden" name="ur_id" id="ur_id">
                    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                    <button type="submit" name="update" class="btn btn-success">ยืนยัน</button>
        </form>
        <hr>
    </div>
    </div>
    <hr>

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