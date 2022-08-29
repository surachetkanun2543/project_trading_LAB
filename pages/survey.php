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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
  <link href="../css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <title>ประเมินความเสี่ยง | <?php echo $user['name']; ?> </title>

</head>

<body>



  <script language="JavaScript">
    function fncSubmit() {

      if (document.frmMain.rdo_gender_0.checked == false && document.frmMain.rdo_gender_1.checked == false) {
        alert('กรุณาระบุ เพศ');
        return false;
      }

      if (document.frmMain.rdo_age_0.checked == false && document.frmMain.rdo_age_1.checked == false && document.frmMain.rdo_age_2.checked == false && document.frmMain.rdo_age_3.checked == false && document.frmMain.rdo_age_4.checked == false && document.frmMain.rdo_age_5.checked == false) {
        alert('กรุณาระบุ อายุ');
        return false;
      }

      if (document.frmMain.rdo_education_0.checked == false && document.frmMain.rdo_education_1.checked == false && document.frmMain.rdo_education_2.checked == false && document.frmMain.rdo_education_3.checked == false) {
        alert('กรุณาระบุ ระดับการศึกษาสูงสุด');
        return false;
      }

      if (document.frmMain.rdo_state_0.checked == false && document.frmMain.rdo_state_1.checked == false && document.frmMain.rdo_state_2.checked == false && document.frmMain.rdo_state_3.checked == false && document.frmMain.rdo_state_4.checked == false && document.frmMain.rdo_state_5.checked == false && document.frmMain.rdo_state_6.checked == false) {
        alert('กรุณาระบุ  สถานะภาพ');
        return false;
      }

      var Rows = document.frmMain.hdnRows.value;
      for (x = 1; x <= Rows; x++) {
        var op1 = document.getElementById("radionNo" + x + "_1");
        var op2 = document.getElementById("radionNo" + x + "_2");
        var op3 = document.getElementById("radionNo" + x + "_3");
        var op4 = document.getElementById("radionNo" + x + "_4");
        var op5 = document.getElementById("radionNo" + x + "_5");
        if (op1.checked == false && op2.checked == false && op3.checked == false && op4.checked == false && op5.checked == false) {
          alert('Please select Answer No ' + x);
          return false;
        }
      }

    }
  </script>

  <nav class="navbar navbar-expand-lg navbar-light  bg-dark ">
    <a class="navbar-brand ml-3 text-light" href="#">
      <img src="../assets/img/logo.png" width="30" height="30" alt="">
      <span>จดบันทึกและวิเคราะห์การลงทุน | </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
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

  <form name="frmMain" method="post" action="save.php" OnSubmit="return fncSubmit();">
    <table width="950" border="0" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <td>&nbsp;</td>
        <br>
        <td colspan="8" align="center">
          <h3>แบบประเมินความเสี่ยง การลงทุน</h3>
          <p>(ใช้เพื่อประเมินความเสี่ยงในการลงทุนของตนเอง)</p>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr bgcolor="#343A40">
        <td>&nbsp;</td>
        <td colspan="7" class="text-light">ข้อมูลเบื้องต้น ส่วนที่ 1</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="157">เพศ</td>
        <td width="387">
          <label>
            <input type="radio" name="rdo_gender" value="ชาย" id="rdo_gender_0" />
            ชาย</label>
          <label>
            <input type="radio" name="rdo_gender" value="หญิง" id="rdo_gender_1" />
            หญิง</label>
        </td>
        <td width="68">&nbsp;</td>
        <td width="60">&nbsp;</td>
        <td width="69">&nbsp;</td>
        <td width="65">&nbsp;</td>
        <td width="78">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>อายุ</td>
        <td>
          <label>
            <input type="radio" name="rdo_age" value="อายุ ต่ำกว่า 20 ปี" id="rdo_age_0" />
            อายุ ต่ำกว่า 20 ปี</label>
          <br />
          <label>
            <input type="radio" name="rdo_age" value="อายุระหว่าง 21 - 30 ปี" id="rdo_age_1" />
            อายุระหว่าง 21 - 30 ปี</label>
          <br />
          <label>
            <input type="radio" name="rdo_age" value="อายุระหว่าง 31 - 40 ปี" id="rdo_age_2" />
            อายุระหว่าง 31 - 40 ปี</label>
          <br />
          <label>
            <input type="radio" name="rdo_age" value="อายุระหว่าง 41 - 50 ปี" id="rdo_age_3" />
            อายุระหว่าง 41 - 50 ปี</label>
          <br />
          <label>
            <input type="radio" name="rdo_age" value="อายุระหว่าง 51 - 59 ปี" id="rdo_age_4" />
            อายุระหว่าง 51 - 59 ปี</label>
          <br />
          <label>
            <input type="radio" name="rdo_age" value="อายุ 60 ปีขึ้นไป" id="rdo_age_5" />
            อายุ 60 ปีขึ้นไป</label>

        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>ระดับการศึกษาสูงสุด</td>
        <td>
          <label>
            <input type="radio" name="rdo_education" value="ประถมศึกษา" id="rdo_education_0">
            ประถมศึกษา</label>
          <br>
          <label>
            <input type="radio" name="rdo_education" value="มัธยมศึกษาตอนต้น/ตอนปลาย/เทียบเท่า" id="rdo_education_1">
            มัธยมศึกษาตอนต้น/ตอนปลาย/เทียบเท่า</label>
          <br>
          <label>
            <input type="radio" name="rdo_education" value="ปริญญาตรี" id="rdo_education_2">
            ปริญญาตรี</label>
          <br>
          <label>
            <input type="radio" name="rdo_education" value="สูงกว่าปริญญาตรี" id="rdo_education_3">
            สูงกว่าปริญญาตรี</label>
          <br>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>สถานะภาพ</td>
        <td>
          <label>
            <input type="radio" name="rdo_state" value="ผู้บริหาร" id="rdo_state_0" />
            ผู้บริหาร</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="อาจารย์" id="rdo_state_1" />
            อาจารย์</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="เจ้าหน้าที่" id="rdo_state_2" />
            เจ้าหน้าที่</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="นักเรียน/นักศึกษา" id="rdo_state_3" />
            นักเรียน/นักศึกษา</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="ศิษย์เก่า" id="rdo_state_4" />
            ศิษย์เก่า</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="ประชาชนทั่วไป" id="rdo_state_5" />
            ประชาชนทั่วไป</label>
          <br />
          <label>
            <input type="radio" name="rdo_state" value="อื่นๆ" id="rdo_state_6" />
            อื่นๆ</label>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr bgcolor="#343A40">
        <td>&nbsp;</td>
        <td colspan="7" class="text-light mb-3 mt-3">แบบประเมิน ส่วนที่ 2 </td>
      </tr>
      <tr>

        <td>&nbsp;
          <hr />
        </td>
        <td>&nbsp;
          <hr />
        </td>
        <td>รายการ
          <hr />
        </td>
        <td align="center">มากที่สุด
          <hr />
        </td>
        <td align="center">มาก
          <hr />
        </td>
        <td align="center">กลาง
          <hr />
        </td>
        <td align="center">น้อย
          <hr />
        </td>
        <td align="center">น้อยที่สุด
          <hr />
        </td>

      </tr>

    </table>
    <table width="950" border="0" align="center">
      <?
      $query = "select * from tb_question ";

      $objQuery = mysqli_query($conn, $query);
      $Num_Rows = mysqli_num_rows($objQuery);



      $i = 1;
      while ($result2 = mysqli_fetch_array($objQuery)) {
        $id_chk = $result2['id_question']; //รหัสคำถาม
        $name = $result2['question']; // ชื่อคำถาม
      ?>

        <tr>
          <td width="574"><?= $name ?> </td>
          <td>&nbsp;</td>
          <td width="70" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_5" type="radio" value="5"></td>
          <td>&nbsp;</td>
          <td width="63" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_4" type="radio" value="4"></td>
          <td>&nbsp;</td>
          <td width="71" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_3" type="radio" value="3"></td>
          <td>&nbsp;</td>
          <td width="65" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_2" type="radio" value="2"></td>
          <td>&nbsp;</td>
          <td width="81" align="center"><input name="radionNo<?= $i; ?>" id="radionNo<?= $i; ?>_1" type="radio" value="1"></td>
        </tr>
      <?
        $i++;
      }

      ?>
    </table>


    <div class="container">
      <div class="row">
        <div class="col text-center mt-3 mb-4">
          <input type="hidden" name="hdnRows" value="<?= $i - 1; ?>">
          <hr>
          <!-- <center><br /><input type="submit" name="Submit" value="ตอบแบบสอบถาม"></center> -->
          <br /><button type="submit" name="Submit" value="ตอบแบบสอบถาม" class="btn btn-success">
            <h5>ยืนยันส่งแบบประเมินความเสี่ยง</h5>
          </button>
        </div>
      </div>
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
</body>

</html>