<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="css/index.css" />
    <!-- font -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="./assets/img/logo.png" type="image/icon type">
    <title>จดบันทึกและวิเคราะห์การลงทุน</title>
</head>

<?php
require './service/user_connect.php';


if (isset($_SESSION['login_id'])) {
    header('Location: ./pages/dashboard.php');
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
$client->setRedirectUri('http://localhost/project_trading_LAB/index.php');

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
        if (mysqli_num_rows($get_user) > 0) {

            $_SESSION['login_id'] = $id;
            header('Location: ./pages/dashboard.php');
            exit;
        } else {

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `tb_user`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if ($insert) {
                $_SESSION['login_id'] = $id;
                header('Location: ./pages/dashboard.php');
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

                    <img class="responsive" src="./assets/img/logo.png" alt="" />
                    <div class="container">
                        <span class="text"></span>
                    </div>

                    <p>
                        เว็บไซต์สำหรับการจดบันทึกและการวิเคราะห์การลงทุน รองรับหลากหลายสินทรัพย์
                        ไม่ว่าจะเป็น หุ้นอเมริกา คริปโตเคอเรนซี่ และระบบแจ้งเตือน


                        <?php
                        $curl = curl_init();

                        curl_setopt_array($curl,  array(
                            CURLOPT_URL => 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        echo "<p>" . ($response) . "</p>";

                        ?>
                        <br>
                        <br>
                    <div class="btnbtn">
                        <a href="" class="active"></a>
                        <a class="btn" href="<?php echo $client->createAuthUrl(); ?>"><i class="fa-brands fa-google-plus-g"></i> SIGN IN WITH GOOGLE</a>
                    <?php endif; ?>
                    <!-- <a class="btn" href="./admin/pages/index.php">ADMIN</a> -->
                    </div>
                </div>
            </div>
        </header>

    </body>

    <!-- javascript -->
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</html>