<?php
include("check.php");
include('fnc.php');
include('../../service/admin_connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

$p_id = secureStr($_GET['ID']);
$p_id = $conn->escape_string($_GET['ID']);
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM tb_questions as p INNER JOIN tb_type as t on p.Assettype_id=t.Assettype_id WHERE p.p_id = '$p_id' ORDER BY p.Assettype_id asc";
$result2 = mysqli_query($conn, $sql) or die;
$row = mysqli_fetch_array($result2);
extract($row);

//2. query ข้อมูลจากตาราง 
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
    <form name="addquestions" action="questions_form_edit_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
      <input type="text" name="p_name" class="form-control" required placeholder="หัวข้อตาราง" value="<?php echo $p_name; ?>"><br>
      <input type="text" name="p_price" class="form-control" required placeholder="คำถาม" value="<?php echo $p_price; ?>">&ensp;
        <button style="width: 60px;height: 40px;" type="submit" class="btn btn-outline-primary shadow p-1"> <span class="fa fa-cloud-upload"></span> </button>
        <a href="questions.php" type="reset" style="width: 60px;height: 40px;" class="btn btn-outline-danger shadow p-1"><span class="fa fa-repeat"></span></a>
      </div>
  </div>
</div>
</div>
</form>