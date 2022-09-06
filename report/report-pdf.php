
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


$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('sarabun', 'B', 'THSarabunB.php'); // แทกฟอนต์  (sarabun เรากำหนดเป็นชื่ออะไรก็ได้)  ฟอนต์ตัวหนา
$pdf->AddFont('sarabun', '', 'THSarabun.php'); // ฟอนต์ตัวปกติ

$pdf->Image('logo.png', 170, 10, 24, 23);
$pdf->Image('bg.png', 165, 35, 35, 23);

$pdf->Ln(50); // ระบุตัวเลขที่ต้องการหางจากบรรทัดบนกี่เซ็น

$pdf->SetFont('sarabun', 'B', 16); // เป็// เป็นการกำหนดฟอนต์ให้กับข้อความแบบตัวหนา
$pdf->Cell(190, 8, iconv('utf-8', 'cp874',  'รายการจดบันทึก เรียนคุณ'), 1, 2, '');
$pdf->Cell(190, 8, iconv('utf-8', 'cp874',  $user['name'] ), 1, 2, '');
$pdf->Cell(190, 18, iconv('utf-8', 'cp874', 'รายการจดบันทึก '), 1, 5, 'C');
$pdf->Cell(10, 15, iconv('utf-8', 'cp874', 'รหัส'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'หมวดหมู่'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'ชื่อสินทรัพย์'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'สถานะ'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'ราคา'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'จำนวน'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'วันที่ซื้อ'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'โน๊ต'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'ตัดขาดทุน'), 1, 0, 'C');
$pdf->Cell(20, 15, iconv('utf-8', 'cp874', 'ทำกำไร'), 1, 1, 'C');

while ($result_sql = mysqli_fetch_array($query_sql)) {
    $pdf->SetFont('sarabun', '', 12); // เป็นการกำหนดฟอนต์ให้กับข้อความแบบตัวปกติ

    $pdf->Cell(10, 10, iconv('utf-8', 'cp874', $result_sql['id']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['Assettype_name']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetname']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['options']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetprice']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetvolume']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetdate']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetnote']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assetsl']), 1, 0, 'C');
    $pdf->Cell(20, 10, iconv('utf-8', 'cp874', $result_sql['assettg']), 1, 1, 'C');
}
$pdf->Output();
