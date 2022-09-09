<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal-wide {
        font-size: 20px;
        width: 850px !important;
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


if ($_GET['options']) {

    $get_user = mysqli_query($db_connection, "SELECT * FROM `tb_user` WHERE `google_id`='$id'");
    $user = mysqli_fetch_assoc($get_user);

    $options = $_GET['options'];
    $assetname = $_GET['assetname'];


    $sToken = "7FSKNu2uFaw20IQxwYQnnMpFQ4gC4d0Xm3gYjIS0qj8";
    $sMessage = " $user " . 'ผู้ใช้งานทั่วไป' . " \n";
    $sMessage .= "\n __________________ \n";
    $sMessage .= "\nรายละเอียดการบันทึก \n";
    $sMessage .= " __________________ \n";
    $sMessage .= "\nขื่อสินทรัพย์ : " . $options . " \n";
    $imageFile = new CURLFILE('noti.jpeg');


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
        echo "
        

        
        <script> 
                        $(document).ready(function(){
                            Swal.fire({ 
                                title: 'สำเร็จ!',
                                text: 'ส่งแจ้งเตือนรายการผ่าน LINE เรียบร้อย !',
                                icon: 'success',
                                imageUrl: 'line.png',
                                customClass: 'swal-wide',
                                timer: 1000,
                                showConfirmButton : false
                            });
                        });
                    
                    </script>";
        header("refresh:0.5 url=index.php");
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
