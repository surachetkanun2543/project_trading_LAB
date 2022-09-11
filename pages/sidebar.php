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

function isActive($data)
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("pages", $array);
    $name = $array[$key + 1];
    return $name === $data ? 'active' : '';
}



?>

<style>
    .logged-in {
        color: green;
    }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">

            <a class="nav-link" data-widget="pushmenu" href="index.php"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


</nav>
<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-white elevation-3 ">

    <div class="sidebar">
        <div class="user-panel mt-5 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/img/logo.png" alt="Admin Logo" class="brand-image img-circle elevation-3"> &nbsp;
                <span class="font-weight-bold" center>&nbsp; จดบันทึกและวิเคราะห์ </span>
                <hr> <span class="logged-in"> ●&nbsp; </span> : <span class="font-weight-bold align=" center>ยินดีต้อนรับ : &nbsp;</span>&nbsp;&nbsp; &nbsp;<img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" class=" img-circle elevation-3 alt=" User Image">
                <br>
                <br><h4 class="text-success" href="index.php" class="d-block"> คุณ <?php echo $user['name']; ?></h4>
            </div>
        </div>
        <hr>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="../dashboard/index.php" class="nav-link <?php echo isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> DASHBOARD </p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../journal/index.php" class="nav-link <?php echo isActive('journal') ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>JOURNAL</p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../performance/index.php" class="nav-link <?php echo isActive('performance') ?>">
                        <i class="fas fa-store"></i>
                        <p> PERFORMANCE </p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../report/index.php" class="nav-link <?php echo isActive('report') ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p> REPORT </p>
                    </a>
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="../riskproflie/survey.php" id="" class="nav-link <?php echo isActive('report') ?>">
                        <i class="fas fa-sign"></i>
                        <p>RISK PROFILE</p>
                    </a>
                    <hr>
                <li class="nav-item">
                    <a href="../profliesetting/index.php" id="" class="nav-link <?php echo isActive('profilesetting') ?>">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>PROFILE SETTING</p>
                    </a>
                    <hr>
                </li>

                <li class="nav-item btn btn-outline-danger">
                    <a href="logout.php" id="logout" class="nav-link" onclick="return confirm('ยืนยันออกจากระบบ ?');">
                        <i class=" text-danger fas fa-sign-out-alt"></i>
                        <p class=" text-danger " href="logout.php" onclick="return confirm('ยืนยันออกจากระบบ ?');">LOGOUT</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>