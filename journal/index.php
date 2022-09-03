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

    <div class="wrapper">
        <?php include_once('../pages/sidebar.php') ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <br>
                            <h4 class="ml-5 text-dark"> บันทึกรายการซื้อขาย</h4>
                            <hr>
                        </div>
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

            <main class="col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                        <div class="card">
                            <div class="card-body text-right">
                                <button type="button" class=" btn btn-success view_data mb-2" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"><i class="fa fa-plus "> </i>เพิ่มบันทึกใหม่</button>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="myTable" style="width: 100%;">
                                        <thead class="table-dark mb-1">
                                            <hr>
                                            <th scope="col">
                                                สถานะ
                                            </th>
                                            <th scope="col">
                                                หมวดหมู่
                                            </th>
                                            <th scope="col">
                                                สินทรัพย์
                                            </th>
                                            <th>
                                                ราคาสินทรัพย์ที่ซื้อ
                                            </th>

                                            <th>
                                                จำนวนสินทรัพย์
                                            </th>
                                            <th>
                                                วันที่ซื้อ
                                            </th>
                                            <th>
                                                บันทึก
                                            </th>

                                            <th>
                                                ราคาตัดขาดทุน
                                            </th>
                                            <th>
                                                ราคาขายทำกำไร
                                            </th>
                                            <th>
                                                รูปภาพ
                                            </th>
                                            <th>
                                                แก้ไข
                                            </th>
                                            <th>
                                                ลบ
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
                                                <tr>
                                                    <td><?php echo $user['options']; ?></td>
                                                    <td><?php echo $user['Assettype_name']; ?></td>
                                                    <td><?php echo $user['assetname']; ?></td>
                                                    <td><?php echo $user['assetprice']; ?></td>
                                                    <td><?php echo $user['assetvolume']; ?></td>
                                                    <td><?php echo $user['assetdate']; ?></td>
                                                    <td><?php echo $user['assetnote']; ?></td>
                                                    <td><?php echo $user['assetsl']; ?></td>
                                                    <td><?php echo $user['assettg']; ?></td>

                                                    <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $user['assetimge']; ?>"></td>

                                                    <td><a type="button" class="btn btn-warning " href="edit.php?id=<?php echo $user['id']; ?>" class="">แก้ไข</a></td>

                                                    <td><a data-id="<?= $user['id']; ?>" href="?delete=<?= $user['id']; ?>" href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger delete-btn">ลบ</a></td>
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
                                                            timer: '2000'
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
</body>

</html>