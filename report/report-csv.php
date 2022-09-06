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
$id = $_SESSION['login_id'];
$sql = "SELECT 
*
FROM tb_journal 
as j 
INNER JOIN tb_type 
as t 
on j.Assettype_name=t.Assettype_id   
WHERE `ur_id`='$id' 
ORDER BY `t`.`Assettype_name` ASC";
$query_sql = mysqli_query($conn, $sql);
$result_sql = mysqli_fetch_array($query_sql);
mysqli_data_seek($query_sql, 0);


if ($query_sql->num_rows > 0) {
    $delimiter = ",";
    $filenamecsv = "Statement.csv";
    $filename = "Statement";

    //create a file pointer for write
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('id', 'options', 'assetname', 'assetprice', 'assetvolume', 'assetdate', 'assetnote');
    fputcsv($f, $fields, $delimiter);

    //write to file
    while ($row  = $result_sql = mysqli_fetch_array($query_sql)) {
        $lineData = array($row['id'], $row['options'], $row['assetname'], $row['assetprice'], $row['assetvolume'], $row['assetdate'], $row['assetnote']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);

    //set headers to download file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '" ของคุณ "' . $user['name'] . '"."' . $filenamecsv . '"');

    fpassthru($f);
}
exit;
