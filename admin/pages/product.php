<!DOCTYPE html>
<html>

<head>
    <title>จัดการสินค้า</title>

    <?php
    include('h.php');
    include("check.php");
    include('../../service/admin_connect.php');
    error_reporting(error_reporting() & ~E_NOTICE);

    $query = "SELECT * FROM tb_type ORDER BY Assettype_id asc" or die;
    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
    $result = mysqli_query($conn, $query);
    //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
    //2. query ข้อมูลจากตาราง 
    ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script language-="javascript">
        $().ready(function() {
            swal({
                position: 'top-left',
                buttons: false,
                title: 'ยินดีต้อนรับเข้าสู่',
                text: "หน้าจัดการสินค้า",
                timer: 700
            })
            show(1);
            // search
            $('#btsearch').click(function() {
                show(1);
            });

            $('.view_data').ready(function(){
                $('#dataModal').modal('show');
            })

        });

        function show(page) {
            $("#showContain").load("product_list.php?page=" + page, {
                q_name: $("#q_name").val()
            }, function() {});
        }

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

</head>
<nav>
    <?php include('nav.php') ?>
</nav>
<div class="container">
    <div class="card-body col-12">
    <h1 class="h3 font-weight-bold m-3" style="color: black;">หน้าจัดการแบบประเมินความเสี่ยง</h1>
    <hr/>
        <div class="container-fluid col-12">
            <div class="s128">
                <form action="javascript:;" method="post">
                    <div class="inner-form">
                        <div class="row">
                            <div class="input-field first">
                                <input style="font-family: 'Athiti', sans-serif;" type="search" name="q_name" id="q_name" placeholder="ค้นหา"><br>&ensp;
                                <!-- <a class='btn btn-outline btn-lg ' name="dataModal"id="dataModal" style="color:lightgrey;" href="product.php?act=add"><i class="fa fa-plus"></i> </a> -->
                                <button type="button" style="color:lightgrey;" class='btn btn-outline btn-lg view_data' data-toggle="modal" data-target="#dataModal"><i class="fa fa-plus"></i></button>
                                <button style="display: none;" id="btsearch" type="submit">ค้นหา</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<div class="row">
    <div class="col-md-12">
        <?php
        $act = $_GET['act'];

        if ($act == 'edit') {
            include('product_form_edit.php');
            echo "<div id='showContain'></div>";
        } else {
            echo "<div id='showContain'></div>";
        }
        ?>
    </div>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#44437a;color: white;">
                <strong class="modal-title">เพิ่มรายการสินค้า</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form name="addproduct" action="product_form_add_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <input type="text" name="p_name" class="form-control" required placeholder="ชื่อสินค้า" />&ensp;
                    <input type="text" name="p_price" class="form-control" required placeholder="ราคาสินค้า" />&ensp;
                    <select name="Assettype_id" class="form-control" required>
                        <option value="Assettype_id">ประเภทสินค้า</option>
                        <?php foreach ($result as $results) { ?>
                            <option value="<?php echo $results["Assettype_id"]; ?>">
                                <?php echo $results["Assettype_name"]; ?>
                            </option>
                        <?php } ?>
                    </select>&ensp;
                    <textarea name="p_detail" class="form-control" required placeholder="รายละเอียดสินค้า"></textarea>&ensp;
                    <div class="custom-file mb-3">
                        <input type="file" name="p_img" id="p_img" class="custom-file-input" title="เลือกรูปภาพสินค้า">&ensp;
                        <label class="custom-file-label" for="customFile">เลือกรูปภาพสินค้า</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button style="width: 60px;height: 40px;" type="submit" id="btn" class="btn btn-outline-primary shadow p-1" glyphicon glyphicon-ok"> <span class="fa fa-cloud-upload"></span> </button>&ensp;
                <button type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1" data-dismiss="modal"><span class="fa fa-repeat"></span></button>
            </div>
        </div>
        </form>
    </div>
</div>
</body>

</html>