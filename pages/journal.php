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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOURNAL | <?php echo $user['name']; ?> </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  bg-dark ">
        <a class="navbar-brand ml-3 text-light" href="#">
            <img src="../assets/img/logo.png" width="30" height="30" alt="">
            <span>จดบันทึกและวิเคราะห์การลงทุน | </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="dashboard.php">DASHBOARD<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="journal.php">JOURNAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="performance.php">PERFORMANCE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="report.php">REPORTING</a>
                </li>
            </ul>
            <div class="col-8 col-md-5 col-lg-9 d-flex align-items-center  justify-content-md-end mt-3 mt-md-0">
                <div class="dropdown text-light">
                    <button class="btn   text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        สวัสดีตอนเที่ยงคุณ : <?php echo $user['name']; ?>
                        <img class="btn  dropdown-toggle" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" alt="img_user" width="60" height="45">
                    </button>

                    <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="survey.php">Risk Profile</a></li>
                        <li><a class="dropdown-item" href="profilesettings.php">Profile Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </nav>
    <div class="container-fluid ">
        <div class="row">
            <main class="col-md-7 ml-sm-auto col-lg-12 px-md-3 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb col-lg-12">
                        <h1 class="breadcrumb-item ">JOURNAL</h1>
                    </ol>
                    <br>
                </nav>
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">TRADING LOG</h5>

                            <div class="card-body text-right">
                                <button type="button" class='  btn btn-success view_data mb-3'><i class="fa fa-plus "> </i> เพิ่มบันทึกใหม่ </button>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="myTable" style="width: 100%;">
                                        <thead class="thead-dark mb-3">

                                            <th>
                                                หมวดหมู่
                                            </th>
                                            <th>
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
                                                รูปภาพ
                                            </th>
                                            <th>
                                                ราคาตัดขาดทุน
                                            </th>
                                            <th>
                                                ราคาขายทำกำไร
                                            </th>
                                            <th>
                                                ต้นทุนเฉลี่ย
                                            </th>
                                            <th>
                                                ต้นทุนเฉลี่ยทั้งหมด
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
                                            $get_user =  "SELECT * FROM tb_journal as j INNER JOIN tb_type as t on j.tb_type=t.Assettype_id WHERE `ur_id`='$id'";

                                            $result = mysqli_query($conn, $get_user);

                                            foreach ($result as $user) {
                                            ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $user['Assettype_name']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetname']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetprice']  ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $user['assetvolume']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetdate']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetnote']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetimge']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetsl']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assettg']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assetavgcost']  ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $user['assettotalcost']  ?>
                                                    </td>
                                                   
                                                    <td>
                                                        <a href="#" onclick="edit(<?php echo $row['id']; ?>);" data-toggle="modal" data-target="#dataModal" class='btn btn-warning btn-lg font1  p-1' style="width: 50px;height: 38px;"><i class='fas fa-cog'></i> </a>
                                                    </td>

                                                    <td>
                                                        <a href="#" onclick="javascript:del('<?php echo $row['id']; ?>');" class='btn btn-danger btn-lg  p-1' style="width: 50px;height: 38px;"><i class="fa-solid fa-box-archive"></i> </a>
                                                    </td>

                                                </tr>

                                            <?php


                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>
</body>

</html>