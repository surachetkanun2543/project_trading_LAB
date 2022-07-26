<?php
include("check.php");
include('fnc.php');
//1. เชื่อมต่อ database:
include('../../service/admin_connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

$p_id = secureStr($_GET['ID']);
$p_id = $conn->escape_string($_GET['ID']);
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM tbl_product as p INNER JOIN tbl_type as t on p.type_id=t.type_id WHERE p.p_id = '$p_id' ORDER BY p.type_id asc";
$result2 = mysqli_query($conn, $sql) or die;
$row = mysqli_fetch_array($result2);
extract($row);

//2. query ข้อมูลจากตาราง 
$query = "SELECT * FROM tbl_type ORDER BY type_id asc" or die;
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
    <form name="addproduct" action="product_form_edit_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
      <input type="text" name="p_name" class="form-control" required placeholder="ชื่อสินค้า" value="<?php echo $p_name; ?>"><br>
      <input type="text" name="p_price" class="form-control" required placeholder="ราคาสินค้า" value="<?php echo $p_price; ?>">&ensp;
      <select name="type_id" class="form-control" required>
        <option value="<?php echo $row["type_id"]; ?>">
          <?php echo $row["type_name"]; ?>
        <option value="type_id">ประเภทสินค้า</option>
        <?php foreach ($result as $results) { ?>
          <option value="<?php echo $results["type_id"]; ?>">
            <?php echo $results["t_name"]; ?>
          </option>
        <?php } ?>
      </select>&ensp;
      <textarea name="p_detail" class="form-control"><?php echo $p_detail; ?></textarea>

      <img src="p_img/<?php echo $row['p_img']; ?>" width="200px">
      <div class="custom-file mb-3">
        <input type="file" name="p_img" id="p_img" class="custom-file-input" />
      </div>
      <div class="custom-file mb-2">
        <input type="file" name="p_img" id="p_img" class="custom-file-input" title="เลือกรูปภาพสินค้า">&ensp;
        <label class="custom-file-label" for="customFile">เลือกรูปภาพสินค้า</label>
      </div>
      <div class="card-body col-12 " align="right">
        <input type="hidden" name="p_id" value="<?php echo $p_id; ?>" />
        <input type="hidden" name="img2" value="<?php echo $p_img; ?>" />
        <button style="width: 60px;height: 40px;" type="submit" class="btn btn-outline-primary shadow p-1"> <span class="fa fa-cloud-upload"></span> </button>
        <a href="product.php" type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1"><span class="fa fa-repeat"></span></a>
      </div>
  </div>
</div>
</div>
</form>