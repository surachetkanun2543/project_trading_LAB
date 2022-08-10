<?php
include("check.php");
//1. เชื่อมต่อ database:
include('../../service/admin_connect.php'); //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//2. query ข้อมูลจากตาราง tb_member:
$query = "SELECT * FROM tb_type ORDER BY Assettype_id asc" or die;
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($conn, $query);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

?>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<div class="card-body col-12 shadow p-0 mb-3 ">
    <div class="card-header " style="background-color:#44437a;color: white;">
        <strong>เพิ่ม / แก้ไข ข้อมูล</strong>
    </div>
    <div class="card-body col-12">
        <div id="report" class="alert-danger"></div>
        <form name="addjournal" action="journal_form_add_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
            <textarea name="p_detail" class="form-control"></textarea>&ensp;
            <div class="custom-file mb-3">
                <input type="file" name="p_img" id="p_img" class="custom-file-input" title="เลือกรูปภาพสินค้า" accept="image/png, image/gif, image/jpeg">&ensp;
                <label class="custom-file-label" for="customFile">เลือกรูปภาพสินค้า</label>
            </div>
            <div class="card-body col-12 " align="right">
                <input type="hidden" name="p_id" id="p_id">
                <button style="width: 60px;height: 40px;" type="submit" id="btn" class="btn btn-outline-primary shadow p-1" glyphicon glyphicon-ok"> <span class="fa fa-cloud-upload"></span> </button>&ensp;
                <button type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1"><span class="fa fa-repeat"></span></button>
            </div>
    </div>
</div>
</form>