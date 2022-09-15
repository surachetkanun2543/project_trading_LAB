<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


require './service/user_connect.php';

$get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` ORDER BY id=3");
$user = mysqli_fetch_assoc($get_user);

//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'noti@journaltrading.tech';                     //SMTP username
$mail->Password   = 'Book-15571';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('noti@journaltrading.tech', 'BOOK CEO OF THEWEB');
$mail->addAddress($user['email'], 'Joe User');     //Add a recipient            //Name is optional
$mail->addReplyTo('noti@journaltrading.tech', 'BOOK CEO OF THEWEB');
// $mail->addCC('62011211078@msu.ac.th');
// $mail->addBCC('62011211078@msu.ac.th');

//Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
$mail->addAttachment('./assets/img/notiemail.png', 'notiemail.jpg');    //Optional name

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
header('Location: index.php');
//echo 'Message has been sent';

