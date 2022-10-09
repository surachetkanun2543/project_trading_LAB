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




<body class="hold-transition sidebar-mini">
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content p-md-3">
                <div class="modal-header">
                    <h4 class="modal-title">กรุณากรอกข้อมูล </h4>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="insert.php" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="Assettype_name">ประเภทสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <select name="Assettype_name" class="form-control" required>
                                    <option value="Assettype_id">เลือก</option>
                                    <?php foreach ($result as $results) { ?>
                                        <option value="<?php echo $results["Assettype_id"]; ?>">
                                            <?php echo $results["Assettype_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="options">สถานะ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="options" name="options" type="text" placeholder="buy  , sell" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assetname" name="assetname" type="text" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetprice">ราคาสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assetprice" name="assetprice" type="number" placeholder="" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetvolume">จำนวนที่ซื้อ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assetvolume" name="assetvolume" type="text" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetsl">วันเดือนปีที่ซื้อ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assetdate" name="assetdate" type="date" placeholder="2022-08-31" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetsl">ราคาตัดขาดทุน<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assetsl" name="assetsl" type="number" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assettg">ราคาทำกำไร<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" id="assettg" name="assettg" type="number" placeholder="" required="" /><small class="form-text text-muted"></small>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetnote">บันทึกเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                                <textarea class="form-control" id="assetnote" name="assetnote" rows="5" placeholder="" required=""></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetimge">บันทึกรูปภาพเพิ่มเติม<span class="text-danger ml-1">*</span></label>
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



    <div class="wrapper ">
        <?php include_once('../pages/sidebar.php') ?>
        <div class="content-wrapper  bg-dark">
            <br>
            <div class="content-header ml-4">
                <div class="container-fluid">
                    <div class="row">
                    <div class="page-wrapper elevation-3 col-lg-3" style="border-radius:10px;">
                            <div class=" col-lg-10 ">
                                <br>
                                <h4 class="ml-4 text-dark"> บันทึกรายการซื้อขาย </h4>
                                <p class="ml-4 text-dark"> (trading journal) </p>

                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['success'])) { ?>
                <div classs="container p-5 text-center">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 m-auto">
                            <div class="alert alert-success elevation-3  fade show" role="alert" style="border-radius:10px;">
                                <h4> <?php
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                        ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger elevation-3 fade show" role="alert" style="border-radius:10px;">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <main class=" col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4 ">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                        <div class="card">
                            <div class="card-body text-right  bg-dark elevation-3" >
                                <button type="button" class="text-light btn btn-success view_data mb-2 mr-2 elevation-3" style="border-radius:8px;" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"><i class="fa fa-usd "> </i> เพิ่มบันทึกการซื้อ</button>
                                <button type="button" class="text-light btn btn-danger view_data mb-2 elevation-3" style="border-radius:8px;" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"><i class="fa fa-usd "> </i> เพิ่มบันทึกการขาย</button>
                                <div  class="table-responsive" >
                                    <table class="table table-striped" id="myTable" style="width: 100%;">
                                        <thead class=" text-center table-secondary mb-1">
                                            <hr>
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
                                            <th class=" text-dark ">
                                                รูปภาพ
                                            </th>
                                            <th class=" text-warning ">
                                                แก้ไข
                                            </th>
                                            <th class=" text-danger ">
                                                ลบ
                                            </th>
                                            <th class=" text-success ">
                                                แจ้งเตือน Line
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
                                                <tr class="text-center text-light">
                                                    <td><?php echo  $user['options']; ?></td>
                                                    <td><?php echo $user['Assettype_name']; ?></td>
                                                    <td><?php echo $user['assetname']; ?></td>
                                                    <td><?php echo number_format($user['assetprice'], '2'); ?> บาท </td>
                                                    <td><?php echo number_format($user['assetvolume'], '2'); ?> หน่วย </td>
                                                    <td><?php echo $user['assetdate']; ?></td>
                                                    <td><?php echo $user['assetnote']; ?></td>
                                                    <td><?php echo number_format($user['assetsl'], '2'); ?> บาท </td>
                                                    <td><?php echo number_format($user['assettg'], '2'); ?> บาท </td>

                                                    <td><img class="rounded elevation-2" width="150px" src="uploads/<?php echo $user['assetimge']; ?>"></td>

                                                    <td><a type="button" class="btn btn-warning elevation-3" style="border-radius:8px;" href="edit.php?id=<?php echo $user['id']; ?>" class=""><i class="fa-solid fa-pen-to-square"></i><br><h1></h1></a>

                                                    <td><a style="border-radius:8px;" data-id="<?= $user['id']; ?>" href="?delete=<?= $user['id']; ?>" href="?delete=<?php echo $user['id']; ?>" class="text-light btn btn-danger delete-btn elevation-3"><i class="text-light fa-solid fa-trash"></i><h1></h1></a></td>

                                                    <td><a style="border-radius:8px;" href="line.php?options=<?php echo $user['assetname']; ?> || สถานะ : <?php echo $user['options']; ?> || ราคาซื้อสินทรัพย์ : <?php echo $user['assetprice']; ?>  ||  วันที่ซื้อสินทรัพย์ : <?php echo $user['assetdate']; ?>" class="btn btn-success text-center text-white elevation-3"><i class="fa-brands fa-line"> </i><h1></h1></a></td>
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
                                    $('#myTable').DataTable();
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
                                $(".delete-btn").click(function(e) {
                                    var userId = $(this).data('id');
                                    e.preventDefault();
                                    deleteConfirm(userId);
                                })


                                function deleteConfirm(userId) {

                                    Swal.fire({
                                        title: 'ลบรายการ !',
                                        text: "คุณแน่ใจหรือไม่ที่จะลบรายการ ?",
                                        icon: 'warning',
                                        dangerMode: true,
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'ใช่แน่ใจ!',
                                        showLoaderOnConfirm: true,
                                        preConfirm: function() {
                                            return new Promise(function(resolve) {
                                                $.ajax({
                                                        url: 'index.php',
                                                        type: 'GET',
                                                        data: 'delete=' + userId,
                                                    })
                                                    .done(function() {

                                                        Swal.fire({
                                                            title: 'สำเร็จ',
                                                            text: 'ลบรายการเรียบร้อย !',
                                                            icon: 'success',
                                                            timer: '1000'
                                                        }).then(() => {
                                                            document.location.href = 'index.php';
                                                        })
                                                    })
                                                    .fail(function() {
                                                        Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                                        window.location.reload();
                                                    });
                                            });
                                        },
                                    });
                                }
                            </script>

                            <!-- SCRIPTS -->
                            <script src="../plugins/jquery/jquery.min.js"></script>
                            <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                            <script src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
                            <script src="../assetsuser/js/adminlte.min.js"></script>


                            <!-- OPTIONAL SCRIPTS -->
                            <script src="../plugins/chart.js/Chart.min.js"></script>
                            <script src="../assetsuser/js/pages/dashboard.js"></script>


                            <!-- OPTIONAL SCRIPTS -->
                            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
                            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
                            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>


</body>

</html>