<?php
session_start();
session_regenerate_id(true);
// change the information according to your database
$db_connection = mysqli_connect("202.28.34.205","62011211078","62011211078","62011211078");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}


$conn = mysqli_connect("202.28.34.205","62011211078","62011211078","62011211078") or die;
?>

