<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content p-md-3">
                <div class="modal-header">
                    <h4 class="modal-title">กรุณากรอกข้อมูล </h4>
                </div>
                <hr>
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-small" for="assetprice">ชื่อ-สกุล<span class="text-danger ml-1">*</span></label>
                            <input class="form-control" id="assetprice" name="assetprice" type="text" placeholder="" required="">
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-small" for="assetvolume">อีเมล์<span class="text-danger ml-1">*</span></label>
                            <input class="form-control" id="assetvolume" name="assetvolume" type="text" placeholder="" required="" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="font-weight-bold text-small" for="assetsl">โทเคน ไลน์<span class="text-danger ml-1">*</span></label>
                            <input class="form-control" id="assetsl" name="assetsl" type="number" placeholder="" required="" />
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="font-weight-bold text-small" for="assetimge">รูปภาพโปรไฟล์<span class="text-danger ml-1">*</span></label>
                            <input type="file" required class="form-control" id="imgInput" name="assetimge">
                            <img loading="lazy" width="100%" id="previewImg" alt="">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="hidden" name="ur_id" id="ur_id">
                            <button type="submit" name="submit" class="btn btn-success">ยืนยัน</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>


    <!-- OPTIONAL SCRIPTS -->
    <script src="../../plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>


    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
    <!-- <div class=" bg-transparent" style="background-image: url('https://img.freepik.com/free-photo/abstract-luxury-gradient-blue-background-smooth-dark-blue-with-black-vignette-studio-banner_1258-108740.jpg?w=1380&t=st=1665642113~exp=1665642713~hmac=295ceedd5a8378dda40b0dfdbd53c266b9f1580eddc0fdba2ca7fb81d545495d'); background-repeat: no-repeat; background-size: cover;"> -->
        <div class="wrapper bg-transparent">
            <?php include_once('../pages/sidebar.php') ?>
            <div class="content-wrapper  bg-transparent">
                <br>
                <div class="content-header ml-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-wrapper elevation-3 col-lg-3" style="border-radius:45px;">
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
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>

                
                <main class="md-ml-sm-auto col-lg-6 py-2 "style="border-radius:35px;">
                    <div class="row">
                        <div class="col">
                                <div class="card text-center bg-light elevation-3 ml-4" style="border-radius:35px;">
                                    <div class="card-body bg-light text-left col-md-6 col-sm-6 ">
                                        <br>
                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold text-small" for="google_id">บัญชี Goolge</label>
                                            <input class="form-control" readonly value="<?php echo $user['google_id']; ?>" id="google_id" name="google_id" type="text" placeholder="crypto 2, stock 1" required="" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold text-small" for="name">ชื่อ-สกุล</label>
                                            <input class="form-control" readonly value="<?php echo $user['name']; ?>" id="name" name="name" type="text" placeholder="buy - sell" required="" />
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold text-small" for="email">อีเมล์</label>
                                            <input class="form-control" readonly value="<?php echo $user['email']; ?>" id="email" name="email" type="text" placeholder="" required="">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold text-small" for="Line_token">LINE TOKEN</label>
                                            <input class="form-control" readonly value="<?php echo $user['Line_token']; ?>" id="Line_token" name="Line_token" type="text" placeholder="" required="" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label class="font-weight-bold text-small" for="Line_token"></label>
                                            <img width="200px" style="border-radius:5px;" src="<?php echo $user['profile_image']; ?>">
                                            <br> <br>
                                            <a style="border-radius:5px;" type="button" href="edit.php?id=<?php echo $user['id']; ?>" class=" elevation-3  btn btn-warning ">
                                                <i class="fa-solid fa-pen-to-square"></i> แก้ไข</a>
                                        </div>
                                    </div>
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