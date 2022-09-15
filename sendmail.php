<?


require './service/user_connect.php';

$get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` WHERE id = '$id'");
$user = mysqli_fetch_assoc($get_user);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php'; // path to the PHPMailer class.

$fm = "noti@journaltrading.tech"; // *** ต้องใช้อีเมล์ @yourdomain.com เท่านั้น  ***
$to = "surache2543@gmail.com"; // อีเมล์ที่ใช้รับข้อมูลจากแบบฟอร์ม
$custemail = $_POST['email']; // อีเมล์ของผู้ติดต่อที่กรอกผ่านแบบฟอร์ม

$subj = $_POST['subject'];

/* ------------------------------------------------------------------------------------------------------------- */
$message .= "ชื่อ-นามสกุล: " . $_POST['name'] . "\n";
$message .= "หัวข้อ: " . $_POST['subject'] . "\n";
$message .= "รายละเอียด: " . $_POST['details'] . "\n";
/* ------------------------------------------------------------------------------------------------------------- */

$mesg = $message;

$mail = new PHPMailer();
$mail->CharSet = "utf-8";

/* ------------------------------------------------------------------------------------------------------------- */
/* ตั้งค่าการส่งอีเมล์ โดยใช้ SMTP ของ โฮสต์ */
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'noti@journaltrading.tech';                     //SMTP username
$mail->Password   = 'Book-15571';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;
/* ------------------------------------------------------------------------------------------------------------- */

$mail->setFrom('noti@journaltrading.tech', 'journaltrading.tech');
$mail->addAddress($user['email'], 'test');
$mail->addReplyTo('62011211078@msu.ac.th', 'BOOK SURACHET ceo and cofounder journaltrading.tech');
$mail->Subject = $subj;
$mail->Body     = $mesg;
$mail->WordWrap = 500;
//
if (!$mail->Send()) {
    echo 'Message was not sent.';
    echo 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้ ' . $mail->ErrorInfo;
    exit;
} else {
    echo '<script type="text/javascript">
    window.onload = function () { alert("success"); } 
</script>';
    echo 'ส่งเมลล์สำเร็จ';
}
