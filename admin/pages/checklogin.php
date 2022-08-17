<?php
session_start();
include('../../service/admin_connect.php');
error_reporting(error_reporting() & ~E_NOTICE);
include("fnc.php");
header("");

if (!empty($_POST['txt_user']) && !empty($_POST['txt_pass'])) {

  $password =  secureStr($_POST['txt_pass']);
  $rs = $conn->query("select * from tbl_admin where admin_user='" . $conn->escape_string($_POST['txt_user']) . "' and admin_pass='" . $conn->escape_string($password) . "' limit 1");
  echo $conn->error;
  $row = mysqli_fetch_array($rs);

  if (mysqli_num_rows($rs) == 1) {

    $status = "ok";
    $msg = "ok";
    $_SESSION["admin_id"] = $row["admin_id"];
    $_SESSION["admin_name"] = $row["admin_name"];
    $_SESSION['logStatus'] = 1;
  } else {

    $status = "";
    $msg =  "ข้อมูลไม่ถูกต้อง";
    echo "<script>";
    echo "alert(\" ข้อมูลไม่ถูกต้อง โปรดลองอีกครั้ง\");";
   // echo "window.history.back()";
    echo "</script>";
  }
} else {
  $status = "";
  $msg =  "ข้อมูลไม่ครบ";
  echo "<script>";
  echo "alert(\" ข้อมูลไม่ครบ โปรดลองอีกครั้ง\");";
  echo "window.history.back()";
  echo "</script>";
}

echo '{"status":"' . $status . '","msg":"' . $msg . '"}';
