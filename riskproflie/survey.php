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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>risk assessment | <?php echo $user['name']; ?> </title>
  <link href="../css/dashboard.css" rel="stylesheet">

  <!-- Favicons -->
  <link rel="manifest" href="../assetsuser/img/favicons/site.webmanifest">
  <link rel="shortcut icon" href="../assets/img/logo.png">
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


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include_once('../pages/sidebar.php') ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            <div class="row">
                        <div class="col-sm-6">
                            <br>
                            <h3 class="ml-5 text-dark"> แบบประเมินความเสี่ยง </h3>
                            <p class="ml-5 text-dark"> (risk assessment form) </ย>
                            <hr>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </div>

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


      <form name="frmMain" method="post" action="save.php" OnSubmit="return fncSubmit();">
        <table width="950" border="0" align="center" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
            <br>
            <td colspan="8" align="center">
              <h3>แบบประเมินความเสี่ยงการลงทุน</h3>
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
            <td colspan="7" class="text-light mb-3 mt-3 ">แบบประเมิน ส่วนที่ 2 </td>
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
              <td  width="574"><?= $name ?> </td>
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
    </div>
  </div>
</form>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>


  <!-- SCRIPTS -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assetsuser/js/adminlte.min.js"></script>


  <!-- OPTIONAL SCRIPTS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <script src="../assetsuser/js/pages/dashboard.js"></script>


</body>

</html>