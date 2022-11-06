<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//error_reporting(0);
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

if (!isset($_SESSION['login_id'])) {
    header('Location: ./index.php');
    exit;
}

$id = $_SESSION['login_id'];
$deletestmt = $conn->query("SELECT * FROM `tb_user` WHERE `google_id`='$id'");
$deletestmt->execute();
$data1 = $deletestmt->fetch();

if (isset($_POST['sell'])) {

    $userid = $_SESSION['login_id'];

    $assetsellname = $_POST['assetname'];
    $options = $_POST['options'];
    $assetpricesell = $_POST['assetpricesell'];
    $assetvolumesell = $_POST['assetvolumesell'];
    $assetdatesell = $_POST['assetdatesell'];
    $assetnote = $_POST['assetnote'];
    $ur_id = $_POST['ur_id'];
    $j_id = $_POST['j_id'];

    echo header('Location: index.php');;
    $sqll = "INSERT INTO tb_sell
    (assetsellname, options, assetpricesell,assetvolumesell,assetdatesell,assetnote,ur_id,j_id) 
   VALUES 
   (:assetsellname, :options, :assetpricesell, :assetvolumesell, :assetdatesell, :assetnote, :userid, :j_id )";

    echo 'ur_id ==>' . $ur_id;
    $sql = $conn->prepare($sqll);

    // $sql->bindParam(":id", $id, PDO::PARAM_INT);
    $sql->bindParam(":assetsellname", $assetsellname, PDO::PARAM_STR);
    $sql->bindParam(":options", $options, PDO::PARAM_STR);
    $sql->bindParam(":assetpricesell", $assetpricesell, PDO::PARAM_INT);
    $sql->bindParam(":assetvolumesell", $assetvolumesell, PDO::PARAM_INT);
    $sql->bindParam(":assetdatesell", $assetdatesell, PDO::PARAM_STR);
    $sql->bindParam(":assetnote", $assetnote, PDO::PARAM_STR);
    $sql->bindParam(":userid", $userid, PDO::PARAM_STR);
    $sql->bindParam(":j_id", $j_id, PDO::PARAM_INT);
    $sql->execute();


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
    $sMessage .= "สินทรัพย์ : " . $assetsellname . " \n";
    $sMessage .= "ราคาขาย : " . $assetpricesell . " \n";
    $sMessage .= "จำนวนที่ขาย : " . $assetvolumesell . " \n";
    $imageFile = new CURLFILE('img/notisell.png');
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
    $sql = curl_exec($chOne);



    if ($sql) {
        $mail->Send();
        echo "<script> 
        $(document).ready(function(){
            Swal.fire({ 
                title: 'เรียบร้อย!',
                text: 'ขายรายการนี้ เรียบร้อยแล้วครับ !',
                icon: 'success',
                timer: 1500,
                showConfirmButton : false
            });
        });
        </script>";
        header("refresh:1 url=index.php");
    } else {
        echo "<script> 
        $(document).ready(function(){
            Swal.fire({ 
                title: 'สำเร็จ!',
                text: 'ขายรายการเรียบร้อย !',
                icon: 'success',
                timer: 1000,
                showConfirmButton : false
            });
        });
        </script>";
        header("refresh:1 url=index.php");
    }

    if ($result) {
        $_SESSION['success'] = "บันทึกรายการขาย เรียบร้อยแล้ว!";
    } else {
        $_SESSION['error'] = "ส่งข้อมูลแจ้งเตือนผิดพลาด!";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SELL | <?php echo $data1['name']; ?> </title>
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="manifest" href="../assetsuser/img/favicons/site.webmanifest">
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../assetsuser/img/favicons/browserconfig.xml">

    <!-- stylesheet -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="../assetsuser/css/adminlte.min.css">
    <link rel="stylesheet" href="../assetsuser/css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Charts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />





    <!-- SCRIPTS -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>


    <!-- OPTIONAL SCRIPTS -->
    <script src="../../plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>
</head>

<style>
    .swal-wide {
        background-image: linear-gradient(330deg,
                hsl(240deg 78% 38%) 0%,
                hsl(291deg 100% 30%) 31%,
                hsl(315deg 100% 34%) 48%,
                hsl(333deg 65% 47%) 59%,
                hsl(351deg 58% 57%) 68%,
                hsl(8deg 58% 62%) 74%,
                hsl(20deg 55% 65%) 80%,
                hsl(29deg 47% 70%) 85%,
                hsl(39deg 34% 77%) 91%,
                hsl(54deg 15% 87%) 100%);
        font-size: 20px;
        width: 850px !important;
        height: 450px !important;
    }
</style>

<script>
    $(document).ready(function($) {
        $('#myForm').on('submit', function(evt) {
            $('#send').hide();
        });
    });
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<body class="hold-transition sidebar-mini">
    <div class=" bg-transparent" style="background-image: url('https://images.unsplash.com/photo-1617224908579-c92008fc08bb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'); background-repeat: no-repeat; background-size: cover;">
        <div class="wrapper bg-transparent">
            <div class="content-wrapper  bg-transparent">
                <br>
                <div class="content-header ml-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" elevation-3 bg-dark col-lg-3" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                <div class=" col-lg-10 ">
                                    <br>
                                    <h4 class="ml-4 text-light"> กรุณากรอกข้อมูลรายการขาย </h4>
                                    <p class="ml-4 text-light"> ( Sell Details ) </p>

                                </div>
                            </div>
                            <br> <br>
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['success'])) { ?>
                    <div classs="container p-5 text-center">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-12 m-auto">
                                <div class="alert alert-success elevation-3 fade show text-light text-center" role="alert" style="border-radius:35px;background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                    <h4> <?php
                                            echo $_SESSION['success'];
                                            unset($_SESSION['success']);
                                            ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <main class=" col-md-7 ml-sm-auto col-lg-12 px-md-4 py-4 ">
                    <div class="row">
                        <div class="col-lg-11  mb-2 mb-lg-0">
                            <div class="card" style="border-radius:45px; background: linear-gradient(0deg, rgba(45,44,44,0.7413340336134453) 20%, rgba(40,38,38,0.6713060224089635) 100%);">
                                <div class="card-body text-light elevation-4" style="border-radius:45px; background: linear-gradient(0deg, rgba(11,10,10,0.5116421568627452) 20%, rgba(10,9,9,0.4780287114845938) 100%);">
                                    <br>
                                    <form action="sell2.php" method="post" enctype="multipart/form-data">

                                        <?php
                                        if (isset($_GET['id'])) {
                                            $id = $_SESSION['login_id'];
                                            $stmt = $conn->query(
                                                "SELECT 
                                            *
                                            FROM tb_journal 
                                            as j 
                                            INNER JOIN tb_type 
                                            as t 
                                            on j.Assettype_name=t.Assettype_id
                                            WHERE id = '{$_GET['id']}'"
                                            );

                                            $stmt->execute();
                                            $data = $stmt->fetch();
                                        }
                                        ?>

                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold text-small" for="assetname"><span class="text-danger ml-1"></span></label>
                                            <input type="hidden" name="j_id" id="j_id" class="form-control" readonly value="<?php echo $data['id']; ?>" />
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold text-small" for="assetname">ชื่อสินทรัพย์<span class="text-danger ml-1"></span></label>
                                            <input class="form-control" style="border-radius:45px;" readonly value="<?php echo $data['assetname']; ?>" id="assetname" name="assetname" type="text" placeholder="crypto 2, stock 1" required="" />
                                        </div>


                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold text-small" for="assetvolume">จำนวนที่ซื้อ<span class="text-danger ml-1"></span></label>
                                            <input class="form-control" style="border-radius:45px;" readonly value="<?php echo $data['assetvolume']; ?>" id="assetvolume" name="assetvolume" type="number" placeholder="" required="">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="font-weight-bold text-small" for="assetprice">ราคาที่ซื้อ<span class="text-danger ml-1"></span></label>
                                            <input class="form-control" style="border-radius:45px;" readonly value="<?php echo $data['assetprice']; ?>" id="assetprice" name="assetprice" type="number" placeholder="" required="">
                                        </div>
                                        <hr>
                                        <h4 class="ml-2 mt-2 mb-2">ข้อมูลที่ท่านต้องกรอก <span class="text-danger ml-1">*</span> </h4>
                                        <hr>
                                        <div class="form-group col-lg-8">
                                            <label class="font-weight-bold text-small" for="options">สถานะ<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" style="border-radius:45px;" id="options" name="options" type="text" placeholder="sell" required="กรุณากรอกคำว่า sell" />
                                        </div>


                                        <div class="form-group col-lg-8">
                                            <label class="font-weight-bold text-small" for="assetpricesell">ราคาที่ขาย<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" style="border-radius:45px;" id="assetpricesell" name="assetpricesell" type="number" placeholder="" required="" />
                                        </div>

                                        <div class="form-group col-lg-8">
                                            <label class="font-weight-bold text-small" for="assetvolumesell">จำนวนที่ขาย<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" style="border-radius:45px;" id="assetvolumesell" name="assetvolumesell" type="number" placeholder="" required="" />
                                        </div>

                                        <div class="form-group col-lg-8">
                                            <label class="font-weight-bold text-small" for="assetdatesell">วันเดือนปีที่ขาย<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" style="border-radius:45px;" id="assetdatesell" name="assetdatesell" type="date" placeholder="2022-08-31" />
                                        </div>


                                        <div class="form-group col-lg-8">
                                            <label class="font-weight-bold text-small" for="assetnote">บันทึกเพิ่มเติม<span class="text-danger ml-1">*</span></label>
                                            <textarea class="form-control" style="border-radius:25px;" id="assetnote" name="assetnote" rows="5" placeholder="" required=""></textarea>
                                        </div>

                                        <div class="form-group col-lg-8 ">
                                            <input type="hidden" name="ur_id" id="ur_id">
                                            <button type="submit" name="sell" class="btn btn-success text-light elevation-4 mt-3" style="border-radius:50px;" name="j_id" id="j_id">ยืนยัน</button>
                                            <a href="index.php" class="btn btn-danger text-light elevation-4 mt-3" style="border-radius:50px;">ยกเลิก</a>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- JavaScript Bundle with Popper -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <script>
                        $(document).ready(function() {
                            $('#').DataTable();
                        });
                    </script>

                    <script>
                        let imgInput = document.getElementById('imgInput');
                        let previewImg = document.getElementById('previewImg');

                        imgInput.onchange = evt => {
                            const [file] = imgInput.files;
                            if (file) {
                                previewImg.src = URL.createObjectURL(file)
                            }
                        }
                    </script>
                    <!-- SCRIPTS -->
                    <script src="../plugins/jquery/jquery.min.js"></script>
                    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="../assetsuser/js/adminlte.min.js"></script>


                    <!-- OPTIONAL SCRIPTS -->
                    <script src="../plugins/chart.js/Chart.min.js"></script>
                    <script src="../assetsuser/js/pages/dashboard.js"></script>
</body>

</html>