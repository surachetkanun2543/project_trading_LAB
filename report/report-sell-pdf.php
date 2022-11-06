

<?php
require('fpdf/fpdf.php'); // แทรกไฟล์ที่เก็บฟังก์ชันของไฟล์  PDF
require '../service/user_connect.php';

$query = "SELECT * FROM `tb_type` ORDER BY `tb_type`.`Assettype_id` ASC";
$result = mysqli_query($conn, $query);

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
$sql =
    "SELECT 
                                            *
                                            FROM tb_sell 
                                            WHERE `ur_id`='$id' 
                                            ORDER BY `tb_sell`.`id` ASC";
$query_sql = mysqli_query($conn, $sql);
$result_sql = mysqli_fetch_array($query_sql);
mysqli_data_seek($query_sql, 0);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('sarabun', 'B', 'THSarabunB.php'); // แทกฟอนต์  (sarabun เรากำหนดเป็นชื่ออะไรก็ได้)  ฟอนต์ตัวหนา
$pdf->AddFont('sarabun', '', 'THSarabun.php'); // ฟอนต์ตัวปกติ

$pdf->Image('../assets/img/logo.png', 15, 10, 24, 23);
$pdf->Image('bg.png', 10, 30, 35, 20);


// ระบุตัวเลขที่ต้องการหางจากบรรทัดบนกี่เซ็น
$pdf->SetFont('sarabun', 'B', 14);

date_default_timezone_set('US/Eastern');
$currentdate = date("d-m-Y");


$pdf->Cell(190, 10, 'journaltrading.tech', 0, 0, 'C');

$pdf->Ln(2);


$pdf->Cell(190, 20, $currentdate, 0, 0, 'C');


$pdf->Ln(45);

$pdf->Cell(190, 8, iconv('utf-8', 'cp874',  'รายการจดบันทึก : รายการขาย '), 1, 2, '');
$pdf->Cell(190, 8, iconv('utf-8', 'cp874',  $user['name']), 1, 2, '');
//$pdf->Cell(190, 18, iconv('utf-8', 'cp874', 'รายการจดบันทึก '), 1, 5, 'C');

$pdf->Cell(10, 12, iconv('utf-8', 'cp874', 'รหัส'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'สถานะ'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'ชื่อสินทรัพย์'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'ราคาขาย'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'จำนวนขาย'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'วันที่ขาย'), 1, 0, 'C');
$pdf->Cell(30, 12, iconv('utf-8', 'cp874', 'บันทึก'), 1, 1, 'C');

while ($result_sql = mysqli_fetch_array($query_sql)) {
    $pdf->SetFont('sarabun', '', 12); // เป็นการกำหนดฟอนต์ให้กับข้อความแบบตัวปกติ

    $pdf->Cell(10, 10, iconv('utf-8', 'cp874', $result_sql['id']), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', $result_sql['options']), 1,0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', $result_sql['assetsellname']), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', number_format($result_sql['assetpricesell'])), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', number_format($result_sql['assetvolumesell'])), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', $result_sql['assetdatesell']), 1, 0, 'C');
    $pdf->Cell(30, 10, iconv('utf-8', 'cp874', $result_sql['assetnote']), 1, 1, 'C');
}
$pdf->Output();


?>

