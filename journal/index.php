<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//error_reporting(0);
require '../service/user_connect.php';
$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
}

$query = "SELECT * FROM `tb_type` ORDER BY `tb_type`.`Assettype_id` ASC";
$result = mysqli_query($conn, $query);

//"SELECT * FROM `tb_journal` ORDER BY `tb_journal`.`assetname` WHERE `ur_id`='$id' ASC";

$querysell = "SELECT * FROM tb_journal as j INNER JOIN tb_type as t on j.Assettype_name=t.Assettype_id  
WHERE `ur_id`='$id' 
ORDER BY `t`.`Assettype_name` ASC";
$resultsell = mysqli_query($conn, $querysell);


$queryselloptions = "SELECT * FROM tb_journal   
WHERE `ur_id`='$id' 
ORDER BY `tb_journal`.`options` ASC";
$resultselloptions = mysqli_query($conn, $queryselloptions);

$querybuydate = "SELECT * FROM tb_journal   
WHERE `ur_id`='$id' 
ORDER BY `tb_journal`.`assetdate` ASC";
$resultbuydate = mysqli_query($conn, $querybuydate);

$queryassetvolume = "SELECT * FROM tb_journal   
WHERE `ur_id`='$id' 
ORDER BY `tb_journal`.`assetvolume` ASC";
$resultassetvolume = mysqli_query($conn, $queryassetvolume);

$queryassetprice = "SELECT * FROM tb_journal   
WHERE `ur_id`='$id' 
ORDER BY `tb_journal`.`assetprice` ASC";
$resultassetprice = mysqli_query($conn, $queryassetprice);


if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
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

</head>
<script>
    $(document).ready(function($) {
        $('#myForm').on('submit', function(evt) {
            $('#send').hide();
        });
    });
</script>

<body class="hold-transition sidebar-mini">
    <div class="modal fade " id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
            <div class="modal-content p-md-3  text-light" style="border-radius:40px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 40%, rgba(40,38,38,0.6713060224089635) 100%);">
                <div class="modal-header bg-success mt-3" style="border-radius:40px;">
                    <h3 class="modal-title  text-dark text-center">กรุณากรอกข้อมูลการซื้อ </h3>
                </div>
                <div class="modal-body">
                    <form action="insert.php" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" style="border-radius:40px;" for="Assettype_name">ประเภทสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <select style="border-radius:40px;" name="Assettype_name" class="form-control" required>
                                    <option style="border-radius:40px;" value="Assettype_id">เลือก</option>
                                    <?php foreach ($result as $results) { ?>
                                        <option style="border-radius:40px;" value="<?php echo $results["Assettype_id"]; ?>">
                                            <?php echo $results["Assettype_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="options">สถานะ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="options" name="options" type="text" placeholder="buy" required="buy" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assetname" name="assetname" type="text" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetprice">ราคาสินทรัพย์<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assetprice" name="assetprice" type="number" placeholder="" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetvolume">จำนวนที่ซื้อ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assetvolume" name="assetvolume" type="text" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetsl">วันเดือนปีที่ซื้อ<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assetdate" name="assetdate" type="date" placeholder="2022-08-31" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assetsl">ราคาตัดขาดทุน<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assetsl" name="assetsl" type="number" placeholder="" required="" />
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="font-weight-bold text-small" for="assettg">ราคาทำกำไร<span class="text-danger ml-1">*</span></label>
                                <input class="form-control" style="border-radius:40px;" id="assettg" name="assettg" type="number" placeholder="" required="" /><small class="form-text text-muted"></small>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetnote">บันทึกเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                                <textarea class="form-control" style="border-radius:40px;" id="assetnote" name="assetnote" rows="5" placeholder="" required=""></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold text-small" for="assetimge">บันทึกรูปภาพเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                                <input type="file" style="border-radius:40px;" required class="form-control" id="imgInput" name="assetimge">
                                <img loading="lazy" width="100%" id="previewImg" alt="">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="ur_id" id="ur_id">
                                <button type="submit" style="border-radius:40px;" name="submit" class="btn btn-success text-light">ยืนยัน</button>
                                <button type="button" style="border-radius:40px;" class="btn btn-danger text-light" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
        <div class="wrapper bg-transparent">
            <?php include_once('../pages/sidebar.php') ?>
            <div class="content-wrapper  bg-transparent">
                <div class="content-header ml-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" elevation-3 bg-dark col-lg-3" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                <div class=" col-lg-10 ">
                                    <br>
                                    <h4 class="ml-4 text-light"> บันทึกรายการซื้อขาย </h4>
                                    <p class="ml-4 text-light"> (trading journal) </p>
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

                <main class=" col-md-7 ml-sm-auto col-lg-12 px-md-4 py-4 ">
                    <div class="row">
                        <div class="col-lg-12  mb-4 mb-lg-0">

                            <button type="button" class="text-light btn btn-success mb-3 ml-3 pt-3 text-center elevation-3" style="border-radius:30px;" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">

                                <h4> เพิ่มรายการซื้อ <i class="fa-solid fa-pen-to-square"> </i></h4>
                            </button> <br>
                            <div class="card" style="border-radius:50px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 20%, rgba(40,38,38,0.6713060224089635) 100%);">
                                <div class="card-body  elevation-4" style="border-radius:50px; background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">

                                    <button type="button" class="elevation-4  bg-transparent text-light btn btn-success mb-3 pt-3 text-right  mr-4" style="border-radius:40px;">
                                        <h5> รายการซื้อ
                                        </h5>
                                    </button>

                                    <div class="table" style="border-radius:50px;">
                                        <table class=" table" style="border-radius:50px;" id="myTable" style="width: 100%;">
                                            <thead class=" text-center thead-dark text-light mb-1" style="border-radius:35px;">
                                                <th>
                                                    สถานะ
                                                </th>
                                                <th>
                                                    หมวด
                                                </th>
                                                <th>
                                                    สินทรัพย์
                                                </th>
                                                <th>
                                                    ราคาสินทรัพย์ที่ซื้อ (บาท)
                                                </th>

                                                <th>
                                                    จำนวนสินทรัพย์ (หน่วย)
                                                </th>
                                                <th>
                                                    วันที่ซื้อ
                                                </th>
                                                <th>
                                                    บันทึก
                                                </th>

                                                <th>
                                                    ราคาตัดขาดทุน (บาท)
                                                </th>
                                                <th>
                                                    ราคาขายทำกำไร (บาท)
                                                </th>
                                                <th>
                                                    รูปภาพ
                                                </th>
                                                <th>
                                                    <h4>ขาย</h4>
                                                </th>

                                                <th>
                                                    <h4>แก้ไข</h4>
                                                </th>
                                                <th>
                                                    <h4>ลบ</h4>
                                                </th>
                                                <th>
                                                    <h4>ไลน์</h4>
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
                                                        <td> <button type="button" class=" btn btn-success btn-sm  text-light" style="border-radius:35px;"><?php echo  $user['options']; ?></button></td>
                                                        <td><?php echo $user['Assettype_name']; ?></td>
                                                        <td><?php echo $user['assetname']; ?></td>
                                                        <td><?php echo number_format($user['assetprice'], '2'); ?> บาท </td>
                                                        <td><?php echo number_format($user['assetvolume'], '2'); ?> หน่วย </td>
                                                        <td><?php echo $user['assetdate']; ?></td>
                                                        <td><?php echo $user['assetnote']; ?></td>
                                                        <td><?php echo number_format($user['assetsl'], '2'); ?> บาท </td>
                                                        <td><?php echo number_format($user['assettg'], '2'); ?> บาท </td>


                                                        <td><img class="rounded elevation-2" style="border-radius:20px;" width="130px" src="uploads/<?php echo $user['assetimge']; ?>"></td>

                                                        <td><a class="text-light btn btn-info elevation-3" style="border-radius:25px;" href="sell2.php?id=<?php echo $user['id']; ?>" value="Send" onclick="this.style.display='none';"><i class="fa-brands fa-paypal"></i><br>
                                                                <h1></h1>
                                                            </a></td>

                                                        <td><a type="button" class="btn btn-warning elevation-3" style="border-radius:25px;" href="edit.php?id=<?php echo $user['id']; ?>" class=""><i class="fa-solid fa-pen-to-square"></i><br>
                                                                <h1></h1>
                                                            </a>

                                                        <td><a style="border-radius:25px;" data-id="<?= $user['id']; ?>" href="?delete=<?= $user['id']; ?>" href="?delete=<?php echo $user['id']; ?>" class="text-light btn btn-danger delete-btn elevation-3"><i class="text-light fa-solid fa-trash"></i>
                                                                <h1></h1>
                                                            </a></td>

                                                        <td><a style="border-radius:25px;" href="line.php?options=<?php echo $user['assetname']; ?> || สถานะ : <?php echo $user['options']; ?> || ราคาซื้อสินทรัพย์ : <?php echo $user['assetprice']; ?>  ||  วันที่ซื้อสินทรัพย์ : <?php echo $user['assetdate']; ?>" class="btn btn-success text-center text-white elevation-3"><i class="fa-brands fa-line"> </i>
                                                                <h1></h1>
                                                            </a></td>

                                                    </tr>

                                                <?php }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><br>

                            <div class=" col-lg-12  mb-4 mt-4 mr-4 ">
                                <div class="card " style="border-radius:50px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 20%, rgba(40,38,38,0.6713060224089635) 100%);">
                                    <div class="card-body  elevation-4" style="border-radius:50px; background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                        <div class="table" style="border-radius:50px;">
                                            <button type="button" class="elevation-4  bg-transparent text-light btn btn-danger mb-3 pt-3 text-right  mr-4" style="border-radius:20px;">
                                                <h5> รายการขาย
                                                </h5>
                                            </button>
                                            <table class=" table " id="myTable" style="width: 100%;" style="border-radius:50px;">
                                                <thead class=" text-center thead-dark text-light mb-1">
                                                    <th>
                                                        สถานะ
                                                    </th>
                                                    <th>
                                                        สินทรัพย์
                                                    </th>

                                                    <th>
                                                        ราคาสินทรัพย์ที่ขาย (บาท)
                                                    </th>
                                                    <th>
                                                        จำนวนสินทรัพย์ที่ขาย (หน่วย)
                                                    </th>
                                                    <th>
                                                        วันที่ขาย
                                                    </th>
                                                    <th>
                                                        บันทึก
                                                    </th>


                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    $id = $_SESSION['login_id'];
                                                    $get_user =
                                                        "SELECT 
                                            *
                                            FROM tb_sell 
                                            WHERE `ur_id`='$id' 
                                            ORDER BY `tb_sell`.`id` ASC";

                                                    $result = mysqli_query($conn, $get_user);

                                                    foreach ($result as $user) {
                                                    ?>
                                                        <tr class="text-center text-light">

                                                            <td> <button type="button" class=" btn btn-danger btn-sm  text-light" style="border-radius:35px;"><?php echo  $user['options']; ?></button></td>
                                                            <td><?php echo  $user['assetname']; ?></td>
                                                            <td><?php echo $user['assetpricesell']; ?> บาท</td>
                                                            <td><?php echo number_format($user['assetvolumesell'], '2'); ?> หน่วย </td>
                                                            <td><?php echo $user['assetdatesell']; ?></td>
                                                            <td><?php echo $user['assetnote']; ?></td>
                                                        </tr>

                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script> -->

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