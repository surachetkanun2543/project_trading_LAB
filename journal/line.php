<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

    .swal-wide {
        border-radius: 40px;
        color: black;
        font-size: 20px;
        width: 650px !important;
        height: 450px !important;
    }
</style>

<?php
error_reporting(0);
session_start();
include "../service/user_connect_PDO.php";

if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}

$id = $_SESSION['login_id'];
$deletestmt = $conn->query("SELECT * FROM `tb_user` WHERE `google_id`='$id'");
$deletestmt->execute();
$data1 = $deletestmt->fetch();

if ($_GET['options']) {



    $options = $_GET['options'];
    $assetname = $_GET['assetname'];


    $sToken = $data1['Line_token'];
    $sMessage = "รายละเอียดการบันทึก\n";
    $sMessage = " $user " . 'สมาชิก' . " \n";
    $sMessage .= "\n __________________ \n";
    $sMessage .= "\nรายละเอียดการบันทึก \n";
    $sMessage .= " __________________ \n";
    $sMessage .= "\nขื่อสินทรัพย์ : " . $options . " \n";
    $imageFile = new CURLFILE('img/noti.png');


    $data  = array(
        'message' => $sMessage,
        'imageFile' => $imageFile

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
    if ($result) {
        $_SESSION['success'] = "ส่งข้อมูลแจ้งเตือน Line Notify เรียบร้อยแล้ว!";
    } else {
        $_SESSION['error'] = "ส่งข้อมูลแจ้งเตือนผิดพลาด!";
    }

    if ($result) {
        echo "
        <script> 
                        $(document).ready(function(){
                            Swal.fire({ 
                                title: 'เรียบร้อย!',
                                text: 'ส่งแจ้งเตือนรายการเทรดผ่าน LINE ของคุณแล้วครับ !',
                                icon: 'success',
                                imageUrl: 'img/good.png',
                                customClass: 'swal-wide',
                                timer: 2000,
                                showConfirmButton : false
                            });
                        });
                    
                    </script>";
        header("refresh:1 url=index.php");
    } else {
        echo "<script> 
                        $(document).ready(function(){
                            Swal.fire({ 
                                title: 'ผิดพลาด!',
                                text: 'ส่งแจ้งเตือนรายการผ่าน LINE ผิดพลาด !',
                                icon: 'error',
                                timer: 1000,
                                showConfirmButton : false
                            });
                        });
                    
                    </script>";
        header("refresh:0.5 url=index.php");
    }
}
