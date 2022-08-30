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
  <title>จัดการสินค้า | AppzStory</title>
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
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
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
                        <h5 class="m-0 text-dark">จัดการสินค้า</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">สินค้า</a></li>
                            <li class="breadcrumb-item active">เพื่มข้อมูล</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12  col-sm-10 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="line-height: 2.1rem;">เพื่มข้อมูล</h3>
                                <a href="index.php" class="btn btn-warning float-right">กลับ</a>
                            </div>
                            <form id="formData">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="cat_name">ประเภทสินค้า</label>
                                            <select class="custom-select mb-3" name="cat_name">
                                                <option disabled selected>Select Course Types</option>
                                                <option value="sClass">StoryClass</option>
                                                <option value="mClass">MiniCourse</option>
                                                <option value="fClass">FreeCourse</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label for="p_name">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="p_name" id="p_name" placeholder="ชื่อสินค้า" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="price">ราคา / บาท</label>
                                            <input type="text" class="form-control" name="price" id="price" placeholder="ราคา">
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label for="url">Link Course</label>
                                            <input type="text" class="form-control" name="url" id="url" placeholder="Link Course" >
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="customFile">รูปปก</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">เลือกรูปภาพ</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea id="details" class="textarea" name="details" placeholder="Place some text here">
                                            </textarea>
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

<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#details').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                }
            },
            height: 300,
        });

        $('#formData').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '../../../service/create.php',
                data: $('#formData').serialize()
            }).done(function(resp) {
                Swal.fire({
                    text: 'เพิ่มข้อมูลเรียบร้อย',
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
