<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

session_start();
include "../service/user_connect_PDO.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}

$id = $_SESSION['login_id'];
$deletestmt = $conn->query("SELECT * FROM `tb_user` WHERE `google_id`='$id'");
$deletestmt->execute();
$data1 = $deletestmt->fetch();


if (isset($_POST['submit'])) {

    $options = $_POST['options'];
    $assetname = $_POST['assetname'];
    $Assettype_name = $_POST['Assettype_name'];
    $assetprice = $_POST['assetprice'];
    $assetvolume = $_POST['assetvolume'];
    $assetdate = $_POST['assetdate'];
    $assetnote = $_POST['assetnote'];
    $assetsl = $_POST['assetsl'];
    $assettg = $_POST['assettg'];
    $ur_id = $_POST['ur_id'];
    $assetimge = $_FILES['assetimge'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $assetimge['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = 'uploads/' . $fileNew;

    // PHPMailer////////////////////////////////////////////////////////////////

    $mail->SMTPDebug = 0;                //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noti@journaltrading.tech';                     //SMTP username
    $mail->Password   = 'Book-15571';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Journal Success ! ';
    $mail->Body = ' New announcement |  บันทึกรายการเรียบร้อย!  (journaltrading.tech) </b> ยินดีด้วยคุณบันทึกรายการซื้อขายสำเร็จ';
    $mail->msgHTML(file_get_contents("noti.php"), dirname(__FILE__));

    $mail->setFrom('noti@journaltrading.tech', 'journaltrading.tech');
    $mail->addAddress($data1['email'], 'Joe User');     //Add a recipient            //Name is optional
    $mail->addReplyTo('noti@journaltrading.tech', 'journaltrading.tech');


    $sToken = $data1['Line_token'];
    $sMessage = "รายละเอียดการบันทึก\n";
    $sMessage .= "สถานะ : " . $options . " \n";
    $sMessage .= "สินทรัพย์ : " . $assetname . " \n";
    $sMessage .= "ราคา : " . $assetprice . " \n";
    $sMessage .= "จำนวน: " . $assetvolume . " \n";
    $imageFile = new CURLFILE('img/noti.jpeg');
    //	$sticker_package_id = '2';  // Package ID sticker
    //	$sticker_id = '34'; 

    $data  = array(
        'message' => $sMessage,
        'imageFile' => $imageFile
        //	'stickerPackageId' => $sticker_package_id,
        //	'stickerId' => $sticker_id
    );

    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
    $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);





    if (in_array($fileActExt, $allow)) {

        if ($assetimge['size'] > 0 && $assetimge['error'] == 0) {
            if (move_uploaded_file($assetimge['tmp_name'], $filePath)) {
                $id = $_SESSION['login_id'];

                // $sql = $conn->prepare("UPDATE tb_journal SET assetname=:assetname, assetprice=:assetprice, assetvolume=:assetvolume , assetdate=:assetdate , assetnote=:assetnote , assetsl=:assetsl  , assettg=:assettg  , assetimge=:assetimge  
                //  WHERE `ur_id`='$id' ");

                $sql = $conn->prepare("INSERT INTO `tb_journal` (`options`, `assetname`, `assetprice`, `assetvolume`, `assetdate`, `assetnote`, `assetsl`, `assettg`, `Assettype_name`, `ur_id`, `assetimge`) 
                VALUES (:options ,:assetname, :assetprice, :assetvolume, :assetdate, :assetnote, :assetsl, :assettg, :Assettype_name, '$id', :assetimge )");

                $sql->bindParam(":options", $options, PDO::PARAM_STR);
                $sql->bindParam(":assetname", $assetname, PDO::PARAM_STR);
                $sql->bindParam(":assetprice", $assetprice, PDO::PARAM_STR);
                $sql->bindParam(":assetvolume", $assetvolume, PDO::PARAM_STR);
                $sql->bindParam(":assetdate", $assetdate, PDO::PARAM_STR);
                $sql->bindParam(":assetnote", $assetnote, PDO::PARAM_STR);
                $sql->bindParam(":assetsl", $assetsl, PDO::PARAM_STR);
                $sql->bindParam(":assettg", $assettg, PDO::PARAM_STR);
                $sql->bindParam(":Assettype_name", $Assettype_name, PDO::PARAM_STR);
                $sql->bindParam(":assetimge", $fileNew, PDO::PARAM_STR);
                $sql->execute();

                if ($sql) {
                    $mail->Send();
                    echo "<script> 
                        $(document).ready(function(){
                            Swal.fire({ 
                                title: 'สำเร็จ!',
                                text: 'บันทึกรายการเรียบร้อย !',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton : false
                            });
                        });
                    </script>";
                    header("refresh:1 url=index.php");
                } else {

                    header("location: index.php");
                }
            }
        }
    }
}
