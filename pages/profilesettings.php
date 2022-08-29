<?php
error_reporting(error_reporting() & ~E_NOTICE);
require '../service/user_connect.php';


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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE SETTINGS | <?php echo $user['name']; ?> </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/icon type">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light  bg-dark ">
        <a class="navbar-brand ml-3 text-light" href="#">
            <img src="../assets/img/logo.png" width="30" height="30" alt="">
            <span>จดบันทึกและวิเคราะห์การลงทุน | </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="dashboard.php">DASHBOARD<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="journal.php">JOURNAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="performance.php">PERFORMANCE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="report.php">REPORTING</a>
                </li>
            </ul>
            <div class="col-8 col-md-5 col-lg-9 d-flex align-items-center  justify-content-md-end mt-3 mt-md-0">
                <div class="dropdown text-light">
                    <button class="btn   text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                       สวัสดีตอนเที่ยงคุณ : <?php echo $user['name']; ?>
                        <img class="btn  dropdown-toggle" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" alt="img_user" width="60" height="45">
                    </button>

                    <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="survey.php">Risk Profile</a></li>
                        <li><a class="dropdown-item" href="profilesettings.php">Profile Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <h1>
    profilesettings page
    </h1>
</body>
</html>