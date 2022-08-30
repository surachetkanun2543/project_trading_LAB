<?php 
    include_once('../../../service/connect.php'); 
    include_once('../authen.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>จัดการผู้ดูแลระบบ | AppzStory</title>
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../assets/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../assets/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <!-- stylesheet -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mali" >
  <link rel="stylesheet" href="../../plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include_once('../includes/sidebar.php') ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0 text-dark">จัดการผู้ดูแลระบบ</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">ผู้ดูแลระบบ</a></li>
                            <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="line-height: 2.1rem;">แก้ไขข้อมูล</h3>
                                <a href="index.php" class="btn btn-warning float-right">กลับ</a>
                            </div>
                            <form id="formData">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label for="first_name">ชื่อจริง</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="ชื่อจริง" value="ชื่อจริง" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="last_name">นามสกุล</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="นามสกุล" value="นามสกุล" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="username">ชื่อผู้ใช้งาน</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้งาน" value="ชื่อผู้ใช้งาน" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password">รหัสผ่าน</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" value="รหัสผ่าน" required>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="permission">สิทธิ์การใช้งาน</label>
                                            <select class="form-control" name="status" id="permission" required>
                                                <option value disabled>กำหนดสิทธิ์</option>
                                                <option value="superadmin">Super Admin</option>
                                                <option value="admin" selected>Admin</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="customFile">รูปโปรไฟล์</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">เลือกรูปภาพ</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php') ?>
</div>

<!-- SCRIPTS -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="../../assets/js/adminlte.min.js"></script>


<script>
    $(document).ready(function(){
        $('#formData').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'PUT',
                url: '../../../service/update.php',
                data: $('#formData').serialize()
            }).done(function(resp) {
                Swal.fire({
                    text: 'อัพเดทข้อมูลเรียบร้อย',
                    icon: 'success',
                    confirmButtonText: 'ตกลง',
                }).then((result) => {
                    location.assign('index.php');
                });
            })
        });
    });
</script>

</body>
</html>
