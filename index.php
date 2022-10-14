<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="css/index.css" />
    <!-- <link rel="stylesheet" href="css/scss.scss" /> -->
    <!-- font -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="./assets/img/logo.png" type="image/icon type">
    <title>จดบันทึกและวิเคราะห์การลงทุน</title>
</head>

<?php

require './service/user_connect.php';

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

//Server settings
$mail->SMTPDebug = 0;                //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'noti@journaltrading.tech';                     //SMTP username
$mail->Password   = 'Book-15571';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

// $mail->addAttachment('./assets/img/notiemail.png', 'notiemail.jpg');    //Optional name

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Login notification alert ! ';
$mail->Body = 'ตรวจพบการเข้าสู่ระบบ (journaltrading.tech) </b> หากไม่ใช้คุณโปรดติดต่อเจ้าหน้าที่ โทร 08638263547 หรือ อีเมล์ noti@journaltrading.tech เพื่อนำเดินการต่อไป';
$mail->msgHTML(file_get_contents("noti.php"), dirname(__FILE__));

if (isset($_SESSION['login_id'])) {
    header('Location: ./dashboard/index.php');
    exit;
}

require './login/google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('758617657839-8pedi5amvm36dngulp9i0v5q0pcfiudn.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://127.0.0.1/project_trading_LAB/index.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) :

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `google_id` FROM `tb_user` WHERE `google_id`='$id'");

        $users = mysqli_query($db_connection, "SELECT `email` FROM `tb_user` WHERE `google_id`='$id'");
        $user = mysqli_fetch_assoc($users);

        $mail->setFrom('noti@journaltrading.tech', 'journaltrading.tech');
        $mail->addAddress($user['email'], 'Joe User');     //Add a recipient            //Name is optional
        $mail->addReplyTo('noti@journaltrading.tech', 'journaltrading.tech');


        if (mysqli_num_rows($get_user) > 0) {
            $_SESSION['login_id'] = $id;
            if (!$mail->Send()) {
                echo 'Message was not sent.';
                echo 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้ ' . $mail->ErrorInfo;
            } else {
                header('Location: ./dashboard/index.php');
                exit;
            }

            exit;
        } else {

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `tb_user`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if ($insert) {
                $_SESSION['login_id'] = $id;
                header('Location: ./dashboard/index.php');
                exit;
            } else {
                echo "Sign up failed!(Something went wrong).";
            }
        }
    } else {
        header('Location: index.php');
        exit;
    }

else :
    // Google Login Url = $client->createAuthUrl(); 
?>



    <body>

        <header>

            <div class="main-container">

                </a>
                <div class="content">

                    <img class="responsive  " src="./assets/img/logo.png" alt="" />
                    <div class="container">
                        <span class="text"></span>
                    </div>

                    <p>
                        เว็บไซต์สำหรับการจดบันทึกและการวิเคราะห์การลงทุนอาทิ หุ้น คริปโต
                        มาพร้อม ระบบแจ้งเตือนผ่าน LINE
                     ระบบส่งออกรายงาน PDF ระบบตรวจสอบสถานะความเสี่ยง</p>
                    <br>

                    <?PHP
                    $url = 'https://bitpay.com/api/rates';
                    $json = json_decode(file_get_contents($url));
                    $THB = $btc = 0;

                    foreach ($json as $obj) {
                        if ($obj->code == 'THB') $btc = $obj->rate;
                    }


                    echo "<p class='showData'> 1 Bitcoin = " .
                        $btc . " THB <br /> </p>";
                    $THB = 1 / $btc;

                    // echo "10 THB = " . round($THB * 10, 8) . "BTC";
                    ?>

                    <br>
                    <br>
                    <div class=" bg-dark hitem" id="newsResults"></div>
                    <div class="btnbtn">
                        <a href="" class="active"></a>
                        <a class="btn " href="<?php echo $client->createAuthUrl(); ?>"><i class="fa-brands fa-google-plus-g"></i> SIGN IN WITH GOOGLE</a>
                    <?php endif; ?>
                    <!-- <a class="btn" href="./admin/pages/index.php">ADMIN (DEV)</a> -->
                    </div>
                </div>
            </div>
        </header>

    </body>

    <!-- javascript -->
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</html>