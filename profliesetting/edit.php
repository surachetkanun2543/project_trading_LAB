<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

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

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $Line_token = $_POST['Line_token'];
    $ur_id = $_POST['ur_id'];
    $profile_image = $_FILES['profile_image'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['profile_image']['name'];

    if ($upload != '') {

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $profile_image['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/' . $fileNew;


        if (in_array($fileActExt, $allow)) {
            if ($profile_image['size'] > 0 && $profile_image['error'] == 0) {
                move_uploaded_file($profile_image['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }

    $sql = $conn->prepare(
        "UPDATE 
        tb_user 
        SET  name = :name, 
        email = :email, 
        Line_token = :Line_token, 
        profile_image = :profile_image
        WHERE id=:id ");

    $sql->bindValue(":id", $id, PDO::PARAM_INT);
    $sql->bindParam(":name", $name, PDO::PARAM_STR);
    $sql->bindParam(":email", $email, PDO::PARAM_STR);
    $sql->bindParam(":Line_token", $Line_token, PDO::PARAM_STR);


    $sql->bindParam(":profile_image", $fileNew);
    $sql->execute();




    if ($sql) {
        
        echo "<script> 
        $(document).ready(function(){
            Swal.fire({ 
                title: 'สำเร็จ!',
                text: 'แก้ไขรายการเรียบร้อย !',
                icon: 'success',
                timer: 2000,
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
    <title>PROFLIE SETTING | <?php echo $data1['name']; ?> แก้ไขข้อมูลบันทึก </title>
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
                $stmt = $conn->query("SELECT * FROM `tb_user` WHERE `google_id`='$id'");
                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>

            <div class="row">


            
                <div class="form-group col-lg-6">
                    <h5 class="font-weight-bold text-small" for="name">ชื่อ-สกุล<span class="text-danger ml-1">*</span></h5>
                    <input class="form-control" value="<?php echo $data['name']; ?>" id="name" name="name" type="text" placeholder="" required="" />
                    <input type="hidden" value="<?php echo $data['name']; ?>" required class="form-control" name="img2">
                    <input type="hidden" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id">
                </div>
                <div class="form-group col-lg-12">
                    <h5 class="font-weight-bold text-small" for="email">อีมเมล์<span class="text-danger ml-1">*</span></h5>
                    <input class="form-control"  value="<?php echo $data['email']; ?>" id="email" name="email" type="text" placeholder="" required="" />
                </div>
             
                <div class="form-group col-lg-6">
                    <h5 class="font-weight-bold text-small" for="Line_token">โทเคน ไลน์<span class="text-danger ml-1">*</span></h5>
                    <input class="form-control" value="<?php echo $data['Line_token']; ?>" id="Line_token" name="Line_token" type="text" placeholder="" required="" /><small class="form-text text-muted"></small>
                </div>
                
                <div class="form-group col-lg-12">
                    <h5 class="font-weight-bold text-small" for="profile_image">รูปภาพโปรไฟล์<span class="text-danger ml-1"></span></h5>
                    <input type="file" value="<?php echo $data['profile_image']; ?>"  class="form-control" id="imgInput" name="profile_image">
                    <br>
                    <img loading="lazy" src="uploads/<?php echo $data['profile_image']; ?>" width="150px" id="previewImg" alt="">

                    <hr>
                </div>
                <div class="form-group col-lg-12 text-center">
                    <input type="hidden" name="ur_id" id="ur_id">
                    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                    <button type="submit" name="update" class="btn btn-success">ยืนยัน</button>
        </form>
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